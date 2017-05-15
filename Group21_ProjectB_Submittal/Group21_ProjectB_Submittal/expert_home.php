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
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Expert Analysis Home</title>
    </head>
    <body>
		<h3>TLDRerr Expert Analysis Home</h3>
		<form method="post" action="rating_add.php">
	        <span>Add an expert review to a document:
	            <select name="add_doc_name">
	                <?php
	                if(!($stmt = $mysqli->prepare("SELECT DocId, DocName FROM document"))){
	                    echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
	                }
	                if(!($stmt->execute())){
	                    echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
	                }
	                if(!($stmt->bind_result($add_id, $add_name))){
	    				echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
	    			}
	    			while($stmt->fetch()){
	    				echo '<option value="' . $add_id . '">' . $add_name . '</option>';
	    			}
	    			$stmt->close();
	                ?>
				</select>
			</span>
			<span><input type="submit" value="Submit" /></span>
		</form><br />
		<form method="post" action="expert_view.php">
			<span>View existing expert reviews of a document:
				<select name="view_doc_name">
					<?php
					if(!($stmt = $mysqli->prepare("SELECT DocId, DocName FROM document"))){
						echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
					}
					if(!($stmt->execute())){
						echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
					}
					if(!($stmt->bind_result($view_id, $view_name))){
						echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
					}
					while($stmt->fetch()){
						echo '<option value=' . $view_id . '>' . $view_name . '</option>';
					}
					$stmt->close();
					?>
				</select>
			</span>
			<span><input type="submit" name="submit" /></span>
		</form><br />
		<span>Document not listed above?<a href="expert_home.php">&nbsp;Add it! (But not working yet...)</a></span><br />
        <span>Return to main page.<a href="main.html">&nbsp;Go To Main!</a></span><br />
    </body>
</html>
