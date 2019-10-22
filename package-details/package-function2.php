<?php
function printConsole($msg,$data)
          {
            $consoleout1 = "<script>console.log( '". $msg . " : " . $data . "' );</script>";
            echo $consoleout1;
      }
      
/*function addregister($register_array,$db)	
     {
       include("header1-array-to-var.php");
       $sql="INSERT INTO tbl_customer(cid,name,email,contact,password) values (DEFAULT,'$name','$email','$mobile','$password')";
       $result=mysqli_query($db,$sql);
	     if (mysqli_errno($db) == 0)
        {
  				$row = mysqli_fetch_array($result,$db);
  				$row['sqlerrno'] = mysqli_errno($db);
  				$row['sqlerrmsg'] = mysqli_error($db);
  				return $row;
  			}
    		else
  			{
    				$row['sqlerrno'] = mysqli_errno($db);
    				$row['sqlerrmsg'] = mysqli_error($db);
    				return $row;
  			}
 }	*/
 
/*functionn for login and session*/

function insertIntoLoginTable($email,$contact,$password,$db)
{
	  /*echo  'I am inside insertIntoLoginTable: ';*/
      $resp = 99;
      $sql  = "SELECT email from tbl_cust_login where email ='$email'";
      $result=mysqli_query($db,$sql);
         if(mysqli_num_rows($result)>0)
            {
              //echo "You are already registered with us. Please use Login option";
              //echo "\n";
              $msgreg= "You are already registered with us. Please use Login option";
              $resp = 11;
              return $msgreg;
            }
        else
            {
               $sql = "INSERT INTO tbl_cust_login (id,email, password, login_date, mobileno) 
                                  VALUES (DEFAULT,'".$email."','".$password."',NOW(),'".$contact."')"; 
               $result=mysqli_query($db,$sql);
               if($result)
                  {
                    $resp = 0;
                    $msgreg= "Thank you for connecting with us!";
                    return $msgreg;
                   //echo  'I am inside insertIntoLoginTable:  and isserted value in tbl_cust_login ';
                                           
                    }
                else
                    {
                        return $resp;
                    }
              
                } 

}

function checkLoginDetails2($username,$password,$db)
	 {
	    $loginresult['resp'] = 99;
	    $loginresult['mobileno'] = '';
      $sql = "SELECT mobileno FROM tbl_cust_login WHERE email='$username' and password='$password'";
	    if($result = mysqli_query($db,$sql))
      { 
        //echo $sql;
        $rowcount=mysqli_num_rows($result);
        if($rowcount>0)
        {
        
       
         //$row = mysqli_fetch_array($query);
          $row = mysqli_fetch_array($result);
          $loginresult['mobileno'] = $row['mobileno'];
          //echo "mobile".$loginresult['mobileno'];
          $loginresult['resp'] = 0;
          //echo 'login success';
          //return $loginresult;
                //echo 'login success';
          $msgsuccess=' Login Success!';
        }
        
      }
        return $loginresult;
  }
	   

function genrateSessionSaltkey2($email,$contact,$db)
  {
      $sessionresp = 99;
      $currentdatetime = getDateTime2();
      $idname = getCustomerID2($email,$contact,$db);
      $salt=   $currentdatetime.".".$idname;
     // echo 'Generated salt value in salt var:'. $salt; echo '<br>';
     // echo '<br>';
      $sessionresp = insertIntoSessiontable2($salt,$db);
      if ($sessionresp == 0)
        {
           return $salt;
        }
  }

  function getDateTime2()
  {
      date_default_timezone_set('Asia/Kolkata');
      $currentdatetime = date('Y-m-d.H:i:s');
      //echo 'get function date:'. $currentdatetime;
     // echo '<br>';
      return $currentdatetime;
  }

  function getCustomerID2($email,$contact,$db)
{
      $resp = 99;
     /* echo 'email 111:'.$email; echo '<br>';
      echo 'email 111:'.$contact; echo '<br>';
      //echo 'email:'.$email;*/
      //$salt_result['id_name']="";
      //$salt_result['msg']="";
      $sql  = "SELECT cid,name from tbl_customer where email ='$email' and contact ='$contact'";
     
     // echo $sql;
      if($result=mysqli_query($db,$sql))
      {
        $row =mysqli_fetch_array($result);
         $custid = $row['cid'];
          $custname = $row['name'];
           //$salt_result['id_name'] =   $custid.".".$custname; 
           // $salt_result['msg'] = "Access granted.............";
          $user_name =$custid.".".$custname; 
         // echo 'i am fire after getting customer id '.$idname; echo '<br>';
          //echo "<br>";
         // echo "User Name here".$user_name;
          //echo "<br>";
          $resp = 0;

      }
     
      return $user_name;
     // $row = mysqli_fetch_array($result);
      //print_r($result); echo '<br>';
      //$num_row = mysqli_num_rows($result);
     

}

function insertIntoSessiontable2($salt,$db)
{
          $resp = 99;
         // echo "<br>";
         // echo "Ali..........." .$salt;
         // echo "<br>";
          $saltarr = split("\.", $salt);     
          //$saltarr =  explode("\.", $salt);
          //echo $saltarr;
          $cid = $saltarr[2];
        //  echo "Customer id to insert in session table 11: ".$cid;
        //  echo "<br>";
          $sql = "INSERT INTO tbl_session_al (id, session_salt, customer_id, session_timestamp) 
                               VALUES (DEFAULT,'".$salt."','".$cid."',NOW())"; 
                              // echo "<br>";
                              // echo $sql;


          $result=mysqli_query($db,$sql);
	        if($result)
		        {
		            $resp = 0;
		            return $resp;
		        }
	    	  else
		        {
		          //echo "Failed insert in session table. Please contact support team!!";
		          //echo "\n";
		          //$message =  "Failed insert in session table. Please contact support team!!";
		          return $resp;
		        }
}

  function getUserNamefromSalt2($saltkey)
    {
      //$saltarr =  explode("\.", $saltkey);
      $saltarr = split ("\.", $saltkey);   
      //$username =  $saltarr[0];
      $username =  $saltarr[3];
      return $username;
    }
?>