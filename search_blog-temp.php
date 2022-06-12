<?php
/*
Template Name: Blog Template
*/
?>
<?php get_header(); ?>

<?php
       //pass your search string here example like this ( 's'=>'test' ) 
       $args=array('s'=>'test','order'=> 'DESC', 'posts_per_page'=>get_option('posts_per_page'));
	   
	  $query=new WP_Query($args);
	  
		if( $query->have_posts()): 
		
        while( $query->have_posts()): $query->the_post();
		 
		 {
         echo $post->post_title;
         echo $post->post_content;
         }
		 
		endwhile; 
		else:
		endif;
		
		
		?>
	 
<?php get_footer(); ?>