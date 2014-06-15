<?php
/* @var $this BlackController */
/* @var $model Black */

$this->breadcrumbs=array(
	'黑名单管理',
);

$this->menu=array(
	array('label'=>'添加黑名单', 'url'=>array('create')),
);
?>

<h1>黑名单管理</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'black-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'uid',
		array('name'=>'speak', 'value'=>'BlackController::expireShowPorcess($data->speak);', 'header'=>'发言权限封禁'),
		array('name'=>'login', 'value'=>'BlackController::expireShowPorcess($data->login);', 'header'=>'登录权限封禁'),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
