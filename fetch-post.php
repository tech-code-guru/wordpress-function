<?php
/**
 * Template Name: my-test
*/

get_header(); ?>

<div id="main" class="site-main">

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
		
<?php 

//$sql="SELECT * FROM  `wp_posts` where post_type='post '";
//$result=$wpdb->get_results($sql);
$myquery=array
						(
						'post_type'=>'books',
						'cat'=>'',
						'order'=>'ASC',
						'orderby'=>'',
						'post_status'=>'puplish',
						'posts_per_page'=>'',
						'author'=>'',
						'author_name'=>'admin',
						'tag'=>''
						);
					$result=query_posts($myquery);
					
foreach ($result as $abc)
//echo '<pre>';
//print_r($abc);
//echo '</pre>';


{
	
echo $abc->ID.'<br>';
echo $abc->post_title.'<br>';
echo $abc->post_content;
//echo $abc->post_date;
//echo $abc->post_name;
//echo $abc->post_excerpt;

?>
			<?php $image=wp_get_attachment_image_src(get_post_thumbnail_id($abc->ID),'single-post-thumbnail'); ?>
			
<?php echo $image[0];?>
										
<article id="post-<?php echo $abc->ID; ?>" class="post-<?php echo $abc->ID; ?> post type-post status-publish format-standard has-post-thumbnail hentry category-uncategorized">
	<header class="entry-header">
				<div class="entry-thumbnail">
			<img src="<?php echo $image[0];?>" width="300">
		</div>
		
				<h1 class="entry-title">
			<a href="<?php echo $abc->guid; ?>" rel="bookmark"><?php echo $abc->post_title; ?></a>
		</h1>
		
	
	</header><!-- .entry-header -->

		<div class="entry-content">
		<p><?php echo $abc->post_content; ?></p>
	</div><!-- .entry-content -->
	
	<footer class="entry-meta">
					<div class="comments-link">
				<a href="http://localhost/wordpress/index.php/2015/12/05/this-is-text-2222/#respond"><span class="leave-reply">Leave a comment</span></a>			</div><!-- .comments-link -->
		
			</footer><!-- .entry-meta -->
</article><!-- #post -->
							
<?php }?>
			
			
		
		</div><!-- #content -->
	</div><!-- #primary -->


		</div>

<?php get_footer(); ?>
