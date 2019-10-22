<?php
 include('../config/dbConfig.php');
$name=trim($_GET["name"]);
$email=trim($_GET["email"]);
$pkg_id = trim($_GET["pkg_id"]);
$comment = trim($_GET["comm"]);
$rate = trim($_GET["rate"]);
$title = trim($_GET["title"]);
/*echo "Your name ".$name;
echo "<br>";
echo "Your email ".$email;
echo "<br>";
echo "package id".$pkg_id;
echo "<br>";
echo "comment".$comment;*/
$revD =date('Y-m-d h:i:s'); // for am/pm
//$revD =date('Y-m-d h:i:sa');
/*echo "<br>";
echo "date ".$revD;*/

$sql ="INSERT INTO tbl_review(rev_date,package_id,name,email,rev_comment,rating,title) values('$revD',$pkg_id,'$name','$email','$comment',$rate,'$title')" ;
//echo $sql;
if($result = mysqli_query($db,$sql))
{
	echo "Thank you for your reivew";

}
else
{
	echo "There are some errors";
}




//exit();
?>  