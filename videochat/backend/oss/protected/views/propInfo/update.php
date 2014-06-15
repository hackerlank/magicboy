<?php
/* @var $this PropInfoController */
/* @var $model PropInfo */

$this->breadcrumbs=array(
	'道具管理'=>array('admin'),
	'道具信息更新',
);

$this->menu=array(
	array('label'=>'道具管理', 'url'=>array('admin')),
);
?>

<h1>道具信息更新</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>