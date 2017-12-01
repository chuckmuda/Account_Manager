<?php
include('dbconfig.php');
$id=$_GET['id'];
$deactivate_date =date('Y-m-d H:i:s');

$query = $db_con->prepare("SELECT active FROM accounts WHERE id='$id'");
$query->execute();

$result=$query->fetch(PDO::FETCH_ASSOC);

if($result['active'] == 1){
    
    $query = $db_con->prepare("UPDATE accounts SET active='0' WHERE id='$id'");
    $query->execute();

    $query = $db_con->prepare("UPDATE accounts SET deactivated_date='$deactivate_date' WHERE id='$id'");
    $query->execute();
}


header("Location:success.php");
?>