<?php
/* @var $this ModeratorController */
/* @var $model Moderator */

$this->breadcrumbs=array(
	'Moderators'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Moderator', 'url'=>array('index')),
	array('label'=>'Create Moderator', 'url'=>array('create')),
	array('label'=>'Update Moderator', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Moderator', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Moderator', 'url'=>array('admin')),
);
?>

<h1>View Moderator #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'passwd',
		'score',
		'time',
		'ip',
		'id',
	),
)); ?>
