<?php

include '../requestDispatchers/config.php';
include 'database.class.php';

$db = new Database();

/**
 * Insert a new record
*/
$db->prepare('INSERT INTO mytable (placeholder, placeholder, placeholder, placeholder) VALUES (:fname, :lname, :age, :gender)');

$db->bind(':fname', 'John');
$db->bind(':lname', 'Smith');
$db->bind(':age', '24');
$db->bind(':gender', 'male');

$db->execute();

echo $db->lastInsertId();

/**
 * Insert multiple records using a Transaction
*/
$db->beginTransaction();

$db->prepare('INSERT INTO mytable (placeholder, placeholder, placeholder, placeholder) VALUES (:fname, :lname, :age, :gender)');

$db->bind(':fname', 'Jenny');
$db->bind(':lname', 'Smith');
$db->bind(':age', '23');
$db->bind(':gender', 'female');

$db->execute();

$db->bind(':fname', 'Jilly');
$db->bind(':lname', 'Smith');
$db->bind(':age', '25');
$db->bind(':gender', 'female');

$db->execute();

echo $db->lastInsertId();

$db->endTransaction();

/**
 * Select a single row
*/
$db->prepare('SELECT FName, LName, Age, Gender FROM mytable WHERE FName = :fname');

$db->bind(':fname', 'Jenny');

$row = $db->single();

echo "<pre>";
print_r($row);
echo "</pre>";

/**
 * Select multiple rows
 */
$db->prepare('SELECT FName, LName, Age, Gender FROM mytable WHERE LName = :lname');

$db->bind(':lname', 'Smith');

$rows = $db->resultset();

echo "<pre>";
print_r($rows);
echo "</pre>";

echo $db->rowCount();

?>