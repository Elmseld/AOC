<?php

namespace Enax\Users;

class UserLoginController implements \Anax\DI\IInjectionAware {

    use \Anax\DI\TInjectable;
    
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
    *
    * login
    *
    * @return void
    */
	    public function loginAction() {
				
				if($this->checkLoginSimple()) {
					 $info = '<span class="flashmsgicon"><i class="fa fa-info-circle fa-2x"></i></span>&nbsp;Du är redan inloggad som '.$this->di->session->get('acronym');
            $loginform = null;
				}
				
				else {
					$form = new \Enax\HTMLForm\EFormLogin();
					$form->setDI($this->di);
					$form->check();
					$loginform = $form->getHTML();
				}


        $this->theme->setTitle("Logga in");
        $this->views->add('default/page', [
        'title' => "Logga in",
        'content' => $loginform
    ]);

    }
	
	
	
//    public function loginAction() {
//        if ($this->checkLoginSimple()) {
//            $info = '<span class="flashmsgicon"><i class="fa fa-info-circle fa-2x"></i></span>&nbsp;Du är redan inloggad som '.$this->di->session->get('acronym');
//            $this->di->msgFlash->info($info);
//            $loginform = null;
//        
//				} else {
//            $form = new \Enax\HTMLForm\EFormLogin();
//            $form->setDI($this->di);
//            $form->check();
//            $loginform = $form->getHTML();
//        }
//        
//			$this->views->add('default/page', [
//			'title' => 'Logga in',
//			'content' => '<h2>Logga in</h2>' . $loginform,
//        ], 'main-extended');
//		//$this->views->add('users/users-sidebar', [], 'sidebar');
////        $this->di->msgFlash->clearMsg();
//    }
    
	 /**
    * Logout
    *
    * @param bool $logout
    *
    * @return void
    */
    public function logoutAction() {
        if ($this->checkLoginSimple()) {
            $form = new \Enax\HTMLForm\EFormLogout();
            $form->setDI($this->di);
            $form->check();
					  $this->theme->setTitle("Logga ut");
            $this->views->add('default/page', [
                'title' => 'Logga ut',
                'content' => $form->getHTML()
            ]);
        
				} else {
						$logout = $this->di->msgFlash->outputMsgs();
						$this->theme->setTitle("Utloggad");
            $this->views->add('default/page', [
                'title' => 'Utloggad',
                'content' => $logout
            ]);
            $this->di->msgFlash->clearMsg();
        }
    }
    /**
    * Check login simple
    *
    * @return boolean
    */
    public function checkLoginSimple() {
        return $this->di->session->has('acronym');
    }
	
	
    /**
    * Check correct user login
    *
    * @param int $userId
    *
    * @return boolean
    */
    public function checkLoginCorrectUser($userId = null) {
        if ($this->di->session->has('acronym') && ($this->di->session->get('id') === $userId)) {
            return true;
        } else {
            return false;
        }
    }
    /**
    * Check admin user login
    *
    * @param int $userId
    *
    * @return boolean
    */
//    public function checkLoginAdmin($userId = null) {
//        if ($this->di->session->has('acronym') && $this->di->session->get('isAdmin')) {
//            return true;
//        } else {
//            return false;
//        }
//    }
    /**
    * Redirect to login
    *
    * @param string $message, error message
    *
    * @return void
    */
    public function redirectToLogin($message = "Åtgärden kräver inloggning") {
        $this->di->msgFlash->error('<p><span class="flashmsgicon"><i class="fa fa-exclamation-triangle fa-2x"></i></span>&nbsp;'.$message.'</p>');
        $url = $this->url->create('login');
        $this->response->redirect($url);
    }
}