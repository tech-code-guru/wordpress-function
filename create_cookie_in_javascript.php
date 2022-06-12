<script  type="text/javascript">
	jQuery(document).ready(function(){
        jQuery("#user-submit").click(function(){
          var inputEmail= document.getElementById("email");
             //localStorage.setItem("email", inputEmail.value);
             //var storedValue = localStorage.getItem("email");
             //alert(storedValue);
			createCookie("my_email", inputEmail.value, "10"); 


	// Function to create the cookie 
	function createCookie(name, value, days) { 
	var expires;       
	if (days) { 
		var date = new Date(); 
		date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000)); 
		expires = "; expires=" + date.toGMTString(); 
	} 
	else { 
		expires = ""; 
	} 
	  
	document.cookie = escape(name) + "=" +  
		escape(value) + expires + "; path=/"; 
	} 
        });
        

});
</script>
<?php 
// get cookie 
$wp_user_email =  $_COOKIE["my_email"];

?>
