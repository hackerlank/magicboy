<?php
/* @var $this UserPropController */
/* @var $model UserProp */

$this->breadcrumbs=array(
	'用户管理'=>array('user/admin'),
	'用户道具管理',
);

$this->menu=array(
	//array('label'=>'Create UserProp', 'url'=>array('create')),
);
?>

<h1>用户道具管理</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-prop-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'uid',
		array('name'=>'prop_id', 'value'=>'PropInfo::getNameFromId($data->prop_id)', 'header'=>'道具名称'),
		array('name'=>'num', 'header'=>'数量'),
		//'time',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
