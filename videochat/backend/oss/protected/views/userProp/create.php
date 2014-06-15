<?php
/* @var $this UserPropController */
/* @var $model UserProp */

$this->breadcrumbs=array(
	'User Props'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserProp', 'url'=>array('index')),
	array('label'=>'Manage UserProp', 'url'=>array('admin')),
);
?>

<h1>Create UserProp</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>