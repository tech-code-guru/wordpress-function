<?php

$copy_date = "Copyright 1999";
$copy_date = eregi_replace("([0-7]+)", "2000", $copy_date);
print $copy_date;

?>

<hr />
<?php

$copy_date = "Copyright 2000";
$copy_date = eregi_replace("([a-z]+)", "&Copy;", $copy_date);
print $copy_date;

?>
<hr />

<?php
echo stristr("Hello world!","world");
?>