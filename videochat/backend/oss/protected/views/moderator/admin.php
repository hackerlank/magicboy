<?php
/* @var $this ModeratorController */
/* @var $model Moderator */

$this->breadcrumbs=array(
	'主持人管理',
);

$this->menu=array(
	//array('label'=>'List Moderator', 'url'=>array('index')),
	array('label'=>'添加主持人', 'url'=>array('create')),
	array('label'=>'主持人排名更新', 'url'=>array('rank')),
	array('label'=>'主持人工时查询', 'url'=>array('worktime')),
);
?>

<h1>主持人管理</h1>

<?php 
	$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'moderator-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array('name'=>'name', 'header'=>'用户名'),
		array('name'=>'nick', 'header'=>'昵称'),
		array('name'=>'passwd', 'header'=>'密码'),
		array('name'=>'score', 'header'=>'分数'),
		array('name'=>'url', 'header'=>'头像地址'),
		array('name'=>'time', 'header'=>'登录时间'),
		array('name'=>'ip', 'header'=>'登录ip'), 
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
