<?php
/* @var $this MessageController */
/* @var $model Message */
$navi = ($model->type == 0)?'普通消息':'系统消息';
$this->breadcrumbs=array(
	'消息管理'=>array('index'),
	"$navi"=>array('admin', 'Message[type]'=>$model->type),
	'消息详情'
);

$this->menu=array(
	array('label'=>"添加{$navi}", 'url'=>array('create', 'type'=>$model->type)),
	array('label'=>"更新{$navi}", 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'消息管理', 'url'=>array('index')),
);
?>

<h1><?php echo $navi?>详情</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array('name'=>'消息', 'value'=>CHtml::encode($model->msg)),
		array('name'=>'消息类型', 'value'=>$navi),
		array('name'=>'添加时间', 'value'=>date('Y-m-d H:i:s', $model->time)),
	),
)); ?>
