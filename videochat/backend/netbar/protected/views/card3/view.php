<?php
/* @var $this Card3Controller */
/* @var $model Card3 */

$this->breadcrumbs=array(
	'Card3s'=>array('index'),
	$model->seq,
);

$this->menu=array(
	array('label'=>'List Card3', 'url'=>array('index')),
	array('label'=>'Create Card3', 'url'=>array('create')),
	array('label'=>'Update Card3', 'url'=>array('update', 'id'=>$model->seq)),
	array('label'=>'Delete Card3', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->seq),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Card3', 'url'=>array('admin')),
);
?>

<h1>View Card3 #<?php echo $model->seq; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'seq',
		'uid',
		'ip',
		'prop_time',
		'drink_time',
		'drink_operator_id',
	),
)); ?>
