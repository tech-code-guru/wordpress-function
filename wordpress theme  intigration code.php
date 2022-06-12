<a href="<?php echo get_option('home'); ?>" title="<?php bloginfo('description'); ?>"><?php bloginfo('name'); ?></a><!--this script show site name and title-->
<?php wp_list_pages('sort_order=desc&title_li='); ?><!--this script sample page call-->


<?php _e('Categories'); ?><!--Categories-->
<?php wp_list_cats('sort_column=name&optioncount=1&hierarchical=0'); ?><!-- Show Categories name-->


<?php _e('Archives'); ?><!--Archives-->
<?php wp_get_archives('type=monthly'); ?><!--Archives month and year-->

<h1>new code</h1>

<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
  <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="post-header">
        <div class="date"><?php the_time( 'M j y' ); ?></div>
        <h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
        <div class="author"><?php the_author(); ?></div>
    </div><!--end post header-->
    <div class="entry clear">
        <?php if ( function_exists( 'add_theme_support' ) ) the_post_thumbnail(); ?>
        <?php the_content(); ?>
        <?php edit_post_link(); ?>
        <?php wp_link_pages(); ?>
    </div><!--end entry-->
    <div class="post-footer">
        <div class="comments"><?php comments_popup_link( 'Leave a Comment', '1 Comment', '% Comments' ); ?></div>
    </div><!--end post footer-->
  </div><!--end post-->
<?php endwhile; /* rewind or continue if all posts have been fetched */ ?>
  <div class="navigation index">
    <div class="alignleft"><?php next_posts_link( 'Older Entries' ); ?></div>
    <div class="alignright"><?php previous_posts_link( 'Newer Entries' ); ?></div>
  </div><!--end navigation-->
<?php else : ?>
<?php endif; ?>


        
            