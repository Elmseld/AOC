<?php 
/**
 * This is a Elms pagecontroller.
 *
 */

// Get environment & autoloader.
require __DIR__.'/config_with_app.php'; 


//// Inject the comment service into the app
//$di->setShared('msgFlash', function() use ($di){
//    $flashMessages = new \elms\EFlashMessage\EFlashMessage();
//    $flashMessages->setDI($di);
//    return $flashMessages;
//});

$app->theme->addStylesheet('css/EFlashMessage.css');

$app->msgFlash->alert('Alert flash meddelande!!');
$app->msgFlash->success('Success flash meddelande!!');
$app->msgFlash->error('Error flash meddelande!!');
$app->msgFlash->info('Info flash meddelande!!');
$app->theme->setVariable('title', "Flash messages")
            ->setVariable('main', $app->msgFlash->outputMsgs());
$app->msgFlash->clearMsg();




// Render the response using theme engine.
$app->theme->render();
