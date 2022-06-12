  <?php
$autor_id = $post->post_author;
 ?>
 <?php echo get_the_date('M'); ?> <?php echo get_the_date('d'); ?>, <?php echo get_the_date('Y'); ?> — by <a><?php the_author_meta('user_nicename',$autor_id); ?>