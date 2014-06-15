<?php
/* @var $this BlackController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Blacks',
);

$this->menu=array(
	array('label'=>'Create Black', 'url'=>array('create')),
	array('label'=>'Manage Black', 'url'=>array('admin')),
);
?>

<h1>Blacks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
