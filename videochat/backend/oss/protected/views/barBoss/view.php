<?php
/* @var $this BarBossController */
/* @var $model BarBoss */

$this->breadcrumbs=array(
	'网吧老板管理'=>array('admin'),
	'详情'
);

$this->menu=array(
	array('label'=>'网吧老板管理', 'url'=>array('admin')),
);
?>

<h1>详情信息</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array('label'=>'id','value'=>CHtml::encode($model->id)),
		array('label'=>'用户名','value'=>CHtml::encode($model->name)),
		array('label'=>'密码','value'=>CHtml::encode($model->passwd)),
		array('label'=>'发放饮料数','value'=>$model->issueNum),
		array('label'=>'最后登录时间','value'=>$model->time),
		array('label'=>'登录ip','value'=>$model->ip),
	),
)); ?>
