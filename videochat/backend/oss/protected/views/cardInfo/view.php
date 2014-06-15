<style>
table.detail-view .null {color: pink;}
table.detail-view {background: white;border-collapse: collapse;width: 100%;margin: 0;}
table.detail-view th, table.detail-view td{font-size: 0.9em;border: 1px white solid;padding: 0.3em 0.6em;vertical-align: top;}
table.detail-view th {text-align: right;	width: 160px;}
table.detail-view tr.odd {background:#E5F1F4;}
table.detail-view tr.even {background:#F8F8F8;}
</style>

<?php
/* @var $this CardInfoController */
/* @var $model CardInfo */

$this->breadcrumbs=array(
	'卡片礼包管理'=>array('admin'),
	'卡片礼包详情'
);

$this->menu=array(
	array('label'=>'卡片礼包管理', 'url'=>array('admin')),
);
?>

<h1>卡片礼包详情</h1>

<table id="yw0" class="detail-view">
<tbody>
<tr class="odd">
	<th>id</th><td><?php echo $model->id;?></td>
</tr>
<tr class="even">
	<th>卡片名</th>
	<td><?php echo CHtml::encode($model->name);?></td>
</tr>
<tr class="odd">
	<th>道具列表</th>
	<td>数量</td>
</tr>
<?php foreach ($model->prop_list as $item):?>
<tr class="odd">
	<th></th>
	<td><?php echo CHtml::encode("{$item['name']}  {$item['num']}")?></td>
</tr>
<?php endforeach?>
<tr class="even">
	<th>使用情况</th>
	<td>
	<?php
		if ($model->id == 2){
			echo "道具领取:<b>$used</b>";
		}
		else if ($model->id == 3){
			echo "道具领取:<b>{$used['prop']}</b>&nbsp;&nbsp;饮料领取:<b>{$used['drink']}</b>";
		}
	?>
	</td>
</tr>
<!--tr class="even">
	<th>描述</th>
	<td><?php echo CHtml::encode($model->desc);?></td>
</tr-->
</tbody></table>
