<?php
/* @var $this PropInfoController */
/* @var $model PropInfo */

$this->breadcrumbs=array(
	'道具管理'=>array('admin'),
	$model->name,
);

$this->menu=array(
	array('label'=>'道具管理', 'url'=>array('admin')),
);
?>

<h1>详情信息</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'url',
		'score',
	),
)); ?>
