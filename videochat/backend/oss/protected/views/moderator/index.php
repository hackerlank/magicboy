<?php
/* @var $this ModeratorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Moderators',
);

$this->menu=array(
	array('label'=>'Create Moderator', 'url'=>array('create')),
	array('label'=>'Manage Moderator', 'url'=>array('admin')),
);
?>

<h1>Moderators</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
