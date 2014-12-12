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
	        'name' => 'Обучение',
	        'icon' => 'bell-o',
	        'url' => '#',
	        'auth' => 'user',
	        'visible' => true,
	        'parent' => array(
				    0 => array(
				        'name' => 'Курсы',
				        'icon' => 'book',
				        'url' => 'courses',
				        'auth' => 'user',
				        'visible' => true,
				    ),
				    10 => array(
				        'name' => 'Технологии',
				        'icon' => 'gears',
				        'url' => 'technology',
				        'auth' => 'user',
				        'visible' => true,
				    ),
				    20 => array(
				        'name' => 'Направления',
				        'icon' => 'arrows',
				        'url' => 'path',
				        'auth' => 'user',
				        'visible' => true,
				    ),
	        )
	    ),	    
	    40 => array(
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