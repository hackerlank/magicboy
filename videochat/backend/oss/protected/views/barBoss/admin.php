<?php
/* @var $this BarBossController */
/* @var $model BarBoss */

$this->breadcrumbs=array(
	'网吧老板管理',
);

$this->menu=array(
	array('label'=>'添加老板', 'url'=>array('create')),
);
?>

<h1>网吧老板管理</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'bar-boss-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array('name'=>'name', 'header'=>'用户名'),
		array('name'=>'passwd', 'header'=>'密码'),
		array('name'=>'time', 'header'=>'最近登录时间'),
		array('name'=>'ip', 'header'=>'登录IP'),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
