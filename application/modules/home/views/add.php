     <!-- Hero Area Start-->
        <div class="slider-area ">
        <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="assets/img/hero/about.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2><?php echo $info['title'];?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- Hero Area End -->
        <!-- job post company Start -->
        <div class="job-post-company pt-120 pb-120">
            <div class="container">
                <div class="row justify-content-between">
                    <!-- Left Content -->
                    <div class="col-xl-7 col-lg-8">
                        <!-- job single -->
                        <div class="single-job-items mb-50">
                            <div class="job-items">
                                <div class="company-img company-img-details">
                                    <a href="#"><img src="assets/img/icon/job-list1.png" alt=""></a>
                                </div>
                                <div class="job-tittle">
                                    <a href="#">
                                        <h4><?php echo ucfirst($info['title']);?></h4>
                                    </a>
                                    <ul>
                                        <li><?php echo ucfirst($info['company_name']);?></li>
                                        <li><i class="fas fa-map-marker-alt"></i><?php echo ucfirst($info['city']);?></li>
                                        <li><?php echo "Exp. ". $info['start_experience']." - ".$info['end_experience'];?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                          <!-- job single End -->
                       
                        <div class="job-post-details">
                            <div class="post-details1 mb-50">
                                <!-- Small Section Tittle -->
                                <div class="small-section-tittle">
                                    <h4>Job Description</h4>
                                </div>
                                <p><?php echo $info['description'];?></p>
                            </div>
                         
                        </div>

                    </div>
                    <!-- Right Content -->
                    <div class="col-xl-4 col-lg-4">
                        <div class="post-details3  mb-50">
                            <!-- Small Section Tittle -->
                           <div class="small-section-tittle">
                               <h4>Job Overview</h4>
                           </div>
                          <ul>
                              <li>Posted date : <span><?php echo date('d-m-Y', strtotime($info['created_on']));?></span></li>
                              <li>Location : <span><?php echo ucfirst($info['city']);?></span></li>
                              <li>Experience :  <span><?php echo "Exp. ". $info['start_experience']." - ".$info['end_experience'];?></span></li>
                              <li>Company Name : <span><?php echo ucfirst($info['company_name']);?></span></li>
                          </ul>
                        <!--  <div class="apply-btn2">
                            <a href="#" class="btn">Apply Now</a>
                         </div> -->
                       </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- job post company End -->