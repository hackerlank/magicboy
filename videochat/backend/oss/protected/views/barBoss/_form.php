<?php
/* @var $this BarBossController */
/* @var $model BarBoss */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bar-boss-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
	<div class="row">
	<?php if ($model->isNewRecord):?>
		<?php echo $form->labelEx($model,'用户名'); ?>
		<?php echo $form->textField($model,'name',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'name'); ?>
	<?php else:?>
		<?php echo $form->labelEx($model, '用户名'); ?>
		<?php echo $model->name;?>
	<?php endif?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'密码'); ?>
		<?php echo $form->passwordField($model,'passwd',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'passwd'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->