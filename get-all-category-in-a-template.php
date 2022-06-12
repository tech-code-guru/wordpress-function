	<?php
					$category = get_categories();
					//echo '<pre>';
					//print_r($category);
					//echo '</pre>';
					foreach ($category as $allCategory)
{
echo $firstCategory = $allCategory->name.', &nbsp';	
}

?>



<!---========================get all catagoty in a select option==================================-->
<select name="post_category">
<?php
$category = get_categories();
					//echo '<pre>';
					//print_r($category);
					//echo '</pre>';
					foreach ($category as $allCategory)
{
?>
		<option><?php echo $firstCategory = $allCategory->name; ?></option>
		
		<?php } ?>
		</select>


<!---========================get all catagoty in a select option==================================-->