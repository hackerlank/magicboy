<?php
/* @var $this ModeratorController */
/* @var $model Moderator */

$this->breadcrumbs=array(
	'主持人管理'=>array('admin'),
	'主持人排名更新',
);

$this->menu=array(
	array('label'=>'主持人管理', 'url'=>array('admin')),
);
?>

<?php 
	$class = $res ? 'flash-success' : 'flash-error';
	$tips = $res ? '更新成功':'更新失败';
?>
<div class="<?php echo $class?>">
	<?php echo CHtml::tag('p', array(), $tips);?>
</div>
<?php 
	echo CHtml::tag('b', array(), '目前排名');
	$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'moderator-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array('name'=>'name', 'header'=>'用户名'),
		array('name'=>'nick', 'header'=>'昵称'),
		array('name'=>'score', 'header'=>'分数'),
		array('name'=>'url', 'header'=>'头像地址'),
		/*
		array(
			'class'=>'CButtonColumn',
		),*/
	),
));
?>