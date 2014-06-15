<?php
/* @var $this Card3Controller */
/* @var $model Card3 */

$this->breadcrumbs=array(
	'Card3s'=>array('index'),
	$model->seq=>array('view','id'=>$model->seq),
	'Update',
);

$this->menu=array(
	array('label'=>'List Card3', 'url'=>array('index')),
	array('label'=>'Create Card3', 'url'=>array('create')),
	array('label'=>'View Card3', 'url'=>array('view', 'id'=>$model->seq)),
	array('label'=>'Manage Card3', 'url'=>array('admin')),
);
?>

<h1>Update Card3 <?php echo $model->seq; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>