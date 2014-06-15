<?php
$this->pageTitle=Yii::app()->name . ' - 饮料领取';
$this->breadcrumbs=array(
	'饮料领取',
);
?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm'); ?>
 
    <?php echo $form->errorSummary($model); ?>
   
	<?php if(Yii::app()->user->hasFlash('success')):?>
		<div class="flash-success">
		<p><?php echo Yii::app()->user->getFlash('success')?></p>
		</div>
	<?php endif;?>
	
    <div class="row">
        <?php echo $form->label($model, '请输入卡号:'); ?>
        <?php echo $form->textField($model,'cardnum') ?>
    </div>

    <div class="row submit">
        <?php echo CHtml::submitButton('领取'); ?>
    </div>
 
<?php $this->endWidget(); ?>
</div><!-- form -->