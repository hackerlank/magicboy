<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	'新闻公告管理',
);

$this->menu=array(
	array('label'=>'添加新闻公告', 'url'=>array('create')),
	array('label'=>'发布新闻公告', 'url'=>array('distribute')),
);
?>

<h1>新闻公告管理</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'news-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array('name'=>'type', 'header'=>'类型'),
		array('name'=>'title', 'header'=>'标题'),
		'url',
		array('name'=>'time', 'header'=>'时间'),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
