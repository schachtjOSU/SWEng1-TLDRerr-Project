<?php

// Turn on the error reporting
ini_set('display_errors', 'On');

// Get the location of database and all the password stuff from a different file
include('admin/data.user.php');

$dbcon = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Error test connection.
if(!$dbcon || $dbcon->connect_errno){
	echo "Connection error " . $mysqldb->connect_errno . " " . $mysqldb->connect_error;
}

// Use variable id to equal the post from the form

$id = $_POST['WordUpdate'];

//$name = $_POST['UpdateName'];

// Update Legal value(name) from LegalAdd.php's form

if(!($state = $dbcon->prepare("UPDATE legal SET TCName= ?, LegalDef=?, LegalSource=?, TLDerrDef=?, Entryname=?, LastUpdate=? WHERE LegalNum=$id"))){

	echo "Prepare failed: "  . $state->errno . " " . $state->error;

}

// Bind the result, send an error if the bind failed.

if(!($state->bind_param("ssssss",$_POST['UpdateWord'],$_POST['UpdateDef'],$_POST['UpdateSource'],$_POST['UpdateTLDef'],$_POST['UpdateUser'],$_POST['UpdateLast']))){

	echo "Bind failed: "  . $state->errno . " " . $state->error;

}

// Execute the statement, send an error if it failed or state a row was added.

if(!$state->execute()){

	echo "Execute failed: "  . $state->errno . " " . $state->error;

} else {

	echo "Updated " . $state->affected_rows . " rows to TLDerr Word table.";

}

?>

<!-- Ways to navigate back to the page to add another word or back to the Home page -->

<p><a href="LegalAdd.php">Add or Update another Word?</a></p>

<p><a href="main.html">Home Page</a></p>