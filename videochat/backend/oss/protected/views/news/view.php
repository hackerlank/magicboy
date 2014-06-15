<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	'新闻公告管理'=>array('admin'),
	'新闻公告详情',
);

$this->menu=array(
	array('label'=>'新闻公告管理', 'url'=>array('admin')),
);
?>

<h1>新闻公告详情</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array('label'=>'类型','value'=>$model->type),
		array('label'=>'标题','value'=>$model->title),
		'url',
		array('label'=>'时间','value'=>$model->title),
	),
)); ?>
