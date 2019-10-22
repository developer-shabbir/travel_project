 <?php 
  session_start();
  error_reporting(0);
 include('../header-1.php');
 include ('../config/dbConfig.php');

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
               
/*
              echo "rooms : " .$_SESSION["roomoption"];
              echo "pay : " .$_SESSION["payoption"] ;
              echo "payamount : " . $_SESSION["payamount"]  ;*/

$uname=$_SESSION['username'];
//echo "My Name is.........".$_SESSION['username'];
      if($_SESSION["username"]=="")
      {
        $uname="Guest";
      }
      else
      {
        $sql ="SELECT contact FROM tbl_customer where email='".$_SESSION['useremail']."'";
        //echo $sql;
        $result = mysqli_query($db,$sql);
        if (mysqli_num_rows($result) > 0) 
        {
        $row = mysqli_fetch_array($result);
        $_SESSION["usernumber"]=$row['contact'];
       

        }   


      }

?>

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

/*if($_POST['btnPayumoney'])
{

  echo "Ali";
}*/

?>
<div id="body_wrapper" class="full trip">

  <!-- end header -->
  <div id="page_title">
    <div class="container clearfix">
      <div class="page-name">Payment</div>
      <div class="breadcrumb clearfix"><a href="#">Home</a><span class="current-page">Payment</span> </div>
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
      <form name="payment_form" id="payment_form" method="POST" action="form_process3.php">
        <div class="col-xs-12 col-sm-8 col-md-8 xs-mb">
          <div class="white-bg payment-wrapper">
            <!-- <h3 class="section-title">Who's traveling? <span class="step active">1</span></h3> -->
            <div class="bb2 mb-20"></div>
            <!-- <p>Please tell us who will be checking in. Must be 18 or older. </p>
            <form role="form" class="row">
              <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="form-group">
                  <label for="first-name">First Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="first-name" placeholder="First Name">
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="form-group">
                  <label for="last-name">Last Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="last-name" placeholder="First Name">
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="form-group">
                  <label for="email-name">Email Address <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="email-name" placeholder="Email Address">
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="form-group">
                  <label for="email-comfirm-name">Confrim Email Address <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="email-comfirm-name" placeholder="Confrim Email Address">
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6 xs-mb">
                <label for="country-code">Country Code <span class="text-danger">*</span></label>
                <select class="form-control mySelectBoxClass" id="country-code">
                  <option selected>Thailand (+66)</option>
                  <option>Hong Kong (+852)</option>
                  <option>Indonesia (+62)</option>
                  <option>Italy (+39)</option>
                  <option>Kuwait (+965)</option>
                  <option>Malaysia (+60)</option>
                  <option>Netherlands (+31)</option>
                  <option>Norway (+47)</option>
                </select>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="form-group">
                  <label for="phone-number">Phone Number <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="phone-number" placeholder="Phone Number">
                </div>
              </div>
            </form> -->
            <h3 class="section-title mt-20">Select Payment gateway <span class="step">2</span></h3>
            <div class="bb2 mb-30"></div>
            <ul class="tabs">
            <!--   <li><a href="#payment-tab1">Credit Card</a></li>
              <li><a href="#payment-tab2">Paypal</a></li> -->
              <li><a href="#payment-tab3" class="active">PayUMoney</a></li>
             <!--  <li><a href="#payment-tab4">Billing Details</a></li> -->
            </ul>
            <!-- tabs -->
              <ul id="payment-tab" class="tabs-content xss-mb" style="padding: 20px 0">
<!--               <li id="payment-tab1"  class="active">
               
                <div class="form-horizontal" role="form">
                  <div class="clear"></div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-xs-12 col-sm-4 col-md-4 control-label">Credit Card Type: <span class="text-danger">*</span></label>
                    <div class="col-xs-12 col-sm-8 col-md-8">
                      <div class="styled-radio inline">
                        <label for="visa">
                        <input type="radio" id="visa" name="payments" checked >
                        <img src="images/credit-card/visa.png" alt="Visa" > </label>
                      </div>
                      <div class="styled-radio inline">
                        <label for="mastercard">
                        <input type="radio" id="mastercard" name="payments">
                        <img src="images/credit-card/mastercard.png" alt="Master Card" > </label>
                      </div>
                      <div class="styled-radio inline">
                        <label for="cirrus">
                        <input type="radio" id="cirrus" name="payments">
                        <img src="images/credit-card/cirrus.png" alt="Cirrus" > </label>
                      </div>
                      <div class="styled-radio inline">
                        <label for="amex">
                        <input type="radio" id="amex" name="payments">
                        <img src="images/credit-card/amex.png" alt="Amex" > </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-xs-12 col-sm-4 col-md-4 control-label">Credit Card Number: <span class="text-danger">*</span></label>
                    <div class="col-xs-12 col-sm-6 col-md-4">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="Credit Card Number">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-xs-12 col-sm-4 col-md-4 control-label">Expiration Date: <span class="text-danger">*</span></label>
                    <div class="col-xs-12 col-sm-3 col-md-3 xs-mb">
                      <select class="form-control mySelectBoxClass" id="country-code">
                        <option selected>Month</option>
                        <option>01 JAN</option>
                        <option>02 FEB</option>
                        <option>03 MAR</option>
                        <option>04 APR</option>
                        <option>05 MAY</option>
                        <option>06 JUN</option>
                        <option>07 JUL</option>
                        <option>08 AUG</option>
                        <option>09 SEP</option>
                        <option>10 OCT</option>
                        <option>11 NOV</option>
                        <option>12 DEC</option>
                      </select>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-2">
                      <select class="form-control mySelectBoxClass" id="country-code">
                        <option selected>Year</option>
                        <option>2013</option>
                        <option>2014</option>
                        <option>2015</option>
                        <option>2016</option>
                        <option>2017</option>
                        <option>2018</option>
                        <option>2019</option>
                        <option>2020</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-xs-12 col-sm-4 col-md-4 control-label">Card Identification Number: <span class="text-danger">*</span></label>
                    <div class="col-xs-12 col-sm-6 col-md-5">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="Card Identification Number">
                    </div>
                    <div class="col-xs-12 col-sm-2 col-md-3"> <span class="font12">What's this?</span> </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-xs-12 col-sm-4 col-md-4 control-label">Billing ZIP Code:: <span class="text-danger">*</span></label>
                    <div class="col-xs-12 col-sm-6 col-md-5">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="Billing ZIP Code">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-xs-12 col-sm-4 col-md-4 control-label">Cardholder Name: <span class="text-danger">*</span></label>
                    <div class="col-xs-12 col-sm-6 col-md-5">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="Card Identification Number">
                    </div>
                    <div class="col-xs-12 col-sm-2 col-md-3"> <span class="font12">(as it appears on the card)</span> </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-xs-12 col-sm-4 col-md-4 control-label">Coupon code: <span class="font12">(optional)</span></label>
                    <div class="col-xs-12 col-sm-6 col-md-5">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="If Your Have">
                    </div>
                  </div>
               
                </div>
              </li> -->
              <!-- <li id="payment-tab2" class="active">
                <div class="notification-box notification-box-warning mt-10 mb-20 active">
                  <p><strong>Important: </strong> You will be redirected to PayUmoney's website to securely complete your payment. </p>
                  <a href="#" class="notification-close notification-close-warning"><i class="fa-times"></i></a> </div>
                <a href="#" class="btn btn-primary btn-large">Proceed To PayUmoney</a> </li> -->

                 <li id="payment-tab3" class="active">
                <div class="notification-box notification-box-warning mt-10 mb-20">
                  <p><strong>Important: </strong> You will be redirected to PayUMoney's website to securely complete your payment. </p>
                  <a href="#" class="notification-close notification-close-warning"><i class="fa-times"></i></a> </div>
               <!--  <a href="#" class="btn btn-primary btn-large">Proceed To PayUMoney</a>  -->
                  <button type="submit" name="btnPayumoney" id="btnPayumoney" class="btn btn-primary btn-large">Proceed for Payment</button>
                </li>


                <!-- For Booking details -->
                <li id="payment-tab4">
                <!-- <div class="notification-box notification-box-warning mt-10 mb-20">
                  <p><strong>Important: </strong> You will be redirected to PayUMoney's website to securely complete your payment. </p>
                  <a href="#" class="notification-close notification-close-warning"><i class="fa-times"></i></a> </div> -->
                <!-- <a href="#" class="btn btn-primary btn-large">Proceed To PayUMoney</a> 
                  <button type="submit" name="btnPayumoney" id="btnPayumoney" class="btn btn-primary btn-large">Proceed To PayUMoney Here</button> -->

                  <?php  //echo "gross amt  ".$_SESSION["grossAmount"] ?>
                  <table hidden="hidden">
                    <tr>
                      <td>
                        txnid
                      </td>
                      <td>
                        <input type="text" name="txnid" id="txnid" value="<?php echo $txnid=rand(1000000000,9999999999); ?>">
                      </td>
                    </tr>

                    <tr>
                      <td>
                        Amount
                      </td>
                      <td>
                        <input type="text" name="amount" id="amount" value="<?php if(isset( $_SESSION["payamount"])) echo  $_SESSION["payamount"]; ?>">
                      </td>
                    </tr>

                    <tr>
                      <td>
                        Name
                      </td>
                      <td>
                        <input type="text" name="firstname" id="firstname" value="<?php if(isset($uname )) echo  $uname; ?>">
                      </td>
                    </tr>

                     <tr>
                      <td>
                        Email
                      </td>
                      <td>
                        <input type="hidden" name="email" id="email" value="<?php if(isset( $_SESSION["useremail"])) echo  $_SESSION["useremail"]; ?>">
                      </td>
                    </tr>

                    <tr>
                      <td>
                        Phone
                      </td>
                      <td>
                        <input type="text" name="phone" id="phone" value="<?php if(isset( $_SESSION["usernumber"])) echo  $_SESSION["usernumber"]; ?>">
                      </td>
                    </tr>


                    <tr>
                      <td>
                        Productinfo
                      </td>
                      <td>
                        <input type="text" name="productinfo" id="productinfo" value="<?php if(isset( $_SESSION["package_idd"])) echo  $_SESSION["package_idd"]; ?>">
                      </td>
                    </tr>

                    <tr>
                      <td>
                        Success Url
                      </td>
                      <td>
                        <input type="text" name="surl" id="surl" value="<?php echo $successURL; ?>" size="64">
                      </td>
                    </tr>


                    <tr>
                      <td>
                        Failure Url
                      </td>
                      <td>
                        <input type="text" name="furl" id="furl" value="<?php echo $failURL; ?>" size="64">
                      </td>
                    </tr>

                   <tr>
                      <td>
                        Address1
                      </td>
                      <td>
                        <input type="text" name="address1" id="address1" value="<?php if(isset( $_SESSION["booking_idd"])) echo  $_SESSION["booking_idd"]; ?>">
                      </td>
                    </tr>













                    <tr>
                      <td>
                        <input type="submit" name="btnPayumoney">
                      </td>
                      <td>
                        
                      </td>
                    </tr>

                   
                  </table>

                </li>

                <!-- End here -->
               
            </ul>







            <!-- <div class="clear"></div>
            <h3 class="section-title mt-20">Where should we send your confirmation? <span class="step">3</span></h3>
            <div class="bb2 mb-20"></div>
            <p>Please enter the email address where you would like to receive your confirmation.</p>
           <! <form class="form-horizontal" role="form"> -->
            <!-- <div class="form-horizontal" role="form">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Email Adress: <span class="text-danger">*</span></label>
                <div class="col-xs-12 col-sm-6 col-md-5">
                  <input type="email" class="form-control" id="inputEmail3" placeholder="Email Adress">
                </div>
              </div> -->
          <!--   </form> 
          </div> -->

            <!-- <div class="clear"></div>
            <h3 class="section-title mt-40">Review and book your trip <span class="step">4</span></h3>
            <div class="bb2 mb-20"></div>
            <div class="notification-box notification-box-info mb-20">
              <p>Important information about your booking:</p>
              <span class="font12">• This reservation is non-refundable and cannot be changed or canceled.</span> <a href="#" class="notification-close notification-close-info"><i class="fa-times"></i></a> </div>
            <div class="styled-checkbox mt-10">
              <label>
              <input type="checkbox" name="optionsCheckbox" id="optionsCheckbox1" value="option1">
              By selecting to complete this booking I acknowledge that I have read and accept the <a href="#" class="clblue">rules & 
              restrictions</a> <a href="#" class="clblue">terms & conditions</a> , and <a href="#" class="clblue">privacy policy</a>. </label>
            </div>
            <a href="#" class="btn btn-primary btn-large mt-10">COMPLETE BOOKING</a>
            <div class="clear"></div> -->
          </div>
        </div>
        </form>
        

                <div class="col-xs-12 col-sm-4 col-md-4">
          <div class="sidebar hotel-sidebar">
            <div class="sidebar-item mb-20">
              <div class="summary-payment">
                <div class="summary-header mb-30"><!--  <img src="images/list-items/small-item-01.jpg" alt="Alternative Hotel" /> -->
                   <h3 class="no-mb">Booking Summary</h3>
                  <!-- <span>Location, Country</span> <span class="rating-static rating-30"></span>  -->
                  </div>
                  <!--  -->
     
                <!--  -->

                <!-- test -->

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
            <div class="sidebar-item mb-20">
              <div class="lp-box"> <i class="text-info fa-phone-square"></i>
                <h4>Need Assistance?</h4>
                <p>Our team is 24/7 at your service to help you with your booking issues or answer any related questions</p>
                <span class="text-info font24">+91 98310 62787</span> </div>
            </div>
            <!-- <div class="sidebar-item mb-20">
              <div class="lp-box"> 
              <i class="text-info fa-lock"></i>
                <h4>Login</h4>
                <form role="form">
                  <div class="form-group">
                    <label for="show-login">Email / Username</label>
                    <input type="text" class="form-control" id="show-login" placeholder="Email / Username">
                  </div>
                  <div class="form-group">
                    <label for="show-password">Password</label>
                    <input type="password" class="form-control" id="show-password" placeholder="Password">
                  </div>
                  <div class="styled-checkbox">
                    <label>
                    <input type="checkbox" name="optionsCheckbox" id="optionsCheckbox1" value="option1">
                    Remember Me</a>. </label>
                  </div>
                  <div class="clear mb-15"></div>
                  <button type="submit" class="btn btn-primary">Login</button>
                  <div class="clear mb-10"></div>
                </form>
              </div>
            </div> -->
          </div>
        </div>













<!--         <div class="col-xs-12 col-sm-4 col-md-4">
          <div class="sidebar hotel-sidebar">
            <div class="sidebar-item mb-20">
              <div class="summary-payment">
                <div class="summary-header mb-30"> <img src="images/list-items/small-item-01.jpg" alt="Alternative Hotel" />
                  <h3 class="no-mb"><?php// if(isset($packageName)) echo $packageName; ?></h3>
                  <span>Location, Country</span> <span class="rating-static rating-30"></span> </div>
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
                <span class="left">Total Fee:</span> <span class="right text-success text-bold font24"><?php // if(isset( $_SESSION["grossAmount"])) echo  $_SESSION["grossAmount"]; ?></span>
                <div class="clear mb-10"></div>
              </div>
            </div>
            <div class="sidebar-item mb-20">
              <div class="lp-box"> <i class="text-info fa-phone-square"></i>
                <h4>Need Assistance?</h4>
                <p>Our team is 24/7 at your service to help you with your booking issues or answer any related questions</p>
                <span class="text-info font24">+1900 12 213 21</span> </div>
            </div>
            <! <div class="sidebar-item mb-20">
              <div class="lp-box"> <i class="text-info fa-lock"></i>
                <h4>Login</h4>
                <form role="form"> 
                <div role="form">
                  <div class="form-group">
                    <label for="show-login">Email / Username</label>
                    <input type="text" class="form-control" id="show-login" placeholder="Email / Username">
                  </div>
                  <div class="form-group">
                    <label for="show-password">Password</label>
                    <input type="password" class="form-control" id="show-password" placeholder="Password">
                  </div>
                  <div class="styled-checkbox">
                    <label>
                    <input type="checkbox" name="optionsCheckbox" id="optionsCheckbox1" value="option1">
                    Remember Me</a>. </label>
                  </div>
                  <div class="clear mb-15"></div>
                  <button type="submit" class="btn btn-primary">Login</button>
                  <div class="clear mb-10"></div>
                < </form> -->
                </div>
              </div> 
 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end content_wrapper -->

   <!-- Footer part with js files  -->
  <?php include('../footer.php') ?>
</div>

</body>
</html>
