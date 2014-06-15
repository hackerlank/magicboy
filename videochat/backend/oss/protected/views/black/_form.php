<?php
/* @var $this BlackController */
/* @var $model Black */
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
	'id'=>'black-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php if($type == 'create'):?>
	<div class="row">
		<?php echo $form->labelEx($model,'用户id-(uid)'); ?>
		<?php echo $form->textField($model,'uid',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'uid'); ?>
	</div>
	<?php elseif($type == 'update'):?>
	<div class="row">
		<?php echo $form->labelEx($model,'用户id-(uid)'); ?>
		<?php echo $model['uid']; ?>
	</div>
	<?php endif?>
	<div class="row">
		<?php 
	    $option = array('30'=>'30分钟','60'=>'60分钟','120'=>'2小时','480'=>'8小时', '-1'=>'永久','0'=>'解除');
	    echo $form->labelEx($model,'发言权限封禁');
	    echo $form->dropDownList($model, 'speak', $option); 
	    echo $form->error($model,'speak');
	    ?>
	</div>
	
	<div class="row">
	    <?php 
	    $option = array('30'=>'30分钟','60'=>'60分钟','120'=>'2小时','480'=>'8小时', '-1'=>'永久','0'=>'解除');
	    echo $form->labelEx($model,'登录权限封禁');
	    echo $form->dropDownList($model, 'login', $option); 
	    echo $form->error($model,'login');
	    ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($type == 'create' ? '创建' : '更新'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->