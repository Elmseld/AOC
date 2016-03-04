<?php

namespace Enax\Users;

/**
 * A controller for users and admin related events.
 *
 */
class UsersController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;
    private $customhits = array(4, 8, 12);

    /**
     * Initialize the controller.
     *
     * @return void
     */
    public function initialize() {
        $this->users = new \Enax\Users\User();
        $this->users->setDI($this->di);
    }

    /**
     * List all users.
     *
     * @return void
     */
    public function listAction() {

        $uhits = $this->di->request->getGet('hits') ? $this->di->request->getGet('hits') : $this->di->session->get('uhits');
        $uhits = $uhits != null ? $uhits : 8;
        $this->di->session->set('uhits', $uhits);
        $page = $this->di->request->getGet('page') ? $this->di->request->getGet('page') : 0;


            $all = $this->users->query()
                ->limit($uhits)
                ->offset($page)
                ->orderBy('acronym ASC')
                ->execute();
            $res = $this->users->findAll();
            $count = count($res);
        

        $get = array('hits' => $uhits, 'page' => $page);
        $pagelinks = $this->pager->paginateGet($count, 'users/index', $get, $this->customhits);

        foreach ($all as $user) {
            $user->gravatar = 'http://www.gravatar.com/avatar/' . md5(strtolower(trim($user->getProperties()['email']))) . '.jpg?s=60&d=identicon';
            $user->stats = $this->getUserStats($user->getProperties()['id']);
        }

        $this->theme->setTitle("Alla användare");
        $this->views->add('users/list-all', [
            'users' => $all,
            'pages' => $pagelinks,
            'title' => "Alla användare",
        ]);
    }


    /**
    * Add legend as triptych
    *
    * @return
    */
    private function addLegend() {
        $legend1 = $this->fileContent->get('users/users-legend.html');
        $legend2 = $this->fileContent->get('users/users-legend-2.html');
        $legend3 = $this->fileContent->get('users/users-legend-3.html');

        $this->theme->addClassAttributeFor('wrap-triptych', 'smaller-text');

        $this->views->add('theme/region-small', ['content' => $legend1], 'triptych-1');
        $this->views->add('theme/region-small', ['content' => $legend2], 'triptych-2');
        $this->views->add('theme/region-small', ['content' => $legend3], 'triptych-3');
    }

    /**
     * List user with id.
     *
     * @param int $id of user to display
     *
     * @return void
     */
    public function idAction($id = null) {
        // Get user
        $user = $this->users->find($id);

        if ($user) {
            $user->gravatar = 'http://www.gravatar.com/avatar/' . md5(strtolower(trim($user->getProperties()['email']))) . '.jpg?s=130&d=identicon';
            // Get user answers
            $uAnswers = $this->getUserAnswers($id);
            // Get user comments
            $uComments = $this->getUserComments($id);
            // Get user questions
            $uQuestions = $this->getUserQuestions($id);
            $uQuestions = $this->di->QuestionController->getRelatedData($uQuestions);

            $rank = $this->getUserStats($id);
            $votes = $this->vote->getTotalUserVotes($id);
            // Check Activity tab
            $tab = $this->di->request->getGet('tab') ? $this->di->request->getGet('tab') : 'question';
            switch ($tab) {
                case 'answer':
                    $tabContent = $uAnswers;
                    break;
                case 'comment':
                    $tabContent = $uComments;
                    break;
                default:
                // questions as default
                    $tabContent = $uQuestions;
                    break;
            }

            $this->theme->setTitle("Användare " . $user->acronym);
            $this->views->add('users/view', [
                'user' => $user,
                'rank' => $rank,
                'votes' => $votes,
                'title' => 'Användare ' . $user->acronym,
                'flash' => $this->di->msgFlash->outputMsgs(),
            ]);

            $this->views->add('users/'.$tab.'-tab', [
                'qCount' => count($uQuestions),
                'aCount' => count($uAnswers),
                'cCount' => count($uComments['questioncomments']) + count($uComments['answercomments']),
                'user' => $user,
                'content' => $tabContent,
            ]);
					$this->views->add('users/bottom', []);
            $this->di->msgFlash->clearMsg();
        } else {
            $url = $this->url->create('users');
            $this->response->redirect($url);
        }
    }

    /**
    * Get user stats
    *
    * @param int $id, user ID
    *
    * @return int $stats, sum of activity and rank of posts made
    */
    public function getUserStats($id) {

        // Get no of answers and sum of upvotes and downvotes for user
        $this->db->select("COUNT(*) AS noOfAnswers, COUNT(accepted) AS accAns, SUM(upvotes) AS aUpvotes, SUM(downvotes) AS aDownvotes")
            ->from('answer')
            ->where("answerUserId = ?")
            ->andWhere("deleted IS NULL")
            ->execute([$id]);
        $aStats = $this->db->fetchAll();
        $stats = $aStats[0]->noOfAnswers + $aStats[0]->accAns + $aStats[0]->aUpvotes - $aStats[0]->aDownvotes;

        // Get no of comments and sum of upvotes and downvotes for user
        $this->db->select("COUNT(*) AS noOfComments, SUM(upvotes) AS cUpvotes, SUM(downvotes) AS cDownvotes")
            ->from('comment')
            ->where("commentUserId = ?")
            ->andWhere("deleted IS NULL")
            ->execute([$id]);
        $cStats = $this->db->fetchAll();
        $stats += $cStats[0]->noOfComments + $cStats[0]->cUpvotes - $cStats[0]->cDownvotes;

        // Get no of questions and sum of upvotes and downvotes for user
        $this->db->select("COUNT(*) AS noOfQuestions, SUM(upvotes) AS qUpvotes, SUM(downvotes) AS qDownvotes")
            ->from('question')
            ->where("questionUserId = ?")
            ->andWhere("deleted IS NULL")
            ->execute([$id]);
        $qStats = $this->db->fetchAll();
        $stats += $qStats[0]->noOfQuestions + $qStats[0]->qUpvotes - $qStats[0]->qDownvotes;

        return $stats;
    }

    /**
    * Get user answers
    *
    * @param int $id, user ID
    *
    * @return array $answers, array with Answer objects plus question title
    */
    private function getUserAnswers($id) {
        $userA = new \Enax\Answers\Answer();
        $userA->setDI($this->di);
        $answers = $userA->query("a.*, q.title AS qtitle")
            ->from('answer AS a')
            ->join('question AS q', 'a.questionId = q.id')
            ->where("a.answerUserId = ?")
            ->andWhere("a.deleted IS NULL")
            ->orderBy("a.upvotes - a.downvotes DESC")
            ->execute([$id]);

        return $answers;
    }

    /**
    * Get user comments
    *
    * @param int $id, user ID
    *
    * @return array $comments, array with 2 arrays of Comment objects
    */
    private function getUserComments($id) {
        $userC = new \Enax\Comment\Comment();
        $userC->setDI($this->di);
        $comments['questioncomments'] = $userC->query("c.*, q.id AS qID, q.title AS qtitle")
            ->from('comment AS c')
            ->join('comment2question AS c2q', 'c.id = c2q.idComment')
            ->join('question AS q', 'c2q.idQuestion = q.id')
            ->where("c.commentUserId = ?")
            ->andWhere("c.deleted IS NULL")
            ->orderBy("c.upvotes - c.downvotes DESC")
            ->execute([$id]);

        $comments['answercomments'] = $userC->query("c.*, a.questionID AS qID, a.id AS aID, a.content AS acontent")
            ->from('comment AS c')
            ->join('comment2answer AS c2a', 'c.id = c2a.idComment')
            ->join('answer AS a', 'c2a.idAnswer = a.id')
            ->where("c.commentUserId = ?")
            ->andWhere("c.deleted IS NULL")
            ->orderBy("c.upvotes - c.downvotes DESC")
            ->execute([$id]);
        // Clean comment content from markdown and html-tags
        foreach ($comments['answercomments'] as $comment) {
            $md2html = $this->textFilter->doFilter($comment->getProperties()['acontent'], 'shortcode, markdown');
            $comment->filteredcontent = strip_tags($md2html);
        }

        return $comments;
    }

    /**
    * Get user questions
    *
    * @param int $id, user ID
    *
    * @return array $questions, array with Question objects
    */
    private function getUserQuestions($id) {
        $userQ = new \Enax\Question\Question();
        $userQ->setDI($this->di);
        $questions = $userQ->query()
            ->where("questionUserId = ?")
            ->andWhere("deleted IS NULL")
            ->orderBy("upvotes - downvotes DESC")
            ->execute([$id]);

        return $questions;
    }

    /**
    * List users by rank
    *
    * @param int $limit number of users to fetch
    *
    * @return void
    */
    public function getActiveAction($limit = 1) {
        $all = $this->users->query()
            ->where('deleted IS NULL')
            ->orderBy('acronym ASC')
            ->execute();
        $res = $this->users->query("COUNT(*) AS count")
            ->where('deleted IS NULL')
            ->execute();
        $count = $res[0]->count;

        foreach ($all as $user) {
            $user->gravatar = 'http://www.gravatar.com/avatar/' . md5(strtolower(trim($user->getProperties()['email']))) . '.jpg?s=40&d=identicon';
            $user->stats = $this->getUserStats($user->getProperties()['id']);
        }

        // Sort by rank with anonymous function
        usort($all, function($a, $b) {if ($a->stats == $b->stats) {return 0;} return ($a->stats < $b->stats) ? 1 : -1;});

        // Limit list
        $active = array_slice($all, 0, $limit);

        $this->views->add('users/index-list', [
            'users' => $active,
            'title' => 'Topp '.count($active).' aktivaste användare',
            'totalusers' => $count,
        ]);
    }

    /**
     * Add new user.
     *
     * @param string $acronym of user to add.
     *
     * @return void
     */
    public function addAction($acronym = null) {

        $this->users = $this->di->session->get('tempuser');

        $form = new \Enax\HTMLForm\EFormAddUser($this->users);
        $form->setDI($this->di);
        $form->check();

        $this->di->theme->setTitle("Bli medlem");
        $this->views->add('theme/index', [
            'title' => 'Bli medlem',
            'content' => '<h2>Bli medlem</h2>' . $this->di->msgFlash->outputMsgs() . $form->getHTML(),
            ]);
        $this->di->msgFlash->clearMsg();
    }

    /**
     * Update user.
     *
     * @param int $id of user to edit.
     *
     * @return void
     */
    public function updateAction($id = null) {
        $content = null;
        if (!$this->di->LoginController->checkLoginSimple()) {
            // Not logged in
            $this->di->LoginController->redirectToLogin('Logga in för att redigera användare');

        } elseif ($this->di->LoginController->checkLoginCorrectUser($id)) {
            // User is logged in, show update form
            $user = $this->users->find($id);
            $form = new \Enax\HTMLForm\EFormUpdateUser($user);
            $form->setDI($this->di);
            $form->check();

            $content = $form->getHTML();

        } else {
            // Wrong user is logged in
            $content = '<p>Den gubben går inte! Fel användare är inloggad.</p>';

        }

        $this->di->theme->setTitle("Uppdatera användare");
        $this->views->add('theme/index', [
            'title' => 'Uppdatera användare',
            'content' => '<h2>Uppdatera användare</h2>' . $this->di->msgFlash->outputMsgs() . $content
        ]);
        $this->di->msgFlash->clearMsg();
    }

    /**
    * Softdelete user
    *
    * @param integer $id of user to soft delete.
    *
    * @return void
    */
    public function softDeleteAction($id = null) {

        if ($this->di->LoginController->checkLoginCorrectUser($id)) {
            $form = new \Enax\HTMLForm\EFormDeleteUser($id);
            $form->setDI($this->di);
            $form->check();
            $this->views->add('theme/index', [
                'title' => 'Avsluta konto',
                'content' => '<h3>Vill du avsluta kontot?</h3>' . $form->getHTML(),
            ]);
        } else {
            $this->views->add('theme/index', [
                'title' => 'Kontot avslutat',
                'content' => $this->di->msgFlash->outputMsgs()
            ]);
            $this->di->msgFlash->clearMsg();
        }
    }

    /**
     * Undo delete (soft) user.
     *
     * @param integer $id of user to undo soft delete.
     *
     * @return void
     */
    public function undoSoftDeleteAction($id = null) {
        if (!isset($id)) {
            die("Missing id");
        }

        $now = date('Y-m-d H:i:s');

        $user = $this->users->find($id);

        $user->deleted = null;
        $user->active = $now;
        $user->save();

        $url = $this->url->create('users/id/' . $id);
        $this->response->redirect($url);
    }

}