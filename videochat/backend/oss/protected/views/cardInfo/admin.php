<?php
/* @var $this CardInfoController */
/* @var $model CardInfo */

$this->breadcrumbs=array(
	'卡片礼包管理'
);

$this->menu=array(
	//array('label'=>'Create CardInfo', 'url'=>array('create')),
);
?>

<h1>卡片礼包管理</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'card-info-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array('name'=>'name', 'header'=>'卡片名称'),
		//'prop_list',
		//'desc',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
