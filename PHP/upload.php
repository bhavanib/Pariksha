<?php
$a=0;
$b=0;
$c=0;
$target_dir = "files/";
$target_file1 = $target_dir . basename($_FILES["ufile"]["name"][0]);
$target_file2 = $target_dir . basename($_FILES["ufile"]["name"][1]);
$target_file3 = $target_dir . basename($_FILES["ufile"]["name"][2]);
if (move_uploaded_file($_FILES["ufile"]["tmp_name"][0], $target_file1)) {
        $a=1;
    } else {
 
    }
if (move_uploaded_file($_FILES["ufile"]["tmp_name"][1], $target_file2)) {
        $b=1;
    } else {
 
    }
if (move_uploaded_file($_FILES["ufile"]["tmp_name"][2], $target_file3)) {
       $c=1;
    } else {
 
    }
if (($a ==1) and ($b == 1) and ($c == 1 ))
{
$Message = urlencode("All files have been uploaded successfully.");
header("Location:index.php?Message=".$Message);
}
 
?>