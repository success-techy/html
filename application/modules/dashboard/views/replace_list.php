        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Replace</h2>
            </div>
          </header>
          <!-- Breadcrumb-->
          <div class="breadcrumb-holder container-fluid">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
              <li class="breadcrumb-item active">Replace</li>
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
		              <h3 class="h4">Replace Orders</h3>
		            </div>
		            <div class="card-body">
		              <div class="table-responsive">                       
		                <table class="table table-striped table-hover" id="myTable">
		                  <thead>
		                    <tr>
		                      <th>#</th>
		                      <th>Order ID</th>
		                      <th>User</th>
		                      <th>Price</th>
		                      <th>Purchase date</th>
		                      <th>replace date</th>
		                      <th>Reason</th>
		                      <th>Status</th>
		                      <th>Action</th>
		                    </tr>
		                  </thead>
		                  <tbody>
		                    <tr>
		                      <th scope="row">1</th>
		                      <td>D51A24A62A586659</td>
		                      <td>Billy Burke</td>
		                      <td>SAR 159.00</td>
		                      <td>15-02-2019</td>
		                      <td>19-02-2019</td>
		                      <td>Due to Some Technical Issue</td>
		                      <td>Requested</td>
		                      <td>
		                        <button onclick="confirm_delete(this);"><i class="fa fa-times red"></i></button>
		                      </td>
		                    </tr>


		                    <tr>
		                      <th scope="row">2</th>
		                      <td>D51A24A62A586619</td>
		                      <td>Billy Burke</td>
		                      <td>SAR 969.00</td>
		                      <td>16-02-2019</td>
		                      <td>17-02-2019</td>
		                      <td>system Issue</td>
		                      <td>Requested</td>
		                      <td>
		                        <button onclick="confirm_delete(this);"><i class="fa fa-times red"></i></button>
		                      </td>
		                    </tr>


		                    <tr>
		                      <th scope="row">4</th>
		                      <td>D51A24A62A586632</td>
		                      <td>Billy Burke</td>
		                      <td>SAR 62.00</td>
		                      <td>11-02-2019</td>
		                      <td>13-02-2019</td>
		                      <td>No issue</td>
		                      <td>Replaced</td>
		                      <td>
		                        <button onclick="confirm_delete(this);"><i class="fa fa-times red"></i></button>
		                      </td>
		                    </tr>


		                    <tr>
		                      <th scope="row">5</th>
		                      <td>D51A24A62A586611</td>
		                      <td>Billy Burke</td>
		                      <td>SAR 199.00</td>
		                      <td>15-02-2019</td>
		                      <td>19-02-2019</td>
		                      <td>Due to Some Technical Issue</td>
		                      <td>Requested</td>
		                      <td>
		                        <button onclick="confirm_delete(this);"><i class="fa fa-times red"></i></button>
		                      </td>
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