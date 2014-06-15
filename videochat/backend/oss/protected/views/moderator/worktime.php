<?php
$this->breadcrumbs=array(
	'主持人管理'=>array('admin'),
	'主持人工时查询',
);

$this->menu=array(
	array('label'=>'主持人管理', 'url'=>array('admin')),
);
?>

<?php if(Yii::app()->user->hasFlash('error')):?>
	<div class="flash-error">
	<p><?php echo Yii::app()->user->getFlash('error')?></p>
	</div>
<?php endif;?>

<style>
.ui-datepicker-trigger {height:18px;width:18px;margin-left:2px;vertical-align:middle}
</style>

<div class="form">
	<form method="post" actoin="/">
		<div class="row">
			<label>主持人名</label>
			<input type="text" value="<?php echo $query['name']?>" name="worktime[name]" />
		</div>
		<div class="row">
			<label>开始时间</label>
			<?php
				$this->widget('zii.widgets.jui.CJuiDatePicker',array(
			        //'attribute'=>'worktime[start]',
			        'language'=>'zh_cn',
			        'name'=>'worktime[start]',
					'value'=>$query['start'],
			        'options'=>array(
			            'showAnim'=>'fold',
			            'showOn'=>'both',
			            'buttonImage'=>Yii::app()->request->baseUrl.'/images/calendar.gif',
			            'buttonImageOnly'=>true,
			            //'minDate'=>'new Date()',
			            'dateFormat'=>'yy-mm-dd',
			        ),
			        'htmlOptions'=>array(
			            'style'=>'height:18px',
			        	'maxlength'=>8,
			        ),
			    ));
			?>
			<!--input type="text" value="<?php echo $query['start']?>" name="worktime[start]" /-->
		</div>

		<div class="row">
			<label>结束时间</label>
			<?php
				$this->widget('zii.widgets.jui.CJuiDatePicker',array(
			        //'attribute'=>'worktime[end]',
			        'language'=>'zh_cn',
			        'name'=>'worktime[end]',
					'value'=>$query['end'] ? $query['end'] : Date('Y-m-d'),
			        'options'=>array(
			            'showAnim'=>'fold',
			            'showOn'=>'both',
			            'buttonImage'=>Yii::app()->request->baseUrl.'/images/calendar.gif',
			            'buttonImageOnly'=>true,
			            'maxDate'=>'new Date()',
			            'dateFormat'=>'yy-mm-dd',
			        ),
			        'htmlOptions'=>array(
			            'style'=>'height:18px',
			        	'maxlength'=>8,
			        ),
			    ));
			?>
		</div>
		<div class="row buttons">
			<input type="submit" value="查询">
		</div>
	</form>
</div>


<?php
	if (!isset($data['dataProvider'])){
		return;
	}

	echo "总计工作时长:<b>{$data['totalTime']}小时<b>";
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'worktime-grid',
		'dataProvider'=>$data['dataProvider'],
		'columns'=>array(
			//array('name'=>'mid', 'header'=>'用户名'),
			array('name'=>'start', 'header'=>'时间'),
			array('name'=>'total', 'header'=>'工作时长(小时)'),
		),
));
?>