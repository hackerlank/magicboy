<?php
/* @var $this ModeratorController */
/* @var $model Moderator */

$this->breadcrumbs=array(
	'用户管理'=>array('admin'),
	'用户排名更新',
);

$this->menu=array(
	array('label'=>'用户管理', 'url'=>array('admin')),
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
		array('name'=>'uid', 'header'=>'uid'),
		array('name'=>'nick', 'header'=>'昵称'),
		array('name'=>'score', 'header'=>'分数'),
		array('name'=>'face_id', 'header'=>'头像'),
		array('name'=>'level', 'header'=>'等级'),
		array('name'=>'area', 'header'=>'大区'),
		array('name'=>'privilege', 'header'=>'权限'),
		/*
		array(
			'class'=>'CButtonColumn',
		),*/
	),
));
?>