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
			
			$this->set('QuestionController', function() {
				$controller = new \Enax\Question\QuestionController();
				$controller->setDI($this);
				return $controller;
				
			});
			
			// User login
      $this->set('LoginController', function() {
          $userlogincontroller = new \Enax\Users\UserLoginController();
          $userlogincontroller->setDI($this);
          return $userlogincontroller;
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
			
			$this->setShared('logger', function () {
         $logger = new \Toeswade\Log\Clog();
         return $logger;
      });
		}
}