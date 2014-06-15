<?php
/* @var $this MessageController */
/* @var $model Message */
$navi = ($_GET['type'] == 0)?'普通消息':'系统消息';
$this->breadcrumbs=array(
	'消息管理'=>array('index'),
	"{$navi}管理"=>array('admin', 'Message[type]'=>$_GET['type']),
	"添加{$navi}",
);

$this->menu=array(
	array('label'=>'消息管理', 'url'=>array('index')),
);
?>

<h1>添加<?php echo $navi?></h1>
<?php
$model->type = $_GET['type'];
echo $this->renderPartial('_form', array('model'=>$model));
?>