<?php
include('dbconfig.php');
$id=$_GET['id'];
$activate_date =date('Y-m-d H:i:s');

$query = $db_con->prepare("SELECT active FROM accounts WHERE id='$id'");
$query->execute();

$result=$query->fetch(PDO::FETCH_ASSOC);

if($result['active'] == 0){
$query = $db_con->prepare("UPDATE accounts SET active='1' WHERE id='$id'");
$query->execute();

$query = $db_con->prepare("UPDATE accounts SET active_date='$activate_date' WHERE id='$id'");
$query->execute();
}
header("Location:success.php");

?>