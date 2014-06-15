<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'用户管理'=>array('admin'),
	'用户信息更新',
);

$this->menu=array(
	//array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'用户管理', 'url'=>array('admin')),
);
?>

<h1>用户信息更新</h1>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>