<style>
    .sidebarlink  {
        font-weight:600;
    }

.sidebarlinkmain  {
        font-weight:900;
        font-size:15px;
    }


</style>
<?php $categoriesCount = count($categories);
      $colors = array('green', 'blue', 'red', 'yellow','purple','cyan'); 
	  $i=0;
      $catClass = 5;	   
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
	
	
		    <li class="category-<?=$catClass++;?>">
			<a href="<?= empty($cat->children) ? url(['category/index', 'slug' => $cat->slug]) :  'index.php/category/' . $cat->slug ; ?>"  class='sidebarlinkmain'>
			    <font style="vertical-align: inherit;">
					<font style="vertical-align: inherit;"> 	
				        <?= html_encode($cat->name); ?>
					</font>
				</font>	
			</a>	
			<?php if (!empty($childCats)) {?><!---<i class="fa fa-chevron-down"></i>--><?php }?></a>
				
			  <?php 
			  if (!empty($childCats))
			  {
				$j=1;
			   foreach ($childCats as $parentId => $cats) 
	           { 
				 foreach ($cats as $childKey => $childCat) 
				 {
					 
				  if($j<5)
				  {
				?>	
				<ul>
				  <li class=""> 
					<a href="<?= url(['category/index', 'slug' => $childCat->slug]) ?>" class='sidebarlink' title="<?= html_encode($childCat->name); ?>"> 
						<font style="vertical-align: inherit;">
							<font style="vertical-align: inherit;"> 
								<?= html_encode($childCat->name); ?> 
							</font>
										
						</font>
					  </a>
				  </li>
				</ul>
			    <?php
				  }
				  else
				  {
				?>
                <ul class="<?=$i?>" style="display:none">
				  <li class=""> 
						<a href="<?= url(['category/index', 'slug' => $childCat->slug]) ?>" title="<?= html_encode($childCat->name); ?>">
							<?= html_encode($childCat->name); ?>
					   </a>
				  </li>
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
				
			</li>
			
		
 <?php } ?>	



