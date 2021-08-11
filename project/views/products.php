<?php 
$prodCat = new CoreFunctions();
?>
<style type="text/css">

</style>
<div class="row">
  <div class="col-lg-12 col-md-6 col-sm-6">
    <div class="card">
      <div class="card-header card-header-info">
          <h4 class="card-title">Products</h4>
          <p class="card-category">Manage products here!</p>
      </div>
      <div class="card-body">
        <div class="row">
            <div class='col-sm-12'>
                <button class='btn btn-sm btn-primary pull-right' data-toggle='modal' data-target='#addproduct' id='product_btn'> Add Data </button>
            </div>
            <div class='col-sm-12'>
                <div class="table-responsive">
                    <table class="table table-hover" id='master_list'>
                    <thead class=" text-primary">
                        <!-- <th></th> -->
                        <th>#</th>
                        <th>NAME</th>
                        <th>PRICE</th>
                        <th>CATEGORY</th>
                        <th>DATE ADDED</th>
                        <th>ACTION</th>
                    </thead>
                    <tbody>
                        <?php
                            $list = $prodCat->PRODUCT_LIST();
                            if(is_array($list)){
                                foreach ($list as $data) {
                                    echo "<tr>";
                                        echo "<td>".$data['count']."</td>";
                                        echo "<td>".$data['name']."</td>";
                                        echo "<td>".$data['price']."</td>";
                                        echo "<td>".$data['category']."</td>";
                                        echo "<td>".$data['date_added']."</td>";
                                        echo "<td>".$data['action']."</td>";
                                    echo "</tr>";
                                }
                            }
                        ?>
                    </tbody>
                    </table>
                </div>
            </div>  
          
        </div>
      </div>
    </div>
  </div>
</div>
<?php include 'modals/add_product.php'; ?>
<script type="text/javascript">
$(document).ready( function(){
  $("#master_list").DataTable();

  $("#product").on("submit", function(e){
      e.preventDefault();
      $("#create_btn").prop("disabled", true);
      $("#create_btn").html("<span class='fa fa-spin fa-spinner'></span> Loading");
      var url = 'ajax/CRUD_product.php';
      var data = $(this).serialize();
      $.post(url, data, function(data){
        if(data == 1){
            alert_response("All Good!","Product Information Successfully Added!","success");
        }else if(data == 2){
            alert_response("Aw Snap!","Product Information Already Exist!","warning");
        }else{
            alert_response("Aw Snap!","Error while adding the data!","error");
        }
      });
  })

});
function updateproduct(product_id){
    var action = "update";
    var prodName = $("#prodName"+product_id).val();
    var categID = $("#categID"+product_id).val();
    var prodPrice = $("#prodPrice"+product_id).val();
    var conf = confirm("Information of this product will change. Continue?");
    if(conf == true){
        $("#updateBtn"+product_id).prop("disabled", true);
        $("#updateBtn"+product_id).html("<span class='fa fa-spin fa-spinner'></span>");
        $.post("ajax/CRUD_product.php", {
            action: action,
            prodName: prodName,
            categID: categID,
            prodPrice: prodPrice,
            product_id: product_id
        }, function(data){
            if(data == 1){
                alert_response("All Good!","Product Information Successfully Updated!","success");
            }else if(data == 2){
                alert_response("Aw Snap!","Product Information Already Exist!","warning");
            }else{
                alert_response("Aw Snap!","Error while adding the data!","error");
            }
        })
    }
    
}
function deleteproduct(product_id){
    var action = "delete";
    var conf = confirm("This product will be deleted. Continue?");
    if(conf == true){
    $("#deleteBtn"+product_id).prop("disabled", true);
    $("#deleteBtn"+product_id).html("<span class='fa fa-spin fa-spinner'></span>");
    $.post("ajax/CRUD_product.php", {
        product_id: product_id,
        action: action
    }, function(data){
        if(data > 0){
            alert_response("All Good!","Product was Successfully Deleted!","success");
        }else{
            alert_response("Aw Snap!","Error while adding the data!","error");
        }
    })
    }
}
</script>