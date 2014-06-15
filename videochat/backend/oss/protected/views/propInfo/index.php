<?php
/* @var $this PropInfoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Prop Infos',
);

$this->menu=array(
	array('label'=>'Create PropInfo', 'url'=>array('create')),
	array('label'=>'Manage PropInfo', 'url'=>array('admin')),
);
?>

<h1>Prop Infos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
