<?php
/* @var $this BlackController */
/* @var $model Black */

$this->breadcrumbs=array(
	'黑名单管理'=>array('admin'),
	'添加黑名单',
);

$this->menu=array(
	array('label'=>'黑名单管理', 'url'=>array('admin')),
);
?>

<h1>添加黑名单</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'type'=>'create')); ?>