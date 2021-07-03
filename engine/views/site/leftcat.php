<?php
$this->registerCssFile('../assets/site/css/sidebar-accordion.css',[yii\web\JqueryAsset::className()]);
$this->registerJsFile('https://code.jquery.com/jquery-3.4.1.min.js', ['position' => \yii\web\View::POS_BEGIN]);



?> 

<script>

if (screen.width < 1100) { 
    $(document).ready(function() {
	$('.menu li:has(ul)').click(function(e) {
		e.preventDefault();

		if($(this).hasClass('activado')) {
			$(this).removeClass('activado');
			$(this).children('ul').slideUp();
		} else {
			$('.menu li ul').slideUp();
			$('.menu li').removeClass('activado');
			$(this).addClass('activado');
			$(this).children('ul').slideDown();
		}

		$('.menu li ul li a').click(function() {
			window.location.href = $(this).attr('href');
		})
	});
});
 } 



</script>



<div class="contenedor-menu">
		<!-- <a href="" class="btnMenu">Menu <i class="fa fa-bars"></i></a> -->
<?php $categoriesCount = count($categories);
      $colors = array('green', 'blue', 'red', 'yellow','purple','cyan'); 
	  $i=0;
	  foreach ($categories as $key => $cat) 
		{ 
	      $childCats = [];
          $catArray = [];
	
	       if (!empty($cat->children)) 
		   {
				$childCats[$cat->category_id]               = $cat->children;
				$catArray[$cat->category_id]['name']        = $cat->name;
				$catArray[$cat->category_id]['slug']        = $cat->slug;
           } 
	
			
			
	?>
	
	
		<ul class="menu" style="padding: 0px">
			<li><a href="<?= empty($cat->children) ? url(['category/index', 'slug' => $cat->slug]) : '#'; ?>"><i class="cat-fa-design fa <?= html_encode($cat->icon); ?> <?=$colors[$i++]?>" aria-hidden="true" style="float: left"></i><span style="left: 0.6rem;position: relative;top: 0.7rem;"><?= html_encode($cat->name); ?></span><?php if (!empty($childCats)) {?><!---<i class="fa fa-chevron-down"></i>--><?php }?></a>
				<br/>
			  <?php 
			  if (!empty($childCats))
			  {
				$j=1;
			   foreach ($childCats as $parentId => $cats) 
	           { 
				 foreach ($cats as $childKey => $childCat) 
				 {
					 
				  if($j<3)
				  {
				?>	
				<ul style="padding: 0px;width: 100%!important;font-weight: normal;" id="sub-categories">
					<li><a style="padding-left:1rem" href="<?= url(['category/index', 'slug' => $childCat->slug]) ?>"> <span><?= html_encode($childCat->name); ?></span></a></li>
				</ul>
			    <?php
				  }
				  else
				  {
				?>
				<ul style="padding: 0px;width: 100%!important;font-weight: normal;display:none" id="sub-categories" class="<?=$i?>">
					<li><a style="padding-left:1rem" href="<?= url(['category/index', 'slug' => $childCat->slug]) ?>"> <span><?= html_encode($childCat->name); ?></span></a></li>
				</ul>
				<?php 
				  }
			    ?>
			  <?php
					  $j++;
				 }
			   } 
				 
			  }
		     
				?>	
				<button class="text-center showBtn line" id="myBtn<?=$i?>" title="all" data-id="<?=$i?>" style="display: none;background-color: transparent;border: none;font-size: 1.4rem;text-align: center;padding: 0 11px;letter-spacing: 0px;color:#000;outline: none">SHOW ALL</button>
			</li>
			<hr style="border-color: #000;display: none" class="line"/> 
		</ul>
 <?php } ?>	
</div>
<script>
	$('.showBtn').on('click', function() {
		
		
      var title = this.title;
	  var id = $(this).attr("data-id");
		
		
      if(title == "all")
	  {
		  $("."+id).css("display","block");
		  this.title = "less";
		  $("#myBtn"+id).html("SHOW LESS");
	  }
	  else if(title == "less")
	  {   
		  $("."+id).css("display","none");
		  this.title = "all";
		  $("#myBtn"+id).html("SHOW ALL");
			  
	  }
    });
	
 

</script>

