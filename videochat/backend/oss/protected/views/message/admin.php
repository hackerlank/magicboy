<?php
/* @var $this MessageController */
/* @var $model Message */
$navi = ($model->type == 0)?'普通消息':'系统消息';
$this->breadcrumbs=array(
	'消息管理'=>array('index'),
	$navi
);

$this->menu=array(
	array('label'=>'添加消息', 'url'=>array('create', 'type'=>$model->type)),
	array('label'=>'发布消息', 'url'=>array('distribute', 'type'=>$model->type)),
);
?>

<h1><?php echo $navi?>管理</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'message-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array('name'=>'msg', 'header'=>'消息'),
		array('name'=>'time', 'header'=>'发布时间', 'value'=>'date("Y-m-d H:i:s",$data->time)'),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
