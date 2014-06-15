<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'用户管理'=>array('admin'),
	'详情信息'
);

$this->menu=array(
	//array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'更新用户信息', 'url'=>array('update', 'id'=>$model->uid)),
	array('label'=>'用户管理', 'url'=>array('admin')),
);
?>

<h1>详情信息</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'uid',
		array('name'=>'权限', 'value'=>$model->privilege),
		array('name'=>'最后登录时间', 'value'=>$model->time),
		array('name'=>'分数', 'value'=>$model->score),
		array('name'=>'头像', 'value'=>$model->face_id),
		array('name'=>'等级', 'value'=>$model->level),
		array('name'=>'昵称', 'value'=>$model->nick),
		array('name'=>'大区', 'value'=>$model->area),
		array('name'=>'职业', 'value'=>$model->occupation),
	),
)); ?>
