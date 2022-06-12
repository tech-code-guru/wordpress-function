
<?php echo the_ID(); ?>
<?php echo the_title(); ?>
<?php echo the_post_thumbnail(); ?>
<?php echo the_permalink(); ?>



<!----------------post using featch query------------------------------------->
<?php 

$sql="SELECT * 
FROM  `wp_posts` 
where post_type='post'";
$result=$wpdb->get_results($sql);
foreach ($result as $abc)
{
echo $abc->ID.'<br>';
}
?>
<!---------------- end post using featch query------------------------------------->
