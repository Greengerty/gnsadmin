
<?php
	/* PAGER */
	$pager = '';

	if(isset($_GET['page']))
		$parametrs['items']->pagination->currentPage = (int)$_GET['page'];

	$parametrs['items']->getData();
	$pages = ceil($parametrs['items']->pagination->itemCount / $parametrs['items']->pagination->pageSize); //Pager - count of pages

	if($pages > 1)
	{
		$class='';
		if($parametrs['items']->pagination->currentPage == 0)
			$class='active';

		/* SEARCH */
		$search = '';
		if (isset($_GET['search']))
		{
			$search .= 'search='.$_GET['search'].'&';
		}

		/* SORT */
		$sort = '';
		$howsort = '';
		if (isset($_GET['sort']))
		{
			$sort .= 'sort='.$_GET['sort'].'&';
			$howsort .= 'howsort='.$_GET['howsort'].'&';
		}

		/* PAGER BODY */
		$pager = '
					<ul class="pagination pagination-sm pull-right">
						<li><a href="'.Yii::app()->params['adminUrl'].'/'.strtolower($parametrs['items']->id).'/?'.$search.$sort.$howsort.'">«</a></li>
		';
		for ($i=0; $i < $pages; $i++)
		{
			$class='';
			if ($i == $parametrs['items']->pagination->currentPage)
				$class='active';

			$pager .= '<li class="'.$class.'"><a href="'.Yii::app()->params['adminUrl'].'/'.strtolower($parametrs['items']->id).'/?'.$search.$sort.$howsort.'page='.$i.'">'.($i+1).'</a></li>';
		} 
		$pager .= '<li><a href="'.Yii::app()->params['adminUrl'].'/'.strtolower($parametrs['items']->id).'/?'.$search.$sort.$howsort.'page='.($pages-1).'">»</a></li>
					</ul>
		';

		echo $pager;
	}
	/* PAGER END */
?>

<div class="adv-table editable-table ">
	<div class="space15"></div>
	<table class="table table-striped table-hover table-bordered" id="editable-sample">
		<thead>
		<tr>
		<?php
		/* column names */
		foreach ($parametrs['columns'] as $column)
		{
			/* SEARCH */
			$search = '';
			if (isset($_GET['search']))
			{
				$search .= 'search='.$_GET['search'].'&';
			}

			/* SORT */
			$sort = 'sort='.$column.'&';
			$howsort = 'howsort=asc&';
			if (isset($_GET['howsort']))
			{
				if($_GET['howsort'] == 'asc')
					$howsort = 'howsort=desc&';
				else
					$howsort = 'howsort=asc&';
			}		
			echo '<th><a href="?'.$search.$sort.$howsort.'">' . $parametrs['model']->attributeLabels()[$column] . '</a></th>';
		}

		/* join column names */
		if (isset($parametrs['joinColumns']))
		{
			foreach ($parametrs['joinColumns'] as $column => $model)
			{
				echo '<th>' . $parametrs['model']->attributeLabels()[$column] . '</th>';
			}
		}
		?>
			<th style="width:120px"><a href="?<?=$search?>sort=status&<?=$howsort?>">Вкл / Выкл</a></th>
			<th style="width:100px; text-align:center">Опции</th>
		</tr>
		</thead>
		<tbody>
			<?php
			/* join column data */
			/* done this before output cycle for sql query optimization */
			if (isset($parametrs['joinColumns']))
			{				
				$joinArray = array();
				foreach ($parametrs['joinColumns'] as $column => $model)
				{									/* model name */                       /* join field */    /* needed field */
					$joinArray[$model['model']] = CHtml::listData($model['model']::model()->findAll(), $model['joinField'], $model['neededField']);
				}
			}
			/* join column data end */

			foreach ($parametrs['items']->getData() as $item) {
				echo '<tr class="">';
				/* column data */
				foreach ($parametrs['columns'] as $column)
				{
					/*name | login*/
					if($column == 'name' || $column == 'login')
						echo '<td><a href="' . Yii::app()->params['adminUrl']. '/' . strtolower($parametrs['items']->id) . '/update/id/'. $item->attributes['id'] . '/">'. $item->attributes[$column] . '</a></td>';
					/* img */
					elseif($column == 'img'){
						if($item->attributes[$column] != '')
							echo '<td><a href="' . Yii::app()->params['adminUrl']. '/' . strtolower($parametrs['items']->id) . '/update/id/'. $item->attributes['id'] . '/"><img width="50" src="/uploads/' . strtolower($parametrs['items']->id) . '/' . $item->attributes[$column] . '"></a></td>';
						else
							echo '<td></td>';
					}
					/* else */
					else
						echo '<td>' . $item->attributes[$column] . '</td>';
				}
				/* column data end */

				/* join column data output */
				if (isset($parametrs['joinColumns']))
				{				
					foreach ($parametrs['joinColumns'] as $column => $model)
						echo '<td>' . $joinArray[$model['model']][$item->attributes[$column]] . '</td>';
				}
				/* join column data output end */

				$status = 'no-active';
				if(isset($item->attributes['status']) && $item->attributes['status'] == 1)
					$status = 'active';
			?>
			<td align="center">
				<a href="javascript:void(0)" onclick="onoff(this, '<?=Yii::app()->params['adminUrl']?>/<?=strtolower($parametrs['items']->id)?>/onoff/id/<?=$item->attributes['id']?>/', '<?=$item->attributes['id']?>')"><i class="fa fa-circle <?=$status?>"></i></a>
			</td>
			<td class="gns-actions" align="center">
				<a href="<?=Yii::app()->params['adminUrl']?>/<?=strtolower($parametrs['items']->id)?>/update/id/<?=$item->attributes['id']?>/"><i class="fa fa-edit"></i></a>
				<a onclick="return confirmItemDelete();"href="<?=Yii::app()->params['adminUrl']?>/<?=strtolower($parametrs['items']->id)?>/delete/id/<?=$item->attributes['id']?>/"><i class="fa fa-trash-o"></i></a>
			</td>
			<?php } ?>
		</tr>
		</tbody>
	</table>
</div>
<?php 
	echo $pager;
?>
