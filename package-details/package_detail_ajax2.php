<?php
//include('../header-1.php');
include('../config/dbConfig.php');
include('package-function2.php');
session_start();
//echo "Ali1234566...............";


	$username =$_GET['a'];
	$password =$_GET['b'];
 				//$username = mysqli_real_escape_string($db, $_POST['useremail']); 
              	//$password = mysqli_real_escape_string($db, $_POST['userpassword']);  
               	$loginresult['resp'] = 99;
               $loginresult['mobileno'] = '';
              // echo 'USER:'.$username;echo "<br/>";
               //echo 'Pass'.$password;echo "<br/>";
               //echo $username;
               $loginresult = checkLoginDetails2($username,$password,$db);
               $saltkey = '';
               //$_SESSION['salt']  = '';
               // echo "login feedback".$loginresult['resp'];
               // echo "<br>";
               // echo "phone ".$loginresult['mobileno'];
                 //$salt_result['id_name']="";
                // $salt_result['msg']="";
               if ($loginresult['resp'] == 0) 
                {
                    $saltkey = genrateSessionSaltkey2($username,$loginresult['mobileno'] ,$db);
                    $_SESSION['salt']   = $saltkey ;
                   ///////$salt_result = getUserNamefromSalt($saltkey);
                 	 $_SESSION['username'] = getUserNamefromSalt2($saltkey);

                  // echo "<br>";
                   //echo "My Name  ". $_SESSION['username'];
                  // echo "<br>";
                   ///// //$_SESSION['username'] =$salt_result['id_name'];
                   //// //$msglogin="Access Granted!!";
                   ////// $msglogin=$salt_result['msg'];
                    echo 'Login successfully.';
                   //// //exit();
                    //header('Location: http://www.ccm.net/forum/');   

                    
                }
                else
                {
                  /* $msglogin="Invalid Email or Password!";*/
                  $msglogin="Invalid Email or Password!";

                  //echo 'login error';
                   //exit();
                  echo 'login error';
                }



?>