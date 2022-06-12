<?php
/**
 * Template Name: about_temp
 *
 * @package Total
 */

get_header(); 
 
           
                $args = array(
    				'page_id' => 23
    				);
    			$query = new WP_Query($args);
    			if($query->have_posts()):
    				while($query->have_posts()) : $query->the_post();
    			?>
    			<h2 class="ht-section-title"><?php the_title(); ?></h2>
    			<div class="ht-content">
    				<?php 
					if(has_excerpt()){
						the_excerpt();
					}else{
						the_content(); 
					} ?>
    			</div>
    			<?php
    			endwhile;
    			endif;	
    			wp_reset_postdata();
         
			?>