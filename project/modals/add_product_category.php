<form method="POST" id="product_category">
<div class="modal fade" id="productCategory" tabindex="-1" role="dialog" aria-labelledby="product_categoryLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="product_categoryLabel"><span class='fa fa-plus-circle'></span> Add Product Category</h5>
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
                      <input type="hidden" id="action" name="action" value="add" >
                      <input type="text" autocomplete='off' id="prodCat" name="prodCat"  class="form-control" required >
                      <label for="prodCat">Name <span style="color:red">*</span></label>
                  </div>
                  <div class="md-form">
                      <textarea rows="3" style="resize: none;" class="form-control" id="catDescription" name="catDescription"></textarea>
                      <label for="catDesc">Description <span style="color:red">*</span></label>
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