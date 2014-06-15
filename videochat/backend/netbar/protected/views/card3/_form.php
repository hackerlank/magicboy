<?php
/* @var $this Card3Controller */
/* @var $model Card3 */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'card3-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'seq'); ?>
		<?php echo $form->textField($model,'seq',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'seq'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'uid'); ?>
		<?php echo $form->textField($model,'uid',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ip'); ?>
		<?php echo $form->textField($model,'ip',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'ip'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prop_time'); ?>
		<?php echo $form->textField($model,'prop_time'); ?>
		<?php echo $form->error($model,'prop_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drink_time'); ?>
		<?php echo $form->textField($model,'drink_time'); ?>
		<?php echo $form->error($model,'drink_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drink_operator_id'); ?>
		<?php echo $form->textField($model,'drink_operator_id',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'drink_operator_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->