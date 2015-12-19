<?php
if(isset($_GET['Message'])){
    echo $_GET['Message'];
}
?>
<!DOCTYPE html>
<html>
<body>
<h1> Welcome to Pariksha Desktop Application </h1>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form action="upload.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td><strong>multiple Files Upload </strong></td>
</tr>
<tr>
<td>Select file
<input name="ufile[]" type="file" id="ufile[]" size="50" /></td>
</tr>
<tr>
<td>Select file
<input name="ufile[]" type="file" id="ufile[]" size="50" /></td>
</tr>
<tr>
<td>Select file
<input name="ufile[]" type="file" id="ufile[]" size="50" /></td>
</tr>
<tr>
<td align="center"><input type="submit" name="Submit" value="Upload" /></td>
</tr>
</table>
</td>
</form>
</tr>
</table> 
 
<form action="docx_read.php" method="post" name="form2" id="form2">
<input type="submit" name="Submit1" value="Generate"  />
</body>
</html> 