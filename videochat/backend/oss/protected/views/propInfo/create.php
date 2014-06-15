<?php
/* @var $this PropInfoController */
/* @var $model PropInfo */

$this->breadcrumbs=array(
	'道具管理'=>array('admin'),
	'添加道具',
);

$this->menu=array(
	array('label'=>'道具管理', 'url'=>array('admin')),
);
?>

<h1>添加道具</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>