<?php

$posted = array();
if(!empty($_POST)) {
    //print_r($_POST); //disabled code
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
    echo $posted[$key];
    echo "<br>";
	
  }
}

?>