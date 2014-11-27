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
	    30 => array(
	        'name' => 'Блог',
	        'icon' => 'edit',
	        'url' => '#',
	        'auth' => 'user',
	        'visible' => true,
	        'parent' => array(
				    0 => array(
				        'name' => 'Посты',
				        'icon' => 'bullhorn',
				        'url' => 'news',
				        'auth' => 'user',
				        'visible' => true,
				    ),
				    10 => array(
				        'name' => 'Категории постов',
				        'icon' => 'font',
				        'url' => 'newscategory',
				        'auth' => 'user',
				        'visible' => true,
				    ),
	        )
	    ),	    
	)
);
?>