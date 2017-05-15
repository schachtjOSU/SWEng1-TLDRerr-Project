<?php
// Turn on error reporting
ini_set('display_errors', 'On');

// Get the location of database and all the password stuff from a different file
include('admin/data.user.php');

// Connect to database
$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Error check the db connection
if($mysqli->connect_errno){
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
if(!($stmt = $mysqli->prepare("INSERT INTO expert_review (Document, ExpertName, Rating) VALUES (?, ?, ?)"))){
    echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("isi", $_POST['doc_id'], $_POST['expert_name'], $_POST['expert_rating']))){
    echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->execute())){
    echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
} else {
    echo "Added " . $stmt->affected_rows . " expert rating!";
}
?>
<br /><br /><span><a href="expert_home.php">Go to home</a></span>
