<?php 
require __DIR__.'/config_with_app.php'; 

$app->router->add('', function() use ($app) {
	    
	$app->theme->setTitle("Startsidan");
	
	$content = $app->fileContent->get('index.md');
	$content = $app->textFilter->doFilter($content, 'shortcode, markdown');

	
		$app->views->add('welcome/page', [
		'content' => $content,
	]);
	
	 $app->dispatcher->forward([
      'controller' => 'question',
      'action' 		 => 'getLatest',
      'params' 		 => [3],
  ]);

  $app->dispatcher->forward([
    'controller' => 'users',
    'action' 		 => 'getActive',
    'params'		 => [4],
]);

    $app->dispatcher->forward([
      'controller' => 'tags',
      'action' 		 => 'getMostPopular',
      'params' 		 => [5, null],
  ]);
    
});

$app->router->add('me', function () use ($app){ 
    $app->theme->setTitle("About");
    $app->theme->addStylesheet('css/comments.css'); 


    $content = $app->fileContent->get('me.md'); 
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown'); 
	
    $byline  = $app->fileContent->get('byline.md'); 
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown'); 

    $app->views->add('me/page', [ 
        'content' => $content, 
        'byline' => $byline, 
    ]);  

}); 

$app->router->add('redovisning', function () use ($app){ 
    $app->theme->setTitle("Redovisning"); 

    $content = $app->fileContent->get('redovisning.md'); 
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown'); 
	
		$byline  = $app->fileContent->get('byline.md'); 
		$byline = $app->textFilter->doFilter($byline, 'shortcode, markdown'); 

    $app->views->add('me/page', [ 
        'content' => $content, 
        'byline' => $byline, 
    ]); 
}); 


// Rout to KommentarsForum, the discussion page
$app->router->add('forum', function() use ($app) {

    $app->theme->addStylesheet('css/comment.css');
    $app->theme->setTitle("Forum");
    $app->views->add('forum/index');

    // Dispatcher for comments view
    $app->dispatcher->forward([
        'controller' => 'question',
        'action'     => 'list',
        'params'    => ['forum'],
    ]);
    
});


// Router for viewing and editing users
$app->router->add('users', function () use ($app) {

    $app->theme->setTitle("Visa alla användare");

    // Display all users in database
    $app->dispatcher->forward([
        'controller' => 'users',
        'action'     => 'list',
    ]);

});



// Router to setup/restore default users
$app->router->add('setupAll', function () use ($app) {

    //$app->db->setVerbose();
    $app->dispatcher->forward([
        'controller' => 'database',
        'action'     => 'setup',
    ]);
 
});

// Router for viewing and editing users
$app->router->add('tags', function () use ($app) {

    $app->theme->setTitle("Visa taggar");

    // Display all users in database
    $app->dispatcher->forward([
        'controller' => 'tags',
        'action'     => 'list',
    ]);

});

// Router for viewing and editing users
$app->router->add('flash', function () use ($app) {
    $app->theme->addStylesheet('css/EFlashMessage.css');
    $app->theme->setTitle("Fyra olika exempel på flash meddelanden");

   	$app->msgFlash->info('Info flash meddelande!!');
	 	$app->msgFlash->success('Success flash meddelande!!');
		$app->msgFlash->alert('Alert flash meddelande!!');
		$app->msgFlash->error('Error flash meddelande!!');
		$app->theme->setVariable('title', "Flash messages")
            	 ->setVariable('main', $app->msgFlash->outputMsgs());
		$app->msgFlash->clearMsg();

});


$app->router->add('source', function() use ($app) { 

    $app->theme->addStylesheet('css/source.css'); 
    $app->theme->setTitle("Källkod"); 

    $source = new \Mos\Source\CSource([ 
        'secure_dir' => '..', 
        'base_dir' => '..', 
        'add_ignore' => ['.htaccess'], 
    ]); 

    $app->views->add('me/source', [ 
        'content' => $source->View(), 
    ]); 

});

/**
 * Dispatch to UserLoginController and show login page
 *
 */
$app->router->add('login', function() use ($app) {
    $app->theme->setTitle("Logga in");
  $app->dispatcher->forward([
    'controller' => 'login',
    'action' => 'login'
    ]);
});

/**
 * Dispatch to UserLoginController and logout
 *
 */
$app->router->add('logout', function() use ($app) {
    $app->theme->setTitle("Logga ut");
  $app->dispatcher->forward([
    'controller' => 'login',
    'action' => 'logout'
    ]);
});

$app->router->handle(); 
$app->theme->render(); 
//echo $app->logger->renderLog();