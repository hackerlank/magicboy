<?php
$this->breadcrumbs=array(
	'道具管理'=>array('admin'),
	'道具信息发布',
);

$this->menu=array(
	array('label'=>'道具管理', 'url'=>array('admin')),
);
?>

<?php 
	$class = ($res == true) ? 'flash-success' : 'flash-error';
	$tips = ($res == true) ? '发布成功':'发布失败';
?>
<div class="<?php echo $class?>">
	<?php echo CHtml::tag('p', array(), $tips);?>
</div>

<?php 
	$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'moderator-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		'id',
		'name',
		'url',
		'score',
	),
));
?>