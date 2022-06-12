<?php 
/*
Template Name: fetch post
*/ 
?>
<?php
//replace with your URL
$rss = fetch_feed('christine.demowebsites.co.in');

if (!is_wp_error($rss)) :

	$maxitems = $rss -> get_item_quantity(10); //gets latest 5 items This can be changed to suit your requirements
	$rss_items = $rss -> get_items(0, $maxitems);
endif;
?>
<?php
//grabs our post thumbnail image
	function get_first_image_url($html) {
		if (preg_match('/<img.+?src="(.+?)"/', $html, $matches)) {
			return $matches[1];
		}
	}
?>
<?php
//shortens description
function shorten($string, $length) {
	$suffix = '&hellip;';
	$short_desc = trim(str_replace(array("\r", "\n", "\t"), ' ', strip_tags($string)));
	$desc = trim(substr($short_desc, 0, $length));
	$lastchar = substr($desc, -1, 1);
	if ($lastchar == '.' || $lastchar == '!' || $lastchar == '?')
		$suffix = '';
		$desc .= $suffix;
	return $desc;
}
?>
<!--start of displaying our feeds-->
<ul class="rss-items" id="wow-feed">
<?php
		if ($maxitems == 0) echo '<li>No items.</li>';
		else foreach ( $rss_items as $item ) :
	//echo '<pre>';
//print_r ($item);
//echo '</pre>';

?>
<?php echo $Name=$item->get_author()->get_name(); ?>

    <?php if($Name=="Christine Chen") { ?>
	<li class="item">
	<span class="rss-image">
	<p><?php //echo $item -> data(); ?></p>
	<?php echo '<img src="' . get_first_image_url($item -> get_content()) . '"/>'; ?>
	</span>
	<span class="data">
	<h5><a href='<?php echo esc_url($item -> get_permalink()); ?>' title='<?php echo esc_html($item -> get_title()); ?>'> <?php echo esc_html($item -> get_title()); ?></a></h5>
	<span class="date-image">&nbsp;</span>
	<small><?php echo $item -> get_date('F Y'); ?></small><!--This can be changed -->
	<span class="comment-image">&nbsp;</span>
	<small><?php $comments = $item -> get_item_tags('http://purl.org/rss/1.0/modules/slash/', 'comments'); ?><?php $number = $comments[0]['data']; ?>
	<?php //checks and displays comment count
	if ($number == '1')
	{
	echo $number . "&nbsp;" . "Comment";
	}
	else
	{
	echo $number . "&nbsp;" . "Comments";
	}
	?>
	</small>
	<p><?php echo shorten($item -> get_description(), '300'); ?></p>
	</span>
	</li>
	<?php } ?>
	
<?php endforeach; ?>
</ul>

<style>

/*Author:  Tracy Ridge */
/*URL: http://www.worldoweb.co.uk/ */
/*Email:  tracy@worldoweb.co.uk */
#wow-feed {
    background: #FFFFFF;
    border: 1px solid #AFAFB0;
    width: 600px;
    margin: 10px 0;
    font-size: 0.8em;
}
#wow-feed  li { list-style: none; }
#wow-feed .rss-image img {
    width: 100px;
    height: 100px;
    padding: 8px;
    border: solid 1px #eee;
}
#wow-feed .rss-image { width: 30%; }
#wow-feed .item {
    border-bottom: 1px solid #AFAFB0;
    padding: 10px;
}
#wow-feed .data {
    display: inline-block;
    margin-left: 2%;
    vertical-align: top;
    width: 70%;
}
#wow-feed .data h5 { font-weight: bold; }
#wow-feed .data small {
    color: #8F90CB;
    font-size: 0.9em;
    margin-right: 10%;
}
#wow-feed .comment-image {
    background: url("images/comments.png");
    height: 16px;
    width: 16px;
    vertical-align: middle;
    display: inline-block;
    margin-right: 2%;
}
#wow-feed .date-image {
    background: url("images/date.png");
    height: 16px;
    width: 16px;
    vertical-align: middle;
    display: inline-block;
    margin-right: 2%;
}


</style>
