<?php
/* @var $this BlackController */
/* @var $model Black */

$this->breadcrumbs=array(
	'黑名单管理'=>array('admin'),
	'更新黑名单',
);

$this->menu=array(
	array('label'=>'添加黑名单', 'url'=>array('create')),
	array('label'=>'黑名单管理', 'url'=>array('admin')),
);
?>

<h1>更新黑名单</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'type'=>'update')); ?>