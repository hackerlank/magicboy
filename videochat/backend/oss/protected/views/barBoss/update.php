<?php
/* @var $this BarBossController */
/* @var $model BarBoss */

$this->breadcrumbs=array(
	'网吧老板管理'=>array('admin'),
	'老板信息更新',
);

$this->menu=array(
	array('label'=>'网吧老板管理', 'url'=>array('admin')),
);
?>

<h1>老板信息更新</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>