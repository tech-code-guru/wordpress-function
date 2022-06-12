<?php
/* Template Name: Register Template */

get_header();
 header("Access-Control-Allow-Origin: *");

?>
<section class="default_page register_template">
<div class="container">
<div class="row">

<div class="col-sm-12">

<div class="alert alert-success" style="display:none;">
    <button type="button" class="close" data-dismiss="alert">x</button>

</div>


<div class="alert alert-danger" style="display:none;">
    <button type="button" class="close" data-dismiss="alert">x</button>

</div>
<form action="" method="post">
<div class="col-sm-6">

<div class="form-group">
<label class="col-12 col-form-label" for="">Name <span class="required">*</span></label>
<div class="col-12"><input class="form-control user_name" name="user_name"  type="text" value="" /></div>
</div>  

<div class="form-group">
<label class="col-12 col-form-label" for="">Father Name</label>
<div class="col-12"><input class="form-control father_name" name="father_name"  type="text" value="" /></div>
</div> 

<div class="form-group">
<label class="col-12 col-form-label" for="">Age <span class="required">*</span></label>
<div class="col-12"><input class="form-control age" name="age"  type="text" value="" /></div>
</div> 

<div class="form-group">
<label class="col-12 col-form-label" for="">Gender <span class="required">*</span></label>
<div class="col-12">
<select  class="form-control gender" name="gender">
<option value="nan">Select Gender</option>
<option value="Male">Male</option>
<option value="Female">Female</option>

</select>

</div>
</div> 
</div>

<div class="col-sm-6">
<div class="form-group">
<label class="col-12 col-form-label" for="">Occupation <span class="required">*</span></label>
<div class="col-12"><input class="form-control occupation" name="occupation"  type="text" value="" /></div>
</div> 

<div class="form-group">
<label class="col-12 col-form-label" for="">UserName <span class="required">*</span></label>
<div class="col-12"><input class="form-control user_login" name="user_login"  type="text" value="" /></div>
</div> 

<div class="form-group">
<label class="col-12 col-form-label" for="">Email</label>
<div class="col-12"><input class="form-control user_email" name="user_email"  type="text" value="" /></div>
</div>  

<div class="form-group">
<label class="col-12 col-form-label" for="">Phone Number <span class="required">*</span></label>
<div class="col-12"><input class="form-control phoneno" name="phoneno"  type="text" value="" /></div>
</div> 
</div>

<div class="col-sm-4"></div>
<div class="col-sm-4"><p class="submit"><input type="button" name="register" class="btn-primary button button-primary register_user" value="Register"></p>
</div>
<div class="col-sm-4"></div>

</form>
</div>
</div></div></div>
</section>
<!-- 
Father Name
Age
gender
Occupation
phoneno
Email



-->
<script>
$(document).ready(function()
{
	$('.register_user').click(function()
	{
	var user_name=$('.user_name').val();
	var father_name=$('.father_name').val();
	var age=$('.age').val();
    var gender=$('.gender').val();
    var occupation=$('.occupation').val();
	var user_login=$('.user_login').val();
	var user_email=$('.user_email').val();
	var phoneno=$('.phoneno').val();
	var user_pass=$('.phoneno').val();
	var mobile_code=$('.user_name').val();
	
	$.ajax(
	{
	url: '<?php bloginfo('template_url'); ?>/register_ajax.php',
	type: "POST",
	//dataType: 'json',
    data: {user_name:user_name,father_name:father_name,age:age,gender:gender,occupation:occupation,user_login:user_login,user_email:user_email,phoneno:phoneno,user_pass:user_pass,mobile_code:mobile_code},
	success:function(result)
	{
		
	$('.alert-danger').html(result).show();	
	var sucess = $.parseJSON(result);
	if(sucess.status=="1")
	{
		   $('.alert-success').html(sucess.msg).show();
	   $('.alert-danger').remove();	
	   
$.ajax(
	{
	url:'https://smsapi.engineeringtgr.com/send/?Mobile=9090909090&Password=ssmuha&Key=sanjavjcEmwuNBFnO28sUXVatAR0&Message=dsds&To=qzsxxza'
	});
	
		
	}
	
	},
	error: function()
	{
alert('Opps something wrong!');
	}
	});

	});
	
});

</script>

<script>
$(document).ready(function()
{
		
});
</script>

<?php get_footer(); ?>

