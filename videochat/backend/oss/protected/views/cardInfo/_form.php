<?php
/* @var $this CardInfoController */
/* @var $model CardInfo */
/* @var $form CActiveForm */
?>
<style>
.row span {display:inline-block;width:100px;text-align:right;}
</style>
<div class="form">
	<form method="post">
		<div class="row">
			<label>卡名称</label>
			<input type="text" name="CardInfo[name]" value="<?php echo $data['name']?>">
		</div>
		<div class="row">
			<label>道具列表：</label>
		</div>
		<div id="prop_container">
		<?php foreach ($data['prop_list'] as $item):?>
		<div class="row">
			<span><?php echo $item['name'];?></span>
			<input id="<?php echo $item['id'];?>" type="text" value="<?php echo $item['num'];?>">
		</div>
		<?php endforeach?>
		</div>
		<div class="row">
			<input type="hidden" name="CardInfo[prop_list]" id="prop_list" value="">
		</div>
		<div class="row">
			<input type="submit" value="更新">
		</div>
	</form>
</div>

<?php
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/cardInfo/_form.js', CClientScript::POS_END);
?>



