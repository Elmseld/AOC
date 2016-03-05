<?php

namespace Enax\HTMLForm;

/**
 * Anax base class for wrapping sessions.
 *
 */
class EFormUpdateAnswer extends \Mos\HTMLForm\CForm
{
    use \Anax\DI\TInjectionaware,
    \Anax\MVC\TRedirectHelpers;

    private $answerID;

    /**
     * Constructor
     *
     */
    public function __construct($answer = null) {

        $this->answerID = $answer;

        parent::__construct([], [
            'content' => [
            'type'          => 'textarea',
            'label'         => 'Svar',
            'required'      => true,
            'autofocus'     => true,
            'validation'    => ['not_empty'],
						'value'         => $this->answerID->getProperties()['content'],
            ],

            'submit' => [
            'type'      => 'submit',
            'value'     => 'Posta svar',
            'callback'  => [$this, 'callbackSubmit'],
            ],
            'reset' => [
            'type'      => 'reset',
            'value'     => 'Rensa',
            ],
            'submit-abort' => [
            'type'      => 'submit',
            'value'     => 'Avbryt',
            'formnovalidate' => true,
            'callback'  => [$this, 'callbackSubmitFail'],
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
        if ($this->di->request->getPost('submit-abort')) {
            $this->redirectTo('question/id/'.$this->answerID->getProperties()['questionId']);
        } else {
            return parent::check([$this, 'callbackSuccess'], [$this, 'callbackFail']);
        }
    }



    /**
     * Callback for submit-button.
     *
     */
    public function callbackSubmit()
    {

        $now = date('Y-m-d H:i:s');

        $this->answer = new \Enax\Answers\Answer();
        $this->answer->setDI($this->di);
        // Save answer
        $this->answer->save([
						'id'				=> $this->answerID->getProperties()['id'],
            'content'      => strip_tags($this->Value('content')),
            'updated'   => $now,
            ]);

        return true;
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
        $this->redirectTo('question/id/' . $this->answerID->getProperties()['questionId'] . '#answer-' . $this->answerID->getProperties()['id']);
    }



    /**
     * Callback What to do when form could not be processed?
     *
     */
    public function callbackFail()
    {
        $this->AddOutput("<p><i>Det gick inte att spara. Kontrollera fälten.</i></p>");
        $this->redirectTo();
    }

}