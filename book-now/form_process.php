<?php
session_start();

$MERCHANT_KEY = "gtKFFx"; // test key

// Merchant Salt as provided by Payu
//$SALT = "JgX7sufwgr";
$SALT = "eCwWELxi";   // test salt key

$firstname =$_POST['firstname'];
$email =$_POST['email'];
$phone =$_POST['phone'];
$productinfo =$_POST['productinfo'];
$service_provider ="payUmoney";   //$_POST['service_provider'];
$amount =$_POST['amount'];
//$txnid =$_POST['txnid'];
$surl =$_POST['surl'];
$furl =$_POST['furl'];

/*$hashsq = $MERCHANT_KEY.'|'.$txnid.'|'.$amount.'|'.$productinfo.'|'.$firstname.'|'.$email.'|||||||||||'.$$SALT;
echo $hashsq;
echo "<br>";

$hash=strtolower(hash("sha512",$hashsq));
//$hash = strtolower(hash('sha512', $hash_string));
echo $hash;*/


//--------- new  code start here -------------

$PAYU_BASE_URL = "https://test.payu.in"; // test url
$formError = 0;
$action = '';

if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
		  || empty($posted['service_provider'])
  ) {
    $formError = 1;
  } else {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
	$hashVarsSeq = explode('|', $hashSequence);

  
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
    $action="test2.php";
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
  //$action="test2.php";
}


//----------- end here --------------



?>

<!DOCTYPE html>
<html>
<head>
	<title></title>

	<script type="text/javascript">
	
	function submitForm()
	{
		var postForm= document.forms.postForm;
		postForm.submit();
	}


</script>
</head>
<body onload="submitForm();">
<form name="postForm" action="test2.php" method="POST">
<!-- http://test.payu.in/_payment -->
<input type="text" name="key" value="<?php echo $MERCHANT_KEY; ?>">
<input type="text" name="hash" value="7d6490fbb94f4960a136cb98c23c95273c47d3675963f688d41cc86bb77f477cc3f521794574bfda426f426ddae11ff184f4447baa97b4806ccb66d36188e9c7">
<input type="text" name="txnid" value="<?php echo $txnid; ?>">

<input type="text" name="amount" value="<?php echo $amount; ?>">
<input type="text" name="firstname" value="<?php echo $firstname; ?>">
<input type="text" name="email" value="<?php echo $email; ?>">
<input type="text" name="phone" value="<?php echo $phone; ?>">
<input type="text" name="productinfo" value="<?php echo $productinfo; ?>">
<input type="text" name="surl" value="<?php echo $surl; ?>">
<input type="text" name="furl" value="<?php echo $furl; ?>">
<input type="text" name="service_provider" value="payUmoney" size="64" />








<!-- <input type="text" name="service_provider" value="payUmoney" size="64" /> -->



	

</form>

</body>
</html>

