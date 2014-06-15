<?php
/* @var $this BarBossController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Bar Bosses',
);

$this->menu=array(
	array('label'=>'Create BarBoss', 'url'=>array('create')),
	array('label'=>'Manage BarBoss', 'url'=>array('admin')),
);
?>

<h1>Bar Bosses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
