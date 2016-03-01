<?php

namespace Enax\Question;

/**
 * To attach comments-flow to a page or some content.
 *
 */
class QuestionController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;
	
 public function initialize()
    {
        $this->questions = new \Enax\Question\Question();
        $this->questions->setDI($this->di);
    }

    /**
     * View all comments.
     *
     * @return void
     */
    public function listAction($pagekey)
    {
        $all = $this->questions->query()
            ->where('pagekey = ?')
            ->execute(array($pagekey));

        $this->views->add('forum/forum', [
            'questions' => $all,
            'pagekey'  => $pagekey,
            'title'    => "Frågor"
            ]);
    }

    /**
     * Add a comment.
     *
     * @return void
     */
    public function addAction($pagekey = null)
    {
        $ip = $this->request->getServer('REMOTE_ADDR');

        $form = new \Enax\HTMLForm\EFormAddQuestion($pagekey, $ip);
        $form->setDI($this->di);
        $form->check();

        $this->theme->setTitle("Frågor");
        $this->views->add('default/page', [
            'title' => "Lägg till fråga",
            'content' => $form->getHTML()
    ]);

    }

    /**
     *
     * Form to edit comment
     *
     */
    public function editViewAction($id = null)
    {
        if (!isset($id)) {
            die("Missing id");
        }

        $question = $this->questions->find($id);

        $content = $this->textFilter->doFilter($question->content, "nl2br");
        $name = $question->name;
        $web = $question->web;
        $email = $question->email;
        $pagekey = $question->pagekey;

        $form = new \Enax\HTMLForm\EFormUpdateQuestion($id, $content, $name, $web, $email, $pagekey);
        $form->setDI($this->di);
        $status = $form->check();

        $this->theme->setTitle("Redigera fråga");
        $this->views->add('default/page', [
             'title' => "Redigera fråga",
             'content' => $form->getHTML()
        ]);
    }

    /**
     * Remove one comment.
     *
     * @return void
     */
    public function deleteAction($id, $pagekey)
    {
        $isPosted = $this->request->getPost('doRemoveOne');

        if (!$isPosted) {
            $this->response->redirect($this->request->getPost('redirect'));
        }

        $this->questions->deleteOne($id, $pagekey);

        $this->response->redirect($url);
    }


    /**
     * Remove all comments.
     *
     * @return void
     */
    public function removeAllAction($pagekey)
    {
        $questions = $this->questions->query()
            ->where('pagekey = ?')
            ->execute(array($pagekey));

        foreach ($questions as $question) {
            $this->questions->delete($question->getProperties()['id']);
        }


        $url = $pagekey == 'forum' ? $this->url->create('forum') : $this->url->create('');
        $this->response->redirect($url);
    }

    /**
     * Restore/setup comment database and setup two example comments.
     *
     *
     * @return void
     */
    public function resetForumAction($pagekey = null)
    {
        $this->db->dropTableIfExists('question')->execute();

        $this->db->createTable(
            'question',
            [
                'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
                'content'   => ['text', 'not null'],
                'name'      => ['varchar(80)'],
                'web'       => ['varchar(80)'],
                'email'     => ['varchar(80)'],
                'timestamp' => ['datetime'],
                'ip'        => ['text'],
                'gravatar'  => ['varchar(80)'],
                'pagekey'   => ['varchar(80)'],


            ]
        )->execute();

        $this->db->insert(
            'question',
            ['content', 'name', 'web', 'email', 'timestamp', 'ip', 'gravatar', 'pagekey',]
        );

        date_default_timezone_set('Europe/Berlin');
        $now = date('Y-m-d H:i:s');

        $this->db->execute([
            'Välkommen till frågeforumet, detta är en testkommentar',
            'Nisse',
            'http://www.nisses.se',
            'nisse@hult.se',
            $now,
            $this->request->getServer('REMOTE_ADDR'),
            'http://www.gravatar.com/avatar/' . md5(strtolower(trim('em@ail.se'))) . '.jpg',
            'forum',

        ]);

        $this->db->execute([
            'Testkommentar 2',
            'Webbadmin',
            'http://www.elmseld.se',
            'emily.elmseld@gmail.com',
            $now,
            $this->request->getServer('REMOTE_ADDR'),
            'http://www.gravatar.com/avatar/' . md5(strtolower(trim('emily.elmseld@gmail.com'))) . '.jpg',
            'forum'
        ]);

        $url = $this->url->create('forum');
        $this->response->redirect($url);
    }


}