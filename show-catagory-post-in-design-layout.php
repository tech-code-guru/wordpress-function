<?php
/**
 * Template Name: Post Temp
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>
<?php
query_posts('cat=1');
while (have_posts()) : the_post();
{
?>



<div id="main" class="site-main">

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
		
										<article id="post-<?php the_ID(); ?>" class="post-7 post type-post status-publish format-standard has-post-thumbnail hentry category-uncategorized">
	<header class="entry-header">
				<div class="entry-thumbnail">
		 <?php the_post_thumbnail();  ?>
		
				<h1 class="entry-title">
			<a href="http://localhost/wordpress/index.php/2015/12/05/this-is-text-2222/" rel="bookmark"><?php the_title(); ?></a>
		</h1>
		
		<div class="entry-meta">
<?php twentythirteen_entry_meta(); ?>
			<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>			</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

		<div class="entry-content">
		<p><?php the_excerpt(); ?></p>
	</div><!-- .entry-content -->
	
	<footer class="entry-meta">
					<div class="comments-link">
				<a href="http://localhost/wordpress/index.php/2015/12/05/this-is-text-2222/#respond"><span class="leave-reply">Leave a comment</span></a>			</div><!-- .comments-link -->
		
			</footer><!-- .entry-meta -->
</article><!-- #post -->
							
						
			
			
		
		</div><!-- #content -->
	</div><!-- #primary -->


		</div>
	<?php }	endwhile;
?>
