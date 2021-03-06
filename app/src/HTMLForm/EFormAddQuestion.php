<?php

namespace Enax\HTMLForm;

/**
 * Anax base class for wrapping sessions.
 *
 */
class EFormAddQuestion extends \Mos\HTMLForm\CForm
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;

   private $tags;
    private $lastID;

    /**
     * Constructor
     *
     */
    public function __construct($tags = null) {

        $this->tags = $tags;
        $tagTitles = array();
        foreach ($this->tags as $value) {
            if ($value->getProperties()['deleted'] == null) {
                $tagTitles[$value->getProperties()['id']] = $value->getProperties()['name'];
            }
        }

        parent::__construct([], [
            'title' => [
            'type'          => 'text',
            'label'         => 'Titel',
            'required'      => true,
            'autofocus'     => true,
            'validation'    => ['not_empty'],
            ],
            'content' => [
            'type'          => 'textarea',
            'label'         => 'Fråga',
            'required'      => true,
            'validation'    => ['not_empty'],
            ],
            'tags' => [
            'type'          => 'select-multiple',
            'options'       => $tagTitles,
            'label'         => 'Ämnestaggar (välj flera med cmd/ctrl nedtryckt)',
            'required'       => true,
            'size'          => 5,
            ],

            'submit' => [
            'type'      => 'submit',
            'value'     => 'Posta fråga',
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
            $this->redirectTo('question');
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

        $this->question = new \Enax\Question\Question();
        $this->question->setDI($this->di);
        // Save question
        $this->question->save([
            'title'      => strip_tags($this->Value('title')),
            'content'      => strip_tags($this->Value('content')),
            'created'   => $now,
            'upvotes'   => 0,
            'downvotes' => 0,
            'questionUserId'  => $this->di->session->get('id')
            ]);
        // Save tag2question
        $this->lastID = $this->question->db->lastInsertId();
        $selectedTags = $this->di->request->getPost('tags');

        $this->di->db->insert(
            'tag2question',
            ['idQuestion', 'idTag']
        );
        foreach ($selectedTags as $tagID) {
            $this->di->db->execute(array($this->lastID, $tagID));
        }

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
        $this->redirectTo('question/id/' . $this->lastID);
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