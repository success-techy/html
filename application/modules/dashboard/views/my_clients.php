        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">My Clients</h2>
            </div>
          </header>
          <!-- Breadcrumb-->
          <div class="breadcrumb-holder container-fluid">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
              <li class="breadcrumb-item active">My Clients</li>
            </ul>
          </div>


          <section class="tables">   
            <div class="container-fluid">
              <div class="row">
		        <div class="col-lg-12">
		          <div class="card">
		            <div class="card-close">
		              <div class="dropdown">
		                <button type="button" id="closeCard3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
		                <div aria-labelledby="closeCard3" class="dropdown-menu dropdown-menu-right has-shadow">
		                  <a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a>
		                </div>
		              </div>
		            </div>
		            <div class="card-header d-flex align-items-center">
		              <h3 class="h4">Clients List</h3>
		            </div>
		            <div class="card-body">
		              <div class="table-responsive">                       
		                <table class="table table-striped table-hover" id="myTable">
		                  <thead>
		                    <tr>
		                      <th>#</th>
		                      <th>Client Name</th>
		                      <th>Mail</th>
		                      <th>Contact</th>
		                      <th>Member Since</th>
		                    </tr>
		                  </thead>
		                  <tbody>
		                    <tr>
		                      <th scope="row">1</th>
		                      <td>Kristen Stewart</td>
		                      <td>Kristen@gmail.com</td>
		                      <td>+1-987-987-9879</td>
		                      <td>15 Feb 2019</td>
		                      <!-- <td>
		                        <button onclick="confirm_delete(this);"><i class="fa fa-times red"></i></button>
		                      </td> -->
		                    </tr>

		                    <tr>
		                      <th scope="row">2</th>
		                      <td>Billy Burke</td>
		                      <td>Billy@gmail.com</td>
		                      <td>+1-987-987-9879</td>
		                      <td>14 Feb 2019</td>
		                      <!-- <td>
		                        <button onclick="confirm_delete(this);"><i class="fa fa-times red"></i></button>
		                      </td> -->
		                    </tr>

		                    <tr>
		                      <th scope="row">3</th>
		                      <td>Peter Facinelli</td>
		                      <td>Peter@gmail.com</td>
		                      <td>+1-987-987-9879</td>
		                      <td>16 Feb 2019</td>
		                      <!-- <td>
		                        <button onclick="confirm_delete(this);"><i class="fa fa-times red"></i></button>
		                      </td> -->
		                    </tr>

		                    <tr>
		                      <th scope="row">4</th>
		                      <td>Elizabeth Reaser</td>
		                      <td>Elizabeth@gmail.com</td>
		                      <td>+1-987-987-9879</td>
		                      <td> 08 Feb 2019</td>
		                      <!-- <td>
		                        <button onclick="confirm_delete(this);"><i class="fa fa-times red"></i></button>
		                      </td> -->
		                    </tr>

		                    <tr>
		                      <th scope="row">5</th>
		                      <td>Ashley Greene</td>
		                      <td>Ashley@gmail.com</td>
		                      <td>+1-987-987-9879</td>
		                      <td> 07 Feb 2019</td>
		                      <!-- <td>
		                        <button onclick="confirm_delete(this);"><i class="fa fa-times red"></i></button>
		                      </td> -->
		                    </tr>

		                    <tr>
		                      <th scope="row">6</th>
		                      <td>Kellan Lutz</td>
		                      <td>Kellan@gmail.com</td>
		                      <td>+1-987-987-9879</td>
		                      <td> 06 Feb 2019</td>
		                      <!-- <td>
		                        <button onclick="confirm_delete(this);"><i class="fa fa-times red"></i></button>
		                      </td> -->
		                    </tr>

		                    <tr>
		                      <th scope="row">7</th>
		                      <td>Nikki Reed</td>
		                      <td>Nikki@gmail.com</td>
		                      <td>+1-987-987-9879</td>
		                      <td> 05 Feb 2019</td>
		                      <!-- <td>
		                        <button onclick="confirm_delete(this);"><i class="fa fa-times red"></i></button>
		                      </td> -->
		                    </tr>

		                    <tr>
		                      <th scope="row">8</th>
		                      <td>Jackson Rathbone</td>
		                      <td>Jackson@gmail.com</td>
		                      <td>+1-987-987-9879</td>
		                      <td> 04 Feb 2019</td>
		                      <!-- <td>
		                        <button onclick="confirm_delete(this);"><i class="fa fa-times red"></i></button>
		                      </td> -->
		                    </tr>

		                    <tr>
		                      <th scope="row">9</th>
		                      <td>Judi Shekoni</td>
		                      <td>Judi@gmail.com</td>
		                      <td>+1-987-987-9879</td>
		                      <td> 03 Feb 2019</td>
		                      <!-- <td>
		                        <button onclick="confirm_delete(this);"><i class="fa fa-times red"></i></button>
		                      </td> -->
		                    </tr>

		                    <tr>
		                      <th scope="row">10</th>
		                      <td>Christian Camargo</td>
		                      <td>Christian@gmail.com</td>
		                      <td>+1-987-987-9879</td>
		                      <td> 02 Feb 2019</td>
		                      <!-- <td>
		                        <button onclick="confirm_delete(this);"><i class="fa fa-times red"></i></button>
		                      </td> -->
		                    </tr>

		                    <tr>
		                      <th scope="row">11</th>
		                      <td>Mía Maestro</td>
		                      <td>Mía@gmail.com</td>
		                      <td>+1-987-987-9879</td>
		                      <td> 01 Feb 2019</td>
		                      <!-- <td>
		                        <button onclick="confirm_delete(this);"><i class="fa fa-times red"></i></button>
		                      </td> -->
		                    </tr>


		                  </tbody>
		                </table>
		              </div>
		            </div>
		          </div>
		        </div>
		      </div>
		    </div>
		  </section>


    


<script type="text/javascript" src="http://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

<script type="text/javascript">
    $(document).ready( function () {
        $('#myTable').DataTable();
    });

    function confirm_delete(that) {
        confirm("Do you want to delete this Clients?");
    }

</script>