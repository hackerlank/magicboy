<?php
/* @var $this PropInfoController */
/* @var $model PropInfo */
/* @var $form CActiveForm */
?>
<div class="form">
	<?php if(Yii::app()->user->hasFlash('success')):?>
		<div class="flash-success">
		<p><?php echo Yii::app()->user->getFlash('success')?></p>
		</div>
	<?php elseif(Yii::app()->user->hasFlash('error')):?>
		<div class="flash-error">
		<p><?php echo Yii::app()->user->getFlash('error')?></p>
		</div>
	<?php endif;?>
	
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'prop-info-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'图片'); ?>
		<?php
			if ($model['url']){
				$imgUrl = yii::app()->params['imgurl'].$model['url'];
				echo "<img src='{$imgUrl}' /><br>";
			}	
		?>
		<?php echo $form->fileField($model, 'imgfile')?>
		<?php echo $form->error($model,'imgfile'); ?>
	</div>
	
	<?php if (!$model->isNewRecord):?>
	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>
	<?php endif?>

	<div class="row">
		<?php echo $form->labelEx($model,'score'); ?>
		<?php echo $form->textField($model,'score',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'score'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->