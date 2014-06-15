<?php
/* @var $this ModeratorController */
/* @var $model Moderator */

$this->breadcrumbs=array(
	'主持人管理'=>array('admin'),
	'添加主持人',
);

$this->menu=array(
	array('label'=>'主持人管理', 'url'=>array('admin')),
	array('label'=>'主持人排名更新', 'url'=>array('rank')),
);
?>

<h1>添加主持人</h1>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>