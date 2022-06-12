<?php

/*******************************
 MENUS SUPPORT
********************************/
if ( function_exists( 'wp_nav_menu' ) ){
	if (function_exists('add_theme_support')) {
		add_theme_support('nav-menus');
		add_action( 'init', 'register_my_menus' );
		function register_my_menus() {
			register_nav_menus(
				array(
					'main-menu' => __( 'Main Menu' )
				)
			);
			register_nav_menus(
				array(
					'footer-menu' => __( 'Footer Menu' )
				)
			);
		}
	}
}

/* CallBack functions for menus in case of earlier than 3.0 Wordpress version or if no menu is set yet*/

function primarymenu(){ ?>
			<div id="mainMenu" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<?php wp_list_pages('title_li='); ?>
					<?php //wp_list_categories('hide_empty=1&exclude=1&title_li='); ?>
				</ul>
			</div>
<?php }

/*******************************
 THUMBNAIL SUPPORT
********************************/

add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 300, 200, true );

/* Get the thumb original image full url */

function get_thumb_urlfull ($postID) {
$image_id = get_post_thumbnail_id($post);  
$image_url = wp_get_attachment_image_src($image_id,'large');  
$image_url = $image_url[0]; 
return $image_url;
}

/*******************************
 EXCERPT LENGTH ADJUST
********************************/

function home_excerpt_length($length) {
	return 30;
}
add_filter('excerpt_length', 'home_excerpt_length');


/*******************************
 WIDGETS AREAS
********************************/

if ( function_exists('register_sidebar') )
register_sidebar(array(
	'name' => 'sidebar',
	'before_widget' => '<div class="rightBox">',
	'after_widget' => '</div>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
));

register_sidebar(array(
	'name' => 'footer col 1',
	'before_widget' => '<div class="footer-col">',
	'after_widget' => '</div>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
));
register_sidebar(array(
	'name' => 'footer col 2',
	'before_widget' => '<div class="footer-col">',
	'after_widget' => '</div>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
));
register_sidebar(array(
	'name' => 'footer col 3',
	'before_widget' => '<div class="footer-col">',
	'after_widget' => '</div>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
));
register_sidebar(array(
	'name' => 'footer col 4',
	'before_widget' => '<div class="footer-col">',
	'after_widget' => '</div>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
));
register_sidebar(array(
	'name' => 'footer',
	'before_widget' => '<div class="boxFooter">',
	'after_widget' => '</div>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
));
	
/*******************************
 PAGINATION
********************************
 * Retrieve or display pagination code.
 *
 * The defaults for overwriting are:
 * 'page' - Default is null (int). The current page. This function will
 *      automatically determine the value.
 * 'pages' - Default is null (int). The total number of pages. This function will
 *      automatically determine the value.
 * 'range' - Default is 3 (int). The number of page links to show before and after
 *      the current page.
 * 'gap' - Default is 3 (int). The minimum number of pages before a gap is 
 *      replaced with ellipses (...).
 * 'anchor' - Default is 1 (int). The number of links to always show at begining
 *      and end of pagination
 * 'before' - Default is '<div class="emm-paginate">' (string). The html or text 
 *      to add before the pagination links.
 * 'after' - Default is '</div>' (string). The html or text to add after the
 *      pagination links.
 * 'title' - Default is '__('Pages:')' (string). The text to display before the
 *      pagination links.
 * 'next_page' - Default is '__('&raquo;')' (string). The text to use for the 
 *      next page link.
 * 'previous_page' - Default is '__('&laquo')' (string). The text to use for the 
 *      previous page link.
 * 'echo' - Default is 1 (int). To return the code instead of echo'ing, set this
 *      to 0 (zero).
 *
 * @author Eric Martin <eric@ericmmartin.com>
 * @copyright Copyright (c) 2009, Eric Martin
 * @version 1.0
 *
 * @param array|string $args Optional. Override default arguments.
 * @return string HTML content, if not displaying.
 */
 
function emm_paginate($args = null) {
	$defaults = array(
		'page' => null, 'pages' => null, 
		'range' => 3, 'gap' => 3, 'anchor' => 1,
		'before' => '<div class="emm-paginate">', 'after' => '</div>',
		'title' => __('Pages:'),
		'nextpage' => __('&raquo;'), 'previouspage' => __('&laquo'),
		'echo' => 1
	);

	$r = wp_parse_args($args, $defaults);
	extract($r, EXTR_SKIP);

	if (!$page && !$pages) {
		global $wp_query;

		$page = get_query_var('paged');
		$page = !empty($page) ? intval($page) : 1;

		$posts_per_page = intval(get_query_var('posts_per_page'));
		$pages = intval(ceil($wp_query->found_posts / $posts_per_page));
	}
	
	$output = "";
	if ($pages > 1) {	
		$output .= "$before<span class='emm-title'>$title</span>";
		$ellipsis = "<span class='emm-gap'>...</span>";

		if ($page > 1 && !empty($previouspage)) {
			$output .= "<a href='" . get_pagenum_link($page - 1) . "' class='emm-prev'>$previouspage</a>";
		}
		
		$min_links = $range * 2 + 1;
		$block_min = min($page - $range, $pages - $min_links);
		$block_high = max($page + $range, $min_links);
		$left_gap = (($block_min - $anchor - $gap) > 0) ? true : false;
		$right_gap = (($block_high + $anchor + $gap) < $pages) ? true : false;

		if ($left_gap && !$right_gap) {
			$output .= sprintf('%s%s%s', 
				emm_paginate_loop(1, $anchor), 
				$ellipsis, 
				emm_paginate_loop($block_min, $pages, $page)
			);
		}
		else if ($left_gap && $right_gap) {
			$output .= sprintf('%s%s%s%s%s', 
				emm_paginate_loop(1, $anchor), 
				$ellipsis, 
				emm_paginate_loop($block_min, $block_high, $page), 
				$ellipsis, 
				emm_paginate_loop(($pages - $anchor + 1), $pages)
			);
		}
		else if ($right_gap && !$left_gap) {
			$output .= sprintf('%s%s%s', 
				emm_paginate_loop(1, $block_high, $page),
				$ellipsis,
				emm_paginate_loop(($pages - $anchor + 1), $pages)
			);
		}
		else {
			$output .= emm_paginate_loop(1, $pages, $page);
		}

		if ($page < $pages && !empty($nextpage)) {
			$output .= "<a href='" . get_pagenum_link($page + 1) . "' class='emm-next'>$nextpage</a>";
		}

		$output .= $after;
	}

	if ($echo) {
		echo $output;
	}

	return $output;
}

/**
 * Helper function for pagination which builds the page links.
 *
 * @access private
 *
 * @author Eric Martin <eric@ericmmartin.com>
 * @copyright Copyright (c) 2009, Eric Martin
 * @version 1.0
 *
 * @param int $start The first link page.
 * @param int $max The last link page.
 * @return int $page Optional, default is 0. The current page.
 */
function emm_paginate_loop($start, $max, $page = 0) {
	$output = "";
	for ($i = $start; $i <= $max; $i++) {
		$output .= ($page === intval($i)) 
			? "<span class='emm-page emm-current'>$i</span>" 
			: "<a href='" . get_pagenum_link($i) . "' class='emm-page'>$i</a>";
	}
	return $output;
}

function post_is_in_descendant_category( $cats, $_post = null )
{
	foreach ( (array) $cats as $cat ) {
		// get_term_children() accepts integer ID only
		$descendants = get_term_children( (int) $cat, 'category');
		if ( $descendants && in_category( $descendants, $_post ) )
			return true;
	}
	return false;
}

/*******************************
 CUSTOM COMMENTS
********************************/

function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class('clearfix'); ?> id="li-comment-<?php comment_ID() ?>">
   	<div class="gravatar">
	 <?php echo get_avatar($comment,$size='50',$default='http://www.gravatar.com/avatar/61a58ec1c1fba116f8424035089b7c71?s=32&d=&r=G' ); ?>
	 <div class="gravatar_mask"></div>
	</div>
     <div id="comment-<?php comment_ID(); ?>">
	  <div class="comment-meta commentmetadata clearfix">
	    <?php printf(__('<strong>%s</strong>'), get_comment_author_link()) ?><?php edit_comment_link(__('(Edit)'),'  ','') ?> <span><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?>
	  </span>
	  </div>
	  
      <div class="text">
		  <?php comment_text() ?>
	  </div>
	  
	  <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.') ?></em>
         <br />
      <?php endif; ?>

      <div class="reply">
         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </div>
     </div>
<?php }

/*******************************

  THEME OPTIONS PAGE

********************************/



add_action('admin_menu', 'rich_theme_page');

function rich_theme_page ()

{

	if ( count($_POST) > 0 && isset($_POST['rich_settings']) )

	{

		$options = array ('logo_img', 'logo_alt','contact_text','linkedin_link','gplus_link','twitter_link','facebook_link','flickr_link','insta_link','pinterest_link','youTube_link','copyright','rich_mytest','phone_number','contact_email','contact_address','show_hide_slider','slider_img_1','slider_img_2','slider_img_3','slider_img_4','slider_img_5','slider_title_1','slider_title_2','slider_title_3','slider_title_4','slider_title_5','slider_text_1','slider_text_2','slider_text_3','slider_text_4','slider_text_5','slider_page_link_1','slider_page_link_2','slider_page_link_3','slider_page_link_4','slider_page_link_5','slider_link_1','slider_link_2','slider_link_3','slider_link_4','slider_link_5','footerlogo');

		

		foreach ( $options as $opt )

		{

			delete_option ( 'rich_'.$opt, $_POST[$opt] );

			//add_option ( 'rich_'.$opt, $_POST[$opt] );

			add_option ( 'rich_'.$opt, stripslashes($_POST[$opt]) );	

		}			

		 

	}

	add_menu_page(__('Theme Options'), __('Theme Options'), 'edit_themes', basename(__FILE__), 'rich_settings');

	add_submenu_page(__('Theme Options'), __('Theme Options'), 'edit_themes', basename(__FILE__), 'rich_settings');

}

function rich_settings()

{?>
  <div class="wrap cstheme">
    <link rel="stylesheet" href="<?php echo get_bloginfo('template_directory')."/admin/"; ?>css/ui.css" />
    <link rel="stylesheet" href="<?php echo get_bloginfo('template_directory')."/admin/"; ?>css/admin-style.css" type="text/css" />
    <link href="<?php echo get_bloginfo('template_directory')."/admin/"; ?>css/tab.css" rel="stylesheet" type="text/css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> 
    <script src="<?php echo get_bloginfo('template_directory')."/admin/"; ?>js/jquery_ui.js"></script> 
    <script src="<?php echo get_bloginfo('template_directory')."/admin/"; ?>js/tab.js" type="text/javascript"></script> 
    <script>

  $(function() {

    $( "#tabs" ).tabs();

  });

jQuery(document).ready(function($){



$('.custom_media_upload').click(function() {



        var send_attachment_bkp = wp.media.editor.send.attachment;

        var button = $(this);



        wp.media.editor.send.attachment = function(props, attachment) {



            $(button).prev().prev().attr('src', attachment.url);

            $(button).prev().val(attachment.url);



            wp.media.editor.send.attachment = send_attachment_bkp;

        }



        wp.media.editor.open(button);



        return false;       

    });



});

</script>
    <?php 

	if(function_exists( 'wp_enqueue_media' )){

		wp_enqueue_media();

	}else{

		wp_enqueue_style('thickbox');

		wp_enqueue_script('media-upload');

		wp_enqueue_script('thickbox');

	}

?>
    <h2>Theme Options Panel</h2>
     
	 <script>
	 
			var uri = "<?= $_SERVER['REQUEST_URI'] ?>";
			
			function selectTabs(id){
												
				submit_to = uri+"#"+id;
				jQuery("#tabbedForm").attr("action",submit_to);
				
				}
		</script>
        
    <form method="post" action="<?= $_SERVER['REQUEST_URI'] ?>" id="tabbedForm">
      <div id="tabs" class="rstabSec">
        <ul class="rstab">
          <li><a href="#general-setting" onclick="selectTabs('general-setting')">General Settings</a></li>
          <li><a href="#contact-setting" onclick="selectTabs('contact-setting')">Contact Settings</a></li>
          <li><a href="#social-bar" onclick="selectTabs('social-bar')">Social Settings</a></li>
          <li><a href="#home-page-slider" onclick="selectTabs('home-page-slider')">Home Page Slider</a></li>
          <li><a href="#footer-setting" onclick="selectTabs('footer-setting')">Footer Settings</a></li>
        </ul>
        
       
        <div id="widgets-left">
          <div class="rsAdmin">
            <div id="general-setting">
              <fieldset style="padding-bottom:20px; margin-top:20px;">
                <legend style="margin-left:5px; padding:0 5px;color:#2481C6; text-transform:uppercase;"><strong>General Settings</strong></legend>
                <table class="form-table">
                  
                  <!-- General settings -->
                  
                  <tr valign="top">
                    <th scope="row"><label for="logo_img">Change logo</label></th>
                    <td><input class="custom_media_url" id="logo_img" type="text" name="logo_img" value="<?php echo get_option('rich_logo_img'); ?>" >
                      <a href="#" class="button custom_media_upload">Upload</a> <br />
                      <em>current logo:</em> <br />
                      <img src="<?php echo get_option('rich_logo_img'); ?>" alt="<?php echo get_option('rich_logo_alt'); ?>" /></td>
                  </tr>
                  <tr valign="top">
                    <th scope="row"><label for="logo_alt">Logo ALT Text</label></th>
                    <td><input name="logo_alt" type="text" id="logo_alt" value="<?php echo get_option('rich_logo_alt'); ?>" class="regular-text" /></td>
                  </tr>
                </table>
              </fieldset>
              <p class="submit">
                <input type="submit" name="Submit" class="button-primary" value="Save Changes" />
                <input type="hidden" name="rich_settings" value="save" style="display:none;" />
              </p>
            </div>
            <div id="contact-setting">
              <fieldset style="padding-bottom:20px; margin-top:20px;">
                <legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>Contact Page Settings</strong></legend>
                <table class="form-table">
                  <tr>
                    <td colspan="2"></td>
                  </tr>
                  <tr valign="top">
                    <th scope="row"><label for="phone_number">Phone Number</label></th>
                    <td><input name="phone_number" type="text" id="phone_number" value="<?php echo get_option('rich_phone_number'); ?>" class="regular-text" /></td>
                  </tr>
                  <tr valign="top">
                    <th scope="row"><label for="contact_email">Email Address</label></th>
                    <td><input name="contact_email" type="text" id="contact_email" value="<?php echo get_option('rich_contact_email'); ?>" class="regular-text" /></td>
                  </tr>
                  <tr valign="top">
                    <th scope="row"><label for="contact_address">Mailing Address</label></th>
                    <td><textarea name="contact_address" id="contact_address" rows="7" cols="70"><?php echo stripslashes(get_option('rich_contact_address')); ?></textarea></td>
                  </tr>
                </table>
              </fieldset>
              <p class="submit">
                <input type="submit" name="Submit" class="button-primary" value="Save Changes" />
                <input type="hidden" name="rich_settings" value="save" style="display:none;" />
              </p>
            </div>
            <div id="social-bar">
              <fieldset style="padding-bottom:20px; margin-top:20px;">
                <legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>Social Links</strong></legend>
                <table class="form-table">
                  <tr valign="top">
                    <th scope="row"><label for="facebook_link">Facebook Link</label></th>
                    <td><input name="facebook_link" type="text" id="facebook_link" value="<?php echo get_option('rich_facebook_link'); ?>" class="regular-text" /></td>
                  </tr>
                  <tr valign="top">
                    <th scope="row"><label for="twitter_link">Twitter Link</label></th>
                    <td><input name="twitter_link" type="text" id="twitter_link" value="<?php echo get_option('rich_twitter_link'); ?>" class="regular-text" /></td>
                  </tr>
                  <tr valign="top">
                    <th scope="row"><label for="flickr_link">Flickr Link</label></th>
                    <td><input name="flickr_link" type="text" id="flickr_link" value="<?php echo get_option('rich_flickr_link'); ?>" class="regular-text" /></td>
                  </tr>
                  <tr valign="top">
                    <th scope="row"><label for="linkedin_link">LinkedIn Link</label></th>
                    <td><input name="linkedin_link" type="text" id="linkedin_link" value="<?php echo get_option('rich_linkedin_link'); ?>" class="regular-text" /></td>
                  </tr>
                  <tr valign="top">
                    <th scope="row"><label for="gplus_link">Google Plus Link</label></th>
                    <td><input name="gplus_link" type="text" id="gplus_link" value="<?php echo get_option('rich_gplus_link'); ?>" class="regular-text" /></td>
                  </tr>
                  <tr valign="top">
                    <th scope="row"><label for="youTube_link">Youtube Link</label></th>
                    <td><input name="youTube_link" type="text" id="youTube_link" value="<?php echo get_option('rich_youTube_link'); ?>" class="regular-text" /></td>
                  </tr>
                  <tr valign="top">
                    <th scope="row"><label for="pinterest_link">Pinterest Link</label></th>
                    <td><input name="pinterest_link" type="text" id="pinterest_link" value="<?php echo get_option('rich_pinterest_link'); ?>" class="regular-text" /></td>
                  </tr>
                  <tr valign="top">
                    <th scope="row"><label for="insta_link">Instagram Link</label></th>
                    <td><input name="insta_link" type="text" id="insta_link" value="<?php echo get_option('rich_insta_link'); ?>" class="regular-text" /></td>
                  </tr>
                </table>
              </fieldset>
              <p class="submit">
                <input type="submit" name="Submit" class="button-primary" value="Save Changes" />
                <input type="hidden" name="rich_settings" value="save" style="display:none;" />
              </p>
            </div>
            
            <div id="home-page-slider">
            <script>
			  	
					
					function toggleUI(id){
						show = jQuery("#"+id+" :selected").val();
						if(show == "no"){
							jQuery("#homeslide-ui").hide();
						}
						
						if(show == "yes"){
							jQuery("#homeslide-ui").show();
						}
						
						}
						
						jQuery(function(){
							toggleUI("show_hide_slider");
							});
			  </script>
              <fieldset style="padding-bottom:20px; margin-top:20px;">
                <legend style="margin-left:5px; padding:0 5px;color:#2481C6; text-transform:uppercase;"><strong>Homepage Slider </strong></legend>
                <table class="form-table">
                <tr valign="top">
                    <th scope="row"><label for="latest_tweet">Show home page slider</label></th>
                    <td>
                        <select name="show_hide_slider" id="show_hide_slider" onchange="toggleUI(id)">		
                            <option value="yes" <?php if(get_option('rich_show_hide_slider') == 'yes'){?>selected="selected"<?php }?>>Yes</option>
                            <option value="no" <?php if(get_option('rich_show_hide_slider') == 'no'){?>selected="selected"<?php }?>>No</option>
                        </select>
                    </td>
                </tr>
                </table>
                <p class="submit">
                <input type="submit" name="Submit" class="button-primary" value="Save Changes" />
                <input type="hidden" name="rich_settings" value="save" style="display:none;" />
              </p>
              
                <div class="show-home-slider" id="homeslide-ui">
                <table class="form-table">
                  <tr valign="top">
                    <th colspan="2">Slider 1</th>
                  </tr>
                  <tr valign="top">
                    <th scope="row"><label for="slider_title_1">Slider Title</label></th>
                    <td><input name="slider_title_1" type="text" id="slider_title_1" value="<?php echo get_option('rich_slider_title_1'); ?>" class="regular-text" /></td>
                  </tr>  
                  <tr valign="top">
                    <th scope="row"><label for="slider_img_1">Slider Image</label></th>
                    <td><input class="custom_media_url" id="slider_img_1" type="text" name="slider_img_1" value="<?php echo get_option('rich_slider_img_1'); ?>" >
                      <a href="#" class="button custom_media_upload">Upload</a><br />
                    <strong>(Image size max 1300 X 560px)</strong><br />
                      <em>current image:</em> <br />
                      <img style="width:200px;" src="<?php echo get_option('rich_slider_img_1'); ?>" alt="" /></td>
                  </tr>                
                  <tr valign="top">
                    <th scope="row"><label for="slider_text_1">Slider Text</label></th>
                    <td><textarea name="slider_text_1" id="slider_text_1" rows="3" cols="70"><?php echo stripslashes(get_option('rich_slider_text_1')); ?></textarea></td>
                  </tr>
                  <tr valign="top">
                    <th scope="row"><label for="slider_page_link_1">Slider link page list</label></th>
                    <td><?php wp_dropdown_pages("name=slider_page_link_1&show_option_none=".__('- Select -')."&selected=" .get_option('rich_slider_page_link_1')); ?>
                      <br />
                      <em>You can either enter a link manually or select a page to point at.</em></td>
                  </tr>
                  <tr valign="top">
                    <th scope="row"><label for="slider_link_1">Slider page Link</label></th>
                    <td><input name="slider_link_1" type="text" id="slider_link_1" value="<?php echo get_option('rich_slider_link_1'); ?>" class="regular-text" />
                      <br />
                      <em>You can either enter a link manually or select a page to point at.</em></td>
                  </tr>
                  <tr>
                  <td colspan="2">
                  	<p class="submit">
                <input type="submit" name="Submit" class="button-primary" value="Save Changes" />
                <input type="hidden" name="rich_settings" value="save" style="display:none;" />
              </p>
                  </td>
                  </tr>
                  <tr valign="top">
                    <th colspan="2">Slider 2</th>
                  </tr>
                  
                  <tr valign="top">
                    <th scope="row"><label for="slider_title_2">Slider Title</label></th>
                    <td><input name="slider_title_2" type="text" id="slider_title_2" value="<?php echo get_option('rich_slider_title_2'); ?>" class="regular-text" /></td>
                  </tr>  
                  <tr valign="top">
                    <th scope="row"><label for="slider_img_2">Slider Image</label></th>
                    <td><input class="custom_media_url" id="slider_img_2" type="text" name="slider_img_2" value="<?php echo get_option('rich_slider_img_2'); ?>" >
                      <a href="#" class="button custom_media_upload">Upload</a><br />
                    <strong>(Image size max 1300 X 560px)</strong><br />
                      <em>current image:</em> <br />
                      <img style="width:200px;" src="<?php echo get_option('rich_slider_img_2'); ?>" alt="" /></td>
                  </tr>                
                  <tr valign="top">
                    <th scope="row"><label for="slider_text_2">Slider Text</label></th>
                    <td><textarea name="slider_text_2" id="slider_text_2" rows="3" cols="70"><?php echo stripslashes(get_option('rich_slider_text_2')); ?></textarea></td>
                  </tr>
                  <tr valign="top">
                    <th scope="row"><label for="slider_page_link_2">Slider link page list</label></th>
                    <td><?php wp_dropdown_pages("name=slider_page_link_2&show_option_none=".__('- Select -')."&selected=" .get_option('rich_slider_page_link_2')); ?>
                      <br />
                      <em>You can either enter a link manually or select a page to point at.</em></td>
                  </tr>
                  <tr valign="top">
                    <th scope="row"><label for="slider_link_2">Slider page Link</label></th>
                    <td><input name="slider_link_2" type="text" id="slider_link_2" value="<?php echo get_option('rich_slider_link_2'); ?>" class="regular-text" />
                      <br />
                      <em>You can either enter a link manually or select a page to point at.</em></td>
                  </tr>
                  <tr>
                  <td colspan="2">
                  	<p class="submit">
                <input type="submit" name="Submit" class="button-primary" value="Save Changes" />
                <input type="hidden" name="rich_settings" value="save" style="display:none;" />
              </p>
                  </td>
                  </tr>
                  <tr valign="top">
                    <th colspan="2">Slider 3</th>
                  </tr>
                  
                  <tr valign="top">
                    <th scope="row"><label for="slider_title_3">Slider Title</label></th>
                    <td><input name="slider_title_3" type="text" id="slider_title_3" value="<?php echo get_option('rich_slider_title_3'); ?>" class="regular-text" /></td>
                  </tr>  
                  <tr valign="top">
                    <th scope="row"><label for="slider_img_3">Slider Image</label></th>
                    <td><input class="custom_media_url" id="slider_img_3" type="text" name="slider_img_3" value="<?php echo get_option('rich_slider_img_3'); ?>" >
                      <a href="#" class="button custom_media_upload">Upload</a><br />
                    <strong>(Image size max 1300 X 560px)</strong><br />
                      <em>current image:</em> <br />
                      <img style="width:200px;" src="<?php echo get_option('rich_slider_img_3'); ?>" alt="" /></td>
                  </tr>                
                  <tr valign="top">
                    <th scope="row"><label for="slider_text_3">Slider Text</label></th>
                    <td><textarea name="slider_text_3" id="slider_text_3" rows="3" cols="70"><?php echo stripslashes(get_option('rich_slider_text_3')); ?></textarea></td>
                  </tr>
                  <tr valign="top">
                    <th scope="row"><label for="slider_page_link_3">Slider link page list</label></th>
                    <td><?php wp_dropdown_pages("name=slider_page_link_3&show_option_none=".__('- Select -')."&selected=" .get_option('rich_slider_page_link_3')); ?>
                      <br />
                      <em>You can either enter a link manually or select a page to point at.</em></td>
                  </tr>
                  <tr valign="top">
                    <th scope="row"><label for="slider_link_3">Slider page Link</label></th>
                    <td><input name="slider_link_3" type="text" id="slider_link_3" value="<?php echo get_option('rich_slider_link_3'); ?>" class="regular-text" />
                      <br />
                      <em>You can either enter a link manually or select a page to point at.</em></td>
                  </tr>
                  <tr>
                  <td colspan="2">
                  	<p class="submit">
                <input type="submit" name="Submit" class="button-primary" value="Save Changes" />
                <input type="hidden" name="rich_settings" value="save" style="display:none;" />
              </p>
                  </td>
                  </tr>
                  <tr valign="top">
                    <th colspan="2">Slider 4</th>
                  </tr>
                  
                  <tr valign="top">
                    <th scope="row"><label for="slider_title_4">Slider Title</label></th>
                    <td><input name="slider_title_4" type="text" id="slider_title_4" value="<?php echo get_option('rich_slider_title_4'); ?>" class="regular-text" /></td>
                  </tr>  
                  <tr valign="top">
                    <th scope="row"><label for="slider_img_4">Slider Image</label></th>
                    <td><input class="custom_media_url" id="slider_img_4" type="text" name="slider_img_4" value="<?php echo get_option('rich_slider_img_4'); ?>" >
                      <a href="#" class="button custom_media_upload">Upload</a><br />
                    <strong>(Image size max 1300 X 560px)</strong><br />
                      <em>current image:</em> <br />
                      <img style="width:200px;" src="<?php echo get_option('rich_slider_img_4'); ?>" alt="" /></td>
                  </tr>                
                  <tr valign="top">
                    <th scope="row"><label for="slider_text_4">Slider Text</label></th>
                    <td><textarea name="slider_text_4" id="slider_text_4" rows="3" cols="70"><?php echo stripslashes(get_option('rich_slider_text_4')); ?></textarea></td>
                  </tr>
                  <tr valign="top">
                    <th scope="row"><label for="slider_page_link_4">Slider link page list</label></th>
                    <td><?php wp_dropdown_pages("name=slider_page_link_4&show_option_none=".__('- Select -')."&selected=" .get_option('rich_slider_page_link_4')); ?>
                      <br />
                      <em>You can either enter a link manually or select a page to point at.</em></td>
                  </tr>
                  <tr valign="top">
                    <th scope="row"><label for="slider_link_4">Slider page Link</label></th>
                    <td><input name="slider_link_4" type="text" id="slider_link_4" value="<?php echo get_option('rich_slider_link_4'); ?>" class="regular-text" />
                      <br />
                      <em>You can either enter a link manually or select a page to point at.</em></td>
                  </tr>
                  <tr>
                  <td colspan="2">
                  	<p class="submit">
                <input type="submit" name="Submit" class="button-primary" value="Save Changes" />
                <input type="hidden" name="rich_settings" value="save" style="display:none;" />
              </p>
                  </td>
                  </tr>
                  <tr valign="top">
                    <th colspan="2">Slider 5</th>
                  </tr>
                  
                  <tr valign="top">
                    <th scope="row"><label for="slider_title_5">Slider Title</label></th>
                    <td><input name="slider_title_5" type="text" id="slider_title_5" value="<?php echo get_option('rich_slider_title_5'); ?>" class="regular-text" /></td>
                  </tr>  
                  <tr valign="top">
                    <th scope="row"><label for="slider_img_5">Slider Image</label></th>
                    <td><input class="custom_media_url" id="slider_img_5" type="text" name="slider_img_5" value="<?php echo get_option('rich_slider_img_5'); ?>" >
                      <a href="#" class="button custom_media_upload">Upload</a><br />
                    <strong>(Image size max 1300 X 560px)</strong><br />
                      <em>current image:</em> <br />
                      <img style="width:200px;" src="<?php echo get_option('rich_slider_img_5'); ?>" alt="" /></td>
                  </tr>                
                  <tr valign="top">
                    <th scope="row"><label for="slider_text_5">Slider Text</label></th>
                    <td><textarea name="slider_text_5" id="slider_text_5" rows="3" cols="70"><?php echo stripslashes(get_option('rich_slider_text_5')); ?></textarea></td>
                  </tr>
                  <tr valign="top">
                    <th scope="row"><label for="slider_page_link_5">Slider link page list</label></th>
                    <td><?php wp_dropdown_pages("name=slider_page_link_5&show_option_none=".__('- Select -')."&selected=" .get_option('rich_slider_page_link_5')); ?>
                      <br />
                      <em>You can either enter a link manually or select a page to point at.</em></td>
                  </tr>
                  <tr valign="top">
                    <th scope="row"><label for="slider_link_5">Slider page Link</label></th>
                    <td><input name="slider_link_5" type="text" id="slider_link_5" value="<?php echo get_option('rich_slider_link_5'); ?>" class="regular-text" />
                      <br />
                      <em>You can either enter a link manually or select a page to point at.</em></td>
                  </tr>
                </table>
              <p class="submit">
                <input type="submit" name="Submit" class="button-primary" value="Save Changes" />
                <input type="hidden" name="rich_settings" value="save" style="display:none;" />
              </p>
                </div>
              </fieldset>
            </div>
            
            
            <div id="footer-setting">
              <fieldset style="padding-bottom:20px; margin-top:20px;">
                <legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>Footer</strong></legend>
                <table class="form-table">
                	<tr valign="top">
                    <th scope="row"><label for="footerlogo">Change logo</label></th>
                    <td><input class="custom_media_url" id="footerlogo" type="text" name="footerlogo" value="<?php echo get_option('rich_footerlogo'); ?>" >
                      <a href="#" class="button custom_media_upload">Upload</a> <br />
                      <em>current logo:</em> <br />
                      <img src="<?php echo get_option('rich_footerlogo'); ?>" alt="<?php echo get_option('rich_logo_alt'); ?>" /></td>
                  </tr>
                  <tr>
                    <th><label for="copyright">Copyright Text</label></th>
                    <td><textarea name="copyright" id="copyright" rows="4" cols="70"><?php echo stripslashes(get_option('rich_copyright')); ?></textarea>
                      <br />
                      <em>You can use HTML for links etc.</em></td>
                  </tr>
                </table>
              </fieldset>
              <p class="submit">
                <input type="submit" name="Submit" class="button-primary" value="Save Changes" />
                <input type="hidden" name="rich_settings" value="save" style="display:none;" />
              </p>
            </div>
            
          </div>
        </div>
      </div>
    </form>
  </div>
  <?php }
/*******************************
  CONTACT FORM 
********************************/

 function hexstr($hexstr) {
  $hexstr = str_replace(' ', '', $hexstr);
  $hexstr = str_replace('\x', '', $hexstr);
  $retstr = pack('H*', $hexstr);
  return $retstr;
}

function strhex($string) {
  $hexstr = unpack('H*', $string);
  return array_shift($hexstr);
}

// Replaces the excerpt "more" text by a link
function new_excerpt_more($more) {
       global $post;
 //return '. <a class="readmore" href="'. get_permalink($post->ID) . '">Read More...</a>';
 return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');
function sm_widget() { register_sidebar(array( 'name' => __( 'Blog Sidebar Widget', 'smtheme' ),  'id' => 'my_sidebar', 'description' => __( 'Blog sidebar widget appear here', 'smtheme' ), ));}add_action( 'widgets_init', 'sm_widget' );


?>