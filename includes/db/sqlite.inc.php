<?php

/**
 * 
 * ByteHoard2 SQLite  Database Abstraction Layer include library
 *
 * Same as bh1, but with prefixes.
 *
 *
 * @copyright ByteHoard team 2003-2004 
 * @license
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
**/
 
# Details for the grepper to pick up on

#name SQLite Database Module
#author Rob Lemley
#description Use a SQLite database (file-based, requires no additional database server)
#type database
#extension sqlite

# Must be here so 2.1 knows it can create and drop.
# Although preg_grep just looks for the create_bhdb stuff.
$dbmoduleversion = 2;

# Define what configuration you want. Key = what the dbconfig key will be. Value = array, with Data type (string / password) and description.
$dbconfigneeded = array(
	"filename"=>array("type"=>"string", "name"=>"SQLite Database Filename", "description"=>"The filename of the SQLite database file.<br>You may leave it as the default unless you want more than one program sharing the same database.<br>If you use a relative filepath, it will be taken relative to the main ByteHoard directory.", "default"=>"bytehoard.sqlite"),
	"prefix"=>array("type"=>"string", "name"=>"Table Prefix", "description"=>"The prefix ByteHoard should use on its tables. <br>Leave it as the default unless you're doing multiple installations using the same database.", "default"=>"bh2_"),
);

# Dynamically load extension in case (this will do addition of .dll or .so and only load if needed)
bh_dl("sqlite");

function bhdb_sqlite_correct_filename($filename) {
	if ((substr($filename, 0, 1) == "/") || (substr($filename, 1, 1) == ":")) {
		return $filename;
	} else {
		return str_replace("//", "/", realpath(dirname(__FILE__)."/../../")."/".$filename);
	}
}

function insert_bhdb($table, $values) {
global $dbconfig;

# Login to MySQL database
$dblink = sqlite_open(bhdb_sqlite_correct_filename($dbconfig['filename']));

# Parse given variables into SQL statement.

$sql = "INSERT INTO '".$dbconfig['prefix'].$table."' ";

$csql = "( ";
$vsql = " VALUES ( ";

$n = 0;

foreach ($values as $column => $data) {

	if ($n == 0) {
		$csql .= "'".$column."'";
		$vsql .= "'".addslashes($data)."'";
	} else {
		$csql .= ", '".$column."'";
		$vsql .= ", '".addslashes($data)."'";
	}

	$n++;
	
}

$csql .= " )";
$vsql .= " )";

$sql = $sql.$csql.$vsql.";";

$result = sqlite_query($dblink, $sql);


if ($result === FALSE) { die ("SQLite Error: ".sqlite_error_string(sqlite_last_error($dblink))."<br><br>Query: ".$sql); }

return $result;

}

function delete_bhdb($table, $where) {
global $dbconfig;

# Login to MySQL database
$dblink = sqlite_open(bhdb_sqlite_correct_filename($dbconfig['filename']));

# Parse given variables into SQL statement.

$sql = "DELETE FROM '".$dbconfig['prefix'].$table."' ";

$wsql = "WHERE ";

$n = 0;

foreach ($where as $column => $data) {

	if ($n == 0) {
		$wsql .= " ".$column." = '".addslashes($data)."' ";
	} else {
		$wsql .= "AND ".$column." = '".addslashes($data)."' ";
	}

	$n++;
	
}

$sql = $sql.$wsql.";";

$result = sqlite_query($dblink, $sql);

if ($result === FALSE) { die ("SQLite Error: ".sqlite_error_string(sqlite_last_error($dblink))."<br><br>Query: ".$sql); }

return $result;

}

function select_bhdb($table, $where, $limit) {
global $dbconfig;

# Login to MySQL database
$dblink = sqlite_open(bhdb_sqlite_correct_filename($dbconfig['filename']));

# Parse given variables into SQL statement.

$sql = "SELECT * FROM '".$dbconfig['prefix'].$table."' ";

if ($where != "") {

	$wsql = "WHERE ";

	$n = 0;

	foreach ($where as $column => $data) {

		if ($n == 0) {
			$wsql .= " " .$column." = '".addslashes($data)."' ";
		} else {
			$wsql .= "AND ".$column." = '".addslashes($data)."' ";
		}
	
		$n++;
	
	}

	$sql = $sql.$wsql."";


} else {

	$sql = "SELECT * FROM '".$dbconfig['prefix'].$table."'";

}

if ($limit != "") {
	$sql .= " LIMIT ".$limit.";";
} else {
	$sql .= ";";
}
$result0 = sqlite_query($dblink, $sql);

$array = array();

if ($result0 === FALSE) { die ("SQLite Error: ".sqlite_error_string(sqlite_last_error($dblink))."<br><br>Query: ".$sql); }

while ($av = sqlite_fetch_array($result0, SQLITE_ASSOC)) {

	$array[] = $av;
	
}
return $array;

}

function update_bhdb($table, $values, $where) {
global $dbconfig;

# Login to MySQL database
$dblink = sqlite_open(bhdb_sqlite_correct_filename($dbconfig['filename']));

# Parse given variables into SQL statement.

$sql = "UPDATE '".$dbconfig['prefix'].$table."' ";

$ssql = "SET ";

$n = 0;


foreach ($values as $column => $data) {

	if ($n == 0) {
		$ssql .= " ".$column." = '".addslashes($data)."' ";
	} else {
		$ssql .= ", ".$column." = '".addslashes($data)."' ";
	}

	$n++;

}

if ($where != "") {

	$wsql = "WHERE ";

	$n = 0;

	foreach ($where as $column => $data) {

		if ($n == 0) {
			$wsql .= "".$column." = '".addslashes($data)."' ";
		} else {
			$wsql .= "AND ".$column." = '".addslashes($data)."' ";
		}
	
		$n++;
	
	}

	$sql = $sql.$ssql.$wsql.";";


} else {

	$sql = $sql.$ssql.";";

}

$result = sqlite_query($dblink, $sql);

if ($result === FALSE) { die ("SQLite Error: ".sqlite_error_string(sqlite_last_error($dblink))."<br><br>Query: ".$sql); }

return $result;

}

function create_bhdb($table, $fields) {
global $dbconfig, $dbmoderror;

# Login to MySQL database
$dblink = sqlite_open(bhdb_sqlite_correct_filename($dbconfig['filename']));

# start SQL query
$sql = "CREATE TABLE '".$dbconfig['prefix'].$table."' ( ";

foreach ($fields as $fieldname => $attributes) {

	# Get them all uppercase
	foreach ($attributes as $key=>$value) { $value = strtoupper($value); $attributes[$key] = $value; }

	if ($attributes['type'] == "VARCHAR") { $attributes['type'] = "VARCHAR(255)"; }
	if ($attributes['primary'] == 1) { $primarykey = $fieldname; }
	
	# Create SQL
	$sql .= "'".$fieldname."' ".$attributes['type']. ", ";

}

# If there's a primary key, add it to the sql.
if (!empty($primarykey)) { $sql .= "PRIMARY KEY ('".$primarykey."') )"; }
else { $sql = substr($sql, 0, -2); $sql .= ")"; }

$result = sqlite_query($dblink, $sql);

if ($result === FALSE) { $dbmoderror = ("SQLite Error: ".sqlite_error_string(sqlite_last_error($dblink))); }

return $result;

}

function drop_bhdb($table) {
global $dbconfig;

# Login to MySQL database
$dblink = sqlite_open(bhdb_sqlite_correct_filename($dbconfig['filename']));

$sql = "DROP TABLE '".$dbconfig['prefix'].$table."'";

$result = sqlite_query($dblink, $sql);

if ($result === FALSE) { die ("SQLite Error: ".sqlite_error_string(sqlite_last_error($dblink))."<br><br>Query: ".$sql); }

return $result;

}

function test_bhdb($dbconfig) {
global $dbmoderror;

# Login to MySQL database
$dblink = sqlite_open(bhdb_sqlite_correct_filename($dbconfig['filename']));

if ($dblink === FALSE) { $dbmoderror = "SQLite Error: ".sqlite_error_string(sqlite_last_error($dblink)); return FALSE; }


return TRUE;

}

function table_exists_bhdb($table) {

$dblink = sqlite_open(bhdb_sqlite_correct_filename($dbconfig['filename']));

if ($dblink === FALSE) { $dbmoderror = "SQLite Error: ".sqlite_error_string(sqlite_last_error($dblink)); return FALSE; }

# Select the table
$seldb = sqlite_query($dblink, "SELECT * FROM '".$table."'");

if ($seldb === FALSE) { 
	return FALSE;
} else {
	return TRUE;
}

}

?>
