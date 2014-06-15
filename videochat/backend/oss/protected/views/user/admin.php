<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'用户管理',
);


$this->menu=array(
	//array('label'=>'添加用户', 'url'=>array('create')),
	array('label'=>'用户排名更新', 'url'=>array('rank')),
	array('label'=>'用户道具管理', 'url'=>array('userProp/admin')),
);

?>

<h1>用户管理</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'uid',
		array('name'=>'privilege', 'header'=>'权限'),
		//'time',
		array('name'=>'score', 'header'=>'分数'),
		//'face_id',
		array('name'=>'level', 'header'=>'等级'),
		array('name'=>'nick', 'header'=>'昵称'),
		array('name'=>'area', 'header'=>'大区'),
		//array('name'=>'occupation', 'header'=>'职业'),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
