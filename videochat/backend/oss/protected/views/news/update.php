<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	'新闻公告管理'=>array('admin'),
	'更新新闻',
);

$this->menu=array(
	array('label'=>'添加新闻', 'url'=>array('create')),
	array('label'=>'新闻公告管理', 'url'=>array('admin')),
);
?>

<h1>更新新闻公告</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>