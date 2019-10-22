             <div class="sidebar-item mb-20">
                <div class="lp-box"> <i class="text-info fa-heart"></i>
                  <h4>Hotels In This Package</h4>
                </div>
                <ul class="small-list-item">
              <?php 
                $sqlHotel = "SELECT category_id, package_name from tbl_package where id = $p_id";
                $result = mysqli_query($db,$sqlHotel);
                $row=mysqli_fetch_row($result);
                $catID = $row[0];
                //echo "<br/>";
                //echo $sqlHotel;
               // echo "<br/>";
               // echo 'Categeory : '.$catID;
               if($catID == '1'):


                /**/

              $sql = "SELECT id,category_id,hotel_name, image_folder, location 
              from tbl_package_hotels where category_id=$catID order by id desc limit 5";
                  //echo $sql;
                    $i = 0;
                    $result=mysqli_query($db,$sql);
                    while($row = mysqli_fetch_assoc($result))
                     {
                      /*$name= $row['hotel_name'];
                      $location = $row['location'];
                      $u_comm=$row['rev_comment'];
                      $u_rating=$row['rating'];
                      $u_title=$row['title'];*/
              /**/      
                      $name= $row['hotel_name'];
                      $location = $row['location'];
                      $folder = $row['image_folder'];
                      $i++


               
              ?>   
                <a href="#" class="text-bold inverse"><?php echo $name . "," . $location ?></a>

                   <li>
                    <img src="../../images/list-items/small-item-01.jpg" data-to="<?php echo $folder ?>" data-caption="<?php echo $name ?>" data-i="<?php echo $i ?>" class="modallery">

                    <!--  -->
                     <img src="../../images/list-items/small-item-01.jpg" data-to="<?php echo $folder ?>" data-caption="<?php echo $name ?>" data-i="<?php echo $i ?>" onclick="openslider(<?php echo $i ?>)">

                    <!--  -->

                    <!--  -->
                  <input type="hidden" name="<?php echo "img_inp_". $i ?>" id="<?php echo "img_inp_".$i ?>" 
                  value="<?php echo $folder ?>"/>
                    <!--  -->
                    </li>

                <!-- access hotel folder -->
                <?php

                $path = "../../images/Hotel/" . $folder ."/*.*" ;
                //echo $path;


                  $files = glob($path);
                  //echo 'Count :'.count($files);
                for ($i=0; $i<count($files); $i++)
                  {
                    $image_src = $files[$i];

                    ?>
                    

<!--     images for hotesls      -->
<!--           -->


                    
                    
                   <?php  } ?>

                   <!-- end of for loop -->


       
                     <?php  } ?>
                   <!-- end of while loop -->                
  
                <!--  +++++++++++++++++++++++++++++++Madina Hotels++++++++++++++++++++++++++ -->
                <?php elseif ($catID == '2'): ?>
                <li>
                    <a href="#" class="image-small-list"><img src="../../images/list-items/small-item-01.jpg" alt="Alternative Hotel" /></a><a href="#" class="text-bold inverse">Elaf Al Nakheel, Madinaha</a>
                    <div class="price-small"><strong>$76</strong> <span>per person</span></div>
                    <span class="rating-static rating-45"></span>
                </li>

                <li>
                    <a href="#" class="image-small-list"><img src="../../images/list-items/small-item-01.jpg" alt="Alternative Hotel" /></a><a href="#" class="text-bold inverse">Elaf Taiba hotel, Madinaha</a>
                    <div class="price-small"><strong>$76</strong> <span>per person</span></div>
                    <span class="rating-static rating-45"></span>
                </li>
                <li>
                    <a href="#" class="image-small-list"><img src="../../images/list-items/small-item-01.jpg" alt="Alternative Hotel" /></a><a href="#" class="text-bold inverse">Dallah Taibah Hotel (4 Star), Madinaha</a>
                    <div class="price-small"><strong>$76</strong> <span>per person</span></div>
                    <span class="rating-static rating-45"></span>
                </li>

                <li>
                    <a href="#" class="image-small-list"><img src="../../images/list-items/small-item-01.jpg" alt="Alternative Hotel" /></a><a href="#" class="text-bold inverse">Elyas Silver Hotel, Madinaha</a>
                    <div class="price-small"><strong>$76</strong> <span>per person</span></div>
                    <span class="rating-static rating-45"></span>
                </li>

                <li>
                    <a href="#" class="image-small-list"><img src="../../images/list-items/small-item-01.jpg" alt="Alternative Hotel" /></a><a href="#" class="text-bold inverse">Saif Al Tawbah, Madina</a>
                    <div class="price-small"><strong>$76</strong> <span>per person</span></div>
                    <span class="rating-static rating-45"></span>
                </li>
                 <?php else: ?>
                  <li>
                    <a href="#" class="text-bold inverse">Sorry! Hotel's Unavailable.</a>
                  </li>
               <?php endif; ?>
              </ul>
            </div> 