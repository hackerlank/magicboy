<?php
/* @var $this ModeratorController */
/* @var $model Moderator */

$this->breadcrumbs=array(
	'主持人管理'=>array('admin'),
	'更新',
);

$this->menu=array(
	array('label'=>'添加主持人', 'url'=>array('create')),
	array('label'=>'主持人管理', 'url'=>array('admin')),
	array('label'=>'主持人排名更新', 'url'=>array('rank')),
	array('label'=>'主持人工时查询', 'url'=>array('worktime')),
);
?>

<h1>更新主持人信息</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>