<?php
/* Template Name: sm-ajax */

get_header(); ?>
<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
var username='sanjay_don';
var password='dondon';

   	$.ajax(
	{
	url: 'http://www.dailyonlinelottery.in/wp-admin/admin-ajax.php',
	type: "POST",
	//dataType: 'json',
	data : {username:username,password:password,action: "sm_create_user"},
   //data: {user_name:user_name,password:password},
	success:function(result)
	{
	alert('sucess');
	
	},
	error: function()
	{
alert('Opps something wrong!');
	}
	});
});
</script>
<?php
get_footer();
