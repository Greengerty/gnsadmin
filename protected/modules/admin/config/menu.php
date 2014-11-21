<?php
return array(
	'menu' => array(
	    0 => array(
	        'name' => 'Администраторы',
	        'icon' => 'user-md',
	        'url' => 'admins',
	        'auth' => 'root',
	        'visible' => true,
	    ),
	    10 => array(
	        'name' => 'Дерево сайта',
	        'icon' => 'sitemap',
	        'url' => 'pages',
	        'auth' => 'moderator',
	        'visible' => true,
	    ),
	    20 => array(
	        'name' => 'Преподаватели',
	        'icon' => 'users',
	        'url' => 'teachers',
	        'auth' => 'user',
	        'visible' => true,
	    ),	    
	)
);
?>