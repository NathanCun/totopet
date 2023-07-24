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
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body dashboard-tabs p-0">
                  <ul class="nav nav-tabs px-4" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview" role="tab"
                        aria-controls="overview" aria-selected="true">Overview</a>
                    </li>
                  </ul>
                  <div class="tab-content py-0 px-0">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                      <div class="d-flex flex-wrap justify-content-xl-between">
                        <div
                          class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-email-open-outline me-3 icon-lg text-primary" ></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Total Unread message</small>
                            <h5 class="me-2 mb-0">
                                <?php include '../../php/count_message.php'; ?>
                            </h5>
                          </div>
                        </div>
                    
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Message</p>
                  

                        <!-- The Modal -->
                        <div id="myModal" class="modal">

                          <!-- Modal content -->
                          <div class="modal-content">
                            <span class="close">&times;</span>
                            <form class="forms-sample" method="POST" enctype="multipart/form-data">
                              <div class="form-group">
                                <label for="c-name">Name</label>
                                <input type="text" class="form-control" id="c-name" placeholder="Name" name="brand-name">
                              </div>
                              <div class="form-group">
                                <label>File upload</label>
                                <input type="file" class="file-upload-default" name="brand-image">
                                <div class="input-group col-xs-12">
                                  <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                  </span>
                                </div>
                              </div>
                              
                              <button type="submit" class="btn btn-primary me-2" name="input-data">Submit</button>
                            </form>
                          </div>

                        </div>
                        
                        
                        <script>
                          
                        </script>
                        
                  <div class="table-responsive">
                    <table id="recent-purchases-listing" class="table">
                      <thead>
                        <tr>
                          <th>date</th>
                          <th>Name</th>
                          <th>phone number</th>
                          <th>Message</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php include '../../php/show_table_message.php';
                        
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