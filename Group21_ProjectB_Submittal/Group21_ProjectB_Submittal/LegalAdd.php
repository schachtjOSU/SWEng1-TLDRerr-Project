<?php

// Turn on the error reporting
ini_set('display_errors', 'On');

// Include connections
include('admin/data.user.php');

$dbcon = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Error test connection.
if(!$dbcon || $dbcon->connect_errno){
	echo "Connection error " . $mysqldb->connect_errno . " " . $mysqldb->connect_error;
}
?>

<!-- Author: Jeffrey Schachtsick
	 Course: CS361 - Software Engineering 1
	 Assignment: TLDerr Project
	 Description: Landing Page for DB testing
	 Date Updated: 11/19/2016 -->

<!DOCTYPE html>
<html lang="en">
  <head>

	<!-- Title of Ingredient Table -->
    <meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css" />
    <title>TLDRerr Words Table</title>

  </head>

  <body>

	<!-- Interface for navigating between pages -->

	<table>

		<tr>

			<td><a href="main.html">Home | </a></td>

			<td><a href="LegalAdd.php">Reload TLDRerr Words and Phrases</a></td>

		</tr>

	</table>

	<p>TLDerr Words Example</p>

	<!-- List each TLDerr word from the database with the TLDerr ID and the rest of the attributes -->

	<table class=table_display td>

		<colgroup>

			<col span="1" style="width: 7%;">

			<col span="1" style="width: 33%;">

			<col span="1" style="width: 15%;">

			<col span="1" style="width: 32%;">

			<col span="1" style="width: 7%;">

			<col span="1" style="width: 6%;">

		</colgroup>

		<tr>

			<td>Word</td>

			<td>Definition</td>

			<td>Definition's source</td>

			<td>TLDRerr's definition</td>

			<td>Updated By</td>

			<td>Last Update</td>

		</tr>

<?php

// Make select statement

if(!($state = $dbcon->prepare("SELECT legal.LegalNum, legal.TCName, legal.LegalDef, legal.LegalSource, legal.TLDerrDef, legal.Entryname, legal.LastUpdate FROM legal"))) { echo "Prepare failed: " . $state->errno . " " . $state->error;

}

// execute the statement, error if incorrect

if(!$state->execute()) {

	echo "Execute failed: " . $dbcon->connect_errno . " " . $dbcon->connect_error;

}

// Bind the result

if(!$state->bind_result($id, $word, $legaldef, $source, $tldef, $user, $date)){

	echo "Bind failed: " . $dbcon->connect_errno . " " . $dbcon->connect_error;

}

// Display items from select to table

while($state->fetch()) {

	echo "\n</td>\n<td>\n" . $word . "\n</td>\n<td>\n" . $legaldef . "\n</td>\n<td>\n" . $source . "\n</td>\n<td>\n" . $tldef . "\n</td>\n<td>\n" . $user . "\n</td>\n<td>\n" . $date . "\n</td>\n</tr>";

}

// Close the state

$state->close();

?>

	</table>

	<div>

		<!-- Form for adding a word to the database, sends to addlegal.php file -->

		<form method="post" action="addlegal.php">

			<fieldset>

				<legend>Add Word</legend>

				<!-- Add word with text -->

				<p>Word or Phrase: <input type="text" name="WordName" /></p>

				<p>Legal Definition: <input type="text" name="WordDef" /></p>

				<p>Definition's source: <input type="text" name="DefSource" /></p>

				<p>TLDRerr Definition: <input type="text" name="TLDef" /></p>

				<p>User Name: <input type="text" name="UserName" /></p>

				<p>Date (yyyy-mm-dd): <input type="text" name="LastUpdate" /></p>

				<p><input type="submit" /></p>

			</fieldset>

		</form>

	</div>

	<!-- Update section for Words -->

	<div>

		<form method="post" action="updatelegal.php">

			<fieldset>

				<legend>Update a Word or Phrase</legend>

				<!-- Drop down menu that selects the word from the table -->

				<p>NOTE: For your convenience, the last entered Word fields are prepopulated.<br>
                    Copy-Paste the values from the view above for things you want to keep.</p>

				<p>Select Search Word to Update <select name="WordUpdate">

<?php

// Make select statement

if(!($state = $dbcon->prepare("SELECT legal.LegalNum, legal.TCName, legal.LegalDef, legal.LegalSource, legal.TLDerrDef, legal.Entryname, legal.LastUpdate FROM legal"))){

	echo "Prepare failed: "  . $state->errno . " " . $state->error;

}

// execute the statement, error if incorrect

if(!$state->execute()){

	echo "Execute failed: "  . $dbcon->connect_errno . " " . $dbcon->connect_error;

}

// Bind the result

if(!$state->bind_result($id, $word, $legaldef, $source, $tldef, $user, $date)){

	echo "Bind failed: "  . $dbcon->connect_errno . " " . $dbcon->connect_error;

}

// Display the ingredient in the drop down menu

while($state->fetch()){

	echo '<option value=" '. $id . ' "> ' . $word . '</option>\n';

}

echo '\n</select></p><p>Updated Word or Phrase: <input type="text" name="UpdateWord" value="' .  $word . '" /></p><p>Updated Legal Definition: <input type="text" name="UpdateDef" value="' .  $legaldef . '" /></p><p>Updated Definitions source: <input type="text" name="UpdateSource" value="' .  $source . '" /></p><p>Updated TLDRerr Definition: <input type="text" name="UpdateTLDef" value="' .  $tldef . '" /></p><p>Updated User Name: <input type="text" name="UpdateUser" value="' .  $user . '" /></p><p>Updated Date (yyyy-mm-dd): <input type="text" name="UpdateLast" value="' .  $date . '" /></p>';

	//'<option value=" '. $id . ' "> ' . $iname . '</option>\n';

// Close the state

$state->close();

?>				

				<!--</select></p>

				<p>Update Word or Phrase: <input type="text" name="UpdateWord" /></p>

				<p>Legal Definition: <input type="text" name="UpdateDef" /></p>

				<p>Definitions source: <input type="text" name="UpdateSource" /></p>

				<p>TLDerr Definition: <input type="text" name="UpdateTLDef" /></p>

				<p>User Name: <input type="text" name="UpdateUser" /></p>

				<p>Date (yyyy-mm-dd): <input type="text" name="UpdateLast" /></p> -->

				<p><input type="submit" /></p>

			</fieldset>

		</form>

	</div>

	</body>

</html>