<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'uid'); ?>
		<?php echo $form->textField($model,'uid',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'权限'); ?>
		<?php echo $form->textField($model,'privilege',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'privilege'); ?>
	</div>

	<!--div class="row">
		<?php //echo $form->labelEx($model,'time'); ?>
		<?php //echo $form->textField($model,'time'); ?>
		<?php //echo $form->error($model,'time'); ?>
	</div-->

	<div class="row">
		<?php echo $form->labelEx($model,'分数'); ?>
		<?php echo $form->textField($model,'score',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'score'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'头像'); ?>
		<?php echo $form->textField($model,'face_id',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'face_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'等级'); ?>
		<?php echo $form->textField($model,'level',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'level'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'昵称'); ?>
		<?php echo $form->textField($model,'nick',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'nick'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'大区'); ?>
		<?php echo $form->textField($model,'area',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'area'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'职业'); ?>
		<?php echo $form->textField($model,'occupation',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'occupation'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->