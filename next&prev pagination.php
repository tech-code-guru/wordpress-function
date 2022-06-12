<?php
/*
Template Name: God-Temp
 */

        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

        $args = array(
            'post_type' => 'product',
            'orderby' => 'title',
            'order' => 'ASC',
            'posts_per_page' => 2,
            'paged' => $paged
        );

        $the_query = new WP_Query($args);
		
if( $the_query->have_posts() ) : 
while( $the_query->have_posts() ) : $the_query->the_post();
 

                        if ( has_post_thumbnail() ) {
                            the_post_thumbnail('', array('class' => 'img-responsive'));
                        }
                 
                     the_title(); 
                     the_content(); 
					 the_permalink(); 
                
     endwhile; 

   
            echo get_next_posts_link( 'Next Page', $the_query->max_num_pages ); 
          echo get_previous_posts_link( 'Previous Page' ); 
   

     wp_reset_postdata();

    else:  
 _e( 'Sorry, no posts matched your criteria.' ); 

    endif; ?>