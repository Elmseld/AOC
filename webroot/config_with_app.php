<?php
/**
 * Config file for pagecontrollers, creating an instance of $app.
 *
 */

// Get environment & autoloader.
require __DIR__.'/config.php'; 

// Create services and inject into the app. 
$di  = new \Enax\DI\CDIFactoryEnax();
$app = new \Anax\Kernel\CAnax($di);

$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN); 
$app->theme->configure(ANAX_APP_PATH . 'config/theme_aoc.php'); 
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_aoc.php'); 

$app->session(); 