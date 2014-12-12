<script src="/themes/admin/js/advanced-form.js"></script>
<link rel="stylesheet" type="text/css" href="/themes/admin/js/jquery-multi-select/css/multi-select.css" />
<script type="text/javascript" src="/themes/admin/js/jquery-multi-select/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="/themes/admin/js/jquery-multi-select/js/jquery.quicksearch.js"></script>


<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'items-form',
    'htmlOptions'=>array(
        'class'=>'form-horizontal',
        'enctype' => 'multipart/form-data',
        'enableAjaxValidation'=>false,
    ),  
)); 
?>      
            <div class="form-group">
                <?php echo $form->labelEx($model,'name', array('class'=>'col-lg-2 col-sm-2 control-label')); ?>
                <div class="col-lg-10">
                    <?php echo $form->textField($model,'name',
                          array('class'=>'form-control', 'placeholder'=>Yii::t('adminModule.app','Название'), 'maxlength'=>255)
                    );?>                
                    <p><?php echo $form->error($model,'name',array('class'=>'text-danger')); ?></p>
                </div>
            </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'alias', array('class'=>'col-lg-2 col-sm-2 control-label')); ?>
            <div class="col-lg-10">
                <?php echo $form->textField($model,'alias',
                      array('class'=>'form-control', 'placeholder'=>Yii::t('adminModule.app','Алиас'), 'maxlength'=>255)
                );?>                
                <p><?php echo $form->error($model,'alias',array('class'=>'text-danger')); ?></p>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 col-sm-2 control-label required" > Курсы </label>
            <div class="col-md-10 control-label tal">
                <select name="Technology[courses][]" class="multi-select" multiple="" id="my_multi_select3" >
                <?php
                $courses = CHtml::listData($model->courses, 'id', 'id');                
                foreach (CHtml::listData(Courses::model()->findAll(), 'id', 'name') as $courseId=>$courseName)
                {
                    $selected = '';
                    if (in_array($courseId, $courses))
                        $selected = 'selected';
                    echo '<option value="'.$courseId.'" '.$selected.'>'.$courseName.'</option>';
                }
                ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 col-sm-2 control-label required" ></label>
            <div class="col-lg-10 toggle-heading" style="height:23px">
            <?php echo $form->checkBox($model,'status', 
                array('class'=>'switch-small', 
                      'data-on'=>"success", 
                      'data-off'=>"danger", 
                      'data-on-label'=>Yii::t('adminModule.app','Вкл'),  
                      'data-off-label'=>Yii::t('adminModule.app','Выкл')
                    )); 
            ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
               <button type="submit" class="btn btn-info"><?php echo ($model->isNewRecord ? 'Создать' : 'Сохранить') ?></button>
            </div>
        </div>
<?php $this->endWidget(); ?>

<script>
    $(document).ready(function()
    {
        $("#Technology_alias").click(function()
        {
            if($("#Technology_alias").val() == '')
                $("#Technology_alias").val( urlRusLat($("#Technology_name").val()) );
        });


        $('#my_multi_select3').multiSelect({
            selectableHeader: "<b>Общий список</b><input type='text' class='form-control search-input' autocomplete='off' placeholder='поиск...'>",
            selectionHeader: "<b>Отобранные курсы</b><input type='text' class='form-control search-input' autocomplete='off' placeholder='поиск...'>",
            afterInit: function (ms) {
                var that = this,
                    $selectableSearch = that.$selectableUl.prev(),
                    $selectionSearch = that.$selectionUl.prev(),
                    selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                    selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

                that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function (e) {
                        if (e.which === 40) {
                            that.$selectableUl.focus();
                            return false;
                        }
                    });

                that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function (e) {
                        if (e.which == 40) {
                            that.$selectionUl.focus();
                            return false;
                        }
                    });

                $(".ms-container").css('width', '100%')
            },
            afterSelect: function () {
                this.qs1.cache();
                this.qs2.cache();
            },
            afterDeselect: function () {
                this.qs1.cache();
                this.qs2.cache();
            }
        });


    });    
</script>