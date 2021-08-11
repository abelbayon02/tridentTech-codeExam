<form method="POST" id="product">
<div class="modal fade" id="addproduct" tabindex="-1" role="dialog" aria-labelledby="addproductLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addproductLabel"><span class='fa fa-plus-circle'></span> Add Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <div class="card" style="">
              <div class="card-body">
                  <h6 id="register-response" style="margin-bottom: 30px;"></h6>
                  <div class="md-form">
                      <input type="hidden" id="action" name="action" value="add">
                      <input type="text" autocomplete='off' id="prodName" name="prodName"  class="form-control" required >
                      <label for="prodName">Name <span style="color:red">*</span></label>
                  </div>
                  <div class="md-form">
                      <select id="productCat" class="form-control" name="productCat">
                        <?=$prodCat->PRODUCT_CATEGORY()?>
                      </select>
                      <label for="productCat">Category <span style="color:red">*</span></label>
                  </div>
                   <div class="md-form">
                      <input type="number" autocomplete='off' id="price" name="price"  class="form-control" required >
                      <label for="price">Price <span style="color:red">*</span></label>
                  </div>
              </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" id="create_btn" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</form>