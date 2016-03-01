<?php
 /**
 * This is a Anax pagecontroller.
 *
 */
// Include the essential settings.
require __DIR__.'/config_with_app.php';

$app->theme->configure(ANAX_APP_PATH . 'config/theme-grid.php');
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_theme.php');


// Home route
$app->router->add('', function() use ($app) {

    $app->theme->setTitle("Ett nytt tema");
	
		$app->views->add('theme/index');

});


//Regions
$app->router->add('regioner', function() use ($app) {
    $app->theme->addStylesheet('css/anax-grid/regions_demo.css');
    $app->theme->setTitle("Regioner");
    
    $app->views->addString('flash', 'flash')
               ->addString('featured-1', 'featured-1')
               ->addString('featured-2', 'featured-2')
               ->addString('featured-3', 'featured-3')
               ->addString('main', 'main')
               ->addString('sidebar', 'sidebar')
               ->addString('triptych-1', 'triptych-1')
               ->addString('triptych-2', 'triptych-2')
               ->addString('triptych-3', 'triptych-3')
               ->addString('footer-col-1', 'footer-col-1')
               ->addString('footer-col-2', 'footer-col-2')
	             ->addString('footer-col-3', 'footer-col-3')
               ->addString('footer-col-4', 'footer-col-4')
			;
});

// Typography
$app->router->add('typography', function() use ($app) {
		
	$app->theme->setTitle("Typography");
	
	$content = $app->fileContent->get('typography.html');
	$content = $app->textFilter->doFilter($content, 'shortcode, markdown');
	
	
	$app->views->addString($content, 'main')
						 ->addString($content, 'sidebar');
	
});

// Font Awesome
$app->router->add('font', function() use ($app) {
		
	$app->theme->setTitle("Font Awesome");
	
	
	$content = $app->fileContent->get('fontAwesome.html');
	$sidebar = $app->fileContent->get('fontAwesomeSide.html');
	$content = $app->textFilter->doFilter($content, 'shortcode, markdown');
	$sidebar = $app->textFilter->doFilter($sidebar, 'shortcode, markdown');
	
	
	$app->views->addString($content, 'main')
						 ->addString($sidebar, 'sidebar');
	
});


// One with everything
$app->router->add('finalTheme', function() use ($app) {
    $app->theme->addStylesheet('css/anax-grid/regions.css');
    $app->theme->setTitle("Final temat");
	
		$featured1 = $app->fileContent->get('fontAwesomeCitat.html');
		$featured2 = $app->fileContent->get('fontAwesomePepp.html');
		$featured3 = $app->fileContent->get('fontAwesomeFeatured.html');
		$main = $app->fileContent->get('typography.html');
		$sidebar = $app->fileContent->get('fontAwesomeSide.html');
		$triptych1 = null;
		$triptych2 = null;
		$triptych3 = null;
		$footerCol1 = $app->fileContent->get('fontFooter4.html');
		$footerCol2 = $app->fileContent->get('fontFooter3.html');
		$footerCol3 = $app->fileContent->get('fontFooter2.html');
		$footerCol4 = $app->fileContent->get('fontFooter.html');

		
	
		if(isset($flash)) 					$app->views->addString($flash, 'flash');
	
		if(isset($featured1) || isset($featured2) || isset($featured3))	{
			$app->views->addString($featured1, 'featured-1')
								 ->addString($featured2, 'featured-2')        
								 ->addString($featured3, 'featured-3');
		}			

		if(isset($main))           	$app->views->addString($main, 'main');
    if(isset($sidebar))         $app->views->addString($sidebar, 'sidebar');
	
		if(isset($triptych1) || isset($triptych2) || isset($triptych3))	{			
			$app->views->addString($triptych1, 'triptych-1')
  							 ->addString($triptych2, 'triptych-2')
   							 ->addString($triptych3, 'triptych-3');

		}
	
		if(isset($footerCol1) || isset($footerCol2) || isset($footerCol3) || isset($footerCol4)) {     
			$app->views->addString($footerCol1, 'footer-col-1')
 								 ->addString($footerCol2, 'footer-col-2')
								 ->addString($footerCol3, 'footer-col-3')
								 ->addString($footerCol4, 'footer-col-4');
		}

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


// Check for matching routes and dispatch to controller/handler of route
$app->router->handle();

// Render the page
$app->theme->render();