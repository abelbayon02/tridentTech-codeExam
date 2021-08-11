<?php
$prodCat = new CoreFunctions();
?>
<div class="row">
  <div class="col-lg-12 col-md-6 col-sm-6">
    <div class="card">
      <div class="card-header card-header-info">
          <h4 class="card-title">Product Categories</h4>
          <p class="card-category">Manage product categories here!</p>
      </div>
      <div class="card-body">
        <div class="row">
            <div class='col-sm-12'>
                <button class='btn btn-sm btn-success pull-right' data-toggle='modal' data-target='#productCategory' id='productCategory_btn'><span class="fa fa-plus-circle"></span> Add Data </button>
            </div>
            <div class='col-sm-12'>
                <div class="table-responsive">
                    <table class="table table-hover" id='product_category_table'>
                    <thead class=" text-primary">
                        <!-- <th></th> -->
                        <th>#</th>
                        <th>NAME</th>
                        <th>DESCRIPTION</th>
                        <th>ACTION</th>
                    </thead>
                    <tbody>
                        <?php
                            $list = $prodCat->PRODUCT_CATEGORY_LIST();
                            if(is_array($list)){
                                foreach ($list as $data) {
                                    echo "<tr>";
                                        echo "<td>".$data['count']."</td>";
                                        echo "<td>".$data['name']."</td>";
                                        echo "<td>".$data['description']."</td>";
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
<?php include 'modals/add_product_category.php'; ?>
<script type="text/javascript">
$(document).ready( function(){
  $("#product_category_table").dataTable();

  $("#product_category").on("submit", function(e){
      e.preventDefault();
      $("#create_btn").prop("disabled", true);
      $("#create_btn").html("<span class='fa fa-spin fa-spinner'></span> Loading");
      var url = 'ajax/CRUD_category.php';
      var data = $(this).serialize();
      $.post(url, data, function(data){
        if(data == 1){
            alert_response("All Good!","Category Name Successfully Added!","success");
        }else if(data == 2){
            alert_response("Aw Snap!","Category Name Already Exist!","warning");
        }else{
            alert_response("Aw Snap!","Error while adding the data!","error");
        }
      });
  })
});

function updateCategory(category_id){
    var action = 'update';
    var name = $("#catName"+category_id).val();
    var categ = $("#catDesc"+category_id).val();
    var conf = confirm("Information of this category will change. Continue?");
    if(conf == true){
    $("#updateBtn"+category_id).prop("disabled", true);
    $("#updateBtn"+category_id).html("<span class='fa fa-spin fa-spinner'></span>");
    $.post("ajax/CRUD_category.php", {
        name: name,
        categ: categ,
        category_id: category_id,
        action: action
    }, function(data){
        if(data == 1){
            alert_response("All Good!","Category Name Successfully Updated!","success");
        }else if(data == 2){
            alert_response("Aw Snap!","Selected Name Already Exist!","warning");
        }else{
            alert_response("Aw Snap!","Error while adding the data!","error");
        }
    })  
    }
}
function deleteCategory(category_id){
    var action = 'delete';
    var conf = confirm("This Category will be deleted. Continue?");
    if(conf == true){
    $("#deleteBtn"+category_id).prop("disabled", true);
    $("#deleteBtn"+category_id).html("<span class='fa fa-spin fa-spinner'></span>");
    $.post("ajax/CRUD_category.php", {
        category_id: category_id,
        action: action
    }, function(data){
        if(data > 0){
            alert_response("All Good!","Category was Successfully Deleted!","success");
        }else{
            alert_response("Aw Snap!","Error while adding the data!","error");
        }
    })
    }
}
</script>