<?php
/* @var $this PropInfoController */
/* @var $model PropInfo */

$this->breadcrumbs=array(
	'道具管理'
);

$this->menu=array(
	array('label'=>'添加道具', 'url'=>array('create')),
	array('label'=>'道具信息发布', 'url'=>array('distribute')),
);
?>

<h1>道具管理</h1>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'prop-info-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		array('name'=>'url', 
			  'value'=>'CHtml::image(yii::app()->params["imgurl"].$data->url,"",array("width"=>60,"height"=>60))',
			  'type'=>'raw', 
			  'htmlOptions'=>array('width'=>'60','style'=>'text-align:center'),
			  'header'=>'图片'),
		//'url',
		'score',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
