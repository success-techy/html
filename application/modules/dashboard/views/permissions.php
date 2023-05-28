<div class="content-inner">
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Permissions</h2>
        </div>
    </header>
    <!-- Breadcrumb-->
    <div class="breadcrumb-holder container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?php echo base_url();?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Permissions</li>
        </ul>
    </div>
 <div class="pull-right">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-item">Add New Variations</button>
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
              <h3 class="h4">Vendors Permissions</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">                       
                <table class="table table-striped table-hover" id="myTable">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Sub Vendor</th>
                      <th>Contact</th>
                      <th>Modules</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>Mr. Johnson</td>
                      <td>+9-9898-989-985</td>
                      <td>Deals, Cms, Dashboard, Income</td>
                      <td>Active</td>
                      <td>
                        <button onclick="confirm_delete(this);"><i class="fa fa-times red"></i></button>
                      </td>
                    </tr>

                    <tr>
                      <th scope="row">1</th>
                      <td>Mr. WidWicky</td>
                      <td>+1-659-965-9865</td>
                      <td>Deals, Cms, Dashboard, Income, Mail, Reports</td>
                      <td>Active</td>
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

    <!-- Create Item Modal -->
    <div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-m" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Add New Deal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                  <div class="card-body">
                      <form class="form-horizontal form-validate" action="<?php echo base_url('product/do_add_variation');?>" method="post">

                          <div class="row">
                              <div class="col-md-12">

                                  <div class="form-group row">
                                      <label class="col-sm-4 form-control-label">Select Sub vendor</label>
                                      <div class="col-sm-8">
                                          <select class="form-control" name=deal_duration_type required>
                                              <option value="">Select Sub-Vendor</option>
                                              <option value="1">name 1</option>
                                              <option value="2">name 2</option>
                                          </select>
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <label class="col-sm-12 form-control-label">Select Modules</label>
                                      <div class="col-sm-12">
                                          <table class="table table-striped table-hover" id="myTable">
                                            <thead>
                                                <tr>
                                                  <th>#</th>
                                                  <th>Modules Name</th>
                                                  <th>Select</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              <tr>
                                                <th>1</th>
                                                <td>Deals</td>
                                                <td><input type="checkbox" name=""></td>
                                              </tr>

                                              <tr>
                                                <th>2</th>
                                                <td>Clients</td>
                                                <td><input type="checkbox" name=""></td>
                                              </tr>

                                              <tr>
                                                <th>3</th>
                                                <td>Dashboard</td>
                                                <td><input type="checkbox" name=""></td>
                                              </tr>

                                              <tr>
                                                <th>4</th>
                                                <td>Loyalty</td>
                                                <td><input type="checkbox" name=""></td>
                                              </tr>

                                              <tr>
                                                <th>5</th>
                                                <td>income</td>
                                                <td><input type="checkbox" name=""></td>
                                              </tr>

                                              <tr>
                                                <th>6</th>
                                                <td>product</td>
                                                <td><input type="checkbox" name=""></td>
                                              </tr>

                                              <tr>
                                                <th>7</th>
                                                <td>CMS</td>
                                                <td><input type="checkbox" name=""></td>
                                              </tr>
                                            </tbody>
                                          </table>
                                      </div>
                                  </div>

                              </div>
                          </div>
                          <div class="line"></div>
                          <div class="form-group row">
                              <button type="submit" class="btn btn-primary">Save</button>&nbsp;&nbsp;
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> 
                          </div>
                      </form>
                  </div>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">

// products
// add_buy_get_option

$('.subcategory_blk').hide();
$("#category").on('change',function(){
var id=$(this).val();
$.ajax({
type:"POST",
url:"<?php echo site_url();?>product/get_sub_category",
data:{'id':id},
dataType:'json',
success: function(response)
{ console.log(response);
var ln=response.length;
if(ln>=1)
{
var cnt;
for(var i=0;i<=ln-1;i++)
{
cnt+='<option value="'+response[i]['id']+'">'+response[i]['name']+'</option>';

}

$('.subcategory_blk').show();
$('#subcategory').html('');
$('#subcategory').html(cnt);

}
else
{
$('.subcategory_blk').hide();
}

}
});
});
var id=$('#category').val();
$.ajax({
type:"POST",
url:"<?php echo site_url();?>product/get_sub_category",
data:{'id':id},
dataType:'json',
success: function(response)
{ 
var ln=response.length;
if(ln>=1)
{
var cnt;
for(var i=0;i<=ln-1;i++)
{
cnt+='<option value="'+response[i]['id']+'">'+response[i]['name']+'</option>';

}

$('.subcategory_blk').show();
$('#subcategory').html('');
$('#subcategory').html(cnt);

}
else
{
$('.subcategory_blk').hide();
}

}
});

$('.edit-item').on('click', function(){
var id=$(this).data('edit');
$.ajax({
type:"POST",
url:"<?php echo site_url();?>product/get_variation_info",
data:{'id':id},
dataType:'json',
success: function(response)
{ 
var ln=response.length;
$('#sku').val(response[0]['sku']);
$('#product_id').val(response[0]['product_id']);
$('#batch_id').val(response[0]['batch_id']);
$('#amount').val(response[0]['amount']);
$('#bar_code').val(response[0]['barcode']);
$('#man_date').val(response[0]['man_date']);
$('#exp_date').val(response[0]['exp_date']);
$('#var_id_updt').val(response[0]['var_id']);
var cnt;
$('#edit-item').modal('show');
for(var i=0;i<=ln-1;i++)
{
$('#id_'+response[i]['orgin_attr_id']).val(response[i]['attr_id']); 
$('#vl_'+response[i]['orgin_attr_id']).val(response[i]['value']);         
}
}
});
});

$('.remove-item').on('click', function(){
if(confirm('Are you want to delete?'))
{
var id=$(this).data('edit');
$.ajax({
type:"POST",
url:"<?php echo site_url();?>product/change_status",
data:{'id':id},
dataType:'json',
success: function(response)
{ 
// / location.reload();
}
});
}

});

</script>
