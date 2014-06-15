<?php

class ModeratorController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
	
	public function actions(){
		return  array('worktime'=>array(
					'class'=>'application.controllers.Moderator.WorktimeAction',
				));
	}
	
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin', 'delete', 'rank', 'worktime'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Moderator;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Moderator']))
		{
			$model->attributes=$_POST['Moderator'];
			try{
				if($model->save()){
					Yii::app()->user->setFlash('success','添加成功');
					//$this->redirect(array('view','id'=>$model->id));
				}
			}
			catch(Exception $e){
				$errMsg = $e->getMessage();
				if (!!stristr($errMsg, 'Duplicate entry')){
					$errMsg = '该用户已存在，请尝试使用其它用户名';
				}
				Yii::app()->user->setFlash('error',$errMsg);
			}
		}
		
		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);
		
		$oldScore = $model['score'];
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Moderator']))
		{
			$model->attributes = $_POST['Moderator'];
			try{
				if($model->save()){
					Yii::app()->user->setFlash('success','更新成功');
				}
			}
			catch(Exception $e){
				Yii::app()->user->setFlash('error',$e->getMessage());
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	
	public function actionRank(){
		//echo '更新排名';
		$rankGen = new ModeratorRank();
		$res = $rankGen->gen();
		
		$rank = $rankGen->get();
		
		$dataProvider = new CArrayDataProvider($rank, array(
							'keyField'=>'name',
							'sort'=>array(
								'attributes'=>array('name', 'nick', 'score'),
							),
						));
		$this->render('rank', array('res'=>$res, 'dataProvider'=>$dataProvider));
	}
	
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Moderator');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Moderator('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Moderator']))
			$model->attributes=$_GET['Moderator'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Moderator::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='moderator-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
