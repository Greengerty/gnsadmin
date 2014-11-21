<link rel="stylesheet" type="text/css" href="/themes/admin/js/jquery-tags-input/jquery.tagsinput.css">
<script src="/themes/admin/js/jquery-tags-input/jquery.tagsinput.js"></script>
<script src="/themes/admin/js/advanced-form.js"></script>
<script src="/themes/admin/js/jcrop/js/jquery.Jcrop.min.js"></script>
<script src="/themes/admin/js/imageCropCustom.js"></script> <!-- my custom script -->
<link rel="stylesheet" href="/themes/admin/js/jcrop/css/jquery.Jcrop.css" type="text/css" />

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'items-form',
    'htmlOptions'=>array(
        'class'=>'form-horizontal',
        'enctype' => 'multipart/form-data',
    ),	
)); ?>		
		<div class="form-group">
			<?php echo $form->labelEx($model,'name', array('class'=>'col-lg-2 col-sm-2 control-label')); ?>
			<div class="col-lg-10">
                <?php echo $form->textField($model,'name',
                      array('class'=>'form-control', 'placeholder'=>Yii::t('adminModule.app','Имя'), 'maxlength'=>255)
                );?>				
				<p><?php echo $form->error($model,'name',array('class'=>'text-danger')); ?></p>
			</div>
		</div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'position', array('class'=>'col-lg-2 col-sm-2 control-label')); ?>
            <div class="col-lg-10">
                <?php echo $form->textField($model,'position',
                      array('class'=>'form-control', 'placeholder'=>Yii::t('adminModule.app','Должность'), 'maxlength'=>255)
                );?>                
                <p><?php echo $form->error($model,'position',array('class'=>'text-danger')); ?></p>
            </div>
        </div>

		<div class="form-group">
			<?php echo $form->labelEx($model,'body', array('class'=>'col-lg-2 col-sm-2 control-label')); ?>
			<div class="col-lg-10">
	            <?php echo $form->textArea($model,'body',array('class'=>'form-control')); ?>				
				<p><?php echo $form->error($model,'body',array('class'=>'text-danger')); ?></p>
			</div>
		</div>		

        <div class="form-group">
            <?php echo $form->labelEx($model,'tags', array('class'=>'col-lg-2 col-sm-2 control-label')); ?>
            <div class="col-md-10">
                <?php echo $form->textField($model,'tags',
                      array('class'=>'form-control', 'placeholder'=>Yii::t('adminModule.app','Теги'), 'maxlength'=>255)
                );?>
                <p><?php echo $form->error($model,'tags',array('class'=>'text-danger')); ?></p>
            </div>
        </div>	

        <!-- work with Image1 with crop -->
        <!-- for more images copy and replace mainImg1>mainImg2, imgOptions1>imgOptions2, imgCropOption1>imgCropOption2 e.t.c. -->
        <div class="form-group">
            <?php echo $form->labelEx($model,'img', array('class'=>'col-lg-2 col-sm-2 control-label')); ?>
            <div class="col-md-10">
            	<?php if ($model->img != ''){ ?>
            		<div class="fileupload-new thumbnail" style="text-align:center;">
                        <img src="/uploads/<?=$this->id?>/<?=$model->img?>" alt="" style="height: 150px;" id="mainImg1">
                        <span id="imgOptions1">
                        	<input type="hidden" value="0" name="delimg">
                        	<input class="iCheck-helper" name="delimg" id="delimg1" value="1" type="checkbox"> <label for="delimg1">Удалить</label> | 
                            <i class="fa fa-crop"></i> <a href="javascript: cropImage('mainImg1', <?php echo $size[0] ?>, <?php echo $size[1] ?>, 1)" class="undrlne" id="cropLink1">Обрезать</a>
                        </span>
                        <span id="imgCropCancel1" style="display:none;">
                            <i class="fa fa-times"></i> <a href="javascript: cancelCrop('mainImg1')" class="undrlne">Отменить</a>
                        </span>
                        <span id="imgCropOption1" style="display:none;">
                           | <i class="fa fa-save"></i> <a href="javascript: saveCrop('<?=$this->id?>', '/uploads/<?=$this->id?>/<?=$model->img?>', 'mainImg1')" class="undrlne">Сохранить</a>
                            (W:<span id="imgW1"></span> / H:<span id="imgH1"></span>)
                        </span>
                    </div>
            	<?php } ?>
                <?php echo CHtml::activeFileField($model, 'image'); ?>
                <p><?php echo $form->error($model,'img',array('class'=>'text-danger')); ?></p>
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

		<div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
               <button type="submit" class="btn btn-info"><?php echo ($model->isNewRecord ? 'Создать' : 'Сохранить') ?></button>
            </div>
        </div>
<?php $this->endWidget(); ?>

<script>CKEDITOR.replace( 'Teachers_body' );</script>
