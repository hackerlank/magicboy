<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	
	public function filters()
	{
		return array(
			'accessControl + draw', // perform access control for CRUD operations
		);
	}
	
	public function accessRules()
	{
		return array(
			array('allow', 
				'actions'=>array('draw', 'show'),
				'users'=>array('@'),
			),
			array('deny', 
				'users'=>array('*'),
			),
		);
	}
	
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
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

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionDraw() {
		$form = new DrawForm();
		if (!isset($_POST['DrawForm'])) {
			$this->render('draw', array('model' => $form));
			return;
		}
		
		$form->attributes = $_POST['DrawForm'];			
		if (!$form->validate()) {
			$this->render('draw', array('model' => $form));
			return;
		}
		
		$card = Card3::model()->findByPk($form->cardnum);
		if (empty($card)) {
			$form->addError('cardnum', '卡号错误');
			$this->render('draw', array('model' => $form));
			return;
		}
		
		if ($card['drink_operator_id'] == 0){
			$card['drink_operator_id'] = yii::app()->user->id;
			$card['ip'] = yii::app()->request->userHostAddress;
			$card['drink_time'] = date('Y-m-d H:i:s');
			
			$res = $card->save();
			if (!$res){
				$form->addError('cardnum', '系统错误，请重领取。');
			}
			else{
				Yii::app()->user->setFlash('success','领取成功');
				$this->render('draw', array('model' => $form));
				return;
			}
		}
		else{
			$form->addError('cardnum', '饮料已领取');
		}
		
		$this->render('draw', array('model' => $form));
	}
	
	public function actionShow(){
		$card = new Card3();
		$num = $card->count("drink_operator_id = :id", array(':id'=>yii::app()->user->id));
		$criteria = new CDbCriteria();
		$criteria->addCondition("drink_operator_id = :id");
		$criteria->params[':id'] = yii::app()->user->id;
		$dataProvider = new CActiveDataProvider($card, array(
			'criteria'=>$criteria,
		));		

		$this->render('show', array('dataProvider'=>$dataProvider, 'model'=>$card, 'num'=>$num));
	}
}