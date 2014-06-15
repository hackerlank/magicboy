<?php
/* @var $this UserPropController */
/* @var $model UserProp */

$this->breadcrumbs=array(
	'用户管理'=>array('user/admin'),
	'用户道具管理'=>array('admin'),
	'用户道具更新',
	//$model->id=>array('view','id'=>$model->id),

);
/*
$this->menu=array(
	array('label'=>'List UserProp', 'url'=>array('index')),
	array('label'=>'Create UserProp', 'url'=>array('create')),
	array('label'=>'View UserProp', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserProp', 'url'=>array('admin')),
);*/
?>

<h1>用户道具更新</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>