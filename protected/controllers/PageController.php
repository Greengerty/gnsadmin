<?php

class PageController extends Controller
{
	public $controllerName = 'Текстовая страница';

	/**
	 * This is the action to show page from DB
	*/
	public function actionIndex()
	{
	   	$url = Yii::app()->request->pathInfo;
		$criteria=new CDbCriteria;
		$criteria->condition='url=:url';
		$criteria->params=array(':url'=>$url);
		$page = Pages::model()->find($criteria);

		/* menu */ //TODO:: перенести генерацию меню и хлебных крошек в главный контроллер Controller
		$menu = Pages::model()->findAll();
		$allpages = array();
		foreach($menu as $item){
			$this->menu[$item['parent']][] = $item;
			$allpages[$item['id']] = $item;
		}
		/* META TITLE */
		$this->pageTitle = $page['meta_title']. ' - ' . $this->pageTitle;
		/* Breadcrumbs */
		if($page['parent'] != 1)
			$this->breadcrumbs[$allpages[$page['parent']]['url']] = $allpages[$page['parent']]['meta_title'];
		$this->breadcrumbs[$page['url']] = $page['meta_title'];

		$this->render('page', array('page' => $page));
	}

	/**
	 * This is the action to handle external exceptions.
	*/
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}


}