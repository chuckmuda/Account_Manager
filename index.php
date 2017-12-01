<?php
include('dbconfig.php');
	if(isset($_POST['submit']))
	{

		$user_first = $_POST['first_name'];
		$user_last = $_POST['last_name'];
		$user_email = $_POST['user_email'];
        $acc_type = $_POST['type'];
		$joining_date =date('Y-m-d H:i:s');
        
		try
		{	
			$stmt = $db_con->prepare("SELECT * FROM accounts WHERE email=:user_email");
			$stmt->execute(array(":user_email"=>$user_email));
			$count = $stmt->rowCount();
            
			if($count==0){
				
			$stmt = $db_con->prepare("INSERT INTO accounts(first_name,last_name,email,account_type_id,joining_date) VALUES(:fname, :lname, :email, :type, :jdate)");
			$stmt->bindParam(":fname",$user_first);
			$stmt->bindParam(":lname",$user_last);
			$stmt->bindParam(":email",$user_email);
            $stmt->bindParam(":type",$acc_type);
			$stmt->bindParam(":jdate",$joining_date);
                
                if($stmt->execute())
                {
                   
                    header("Location:success.php");
                }
            }//end of if count						
		}//end of try
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}//end of if post
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Account Manager</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link href="style.css" rel="stylesheet" type="text/css" media="screen">
</head>
<body>
    <div class="signin-form">
        <div class="container">
           <form class="form-signin" method="post" id="register-form">
                <h2 class="form-signin-heading">Sign Up</h2>
            <hr />
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="First Name" name="first_name" id="first_name" required/>
                    </div>
                                   
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Last Name" name="last_name" id="last_name" required/>
                    </div>
        
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email address" name="user_email" id="user_email" required/>
                        <span id="check-e"></span>
                    </div>
               
            <hr/>
               
               <h3 class="text-primary">Account Type?</h3>
                    <label class="text-primary">
                        <input type="radio" class="radio" value="1" name="type" id="type" required/>Free</label>
            &nbsp;&nbsp;
                    <label class="text-primary">
                        <input type="radio" class="radio" value="2" name="type" id="type" required/>Paying</label>
               <hr />
                    <div class="form-group">
                        <button type="submit" class="btn btn-default" name="submit">
                            <span class="glyphicon glyphicon-log-in"></span> &nbsp; Create Account</button>
                    </div>                      
            </form>
        </div><!--  end of container -->
    </div><!--  end of signin-form  -->
</body>
</html>
