<?php
$a=0;
$b=0;
$c=0;
$target_dir = "classrooms/";
$target_file1 = $target_dir . basename($_FILES["ufile"]["name"][0]);
 
if (move_uploaded_file($_FILES["ufile"]["tmp_name"][0], $target_file1)) 
{
  $a=1;
    } else {
 
    }
 
if (($a ==1))
{
header("Location:indexusn.php);
}
 
?>