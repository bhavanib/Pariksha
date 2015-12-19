<?php
session_start();
$servername = "mysql10.000webhost.com";
$username = "a1137386_root";
$password = "Root123";
$dbname = "a1137386_SLayout";
$usn = $_POST["usn"];
$usn = strtolower($usn);
 
function printer($filename,$room)
{
   echo "<html><body>\n\n";
   echo "<h1>Room no : ".$room."</h1>\n\n";
 
 
 echo "<table border = \"1\" cellspacing= \"0\" cellpadding = \"2\">";
 
echo "<col width=\"260\">";
echo "<col width=\"260\">";
echo "<col width=\"260\">";
echo "<tr><td align=\"center\" colspan = \"3\">Blackboard</td></tr>";
 
$f = fopen($filename, "r");
while (($line = fgetcsv($f)) !== false) {
        echo "<tr>";
        foreach ($line as $cell) {
                echo "<td height=\"20\">" . htmlspecialchars($cell) . "</td>";
        }
        echo "</tr>";
}
fclose($f);
echo "\n</table></body></html>";
}
 
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
}
 
$stmt = $conn->prepare("SELECT dlink,room FROM layout WHERE usn=?");
$stmt->bind_param("s", $usn);
$stmt->execute();
 
/* bind result variables */
$stmt->bind_result($dlink,$room);
 
/* fetch value */
$stmt->fetch();
 
if(empty($dlink) || empty($room))
{ die("Sorry this usn is not present in our database");
 
}
 
 
echo "<html><head>";
echo "<a href="."\"".$dlink."\"".">"."Click to download</a><br/><br/><br/>";
 
$conn->close();
printer($dlink,$room);
?> 
 
</body>
</html>