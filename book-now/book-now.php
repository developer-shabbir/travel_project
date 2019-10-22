 <?php

 session_start();
 error_reporting(0);

include('../header-1.php');
include ('../config/dbConfig.php');
$_SESSION['dLocation'] = $_REQUEST['dLocation'];
//echo '222222222222222'.$_SESSION['dLocation'];

$quad_price = 365000;
$triple_price = 405000;
$dual_price = 485000; 

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
function sendMailTo2($domainId,$subj,$msg,$fromM)
            {


              try {
                  $frm="From:" . $fromM;
                   if (mail($domainId,$subj,$msg,$frm))
                   {
                      $er="Mail Send To ". $email;
                    }
                   else
                    {
                    $er="Mail Not SenD.";

                    }
                  }

//catch exception
        catch(Exception $e) 
              {
               
                //echo 'Message: ' .$e->getMessage();
              }
                  
            }
 ?>

<?php



      $cat_id =$_GET['pack_id'];

      $date_id =$_GET['date_id'];  //get date_id

      // ++++++++++++++++++++ Clear session value of booking details +++++++++++++++++
    /*  $_SESSION["packageDate"]="";
      $_SESSION["travelUserDate"]="";
      $_SESSION["adultCount"] ="";
      $_SESSION["childCount"] = "";
      $_SESSION["useremail"] = "";
      $_SESSION["usernumber"] = "";
      $_SESSION["totCount"] ="";
      $_SESSION["grossAmount"]="";*/
      // +++++++++++++++++++++++++++++ End Here ++++++++++++++++++++++++++++++++++++++


        /*echo "package date".$_SESSION["packageDate"];
      echo "<br>";
      echo "travel Date ".$_SESSION["travelUserDate"];
      echo "<br>";
      echo "adult ".$_SESSION["adultCount"];
      echo "<br>";
      echo "child". $_SESSION["childCount"];
      echo "<br>";
      echo "user mail ".$_SESSION["useremail"];
      echo "<br>";
      echo "mobile No.".$_SESSION["usernumber"];
      echo "<br>";
      echo "passengers".$_SESSION["totCount"] ;
      echo "-----------------------------------------";
*/
      //session_start();

      // if($_SESSION["packageDate"]==""){ // for unregistered user 

     // echo "id : " .$_SESSION["packageDate"];
    //  echo "travel date: ". $_SESSION["travelUserDate"];

        if($_POST['usernumber']!="")
        {
          
         
          $_SESSION["useremail"] = $_POST['useremail'];
          $_SESSION["usernumber"] = $_POST['usernumber'];
          $_SESSION["packageDate"] = $_POST['packageDate'];
          $_SESSION["travelUserDate"] = $_POST['travelUserDate'];
          $_SESSION["adultCount"] = $_POST['passAdult'];
          $_SESSION["childCount"] = $_POST['passChild'];

        //  echo "adultCount : "  .$_SESSION["adultCount"];

        }

        else
        {
        //   echo "pak date ".$_SESSION["packageDate"];
          if (($_SESSION["packageDate"])=="")
          {
          $_SESSION["packageDate"] = $_POST['packageDate'];
         
          $_SESSION["travelUserDate"] = $_POST['travelUserDate'];
          $_SESSION["adultCount"] = $_POST['passAdult'];
          $_SESSION["childCount"] = $_POST['passChild'];
        }

         // echo "else adultCount : "  .$_SESSION["adultCount"];

        }

          

    //echo "id1 : " .$_SESSION["packageDate"];



      /*if(($_SESSION['salt'])==""){

        echo "111111111111111111111";
      $_SESSION["packageDate"] = $_POST['packageDate'];
      $_SESSION["travelUserDate"] = $_POST['travelUserDate'];
      $_SESSION["adultCount"] = $_POST['passAdult'];
      $_SESSION["childCount"] = $_POST['passChild'];
     
      $_SESSION["useremail"] = $_POST['useremail'];
      $_SESSION["usernumber"] = $_POST['usernumber'];
       
   }

      $_SESSION["packageDate"] = $_POST['packageDate'];
      $_SESSION["travelUserDate"] = $_POST['travelUserDate'];
      $_SESSION["adultCount"] = $_POST['passAdult'];
      $_SESSION["childCount"] = $_POST['passChild'];*/
      




      // For registered user
      if($_SESSION["packageDate"]=="")
      {
        $_SESSION["packageDate"]=$_GET['pack_date'];
      }
      if($_SESSION["travelUserDate"]=="")
      {
        $_SESSION["travelUserDate"]=$_GET['pack_date'];
      }

      //echo "No. of passengers ".$_SESSION["totCount"];
      if($_SESSION["useremail"] =="")
      {
        $_SESSION["useremail"]=$_GET['user'];

      }
      if( $_SESSION["adultCount"]=="")
      {
         $_SESSION["adultCount"] = $_GET['adult'];
      }
      if($_SESSION["childCount"]=="") 
      {
         $_SESSION["childCount"] =$_GET['child'];
      }

      /*date_id*/

  
        /*date_id*/


      $_SESSION["totCount"] =   $_SESSION["childCount"] + $_SESSION["adultCount"];

 //    echo "email id........... ".$_SESSION["useremail"];

      

      if(isset($cat_id)) //this is package id
          {

            $sql="SELECT * from v_package WHERE id= $cat_id ";
            //echo $sql;
            $result = mysqli_query($db, $sql);
            if (mysqli_num_rows($result) > 0) 
              {
                  $row = mysqli_fetch_array($result);
                  $packageName=$row['package_name'];
                  $packagePrice=$row['price'];

                  $category_id =$row['category_id'];   // add category on 09/05

                  $_SESSION['price']= $packagePrice;
                  $_SESSION['pack_name'] =$packageName;

                  /*double and triple rom price from table*/

                     $dual_price = $row['double_room'];

                      $triple_price = $row['triple_room'];
                  /**/

              }  
            $_SESSION["grossAmount"] = $_SESSION["totCount"] * $packagePrice;

            /*  pay amount*/

            
            /**/


            /*  echo "No. of user.".$_SESSION["totCount"];
              echo "<br>";
              echo "price .. ".$packagePrice;*/

            //echo "package  ".$packageName;
            //echo "Price :".$packagePrice;

        

              $d_id = $_SESSION["packageDate"];

             // echo $d_id;
              $sql1="SELECT departure_date, arrival_date FROM tbl_package_date 
              WHERE id = $d_id";

              $result1 = mysqli_query($db,$sql1);
              $row1=mysqli_fetch_row($result1);


              $_SESSION["departure_date"] = $row1[0];
              $_SESSION["arrival_date"] = $row1[1];



              $departure_date = dateName($_SESSION["departure_date"]);    
              $arrival_date = dateName($_SESSION["arrival_date"]);
              $travelUserDate = dateName($_SESSION['travelUserDate']);

              //echo "date" . $departure_date;

              /**/
            $_SESSION["quad_price"] =  $_SESSION['price'];
            $_SESSION["triple_price"] =  $triple_price;
            $_SESSION["dual_price"] =  $dual_price;

              //calculate default payment amount which is 20 %
            $_SESSION["payamount"] = $_SESSION["quad_price"] * $_SESSION["totCount"]*0.2;
              /**/

         
          }
      else
          {
            echo  "Technical Problem Please contact Developer.";
          }


     /* echo "package date".$_SESSION["packageDate"];
      echo "<br>";
      echo "travel Date ".$_SESSION["travelUserDate"];
      echo "<br>";
      echo "adult ".$_SESSION["adultCount"];
      echo "<br>";
      echo "child". $_SESSION["childCount"];
      echo "<br>";
      echo "user mail ".$_SESSION["useremail"];
      echo "<br>";
      echo "mobile No.".$_SESSION["usernumber"];
      echo "<br>";
      echo "passengers".$_SESSION["totCount"] ;*/


/*--------------------------payable amount testing---------------------------*/
    if(isset($_POST['gotest']))
        {





  /*        if(isset($_POST) && $_POST['pay_option'] == "1")
          {

             //$_SESSION["payamount"]  = 0;
       

           }
          if(isset($_POST) && $_POST['pay_option'] == "2")
          {

             //$_SESSION["payamount"]  = 100;
        

           }*/

           echo "payable amount : " . $_SESSION["payamount"];

        }

/*-----------------------------------------------------*/        
$_SESSION["package_idd"] = $cat_id;
$_SESSION["booking_idd"] =0;

      if(isset($_POST['btnCnfBook']))
        {

              /*check payment aount*/

              echo "payable amount : " . $_SESSION["payamount"];

              if ($_SESSION["payamount"] == "")
              {
                echo "<script>alert('Please select PAYMENT OPTION')</script>";
              }
              else
              {
                //echo "<script>alert('PAYMENT OPTION selected')</script>";
              }
              /**/

                if (isset($_POST['optroom']) && $_POST['optroom'] == '1')
                  {$_SESSION["roomoption"] = 1;$room_option= "QUAD";}
                if (isset($_POST['optroom']) && $_POST['optroom'] == '2')
                  {$_SESSION["roomoption"] = 2; $room_option= "TRIPLE";}
                if (isset($_POST['optroom']) && $_POST['optroom'] == '3')
                  {$_SESSION["roomoption"] = 3;$room_option= "DOUBLE";}


                 if (isset($_POST['pay_option']) && $_POST['pay_option'] == '1')
                  {$_SESSION["payoption"] = "PART";$payment_option = "PART";}
                  if (isset($_POST['pay_option']) && $_POST['pay_option'] == '2')
                  {$_SESSION["payoption"] = "FULL";$payment_option = "FULL";}

                                /**/
                switch ($room_option) {
                        case "QUAD":
                            
                          if ($payment_option == "PART")
                            $_SESSION["payamount"] = $_SESSION["quad_price"] * $_SESSION["totCount"]*0.2;
                          else
                            $_SESSION["payamount"] =$_SESSION["quad_price"] * $_SESSION["totCount"];
                            break;
                        case "TRIPLE":
                          if ($payment_option == "PART")
                            $_SESSION["payamount"] = $_SESSION["triple_price"] * $_SESSION["totCount"]*0.2;
                          else
                            $_SESSION["payamount"] =$_SESSION["triple_price"] * $_SESSION["totCount"];
                            break;
                        case "DOUBLE":
                          if ($payment_option == "PART")
                            $_SESSION["payamount"] = $_SESSION["dual_price"] * $_SESSION["totCount"]*0.2;
                          else
                            $_SESSION["payamount"] =$_SESSION["dual_price"] * $_SESSION["totCount"];
                            break;
                        default:
                            echo "Please select ROOM options!";
                            }
                        
                        $payment_amount = $_SESSION["payamount"];

                       //ssh echo "payable amount 1: " . $_SESSION["payamount"];


                /**/

                      



                        if( $_SESSION["roomoption"] == 1)                         
                        $p_unit_price =   $_SESSION["quad_price"]; 

                          
                        if( $_SESSION["roomoption"] == 2) 
                         $p_unit_price =  $_SESSION["triple_price"]; 
                        if( $_SESSION["roomoption"] == 3) 
                         $p_unit_price =  $_SESSION["dual_price"];

                    $p_gross_price  = $p_unit_price * $_SESSION["totCount"];

                    $p_tax = 0;
                    $p_discount = 0;

                    $p_total_price =  ($p_gross_price + $p_tax) - $p_discount;
                 

                      $ex_location  = 'Kolkata';   //populate it dynamically

                      
                  /*echo "user nameeeeee".$_SESSION["useremail"];
                  echo "<br>";
                  echo "package date".$_SESSION["packageDate"];
                  echo "<br>";
                  echo "travel Date ".$_SESSION["travelUserDate"];
                  echo "<br>";*/
                  //exit();
                  date_default_timezone_set('Asia/Kolkata');
                  $booking_date = date('Y-m-d');
                  $next_payment_due_date = date('Y-m-d',strtotime('+1 week'));

                  $_SESSION["next_payment_due_date"]  = $next_payment_due_date;
                   // echo  "next due : ".$next_payment_due_date;
                 

                  //echo "booking date : ". $booking_date;

                  

             $sql="";
            if($_SESSION["travelUserDate"]!="")
              {



                $y = date('Y-m-d', strtotime($_SESSION["travelUserDate"])); 

                //$y = null;

                $sql ="INSERT INTO tbl_booking_details(user_id,package_id,
                        user_email,
                        user_phone,
                        booking_date,
                        booking_status,

                        depature_date,
                        arrival_date,
                        ex_location,
                        
                        p_unit_price,
                        p_gross_price,
                        
                        p_tax,p_discount,
                        
                        p_total_price,
                        user_selected_date,
                        no_of_passengers,
                        payment_option,
                        payment_amount,
                        next_payment_due_date,
                        room_option )
                      values(1,'".$cat_id."',
                        '". $_SESSION['useremail']."',
                        '".$_SESSION['usernumber']."',
                        '". $booking_date."',
                        'Y',
                        '".$_SESSION['departure_date']."',
                        '". $_SESSION['arrival_date']."',
                        '".$_SESSION['dLocation']."',
                        '".$p_unit_price."',
                        '".$p_gross_price."',
                        '".$p_tax."',
                        '".$p_discount."',
                        
                        '".$p_total_price."',
                        '". $y ."',
                        '".$_SESSION["totCount"]."' ,
                        '".$payment_option."',
                        '".$payment_amount."',
                        '".$next_payment_due_date."',
                        '".$room_option."')";

              }
              else
              {
                $sql ="INSERT INTO tbl_booking_details(user_id,package_id,
                                                user_email,
                        user_phone,
                        booking_date,
                        booking_status,

                        depature_date,
                        arrival_date,
                        ex_location,
                        
                        p_unit_price,
                        p_gross_price,
                        
                        p_tax,p_discount,
                        
                        p_total_price,
                        
                        no_of_passengers,
                        payment_option,
                        payment_amount,
                        next_payment_due_date,
                        room_option )
                      values(1,'".$cat_id."',
                        '". $_SESSION['useremail']."',
                        '".$_SESSION['usernumber']."',
                        '". $booking_date."',
                        'Y',
                        '".$_SESSION['departure_date']."',
                        '". $_SESSION['arrival_date']."',
                        '".$_SESSION['dLocation']."',
                        '".$p_unit_price."',
                        '".$p_gross_price."',
                        '".$p_tax."',
                        '".$p_discount."',
                        
                        '".$p_total_price."',
                        
                        '".$_SESSION["totCount"]."' ,
                        '".$payment_option."',
                        '".$payment_amount."',
                        '".$next_payment_due_date."',
                        '".$room_option."')";
              }
              mysqli_query($db,$sql);



              
/*              echo "sql error" .  mysqli_error($db);
              echo "<br>";
              echo "sql error" .  mysqli_errno($db);
              echo "<br>";
               echo $sql;
           
              echo "<br>" ;
              echo  "Price".$packagePrice;*/


              $sql ="SELECT MAX(id) FROM tbl_booking_details WHERE id IS NOT NULL";
              $result = mysqli_query($db,$sql);
               if (mysqli_num_rows($result) > 0) 
              {
                  $row = mysqli_fetch_array($result);
                  $b_id=$row[0];
                  $_SESSION["booking_idd"] =$b_id;


              }  
              else
              {
                $b_id=1;
              }

          
          for($x = 1; $x <= $_SESSION["totCount"]; $x++) 
            {

              $sql="INSERT INTO tbl_passenger_details (booking_id,p_title,p_fname,p_mname,p_lname) values('".$b_id."','".$_POST['title_code'.$x]."','".$_POST['first_name'.$x]."','".$_POST['middel_name'.$x]."','".$_POST['last_name'.$x]."')" ;
              mysqli_query($db,$sql);

              // booking detail

            }

/*syed*/      
              
              ?>
                <script type="text/javascript">
                window.location = "travel-payment.php";
                </script>      
              

              <?php 


              /*syed*/

        }


         if(isset($_POST['btnCnfBook1']))
         {
                          if (isset($_POST['optroom']) && $_POST['optroom'] == '1')
                  {$_SESSION["roomoption"] = 1;$room_option= "QUAD";}
                if (isset($_POST['optroom']) && $_POST['optroom'] == '2')
                  {$_SESSION["roomoption"] = 2; $room_option= "TRIPLE";}
                if (isset($_POST['optroom']) && $_POST['optroom'] == '3')
                  {$_SESSION["roomoption"] = 3;$room_option= "DOUBLE";}


                 if (isset($_POST['pay_option']) && $_POST['pay_option'] == '1')
                  {$_SESSION["payoption"] = "PART";$payment_option = "PART";}
                  if (isset($_POST['pay_option']) && $_POST['pay_option'] == '2')
                  {$_SESSION["payoption"] = "FULL";$payment_option = "FULL";}

                /**/
                switch ($room_option) {
                        case "QUAD":
                            
                          if ($payment_option == "PART")
                            $_SESSION["payamount"] = $_SESSION["quad_price"] * $_SESSION["totCount"]*0.2;
                          else
                            $_SESSION["payamount"] =$_SESSION["quad_price"] * $_SESSION["totCount"];
                            break;
                        case "TRIPLE":
                          if ($payment_option == "PART")
                            $_SESSION["payamount"] = $_SESSION["triple_price"] * $_SESSION["totCount"]*0.2;
                          else
                            $_SESSION["payamount"] =$_SESSION["triple_price"] * $_SESSION["totCount"];
                            break;
                        case "DOUBLE":
                          if ($payment_option == "PART")
                            $_SESSION["payamount"] = $_SESSION["dual_price"] * $_SESSION["totCount"]*0.2;
                          else
                            $_SESSION["payamount"] =$_SESSION["dual_price"] * $_SESSION["totCount"];
                            break;
                        default:
                            echo "Please select ROOM options!";
                            }
                        
                        $payment_amount = $_SESSION["payamount"];

                /**/

                        if( $_SESSION["roomoption"] == 1)                         
                        $p_unit_price =   $_SESSION["quad_price"]; 

                          
                        if( $_SESSION["roomoption"] == 2) 
                         $p_unit_price =  $_SESSION["triple_price"]; 
                        if( $_SESSION["roomoption"] == 3) 
                         $p_unit_price =  $_SESSION["dual_price"];

                    $p_gross_price  = $p_unit_price * $_SESSION["totCount"];

                    $p_tax = 0;
                    $p_discount = 0;

                    $p_total_price =  ($p_gross_price + $p_tax) - $p_discount;

                    $ex_location  = 'Kolkata';
                 


                  /*echo "user nameeeeee".$_SESSION["useremail"];
                  echo "<br>";
                  echo "package date".$_SESSION["packageDate"];
                  echo "<br>";
                  echo "travel Date ".$_SESSION["travelUserDate"];
                  echo "<br>";*/
                  //exit();
                  date_default_timezone_set('Asia/Kolkata');
                  $booking_date = date('Y-m-d');
                  $next_payment_due_date = date('Y-m-d',strtotime('+1 week'));
                   // echo  "next due : ".$next_payment_due_date;
                 

                  //echo "booking date : ". $booking_date;

                  

             $sql="";
            if($_SESSION["travelUserDate"]!="")
              {



                $y = date('Y-m-d', strtotime($_SESSION["travelUserDate"])); 

                //$y = null;

                $sql ="INSERT INTO tbl_booking_details(user_id,package_id,
                        user_email,
                        user_phone,
                        booking_date,
                        booking_status,

                        depature_date,
                        arrival_date,
                        ex_location,
                        
                        p_unit_price,
                        p_gross_price,
                        
                        p_tax,p_discount,
                        
                        p_total_price,
                        user_selected_date,
                        no_of_passengers,
                        payment_option,
                        payment_amount,
                        next_payment_due_date,
                        room_option )
                      values(1,'".$cat_id."',
                        '". $_SESSION['useremail']."',
                        '".$_SESSION['usernumber']."',
                        '". $booking_date."',
                        'Y',
                        '".$_SESSION['departure_date']."',
                        '". $_SESSION['arrival_date']."',
                        '".$_SESSION['dLocation']."',
                        '".$p_unit_price."',
                        '".$p_gross_price."',
                        '".$p_tax."',
                        '".$p_discount."',
                        
                        '".$p_total_price."',
                        '". $y ."',
                        '".$_SESSION["totCount"]."' ,
                        '".$payment_option."',
                        '".$payment_amount."',
                        '".$next_payment_due_date."',
                        '".$room_option."')";

              }
              else
              {
                $sql ="INSERT INTO tbl_booking_details(user_id,package_id,
                                                user_email,
                        user_phone,
                        booking_date,
                        booking_status,

                        depature_date,
                        arrival_date,
                        ex_location,
                        
                        p_unit_price,
                        p_gross_price,
                        
                        p_tax,p_discount,
                        
                        p_total_price,
                        
                        no_of_passengers,
                        payment_option,
                        payment_amount,
                        next_payment_due_date,
                        room_option )
                      values(1,'".$cat_id."',
                        '". $_SESSION['useremail']."',
                        '".$_SESSION['usernumber']."',
                        '". $booking_date."',
                        'Y',
                        '".$_SESSION['departure_date']."',
                        '". $_SESSION['arrival_date']."',
                        '".$_SESSION['dLocation']."',
                        '".$p_unit_price."',
                        '".$p_gross_price."',
                        '".$p_tax."',
                        '".$p_discount."',
                        
                        '".$p_total_price."',
                        
                        '".$_SESSION["totCount"]."' ,
                        '".$payment_option."',
                        '".$payment_amount."',
                        '".$next_payment_due_date."',
                        '".$room_option."')";
              }
              mysqli_query($db,$sql);



              
/*      ssh        echo "sql error" .  mysqli_error($db);
              echo "<br>";
              echo "sql error" .  mysqli_errno($db);
              echo "<br>";
               echo $sql;
           
              echo "<br>" ;
              echo  "Price".$packagePrice;*/


              $sql ="SELECT MAX(id) FROM tbl_booking_details WHERE id IS NOT NULL";
              $result = mysqli_query($db,$sql);
               if (mysqli_num_rows($result) > 0) 
              {
                  $row = mysqli_fetch_array($result);
                  $b_id=$row[0];
                  $_SESSION["booking_idd"] =$b_id;


              }  
              else
              {
                $b_id=1;
              }

          
          for($x = 1; $x <= $_SESSION["totCount"]; $x++) 
            {

              $sql="INSERT INTO tbl_passenger_details (booking_id,p_title,p_fname,p_mname,p_lname) values('".$b_id."','".$_POST['title_code'.$x]."','".$_POST['first_name'.$x]."','".$_POST['middel_name'.$x]."','".$_POST['last_name'.$x]."')" ;
              mysqli_query($db,$sql);

              // booking detail

            }
         
         
         ?>
                <script type="text/javascript">
                window.location = "reg_confirmation.php";
                </script>      
              

              <?php  

              /*syed*/

        }



?>




<div id="body_wrapper" class="full trip">

  <!-- end header -->
  <div id="page_title">
    <div class="container clearfix">
      <div class="page-name">Booking Details And Package Summary</div>
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
        <div class="col-xs-12 col-sm-8 col-md-8 xs-mb">
          <div class="white-bg payment-wrapper">
            <h3 class="section-title">Who's traveling? </h3>
            <div class="bb2 mb-20"></div>
            <p>Please tell us who will be checking in.</p>

           <!--  <form name="frm-booking" id="frm-booking" method="POST" action="../payment/travel-payment.php"> -->
            <form name="frm-booking" id="frm-booking" method="POST" action="">
            
            <!-- <form id="frm_booking"> -->

           
            <?php for($x = 1; $x <= $_SESSION["totCount"]; $x++) {  ?>
           <!--  //{ //<!-loop to generate no of passengers --> 
             
                <!--  if($x==0) 
                   {
                    echo "<br>";
                    echo "<div>Adult </div>";
                    echo "<div class='bb2 mb-30'></div>";
                   }
                if($_SESSION["adultCount"]==$x)
                   {
                   // echo "<br>";
                    echo "<div>Child </div>";
                    echo "<div class='bb2 mb-30'></div>";
                   }
                  //echo "Ali";
                 // echo "<div class='bb2 mb-30'></div>";
                   //include('demo.php');
                   //echo '<br/>';
 -->
                 
            <div id="passengerField" name="passengerField">
              <div class="col-xs-12 col-sm-6 col-md-2">
                <div class="form-group">
                 <!--  <p>Adult</p> -->
                <label required for="title-code">Title <span class="text-danger">*</span></label>
                      <select class="form-control mySelectBoxClass" id="title_code<?php echo $x; ?>" name="title_code<?php echo $x; ?>" required >
                        <option value="" selected>Title</option>
                        <option>Mr.</option>
                        <option>Mrs.</option>
                        <option>Ms.</option>
                      </select>
                  </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="form-group">
                  <label for="first-name">First Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="first_name<?php echo $x; ?>" name="first_name<?php echo $x; ?>" placeholder="First Name" required>
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="form-group">
                  <label for="middel-name">Middle Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="middel_name<?php echo $x; ?>" name="middel_name<?php echo $x; ?>" placeholder="middel Name">
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="form-group">
                  <label for="last-name">Last Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="last_name<?php echo $x; ?>" name="last_name<?php echo $x; ?>" placeholder="First Name" required>
                </div>
              </div>
              </div>

            <?php } ?> 


            
            <!-- <input type="submit" class="btn btn-primary btn-large mt-10 " name="btnCnfBook" id="btnCnfBook" value="PROCEED"> -->

            <div>

           
           <!--  <div class="bb2 mb-10"></div> -->
            <div class="clear"></div>
            <h4>Terms and Conditions *</h4>
             <div class="bb2 mb-20"></div>
            <label><input type="radio" name="trems_cond1" required><?php echo " I Agree to the terms"?>
            <a href="#" onclick="window.open('agreement.php','newwindow','width=400, height=500'); return false;">Terms and Conditions</a></label></br>


            <input type="submit" class="btn btn-primary btn-large mt-10 " name="btnCnfBook" id="btnCnfBook" value="PAY NOW" >

            </div><br/>

            <!-- <input type="submit" class="btn btn-primary btn-large mt-10 " name="btnCnfBook2" id="btnCnfBook2" value="COMPLETE BOOKINGGGGGGG" > -->

            <div class="clear"></div>
           
            <div class="show-result"></div>
    <!-- </form> -->

    <!-- booking only -->



      <div class="clearfix"></div>
            <h3 class="section-title">SUBMIT Registration and PAY Later </h3>
            <div class="bb2 mb-20"></div>
            
<!-- <form name="frm-booking1" id="frm-booking1" method="POST" action=""> -->

<!--  -->
           
            <p>If you dont want to make online payment now, you can still book this PACKAGE by clicking the below registration button and PAY later through check or online bank transefer. This registration should be followed-up with a deposit to Al-Ameen which will confirm your space for <?php if(isset($packageName)) echo $packageName; else echo 'PackageNameNIL'; ?>. The Initial Deposit amount is 20% of total Package Price. per person.</br>
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
<!--  -->





      <div>

            <h3 class="section-title"></h3>
            <div class="bb2 mb-10"></div>
           
            


            <input type="submit" class="btn btn-primary btn-large mt-10 " name="btnCnfBook1" id="btnCnfBook1" value="Submit & PAY LATER" >

            </div>


            <div class="clear"></div>
           
            <div class="show-result"></div>
<!--  </form> -->

 <!-- syed form -->


        <!-- booking only -->        



          </div>
        </div>

     



            <div class="col-xs-12 col-sm-4 col-md-4">
          <div class="sidebar hotel-sidebar">
            <div class="sidebar-item mb-20">
              <div class="summary-payment">
        
                <div class="summary-header mb-30"><!--  <img src="images/list-items/small-item-01.jpg" alt="Alternative Hotel" /> -->
                  <h3 class="no-mb">Booking Summary</h3>
                  <!-- <span>Location, Country</span> <span class="rating-static rating-30"></span>  -->
                  </div>
                 
                  <p class="no-mb"><?php if(isset($packageName)) echo "<strong>" .$packageName ."</strong>"; else echo "N/A"; ?></p>
                    <div class="clear mb-10"></div>

                   <div class="lp-box"> <i class="text-info icon_calendar"></i>
                  <p><?php if(isset($_SESSION["departure_date"])) echo "Departure : <strong>". $departure_date."</strong>" ; ?> &nbsp; <br/> Return : <?php if(isset( $_SESSION["arrival_date"] )) echo  "<strong>" .$arrival_date."</strong>"; else echo "N/A"; ?>
                  <br/>
                    <?php if(isset( $_SESSION['travelUserDate'])) echo  "Your Selected travel date is : <strong>" .$travelUserDate."</strong>"; echo '<br/>' ?>
                  
                    <?php if(isset( $_SESSION['dLocation'])) echo  "Your selected Departure City is : <strong>" .$_SESSION['dLocation']."</strong>"; else echo "N/A"; ?>
                    </p>
                    </div>
                    <div class="lp-box"> <i class="text-info fa-male"></i>
                    <p> Adults(<?php if(isset( $_SESSION["adultCount"])) echo  $_SESSION["adultCount"]; else echo "0"; ?>) &nbsp; Childs(<?php if(isset( $_SESSION["childCount"])) echo  $_SESSION["childCount"]; else echo "0"; ?>) 
                      </p>
                  </div>
                     <div class="clear mb-10"></div>
                     <div class="bb2 mb-30"></div>
               <!--  -->

               <div class="lp-box"> <i class="text-info icon-hotel"></i>
                  <h4></i> Select ROOM Options</h4>

                <label><input type="radio" id="optroom1" name="optroom" VALUE ="1"  
                <?php 
                if (!isset($_POST['optroom'])||(isset($_POST['optroom']) && $_POST['optroom'] == '1'))
                  echo ' checked="checked"'; ?>/>
                <?php echo " QUAD ROOM  :" . " Rs. ".$_SESSION["quad_price"] ." / PP"?></label>

                <!-- =============================== -->



                <!-- ===========================================  -->

                <label><input type="radio" id="optroom2" name="optroom" VALUE ="2"  
                <?php 
                if (isset($_POST['optroom']) && $_POST['optroom'] == '2')
                echo ' checked="checked"';?> />
                <?php  echo " TRIPLE ROOM  : " . " Rs. ".$_SESSION["triple_price"]." / PP"?></label>
               
                <label><input type="radio" id="optroom3" name="optroom"  VALUE ="3" 
                  <?php 
                  if (isset($_POST['optroom']) && $_POST['optroom'] == '3')
                  echo ' checked="checked"';?> />
                <?php echo " DOUBLE ROOM  : " ." Rs. ".$_SESSION["dual_price"]." / PP"?></label>

                <!--  -->

                  <!-- <input type="submit" name="gotest" value="Go Test"> -->
         
                <!--  -->


                </div>
                 <div class="clear mb-10"></div>
                <!--  -->
              
             

                


                <!--  -->
                <div class="bb2 mb-30"></div>
                <table class="table table-bordered table-striped mb-30">
                  <tr>
                    <td>Base Fair / Unit</td>
                    <td id="unitprice" class="center text-bold text-success">

                    <?php if(isset($_SESSION["quad_price"] )) echo $_SESSION["quad_price"] ; 

              
              
                   

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
                    <td id="totalprice" class="center text-bold text-success"><?php if(isset($_SESSION["quad_price"])) echo $_SESSION["quad_price"] * $_SESSION["totCount"] ; ?></td>
                  </tr>

                </table>
                <div class="bb2 mb-20"></div>


            <div class="lp-box"> <i class="text-info fa-money"></i>
         <!--      <form method="POST" action=""> -->
                <h4>   Select PAYMENT Options  </h4>
                
                <label>
                <input type="radio" name="pay_option" value="1"
                <?php 
                if (!isset($_POST['pay_option'])||(isset($_POST['pay_option']) 
                        && $_POST['pay_option'] == '1'))
                  echo ' checked="checked"'; ?>/>
                <?php echo "  PAY Initial Booking Amount 20%"?>
                </label>
                <span id="partamt" name="partamt" class="right text-success text-bold"><?php if(isset($_SESSION["grossAmount"])) echo "Rs. ".$_SESSION["quad_price"] * $_SESSION["totCount"]*0.2;?></span>

                </br>
                
                <label>
                <input type="radio" name="pay_option" value="2"
                <?php 
                    if (isset($_POST['pay_option']) && $_POST['pay_option'] == '2')
                      echo ' checked="checked"'; ?>/>
                <?php echo "  PAY Full Amount"?>
                </label>

                <span id="fullamt" name="fullamt" class="right text-success text-bold"><?php if(isset($_SESSION["grossAmount"])) echo "Rs. ".$_SESSION["quad_price"] * $_SESSION["totCount"];?></span>


                </form>

                <!-- form end -->
              </div>
                <div class="clear mb-10"></div>
              </div>
            </div>

            <!--      -->
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


 
      </div>
    </div>
  </div>
  <!-- end content_wrapper -->

   <!-- Footer part with js files  -->
  <?php include('../footer.php') ?>
</div>

<script type="text/javascript">
        /*var room = 1;*/
        function add_fields() {
          alert('I am clicked');
      /* room++;*/
       var objTo = document.getElementById('passengerField')
       var divtest = document.createElement("div");
       divtest.innerHTML = '<div class="label">Room ' + room +':</div><div class="content" style="color: red;"><span>Width: <input type="text" style="width:48px;" name="width[]" value="" /><small>(ft)</small> X</span><span>Length: <input type="text" style="width:48px;" namae="length[]" value="" /><small>(ft)</small></span></div>';
      
      objTo.appendChild(divtest)
       }

       function testf(str)
       {
        var idd =str.id;
        alert(idd);
       }




      

        /*$(document).on('click','.cls-book',function(){
          alert('ok');
           var url = "book_now_ajax.php";
          $.ajax({
           type: "POST",
            url: url,
          data: $("#frm_booking").serialize(),
             success: function(data)
            {                  
        //$('.ajax_result').html(data);
             $('.show-result').html(data); // made changes 
            }               
            });
            return false;

            alert('Ali');
            });*/
        

        </script>
<!-- new script -->
<script type="text/javascript">


$("input[name='optroom']").bind('change', function() {
    var amount = 0;
    var total = parseInt($("#totalprice").text().substring(0), 10);
    var unit = parseInt($("#unitprice").text().substring(0), 10);
    var no = parseInt($("#noofpassengers").text().substring(0), 10);


    switch (this.value) {
    case "1":
        amount = <?php echo $_SESSION["quad_price"]?>;

        break;
    case "2":
        amount = <?php echo $_SESSION["triple_price"] ?>;
        break;
    case "3":
        amount = <?php echo $_SESSION["dual_price"] ?>;
        break;
    }

  //alert(amount);

  $("#unitprice").text("Rs. " + (amount));
 
  $("#totalprice").text("Rs. " + (no * amount));
  $("#partamt").text("Rs. " + (no * amount) * 0.2);
  $("#fullamt").text("Rs. " + (no * amount));

//call php to set the session value




});
//pay amount logic




$("input[name='pay_option']").bind('change', function() {
    var amount1 = 0;

    var partamt = parseInt($("#partamt").text().substring(4), 10);
    var fullamt = parseInt($("#fullamt").text().substring(4), 10);
    switch (this.value) {
    case "1":
        amount1 = partamt;

        break;
    case "2":
        amount1 = fullamt;
        break;

    }
    //alert(partamt);

  //alert(amount1);

 

//call php to set the session value



//
$.post("setsessionvalue.php", {
        payamt : amount1 
 
    }, function (data, status) {
        
       //ssh  alert("Data: " + data + "\nStatus: " + status);

       
    });

//




});
</script>        

</body>
</html>
