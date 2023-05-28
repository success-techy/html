    <style type="text/css">
        .single-job-items{
            border: 1px solid #ededed;
        }
    </style>
    <!-- Hero Area Start-->
        <div class="slider-area ">
            <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="<?php echo base_url('/assets/web_assets/');?>assets/img/hero/about.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>Find your Job</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Area End -->
        <!-- Job List Area Start -->
        <div class="job-listing-area pt-120 pb-120">
            <div class="container">
                <div class="row">
                    <!-- Left content -->
                    <div class="col-xl-3 col-lg-3 col-md-4">
                        <div class="row">
                            <div class="col-12">
                                    <div class="small-section-tittle2 mb-45">
                                    <div class="ion"> <svg 
                                        xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="20px" height="12px">
                                    <path fill-rule="evenodd"  fill="rgb(27, 207, 107)"
                                        d="M7.778,12.000 L12.222,12.000 L12.222,10.000 L7.778,10.000 L7.778,12.000 ZM-0.000,-0.000 L-0.000,2.000 L20.000,2.000 L20.000,-0.000 L-0.000,-0.000 ZM3.333,7.000 L16.667,7.000 L16.667,5.000 L3.333,5.000 L3.333,7.000 Z"/>
                                    </svg>
                                    </div>
                                    <h4>Filter Jobs</h4>
                                </div>
                            </div>
                        </div>
                        <!-- Job Category Listing start -->
                        <div class="job-category-listing mb-50">
                            <!-- single one -->
                            <div class="single-listing">
                               <div class="small-section-tittle2">
                                     <h4>Job Category</h4>
                               </div>
                                <!-- Select job items start -->
                                <div class="select-job-items2">
                                    <select name="select" data-type="category" onchange="change_status(this)" id="page_limit">
                                        <option value="">All Category</option>
                                        <?php foreach($category as $k => $v){?>
                                            <option value="<?php echo $v['id'];?>"><?php echo $v['name'];?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!--  Select job items End-->
                                <!-- select-Categories start -->
                                <div class="select-Categories pt-80 pb-50" style="display: none;">
                                    <div class="small-section-tittle2">
                                     <h4>Job Location</h4>
                               </div>
                                <!-- Select job items start -->
                                <div class="select-job-items2">
                                    <select name="select" data-type="location" onchange="change_status(this)" id="location">
                                        <option value="">All City</option>
                                        <?php foreach($city as $k => $v){?>
                                            <option value="<?php echo $v; ?>"><?php echo $v;?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="select-Categories pt-80 pb-50" style="display: none;">
                                    <div class="small-section-tittle2">
                                        <h4>Experience</h4>
                                    </div>
                                     <select name="select" data-type="experience" onchange="change_status(this)" id="experience">
                                        <option value="">All</option>
                                        <option value="0_2">0 - 2 Years</option>
                                        <option value="2_3">2 - 3 Years</option>
                                        <option value="3_4">3 - 4 Years</option>
                                        <option value="4_5">4 - 5 Years</option>
                                        <option value="5">5 + Years</option>
                                    </select>
                                    <!-- <label class="container">0 - 2 Years
                                        <input type="checkbox" checked="checked active">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">2 - 3 Years
                                        <input type="checkbox" checked="checked active">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">3 - 6 Years
                                        <input type="checkbox" checked="checked active">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">6 + Years
                                        <input type="checkbox" checked="checked active">
                                        <span class="checkmark"></span>
                                    </label> -->
                                </div>
                                </div>
                                <!-- select-Categories End -->
                            </div>
                            <!-- single two -->
                           
                            <!-- single three -->
                            
                           
                        </div>
                        <!-- Job Category Listing End -->
                    </div>
                    <!-- Right content -->
                    <div class="col-xl-9 col-lg-9 col-md-8">
                        <!-- Featured_job_start -->
                        <section class="featured-job-area">
                            <div class="container">
                                <!-- Count of Job list Start -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="count-job mb-35">
                                         <!--    <span>39, 782 Jobs found</span> -->
                                            <!-- Select job items start -->
                                          <!--   <div class="select-job-items">
                                                <span>Sort by</span>
                                                <select name="select">
                                                    <option value="">None</option>
                                                    <option value="">job list</option>
                                                    <option value="">job list</option>
                                                    <option value="">job list</option>
                                                </select>
                                            </div> -->
                                            <!--  Select job items End-->
                                        </div>
                                    </div>
                                </div>
                                <!-- Count of Job list End -->
                                <!-- single-job-content -->
                            <span id="main-list">
                                <?php foreach($jobs as $k => $v){ ?>
                                <div class="single-job-items mb-30">
                                    <div class="job-items">
                                        <div class="company-img">
                                          <!--   <a href="#"><img src="assets/img/icon/job-list1.png" alt=""></a> -->
                                        </div>
                                        <div class="job-tittle job-tittle2">
                                            <a href="#">
                                                <h4><?php echo ucfirst($v['title']);?></h4>
                                            </a>
                                            <ul>
                                                <li><?php echo ucfirst($v['company_name']);?></li>
                                                <li><i class="fas fa-map-marker-alt"></i><?php echo ucfirst($v['city']);?></li>
                                                <li><?php echo "Exp. ". $v['start_experience']." - ".$v['end_experience'];?></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="items-link items-link2 f-right">
                                        <a href="<?php echo base_url('home/view/').base64_encode($v['id']);?>">View</a>
                                    </div>
                                </div>
                            <?php }?>
                            <span id="view_more"></span>
                        </span>
                            </div>
                        </section>
                         <div class="apply-btn2">
                            <center><button class="btn" data-id="0" data-type="view" onclick="change_status(this)" id="page_limit">View More</button></center>
                         </div>
                        <!-- Featured_job_end -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Job List Area End -->
        <!--Pagination Start  -->
       <!--  <div class="pagination-area pb-115 text-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="single-wrap d-flex justify-content-center">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-start">
                                    <li class="page-item active"><a class="page-link" href="#">01</a></li>
                                    <li class="page-item"><a class="page-link" href="#">02</a></li>
                                    <li class="page-item"><a class="page-link" href="#">03</a></li>
                                <li class="page-item"><a class="page-link" href="#"><span class="ti-angle-right"></span></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!--Pagination End  -->

        <script src="<?php echo site_url('assets');?>/plugins/jquery/jquery.min.js"></script>
         <script>
    function change_status(e){
          var id = $(e).attr('data-id');
          var type = $(e).attr('data-type');
          $.ajax({
              url: "<?php echo base_url(); ?>home/getJobList",
              type: "post",
              data: {id:id, type:type, selectedval: $(e).val()},
              success: function(res){
                  var obj = JSON.parse(res);
                  if(type=="view"){
                    $(e).attr('data-id', parseInt(id)+14);
                    $('#view_more').append(processing(obj));
                  } else if(type=="location"){
                    $('#main-list').html("");
                    $('#main-list').html(processing(obj));
                  }else if(type=="experience"){
                    $('#main-list').html("");
                    $('#main-list').html(processing(obj));  
                }else if(type=="category"){
                    $('#main-list').html("");
                    $('#main-list').html(processing(obj));
                  }
                 
              },
              error: function(err){
                  console.log(err);
              }
          });
 
  }

  function processing(obj){
     let base = "<?php echo base_url('/home/view/');?>";
                 //console.log(obj);
                 let htmlContent="";
                 for (var i = 0; i < obj.length; i++) {
                      htmlContent = htmlContent + '<div class="single-job-items mb-30">'+
                                    '<div class="job-items">'+
                                        '<div class="company-img">'+
                                        '</div>'+
                                        '<div class="job-tittle job-tittle2">'+
                                            '<a href="#">'+
                                                '<h4>'+ obj[i].title.charAt(0).toUpperCase() + obj[i].title.slice(1) +'</h4>'+
                                            '</a>'+
                                            '<ul>'+
                                                '<li>'+obj[i].company_name+'</li>'+
                                                '<li><i class="fas fa-map-marker-alt"></i>'+obj[i].city+'</li>'+
                                                '<li>'+obj[i].start_experience+' - '+obj[i].end_experience+'</li>'+
                                            '</ul>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="items-link items-link2 f-right">'+
                                        '<a href="'+base+btoa(obj[i].id)+'">View</a>'+
                                    '</div>'+
                                '</div>';
                 }
        return htmlContent;
  }

 
</script>