<?php

namespace Enax\DI;

/**
 * Extended factory for Anax documentation.
 *
 */
class CDIFactoryEnax extends \Anax\DI\CDIFactoryDefault
{
   /**
     * Construct.
     *
     */
    public function __construct()
    {
        parent::__construct();

		
			  // Inject the comment service into the app
				$this->set('CommentController', function() {
						$controller = new \Enax\Comment\CommentController();
						$controller->setDI($this);
						return $controller;
				});
			
			$this->set('form', '\Mos\HTMLForm\CForm');
			
			  // Inject the form controller into the app
        $this->set('FormController', function () {
            $controller = new \Anax\HTMLForm\FormController();
            $controller->setDI($this);
            return $controller;
        });
			
        // Inject the database service into the app
        $this->setShared('db', function() {
            $db = new \Mos\Database\CDatabaseBasic();
            $db->setOptions(require ANAX_APP_PATH . 'config/database_sqlite.php');
            $db->connect();
            return $db;
        });
			
			$this->set('UsersController', function() {
				$controller = new \Enax\Users\UsersController();
				$controller->setDI($this);
				return $controller;
				
			});
			
			$this->set('TagsController', function() {
				$controller = new \Enax\Tags\TagsController();
				$controller->setDI($this);
				return $controller;
				
			});
						
			$this->set('AnswerController', function() {
				$controller = new \Enax\Answers\AnswerController();
				$controller->setDI($this);
				return $controller;
				
			});
			
			$this->set('QuestionController', function() {
				$controller = new \Enax\Question\QuestionController();
				$controller->setDI($this);
				return $controller;
				
			});
			
			// User login
      $this->set('LoginController', function() {
          $controller = new \Enax\Login\LoginController();
          $controller->setDI($this);
          return $controller;
      });
			
			// User login
      $this->set('DatabaseController', function() {
          $database = new \Enax\Database\DatabaseController();
          $database->setDI($this);
          return $database;
      });
			
			$this->set('msgFlash', function() {
				$controller = new \Elms\EFlashMessage\EFlashMessage();
				return $controller;
			
			});
			
			// Loginbar
      $this->setShared('loginBar', function () {
          $loginbar = new \Enax\LoginBar\LoginBar();
          $loginbar->setDI($this);
          return $loginbar;
      });
			
			// Pager
      $this->setShared('pager', function() {
          $pager = new \Enax\Pager\EPager();
          $pager->setDI($this);
          return $pager;
      });
			
			// Vote
      $this->setShared('vote', function() {
          $vote = new \Enax\Vote\Vote();
          $vote->setDI($this);
          return $vote;
      });
			
			$this->setShared('logger', function () {
         $logger = new \Toeswade\Log\Clog();
         return $logger;
      });
		}
}
