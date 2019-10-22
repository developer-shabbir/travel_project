<?php include('../header-1.php');
      include ('../config/dbConfig.php');
      //session_start();
      error_reporting(0);
      session_start();
 function dateName($date) 
    {
        $result = "";
        $convert_date = strtotime($date);
        $month = date('F',$convert_date);
        $year = date('Y',$convert_date);
        //$name_day = date('l',$convert_date);
        $day = date('j',$convert_date);
        $result = $month . " " . $day . ", " . $year ;
        return $result;
             //$date_month_dd_YY = dateName($dep_date);
    }       

 ?>

<?php

              $departure_date = dateName($_SESSION["departure_date"]);    
              $arrival_date = dateName($_SESSION["arrival_date"]);
              $travelUserDate = dateName($_SESSION['travelUserDate']);
              $next_payment_due_date = dateName($_SESSION["next_payment_due_date"]);
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
$address1 =$_POST['address1'];

$sql="SELECT package_name,destination,price from v_package where id=$productinfo";
    $result = mysqli_query($db, $sql);
    if (mysqli_num_rows($result) > 0) 
    {
        $row = mysqli_fetch_array($result);
         $packageName=$row['package_name'];
         $packageLocation =$row['destination'];
         $price =$row['price'];
         $Passengers = $amount/$price;

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
$booking_id =$_SESSION['booking_idd'];


    $sql ="INSERT INTO tbl_transaction VALUES(DEFAULT,'$address1','$status','$firstname','$amount','$discount','$txnid','$key','$productinfo','$email','$mihPayId','$error','$pay_getway_type','$bank_ref_no','$unmappedstatus','$payuMoneyId',DEFAULT)";
      mysqli_query($db,$sql);
      //echo $sql;
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
      <!--  -->
        <div class="book-header clearfix">
          <div class="book-header-name"> 
          <p>
            <?php if(isset($_SESSION["useremail"])) echo "Your booking details will be sent to <strong> ".$_SESSION["useremail"]."</strong>"; ?> &nbsp; <?php if(isset( $_SESSION['usernumber'])) echo "and on your mobile <strong>" .$_SESSION['usernumber']."</strong>"; ?>
            
          </p>
          </div>

      
    </div>
  <!--  -->
      <div class="row clearfix pv-50">
        <div class="col-xs-12 col-sm-8 col-md-8 xs-mb">
          <div class="white-bg payment-wrapper">
            <h2 class="section-title center mb-10"><span class="text-success">Thank you</span>, your booking is complete!</h2>
            <p class="center mb-40">Your confirmation number is 
            <span class="text-success text-bold"><?php if(isset($mihPayId)) echo $mihPayId; ?><span></span>
            <h3>Booking Information</h3>
            <div class="bb2 mb-30"></div>
            <table class="table table-striped">
              <tbody>
                <tr>
                  <td>Name: </td>
                  <td><?php if(isset($firstname)) echo $firstname; ?></td>
                </tr>
                <tr>
                  <td>Email Id: </td>
                  <td><?php if(isset($email)) echo $email; ?></td>
                </tr>
                <tr>
                  <td>Package Id You Have Selected: </td>
                  <td><?php if(isset($productinfo)) echo $productinfo; ?></td>
                </tr>
                <tr>
                  <td>Package you have booked: </td>
                  <td><?php if(isset($packageName)) echo $packageName; ?></td>
                </tr>
               
                <tr>
                  <td>Bank Refference Id: </td>
                  <td><?php if(isset($bank_ref_no)) echo $bank_ref_no; ?></td>
                </tr>
                <tr>
                  <td>Booking Id: </td>
                  <td><?php if(isset($booking_id)) echo $booking_id; ?></td>
                </tr>
               
                

                <tr>
                  <!-- <td>Duration: </td>
                  <td>10 days (Feb/01/2017 - Feb/10/2017)</td> -->
                </tr>
              </tbody>
            </table>
            <h4>You have successfully submitted your booking!</h4>
            <div class="bb2 mb-20"></div>
            <p>Thank you for completing the registration. May Allahu Subhanahu Wa Ta’ala reward you for your intention to perform <?php if(isset($packageName)) echo $packageName; else echo 'PackageNameNIL';?> and may He grant you ease in this journey.</p>

            <h4>What’s next?</h4>
            <p>Your registration should be followed-up with a deposit to Al-Ameen which will confirm your space for <?php if(isset($packageName)) echo $packageName; else echo 'PackageNameNIL'; ?>. The Initial Deposit amount is 20% of total Package Price. per person.</br>
            <blockquote>
            Please make online bank transfer through NEFT/IMPS to Al-Ameen as details given below:<br/>
            Al-Ameen Tours & Travels  <br/>
            INDUSIND BANK LIMITED <br/>
            CURRENT ACCOUNT No.: 20099302202 <br/>
            IFSC CODE: INDB000515
            </blockquote>
            </p>
            <h4>What happens after payment?</h4>
            <div class="bb2 mb-20"></div>
            <p>After payment is received, we will send you a welcome package by email that includes your invoice, tentative itinerary, visa application, as well as all required documentation and additional information required from you.
            </p>
            <h4>When is the next payment due?</h4>
            <h4>Due within 7 days of booking: Initial deposit of 1,20,000 INR.</h4>
            <div class="bb2 mb-15"></div>
            <h3>Thank you for traveling with Al-Ameen Tours & Travels</h3>
            <p>We look forward to serving you during Hajj this year, may Allahu Suhanahu Wa Ta’ala help us all to gain His pleasure.</p>
            <h4>Al-Ameen Tours & Travels Team</br>
                List of required documents for your Hajj Visa:</h4>
                <div class="bb2 mb-15"></div>
            <div class="mb-15 center">Grand Totel: <span class="font24 text-success"><?php if(isset($amount))echo $amount; else echo 'N/A'; ?></span></div>
            <div class="bb2 mb-30"></div>
            <button type="submit" class="btn btn-primary">Print This Bill</button>
            <div class="clear"></div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
          <div class="sidebar hotel-sidebar">
          <!--  <div class="sidebar-item mb-20">
              <div class="summary-payment">
                <div class="summary-header mb-30"> <img src="images/list-items/small-item-01.jpg" alt="Alternative Hotel" />
                  <h3 class="no-mb"><?php// if(isset($packageName)) echo $packageName; ?></h3>
                  <span><?php// if(isset($packageLocation)) echo $packageLocation; ?></span></div>
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
                <span class="left">Total Fee:</span> <span class="right text-success text-bold font24"><?php //if(isset($amount)) echo $amount; ?></span>
                <div class="clear mb-10"></div>
              </div>
            </div> -->
            <!-- Side bar Start Salim -->
            <div class="sidebar-item mb-20">
              <div class="summary-payment">
                <div class="summary-header mb-30"><!--  <img src="images/list-items/small-item-01.jpg" alt="Alternative Hotel" /> -->
                <h3> <strong> Booking Summary</strong> </h3>
                 
                  <!-- <span>Location, Country</span> <span class="rating-static rating-30"></span>  -->
                  </div>
                 


            <!--  -->
              <p class="no-mb"><?php if(isset($_SESSION['pack_name'])) echo "<strong>" .$_SESSION['pack_name'] ."</strong>"; ?></p>
                    <div class="clear mb-10"></div>

                   <div class="lp-box"> <i class="text-info icon_calendar"></i>
                  <p><?php if(isset($_SESSION["departure_date"])) echo "Departure : <strong>". $departure_date."</strong>" ; ?> &nbsp; <br/> Return : <?php if(isset( $_SESSION["arrival_date"] )) echo  "<strong>" .$arrival_date."</strong>"; ?>
                  <br/>
                    <?php if(isset( $_SESSION['travelUserDate'])) echo  "Your selected travel date is : <strong>" .$travelUserDate."</strong>"; ?>
                    </p>
                    </div>
                    <div class="lp-box"> <i class="text-info fa-male"></i>
                    <p> Adults(<?php if(isset( $_SESSION["adultCount"])) echo  $_SESSION["adultCount"]; else echo "0"; ?>) &nbsp; Childs(<?php if(isset( $_SESSION["childCount"])) echo  $_SESSION["childCount"]; else echo "0"; ?>) 
                      </p>
                  </div>
                     <div class="clear mb-10"></div>
                     <div class="bb2 mb-30"></div>

                     <div class="lp-box"> <i class="text-info icon-hotel"></i>
                      <h4></i> Select ROOM Options</h4>
                      <p> You have selected :
                        <?php 
                        if( $_SESSION["roomoption"] == 1) 
                        echo  "QUAD ROOM"; 
                        if( $_SESSION["roomoption"] == 2) 
                        echo  "TRIPLE ROOM"; 
                        if( $_SESSION["roomoption"] == 3) 
                        echo  "DOUBLE ROOM"; 
                       

                        ?> 
                        
                      </p>
               <!--  -->

                <!--  -->
            <table class="table table-bordered table-striped mb-30">
                  <tr>
                    <td>Base Fair / Unit</td>
                    <td id="unitprice" class="center text-bold text-success">

                    <?php                         
                        if( $_SESSION["roomoption"] == 1) 
                        echo  $_SESSION["quad_price"]; 
                        if( $_SESSION["roomoption"] == 2) 
                        echo  $_SESSION["triple_price"]; 
                        if( $_SESSION["roomoption"] == 3) 
                        echo  $_SESSION["dual_price"];

                    ?>


                      

                    </td>
                  </tr>
                  <tr>
                    <td>Passengers</td>
                    <td id="noofpassengers" class="center text-bold text-success"><?php if(isset($_SESSION["totCount"])) echo $_SESSION["totCount"]; ?></td>
                  </tr>
                  <!-- tax -->

                    <tr>
                    <td>Taxes %</td>
                    <td id="tax" class="center text-bold text-success">0</td>
                  </tr>
                  <!--  -->
                  <tr>
                    <td>Total Price</td>
                    <td id="totalprice" class="center text-bold text-success">

                    <?php 
                        if( $_SESSION["roomoption"] == 1) 
                        echo  $_SESSION["quad_price"] * $_SESSION["totCount"]; 
                        if( $_SESSION["roomoption"] == 2) 
                        echo  $_SESSION["triple_price"] * $_SESSION["totCount"]; 
                        if( $_SESSION["roomoption"] == 3) 
                        echo  $_SESSION["dual_price"] * $_SESSION["totCount"]; 
                    ?>
                      
                    </td>
                  </tr>

                </table>
                <!--                             -->



                <div class="bb2 mb-20"></div>
                <!-- <span class="left">You Pay:</span>  -->
                <!-- <span class="right text-success text-bold"> -->
                <span class="text-success text-bold">
                <?php 
                if($_SESSION["payoption"] == "PART") 
                {
                  echo "You have chosen to make";
                  echo "</br>";
                  echo "PART payment : ". $_SESSION["payamount"];
                  echo "</br>";
                  echo "Next Due date is " . $next_payment_due_date;
                }
                  if($_SESSION["payoption"] == "FULL") 
                  {
                  echo "You have chosen to make";
                  echo "</br>";
                  echo "FULL payment : ". $_SESSION["payamount"];
                  }
                ?> 
                </span>
                                <div class="clear mb-10"></div>
              </div>
            </div>
              <!--  -->
            <!-- Side Bar End Salim -->
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
     // echo "Salt is Alive ...............................";
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
