<?php

/**
 * 
 * ByteHoard2 MySQL Database Abstraction Layer include library
 *
 * Now with ADOdb.
 *
 * $Id: mysql.inc.php,v 1.7 2005/07/26 21:55:09 andrewgodwin Exp $
 *
 * @copyright ByteHoard team 2003-2004 
 * @license
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
**/

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }
 
# Details for the grepper to pick up on

#name PostgreSQL Database Module (Alpha)
#author Andrew Godwin
#description Uses a PostgreSQL (local or remote) database to store configuration. <br>(Note: This module is alpha quality. Use at your own risk)
#type database
#extension pgsql

# Must be here so 2.1 knows it can create and drop.
# Although preg_grep just looks for the create_bhdb stuff.
$dbmoduleversion = 2;

# Define what configuration you want. Key = what the dbconfig key will be. Value = array, with Data type (string / password) and description.
$dbconfigneeded = array(
	"host"=>array("type"=>"string", "name"=>"PostgreSQL Hostname", "description"=>"The hostname of your PostgreSQL server. If it's running on the same machine, this will be 'localhost'.", "default"=>"localhost"),
	"username"=>array("type"=>"string", "name"=>"PostgreSQL Username", "description"=>"The username you use to connect to this server."),
	"password"=>array("type"=>"password", "name"=>"PostgreSQL Password", "description"=>"The password you use to connect to this server."),
	"db"=>array("type"=>"string", "name"=>"PostgreSQL Database", "description"=>"The database you want ByteHoard to use."),
	"prefix"=>array("type"=>"string", "name"=>"Table Prefix", "description"=>"The prefix ByteHoard should use on its tables. <br>Leave it as the default unless you're doing multiple installations using the same database.", "default"=>"bh2_"),
);

bh_dl("pgsql");

# Load ADOdb
require_once realpath(dirname(__FILE__)."/../adodb/adodb.inc.php");

function insert_bhdb($table, $values) {
global $dbconfig;

# Create DSN
$dsn = "postgres://".$dbconfig['username'].":".$dbconfig['password']."@".$dbconfig['host']."/".$dbconfig['db'];
$db = NewADOConnection($dsn);

# Parse given variables into SQL statement.

$sql = "INSERT INTO ".$dbconfig['prefix'].$table." ";

$csql = "( ";
$vsql = " VALUES ( ";

$n = 0;

foreach ($values as $column => $data) {

	if ($n == 0) {
		$csql .= "`".$column."`";
		$vsql .= "".$db->qstr($data)."";
	} else {
		$csql .= ",`".$column."`";
		$vsql .= ",".$db->qstr($data)."";
	}

	$n++;
	
}

$csql .= ")";
$vsql .= ")";

$sql = $sql.$csql.$vsql."";

$result = $db->Execute($sql);


if ($result === FALSE) { die ("ADOdb Insert Error: ".$db->ErrorMsg()."<br><br>Query: ".$sql); }

return $result;

}

function delete_bhdb($table, $where) {
global $dbconfig;

# Create DSN
$dsn = "postgres://".$dbconfig['username'].":".$dbconfig['password']."@".$dbconfig['host']."/".$dbconfig['db'];
$db = NewADOConnection($dsn);

# Parse given variables into SQL statement.

$sql = "DELETE FROM ".$dbconfig['prefix'].$table." ";

$wsql = "WHERE ";

$n = 0;

foreach ($where as $column => $data) {

	if ($n == 0) {
		$wsql .= "`".$column."` = ".$db->qstr($data)." ";
	} else {
		$wsql .= "AND `".$column."` = ".$db->qstr($data)." ";
	}

	$n++;
	
}

$sql = $sql.$wsql."";

$result = $db->Execute($sql);

if ($result === FALSE) { die ("ADOdb Delete Error: ".$db->ErrorMsg()."<br><br>Query: ".$sql); }

return $result;

}

function select_bhdb($table, $where, $limit) {
global $dbconfig;

# Create DSN
$dsn = "postgres://".$dbconfig['username'].":".$dbconfig['password']."@".$dbconfig['host']."/".$dbconfig['db'];
$db = NewADOConnection($dsn);
if ($db == FALSE) { die("ADOdb Error: Cannot connect to database"); }
$db->SetFetchMode(ADODB_FETCH_ASSOC);

# Parse given variables into SQL statement.

$sql = "SELECT * FROM ".$dbconfig['prefix'].$table." ";

if ($where != "") {

	$wsql = "WHERE ";

	$n = 0;

	foreach ($where as $column => $data) {

		if ($n == 0) {
			$wsql .= "`".$column."` = ".$db->qstr($data)." ";
		} else {
			$wsql .= "AND `".$column."` = ".$db->qstr($data)." ";
		}
	
		$n++;
	
	}

	$sql = $sql.$wsql."";


} else {

	$sql = "SELECT * FROM ".$dbconfig['prefix'].$table."";

}

$recordSet = $db->Execute($sql);

$array = array();

if (!$recordSet) {
     die ("ADOdb Select Error: ".$db->ErrorMsg()."<br><br>Query: ".$sql);
} else {
	while (!$recordSet->EOF) {
		if (($nl < $limit)||($limit == "")) {
			$array[] = $recordSet->fields;
		}
		$nl++;
		$recordSet->MoveNext();
	}
}

return $array;

}

function update_bhdb($table, $values, $where) {
global $dbconfig;

# Create DSN
$dsn = "postgres://".$dbconfig['username'].":".$dbconfig['password']."@".$dbconfig['host']."/".$dbconfig['db'];
$db = NewADOConnection($dsn);

foreach ($where as $field=>$value) {
	if ($n2 == 1) { $where2 .= " AND "; }
	$where2 .= "`".$field."` = ".$db->qstr($value);
	$n2 = 1;
}

$result = $db->AutoExecute($dbconfig['prefix'].$table,$values,'UPDATE',$where2);
if ($result === FALSE) { die ("ADOdb Update Error: ".$db->ErrorMsg()); }

}

function create_bhdb($table, $fields) {
global $dbconfig, $dbmoderror;

/*

  OK, for some reason this gives out when told to create a table with the field 'group' in it.
  No clue why, so I'm using the old code for now.

# Create DSN
# Actually, don;t datadict doesn't seem to work with them.
#$dsn = "mysql://".$dbconfig['username'].":".$dbconfig['password']."@".$dbconfig['host']."/".$dbconfig['db'];
$db = NewADOConnection('mysql');
$db->Connect($dbconfig['host'], $dbconfig['username'], $dbconfig['password'], $dbconfig['db']);
$dict = NewDataDictionary($db);

# Turn $fields into something for ADOdb
foreach ($fields as $field=>$values){ 
	if ($n2 == 1) { $fieldstr .= ",\n\r"; }
	switch ($values['type']) {
		case "varchar": $fieldtype = "X"; break;
		case "text": $fieldtype = "X2"; break;
	}
	$fieldstr .= $field." ".$fieldtype;
	if ($values['primary'] == 1) {
		$fieldstr .= " KEY";
	}
	$n2 = 1;
}

$sqlarray = $dict->CreateTableSQL($dbconfig['prefix'].$table, $fieldstr, "REPLACE");
$dict->ExecuteSQLArray($sqlarray);
*/

$dblink = pg_connect("host=".$dbconfig['host']." dbname".$dbconfig['db']." user=".$dbconfig['username']." password=".$dbconfig['password']."");



if ($dblink === FALSE) { $dbmoderror = "PostgreSQL Error: ".pg_last_error(); return FALSE; }

# First, drop the table if it exists.
$sql = "DROP TABLE IF EXISTS `".$dbconfig['prefix'].$table."`";
$result = pg_query($sql);
if ($result === FALSE) { $dbmoderror = ("MySQL Error: ".pg_last_error()); return FALSE; }

# start SQL query
$sql = "CREATE TABLE `".$dbconfig['prefix'].$table."` ( ";

foreach ($fields as $fieldname => $attributes) {

	# Get them all uppercase
	foreach ($attributes as $key=>$value) { $value = strtoupper($value); $attributes[$key] = $value; }

	if ($attributes['type'] == "VARCHAR") { $attributes['type'] = "VARCHAR(255)"; }
	if ($attributes['primary'] == 1) { $primarykey = $fieldname; }
	
	# Create SQL
	$sql .= "`".$fieldname."` ".$attributes['type']." NOT NULL, ";

}

# If there's a primary key, add it to the sql.
if (!empty($primarykey)) { $sql .= "PRIMARY KEY (`".$primarykey."`) )"; }
else { $sql = substr($sql, 0, -2); $sql .= ")"; }

$result = pg_query($sql);

if ($result === FALSE) { $dbmoderror = ("MySQL Error: ".pg_last_error()); }

return $result;


}

function drop_bhdb($table) {
global $dbconfig;

# Create DSN
# Actually, don;t datadict doesn't seem to work with them.
#$dsn = "mysql://".$dbconfig['username'].":".$dbconfig['password']."@".$dbconfig['host']."/".$dbconfig['db'];
$db = NewADOConnection('postgres');
$db->PConnect($dbconfig['host'], $dbconfig['username'], $dbconfig['password'], $dbconfig['db']);
$dict = NewDataDictionary($db);

$sqlarray = $dict->DropTableSQL($dbconfig['prefix'].$table);
$dict->ExecuteSQLArray($sqlarray);

}

# Gonna have to keep this native, cannot figure out how to do it w/ADOdb
function test_bhdb($dbconfig) {
global $dbmoderror;

# Login to PgSQL database
$dblink = pg_connect("host=".$dbconfig['host']." dbname".$dbconfig['db']." user=".$dbconfig['username']." password=".$dbconfig['password']."");

if ($dblink === FALSE) { $dbmoderror = "PostgreSQL Error: ".pg_last_error(); return FALSE; }

return TRUE;

}

function table_exists_bhdb($table) {

# Create DSN
$dsn = "postgres://".$dbconfig['username'].":".$dbconfig['password']."@".$dbconfig['host']."/".$dbconfig['db'];
$db = NewADOConnection($dsn);
$db->SetFetchMode(ADODB_FETCH_ASSOC);
$sql = "SELECT * FROM ".$dbconfig['prefix'].$table."";

$recordSet = $db->Execute($sql);
if ($recordSet == FALSE) { return FALSE; } else { return TRUE; }

}

?>