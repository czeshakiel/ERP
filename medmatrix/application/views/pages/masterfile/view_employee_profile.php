<div class="midde_cont">
                  <div class="container-fluid">
                     <div class="row column_title">
                        <div class="col-md-12">
                           <div class="page_title">
                              <h2><?=$subtitle;?></h2>
                           </div>
                        </div>
                     </div>
                     <!-- row -->
                     <div class="row column1">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>Employee Information</h2>
                                 </div>
                              </div>
                              <div class="full price_table padding_infor_info">
                                 <div class="row">
                                    <!-- user profile section --> 
                                    <!-- profile image -->
                                    <?php
                                    if($employee['gender']=="MALE"){
                                        $fa="male";
                                        $img="user_img.jpg";
                                    }else{
                                        $fa="female";
                                        $img="msg1.png";
                                    }
                                    ?>
                                    <div class="col-lg-12">
                                       <div class="full dis_flex center_text">
                                          <div class="profile_img"><img width="180" class="rounded-circle" src="<?=base_url();?>/design/images/layout_img/<?=$img;?>" alt="#" /></div>
                                          <div class="profile_contant">
                                             <div class="contact_inner">
                                                <h3><?=$employee['name'];?></h3>
                                                <p><strong>Designation: </strong><?=$employee['position'];?></p>
                                                <ul class="list-unstyled">
                                                    <li><i class="fa fa-credit-card"></i> : <?=$employee['empid'];?></li>
                                                   <li><i class="fa fa-envelope-o"></i> : <?=$employee['username'];?></li>
                                                   <li><i class="fa fa-calendar"></i> : <?=$employee['birthdate'];?></li>
                                                   <li><i class="fa fa-<?=$fa;?>"></i> : <?=$employee['gender'];?></li>
                                                   <li><i class="fa fa-home"></i> : <?=$employee['address'];?></li>
                                                </ul>
                                             </div>                                             
                                          </div>
                                       </div>
                                       <!-- profile contant section -->
                                       <div class="full inner_elements margin_top_30">
                                          <div class="tab_style2">
                                             <div class="tabbar">
                                                <nav>
                                                   <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                      <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#recent_activity" role="tab" aria-selected="true">SSS</a>
                                                      <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#project_worked" role="tab" aria-selected="false">TIN</a>
                                                      <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#profile_section" role="tab" aria-selected="false">PHILHEALTH</a>
                                                      <a class="nav-item nav-link" id="nav-hdmf-tab" data-toggle="tab" href="#pagibig_section" role="tab" aria-selected="false">PAG-IBIG</a>
                                                      <a class="nav-item nav-link" id="nav-access-tab" data-toggle="tab" href="#access_section" role="tab" aria-selected="false">USER ACCESS</a>
                                                   </div>
                                                </nav>
                                                <div class="tab-content" id="nav-tabContent">
                                                   <div class="tab-pane fade show active" id="recent_activity" role="tabpanel" aria-labelledby="nav-home-tab">
                                                        <p>
                                                            ID NUMBER: <b><u><?=$employee['sss'];?></u></b>
                                                        </p>
                                                   </div>
                                                   <div class="tab-pane fade" id="project_worked" role="tabpanel" aria-labelledby="nav-profile-tab">
                                                      <p>
                                                            ID NUMBER: <b><u><?=$employee['tin'];?></u></b>
                                                      </p>
                                                   </div>
                                                   <div class="tab-pane fade" id="profile_section" role="tabpanel" aria-labelledby="nav-contact-tab">
                                                      <p>
                                                            ID NUMBER: <b><u><?=$employee['philhealth'];?></u></b>
                                                      </p>
                                                   </div>
                                                   <div class="tab-pane fade" id="pagibig_section" role="tabpanel" aria-labelledby="nav-hdmf-tab">
                                                      <p>
                                                            ID NUMBER: <b><u><?=$employee['pagibig'];?></u></b>
                                                      </p>
                                                   </div>
                                                   <div class="tab-pane fade" id="access_section" role="tabpanel" aria-labelledby="nav-access-tab">
                                                      <p>
                                                            <?php
                                                            foreach($access as $ua){
                                                                echo "<font color='blue'>".$ua['station']."</font><font color='red'>($ua[Access])</font> ";
                                                            }
                                                            ?>
                                                      </p>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <!-- end user profile section -->
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-2"></div>
                        </div>
                        <!-- end row -->
                     </div>
                     <!-- footer -->                     
                  </div>