<div class="paihang">
            	<div class="top_tab">
                	排行榜
				</div>
                <a href="#" class="week" id="paihang_tab_user">玩家</a><a href="#" class="day" id="paihang_tab_moderator">主持人</a>
                <ul class="list" id="paihang_user">
                	<?php
                		$num = count($paihang['user']);
                		for ($i=0; $i<$num; $i++){
                			$item = $paihang['user'][$i];
                			$line = "<li><span class='span1'></span><span class='span2'><img src='http://piccache3.soso.com/face/_6693033057987775852' /></span><span class='span3'><a href='#'>{$item['nick']}({$item['uid']})</a></span><span class='span4'>{$item['score']}</span></li>";
                			echo $line;
                		}
                	?>
                </ul>
                <ul class="list" id="paihang_moderator" style="display:none;">
                	<?php
                		$num = count($paihang['moderator']);
                		for ($i=0; $i<$num; $i++){
                			$item = $paihang['moderator'][$i];
                			$line = "<li><span class='span1'></span><span class='span2'><img src='http://piccache3.soso.com/face/_6693033057987775852' /></span><span class='span3'><a href='#'>{$item['nick']}</a></span><span class='span4'>{$item['score']}</span></li>";
                			echo $line;
                		}
                	?>
                </ul>
            </div>
