<?php
session_start();
 error_reporting(0);
//$_SESSION["payamount"] = $_GET['payamt'];

 				$folder = 	$_POST['folder'];

    			$path = "../../images/Hotel/" . $folder ."/*.*" ;
                //echo $path;


                  $files = glob($path);


                  //echo 'Count :'.count($files);
       /*         for ($i=0; $i<count($files); $i++)
                  {
                    $image_src = $files[$i];
                }*/

                   echo json_encode($files) ;

			  //  echo "folder : ". $files;

?>