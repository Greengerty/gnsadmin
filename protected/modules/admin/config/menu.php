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
				        'name' => 'Новости',
				        'icon' => 'bullhorn',
				        'url' => 'news',
				        'auth' => 'user',
				        'visible' => true,
				    ),
				    10 => array(
				        'name' => 'Анонсы',
				        'icon' => 'font',
				        'url' => '#',
				        'auth' => 'user',
				        'visible' => true,
				    ),
				    20 => array(
				        'name' => 'Прес-релизы',
				        'icon' => 'file-text',
				        'url' => '#',
				        'auth' => 'user',
				        'visible' => true,
				    ),
	        )
	    ),	    
	)
);
?>