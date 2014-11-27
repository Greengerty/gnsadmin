
<?php
	if(isset($_GET['page']))
		$parametrs['items']->pagination->currentPage = (int)$_GET['page'];
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
			echo '<th>' . $parametrs['model']->attributeLabels()[$column] . '</th>';
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
			<th style="width:120px">Вкл / Выкл</th>
			<th style="width:100px; text-align:center">Опции</th>
		</tr>
		</thead>
		<tbody>
			<?php
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

				/* join column data */
				if (isset($parametrs['joinColumns']))
				{				
					foreach ($parametrs['joinColumns'] as $column => $model)
					{									/* model name */                       /* join field */    /* needed field */
						$joinArray = CHtml::listData($model['model']::model()->findAll(), $model['joinField'], $model['neededField']);
						echo '<td>' . $joinArray[$item->attributes[$column]] . '</td>';
					}
				}
				/* join column data end */

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
/* PAGER */
$pages = ceil($parametrs['items']->pagination->itemCount / $parametrs['items']->pagination->pageSize); //Pager - count of pages
if($pages > 1){
	$class='';
	if($parametrs['items']->pagination->currentPage == 0)
		$class='active';
?>
<div>
	<ul class="pagination pagination-sm pull-right">
		<li><a href="<?=Yii::app()->params['adminUrl']?>/<?=strtolower($parametrs['items']->id)?>/">«</a></li>
		<li class="<?=$class?>"><a href="<?=Yii::app()->params['adminUrl']?>/<?=strtolower($parametrs['items']->id)?>/">1</a></li>
	<?php
		for($i=2; $i <= $pages; $i++){
			$class='';
			if($i == $parametrs['items']->pagination->currentPage + 1)
				$class='active';
	?>
		<li class="<?=$class?>"><a href="<?=Yii::app()->params['adminUrl']?>/<?=strtolower($parametrs['items']->id)?>/?page=<?=$i?>"><?=$i?></a></li>
	<?php } ?>
		<li><a href="<?=Yii::app()->params['adminUrl']?>/<?=strtolower($parametrs['items']->id)?>/?page=<?=$pages?>">»</a></li>
	</ul>
</div>
<?php } ?>
