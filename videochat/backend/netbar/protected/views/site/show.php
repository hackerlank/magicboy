<?php
$this->breadcrumbs=array(
	'我发出的饮料',
);
?>
<h1>我发出的饮料</h1>
<p>共发放<?php echo $num;?>瓶饮料</p>
<?php 
	$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'moderator-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array('name'=>'seq', 'header'=>'卡号'),
		array('name'=>'drink_time', 'header'=>'发放时间'),
	),
)); ?>
