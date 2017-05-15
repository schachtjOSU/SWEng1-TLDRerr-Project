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
if(!($stmt = $mysqli->prepare("INSERT INTO document_term (DocId, TermId) VALUES (?, ?)"))){
    echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("ii", $_POST['doc_id'], $_POST['term_id']))){
    echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->execute())){
    echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
} else {
    echo "Added " . $stmt->affected_rows . " document-term association!";
}
?>
<br /><br /><span><a href="expert_home.php">Go to home</a></span>
