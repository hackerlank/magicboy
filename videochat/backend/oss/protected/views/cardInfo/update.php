<?php
/* @var $this CardInfoController */
/* @var $model CardInfo */

$this->breadcrumbs=array(
	'卡片礼包管理'=>array('admin'),
	'卡片礼包更新',
);

$this->menu=array(
	//array('label'=>'Create CardInfo', 'url'=>array('create')),
	array('label'=>'卡片礼包详情', 'url'=>array('view', 'id'=>$data['id'])),
	array('label'=>'卡片礼包管理', 'url'=>array('admin')),
);
?>

<h1>卡片礼包更新</h1>

<?php echo $this->renderPartial('_form', array('data'=>$data)); ?>