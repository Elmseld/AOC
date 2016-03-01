<?php

namespace Enax\Comment;

/**
 * To attach comments-flow to a page or some content.
 *
 */
class CommentController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;
	
	
	/**
	 * Initialize the controller.
	 *
	 * @return void 
	 */
    public function initialize()
    {
        $this->comments = new \Enax\Comment\Comment();
        $this->comments->setDI($this->di);
    }



    /**
     * List all comments.
     *
     */
    public function listAction($pagekey) {

        $all = $this->comments->query()
										->where('pagekey = ?')
										->execute(array($pagekey));

        $this->views->add('comment/comments', [
            'comments' => $all,
            'pagekey' => $pagekey
        ]);

		}
    

    /**
     * Add a comment.
     *
     */
    public function addAction($pagekey = null)
    {
			$ip = $this->request->getServer('REMOTE_ADDR');
			
			$form = new \Enax\HTMLForm\EFormAddComment($pagekey, $ip);
			$form->setDI($this->di);
			$form->check();
			
			$this->views->add('default/page', [
				'title' 	=> 'Lägg till ny kommentar',
				'content' => $form->getHTML()
			]);
    }

    /**
     * Edit a comment.
     *
     */
    public function editAction($id = null)
    {

        if (!isset($id)) {
            die("Missing id");
        }

        $comment = $this->comments->find($id);
			
				$content = $this->textFilter->doFilter($comment->content, "markdown, nl2br");
				$name 		= $comment->name;
				$web 			= $comment->web;
				$email 		= $comment->email;
				$pagekey 	= $comment->pagekey;
			
				$form = new \Enax\HTMLForm\EFormUpdateComment($pagekey, $id, $content, $name, $web, $email);
				$form->setDI($this->di);
				$status = $form->check();
			
			
        $this->theme->setTitle("Redigera kommentar");
        $this->views->add('default/page', [
            'title'   => "Redigera din kommentar",
            'content'   => $form->getHTML()
        ]);

    }
	

    /**
     * Remove a comment.
     *
     */
    public function removeAction($id, $pagekey){
			
			$isPosted = $this->request->getPost('doRemoveOne');
			
			if(!isPosted) {
				$this->response->redirect($this->request->getPost('redirect'));
			}

        $this->comments->deleteComment($id, $pagekey);

        $this->response->redirect($this->request->getPost('redirect'));
			
    }

    /**
     * Remove all comments.
     *
     */
    public function removeAllAction($pagekey)
    {
			$comments = $this->comments->query()
																 ->where('pagekey = ?')
																 ->execute(array($pagekey));
			
			foreach($comments as $comment) {
				$this->comments->delete($comment->getProperties()['id']);
			}
			
			$url = $pagekey == 'forum' ? $this->url->create('forum') : $this->url->create('');
			$this->response->redirect($url);
    }
	
	    
	
	
		/**
     * Setup comment database and give two example comments.
     *
     *
     * @return void
     */
    public function setupCommentAction($pagekey = null)
    {
        $this->db->dropTableIfExists('comment')->execute();

        $this->db->createTable(
            'comment',
            [
                'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
                'content' => ['text'],
                'name' => ['varchar(80)'],
                'web' => ['varchar(80)'],
                'email' => ['varchar(80)'],
                'timestamp' => ['datetime'],
                'ip' => ['text'],
                'pagekey' => ['varchar(20)']
            ]
        )->execute();

        $this->db->insert(
            'comment',
            ['content', 'name', 'web', 'email', 'timestamp', 'ip', 'pagekey']
        );
        
        $now = date('Y-m-d H:i:s');

        $this->db->execute([
            'Välkommen till Kommentera Mera! Detta är bara en liten testis.',
            'Admin',
            'http://www.elmseld.se',
            'admin@mail.se',
            $now,
            $this->request->getServer('REMOTE_ADDR'),
            'test'
        ]);

        $this->db->execute([
            'När man ändå gör en kan man lika gärna ha två!',
            'Doe',
            'http://www.facebook.se',
            'doe@mail.com',
            $now,
            $this->request->getServer('REMOTE_ADDR'),
            'doe'
        ]);
			
				$url = $pagekey == 'forum' ? $this->url->create('forum') : $this->url->create('');
        $this->response->redirect($url);
    }
}