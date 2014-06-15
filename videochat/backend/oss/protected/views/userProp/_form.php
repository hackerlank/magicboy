<?php
/* @var $this UserPropController */
/* @var $model UserProp */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-prop-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'uid'); ?>
		<?php echo $form->textField($model,'uid',array('size'=>60,'maxlength'=>64, 'readonly'=>"readonly")); ?>
		<?php echo $form->error($model,'uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, '道具名称'); ?>
		<?php echo $form->hiddenField($model,'prop_id',array('size'=>4,'maxlength'=>4)); ?>
		<input type="text" value='<?php echo PropInfo::getNameFromId($model->prop_id)?>' readonly="readonly" maxlength="64" size="60">
		<?php echo $form->error($model,'prop_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'数量'); ?>
		<?php echo $form->textField($model,'num',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'num'); ?>
	</div>

	<!--div class="row">
		<?php echo $form->labelEx($model,'time'); ?>
		<?php echo $form->textField($model,'time'); ?>
		<?php echo $form->error($model,'time'); ?>
	</div-->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->