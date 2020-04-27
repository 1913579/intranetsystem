
<?php
$this->load->view('admin/header');
?>

<div class="content">
            
            <main>
                    <div class="container-fluid">
    
             <br clear="all">
             <div class="row">

<div class="col-12">

             <div class="card shadow mb-4">
            <div class="card-header bg-primary" style="padding:0;">
              <h6 class="m-0 font-weight-bold text-light">
              
              <a href="<?php echo base_url().'Admin/newuser/'?>" class="btn-top-card">Add New User</a>
              </h6>
            </div>
            <div class="card-body">
           
           
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                  <tr>
                  <th>Nu</th>
                      <th>User Name</th>
                      <th>User Level</th>
                      <th>View User</th>
                    
                     
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                    <th>Nu</th>
                      <th>User Name</th>
                      <th>User Level</th>
                      <th>View User</th>
            
                    
                     
                    
                    </tr>
                  </tfoot>
                  <tbody>
<?php
$i=0;
$j=0;


foreach($users as $key=>$user){
  $j++;
?>

<tr>
<td><?php echo $j;?></td>
<td><?php echo $user->uname;?></td>
<td>

<?php if($user->ustatus==0){
    echo "Admin";
}else if($user->ustatus==1){
    echo "Professor";
}else{
    echo "Student";
}
?>


</td>
<td><a href="<?php echo base_url();?>Admin/viewuser/<?php echo $user->id;?>">View User</a></td>
                    </tr>


                    





<?php
$i++;
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
             </main>
             </div>
<script>
    $("#users").addClass("actived");
    $("title").html("Users");
    </script>
<?php
$this->load->view('admin/footer.php');
?>u