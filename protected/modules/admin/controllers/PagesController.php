<?php
/**
* 
* Functions listed below are described in AdminController class
* public function filters()
* public function actionIndex();
* public function actionCreate()
* public function actionUpdate($id)
* public function actionOnoff()
* protected function renderForm($model)
* protected function loadModel($id)
*
*/
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
