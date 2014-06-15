<?php
/* @var $this BarBossController */
/* @var $model BarBoss */

$this->breadcrumbs=array(
	'网吧老板管理'=>array('admin'),
	'添加老板',
);

$this->menu=array(
	array('label'=>'网吧老板管理', 'url'=>array('admin')),
);
?>

<h1>添加老板</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>