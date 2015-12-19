<?php
    function read_file_docx($filename,$i)
    {   
 
        $striped_content = '';
        $content = '';
        if($i==0){$filename = "files/".$filename;}
        else{$filename = "classrooms/".$filename;}
 
        if(!$filename || !file_exists($filename)) return false;
 
        $zip = zip_open($filename);
 
        if (!$zip || is_numeric($zip)) return false;
 
        while ($zip_entry = zip_read($zip)) 
        {
 
            if (zip_entry_open($zip, $zip_entry) == FALSE) continue;
 
            if (zip_entry_name($zip_entry) != "word/document.xml") continue;
 
            $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
 
            zip_entry_close($zip_entry);
        }// end while
 
        zip_close($zip);    
 
        $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
        $content = str_replace('</w:r></w:p>', "\r\n", $content);
        $striped_content = strip_tags($content);
 
        if($i == 1) {return $striped_content;}
 
        return substr($striped_content,9);
    } 
 
    function printt($big)
    {
         for($pr = 0;$pr < count($big); $pr ++)
         {
           echo "(".$pr.")".$big[$pr];
           //echo $big[$pr];
           echo nl2br("\n");
         }
    } 
 
 
 
    $dir = "files";
    $files1 = scandir($dir);
    $file = scandir("classrooms");
 
 
    /*remaining array*/ $big = array();
 
    //classroom reading work
    $content3 = read_file_docx($file[2],1);
    $content3 = explode(' ',$content3);
 
 
    $content = "";$big = array();
 
    //reading the contents into an array. Now my array contains content from each file as string
    for($i = 2;$i < count($files1);$i++) 
    {
         $temp = read_file_docx($files1[$i],0);
         $temp = explode(' ',$temp);
         $temp = array_slice($temp,0);
         $big = array_merge($big,$temp);         
    }
 
 
 
    $class_no = count($content3);
 
 
    $together = array();
 
    $i=0;$j=floor(count($big)/2);$half = floor(count($big)/2);
 
    while($j<=count($big))
    { 
       if($j==count($big))
       {
           if($i==$half) {break;}
           else
           {
                 while($i<$half)
                 {
 
 
                      array_push($together,$big[$i].",NONE");
                      $i++;
                 }
           }
       }
 
 
if($i==$half)
       {
           if($j==count($big)) {break;}
           else
           {
                 while($j<count($big))
                 {
 
 
                      array_push($together,$big[$j].",NONE");
                      $j++;
                 }
           }
       }
       if(substr($big[$i],5,2)==substr($big[$j],5,2))
       {
 
           array_push($together,$big[$j].",NONE");
 
           $j++;
       }
       else
       {
 
           array_push($together,$big[$i].",".$big[$j]);
           $i++;$j++;
       }
 
    }
 
 
 
    // Generating output for desktop application
    $n =5;
    $j =0;
    $cl = 0;
    $dbfiles = array();
 
    //creating db connection    
    $servername = "mysql10.000webhost.com";
    $username = "a1137386_root";
    $password = "Root123";
    $dbname = "a1137386_SLayout";
 
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $getUrl = $conn->prepare("TRUNCATE TABLE layout");
    $getUrl->execute();
    $getUrl->close();
 
    while($cl < $class_no)
    {    
         $fp = fopen("output/".$content3[$cl].".csv","w");
         $url = "http://goobe.hostei.com/output/".$content3[$cl].".csv";
         array_push($dbfiles,$url);
        echo "<h1>$content3[$cl]</h1>";
        echo "<h4> BLACK BOARD  </h4>";
 
 
        while($j < $n)
        {  
 
 
            echo "<table border = \"1\" cellspacing= \"0\" cellpadding = \"2\">";
            echo "<col width=\"260\">";
            echo "<col width=\"260\">";
            echo "<col width=\"260\">";          
            echo "<tr>";
            echo "<td height = \"20\">".$together[$j]."</td>";
            echo "<td height = \"20\">".$together[$j + 5]."</td>";
            echo "<td height = \"20\">".$together[$j + 10]."</td>";
            echo "</tr>";
            echo "</table>";
            $split_together = explode(',',$together[$j]);
            $w=0;
            while($w<11) {
                 $split_together = explode(',',$together[$j+$w]);
                 $getUrl = $conn->prepare("INSERT INTO layout VALUES(?,?,?)");
                 $split_together[0]= str_replace(' ','',$split_together[0]);
                 //      $split_together[0]= preg_replace('/\s+/ ','',$split_together[0]);
                 $split_together[1]= str_replace(' ','',$split_together[1]);
                 //        $split_together[1]= preg_replace('/\s+/ ','',$split_together[1]);
                 $getUrl->bind_param('sss',$split_together[0],$url,$content3[$cl]);
                 $getUrl->execute();
                 $getUrl->close();
                 $getUrl1 = $conn->prepare("INSERT INTO layout VALUES(?,?,?)");
                 $getUrl1->bind_param('sss',$split_together[1],$url,$content3[$cl]);
                 $getUrl1->execute();
                 $getUrl1->close();
                 $w+=5; 
            }
            fputcsv($fp,array($together[$j],$together[$j + 5],$together[$j + 10]));
 
 
 
            $j ++; 
        }
 
 
        $n = $n + 15;
        echo nl2br("\n");
        $cl ++;
        if($j < count($together))
        {
        $j = 15 * $cl;
        }
        else
        { break;
        }
    }
?>	