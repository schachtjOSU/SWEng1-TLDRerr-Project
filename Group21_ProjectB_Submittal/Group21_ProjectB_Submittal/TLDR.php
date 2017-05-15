<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Give me the calling URL</title>
<style>
body{
	width:500;
	height:auto;
}
h1{
	text-align:center;
    font-size: 25px;
	color:#FF0000;
}
p1{
	color: #FF0000;
	font-weight:bold;
}
</style>
</head>
<body>
<h1>TLDRerr Notes the Following Issues:</h1>

<?php
// Turn on the error reporting
ini_set('display_errors', 'On');

// Include connections
include('admin/data.user.php');

// Initallize db connection.
$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Error test connection.
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

// Error test connection.
echo "<p>Terms found are colored <p1>bold red</p1> like that.</p>";
$url = $_POST['url'];
echo "Checked url: " . $url;

// Converts url's entire page contents to a string.
$html = file_get_contents($url);

// Second paramter is which tags are allowed to remain.
$str = strip_tags($html, '<p><br>');

// Chop up the string into an array, retaining the punctuation.
$array = preg_split('/(\W+)/', $str, -1, PREG_SPLIT_DELIM_CAPTURE);

// Retrieve all "Word" entries from the database.
$query = "SELECT legal.TCName FROM legal";

// Execute the query.
$result = $mysqli->query($query);

// Declare an empty array and populate with all WORD values (could be in there more than once...)
$stack = array();

// Populate the stack[].
while($temp = mysqli_fetch_array($result, MYSQLI_NUM)){
	$stack[] = $temp;
}

// Free result set.
$result->free();

// Close the db connection.
$mysqli->close();

// Declare a new array to compress $stack.
$flatStack = array();

// Compress 2D $stack into 1D $flatStack.
for ($i = 0; $i < count($stack); $i++) {
	for ($j = 0; $j < count($stack[$i]); $j++) {
		$flatStack[] = $stack[$i][$j];
	}
}

/* Debug stack.
echo '<pre>';
print_r($flatStack);
echo '</pre>';
*/

// Get number of words in $array
$arrCount = count($array);

// Test and modify $array elements if found $flatStack.
foreach($flatStack as $word){
	for($i = 0; $i < $arrCount; $i++) {
		if($array[$i] == $word) {
			$array[$i] = "<p1>" . $array[$i] . "</p1>";
		}
	}
}

// Rebuild string.
$str = implode($array);

// Display the now WORD highlighted string.
echo $str;

// Debug Array.
//print_r($array);
?>

</body>
</html>
