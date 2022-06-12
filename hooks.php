<!-----------------------------------add action hooks---------------------------------------->
<?php
function remove_tools()
{

remove_menu_page('tools.php');

}
add_action('admin_menu','remove_tools');


?>





<!-----------------------------------add filter hooks---------------------------------------->

<?php
function modifying_post_title($title)
{

return strtoupper($title);
}
add_filter('the_title','modifying_post_title');

?>


<?php
function modifying_post_content($content)
{
$content .='test';
return $content;
}
add_filter('the_content','modifying_post_content');

?>
