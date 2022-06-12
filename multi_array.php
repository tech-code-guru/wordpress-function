
  <?php 
   $data['full_details']=array('name'=>'sanjay','email'=>'sanjay@gmail.com','location'=>'zirakpur',
   'About'=>array("me"=>"big"));
   $data['other']=array('a'=>'add','b'=>'big','c'=>'cat');
	  
	echo $data['full_details']['email'];
    echo "<pre>"; 
	print_r ($data);
	echo "</pre>";
   ?>
 