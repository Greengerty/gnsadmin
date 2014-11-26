<?php
class PagesController extends AdminController
{
	protected $modelName = 'Pages';

	/**
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if (!Yii::app()->user->checkAccess('moderator'))
			$this->accessError();
		
		if ($id != 1) //no del for main page
		{
			$model = new $this->modelName();
			$model::model()->deleteByPk($id);
		}
		$this->redirect( array('index') );
	}

}
