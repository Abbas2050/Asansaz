<h2><?=html_encode($title);?></h2>
<ul class="social one-columns">
    <?php foreach ($socialMediaLinks as $icon => $link) { ?>
        <?php if ($link) { ?>
            <li><a href="<?=html_encode($link);?>" target="_blank"><i class="fa <?=html_encode($icon);?>" aria-hidden="true"></i></a></li>
        <?php }
	    else{
		?>
	       <li><a href="#"><i class="fa <?=html_encode($icon);?>" aria-hidden="true"></i></a></li> 
	   <?php
		
		
	     }?>
    <?php } ?>
</ul>
