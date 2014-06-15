<?php if (!empty($news)):?>
<ul class="list">
<?php
	for ($i=0; $i<$num; $i++){
		$item = $news[$i];
		if ($item['type'] && $item['url'] && $item['title'] && $item['time']){
			$title = Util::htmlencode($item['title']);
			$line = "<li>【{$item['type']}】<a href='{$item['url']}' target='_blank'>{$title}</a>{$item['time']}</li>";
			echo $line;
		}
	}
?>
</ul>
<?php endif?>
