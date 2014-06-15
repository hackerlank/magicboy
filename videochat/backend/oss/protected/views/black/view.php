<?php
/* @var $this BlackController */
/* @var $model Black */

$this->breadcrumbs=array(
	'黑名单管理'=>array('admin'),
	'详情',
);

$this->menu=array(
	array('label'=>'添加黑名单', 'url'=>array('create')),
	array('label'=>'更新黑名单', 'url'=>array('update', 'id'=>$model->uid)),
	array('label'=>'黑名单管理', 'url'=>array('admin')),
);
?>

<h1>详情</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'uid',
		array('name'=>'发言权限', 'value'=>BlackController::expireShowPorcess($model->speak)),
		array('name'=>'登录权限', 'value'=>BlackController::expireShowPorcess($model->login)),
	),
)); ?>
