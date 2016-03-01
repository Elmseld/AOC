<?php

namespace Enax\HTMLForm;

/**
 * Anax base class for wrapping sessions.
 *
 */
class EFormUpdateQuestion extends \Mos\HTMLForm\CForm
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;

    /** 
     * Constructor 
     * 
     */ 
    public function __construct($id, $content, $name, $web, $email, $pagekey) 
    { 

        parent::__construct([], [ 
            'pagekey' => [ 
                'type'        => 'hidden', 
                'value'       => $pagekey, 
            ], 

            'id' => [ 
                'type'        => 'hidden', 
                'value'       => $id, 
            ], 

            'content' => [ 
                'type'        => 'textarea', 
                'label'       => 'Kommentar:', 
                'value'       => $content, 
                'required'    => true, 
                'validation'  => ['not_empty'], 

            ], 

            'name' => [ 
                'type'        => 'text', 
                'label'       => 'Namn:', 
                'value'       => $name, 
                'required'    => true, 
                'validation'  => ['not_empty'], 
            ], 

            'web' => [ 
                'type'        => 'url', 
                'value'       => $web, 
                'label'       => 'Hemsida:', 
            ], 

            'email' => [ 
                'type'        => 'email', 
                'value'       => $email, 
                'label'       => 'E-post:', 
                'validation'  => ['not_empty', 'email_adress'], 
            ], 

            'submit' => [ 
                'type'      => 'submit', 
                'value'     => 'Spara', 
                'callback'  => [$this, 'callbackSubmit'], 
            ], 
            'submit-reset' => [ 
                'type'      => 'reset', 
                'value'     => 'Återställ', 
            ], 

            'submit-delete' => [ 
                'type'      => 'submit', 
                'value'     => 'Radera kommentar', 
                'callback'  => [$this, 'callbackDelete'] 
            ], 
        ]); 

    } 
        /** 
         * Customise the check() method. 
         * 
         * @param callable $callIfSuccess handler to call if function returns true. 
         * @param callable $callIfFail    handler to call if function returns true. 
         */ 
        public function check($callIfSuccess = null, $callIfFail = null) 
        { 
            return parent::check([$this, 'callbackSuccess'], [$this, 'callbackFail']); 
        } 



        /** 
         * Callback for submit-button. 
         * 
         */ 
        public function callbackSubmit() 
        { 
            $this->AddOutput("<p><i>DoSubmit(): Form was submitted. Do stuff (save to database) and return true (success) or false (failed processing form)</i></p>"); 
            //$this->AddOutput("<p><b>Name: " . $this->Value('name') . "</b></p>"); 
            //$this->AddOutput("<p><b>Email: " . $this->Value('email') . "</b></p>"); 
            //$this->AddOutput("<p><b>Phone: " . $this->Value('phone') . "</b></p>"); 

            $this->question = new \Enax\Question\Question(); 
            $this->question->setDI($this->di); 

            date_default_timezone_set('Europe/Berlin'); 
                    $now = date('Y-m-d H:i:s'); 

                    $save = $this->question->save([ 
                        'id' => $this->Value('id'), 
                        'content' => $this->Value('content'), 
                        'name' => $this->Value('name'), 
                        'web' => $this->Value('web'), 
                        'email' => $this->Value('email'), 
                        'timestamp' => $now, 
                        'gravatar' => 'http://www.gravatar.com/avatar/' . md5(strtolower(trim($this->Value('email')))) . '.jpg',
                    ]); 

                    return $save ? true : false; 
        } 


        /** 
         * Callback for submit-delete button. 
         * 
         */ 
         public function callbackDelete() 
         { 
             $this->questions = new \Enax\Question\Question(); 
             $this->questions->setDI($this->di); 
             $res = $this->questions->delete($this->Value('id')); 

             return $res ? true : false; 
         } 

        /** 
         * Callback for submit-button. 
         * 
         */ 
        public function callbackSubmitFail() 
        { 
            $this->AddOutput("<p><i>DoSubmitFail(): Form was submitted but I failed to process/save/validate it</i></p>"); 
            return false; 
        } 



        /** 
         * Callback What to do if the form was submitted? 
         * 
         */ 
        public function callbackSuccess() 
        { 
            $this->AddOUtput("<p><i>Form was submitted and the callback method returned true.</i></p>"); 
            $url = $this->Value('pagekey') == 'forum' ? 'forum' : ''; 
            $this->redirectTo($url); 

        } 



        /** 
         * Callback What to do when form could not be processed? 
         * 
         */ 
        public function callbackFail() 
        { 
            $this->AddOutput("<p><i>Form was submitted and the Check() method returned false.</i></p>"); 
            $this->redirectTo(); 
        } 


} 