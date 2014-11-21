<div class="col-lg-12">
    <div class="panel">
        <div class="panel-heading">
            <?=Yii::t('adminModule.app','Дерево сайта')?>
            <div class="btn-group pull-right">
					<button type="button" class="btn btn-info btn-xs" 
						onclick="javascript:location.href='<?php echo Yii::app()->params['adminUrl'] . '/' . $this->id . '/create/'?>'">
						<?=Yii::t('adminModule.app','Добавить позицию')?> <i class="fa fa-plus"></i>
					</button>
			</div>
        </div>
        <div class="panel-body">
            <div id="FlatTree" class="tree tree-solid-line">
                <div class = "tree-folder" style="display:none;">
                    <div class="tree-folder-header">
                        <i class="fa fa-folder"></i>
                        <div class="tree-folder-name"></div>
                    </div>
                    <div class="tree-folder-content"></div>
                    <div class="tree-loader" style="display:none"></div>
                </div>
                <div class="tree-item" style="display:none;">
                    <i class="tree-dot"></i>
                    <div class="tree-item-name"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
var treeDirOpen = [];
var TreeView = function () 
{
    return 
    {
        //main function to initiate the module
        init: function () 
        {
            var DataSourceTree = function (options) {
                this._data  = options.data;
                this._delay = options.delay;
            };

            DataSourceTree.prototype = {
                data: function (options, callback) {
                    var self = this;

                    setTimeout(function () 
                    {
                    	if(options.additionalParameters == undefined){
                    		var data = $.extend(true, [], treeDataSource[0]._data);
                    	}
                    	else{
                    		var data = $.extend(true, [], treeDataSource[options.additionalParameters.id]._data);
                    	}                       

                        callback({ data: data });
                    }, this._delay)
                }
            };

	            // INITIALIZING TREE
	            var treeDataSource = [];
	        
        		<?php
                /*PHP GENERATED JS FOR TREE */
        			$tree = $model->getTree();
                    $active = $model->getTreeActive();
                    $folders = array();
        			foreach($tree as $idBranch=>$branch){
        				echo '
        				    treeDataSource['.$idBranch.'] = new DataSourceTree({
        		                data: [';

        				foreach($branch as $idItem=>$item){
                            $status = 'no-active';
                            if($active[$idItem] == 1)
                                $status = 'active';

        					if(isset($tree[$idItem])){
                                $folders[] = $idItem;
                                if($idItem != 1)
        						      echo '{ name: \'<a href="#" onclick="edit('.$idItem.')">'.$item.'</a><div class="tree-actions"><i class="fa fa-circle '.$status.'" id="onoff-'.$idItem.'" onclick="treeonoff(this,'.$idItem.')"></i><i class="fa fa-edit" onclick="edit('.$idItem.')"></i><i class="fa fa-trash-o" id="delete-'.$idItem.'" onclick="del('.$idItem.')"></i></div>\', type: \'folder\', additionalParameters: { id: \''.$idItem.'\' } },';
                                else
                                      echo '{ name: \'<a href="#" onclick="edit('.$idItem.')">'.$item.'</a><div class="tree-actions"><i class="fa fa-edit" onclick="edit('.$idItem.')"></i></div>\', type: \'folder\', additionalParameters: { id: \''.$idItem.'\' } },';
                            }
        					else
        						echo '{ name: \'<i class="fa fa-file-text-o"></i> <a href="#" onclick="edit('.$idItem.')">'.$item.'</a> <div class="tree-actions"><i class="fa fa-circle '.$status.'" onclick="treeonoff(this,'.$idItem.')"></i><i class="fa fa-edit" onclick="edit('.$idItem.')"></i><i class="fa fa-trash-o" onclick="del('.$idItem.')"></i></div>\', type: \'item\', additionalParameters: { id: \''.$idItem.'\' } },';
        		        };

        		        echo '
        		                ],
        		                delay: 0
        			        });
        				';
        			}
                    echo 'treeDirOpen = ['.implode(',', $folders).']';
                /* END PHP GENERATED JS FOR TREE */
        		?>
			
            $('#FlatTree').tree({
                selectable: false,
                dataSource: treeDataSource[0],
                loadingHTML: '<img src="/themes/admin/images/input-spinner.gif"/>',
            });
        }
    };
}();

jQuery(document).ready(function()
{
    TreeView.init();
    // open main directory
    setTimeout(function(){$('#fldr-1').trigger('click')}, 300);
});

function edit(id)
{
	location.href="<?=Yii::app()->params['adminUrl']?>/<?=$this->id?>/update/id/"+id+'/';
	return false;
}

function treeonoff(obj, id) 
{
    $.post( '/admin/pages/onoff/id/'+id+'/', {})
    .done(function( data ) {
        if(data == 1){
            $(obj).removeClass('no-active');
            $(obj).addClass('active');
        }
        else{
            $(obj).removeClass('active');
            $(obj).addClass('no-active');
        }
    });
}

function del(id)
{
    if(confirmItemDelete()){
        location.href="<?=Yii::app()->params['adminUrl']?>/<?=$this->id?>/delete/id/"+id+'/';
    }
	return false;
}
</script>