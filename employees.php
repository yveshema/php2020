<?php
// Script to retrieve employees details from database
try {
    $db = new PDO('mysql:host=localhost;dbname=passion',$user,$passwd);
    $query = "SELECT Employees.firstName, Employees.lastName, Addresses.address, Addresses.city,Provinces.province,Addresses.postalCode,Addresses.movedInDate FROM Addresses INNER JOIN Employees on Addresses.employeeID = Employees.employeeID INNER JOIN Provinces ON Addresses.provinceID = Provinces.provinceID";

} catch (PDOException $e) {
    print "Error!: ". $e->getMessage();
    die();
}

?>