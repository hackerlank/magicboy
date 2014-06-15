<?php
/* @var $this ModeratorController */
/* @var $model Moderator */
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
	'id'=>'moderator-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>
	
	<?php echo $form->errorSummary($model); ?>
	
	<?php if ($model->isNewRecord):?>
	<div class="row">
		<?php echo $form->labelEx($model,'用户名(登录时用)'); ?>
		<?php echo $form->textField($model,'name',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'nick'); ?>
	</div>
	<?php else:?>
	<div class="row">
		<?php echo $form->labelEx($model,'用户名(登录时用)'); ?>
		<?php echo $model['name'];?>
	</div>
	<?php endif?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'昵称(聊天室里显示)'); ?>
		<?php echo $form->textField($model,'nick',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'nick'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'密码'); ?>
		<?php echo $form->textField($model,'passwd',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'passwd'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'头像'); ?>
		<?php 
			if ($model['url']){
				$imgUrl = yii::app()->params['imgurl'].$model['url'];
				echo "<img src='{$imgUrl}' /><br>";
			}
		?>
		<?php echo $form->fileField($model, 'imgfile')?>
		<?php echo $form->error($model,'imgfile'); ?>
	</div>
	
	<?php if(!$model->isNewRecord):?>
	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>64,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>
	<?php endif?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'分数'); ?>
		<?php echo $form->textField($model,'score',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'score'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->