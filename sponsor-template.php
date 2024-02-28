<div class="client-sport client-sport-nomargin home-pg">
   <div class="content-banner">
		 <ul class="sponsor second">
			<?php 									
				foreach( get_uf_repeater('sponser_image','option') as $sponser_images ): extract( $sponser_images ); 
			?>
				<li><a href="#"><img src="<?php echo $image ?>" alt="" /></a></li>
			<?php 										
				endforeach; 
			?>		  
		</ul>
	</div>
</div>