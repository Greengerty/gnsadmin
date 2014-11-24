<?php
class TeachersController extends AdminController
{
	private $modelName = 'Teachers';

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Render list of module items.
	*/
	public function actionIndex()
	{
		if (!Yii::app()->user->checkAccess('root'))
			$this->accessError();

		$model = new $this->modelName('search');
		$model->unsetAttributes();  // clear any default values

		if (isset($_GET[$this->modelName]))
			$model->attributes=$_GET[$this->modelName];

		$this->render('list', array('model'=>$model));
	}

	/**
	 * Create item.
	*/
	public function actionCreate()
	{
		$model = new $this->modelName;
		$this->renderForm($model);
	}

	/**
	 * @param integer $id the ID of the model to be updated
	*/
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);
		$this->renderForm($model);
	}

	/**
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if (!Yii::app()->user->checkAccess('root'))
			$this->accessError();
		
		$model = new $this->modelName();
		$model::model()->deleteByPk($id);
		$this->redirect( array('index') );
	}

	/**
	 * switch ON/Off status item
	 */
	public function actionOnoff()
	{
		if (!Yii::app()->user->checkAccess('root') || !Yii::app()->request->isAjaxRequest)
			$this->accessError();

		$model=$this->loadModel($_GET['id']);
		$model->isNewRecord = false;
		if($model->status)
			$model->attributes=array('status' => 0);
		else
			$model->attributes=array('status' => 1);
		$model->save();
		echo $model->status;
		exit;
	}

	public function actionImageEdit(){
		if (!Yii::app()->user->checkAccess('root') || !Yii::app()->request->isAjaxRequest)
			$this->accessError();

		// http://wideimage.sourceforge.net/examples/crop/ - documentation/examples
		Yii::import("application.modules.".strtolower(Yii::app()->controller->module->id ).'.components.wideimage.WideImage', true);

		if ($_POST['action'] == 'crop' && is_file(Yii::getPathOfAlias('webroot').'/'.$_POST['src'])) {
			// check image in his module uploads
			if(strpos($_POST['src'], '/'.strtolower($this->modelName).'/') !== false){
				$image = WideImage::load(Yii::getPathOfAlias('webroot').'/'.$_POST['src']);
				$cropped = $image->crop($_POST['x'], $_POST['y'], $_POST['w'], $_POST['h']);
				$cropped->saveToFile(Yii::getPathOfAlias('webroot').'/'.$_POST['src']);

				/* image size */
				$size = getimagesize(Yii::getPathOfAlias('webroot').'/'.$_POST['src']);

				echo json_encode($size);
			}
		}
		exit;
	}

	/**
	 * Render form.
	*/
	private function renderForm($model)
	{
		if (!Yii::app()->user->checkAccess('root'))
			$this->accessError();

		if (isset($_POST[$this->modelName]))
		{
			$model->attributes = $_POST[$this->modelName];
			$oldImageName = $model->img;

			/* deleting img */
			if (isset($_POST['delimg']) && $_POST['delimg'] == 1)
			{
				$model->delOldImgFile($oldImageName);
				$model->img = '';
			}

			/* new img name */
			$image = NULL;
			if ($_FILES[$this->modelName]['name']['image'] != '')
			{
				$rnd = date('Ymd') . '_' . rand(0, 1000);
				$image = CUploadedFile::getInstance($model,'image');
				$newImageName = $rnd.'_'.$image->getName();
			}

			try {
				if ($model->save())
				{
					/* saving img */
					if ($image instanceof CUploadedFile)
					{
						$model->delOldImgFile($oldImageName);
						$model->img = $newImageName;
						$model->save();

						$path = Yii::getPathOfAlias('webroot').'/uploads/'.strtolower($this->modelName).'/'.$rnd.'_'.$image->getName();
	                	$image->saveAs($path);
	                }
	                
					$this->redirect(array('index'));
				}
			}
			catch (Exception $e) {
				throw new CHttpException(405,'Sorry, something wrong with request.');
			}
		}

		/*image size*/
		$size = array();
		if($model->img != '' && is_file(Yii::getPathOfAlias('webroot').'/uploads/'.strtolower($this->modelName).'/'.$model->img))
			$size = getimagesize(Yii::getPathOfAlias('webroot').'/uploads/'.strtolower($this->modelName).'/'.$model->img);

		$this->render('edit', array('model'=>$model, 'size'=>$size));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return $this->modelName the loaded model
	 * @throws CHttpException
	 */
	private function loadModel($id)
	{
		$model = new $this->modelName();
		$model = $model::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404,'The requested page does not exist.');
		else
			$model->isNewRecord = false;
		return $model;
	}

}
