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
        <title>Add a Rating or Associate a Term with a Document</title>
    </head>
    <body>
        <form method="post" action="rating_added.php">
            <fieldset>
                <?php
                if(!($stmt = $mysqli->prepare("SELECT DocName FROM document WHERE DocId = ?"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                }
                // Bind specified variable valus to parameters
                if(!($stmt->bind_param("i", $_POST['add_doc_name']))){
                    echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
                }
                // Database executes the SELECT statement
                if(!($stmt->execute())){
                    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                // Results of statement bound to PHP variables
                if(!($stmt->bind_result($doc_name))){
                    echo "Bind failed: "  . $stmt->connect . " " . $stmt->connect;
                }
                // Use new variables to insert HTML
                while($stmt->fetch()){
                        echo "<legend>Add an Expert Rating for " . $doc_name . "</legend>\n";
                }
                $stmt->close();
                echo "<input type='hidden' name='doc_id' value='" . $_POST['add_doc_name'] . "' /> \n"
                ?>
                <span>Expert's name (that's you!): <input type="text" name="expert_name" required /></span><br />
                <span>Safety Rating (1 = Very unsafe to sign, 10 = Very safe):
					<select name="expert_rating">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
					</select>
				</span><br />
                <span><input type="submit" value="Submit" /></span><br />
            </fieldset>
        </form>
        <form method="post" action="term_associated.php">
            <fieldset>
                <?php
                if(!($stmt = $mysqli->prepare("SELECT DocName FROM document WHERE DocId = ?"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                }
                // Bind specified variable valus to parameters
                if(!($stmt->bind_param("i", $_POST['add_doc_name']))){
                    echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
                }
                // Database executes the SELECT statement
                if(!($stmt->execute())){
                    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                // Results of statement bound to PHP variables
                if(!($stmt->bind_result($docname))){
                    echo "Bind failed: "  . $stmt->connect . " " . $stmt->connect;
                }
                // Use new variables to insert HTML
                while($stmt->fetch()){
                        echo "<legend>Associate a Term with " . $docname . "</legend\n>";
                }
                $stmt->close();
				echo "<input type='hidden' name='doc_id' value='" . $_POST['add_doc_name'] . "' /> \n"
                ?>
                <span> Select a Term (already selected terms will not be available):
                    <select name="term_id">
                        <?php
                        if(!($stmt = $mysqli->prepare("SELECT LegalNum, TCName FROM legal l WHERE l.LegalNUM NOT IN (SELECT LegalNum FROM legal INNER JOIN document_term ON LegalNum = TermId WHERE DocId = ?)"))){
							echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
						}
                        if(!($stmt->bind_param("i", $_POST['add_doc_name']))){
                            echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
                        }
						if(!($stmt->execute())){
							echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
						}
						if(!($stmt->bind_result($legalNum, $termName))){
							echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
						}
						while($stmt->fetch()){
							echo '<option value="' . $legalNum . '">' . $termName . '</option>';
						}
						$stmt->close();
                        ?>
                    </select>
                </span><br />
                <span><input type="submit" value="Submit" /></span><br />
            </fieldset>
        </form>
		<br /><span><a href="expert_home.php">Go to home</a></span>
    </body>
</html>
