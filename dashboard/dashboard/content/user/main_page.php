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
                          <i class="mdi mdi-account-outline me-3 icon-lg text-primary" ></i>
                          
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Total User</small>
                            <h5 class="me-2 mb-0">
                                <?php include '../../php/count_user.php'; ?>
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
          <!--  -->

          <div class="row">
            <div class="col-md-6">
              <div class="card">
                <div class="card-header">Rekening User</div>
                <div class="class-body">
                  <form action="" method="POST" class="form-group">
                    <div class="row m-3">
                      <div class="col-md-10">
                        <input type="text" name="pembayaran" value = "<?php echo pembayaran();?>" class="form-control">
                      </div>
                      <div class="col-md-2">
                      <button class="form-control" type="submit" name="update_pembayaran"><i class='fas fa-upload'></i></button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-12 stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Users</p>
                  
                  <button id="show-modal-btn" type="submit" name="send-email" class="btn btn-primary" style="color: white">Add New +</button>
                  <br><br>

                        <!-- The Modal -->
                        <div id="myModal" class="modal">

                          <!-- Modal content -->
                          <div class="modal-content">
                            <span class="close">&times;</span>
                            <form class="forms-sample" method="POST" enctype="multipart/form-data">
                              <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" placeholder="Username" name="user-username" autocomplete="off">
                              </div>
                              <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" class="form-control" id="password" placeholder="Password" name="user-password" autocomplete="off">
                              </div>
                              
                              <button type="submit" class="btn btn-primary me-2" name="input-data" style="color: white">Submit</button>
                            </form>
                          </div>

                        </div>
                        
                        
                  <div class="table-responsive">
                    <table id="recent-purchases-listing" class="table">
                      <thead>
                        <tr>
                          <th>Username</th>
                          <th>Password</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php include '../../php/show_table_user.php'; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->