<?php if(Yii::app()->user->hasFlash('success')):?>
	<div class="flash-success">
		<p><?php echo Yii::app()->user->getFlash('success')?></p>
	</div>
<?php elseif(Yii::app()->user->hasFlash('error')):?>
	<div class="flash-error">
		<p><?php echo Yii::app()->user->getFlash('error')?></p>
	</div>
<?php endif;?>