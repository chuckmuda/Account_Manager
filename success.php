<?php  
include('dbconfig.php'); 
$query = $db_con->prepare("SELECT * FROM accounts");    //for the everything table
$query->execute();

$inactive = $db_con->prepare("SELECT * FROM accounts WHERE active='0'");    //for the inactive accounts table
$inactive->execute();
                                                
                                                    //for the table that displays data from both 'accounts' table and 'account_types' table.
$acctypes = $db_con->prepare("SELECT accounts.id, accounts.first_name, accounts.last_name, account_types.account_type, account_types.description, account_types.cost 
FROM accounts 
INNER JOIN account_types ON accounts.account_type_id = account_types.id");
$acctypes->execute();

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Account Manager</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
    <link href="style.css" rel="stylesheet" type="text/css" media="screen">
</head> 
<body>
    
    <nav class="navbar" role="navigation" style="margin-bottom: 0">
  <div style="padding: 15px 50px 5px 50px; float: left; font-size: 16px;"> 
      <h2>Add Another Account</h2> 
        <a href="index.php" class="btn btn-default ">Back</a> 
        </div>
    </nav>
    <br/>
    
    <div class="row">
        <div class="col-md-12">         
                    <div class="container">  
                        <h3>List of all accounts</h3>
                        <table class="table table-striped table-bordered table-hover table-responsive ">
                             <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th>Join Date</th>
                                    <th>Activation</th>
                                    <th>Actions</th>
                                    <th>Active Date</th>
                                    <th>Deactivated Date</th>
                                </tr>
                            </thead>
                        <tbody>
                        
<?php
                            //While loop assigns array to $row1, array is fetched from the corresponding sql statement shown at the top of the page with the variable $query.                       
    while($row1=$query->fetch(PDO::FETCH_ASSOC))
    {
        $id=$row1['id'];
        $fname=$row1['first_name'];                     //Grabs the corresponding column name from the array and assigns each to a variable
        $lname=$row1['last_name'];
        $email=$row1['email'];
        $type=$row1['account_type_id'];
        $date=$row1['joining_date'];
        $active=$row1['active'];
        $activated=$row1['active_date'];
        $deactive=$row1['deactivated_date'];
?>
                                           
                                <tr>
                                    <td><?php echo $fname ;?></td>
                                    <td><?php echo $lname ;?></td>      <!--  Variable is now echoed into the table data corresponding to the table headers -->
                                    <td><?php echo $email ;?></td>
                                    <td><?php echo $type ;?></td>
                                    <td><?php echo $date ;?></td>
                                    <td><?php echo $active ;?></td>
                                    <td align="center">
                                        <a class="btn btn-default" href="activate.php?id=<?php echo $id ; ?>" > Activate</a>    <!-- sends the id of associative row to activate.php -->
                                        <a class="btn btn-default" href="deactivate.php?id=<?php echo $id ; ?>" > Deactivate</a><!-- sends the id of associative row to deactivate.php -->
                                    </td>
                                    <td><?php echo $activated ;?></td>
                                    <td><?php echo $deactive ;?></td>
                                </tr>                                       
<?php
    }
?>   
                            </tbody>
                        </table>
                    </div>                                          
                </div><!--end of col-md-12 -->
            </div>
                 <hr/>
    <div class="row">
        <div class="col-md-12">         
                    <div class="container">     
                        <h3>List of all Inactive accounts</h3>
                        <table class="table table-striped table-bordered table-hover table-responsive ">
                             <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th>Join Date</th>
                                    <th>Activation</th>
                                    <th>Actions</th>
                                    <th>Active Date</th>
                                    <th>Deactivated Date</th>
                                </tr>
                            </thead>
                        <tbody>          
                            <?php                               //While loop grabs the associative array attached to $inactive sql statement above
                                                                //Only shows the inactive accounts
    while($row1=$inactive->fetch(PDO::FETCH_ASSOC))
    {
        $id=$row1['id'];
        $fname=$row1['first_name'];
        $lname=$row1['last_name'];
        $email=$row1['email'];
        $type=$row1['account_type_id'];
        $date=$row1['joining_date'];
        $active=$row1['active'];
        $activated=$row1['active_date'];
        $deactive=$row1['deactivated_date'];
?>                                         
                                <tr>
                                    <td><?php echo $fname ;?></td>
                                    <td><?php echo $lname ;?></td>
                                    <td><?php echo $email ;?></td>
                                    <td><?php echo $type ;?></td>
                                    <td><?php echo $date ;?></td>
                                    <td><?php echo $active ;?></td>
                                    <td align="center">
                                        <a class="btn btn-default" href="activate.php?id=<?php echo $id ; ?>" > Activate</a>
                                        <a class="btn btn-default" href="deactivate.php?id=<?php echo $id ; ?>" > Deactivate</a>
                                    </td>
                                    <td><?php echo $activated ;?></td>
                                    <td><?php echo $deactive ;?></td>
                                </tr>                                       
<?php
    }
?>   
                            </tbody>
                        </table>
                    </div>                
                </div><!--end of col-md-12 -->
            </div>
            <hr />
    <div class="row">
        <div class="col-md-12">    
                <div class="container">     
                    <h3>List of accounts with corresponding account types, descriptions, and cost.</h3>
                    <b>This was not asked of me however the account_types table is not being used and I was unable to complete the third report.</b>
                        <table class="table table-striped table-bordered table-hover table-responsive ">
                             <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Cost</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php                               //Joins account_types table with accounts table and displays data concurrently
    while($rows=$acctypes->fetch(PDO::FETCH_ASSOC))
    {
        $id=$rows['id'];
        $fname=$rows['first_name'];
        $lname=$rows['last_name'];     
        $type=$rows['account_type'];
        $desc=$rows['description'];
        $cost=$rows['cost'];         
?>                      
                                <tr>                                              
                                    <td><?php echo $id ;?></td>
                                    <td><?php echo $fname ;?></td>
                                    <td><?php echo $lname ;?></td>                                                   
                                    <td><?php echo $type ;?></td>
                                    <td><?php echo $desc ;?></td>
                                    <td><?php echo $cost ;?></td>                                               
                                </tr>                                       
<?php
    }
?>   
                            </tbody>
                        </table>
                    </div><!--end of container -->     
            </div><!--end of col-md-12 -->
        </div><!--end of row -->
</body>
</html>
