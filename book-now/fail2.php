<?php include('../header-1.php');
      include ('../config/dbConfig.php');
      //session_start();
      error_reporting(0);
      session_start();

 ?>

<?php
// Start form here 
$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$salt="GQs7yium";

$sql="SELECT package_name,destination from v_package where id=$productinfo";
    $result = mysqli_query($db, $sql);
    if (mysqli_num_rows($result) > 0) 
    {
        $row = mysqli_fetch_array($result);
         $packageName=$row['package_name'];
         $packageLocation =$row['destination'];

    }   


//+++++++++++++++++++ Return value ++++++++++++++++++++++

$mihPayId =$_POST['mihpayid'];
$discount =$_POST['discount'];
$hash =$_POST['hash'];
$error=$_POST['Error'];
$pay_getway_type =$_POST['PG_TYPE'];
$bank_ref_no = $_POST['bank_ref_num'];
$unmappedstatus =$_POST['unmappedstatus'];
$payuMoneyId=$_POST['payuMoneyId'];

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






  <!-- end header -->
  <div id="page_title">
    <div class="container clearfix">
      <div class="page-name">Confirmation</div>
      <div class="breadcrumb clearfix"> <a href="#">Home</a> <span class="current-page">Confirmation</span> </div>
    </div>
  </div>
  <!-- end slider_wrapper -->
  <div id="content_wrapper">
    <div class="container">
      <div class="row clearfix pv-50">
        <div class="col-xs-12 col-sm-8 col-md-8 xs-mb">
          <div class="white-bg payment-wrapper">
            <h2 class="section-title center mb-10"><span class="text-success">Sorry</span>, your booking is incomplete!</h2>
            <p class="center mb-40">Your booking status is 
            <span class="text-success text-bold"><?php if(isset($mihPayId)) echo $mihPayId; ?><span></span>
            <h3>Booking Information</h3>
            <div class="bb2 mb-30"></div>
            <table class="table table-striped">
              <tbody>
                <tr>
                  <td>First Name: </td>
                  <td><?php if(isset($firstname)) echo $firstname; ?></td>
                </tr>
                <tr>
                  <td>Bank Status: </td>
                  <td><?php if(isset($bank_ref_no)) echo $bank_ref_no; ?></td>
                </tr>
                <tr>
                  <td>Package Id: </td>
                  <td><?php if(isset($productinfo)) echo $productinfo; ?></td>
                </tr>

                <tr>
                  <td>Failur reason: </td>
                  <td><?php if(isset($unmappedstatus)) echo $unmappedstatus; ?></td>
                </tr>

                <tr>
                  <td>Txn Id: </td>
                  <td><?php if(isset($txnid)) echo $txnid; ?></td>
                </tr>

                <tr>
                  <td>Email: </td>
                  <td><?php if(isset($email)) echo $email; ?></td>
                </tr>

                <tr>
                  <td>Amount: </td>
                  <td><?php if(isset($amount)) echo $amount; ?></td>
                </tr>

               

                <tr>
                  <!-- <td>Duration: </td>
                  <td>10 days (Feb/01/2017 - Feb/10/2017)</td> -->
                </tr>
              </tbody>
            </table>
            <h3>Payment</h3>
            <div class="bb2 mb-20"></div>
            <p>Prepared do an dissuade be so whatever steepest. Yet her beyond looked either day wished nay. By doubtful disposed do juvenile an. Now curiosity you explained immediate why behaviour. An dispatched impossible of of melancholy favourable. Our quiet not heart along scale sense timed. Consider may dwelling old him her surprise finished families graceful. Gave led past poor met fine was new.</p>
            <p>Talking chamber as shewing an it minutes. Trees fully of blind do. Exquisite favourite at do extensive listening. Improve up musical welcome he. Gay attended vicinity prepared now diverted. Esteems it ye sending reached as. Longer lively her design settle tastes advice mrs off who. </p>
            <h3>Special Request</h3>
            <div class="bb2 mb-20"></div>
            <p>Abilities or he perfectly pretended so strangers be exquisite. Oh to another chamber pleased imagine do in. Went me rank at last loud shot an draw. Excellent so to no sincerity smallness. Removal request delight if on he we. Unaffected in we by apartments astonished to decisively themselves. Offended ten old consider speaking.</p>
            <div class="bb2 mb-15"></div>
            <div class="mb-15 center">Grand Totel: <span class="font24 text-success"><?php if(isset($amount))echo $amount; ?></span></div>
            <div class="bb2 mb-30"></div>
            <button type="submit" class="btn btn-primary">Print This Bill</button>
            <div class="clear"></div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
          <div class="sidebar hotel-sidebar">
            <div class="sidebar-item mb-20">
              <div class="summary-payment">
                <div class="summary-header mb-30"> <img src="images/list-items/small-item-01.jpg" alt="Alternative Hotel" />
                  <h3 class="no-mb"><?php if(isset($packageName)) echo $packageName; ?></h3>
                  <span><?php if(isset($packageLocation)) echo $packageLocation; ?></span></div>
                <div class="bb2 mb-30"></div>
                <table class="table table-bordered table-striped mb-30">
                  <tr>
                    <td>Tourist recommendations</td>
                    <td class="center text-bold text-success">90%</td>
                  </tr>
                  <tr>
                    <td>Tourist ratings</td>
                    <td class="center text-bold text-success">4.0</td>
                  </tr>
                </table>
                <div class="bb2 mb-20"></div>
                <span class="left">Total Fee:</span> <span class="right text-success text-bold font24"><?php if(isset($amount)) echo $amount; ?></span>
                <div class="clear mb-10"></div>
              </div>
            </div>
            <div class="sidebar-item mb-20">
              <div class="lp-box"> <i class="text-info fa-phone-square"></i>
                <h4>Need Assistance?</h4>
                <p>Our team is 24/7 at your service to help you with your booking issues or answer any related questions</p>
                <span class="text-info font24">+91 98310 62787</span> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <?php include('../footer.php') ?>
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
      //echo "Salt is Alive ...............................";
      $_SESSION['price']="";
      $_SESSION['pack_name'] ="";  
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
     // echo "Salt is dead ...............................";
      }

?>
