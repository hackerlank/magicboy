<?php
/* @var $this UserPropController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Props',
);

$this->menu=array(
	array('label'=>'Create UserProp', 'url'=>array('create')),
	array('label'=>'Manage UserProp', 'url'=>array('admin')),
);
?>

<h1>User Props</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
