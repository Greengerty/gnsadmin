<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'items-form',
    'htmlOptions'=>array(
        'class'=>'form-horizontal',
    ),	
)); ?>	

	<?php if($model->id != 1){?>
	<div class="form-group">
		<?php echo $form->labelEx($model,'parent', array('class'=>'col-lg-2 col-sm-2 control-label')); ?>
		<div class="col-lg-10">
			<?php echo CHtml::dropDownList('Pages[parent]', $model->parent, $model->getTree($model->id), 
			array('class'=>'form-control m-bot15')
			);?>
			<p><?php echo $form->error($model,'parent',array('class'=>'text-danger')); ?></p>
		</div>
	</div>	
	<?php } ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'name', array('class'=>'col-lg-2 col-sm-2 control-label')); ?>
		<div class="col-lg-10">
            <?php echo $form->textField($model,'name',
                  array('class'=>'form-control', 'placeholder'=>Yii::t('adminModule.app','Название'), 'maxlength'=>255)
            );?>				
			<p><?php echo $form->error($model,'name',array('class'=>'text-danger')); ?></p>
		</div>
	</div>

	<?php if($model->id != 1){?>
	<div class="form-group">
		<?php echo $form->labelEx($model,'controller', array('class'=>'col-lg-2 col-sm-2 control-label')); ?>
		<div class="col-lg-10">
			<?php echo CHtml::dropDownList('Pages[controller]', $model->controller, $model->getControllers(), 
			array('class'=>'form-control m-bot15')
			);?>
			<p><?php echo $form->error($model,'controller',array('class'=>'text-danger')); ?></p>
		</div>
	</div>	
	<?php } ?>	

	<?php if($model->id != 1){?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'url', array('class'=>'col-lg-2 col-sm-2 control-label')); ?>
		<div class="col-lg-10">
            <?php echo $form->textField($model,'url',
                  array('class'=>'form-control', 'placeholder'=>Yii::t('adminModule.app','Адрес страницы'), 'maxlength'=>255)
            );?>				
			<p><?php echo $form->error($model,'url',array('class'=>'text-danger')); ?></p>
		</div>
	</div>	
	<?php } ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'body', array('class'=>'col-lg-2 col-sm-2 control-label')); ?>
		<div class="col-lg-10">
            <?php echo $form->textArea($model,'body',array('class'=>'form-control')); ?>				
			<p><?php echo $form->error($model,'body',array('class'=>'text-danger')); ?></p>
		</div>
	</div>		

	<div class="form-group">
		<?php echo $form->labelEx($model,'meta_title', array('class'=>'col-lg-2 col-sm-2 control-label')); ?>
		<div class="col-lg-10">
            <?php echo $form->textField($model,'meta_title',
                  array('class'=>'form-control', 'placeholder'=>Yii::t('adminModule.app','META-заголовок'), 'maxlength'=>255)
            );?>				
			<p><?php echo $form->error($model,'meta_title',array('class'=>'text-danger')); ?></p>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'meta_description', array('class'=>'col-lg-2 col-sm-2 control-label')); ?>
		<div class="col-lg-10">
            <?php echo $form->textField($model,'meta_description',
                  array('class'=>'form-control', 'placeholder'=>Yii::t('adminModule.app','META-описание'), 'maxlength'=>255)
            );?>				
			<p><?php echo $form->error($model,'meta_description',array('class'=>'text-danger')); ?></p>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'meta_keywords', array('class'=>'col-lg-2 col-sm-2 control-label')); ?>
		<div class="col-lg-10">
            <?php echo $form->textField($model,'meta_keywords',
                  array('class'=>'form-control', 'placeholder'=>Yii::t('adminModule.app','META-ключевые слова'), 'maxlength'=>255)
            );?>				
			<p><?php echo $form->error($model,'meta_keywords',array('class'=>'text-danger')); ?></p>
		</div>
	</div>

	<?php if($model->id != 1){?>
	<div class="form-group">
		<?php echo $form->labelEx($model,'reiting', array('class'=>'col-lg-2 col-sm-2 control-label')); ?>
		<div class="col-lg-10">
            <?php echo $form->textField($model,'reiting',
                  array('class'=>'form-control', 'placeholder'=>Yii::t('adminModule.app','Рейтинг страницы'), 'maxlength'=>255)
            );?>				
			<p><?php echo $form->error($model,'reiting',array('class'=>'text-danger')); ?></p>
		</div>
	</div>

	<div class="form-group">
	<label class="col-lg-2 col-sm-2 control-label required" ></label>
		<div class="col-lg-10">
			<?php echo $form->checkBox($model,'status', array('class'=>'iCheck-helper')); ?>
			&nbsp;&nbsp;<?=Yii::t('adminModule.app','Вкл.')?>
			<p><?php echo $form->error($model,'status',array('class'=>'text-danger')); ?></p>
		</div>
	</div>
	<?php } ?>

	<div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
           <button type="submit" class="btn btn-info"><?php echo ($model->isNewRecord ? 'Создать' : 'Сохранить') ?></button>
        </div>
    </div>
<?php $this->endWidget(); ?>

<script>CKEDITOR.replace( 'Pages_body' );</script>