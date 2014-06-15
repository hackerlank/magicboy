<?php
/* @var $this Card3Controller */
/* @var $model Card3 */

$this->breadcrumbs=array(
	'Card3s'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Card3', 'url'=>array('index')),
	array('label'=>'Manage Card3', 'url'=>array('admin')),
);
?>

<h1>Create Card3</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>