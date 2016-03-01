<?php

namespace Enax\LoginBar;


class LoginBar {
	
	
    use \Anax\TConfigure,
    \Anax\DI\TInjectionAware;
	
	
   /**
    * Create the Loginbar
    *
    * @return string with html
    */
    public function create() {
        if ($this->di->session->has('acronym')) {
            // show user gravatar and acronym in topbar
            $gravatar = 'http://www.gravatar.com/avatar/' . md5(strtolower(trim($this->di->session->get('email')))) . '.jpg?s=20&d=identicon';
            $url = $this->di->get('url')->create('users/id/'.$this->di->session->get('id'));
            $acronym = $this->di->session->get('acronym');
            $login = '<span class="navbar-img"><img src="'.$gravatar . '" alt="Inloggad som '
            . $this->di->session->get('acronym').'" height="20" width="20"></span>&nbsp;'
            . '<a href="'.$url.'" title="Inloggad som '.$acronym.'">'.$acronym.'</a><div class="loginbar-spacer"></div>';
            $url = $this->di->get('url')->create('logout');
            $login .= '<i class="fa fa-sign-out"></i><a href="'.$url.'"> Logga ut</a><div class="loginbar-spacer"></div>';
        } else {
            // Not logged in, show Login link
            $url = $this->di->get('url')->create('users/add');
            $login = '<i class="fa fa-user-plus"></i><a id="login" href="'.$url.'"> Bli medlem </a><div class="loginbar-spacer"></div>';
            $url = $this->di->get('url')->create('login');
            $login .= '<i class="fa fa-sign-in"></i><a id="login" href="'.$url.'"> Logga in</a><div class="loginbar-spacer"></div>';
        }

        $html = <<<EOD
        <div class="header_container">
            <div class="header right-align">
                <div class="inline-div">
                    {$login}
                </div>
            </div>
        </div>
EOD;
        return $html;
    }
}