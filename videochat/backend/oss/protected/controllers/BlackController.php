<?php

class BlackController extends Controller
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
				'actions'=>array('admin','delete'),
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
		$model=new Black('create');
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Black']))
		{
			$model->attributes=$_POST['Black'];
			$model['speak'] = $this->expirePorcess($model['speak']);
			$model['login'] = $this->expirePorcess($model['login']);
			try{
				if($model->save()){
					Yii::app()->user->setFlash('success','添加成功');
				}
			}
			catch(Exception $e){
				Yii::app()->user->setFlash('error', $e->getMessage());
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
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Black']))
		{
			$model->attributes = $_POST['Black'];
			$model['speak'] = $this->expirePorcess($model['speak']);
			$model['login'] = $this->expirePorcess($model['login']);
			try{
				if($model->save()){
					Yii::app()->user->setFlash('success','修改成功');
				}
			}
			catch(Exception $e){
				Yii::app()->user->setFlash('error', $e->getMessage());
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
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
		$dataProvider=new CActiveDataProvider('Black');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new Black('search');
		$model->unsetAttributes();
		if(isset($_GET['Black'])){
			$model->attributes=$_GET['Black'];
		}

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
		$model=Black::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='black-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/**
	 *
	 * 处理用户输入的login/speak两项权限时间
	 * @param $time 用户输入的时间
	 */
	protected function expirePorcess($time){
		$time = intval($time);
		if ($time == 0 || $time == -1){
			return $time;
		}
		$time = $time * 60 + time();

		return $time;
	}

   /**
	 *
	 * 数据表中login/speak两项在展现前处理为方便看的形式
	 * 在admin/view模板中调用
	 * @param $time 数据表中的的时间
	 */
	public static function expireShowPorcess($time){
		$time = intval($time);
		if ($time == -1){
			return '永久封禁';
		}
		else if ($time == 0){
			return '正常';
		}
		$time = date('Y-m-d H:i:s', $time);

		return $time;
	}
}
