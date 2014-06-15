<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	'新闻公告管理'=>array('admin'),
	'添加新闻',
);

$this->menu=array(
	array('label'=>'新闻公告管理', 'url'=>array('admin')),
);
?>

<h1>添加新闻</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>