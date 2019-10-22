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

if(empty($post['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $post['txnid'];
}
$hash = '';

    $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|"
                    ."udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
    $hashVarsSeq  = explode('|', $hashSequence);
    $hashString   = '';  
    foreach ($hashVarsSeq as $hashVar) {
        $hashString .= isset($payObject['params'][$hashVar]) ? $payObject['params'][$hashVar] : '';
        $hashString .= '|';
    }
    $hashString .= $salt;
    //generate hash
    $hash = strtolower(hash('sha512', $hashString));
















//$hash=strtolower(sha512($key.'|'.$txnid.'|'.$amount.'|'.$productinfo.'|'.$firstname.'|'.$email.'||||||||||'.$SALT))






/*// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($post['hash']) && sizeof($post) > 0) {
  if(
          empty($post['key'])
          || empty($post['txnid'])
          || empty($post['amount'])
          || empty($post['firstname'])
          || empty($post['email'])
          || empty($post['phone'])
          || empty($post['productinfo'])
          || empty($post['surl'])
          || empty($post['furl'])
		  || empty($post['service_provider'])
  ) {
    $formError = 1;
  } else {
    //$post['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
	$hashVarsSeq = explode('|', $hashSequence);

  
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($post[$hash_var]) ? $post[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
    $action="test2.php";
  }
} elseif(!empty($post['hash'])) {
  $hash = $post['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
  //$action="test2.php";
}*/


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
<input type="text" name="hash" value="<?php echo $hash; ?>">
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

