<?php

namespace Enax\Question;

/**
 * To attach comments-flow to a page or some content.
 *
 */
class QuestionController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;
	
    private $customhits = array(5, 10, 15);

    /**
    * Initialize the controller.
    *
    * @return void
    */
    public function initialize() {
        $this->questions = new \Enax\Question\Question();
        $this->questions->setDI($this->di);
    }

    /**
    * List all questions
    *
    * @return void
    */
    public function listAction() {

        $qhits = $this->di->request->getGet('hits') ? $this->di->request->getGet('hits') : $this->di->session->get('qhits');
        $qhits = $qhits != null ? $qhits : 10;
        $this->di->session->set('qhits', $qhits);
        $page = $this->di->request->getGet('page') ? $this->di->request->getGet('page') : 0;

        $all = $this->questions->query()
        ->orderBy('created DESC')
        ->limit($qhits)
        ->offset($page)
        ->execute();
        $all = $this->getRelatedData($all);

        $count = $this->questions->query("COUNT(*) AS count")
        ->execute();
        $get = array('hits' => $qhits, 'page' => $page);
        $pagelinks = $this->pager->paginateGet($count[0]->count, 'question/list', $get, $this->customhits);

        $this->theme->setTitle('Alla frågor');
        $this->views->add('forum/forum', [
            'content' => $all,
            'pages' => $pagelinks,
            'title' => 'Alla frågor',
        ]);

        $title = $count[0]->count == 1 ? $count[0]->count .' fråga' : $count[0]->count .' frågor';

    }

    /**
    * List all questions with provided tag
    *
    * @return void
    */
    public function tagAction() {

        $tag = null;

        $qhits = $this->di->request->getGet('hits') ? $this->di->request->getGet('hits') : $this->di->session->get('qhits');
        $qhits = $qhits ? $qhits : 10;
        $this->di->session->set('qhits', $qhits);
        $page = $this->di->request->getGet('page') ? $this->di->request->getGet('page') : 0;

        if ($this->di->request->getGet('tag')) {
            $tag = $this->di->request->getGet('tag');
        } else {
            $url = $this->url->create('question');
            $this->response->redirect($url);
        }

        $t = new \Enax\Tags\Tags();
        $t->setDI($this->di);
        $tagname = $t->find($tag);

        $count = $this->questions->query("COUNT(*) AS count")
        ->from('question AS q')
        ->join('tag2question AS t2q', 'q.id = t2q.idQuestion')
        ->where("t2q.idTag = " . $tag)
        ->execute();

        $get = array('tag' => $tag, 'hits' => $qhits, 'page' => $page);

        if ($count[0]->count == 0) {
            $pagelinks = $this->pager->paginateGet(1, 'question/tag', $get, $this->customhits);
        } else {
            $pagelinks = $this->pager->paginateGet($count[0]->count, 'question/tag', $get, $this->customhits);
        }

        $all = $this->questions->query("q.*")
        ->from('question AS q')
        ->join('tag2question AS t2q', 'q.id = t2q.idQuestion')
        ->where("t2q.idTag = " . $tag)
        ->limit($qhits)
        ->offset($page)
        ->groupBy('q.id')
        ->orderBy('q.created DESC')
        ->execute();
        $all = $this->getRelatedData($all);

        $this->theme->setTitle($tagname->getProperties()['name']);
        $this->views->add('forum/forum', [
            'content' => $all,
            'pages' => $pagelinks,
            'title' => 'Frågor om ' . $tagname->getProperties()['name'],
        ]);

        $title = $count[0]->count == 1 ? $count[0]->count .' fråga' : $count[0]->count .' frågor';
        $this->views->add('tags/view', [
            'title' => $title,
            'tags' => $tagname,
        ]);
    }


    /**
    * Find with id.
    *
    * @param int $id
    *
    * @return void
    */
    public function idAction($id = null) {

        $res = $this->questions->find($id);
        if ($res) {
            $res = $this->getRelatedData([$res]);
            $vote = $this->vote->checkVote($res[0], 'question');

            $this->theme->setTitle($res[0]->getProperties()['title']);
            $this->views->add('forum/view', [
                'flash' => $this->di->msgFlash->outputMsgs(),
                'question' => $res[0],
                'title' => $res[0]->getProperties()['title'],
                'vote' => $vote,
            ]);
            $this->di->msgFlash->clearMsg();
					
            $this->dispatcher->forward([
                'controller' => 'comment',
                'action'     => 'viewComments',
                'params'    => [$id, 'question', $id],
            ]);
					
            $this->dispatcher->forward([
                'controller' => 'answer',
                'action'    => 'list',
                'params'    => [$res[0]],
            ]);
					
            $this->views->add('tags/side-view', [
                'title' => 'Relaterade taggar',
                'tags' => $res[0]->tags,
            ]);
					
					  $this->views->add('forum/bottom', []);
					
        } else {
					
            $url = $this->url->create('question');
            $this->response->redirect($url);
        }
    }


    /**
    * Upvote action
    *
    * @param string $id, question ID
    *
    * @return void
    */
    public function upvoteAction($id) {

        $res = $this->questions->find($id);
        $this->vote->castVote($res, 'question', 'upvotes', $id);
    }

    /**
    * Downvote action
    *
    * @param string $id, question ID
    *
    * @return void
    */
    public function downvoteAction($id) {

        $res = $this->questions->find($id);
        $this->vote->castVote($res, 'question', 'downvotes', $id);
    }

    /**
    * Add new question
    *
    * @return void
    */
    public function addAction() {

        if (!$this->di->LoginController->checkLoginSimple()) {
            // Not logged in
            $this->di->LoginController->redirectToLogin('Logga in för att ställa en fråga');

        } else {

            $tag = new \Enax\Tags\Tags();
            $tag->setDI($this->di);
            $tags = $tag->query()
            ->where('deleted IS NULL')
            ->orderBy('name ASC')
            ->execute();

            $form = new \Enax\HTMLForm\EFormAddQuestion($tags);
            $form->setDI($this->di);
            $form->check();

            $this->di->theme->setTitle('Ny fråga');
            $this->views->add('theme/index', [
                'title' => 'Ny fråga',
                'content' => '<h2>Ny fråga</h2>' . $form->getHTML(),
            ]);
        }
    }

    /**
    * Update question
    *
    * @return void
    */
    public function updateAction($id = null) {
        $qstn = $this->questions->find($id);
        $qstn = $this->getRelatedData([$qstn]);

        if ($this->di->LoginController->checkLoginCorrectUser($qstn[0]->user->getProperties()['id'])) {
            $tag = new \Enax\Tags\Tags();
            $tag->setDI($this->di);
            $tags = $tag->query()
            ->where('deleted IS NULL')
            ->orderBy('name ASC')
            ->execute();

            $form = new \Enax\HTMLForm\EFormUpdateQuestion($qstn[0], $tags);
            $form->setDI($this->di);
            $form->check();

            $this->di->theme->setTitle('Redigera fråga');
            $this->views->add('theme/index', [
                'title' => 'Redigera fråga',
                'content' => '<h2>Redigera fråga</h2>' . $form->getHTML(),
            ]);

        } else {
            // Not logged in
            $this->di->LoginController->redirectToLogin('Logga in som '. $qstn[0]->user->getProperties()['acronym'] . ' för att redigera fråga');
        }
    }

    /**
    * Delete
    *
    * @param integer $id
    *
    * @return void
    */
    public function deleteAction($id = null) {
        if (!isset($id)) {
            die('Missing id');
        }
        //$res = $this->questions->delete($id);
    }

    /**
    * Get user data, tags, answers and comments
    *
    * @param array $data questions fetched from db
    *
    * @return array $data questions with user data, answers and comments
    */
    public function getRelatedData($data) {
        // If $data array not empty, convert question content from markdown to html, and get user data, Gravatars and tags
        if (is_array($data)) {
            foreach ($data as $id => &$question) {

                $question->filteredcontent = $this->textFilter->doFilter($question->getProperties()['content'], 'shortcode, markdown');
                // Get user info
                $users = new \Enax\Users\User();
                $users->setDI($this->di);
                $question->user = $users->find($question->getProperties()['questionUserId']);
                $question->user->gravatar = 'http://www.gravatar.com/avatar/' . md5(strtolower(trim($question->user->getProperties()['email']))) . '.jpg?d=identicon';
                $question->user->stats = $this->UsersController->getUserStats($question->getProperties()['questionUserId']);
                // Get associated tags
                $tagIDlist = $this->getSelectedTagIDs($question->getProperties()['id']);
                $question->tags = array();
                foreach ($tagIDlist as $value) {
                    $tag = new \Enax\Tags\Tags();
                    $tag->setDI($this->di);
                    $res = $tag->find($value->idTag);
                    if (!$res->deleted) {
                        $question->tags[] = $res;
                    }
                }

                // Sort tags in alphabetical order by name
                usort($question->tags, function($a, $b) {
                    return strcmp($a->name, $b->name);
                });

                // Get no of answers to question
                $this->db->select("COUNT(*) AS noOfAnswers")
                ->from('answer')
                ->where("questionId = ".$question->getProperties()['id'])
                ->execute();

                $res = $this->db->fetchAll();
                $question->noOfAnswers = $res[0]->noOfAnswers;
            }
        }
        return $data;
    }

    /**
    * Get selected tags for a question
    *
    * @param integer $id, question ID
    *
    * @return array $tagIDlist
    */
    private function getSelectedTagIDs($id) {
        $this->db->select("idTag")
        ->from('tag2question')
        ->where("idQuestion = ?")
        ->execute([$id]);
        $tagIDlist = $this->db->fetchAll();

        return $tagIDlist;
    }

    /**
    * Get latest questions
    *
    * @param int $limit, no of questions to fetched
    *
    * @return array $latestquestions
    */
    public function getLatestAction($limit = 1) {

        $all = $this->questions->query()
        ->orderBy('created DESC')
        ->limit($limit)
        ->execute();
        $latestquestions = $this->getRelatedData($all);

        $this->views->add('forum/forum', [
            'content' => $latestquestions,
            'pages' => null,
            'title' => 'Senaste inläggen i forumet',
        ]);

        //return $latestquestions;
    }

}