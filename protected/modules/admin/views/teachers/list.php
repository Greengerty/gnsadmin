<div class="col-lg-12">
    <div class="panel">
        <div class="panel-heading">
            <?=Yii::t('adminModule.app','Преподаватели')?>
            <div class="btn-group pull-right">
					<button type="button" class="btn btn-info btn-xs" 
						onclick="javascript:location.href='<?php echo Yii::app()->params['adminUrl'] . '/' . $this->id . '/create/'?>'">
						<?=Yii::t('adminModule.app','Добавить позицию')?> <i class="fa fa-plus"></i>
					</button>
			</div>
        </div>
        <div class="panel-body">
<?php 
	$this->beginWidget('ItemsListWidget',array( 
		'items' => $model->search(), 
		'columns'=>array(
			'id',
			'img',
			'name',
			'position',
			'tags',
		),
		'model'=>$model,	
	));
	$this->endWidget(); 
?>	        
        </div>
    </div>
</div>