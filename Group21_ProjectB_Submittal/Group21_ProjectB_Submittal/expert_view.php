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
        <title>View Expert Reviews</title>
    </head>
    <body>
        <div>
            <table>
                <?php
                if(!($stmt = $mysqli->prepare("SELECT DocName FROM document WHERE DocId = ?"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                }
                // Bind specified variable valus to parameters
                if(!($stmt->bind_param("i", $_POST['view_doc_name']))){
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
                        echo "<caption>Expert Reviews For " . $docname . "</caption>";
                }
                $stmt->close();
                ?>
            <tr>
                <th></th>
                <th>Expert</th>
                <th>Rating</th>
                <th>Upvote</th>
                <th>Downvote</th>
            </tr>
       		<span>Return to main page.<a href="main.html">&nbsp;Go To Main!</a></span>
                <?php
                // Displays user rating, expert name, and expert rating for selected document in table
                // Next, need to add functional upvote and downvote buttons
                if(!($stmt = $mysqli->prepare("SELECT UserRate, ExpertName, Rating FROM expert_review WHERE Document = (?) ORDER BY UserRate DESC"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                }
                // Bind specified variable valus to parameters
                if(!($stmt->bind_param("i", $_POST['view_doc_name']))){
                    echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
                }
                // Database executes the SELECT statement
                if(!($stmt->execute())){
                    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                }
                // Results of statement bound to PHP variables
                if(!($stmt->bind_result($user_rate, $expert_name, $rating))){
                    echo "Bind failed: "  . $stmt->connect . " " . $stmt->connect;
                }
                // Use new variables to insert HTML
                while($stmt->fetch()){
                        echo "<tr>\n<td>" . $user_rate . "</td>\n<td>" . $expert_name . "</td>\n<td>" . $rating .
                        "</td>\n<td></td>\n<td></td>\n</tr>\n";
                }
                $stmt->close();
                ?>
        </table>
        </div>
		<span>Return to main page.<a href="main.html">&nbsp;Go To Main!</a></span>
    </body>
</html>
