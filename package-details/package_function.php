<?php
//include('../config/dbConfig.php');

		function reviewCount2($p_id)
			{ 


				
/*TEST*/

/*
$dbHost = 'localhost';

$dbUsername = 'root';

$dbPassword = '1234';

$dbName = 'db_al_ameen';
 
 /*TEST*/

 /*---------------------------------------------------------------------------------*/

 /*PROD*/

 $dbHost = '148.72.232.175';

$dbUsername = 'alameen_kens';

$dbPassword = 'jFev42!5';

$dbName = 'db_al_ameen';

 /*PROD*/


				//Connect and select the database
				$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

				if ($db->connect_error) {
				    die("Connection failed: " . $db->connect_error);


//location for images

    
					}

				//$p_id=1;
				echo $db;
				echo "<br>";
				$sql="SELECT count(*) as rew FROM tbl_review WHERE package_id=".$p_id." ";
				echo $sql;
				echo "<br>";
				
					$result = mysqli_query($db,$sql);
				
					if (mysqli_num_rows($result) > 0)
		 			{
		 				$row=mysqli_fetch_row($result);	
		 				$revCount = $row['rew'];
		  				
		  			}
		  
	           	echo 'SQL  :'.$revCount;
				 //$revCount=2;
                return $revCount;
			}
	
?>