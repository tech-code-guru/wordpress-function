<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<?php
if(isset($_POST['get_url']))

{
   $UrlPath=$_POST['UrlPath'];
   $ClassAndIDName=$_POST['ClassAndIDName'];
   $ClassAndIDAttribute=$_POST['ClassAndIDAttribute'];
   $Attribute=$_POST['Attribute'];



$html = file_get_contents($UrlPath);

//$html ='hkhkhks';




$dom = new DOMDocument();
libxml_use_internal_errors(1);
$dom->formatOutput = True;
$dom->loadHTML( $html );
$xpath = new DOMXPath( $dom );

foreach( $xpath->query( '//'.$Attribute.'[@'.$ClassAndIDAttribute.'="'.$ClassAndIDName.'"]' ) as $node )
{
    echo $node->nodeValue  . '<br><br>';
}
}

?>
<form method="post">
<table border="1">

<tr>
<th>Website Url:</th>
<td><input type="text" name="UrlPath"></td>
</tr>
<tr>
<th>Id Class Name:</th>
<td><input type="text" name="ClassAndIDName"></td>
</tr>
<tr>
<th>Id Class Attribute:</th>
<td><select name="ClassAndIDAttribute">
<option value="select">Select Attribute</option>
<option value="id">Id</option>
<option value="class">Class</option>
</select>
</td>
</tr>

<tr>
<th>Select Attribute:</th>
<td><select name="Attribute">
<option value="select">Select Attribute</option>
<option value="div">div</option>
<option value="id">Id</option>
<option value="ul">ul</option>
<option value="h1">h1</option>
<option value="h2">h2</option>
<option value="h3">h3</option>
<option value="h4">h4</option>
<option value="h5">h5</option>
<option value="h6">h6</option>
<option value="h7">h7</option>
<option value="a">a</option>
<option value="p">p</option>
<option value="li">li</option>
<option value="ol">ol</option>


<option value="class">h2</option>




</select>
</td>
</tr>
<input type="submit" name="get_url" placeholder="http://localhost/business_template_2477/2033_business/">

</form>