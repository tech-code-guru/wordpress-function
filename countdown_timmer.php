<script>
// Set the date we're counting down to
var countDownDate = new Date("<?php echo date("F d, Y 9:52:00"); ?>"
).getTime();


// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time	
	var now = new Date().getTime();

    var start_date = new Date("<?php echo date("F d, Y 9:51:00"); ?>").getTime();
     //console.log(now);
     //console.log(start_date);
	 
	 $('.single_add_to_cart_button4444').hide();

				$('.ajax_add_to_cart').hide();

	if(now>start_date)
	{
		
		$('.single_add_to_cart_button4444').show();

		$('.ajax_add_to_cart').show();
		                
		 // Find the distance between now an the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
	
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="expire_time"
    //document.getElementById("expire_time").innerHTML = days + "d " + hours + "h "
	document.getElementById("expire_time").innerHTML ="Lottery expire end in: " +hours + "h "+ minutes + "m " + seconds + "s ";
    
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("expire_time").innerHTML = "<div style='color:red'>Lottery Expire</div>";

        $('.single_add_to_cart_button4444').hide();
		$('.ajax_add_to_cart').hide();


    }
	}
	
    
   
}, 1000);
</script>
<p id="expire_time"></p>