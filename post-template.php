<?php
/*
Template Name: Post Tempalte

*/

?>
 
  <?php get_header(); ?>

  
  <section class="rs_blog">
<div class="rs_container">
      <div class="col-sm-12">
	  <h2>Blog</h2>
	     <!-------rs_blog_text------------->
	  		<div class="col-sm-8" >
			<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args1 = array(
	'posts_per_page'   => -1,
	'offset'           => 0,
	'orderby'          => 'date',
	'order'            => 'DESC',
	'post_type'        => 'post',
	'post_status'      => 'publish',
	'suppress_filters' => true
   	
);
$posts_array1 = get_posts( $args1 );
$count = count($posts_array1);
$tt = $posts_array1->post_count;
$per_page = get_option('posts_per_page');
$total_p = ceil($count/$per_page);

 $args = array(
	'posts_per_page'   => $per_page,
	'offset'           => 0,
	'orderby'          => 'date',
	'order'            => 'DESC',
	'post_type'        => 'post',
	'post_status'      => 'publish',
	'suppress_filters' => true,
	'paged' => $paged,
   	
);
$posts_array = get_posts( $args );

$my_query = null;
$my_query = new WP_Query($args); // Restore global post data stomped by the_post().

if( $my_query->have_posts() ) {
  while ($my_query->have_posts()) : $my_query->the_post();  ?>
<?php $image=wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()),''); ?>

			       <div class="rs_blog_text">
				            <div class="rs_blog_img">
				                   <img src="<?php echo $image[0];?>"/>
				  
				             </div>
			              <h3><?php echo get_the_title(); ?></h3>
			
			
			               <div class="comment_box">
			                 <ul>	
							 <li><span><i class="fa fa-clock-o" aria-hidden="true"></i></span>   <?php echo get_the_date('M'); ?> <?php echo get_the_date('d'); ?>, <?php echo get_the_date('Y'); ?></li>
		                 	<li><span><i class="fa fa-folder-o" aria-hidden="true"></i></span> Hair Loss</li>
			                <li><span><i class="fa fa-comment" aria-hidden="true"></i></span> 0 Comments</li>
			
			              </ul>
			
			             </div>
			             <p><?php echo the_excerpt(); ?></p>
			               <a href="<?php echo the_permalink(); ?>" class="theme-button"> READ MORE</a>
	               </div>
				     <!---<div class="rs_blog_text">
					             <div class="rs_blog_img">
				                     <img src="hairimg.jpg"/>
				  
				                 </div>
					 
					 
			              <h3>Dont Panic If You Losing Your Hair</h3>
			
			
			               <div class="comment_box">
			                 <ul>	
							 <li><span><i class="fa fa-clock-o" aria-hidden="true"></i></span> May 9, 2016</li>
		                 	<li><span><i class="fa fa-folder-o" aria-hidden="true"></i></span> Hair Loss</li>
			                <li><span><i class="fa fa-comment" aria-hidden="true"></i></span> 0 Comments</li>
			
			              </ul>
			
			             </div>
			             <p>Ok, so this might sound easier in theory than it is in practice, but if you’re suffering from hair loss there IS plenty of help out there to reduce, prevent and even replace hair loss. It’s just a case of…     </p>
			               <a href="#" class="theme-button"> READ MORE</a>
	               </div>
				     <div class="rs_blog_text">
					                   <div class="rs_blog_img">
				                           <img src="hairimg.jpg"/>
				  
				                                  </div>
					 
			              <h3>Dont Panic If You Losing Your Hair</h3>
			               <div class="comment_box">
			                 <ul>	
							 <li><span><i class="fa fa-clock-o" aria-hidden="true"></i></span> May 9, 2016</li>
		                 	<li><span><i class="fa fa-folder-o" aria-hidden="true"></i></span> Hair Loss</li>
			                <li><span><i class="fa fa-comment" aria-hidden="true"></i></span> 0 Comments</li>
			
			              </ul>
			
			             </div>
			             <p>Ok, so this might sound easier in theory than it is in practice, but if you’re suffering from hair loss there IS plenty of help out there to reduce, prevent and even replace hair loss. It’s just a case of…     </p>
			               <a href="#" class="theme-button"> READ MORE</a>
	               </div>-->
				   
				  <?php  endwhile;
}
wp_reset_query();   ?> 
				   
				   
				   
				   
	       </div>
		   <!-------rs_blog_text------------->
		    <!---------------Sidebar----------------------->
	  <div class="col-sm-3">
	  <div class=" services_cat">
	  <?php dynamic_sidebar( 'my_category' ); ?>
	  </div>
	  
	  <div class="Archives_date">
	                
	                        <?php dynamic_sidebar( 'my_sidebar' ); ?>
	                                 
	                
	             </div>
	  
	  <div class="newsletter">
	  <h3><strong>Newsletter</strong></h3>
	  <ul>
	      <li><input type="text" class="form-control" placeholder="Name"></li>
		   <li><input type="text" class="form-control" placeholder="Email"></li>
		   <a href="#" class="theme-button Newsletter"> Subscribe</a>
			   
		  	     
	                                 
	  </ul>
	  
	  </div>
	  
	  </div>
	    
	    
	  
	  <!---------------Sidebar----------------------->
	  
	  
	  
	
	  </div>
	<?php if (function_exists("pagination")) {
    pagination($total_p);
} ?>  


	    		
		</div>

</section>
<style>
.theme-button{
color:#fff;
background-color:rgb(45, 181, 238);
.rs_blog_img
.rs_blog_img.rs_blog_img
}
.rs_blog a {
  border-radius: 6px;
  float: left;
  padding: 10px 15px;
  color: #fff;
}
.comment_box ul li {
  color: rgb(119, 119, 119);
  display: inline;
pfvwopfcwork.com/ajax/libs/font-awesome/  margin-right: 20px;
}
.comment_box ul {
  padding-left: 0;
}
.rs_container {                                                                                                            
  margin: 0 auto;
  max-width: 100%;
  width: 1170px;
}
.rs_blog_text {
  border-bottom: 1px solid rgb(241, 241, 241);
  margin-right: 15px;
 
 padding-bottom: 30px;
   float: left;
}
.services_cat > ul {   
  border: 1px solid rgb(241, 241, 241);
  padding-left: 0 !important;
}
.services_cat li {
  border-top: 1px solid rgb(241, 241, 241);
  float: left;
  list-style: none outside none;
  padding: 3px;
  width: 100%;
}
 .services_cat li ul li:hover{
background-color:#f1f1f1;
}
 .Archives_date li ul li:hover{
background-color:#f1f1f1;
}


.Archives_date > ul {
  border: 1px solid rgb(241, 241, 241);
  padding-left: 0 !important;
}

#categories-3 > ul li > a {
  font-size: 18px;
}
.Archives_date li {
  border-top: 1px solid rgb(241, 241, 241);
  list-style: outside none none;
  padding: 10px;
}
.rs_blog_img {
  margin-top: 30px;
  width: 100%;
}
.rs_blog_img img {
  width: 100%;
}
.rs_blog_img {
  overflow: hidden;
  position: relative;
  vertical-align: top;
}
.rs_blog_img img {
  box-shadow: 0 0 0 rgba(0, 0, 0, 0);
  height: auto;
  transition: all 0.25s ease 0s;
}
.rs_blog_img:hover img {
  transform: scale(1.2);
}
#get-quote  {
  float: left;
  width: 100%;
}

.newsletter {
  margin-left: 20px;
  margin-top: 20px;
}
.Archives_date{
  margin-top: 20px;
}

.services_cat {
  float: left;
  margin-top: 20px;
}
.page_nav .pagination a {
  margin-right: 4px;
}
.page_nav {
  margin-left: 30px;
}


</style>

<?php get_footer(); ?>

<!----   add function.php-------------------->
<?php
/*numeric pagination*/
function pagination($pages = '', $range = 4)
{  
     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
     {
 
         echo "<div class=\"page_nav\"><ul class=\"pagination\">";
         //echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<li><a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a></li>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>Last &raquo;</a></li>";
         //echo "</div>\n";
         echo "</ul></div>\n";
     }
}
?>