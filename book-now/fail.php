<?php
session_start();
  	 /* $_SESSION["packageDate"]="";
      $_SESSION["travelUserDate"]="";
      $_SESSION["adultCount"] ="";
      $_SESSION["childCount"] = "";
      $_SESSION["useremail"] = "";
      $_SESSION["usernumber"] = "";
      $_SESSION["totCount"] ="";
      $_SESSION["grossAmount"]="";
      $_SESSION["booking_idd"]="";*/

?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<div>
		<h2>Payment Failure</h2>
	</div>

	<div>
		<?php 
			if(isset($_POST['status'])){
				if($_POST['status']=="failure"){
					echo "<p>Payment Failed.<br>Details Are Below.</p>";
					echo "<p>Failure Reason: ".$_POST['unmappedstatus']."</p>";
					echo "<p>Txn Id: ".$_POST['txnid']."</p>";
					echo "<p>Name: ".$_POST['firstname']."</p>";
					echo "<p>Email: ".$_POST['email']."</p>";
					echo "<p>Amount: ".$_POST['amount']."</p>";
					echo "<p>Phone No: ".$_POST['phone']."</p>";
					echo "<p>Product Info: ".$_POST['productinfo']."</p>";
				}
			}

			?>
	</div>
</body>
</html>

<?php
 if(isset($_SESSION['salt']))
      {
      $_SESSION["packageDate"]="";
      $_SESSION["travelUserDate"]="";
      $_SESSION["adultCount"] ="";
      $_SESSION["childCount"] = "";
     // $_SESSION["useremail"] = "";
      $_SESSION["usernumber"] = "";
      $_SESSION["totCount"] ="";
      $_SESSION["grossAmount"]="";
      $_SESSION["booking_idd"]="";
      $_SESSION['pack_name'] ="";
     // echo "Salt is Alive ...............................";
      $_SESSION['price']="";  
      }
      else
      {
      $_SESSION["packageDate"]="";
      $_SESSION["travelUserDate"]="";
      $_SESSION["adultCount"] ="";
      $_SESSION["childCount"] = "";
      $_SESSION["useremail"] = "";
      $_SESSION["usernumber"] = "";
      $_SESSION["totCount"] ="";
      $_SESSION["grossAmount"]="";
      $_SESSION["booking_idd"]="";
      $_SESSION['username']="";
      $_SESSION['price']="";
      $_SESSION['pack_name'] ="";
      //echo "Salt is dead ...............................";
      }

?>