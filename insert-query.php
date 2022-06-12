<?php
$sql=$wpdb->insert('wp_test', array(
    'test' => "$values",
	'post_id' => "$post_id"
));
//echo '<pre>';
//print_r($wpdb);
//echo '</pre>';
 echo $wpdb->query($sql);

?>