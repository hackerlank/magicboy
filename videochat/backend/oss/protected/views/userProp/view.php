<?php
/* @var $this UserPropController */
/* @var $model UserProp */

$this->breadcrumbs=array(
	'用户管理'=>array('user/admin'),
	'用户道具管理'=>array('admin'),
	'详情信息',
);

$this->menu=array(
	//array('label'=>'List UserProp', 'url'=>array('index')),
	//array('label'=>'Create UserProp', 'url'=>array('create')),
	array('label'=>'用户道具更新', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete UserProp', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage UserProp', 'url'=>array('admin')),
);
?>

<h1>详情信息</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'uid',
		array('name'=>'道具名称', 'value'=>PropInfo::getNameFromId($model->prop_id)),
		array('name'=>'数量', 'value'=>$model->num),
		array('name'=>'时间', 'value'=>$model->time),
	),
)); ?>
