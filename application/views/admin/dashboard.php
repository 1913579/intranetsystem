
<?php
$this->load->view('admin/header');
?>

<div class="content">
            
            <main>
                    <div class="container-fluid">
    
             <br clear="all">
             <div class="row">



             <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Users</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                     <?php echo $totalusers ?>

                      </div>
                    </div>
                    <div class="col-auto">
                    <i class="material-icons iconbig">
                    people
                                </i>
                    </div>
                  </div>
                </div>
              </div>
</div>
                      


<div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Professors</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <?php echo $professors ?>

                      </div>
                    </div>
                    <div class="col-auto">
                    <i class="material-icons iconbig">
                                    people
                                </i>
                    </div>
                  </div>
                </div>
              </div>
</div>
                      


<div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Students</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <?php echo $students ?>

                      </div>
                    </div>
                    <div class="col-auto">
                    <i class="material-icons iconbig">
                    people
                                </i>
                    </div>
                  </div>
                </div>
              </div>
</div>
             

<div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Admins</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                   <?php echo $admins ?>
                      </div>
                    </div>
                    <div class="col-auto">
                    <i class="material-icons iconbig">
                    people
                                </i>
                    </div>
                  </div>
                </div>
              </div>
</div>
             

</div>
             

             </div>
             </div>
             </main>
             </div>
<script>
    $("#dashboard").addClass("actived");
    </script>
<?php
$this->load->view('admin/footer.php');
?>