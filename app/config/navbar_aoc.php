<?php
/**
 * Config-file for navigation bar.
 *
 */

 // Check whether user is logged in
 $source = null;
 $login = null;

 
    // Here comes the menu strcture
$items = [

        // This is a menu item
        'index'  => [
            'text'  => 'Index',
            'url'   => $this->di->get('url')->create(''),
            'title' => 'Index route of current frontcontroller'
        ],
        
        // This is a menu item
        'about'  => [
            'text'  => 'About',
            'url'   => $this->di->get('url')->create('me'),
            'title' => 'Om AOC'
        ],
			        
				// This is a menu item
        'forum'  => [
            'text'  => 'Frågeforum',
            'url'   => $this->di->get('url')->create('forum'),
            'title' => 'Ställ din fråga om CSS här'
        ],
			
						 
				// This is a menu item
        'tags'  => [
            'text'  => 'Taggar',
            'url'   => $this->di->get('url')->create('tags'),
            'title' => 'Leta bland taggar'
        ],
						  
				// This is a menu item
        'users'  => [
            'text'  => 'Användare',
            'url'   => $this->di->get('url')->create('users'),
            'title' => 'Administerar användare'
        ],
			
				// This is a menu item
        'redovisning'  => [
            'text'  => 'Redovisningar',
            'url'   => $this->di->get('url')->create('redovisning'),
            'title' => 'Alla redovisningar för kursmomenten'
        ],
        
    ];
	
	
	    // if admin, show source code menu item
    if ($this->di->session->get('isAdmin')) {
        $items['admin'] = [
            'text'  => 'ADMIN &#9662;',
            'url'   => $this->di->get('url')->create('users/id/'.$this->di->session->get('id')),
            'title' => 'Översikt över användare',
            //'mark-if-parent-of' => 'users',
            'submenu' => [
                'items' => [
                    'source' => [
                        'text'  =>'Source code',
                        'url'   => $this->di->get('url')->create('source'),
                        'title' => 'Source code'
                    ],
                    'addtag' => [
                        'text'  => 'Nytt ämne',
                        'url'   => $this->di->get('url')->create('tag/add'),
                        'title' => 'Nytt ämne',
                    ],
                    'newadmin' => [
                        'text'  => 'Ny användare',
                        'url'   => $this->di->get('url')->create('users/add'.'/'.null.'/'.$this->di->session->get('isAdmin')),
                        'title' => 'Skapa ny användare',
                    ]
                ],
            ],
        ];
    }
return [
    // Use for styling the menu
    'class' => 'navbar',
    // Menu structure comes here
    'items' => $items,

 


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