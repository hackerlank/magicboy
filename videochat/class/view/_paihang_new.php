<div class="title"><span>玩家排行榜</span></div>
            <ul class="list">
            	<?php
                	$num = count($paihang['user']);
                	for ($i=0; $i<$num; $i++){
                		$seq = $i+1;
                		$item = $paihang['user'][$i];
                		$item['nick'] = Util::htmlencode($item['nick']);
                		$line = "<li><span class='span1'>{$seq}</span><span class='span2'>{$item['nick']}({$item['uid']})</span><span class='span3'></span><span class='span4'>{$item['score']}</span></li>";
                		echo $line;
                	}
                ?>
            </ul>
            <div class="title"><span>主持人排行榜</span></div>
            <ul class="list">
            	<?php
                	$num = count($paihang['moderator']);
                	for ($i=0; $i<$num; $i++){
                		$seq = $i+1;
                		$item = $paihang['moderator'][$i];
                		$item['nick'] = Util::htmlencode($item['nick']);
                		$line = "<li><span class='span1'>{$seq}</span><span class='span2'>{$item['nick']}</span><span class='span3'></span><span class='span4'>{$item['score']}</span></li>";
                		echo $line;
                	}
                ?>
            </ul>
