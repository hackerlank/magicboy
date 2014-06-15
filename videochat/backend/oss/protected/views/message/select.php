<?php
$this->breadcrumbs=array(
	'消息管理',
);
?>

<style>
#content a{text-decoration:none;font-size:16px;}
</style>

<?php echo CHtml::link('普通消息管理', $this->createUrl('admin', array('Message[type]'=>'0')));?>
<br><br>
<?php echo CHtml::link('系统消息管理', $this->createUrl('admin', array('Message[type]'=>'1')));?>
