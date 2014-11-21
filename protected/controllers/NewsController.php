<?php

class NewsController extends Controller
{
	public $controllerName = 'Новости';

	public function actionIndex()
	{
		$this->render('list');
	}

	public function actionView()
	{
		pre($_GET);

		$this->render('list');
	}

}