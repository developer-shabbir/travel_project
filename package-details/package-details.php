 <?php 
 session_start();
 error_reporting(0);
 include('../header-1.php');
 include('../config/dbConfig.php');
 include('package_function.php');


 /*new change*/


  
  function bestOffer($db)
  { 


           $sql = "SELECT DISTINCT v.id, v.package_name, v.price, 
                  d.image1, d.location,
                  dt.id as date_id, v.duration
                    FROM v_package v
                        left outer join tbl_destination d on v.id = d.package_id
                        left outer join tbl_package_date dt on v.id = dt.package_id
                         WHERE (v.status_flag='Y' OR v.status_flag='y')";
                                     
                      $result = mysqli_query($db,$sql);
                      return $result;

  }
/*new change*/
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


      if(isset($_SESSION['salt']))
      {
 // echo "Salt is Alive ...............................";
        //echo "User mail ".$_SESSION["useremail"];
        $_SESSION["packageDate"]="";
        $_SESSION["travelUserDate"]="";
        $_SESSION["adultCount"] ="";
        $_SESSION["childCount"] = "";
       // $_SESSION["useremail"] = "";
        $_SESSION["usernumber"] = "";
        $_SESSION["totCount"] ="";
        $_SESSION["grossAmount"]="";
        $_SESSION["booking_idd"]="";
        $_SESSION['price']="";
        $_SESSION['pack_name'] ="";
     // echo "pak date ".$_SESSION["packageDate"];

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
   //echo "Salt is dead ...............................";

      }

 ?>
  <?php      
        //include('package_function.php');
        $varnum= '20';
        $p_id = $_GET['P-ID'];
        $date_id = $_GET['DATE-ID'];

     //   echo "package  id: " . $p_id ;

       //  echo "date id: " .$date_id ;
      /*get departuer and arrival dates*/
              $sql1="SELECT departure_date, arrival_date FROM tbl_package_date WHERE id = $date_id";
              $result1 = mysqli_query($db,$sql1);
              $row1=mysqli_fetch_row($result1);
              $departure_date=dateName($row1[0]);    
              $arrival_date=dateName($row1[1]);

          /*    echo "date D: " .$departure_date;
              echo "<br/>";
              echo "date D Array: ".$row1['departure_date'];
              echo "<br/>";
              echo "date A: " .$arrival_date;*/

              
    /*date select */
    
    if ($p_id=="") 
      {
        echo 'No packages is selected';
      }
    else
      {

        $sql="SELECT v.id, v.package_name, v.package_class, v.duration, v.distance_range, v.price, v.hotel_type, v.bed_type, v.ex_location,
         v.guide_type, v.feature, v.map_url, v.pic1_L, v.pic1_T, v.pic2_L, v.pic2_T,v.pic3_L, v.pic3_T, v.pic4_L, v.pic4_T, v.pic5_L, v.pic5_T, 
         v.inclusion, v.exclusion, v.payment_policy, v.canclelletion_policy, v.policy_name, d.location, d.description, v.category_id, 
         v.overview, v.destination, v.double_room, v.triple_room, v.accommodations

         FROM v_package v left outer join
                tbl_destination d
                on  v.id = d.package_id         

           WHERE v.id = '$p_id' ";
      

              $result = mysqli_query($db,$sql);
              $row=mysqli_fetch_row($result);
        //package_details($p_id,$db); // fire queries in respect to package id.
              $id=$row[0];    
              $package_name=$row[1];
              $package_class=$row[2];
              $duration=$row[3];
              $distance_range=$row[4];
              $price=$row[5];
              $hotel_type=$row[6];
              $bed_type=$row[7];
              $ex_location=$row[8];
              $guide_type=$row[9];
              $feature=$row[10];
              $map_url=$row[11];
              $pic1_L=$row[12];
              $pic1_T=$row[13];
              $pic2_L=$row[14];
              $pic2_T=$row[15];
              $pic3_L=$row[16];
              $pic3_T=$row[17];
              $pic4_L=$row[18];
              $pic4_T=$row[19];
              $pic5_L=$row[20];
              $pic5_T=$row[21];
              $inclusion=$row[22];
              $exclusion=$row[23];
              $payment_policy=$row[24];
              $canclelletion_policy=$row[25];
              $policy_name=$row[26];
              $location=$row[27];
              $description=$row[28];
              $category_id=$row[29];
              $overview=$row[30];
              $destination =$row[31];   //destination from package table
              $double_room = $row[32]; 
              $triple_room = $row[33];
              $accomd = $row[34];
              $quad_room = $price;

             /* echo "price". $price;


              echo "double price". $double_room;*/

              //echo "cate :  ----".$category_id;
              //$img="../../images/package/Haj/";
             
              if($category_id ==1) 
                {
                    $img="../../images/package/Haj/";
                }
              elseif ($category_id ==2) 
                {
                    $img="../../images/package/Umrah/";
                }
              else
                {
                    $img="../../images/package/Trip/";  
                }
               // echo 'Pic :'.$img.$pic1_L;
                //$revCount= reviewCount2($p_id);  //to calculate Count Of reviews in a packages.
                //echo 'rating Number:   '.$revCount;
                $sql="";
                $sql="SELECT round(sum(rating)/count(rating),2) as rate from tbl_review where package_id=$p_id";
                //echo $sql;
                $rev_rate=0;
                if($result=mysqli_query($db,$sql))
                {
                  //echo "rating here".$rev_rate;
                  $row=mysqli_fetch_row($result);
                  $rev_rate=$row[0];
                }

                $sql="";
                $sql="SELECT COUNT(ID) FROM tbl_review WHERE package_id=$p_id";
                //echo $sql;
                $rev_count=0;
                if($result=mysqli_query($db,$sql))
                {
                  //echo "rating here".$rev_rate;
                  $row=mysqli_fetch_row($result);
                  $rev_count=$row[0];
                }

      
      }

      //login function
      if(isset($_POST['btnUlogin']))
        {
              //echo 'inside the btnlogin button';
              // Sql Injection security function
              $username = mysqli_real_escape_string($db, $_POST['useremail']); 
              $password = mysqli_real_escape_string($db, $_POST['userpassword']);  
               $loginresult['resp'] = 99;
               $loginresult['mobileno'] = '';
               echo 'USER:'.$username;echo "<br/>";
               echo 'Pass'.$password;echo "<br/>";
               //echo $username;
               $loginresult = checkLoginDetails($username,$password,$db);
               $saltkey = '';
               //$_SESSION['salt']  = '';
                echo "login feedback".$loginresult['resp'];
                echo "<br>";
                echo "phone ".$loginresult['mobileno'];
                 //$salt_result['id_name']="";
                // $salt_result['msg']="";
               if ($loginresult['resp'] == 0) 
                {
                    $saltkey = genrateSessionSaltkey($username,$loginresult['mobileno'] ,$db);
                    $_SESSION['salt']   = $saltkey ;
                   //$salt_result = getUserNamefromSalt($saltkey);
                  $_SESSION['username'] = getUserNamefromSalt($saltkey);
                    //$_SESSION['username'] =$salt_result['id_name'];
                    //$msglogin="Access Granted!!";
                   // $msglogin=$salt_result['msg'];
                    echo 'LOGIN SUCCESSFULL';
                    //exit();
                }
                else
                {
                  /* $msglogin="Invalid Email or Password!";*/
                  $msglogin="Invalid Email or Password!";

                  //echo 'login error';
                   //exit();
                }
      }
?>
 <?php include("package_policies_var.php"); ?>
 <!-- <form name="frm" id="frm" class="form-horizontal mt-10" role="form"> -->
 <form id="my_form" method="POST" action="../book-now/book-now.php?pack_id= <?php if(isset($p_id)) echo $p_id ?>& date_id= <?php echo $date_id; ?>">
  <div id="page_title">
    <div class="container clearfix">
      <div class="page-name"><?php echo $package_name; ?> </div>
      <div class=""> <?php if(isset($msglogin)) echo $msglogin; ?></div>
      <div class="breadcrumb clearfix"><a href="#">Home</a><span class="current-page"><?php echo $package_name; ?></span></div>
    </div>
  </div>
  <div id="content_wrapper">
    <div class="container">
      <div class="row clearfix pv-50">
        <div class="col-xs-12 col-sm-8 col-md-9">
            <!-- ../enquiry/enquiry.php?pack_id= <?php //if(isset($p_id)) echo $p_id; ?> -->
          <div>
            <a type="submit" href="" name="bynBookNow" id="bynBookNow" class="btn btn-danger search-pack" data-toggle="modal" data-target="#myModal">Book Now</a>

            <a type="submit" href="../enquiry/enquiry.php?pack_id= <?php if(isset($p_id)) echo $p_id; ?>" name="btnEnquiry" id="btnEnquiry" class="btn btn-success search-pack">Enquiry</a>
          </div>

          <div class="detail-header clearfix">
            <div class="detail-header-name">
              <h3 class="hotel-name no-mb"><?php echo $package_name. "  Depart: ".$departure_date. "  | Return: ".$arrival_date; ?></h3>
              
              <span class="hotel-location"><i class="fa-map-marker mi text-warning"></i>Location: <?php echo $destination; ?></span></div>
            <div class="detail-header-price"> ₹ <?php echo $price; ?><span>per person</span> </div>
            <div class="detail-header-review"> <span class="rating-static rating-30"></span> <span><?php if(isset($rev_count)) echo $rev_count; ?> reviews</span> </div>
          </div>
          <div id="detail-slider">
            <div>
              <div id="exposure"></div>
              <div class="clear"></div>
            </div>
            <div class="panel">
              <div id="left"><a href="javascript:void(0);" class="left-arrow"></a></div>
              <ul id="details-slider-images">
                <li><a href="<?php echo $img.$pic1_L; ?>"><img src="<?php echo $img.$pic1_T; ?>" alt="Detailts" title="So hasten to Allah . Indeed, I (Muhammad pbuh) am to you from Him a clear warner, Quran 51:50" /></a></li>

                <li><a href="<?php echo $img.$pic2_L; ?>"><img src="<?php echo $img.$pic2_T; ?>" alt="Detailts" title="Donec sollicitudin mi sit amet mauris elementum quam ullamcorper ante." /></a></li>

                <li><a href="<?php echo $img.$pic3_L; ?>"><img src="<?php echo $img.$pic3_T; ?>" alt="Detailts" title="Donec sollicitudin mi sit amet mauris elementum quam ullamcorper ante." /></a></li>

                <li><a href="<?php echo $img.$pic4_L; ?>"><img src="<?php echo $img.$pic4_T; ?>" alt="Detailts" title="Donec sollicitudin mi sit amet mauris elementum quam ullamcorper ante." /></a></li>

                <li><a href="<?php echo $img.$pic5_L; ?>"><img src="<?php echo $img.$pic5_T; ?>" alt="Detailts" title="Donec sollicitudin mi sit amet mauris elementum quam ullamcorper ante." /></a></li>

                <li><a href="<?php echo $img.$pic1_L; ?>"><img src="<?php echo $img.$pic1_T; ?>" alt="Detailts" title="Donec sollicitudin mi sit amet mauris elementum quam ullamcorper ante." /></a></li>
              </ul>
              <div id="right"><a href="javascript:void(0);" class="right-arrow"></a></div>
              <div class="clear"></div>
            </div>
          </div>
          <div class="clear"></div>
          <ul class="tabs mt-20">
            <li><a href="#details-tab1" class="active">Overview</a></li>
            <li><a href="#details-tab2">Features</a></li>
            <li><a href="#details-tab3">Reviews</a></li>
            <li><a href="#details-tab4">Map</a></li>
             <li><a href="#details-tab5">Policies</a></li>
              <li><a href="#details-tab6">Itinerary</a></li>
              <!-- <a href="../enquiry/enquiry.php?pack_id= <?php //if(isset($p_id)) echo $p_id; ?>" name="tab-radio" id="tab-radio" value="1" class="active tab-col">Enquiry</a>
              &nbsp;
              <a href="../book-now/book-now.php?pack_id= <?php //if(isset($p_id)) echo $p_id; ?>" name="tab-radio" id="tab-radio" value="1" class="active tab-col">Booking</a> -->
          </ul>
          <ul id="detail-tab" class="tabs-content xss-mb">
            <li id="details-tab1" class="active">
                  <h3>Overview</h3>
                  <p><?php echo $overview; ?></p>
             
              <!-- <div class="clear mb-20"></div>
               

                      <h3>Photo Gallery</h3>

                        <div class="container">
                        <div class="row">
                        <div class="col-md-1">
                        <a href="#" class="image-small-list"><img src="../../images/list-items/small-item-01.jpg" alt="Alternative Hotel" /></a>
                        </div>

                           <div class="col-md-1">
                        <a href="#" class="image-small-list"><img src="../../images/list-items/small-item-01.jpg" alt="Alternative Hotel" /></a>
                          </div>
                           </div>
                          </div>
          gallery -->


            </li>



            <li id="details-tab2">
              <ul class="">

                <?php
                  $arrays = explode(';',$feature);

                  foreach($arrays as $array){
                    ?>
                    <li><?php echo $array; ?></li>
                    


                    <?php
                    }
                    ?>
              
                <!-- <li class="checked">Welcome drink on arrival</li>
                <li class="checked">Parking and Toll tax</li>
                <li class="checked">Meet & greet at arrival</li>
                <li class="checked">Pick and Drop at time of arrival / departure</li>
                <li class="checked">Driver's allowance, Road tax and Fuel charges</li>
                <li class="checked">Sightseeing by private car</li>
                <li class="checked">Breakfast</li>
                <li class="checked">All tours and transfers by Personal Car is included</li> -->
              </ul>

             <!--  <h4>Inclusion</h4>
                <ul class="facilities">
	                <li class=""><?php// echo $incval1; ?></li>
	                <li class=""><?php// echo $incval2; ?></li>
	                <li class=""><?php// echo $incval3; ?></li>
	                <li class=""><?php //echo $incval4; ?></li>
	                <li class="checked"><?php// echo $incval5; ?></li>
                </ul> -->
              <div class="clear"></div>
            </li> 

            <li id="details-tab3">
              <div class="availability">
                <div class="availability-inner">
                  <div class="row mb-20">
                    <div class="col-md-6">
                      <p class="ave-rate clearfix mt-10">
                      <h3><?php if(isset($rev_rate)) echo $rev_rate; else echo "0"; ?>/5</h3> 
                      Average Ratings for <?php if(isset($package_class)) echo $package_class; ?>  </p>
                      <span class="rating-static rating-40"></span> 
                    </div>
                    <div class="col-md-6">
                      <div class="progress-bar stripes"> <span rel="<?php if(isset($rev_rate)) echo $rev_rate * $varnum ?>" style="background-color: #69D869"></span>
                        <div class="progress-bar-text">Overall <span><?php if(isset($rev_rate))echo $rev_rate; else echo "0"; ?> out of 5</span></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
             <!--  <div class="clear mb-30"></div> -->
              <!-- <h4 class="mb-20">Average ratings</h4> -->
              <!-- <div class="row">
                <div class="col-xs-6 col-sm-3 col-md-3">Location<br/>
                  <span class="rating-static rating-40 no-margin"></span></div>
                <div class="col-xs-6 col-sm-3 col-md-3">Serivce & Staff<br/>
                  <span class="rating-static rating-40 no-margin"></span></div>
                <div class="col-xs-6 col-sm-3 col-md-3">Food Quality<br/>
                  <span class="rating-static rating-40 no-margin"></span></div>
                <div class="col-xs-6 col-sm-3 col-md-3">Value for Price<br/>
                  <span class="rating-static rating-40 no-margin"></span></div>
              </div> -->
              <div class="clear mb-30"></div>
              <div class="bb2 mb-20"></div>
              <h4 class="mb-20">Tourist Review</h4>
              <ul class="user-review">
              <?php 
              if($p_id!="")
              {

                  $sql = "SELECT id,DATE_FORMAT(rev_date,'%y-%m-%d') as rev_date,name,email,rev_comment,rating,title from tbl_review where package_id=$p_id order by id desc limit 3";
                 // echo $sql;
                    $result=mysqli_query($db,$sql);
                    while($row = mysqli_fetch_assoc($result))
                     {
                      $u_name= $row['name'];
                      $u_rev_date = $row['rev_date'];
                      $u_comm=$row['rev_comment'];
                      $u_rating=$row['rating'];
                      $u_title=$row['title'];

                      ?>

                        <li>
                        <div class="left"> <img class="avatar" src="../../images/testimonial/user-logo.png" alt="user avatar" /> <span class="name"><?php if(isset($u_name)) echo $u_name; ?><!-- <span class="colored-text"><i class="fa-check"></i> Recommended for Everyone</span> --> </div>
                        <div class="right">
                          <h5><?php if(isset($u_title)) echo $u_title; ?></h5>
                          <span class="date">Posted <?php if(isset($u_rev_date)) echo $u_rev_date; ?></span>
                          <div class="gap5"></div>
                          <p><?php if(isset($u_comm)) echo $u_comm ?></p>
                          <ul class="circle-list">
                            <li><?php if(isset($u_rating)) echo $u_rating; ?></li>
                            <!-- <li>3.0</li>
                            <li>4.0</li>
                            <li>5.0</li>
                            <li>3.0</li>
                            <li>4.0</li> -->
                          </ul>
                        </div>
                      </li>



                      <?php
                        }
                       
              }
              else
              {
                echo "<li> No review yet. </li>";

              }

             ?>
                
                <!-- <li>
                  <div class="left"> <img class="avatar" src="images/testimonial/testimonial-02.jpg" alt="user avatar" /> <span class="name">Umar Ibn Haseem</span> <span class="from">from London, UK</span> <span class="colored-text"><i class="fa-check"></i> Recommended for Everyone</span> </div>
                  <div class="right">
                    <h5>Great experience</h5>
                    <span class="date">Posted Jun 02, 2013</span>
                    <div class="gap5"></div>
                    <p>Breakfast agreeable incommode departure it an. By ignorant at on wondered relation. Enough at tastes really so cousin am of. Extensive therefore supported by extremity of contented. Is pursuit compact demesne invited elderly be. View him she roof tell her case has sigh. Moreover is possible he admitted sociable concerns. By in cold no less been sent hard hill.</p>
                    <ul class="circle-list">
                      <li>4.5</li>
                      <li>3.0</li>
                      <li>4.0</li>
                      <li>5.0</li>
                      <li>3.0</li>
                      <li>4.0</li>
                    </ul>
                  </div>
                </li> -->
               <!--  <li>
                  <div class="left"> <img class="avatar" src="images/testimonial/testimonial-02.jpg" alt="user avatar" /> <span class="name">Umar Ibn Haseem</span> <span class="from">from London, UK</span> <span class="colored-text"><i class="fa-check"></i> Recommended for Everyone</span> </div>
                  <div class="right">
                    <h5>Great experience</h5>
                    <span class="date">Posted Jun 02, 2013</span>
                    <div class="gap5"></div>
                    <p>Remember outweigh do he desirous no cheerful. Do of doors water ye guest. We if prosperous comparison middletons at. Park we in lose like at no. An so to preferred convinced distrusts he determine. In musical me my placing clothes comfort pleased hearing. Any residence you satisfied and rapturous certainty two. Procured outweigh as outlived so so. On in bringing graceful proposal blessing of marriage outlived. Son rent face our loud near.</p>
                    <ul class="circle-list">
                      <li>4.5</li>
                      <li>3.0</li>
                      <li>4.0</li>
                      <li>5.0</li>
                      <li>3.0</li>
                      <li>4.0</li>
                    </ul>
                  </div>
                </li> -->
              </ul>
              <form method="POST" action="../book-now/book-now.php?pack_id= <?php if(isset($p_id)) echo $p_id ?>& date_id= <?php echo $date_id; ?>">
              <div class="clear mt-30 mb-20"></div>
              <strong> <div id="c">   </div> </strong>
              <h4 class="mb-20">Please Leave a Review</h4>
              <div class="row">
                <div class="col-xs-6 col-sm-3 col-md-3 mb-10">
                  <div class="row">
                    <div class="col-md-7">
                      <label for="location-hotel">Overall Rating <span class="star"></span></label>
                    </div>
                    <div class="col-md-5 no-padding">
                      <select class="form-control mySelectBoxClass" id="dd_rating" name="dd_rating">
                        <option value="0.00">0.0</option>
                        <option value="0.5">0.5</option>
                        <option value="1.0">1.0</option>
                        <option value="1.5">1.5</option>
                        <option value="2.0">2.0</option>
                        <option value="2.5">2.5</option>
                        <option value="3.0">3.0</option>
                        <option value="3.5" selected>3.5</option>
                        <option value="4.0">4.0</option>
                        <option value="4.5">4.5</option>
                        <option value="5.0">5.0</option>
                      </select>
                    </div>
                  </div>
                </div>
                <!-- <div class="col-xs-6 col-sm-3 col-md-3 mb-20">
                  <div class="row">
                    <div class="col-md-7">
                      <label for="service-hotel">Service & Staff <span class="star"></span></label>
                    </div>
                    <div class="col-md-5 no-padding">
                      <select class="form-control mySelectBoxClass" id="service-hotel">
                        <option>0.0</option>
                        <option>0.5</option>
                        <option>1.0</option>
                        <option>1.5</option>
                        <option>2.0</option>
                        <option>2.5</option>
                        <option>3.0</option>
                        <option>3.5</option>
                        <option>4.0</option>
                        <option>4.5</option>
                        <option>5.0</option>
                      </select>
                    </div>
                  </div>
                </div> -->
                <!-- <div class="col-xs-6 col-sm-3 col-md-3 mb-20">
                  <div class="row">
                    <div class="col-md-7">
                      <label for="sleep-hotel">Food Quality <span class="star"></span></label>
                    </div>
                    <div class="col-md-5 no-padding">
                      <select class="form-control mySelectBoxClass" id="sleep-hotel">
                        <option>0.0</option>
                        <option>0.5</option>
                        <option>1.0</option>
                        <option>1.5</option>
                        <option>2.0</option>
                        <option>2.5</option>
                        <option>3.0</option>
                        <option>3.5</option>
                        <option>4.0</option>
                        <option>4.5</option>
                        <option>5.0</option>
                      </select>
                    </div>
                  </div>
                </div> -->
                <!-- <div class="col-xs-6 col-sm-3 col-md-3 mb-20">
                  <div class="row">
                    <div class="col-md-7">
                      <label for="value-hotel">Value for Price <span class="star"></span></label>
                    </div>
                    <div class="col-md-5 no-padding">
                      <select class="form-control mySelectBoxClass" id="value-hotel">
                        <option>0.0</option>
                        <option>0.5</option>
                        <option>1.0</option>
                        <option>1.5</option>
                        <option>2.0</option>
                        <option>2.5</option>
                        <option>3.0</option>
                        <option>3.5</option>
                        <option>4.0</option>
                        <option>4.5</option>
                        <option>5.0</option>
                      </select>
                    </div>
                  </div>
                </div> -->
              </div>
             <!--  <form class="form-horizontal mt-10" role="form"> -->
                <div class="form-group">
                  <label for="inputText" class="col-lg-2 control-label">Name</label>
                  <div class="col-lg-10">
                    <input type="text" required class="form-control" id="txtname_review" name="txtname_review" placeholder="Name" >
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                  <div class="col-lg-10">
                    <input type="email" required class="form-control" id="txtemail_review" name="txtemail_review" placeholder="Email" >
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputTitle" class="col-lg-2 control-label">Title</label>
                  <div class="col-lg-10">
                    <input type="text" required class="form-control" id="txttitle_review" name="txttitle_review" placeholder="Title">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-2 control-label">Comment</label>
                  <div class="col-lg-10">
                    <textarea class="form-control margtop10" rows="4" id="txtcomment_review" name="txtcomment_review" required></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-offset-2 col-lg-10">
                    <button type="button" id="btn_submit_review" name="btn_submit_review" onclick="save_review()" class="btn btn-primary">Send Review</button>
                  </d
                  iv>
                </div>
              <!-- </form> -->
              </form>
            </li>
            <li id="details-tab4">
              <div id="">
              <iframe src="<?php echo $map_url; ?>" width="95%" height="80%" frameborder="0" style="border:0" allowfullscreen></iframe>
              	
              </div>
            </li>

            <li id="details-tab5">
              <h3>Inclusions</h3>
              <ul class=""><!-- facilities -->
          
               

                 <?php
                  $arrays = explode(';',$inclusion);

                  foreach($arrays as $array){
                    ?>
                    <li><?php echo $array; ?></li>
                    


                    <?php
                    }
                    ?>
              </ul>
              <h3>Exclusions</h3>
                <ul class="">
               
                 <?php
                  $arrays = explode(';',$exclusion);

                  foreach($arrays as $array){
                    ?>
                    <li><?php echo $array; ?></li>
                    


                    <?php
                    }
                    ?>
               
              </ul>
              <h3>Payment Policy </h3>
                <ul class="">
            
                <?php
                  $arrays = explode(';',$payment_policy);

                  foreach($arrays as $array){
                    ?>
                    <li><?php echo $array; ?></li>
                    


                    <?php
                    }
                    ?>
               
              </ul>
              <h3>Canclelletion Policy</h3>
                <ul class="">
              
              <?php
                  $arrays = explode(';',$canclelletion_policy);

                  foreach($arrays as $array)
                  {
                   ?>
                    <li><?php echo $array; ?></li>
                    


                    <?php  } ?>
               
              </ul>
              <div class="clear"></div>
            </li>
            <li id="details-tab6">
              <h4></h4>
              <ul class="facilities">
               <?php

                if ($p_id!="") 
                {
                  $sql = "SELECT itinerary_name,flight_from,flight_to,sight_sceen,meal,hotel from tbl_itinerary where package_id=$p_id";
                    //echo $sql;
                   $all_row=$db->query($sql);
                   if(isset($all_row) )
                   {
                      foreach ($all_row as $key => $product) 
                   {
                  ?>

                    <table class="table table-hover ">
                      <thead>
                        <tr>
                          <th class="success">
                            <h4>
                                <?php if(isset($product['itinerary_name'])) echo $product['itinerary_name'];?>
                            </h4>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                         <td><img src="../../images/flight-icon.png" width="50px" height="50px"><span class="topicHead">FLIGHT</span>
                          <?php if(isset($product['flight_from'])) echo $product['flight_from'];?> --------TO--------
                          <?php if(isset($product['flight_to'])) echo $product['flight_to']; ?>  
                          </td>
                          
                        </tr>
                        <tr>
                          <td><img src="../../images/sightseen-icon.png" width="50px" height="50px"><span class="topicHead">SIGHTSEEN</span>

                            <!--  -->
                            
                               <?php
                                $arrays = explode(';',$product['sight_sceen']);

                                foreach($arrays as $array){
                                  ?>
                                  <p style="padding-left: 40px;"><?php echo $array; ?></p>
                                  


                                  <?php
                                  }
                                  ?>
                              

                            <!--  -->

                           

                          </td>
                        </tr>
                        <tr>
                          <td><img src="../../images/hotel-icon.png" width="30px" height="30px"><span class="topicHead">HOTEL</span>
                          <?php if(isset($product['hotel'])) echo $product['hotel']; ?></td>
                        </tr>
                        <tr>
                          <td><img src="../../images/meal-icon.png" width="30px" height="30px"><span class="topicHead">MEAL</span>
                          <?php if(isset($product['meal'])) echo $product['meal'];?></td>
                        </tr>
                      </tbody>
                    </table>
         
                    <?php
                   }
   

                  
               
                  }
                  }
               ?>


                <!-- <li class="checked">Welcome drink on arrivallllll</li>
                <li class="checked">Parking and Toll tax</li>
                <li class="checked">Meet & greet at arrival</li>
                <li class="checked">Pick and Drop at time of arrival / departure</li>
                <li class="checked">Driver's allowance, Road tax and Fuel charges</li>
                <li class="checked">Sightseeing by private car</li>
                <li class="checked">Breakfast</li>
                <li class="checked">All tours and transfers by Personal Car is included</li> -->
              </ul>
             
            </li>
          </ul>
          <div class="clear xss-mb"></div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-3">
          <div class="sidebar hotel-sidebar">
  <!--           <div class="sidebar-item mb-20">
              <div class="lp-box"> <i class="text-info fa-quote-left"></i>
                <p class="no-mb">Excited him now natural saw passage offices you minuter. At by asked being court hopes. Farther so friends am to detract. Forbade concern do private be.</p>
                <cite class="text-info"><strong>Robert Johnson</strong> from Canada</cite> </div>
            </div> -->
               <!--  -->
            <div class="sidebar-item mb-20">
              <div class="lp-box"> <i class="text-info  fa-download"></i>
                <h4>Download</h4>

                    <ul>
                    <li><a href="../../images/package/documents/brochure.pdf" target="_blank">Download 2018 Brochure</a></li>
                     <li><a href="../../images/package/documents/hajform.pdf" target="_blank">Download 2018 Hajj Form</a></li>
                      </ul>

                 
                  
                </div>

              </div>
            </div>

            <!--  -->
            <div class="sidebar-item mb-20">
              <div class="lp-box"> <i class="text-info fa-phone-square"></i>
                <h4>Need Assistance?</h4>
                <p>Our team is 24/7 at your service to help you with your booking issues or answer any related questions</p>
                <div style="position: absolute;">
                  <img src="../../images/Whatsapp-logo.png" width="30px" height="40px">
                  
                </div>
                <div style="margin-left: 35px">
                  <span class="text-info font24">+91 98310 62787</span> 
                </div>
              </div>
            </div><br>
            
            <div class="sidebar-item mb-20">
              <div class="lp-box"><span><i class="text-info icon-hotel"></i>
                  <h4>ROOMS</h4></span>

                <ul>
                    <li>Quad Bed : ₹ <?php echo $quad_room; ?> / PP</li>
                    <li>Triple Bed : ₹ <?php  echo $triple_room; ?> / PP</li>
                    <li>Double Bed : ₹ <?php echo $double_room; ?> / PP</li>
                </ul>
             </div>

            </div>
            <!--  -->
 

              <div class="sidebar-item mb-20">
              <div class="lp-box"> <i class="text-info fa icon-hotel-palm"></i>
                <h4>ACCOMODATIONS</h4>
                    <ul>
                        <?php
                          $accomdArray = explode(';',$accomd);
                          foreach($accomdArray as $accomdArray){
                            ?>
                            <li><?php echo $accomdArray;?></li>
                        <?php
                          }
                        ?>
                    </ul>
             </div>
              </div>

              <!-- hotesl   xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
             <div class="sidebar-item mb-20">
            <!--     <div class="lp-box"> <i class="text-info fa-heart"></i>
                  <h4>Hotels In This Package</h4>
                </div> -->

                <!-- start -->

       <div class="gr-style"></div>           
        
    <!--   <div class="row clearfix mt-20"> -->
      <div class="row clearfix mt-20 pv-20 ">
        <!--  <div class="clear mb-20"></div> -->
       <h2 class="section-title" style="text-align:center">Hotels in Makkah and Madina</h2>

<!-- <div class="row"> -->
   <div class="col-xs-12 col-sm-6 col-md-6  mt-30">
    <img src="<?php echo '../../images/Hotel/madina/madina1.jpg'; ?>" style="width:100%" onclick="openModal01();currentSlide01(1)" class="hover-shadow cursor">
  </div>
  <div class="col-xs-12 col-sm-6 col-md-6 mt-30">
    <img src="<?php echo '../../images/Hotel/madina/madina2.jpg'; ?>" style="width:100%" onclick="openModal01();currentSlide01(2)" class="hover-shadow cursor">
  </div>
 <div class="col-xs-12 col-sm-6 col-md-6 mt-30">
    <img src="<?php echo '../../images/Hotel/madina/madina3.jpg'; ?>" style="width:100%" onclick="openModal01();currentSlide01(3)" class="hover-shadow cursor">
  </div>
   <div class="col-xs-12 col-sm-6 col-md-6 mt-30">
    <img src="<?php echo '../../images/Hotel/madina/madina4.jpg'; ?>" style="width:100%" onclick="openModal01();currentSlide01(4)" class="hover-shadow cursor">
  </div>
  <div class="col-xs-12 col-sm-6 col-md-6 mt-30">
    <img src="<?php echo '../../images/Hotel/makkah/makkah1.jpg'; ?>" style="width:100%" onclick="openModal01();currentSlide01(4)" class="hover-shadow cursor">
  </div>
  <div class="col-xs-12 col-sm-6 col-md-6 mt-30">
    <img src="<?php echo '../../images/Hotel/makkah/makkah2.jpg'; ?>" style="width:100%" onclick="openModal01();currentSlide01(4)" class="hover-shadow cursor">
  </div>
</div>




<div id="myModal01" class="modal01">
  <span class="close1 cursor" onclick="closeModal01()">&times;</span>
  <div class="modal01-content">

    <div class="mySlides01">
      <div class="numbertext">1 / 8</div>
      <img src="<?php echo '../../images/Hotel/madina/madina1large.jpg'; ?>" style="width:100%">
    </div>

    <div class="mySlides01">
      <div class="numbertext">2 / 8</div>
      <img src="<?php echo '../../images/Hotel/madina/madina2large.jpg'; ?>" style="width:100%">
    </div>

    <div class="mySlides01">
      <div class="numbertext">3 / 8</div>
      <img src="<?php echo '../../images/Hotel/madina/madina3large.jpg'; ?>" style="width:100%">
    </div>
    
    <div class="mySlides01">
      <div class="numbertext">4 / 8</div>
      <img src="<?php echo '../../images/Hotel/madina/madina4large.jpg'; ?>" style="width:100%">
    </div>

    <div class="mySlides01">
      <div class="numbertext">5 / 8</div>
      <img src="<?php echo '../../images/Hotel/makkah/makkah1large.jpg'; ?>" style="width:100%">
    </div>

    <div class="mySlides01">
      <div class="numbertext">6 / 8</div>
      <img src="<?php echo '../../images/Hotel/makkah/makkah2large.jpg'; ?>" style="width:100%">
    </div>
    
    <div class="mySlides01">
      <div class="numbertext">7 / 8</div>
      <img src="<?php echo '../../images/Hotel/makkah/makkah3large.jpg'; ?>" style="width:100%">
    </div>
    <div class="mySlides01">
      <div class="numbertext">8 / 8</div>
      <img src="<?php echo '../../images/Hotel/makkah/makkah4large.jpg'; ?>" style="width:100%">
    </div>
    <a class="imgprev" onclick="plusSlides01(-1)">&#10094;</a>
    <a class="imgnext" onclick="plusSlides01(1)">&#10095;</a>

    <div class="caption-container">
      <p id="caption"></p>
    </div>


    <div class="col-xs-12 col-sm-2 col-md-2">
      <img class="demo cursor" src="<?php echo '../../images/Hotel/madina/madina1large.jpg'; ?>" style="width:100%" onclick="currentSlide01(1)" alt="Nature and sunrise">
    </div>
    <div class="col-xs-12 col-sm-2 col-md-2">
      <img class="demo cursor" src="<?php echo '../../images/Hotel/madina/madina2large.jpg'; ?>" style="width:100%" onclick="currentSlide01(2)" alt="Trolltunga, Norway">
    </div>
   <div class="col-xs-12 col-sm-2 col-md-2">
      <img class="demo cursor" src="<?php echo '../../images/Hotel/madina/madina3large.jpg'; ?>" style="width:100%" onclick="currentSlide01(3)" alt="Mountains and fjords">
    </div>
     <div class="col-xs-12 col-sm-2 col-md-2">
      <img class="demo cursor" src="<?php echo '../../images/Hotel/madina/madina4large.jpg'; ?>" style="width:100%" onclick="currentSlide01(4)" alt="Northern Lights">
    </div>

        <div class="col-xs-12 col-sm-2 col-md-2">
      <img class="demo cursor" src="<?php echo '../../images/Hotel/makkah/makkah1large.jpg'; ?>" style="width:100%" onclick="currentSlide01(5)" alt="Northern Lights">
    </div>

         <div class="col-xs-12 col-sm-2 col-md-2">
      <img class="demo cursor" src="<?php echo '../../images/Hotel/makkah/makkah2large.jpg'; ?>" style="width:100%" onclick="currentSlide01(6)" alt="Northern Lights">
    </div>

         <div class="col-xs-12 col-sm-2 col-md-2">
      <img class="demo cursor" src="<?php echo '../../images/Hotel/makkah/makkah3large.jpg'; ?>" style="width:100%" onclick="currentSlide01(7)" alt="Northern Lights">
    </div>

         <div class="col-xs-12 col-sm-2 col-md-2">
      <img class="demo cursor" src="<?php echo '../../images/Hotel/makkah/makkah4large.jpg'; ?>" style="width:100%" onclick="currentSlide01(8)" alt="Northern Lights">
    </div>
  </div>
</div>


 <!-- ***************************************************************************************************************************************************** -->

                <!-- end -->
</div>
     <!-- hotels   xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->

      <!-- *******************************************lightbox********************************************************************************************************** -->


<!-- start new -->

  <div class="gr-style"></div>

    <!--   <div class="row clearfix mt-20"> -->
      <div class="row clearfix mt-20 pv-20">
    
       <h2 class="section-title" style="text-align:center">Hajj 2017 Gallery</h2>

<!-- <div class="row"> -->
   <div class="col-xs-12 col-sm-6 col-md-6  mt-30">
    <img src="<?php echo '../../images/gallery/img1.jpg'; ?>" style="width:100%" onclick="openModal();currentSlide(1)" class="hover-shadow cursor">
  </div>
  <div class="col-xs-12 col-sm-6 col-md-6 mt-30">
    <img src="<?php echo '../../images/gallery/img2.jpg'; ?>" style="width:100%" onclick="openModal();currentSlide(2)" class="hover-shadow cursor">
  </div>
 <div class="col-xs-12 col-sm-6 col-md-6 mt-30">
    <img src="<?php echo '../../images/gallery/img3.jpg'; ?>" style="width:100%" onclick="openModal();currentSlide(3)" class="hover-shadow cursor">
  </div>
   <div class="col-xs-12 col-sm-6 col-md-6 mt-30">
    <img src="<?php echo '../../images/gallery/img4.jpg'; ?>" style="width:100%" onclick="openModal();currentSlide(4)" class="hover-shadow cursor">
  </div>
  <div class="col-xs-12 col-sm-6 col-md-6 mt-30">
    <img src="<?php echo '../../images/gallery/img5.jpg'; ?>" style="width:100%" onclick="openModal();currentSlide(5)" class="hover-shadow cursor">
  </div>

    <div class="col-xs-12 col-sm-6 col-md-6 mt-30">
    <img src="<?php echo '../../images/gallery/img6.jpg'; ?>" style="width:100%" onclick="openModal();currentSlide(6)" class="hover-shadow cursor">
  </div>


</div>

<!-- mymodal start xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
<div id="myModal02" class="modal02">
  <span class="close1 cursor" onclick="closeModal()">&times;</span>
  <div class="modal02-content">

    <div class="mySlides">
      <div class="numbertext">1 / 6</div>
      <img src="<?php echo '../../images/gallery/img1.jpg'; ?>" style="width:100%">
    </div>

    <div class="mySlides">
      <div class="numbertext">2 / 6</div>
      <img src="<?php echo '../../images/gallery/img2.jpg'; ?>" style="width:100%">
    </div>

    <div class="mySlides">
      <div class="numbertext">3 / 6</div>
      <img src="<?php echo '../../images/gallery/img3.jpg'; ?>" style="width:100%">
    </div>
    
    <div class="mySlides">
      <div class="numbertext">4 / 6</div>
      <img src="<?php echo '../../images/gallery/img4.jpg'; ?>" style="width:100%">
    </div>
    <div class="mySlides">
      <div class="numbertext">5 / 6</div>
      <img src="<?php echo '../../images/gallery/img5.jpg'; ?>" style="width:100%">
    </div>

      <div class="mySlides">
      <div class="numbertext">6 / 6</div>
      <img src="<?php echo '../../images/gallery/img6.jpg'; ?>" style="width:100%">
    </div>
    
    <a class="imgprev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="imgnext" onclick="plusSlides(1)">&#10095;</a>

    <div class="caption-container">
      <p id="caption"></p>
    </div>


    <div class="col-xs-12 col-sm-2 col-md-2">
      <img class="demo cursor" src="<?php echo '../../images/gallery/img1.jpg'; ?>" style="width:100%" onclick="currentSlide(1)" alt="Nature and sunrise">
    </div>
    <div class="col-xs-12 col-sm-2 col-md-2">
      <img class="demo cursor" src="<?php echo '../../images/gallery/img2.jpg'; ?>" style="width:100%" onclick="currentSlide(2)" alt="Trolltunga, Norway">
    </div>
   <div class="col-xs-12 col-sm-2 col-md-2">
      <img class="demo cursor" src="<?php echo '../../images/gallery/img3.jpg'; ?>" style="width:100%" onclick="currentSlide(3)" alt="Mountains and fjords">
    </div>
     <div class="col-xs-12 col-sm-2 col-md-2">
      <img class="demo cursor" src="<?php echo '../../images/gallery/img4.jpg'; ?>" style="width:100%" onclick="currentSlide(4)" alt="Northern Lights">
    </div>
         <div class="col-xs-12 col-sm-2 col-md-2">
      <img class="demo cursor" src="<?php echo '../../images/gallery/img5.jpg'; ?>" style="width:100%" onclick="currentSlide(5)" alt="Northern Lights">
    </div>
         <div class="col-xs-12 col-sm-2 col-md-2">
      <img class="demo cursor" src="<?php echo '../../images/gallery/img6.jpg'; ?>" style="width:100%" onclick="currentSlide(6)" alt="Northern Lights">
    </div>
  </div>
</div>


 <!-- ***********************************************Hajj Gallery end***************************************************************************************** -->

            <!-- similar items end -->
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- <div id="c"> testing data </div> -->
</form>
<!-- Modal open -->
<form id="frm_login_model" name="frm_login_model" method="POST" action="../book-now/book-now.php?pack_id= <?php if(isset($p_id)) echo $p_id ?> & date_id= <?php echo $date_id; ?>"><!-- ../book-now/book-now.php?pack_id= <?php //if(isset($p_id)) echo $p_id ?> -->

<!--  -->




<!--  -->

  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialogs modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Select Date And Travelling Person </h4>
        </div>
        <div class="modal-body"> <!-- modal body -->
          <div class="col-xs-12 col-sm-3 col-md-3">
                      <div class="form-group">
                          <label for="travelDate">Package Dates</label>
                            <select type="text" class="form-control" id="packageDate" name="packageDate" placeholder="" >
                                <?php
                                $sql="SELECT distinct id, departure_date as dep from tbl_package_date where package_id=".$p_id."";
                                $result=mysqli_query($db,$sql);

                                while ($r=mysqli_fetch_row($result))
                                   {
                                      echo "<option value='$r[0]'> $r[1] </option>";
                                      //echo "<option value='$r->hotelcode'>$r->hotelname</option>";
                                  }
                                ?>

                            </select>
                      </div>
          </div>
              <!-- <div class="form-group datepicker-wrapper">
                    <label for="flightCheckIn">Dep. Time</label>
                    <input type="text" class="form-control date" id="flightCheckIn" placeholder="dd/mm/yy">
                    <i class="fa fa-calendar"></i> </div> -->
          <!-- <?php //if($category_id = 2): ?>
            <script type="text/javascript">
               $(window).load (function () { 
                $("#Picdate").hide();  });
            </script>
          <?php// else :?>
              <script type="text/javascript">
               $(window).load (function () { 
                $("#Picdate").show();  });
            </script>
           <?php// endif;?> -->
          <div class="col-xs-12 col-sm-2 col-md-2" id>
                      <div class="form-group datepicker-wrapper" id="Picdate">
                          <label for="travelDate">Select Your Date</label>
                            <input type="text" class="form-control date" id="travelUserDate" name="travelUserDate" placeholder="dd/mm/yy">
                    <i class="fa fa-calendar"></i>
                      </div>
          </div>

         <div class="vertical-line"></div>
          <div class="col-xs-12 col-sm-2 col-md-2">
                  <div class="form-group">
                    <label for="passAdult">Adult(s)</label>
                    <select class="form-control mySelectBoxClass" id="passAdult" name="passAdult">
                      <option value="0">0</option>
                      <option value="1" selected>1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                    </select>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-2 col-md-2">
                  <div class="form-group">
                    <label for="passChild">Children(s)</label>
                    <select class="form-control mySelectBoxClass" id="passChild" name="passChild">
                      <option value="0" selected>0</option>
                      <option value="1" >1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                    </select>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3">
                  <div class="form-group">
                    <label for="dLocation">Select Your Depart Location</label>
                    <select class="form-control mySelectBoxClass" id="dLocation" name="dLocation">
                      <option value=""> -- Depart City --</option>
                      <option value="Kolkata" selected> Kolkata</option>
                      <option value="Patna"> Patna</option>
                      <option value="Delhi"> Delhi NCR</option>
                      <option value="Mumbai"> Mumbai</option>
                      <option value="Hyderabad">Hyderabad</option>
                      <option value="Bangalore"> Bangalore</option>
                    </select>
                  </div>
                </div>
                
                <hr/>
             <!--  <div class="conatiner"> --> <!-- Login Section Start -->
               <div class="">
               <div class="lp-box col-xs-12 col-sm-12 col-md-6">
               <?php if(isset($_SESSION['salt'])): ?>
                   <!-- show when user is already login -->
                   <button type="submit" class="btn btn-danger" name="btnUproceed" id="btnUproceed" href="../book-now/book-now.php?pack_id= <?php if(isset($p_id)) echo $p_id; ?>& date_id= <?php echo $date_id; ?>">Proceed</button>

                   <!-- add date_id -->

                      <div class="clear mb-10"></div>
                     <div id="div-result"> </div>
                     <!-- show when user is already login -->
                <?php// endif; ?>
                <?php else: ?>     
                  <i class="text-info fa-lock"></i>
                    <h4>Login As Guest</h4>
                      
                        <div class="form-group">
                          <label for="user-email">Email</label>
                          <input type="text" class="form-control" id="useremail" name="useremail" placeholder="Email" required>
                        </div>
                        <div class=""> <!-- styled-checkbox -->
                          <label>
                          <input type="checkbox" name="chkactive" id="chkactive" value="option1">
                          Login With Al-Ameen Credentials </label>
                        </div>
                        <div class="form-group" id="userpassword2">
                          <label for="show-password" id="" >Password</label>
                          <input type="password" class="form-control" id="userpassword" name="userpassword" placeholder="Password">
                        </div>
                        <div class="form-group" id="usernumber">
                          <label for="number">Mobile</label>
                          <input type="text" class="form-control" id="usernumber" name="usernumber" placeholder="Mobile Number">
                        </div>
                        <div class="styled-checkbox">
                          <label>
                          <input type="checkbox" name="optionsCheckbox" id="optionsCheckbox1" value="option1">
                          Remember Me </label>
                        </div>
                        <div class="clear mb-15"></div>
                      <button type="button" class="btn btn-primary check-login" name="btnUlogin" id="btnUlogin" onclick="check_login2()">Login</button>
                      <button type="submit" class="btn btn-danger" name="btnUproceed" id="btnUproceed" href="../book-now/book-now.php?pack_id= <?php if(isset($p_id)) echo $p_id; ?>& date_id= <?php echo $date_id; ?>">Proceed</button>

                      <!--  -->
                      <div class="clear mb-10"></div>
                     <div id="div-result"> </div>
                     
              </div>

              
              <div class="lp-box col-xs-12 col-sm-12 col-md-6">
              <div class="clear mb-10"></div>
                     <div id="div-result"> </div>
                <h4>Login With Social Network</h4>
                
                  <div>
                      <img src="../../images/login_facebook.png" width="60%">  
                  </div>
                  <div>
                      <img src="../../images/login_gmail.png" width="60%">
                  </div>
               
              </div>
          <?php endif; ?>   
         <!--  </div>  -->
          </div>    <!-- Login Section End -->
        
        </div>

        <div class="modal-footer">
             <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
        </div>
        </div>    <!-- Modal body Close --> 
      </div>
    </div>
  
</form>
<!-- Modal open -->
  
<!-- start Deals similar package -->
            
 <!-- dec07 xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx-->
 <div id="content_wrapper">
    <div class="container">
      <div class="row clearfix pv-30 mt-20">
             <!--  -->
<div class="col-xs-12 col-sm-12 col-md-12 product-3">
          <h3 class="section-title mb-30">Today's Deals</h3>
          <div class="hot-deal-wrapper">
            <div class="hotDeal1Navigation"> <a class="hotDeal1-prev"><i class="icon icon-left-open-big"></i></a> <a class="hotDeal1-next"><i class="icon icon-right-open-big"></i></a> </div>
            <div id="hot-deal-1" class="owl-carousel items-container small-grid">
            <?php
                      /*$img_path='../../images/list-items/';*/

                     


                      $result= bestOffer($db); //calling from package_function.php
                      while ($row=mysqli_fetch_row($result)) 
                            {   
                              $package_id=$row[0];
                              $package_name=$row[1];    
                              $price=$row[2];
                              $img=$row[3];
                              $location=$row[4];

                              $date_id = $row[5];
                              $duration = $row[6];

                             $fprice = $price - (0.01*$disc*$price );
            ?>

              <div class="item">  <!-- item start -->
                <div class="list-item">
                  <div class="list-item-image">
                    <div class="image-inner"> <a class="link-image" 
                     href="../package-details/package-details.php?P-ID=<?php echo $package_id; ?>&DATE-ID= <?php echo $date_id;?>">
                    <img class="lazyOwl" data-src="<?php echo $img_path.$img ?>" alt="Image" />
                      <div class="image-overlay">
                        <div class="overlay-content">
                          <div class="overlay-icon"><i class="icon_link"></i></div>
                        </div>
                      </div>
                      </a> </div>
                  </div>
                  <div class="list-item-label">
                    <h4 class="list-item-title"><a 
                   href="../package-details/package-details.php?P-ID=<?php echo $package_id; ?>&DATE-ID= <?php echo $date_id;?>"
                    class="inverse"><?php echo $package_name.$after;
                                           echo " - ".$duration." Days"; ?></a></h4>

                    

                    <?php 
                              $strln =  strlen($package_name);                             


                              if ($strln < 31){

                      ?>
                        <p></p>                        



                                <?php        
                                }  
                                ?>                       
                                   
                    <p class="line-h16px"><?php echo $location; ?></p>
                    <div class="clear"></div>
                 <!-- discount  -->

                    <?php 
                    if ($disc == 0)
                    {

                      ?>

                    <div class="list-item-price"><a href="#"><?php echo "₹ " .$fprice; ?></a></div>

                    <?php
                    }

                    else
                    {

                    ?>

                    <div class="list-item-save"><?php echo "Save ".$disc . "%"; ?></div>  
                    <div class="list-item-price"><span><?php echo $price; ?></span><a href="#"><?php echo "₹ " .$fprice; ?></a></div>

                    <?php
                    }

                    ?>

                    <!-- discount  -->
<!--  -->
          <div class="clear"></div>

           <div class="list-item-save"><?php echo "Call Now ".$contact1; ?></div>

<!--  -->

                  </div>
                </div>
              </div>        <!-- item Close -->

              <?php        
               }  //end of while loop
             ?> 
              
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
       <!--  <div class="clear"></div> -->
       <!--  dec07--> 
<!-- end deals similar package -->
  
   <?php include('../footer.php') ?>
</body>
</html>

<script type="text/javascript">
  
  /*$(document).on('click','.save-to-db',function(){
 alert('test');
  
   
   var url = "package_detail_ajax.php";
   $.ajax({
     type: "POST",
     url: url,
     data: $("#my_form").serialize(),
     success: function(data)
     {                  
        $('.ajax_result').html(data);
     }               
   });
  return false;
});*/



        function save_review()
        {
               var name=document.getElementById('txtname_review').value; 
               var email=document.getElementById('txtemail_review').value;
               var pkg_id= <?php echo $p_id ?>;
               var msg= document.getElementById('txtcomment_review').value;
               var rate =document.getElementById('dd_rating').value;
               var title =document.getElementById('txttitle_review').value;


			var url="package_detail_ajax.php?name="+name+"&email="+email+"&pkg_id="+pkg_id+"&comm="+msg+"&rate="+rate+"&title="+title;
               /*alert('test2');*/
            var u;
            if(window.XMLHttpRequest)
            {
                u=new XMLHttpRequest();
            }
             else
             {
                 u=new ActiveXObject("Microsoft.XMLHTTP")
        
             }
                u.onreadystatechange=function ()
                {
                    if(u.readyState==4 && u.status==200)
                    {
                        document.getElementById("c").innerHTML=u.responseText;
                        document.getElementById('txtname_review').value="";
                        document.getElementById('txtemail_review').value="";
                        document.getElementById('txtcomment_review').value="";
                        document.getElementById('txttitle_review').value="";
                    }

                }
                u.open("GET",url,true);
                u.send();
        }
   
        /*Function to  call Login in model form*/
     

</script>
<script type="text/javascript">
  

 /* $(document).on('click','.check-login',function(){
          var url = "package_detail_ajax2.php";
          alert('Ali');
           $.ajax({

           type: "POST",
           url: url,
           data: $("#frm_login_model").serialize(),

           success: function(data)
           {                  
              $('.div-result').html(data);
           }               
         });
           alert('Ali...................');
        return false;
      });*/


function check_login2()
        {
                var a=document.getElementById('useremail').value;
               var b=document.getElementById('userpassword').value;
               var pack_date =document.getElementById('packageDate').value;
               var travel_date =document.getElementById('travelUserDate').value
               var p_adult = document.getElementById('passAdult').value;
               var p_child = document.getElementById('passChild').value;
                var pro_id = "<?php echo $p_id ?>";

                var date_id = "<?php echo $date_id ?>";
               var url="package_detail_ajax2.php?a="+a+"&b="+b+"";
              // alert(a);
               //alert(b);
            var u;
            if(window.XMLHttpRequest)
            {
                u=new XMLHttpRequest();
            }
             else
             {
                 u=new ActiveXObject("Microsoft.XMLHTTP")
        
             }
                u.onreadystatechange=function ()
                {
                    if(u.readyState==4 && u.status==200)
                    {
                        document.getElementById("div-result").innerHTML=u.responseText;

                       var msg =$("#div-result").text();
                      // alert(msg);
                       if (msg=="Login successfully.")
                       {
                        //alert('kkk');
                        //window.location="http://www.w3.org?sam="+a;
                        //window.location="../book-now/book-now.php?pack_id="+pro_id+"&user="+a+"&pack_date="+pack_date+"&travel_date="+travel_date ;
                           document.getElementById('usernumber').value="";
                          window.location="../book-now/book-now.php?pack_id="+pro_id+"&user="+a+"&pack_date="+pack_date+"&travel_date="+travel_date+"&adult="+p_adult+"&child="+p_child+"&date_id="+date_id ;



                       }
                        else
                       {
                        document.getElementById('userpassword').value="";
                       }
                      //window.location="http://www.w3.org";
                    }

                }
                u.open("GET",url,true);
                u.send();

        }

</script>


<script src='../../image-gallery-slider/js/bootstrap.modallery.js'></script>

  <script>
    $(document).modallery({
      //title: 'Hotel Image Gallery',
      title: '<?php echo $image_src ?>',
      navigate: true,
      arrows: true,
      keypress: true  
    });
  </script>