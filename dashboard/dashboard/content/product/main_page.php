<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between flex-wrap">
          <div class="d-flex align-items-end flex-wrap">
            <div class="me-md-3 me-xl-5">
            <h2>Welcome back, <?php echo $username; ?>.</h2>
            </div>
        </div>
      </div>
    </div>

    </div>

    <div class="row">
      <div class="col-md-12 stretch-card">
        <div class="card">
          <div class="card-body">
            
            <button id="show-modal-btn" type="submit" name="send-email" class="btn btn-primary" style="color: white">Add New +</button>
            <br><br>

                  <!-- The Modal -->
                  <div id="myModal" class="modal">

                    <!-- Modal content -->
                    <div class="modal-content">
                      <span class="close">&times;</span>
                      <form class="forms-sample" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                          <label for="c-name">Name</label>
                          <input type="text" class="form-control" id="c-name" placeholder="Name" name="product-name" autocomplete="off">
                        </div>
                        <div class="form-group">
                          <label>File upload</label>
                          <input type="file" class="file-upload-default" name="product-image" autocomplete="off">
                          <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                            <span class="input-group-append">
                              <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="description">Description</label>
                          <input type="text" class="form-control" id="description" placeholder="Description" name="product-description" autocomplete="off">
                        </div>
                        <div class="form-group">
                          <label for="animal-category">Price</label>
                          <input type="number" class="form-control" name="price" >
                        </div>
                        <div class="form-group">
                          <label for="animal-category">Animal Category</label>
                          <input type="text" class="form-control" id="animal-category" name="animal-category" >
                          <ul id="search-animal-category"></ul>
                        </div>

                        <div class="form-group">
                          <label for="product-category">Product Category</label>
                          <input type="text" class="form-control" id="product-category" name="product-category">
                          <ul id="search-category"></ul>
                        </div>
                        <button type="submit" class="btn btn-primary me-2" name="input-data">Submit</button>
                      </form>
                    </div>

                  </div>
                  
            <div class="table-responsive">
              <table id="recent-purchases-listing" class="table">
                <thead>
                  <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Category</th>
                  </tr>
                </thead>
                <tbody>
                  <?php include '../../php/show_table_product.php'; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>