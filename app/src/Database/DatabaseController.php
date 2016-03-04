<?php

namespace Enax\Database;

/**
 * A controller for users and admin related events.
 *
 */
class DatabaseController implements \Anax\DI\IInjectionAware {

    use \Anax\DI\TInjectable;


	    /**
     * Setup database
     *
     * @return void
     */
    public function setupAction() {
        //$this->db->setVerbose();

        
			$this->db->dropTableIfExists('answer')->execute();

        $this->db->createTable(
            'answer',
            [
            'id' 						=> ['integer', 'primary key', 'not null', 'auto_increment'],
            'content' 			=> ['text'],
            'created' 			=> ['datetime'],
            'updated' 			=> ['datetime'],
            'deleted' 			=> ['datetime'],
						'accepted' 			=> ['datetime'],
						'upvotes' 			=> ['integer'],
        		'downvotes' 		=> ['integer'],
            'answerUserId' 	=> ['integer', 'not null'],
            'questionId' 			=> ['integer', 'not null'],
            'foreign key' 	=> ['(answerUserId)', 'references', 'user(id)'],
            'foreign key' 	=> ['(questionId)', 'references', 'question(id)'],
            ]
            )->execute();
			
			       
			$this->db->dropTableIfExists('comment')->execute();

        $this->db->createTable(
            'comment',
            [
            'id' 						=> ['integer', 'primary key', 'not null', 'auto_increment'],
            'content' 			=> ['text'],
            'created' 			=> ['datetime'],
            'updated' 			=> ['datetime'],
            'deleted' 			=> ['datetime'],
						'upvotes'				=> ['integer'],
						'downvotes' 		=> ['integer'],
						'commentUserId' => ['integer', 'not null'],
						'foreign key' 	=> ['(commentUserId) references user(id)'],
            ]
            )->execute();
			
			
			        
			$this->db->dropTableIfExists('question')->execute();

        $this->db->createTable(
        'question',
        [
        'id'	 				=> ['integer', 'primary key', 'not null', 'auto_increment'],
        'title' 			=> ['varchar(80)'],
        'content' 		=> ['text'],
        'created' 		=> ['datetime'],
        'updated' 		=> ['datetime'],
        'deleted' 		=> ['datetime'],
        'upvotes' 		=> ['integer'],
        'downvotes' 	=> ['integer'],
        'questionUserId' => ['integer', 'not null'],
        'foreign key' => ['(questionUserId)', 'references', 'user(id)'],
    		]
    		)->execute();
			
			
			
			        
			$this->db->insert(
            'question',
            ['title', 'content', 'created', 'upvotes', 'downvotes', 'questionUserId',]
        );

        date_default_timezone_set('Europe/Berlin');
        $now = date('Y-m-d H:i:s');

        $this->db->execute([
            'Välkommen till frågeforumet!',
            'Detta är den alldra första testfrågan i detta forum',
            $now,
						'2',
						'0',
						'2',

        ]);

        $this->db->execute([
            'Välkommen till frågeforumet igen!',
            'Detta är den andra testfrågan i detta forum, den är inge vidare poppis',
            $now,
						'1',
						'0',
						'1',
        ]);
			
			
			
			
        
			$this->db->dropTableIfExists('tags')->execute();

        
			$this->db->createTable(
        'tags',
        [
        'id' 					=> ['integer', 'primary key', 'not null', 'auto_increment'],
        'name' 				=> ['varchar(80)'],
        'description' => ['varchar(255)'],
        'created' 		=> ['datetime'],
        'updated' 		=> ['datetime'],
        'deleted' 		=> ['datetime'],
    		]
    		)->execute();

    			        
			$this->db->dropTableIfExists('tag2question')->execute();

			$this->db->createTable(
				'tag2question',
				[
				'idQuestion' 		=> ['integer', 'not null'],
				'idTag' 			=> ['integer', 'not null'],
				'foreign key' => ['(idQuestion)', 'references', 'question(id)'],
				'foreign key' => ['(idTag)', 'references', 'tags(id)'],
				'primary key' => ['(idQuestion, idTag)'],
				]
				)->execute();

			 
			$now = date('Y-m-d H:i:s');

			        
			$this->db->insert(
            'tags',
            ['name', 'description', 'created',]
        );

        $this->db->execute([
            'Färger',
            'Alla frågor som handlar om färger, allt från temafärger till vilket format som är bäst.',
						$now,
        ]);

        $this->db->execute([
            'Fonter',
            'Frågor om olika fonter, vilka som är funkar som default fonter i de olika webbläsarna till vilka som är snyggast och roligast.',
						$now,
        ]);
			
 				$this->db->execute([
            'CSS3',
            'Bu och bä om CSS3 vilka är fördelarna och vilka är nakdelarna och vad är nytt och vad saknas helt enkelt allt inom CSS3.',
						$now,
        ]);
 
				$this->db->execute([
            'Forms',
            'Frågor om hur man stylar sin formulär på bästa sätt.',
						$now,
        ]);

				$this->db->execute([
            'Responsivet',
            'Frågor om hur man stylar sin responsiva sida på sitt eget sätt.',
						$now,
        ]);
			
			$this->db->insert(
            'tag2question',
            ['idQuestion', 'idTag',]
        );

        $this->db->execute([
            '1',
						'1',
        ]);

        $this->db->execute([
            '1',
						'3',
        ]);
			  
			$this->db->execute([
            '2',
						'2',
        ]);

			
			
			
			        
			$this->db->dropTableIfExists('user')->execute();

        $this->db->createTable(
            'user',
            [
            'id'       => ['integer', 'primary key', 'not null', 'auto_increment'],
            'acronym'  => ['varchar(20)', 'unique', 'not null'],
            'email' 	 => ['varchar(80)'],
            'name'     => ['varchar(80)'],
            'password' => ['varchar(255)'],
						'url'			 => ['varchar(80)'],
            'created'  => ['datetime'],
            'updated'  => ['datetime'],
            'deleted'  => ['datetime'],
            'active' 	 => ['datetime'],
            ]
            )->execute();
			

        $now = date('Y-m-d H:i:s');


            
			$this->db->insert(
                'user',
                ['acronym', 'email', 'name', 'password', 'url', 'created', 'active']
                );

        
        
			$enc_password = $this->encryptPassword('johndoe');
        $this->db->execute([
            'johndoe',
            'johndoe@dbwebb.se',
            'John Doe',
            $enc_password,
						'http://dbwebb.se',
            $now,
            $now,
            ]);

        
			$enc_password = $this->encryptPassword('janedoe');
        $this->db->execute([
            'janedoe',
            'janedoe@dbwebb.se',
            'Jane Doe',
            $enc_password,
						'http://test.se',
            $now,
            $now,
            ]);

        
			$enc_password = $this->encryptPassword('webbadmin');
        $this->db->execute([
            'webbadmin',
            'emily.elmseld@gmail.com',
            'Emily Elmseld',
            $enc_password,
						'http://elmseld.se',
            $now,
            $now,
            ]);
			
		
			$this->db->dropTableIfExists('comment2question')->execute();

        $this->db->createTable(
            'comment2question',
            [
            'idQuestion' 		=> ['integer', 'not null'],
            'idComment' 	=> ['integer','not null'],
            'foreign key' => ['(idQuestion) references question(id)'],
            'foreign key' => ['(idComment) references comment(id)'],
            'primary key' => ['(idQuestion, idComment)'],
            ]
            )->execute();
	

			$this->db->dropTableIfExists('comment2answer')->execute();

        $this->db->createTable(
            'comment2answer',
            [
            'idAnswer' 		=> ['integer', 'not null'],
            'idComment' 	=> ['integer','not null'],
            'foreign key' => ['(idAnswer) references answer(id)'],
            'foreign key' => ['(idComment) references comment(id)'],
            'primary key' => ['(idAnswer, idComment)'],
            ]
            )->execute();
	

			$this->db->dropTableIfExists('vote2answer')->execute();

        $this->db->createTable(
            'vote2answer',
            [
            'idAnswer' 		=> ['integer', 'not null'],
            'idUser' 			=> ['integer','not null'],
            'foreign key' => ['(idAnswer) references answer(id)'],
            'foreign key' => ['(idUser) references user(id)'],
            'primary key' => ['(idAnswer, idUser)'],
            ]
            )->execute();

	
			$this->db->dropTableIfExists('vote2question')->execute();

        $this->db->createTable(
            'vote2question',
            [
            'idQuestion' 		=> ['integer', 'not null'],
            'idUser' 			=> ['integer','not null'],
            'foreign key' => ['(idQuestion) references question(id)'],
            'foreign key' => ['(idUser) references user(id)'],
            'primary key' => ['(idQuestion, idUser)'],
            ]
            )->execute();
				
	
			$this->db->dropTableIfExists('vote2comment')->execute();

        $this->db->createTable(
            'vote2comment',
            [
            'idUser' 			=> ['integer', 'not null'],
            'idComment' 	=> ['integer','not null'],
            'foreign key' => ['(idUser) references user(id)'],
            'foreign key' => ['(idComment) references comment(id)'],
            'primary key' => ['(idUser, idComment)'],
            ]
            )->execute();
			

            $url = $this->url->create('');
            $this->response->redirect($url);
    }
	
				

	
	
	    /**
     * Encrypt password depending on PHP version
     *
     * @param string $password, password as string
     *
     * @return string $enc_password, encrypted password
     */
    private function encryptPassword($password) {
        if (version_compare(phpversion(), '5.5.0', '<')) {
            $enc_password = md5($password);
        } else {
            $enc_password = password_hash($password, PASSWORD_DEFAULT);
        }

        return $enc_password;
    }


}