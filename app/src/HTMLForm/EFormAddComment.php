<?php

namespace Enax\HTMLForm;

/**
 * Anax base class for wrapping sessions.
 *
 */
class EFormAddComment extends \Mos\HTMLForm\CForm
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;

    /**
     * Constructor
     *
     */
    public function __construct($pagekey, $ip)
    {
        parent::__construct([], [
            'pagekey' => [
                'type'        => 'hidden',
                'value'       => $pagekey,
            ],            
					
						'ip' => [
                'type'        => 'hidden',
                'value'       => $ip,
            ],            
					
						'content' => [
                'type'        => 'textarea',
                'label'       => 'Ny kommentar:',
								'required'		=> true,
								'validation'	=> ['not_empty'],
            ],
					
            'name' => [
                'type'        => 'text',
                'label'       => 'Ditt namn:',
                'required'    => true,
                'validation'  => ['not_empty'],
            ],
					
						'web' => [
							'type'					=> 'url',
							'label'					=> 'Hemsida:',
						],
					
            'email' => [
                'type'        => 'email',
                'required'    => true,
                'validation'  => ['not_empty', 'email_adress'],
            ],
            'submit' => [
                'type'      => 'submit',
								'value'			=> 'Spara',
                'callback'  => [$this, 'callbackSubmit'],
            ],
            'reset' => [
                'type'      => 'reset',
                'value'     => 'Återställ',
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


        $this->comment = new \Enax\Comment\Comment();
        $this->comment->setDI($this->di);
        
        $now = date('Y-m-d H:i:s');
        
        $save = $this->comment->save([
            'pagekey' 	=> $this->Value('pagekey'),
            'ip' 				=> $this->Value('ip'),
					  'content' 	=> $this->Value('content'),
            'name' 			=> $this->Value('name'),
            'web' 			=> $this->Value('web'),
            'email' 		=> $this->Value('email'),
            'timestamp' => $now,
            ]);
            
        return $save ? true : false; 
    }



    /**
     * Callback What to do if the form was submitted?
     *
     */
    public function callbackSuccess()
    {
        $this->AddOUtput("<p><i>Form was submitted and the callback method returned true.</i></p>");
        $this->redirectTo();

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