<?php
/* @var $this Card3Controller */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Card3s',
);

$this->menu=array(
	array('label'=>'Create Card3', 'url'=>array('create')),
	array('label'=>'Manage Card3', 'url'=>array('admin')),
);
?>

<h1>Card3s</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
