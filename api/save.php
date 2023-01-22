<?php
include './mysql/config.php';

$connection = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD) or die("Connect failed: %s\n". $connection->error);
if($connection->connect_errno ) {
  printf("Connect failed: %s<br />", $connection->connect_errno);
  exit();
}

if (!$connection->query("CREATE DATABASE IF NOT EXISTS " . DB_NAME)) {
  printf("Could not create database: %s<br />", $connection->error);
}
$connection->select_db(DB_NAME);

// $connection->query('DROP TABLE users');
// $connection->query('DROP TABLE addresses');

$createUsersTable = "CREATE TABLE IF NOT EXISTS users (
  id int(11) AUTO_INCREMENT PRIMARY KEY,
  firstName varchar(255) NOT NULL,
  lastName varchar(255) NOT NULL,
  companyName varchar(255),
  email varchar(255) NOT NULL,
  country varchar(255),
  keepOrigAddress tinyint(1) NOT NULL,
  addressId int(11) NOT NULL,
  created varchar(20) NOT NULL,
  FOREIGN KEY (addressId) REFERENCES addresses(id)
)";

$createAddressesTable = "CREATE TABLE IF NOT EXISTS addresses (
  id int(11) AUTO_INCREMENT PRIMARY KEY,
  address1 varchar(255) NOT NULL,
  address2 varchar(255),
  city varchar(255) NOT NULL,
  state varchar(255) NOT NULL,
  zipcode5 varchar(10),
  zipcode4 tinyint(10),
  created varchar(20) NOT NULL
)";
if(!$connection->query($createAddressesTable)) {
  echo "Error when creating addresses table" . $connection->error;
}
if(!$connection->query($createUsersTable)) {
  echo "Error when creating users table" . $connection->error;
}

// store address
$createAddressRecord = "INSERT INTO addresses(address1, address2, city, state, zipcode5, zipcode4, created) VALUES(
  '" . $_POST['address']['address1'] . "', 
  '" . $_POST['address']['address2'] . "', 
  '" . $_POST['address']['city'] . "', 
  '" . $_POST['address']['state'] . "', 
  '" . $_POST['address']['zipCode5'] . "', 
  '" . $_POST['address']['zipCode4'] . "', 
  '" . time() . "'
);";
if (!$connection->query($createAddressRecord)) {
  echo "Error when adding address record " . $connection->error;
}

// store user
$createUserRecord = "INSERT INTO users(firstName, lastName, companyName, email, country, keepOrigAddress, addressId, created) VALUES(
  '" . $_POST['userDetails']['firstName'] . "', 
  '" . $_POST['userDetails']['lastName'] . "', 
  '" . $_POST['userDetails']['company'] . "', 
  '" . $_POST['userDetails']['email'] . "', 
  '" . $_POST['userDetails']['country'] . "', 
  '" . $_POST['userDetails']['keepOrigAddress'] . "', 
  '" . $connection->insert_id . "',  
  '" . time() . "'
);";
$connection->query($createUserRecord);
if (!$connection->query($createUserRecord)) {
  echo "Error when adding user record " . $connection->error;
}

// returned all stored data
$returnData = array();
$selectAllRecords = "SELECT 
    u.firstName, 
    u.lastName, 
    u.companyName, 
    u.email, 
    u.country, 
    u.keepOrigAddress, 
    u.addressId as `addressId`,
    a.address1, 
    a.address2, 
    a.city, 
    a.state, 
    a.zipcode5, 
    a.zipcode4, 
    a.created
  FROM users u 
  JOIN addresses a 
  ON u.addressId = a.id;
";
if ($result = $connection->query($selectAllRecords)) {
  while($row = $result->fetch_assoc()) {
      $returnData[] = $row;
  }
}
if (!$connection->query($selectAllRecords)) {
  echo "Error when returning records " . $connection->error;
}

$connection->close();

echo json_encode([
  'status' => 200,
  'data' => $returnData
]);