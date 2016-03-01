<?php
/**
 * Config-file for navigation bar.
 *
 */
return [

    // Use for styling the menu
    'class' => 'navbar',
 
    // Here comes the menu strcture
    'items' => [

        // This is a menu item
        'home'  => [
            'text'  => 'Home',
            'url'   => $this->di->get('url')->create(''),
            'title' => 'Home route of current frontcontroller'
        ],
        
        // This is a menu item
        'me'  => [
            'text'  => 'About',
            'url'   => $this->di->get('url')->create('me'),
            'title' => 'Om webbutvecklaren'
        ],
        
        // This is a menu item
        'redovisning'  => [
            'text'  => 'Redovisningar',
            'url'   => $this->di->get('url')->create('redovisning'),
            'title' => 'Alla redovisningar för kursmomenten'
        ],
        
        // This is a menu item
        'forum'  => [
            'text'  => 'KommentarsForum',
            'url'   => $this->di->get('url')->create('forum'),
            'title' => 'Kommentera mera'
        ],
			
			  // This is a menu item
        'users'  => [
            'text'  => 'Användare',
            'url'   => $this->di->get('url')->create('users'),
            'title' => 'Administerar användare'
        ],
			
						
			  // This is a menu item
        'flash'  => [
            'text'  => 'Flash meddelanden',
            'url'   => $this->di->get('url')->create('flash'),
            'title' => 'Exempel på olika flash meddelanden'
        ],
        
        // This is a menu item
        'kallkod'  => [
            'text'  => 'Källkod',
            'url'   => $this->di->get('url')->create('source'),
            'title' => 'Källkoden för denna vackra hemsida'
        ],
    ],
 


    /**
     * Callback tracing the current selected menu item base on scriptname
     *
     */
    'callback' => function ($url) {
        if ($url == $this->di->get('request')->getCurrentUrl(false)) {
            return true;
        }
    },



    /**
     * Callback to check if current page is a decendant of the menuitem, this check applies for those
     * menuitems that has the setting 'mark-if-parent' set to true.
     *
     */
    'is_parent' => function ($parent) {
        $route = $this->di->get('request')->getRoute();
        return !substr_compare($parent, $route, 0, strlen($parent));
    },



   /**
     * Callback to create the url, if needed, else comment out.
     *
     */
   /*
    'create_url' => function ($url) {
        return $this->di->get('url')->create($url);
    },
    */
];