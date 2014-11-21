<aside>
	<div id="sidebar"  class="nav-collapse ">
		<!-- sidebar menu goes here-->
		<ul class="sidebar-menu" id="nav-accordion">
		<?php
		 	foreach (Yii::app()->params['menu'] as $menuItem)
		 	{
		 		if (Yii::app()->user->checkAccess($menuItem['auth']) && $menuItem['visible'])
		 		{
		 			$class = '';
		 			if($parametrs['action'] == $menuItem['url'])
		 				$class = 'active';

		 			echo '
						<li>
							<a href="' . Yii::app()->params['adminUrl'] . '/' . $menuItem['url'] . '/" class="'.$class.'">
								<i class="fa fa-' . $menuItem['icon'] . '"></i>
								<span>' . Yii::t('adminModule.app',$menuItem['name']) . '</span>
							</a>
						</li>
						';
		 		}
		 	}
		?>
		</ul>
	</div>
</aside>

