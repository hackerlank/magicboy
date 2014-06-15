<?php
/* @var $this MessageController */
/* @var $model Message */
$navi = ($model->type == 0)?'普通消息':'系统消息';
$this->breadcrumbs=array(
	'消息管理'=>array('index'),
	"{$navi}管理"=>array('admin', 'Message[type]'=>$model->type),
	"更新{$navi}",
);
/*
$this->menu=array(
	array('label'=>'消息管理', 'url'=>array('admin')),
);*/
?>

<h1><?php echo $navi;?>更新</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>