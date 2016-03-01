<?php

namespace Enax\Tags;

/**
 * A controller for users and admin related events.
 *
 */
class TagsController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;
    
    
    /**
     * Initialize the controller.
     *
     * @return void
     */
    public function initialize()
    {
        $this->tags = new \Enax\Tags\Tags();
        $this->tags->setDI($this->di);
    }
    
    
   
    /**
     * List all users.
     *
     * @return void
     */
    public function listAction()
    {			
        $all = $this->tags->findAll();

        $this->theme->setTitle("Taggar");
        $this->views->add('tags/list-all', [
            'tags' => $all,
            'title' => "Alla tillgängliga taggar",
        ]);
    }
    
    
    /**
     * List all active and not deleted users.
     *
     * @return void
     */
    public function activeAction()
    {
        $all = $this->tags->query()
            ->where('active IS NOT NULL')
            ->andWhere('deleted IS NULL')
            ->execute();
 
        $this->theme->setTitle("Aktiva användare");
        $this->views->add('tags/list-all', [
            'tags' => $all,
            'title' => "Aktiva Taggar",
        ]);
    }
    
    
    /**
     * List all inactive and not deleted users.
     *
     * @return void
     */
    public function isInactiveAction()
    {
        $all = $this->tags->query()
            ->where('active IS NULL')
            ->andWhere('deleted IS NULL')
            ->execute();
 
        $this->theme->setTitle("Inaktiva användare");
        $this->views->add('tags/list-all', [
            'tags' => $all,
            'title' => "Inaktiva användare",
        ]);
    }
    
    
    /**
     * List user with id.
     *
     * @param int $id of user to display
     *
     * @return void
     */
    public function idAction($id = null)
    {
        $tags = $this->tags->find($id);
 
        $this->theme->setTitle("Detaljer för användare");
        $this->views->add('tags/view', [
            'tags'  => $tags,
            'title' => "Detaljer för användare: ",
        ]);
    }
    
    
    /**
     * Add new user.
     *
     * @param string $acronym of user to add.
     *
     * @return void
     */
    public function addAction()
    {

        $form = new \Enax\HTMLForm\EFormAdd();
        $form->setDI($this->di);
        $form->check();

        $this->theme->setTitle("Lägg till ny användare");
        $this->views->add('default/page', [
        'title' => "Lägg till ny användare",
        'content' => $form->getHTML()
    ]);

    }

    
    
    /**
     * Restore/setup user database and setup two example users.
     *
     *
     * @return void
     */
    public function setupTagsAction()
    {
        
        $this->db->dropTableIfExists('tags')->execute();

        $this->db->createTable(
            'tags',
            [
                'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
                'name' => ['varchar(20)', 'unique', 'not null'],
                'description' => ['varchar(500)'],
                'questions' => ['integer'],
            ]
        )->execute();

        $this->db->insert(
            'tags',
            ['name', 'description']
        );

        $this->db->execute([
            'Färger',
            'Alla frågor som handlar om färger, allt från temafärger till vilket format som är bäst.'
        ]);

        $this->db->execute([
            'Fonter',
            'Frågor om olika fonter, vilka som är funkar som default fonter i de olika webbläsarna till vilka som är snyggast och roligast.'
        ]);
			
			  $this->db->execute([
            'CSS3',
            'Bu och bä om CSS3 vilka är fördelarna och vilka är nakdelarna och vad är nytt och vad saknas helt enkelt allt inom CSS3.'
        ]);
			
			  $this->db->execute([
            'Forms',
            'Frågor om hur man stylar sin formulär på bästa sätt.'
        ]);
			
			  $this->db->execute([
            'Responsivet',
            'Frågor om hur man stylar sin responsiva sida på sitt eget sätt.'
        ]);

        $url = $this->url->create('tags');
        $this->response->redirect($url);
    }

}