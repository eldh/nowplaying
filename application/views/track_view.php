<div id="trackinfo" class="clearfix">
	<div id='image-wrapper'>
		<div id='image-content'>
			<div class='face front clearfix'>
				<img src="<?= $songdata['trackinfo']['image']; ?>" />
			</div>
			<div class='face back clearfix'>
				<div class='text'>
					<h1><a href="<?= $songdata['trackinfo']['url']?>"><?= $songdata['trackinfo']['title']?></a></h1>
					<div class="part"></div>
						<span class="extratext">Duration</span>
						<h3 class="subtitle">
							<?= $songdata['trackinfo']['duration']['mins']." minutes ".$songdata['trackinfo']['duration']['secs']." seconds"?>
						</h3>
					</div>
					<div class="part">
						<span class="extratext">Album</span>
						<h3 class="subtitle">
							<?php if ($songdata['trackinfo']['albumurl'] != null){ ?>
								<a href="<?= $songdata['trackinfo']['albumurl']?>"><?= $songdata['trackinfo']['album']?></a>
							<?php } else {?>
								<?= $songdata['trackinfo']['album']?>
							<?php }?>
						</h3>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="info">
		<div class="content">
			<div class="title-text">
				<h2><a href="<?= $songdata['trackinfo']['url']?>"><?= $songdata['trackinfo']['title']?></a></h2>
				<span class="extratext">by</span>
				<h1 id="title"><a href="<?= $songdata['artistinfo']['url']?>"><?= $songdata['artistinfo']['name']?></a></h1>
			</div>
		</div>
	</div>
	<div class="social">
	<div class="fb">
	</div>
	<div class="twitter"></div>
	</div>
	<div class="links">
    	<div class="content clearfix">
    		<div class="section">
    			<h3>Listen</h3>
    			<ul>
    				<li><a href="<?= $songdata['spotifyinfo']['url'] ?>">Spotify</a></li>
    			</ul>
    		</div>
 <!--
   		<div class="section">
    			<h3>Share</h3>
    			<ul>
    				<li><a href="http://twitter.com/share?text=<?= $title.': '. $songdata['artistinfo']['name'].' - '. $songdata['trackinfo']['title']?>&url=<?= $url ?>&via=eldh">Twitter</a></li>				
    				<li><a href="javascript: window.open('http://www.facebook.com/sharer.php?u=http://www.digitalmagi.se/nowplaying#/John Grant/TC and honeybear&t=<?= $title.': '. $songdata['artistinfo']['name'].' - '. $songdata['trackinfo']['title']?>','Share on facebook','menubar=0,resizable=0,location=0,directories=0,toolbar=0,status=0,width=600,height=250')">Facebook</a></li>
    			</ul>
    		</div>
-->
    		<?php if (array_key_exists('similar', $songdata['artistinfo'])){ ?>
    			<div class="section similar">
    				<h3>Similar</h3>
    				<ul>
    					<?php for ($i = 0; $i < 3; $i++) { ?>
    						<li><a href="<?php echo $songdata['artistinfo']['similar'][$i]['url']; ?>"><?php echo $songdata['artistinfo']['similar'][$i]['name']; ?></a></li>
    					<?php } ?>
    				</ul>
    			</div>
    		<?php } if (array_key_exists('tags', $songdata['artistinfo'])){ ?>
    			<div class="section tags">
    				<h3>Tags</h3>
    				<ul>
    					<?php for ($i = 0; $i < 3; $i++) { ?>
    					<li><a href="<?= $songdata['artistinfo']['tags'][$i]['url']; ?>"><?= $songdata['artistinfo']['tags'][$i]['name']; ?></a></li>
    					<?php } ?>
    				</ul>
    			</div>
    		<?php }?>
    	</div>
    </div>
</div>