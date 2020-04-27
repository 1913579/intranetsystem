
<?php
$this->load->view('admin/header');
?>

<div class="content">
            
            <main>
                    <div class="container-fluid">
    
             <br clear="all">
<div class="row">
<div class="col-lg-6 mx-auto">
<form method="post" action="<?php echo base_url();?>Admin/submitnewuser" enctype="multipart/form-data">
<div class="form-group">
    <label for="uname">User Name</label>
    <input type="text" class="form-control" id="uname"  placeholder="User Name" name="uname">
  </div>


  <div class="form-group">
    <label for="upass">Password</label>
    <input type="password" class="form-control" id="upass"  placeholder="Password" name="upass">
  </div>


  <div class="form-group">
    <label for="fname">First Name</label>
    <input type="text" class="form-control" id="fname"  placeholder="First Name" name="first_name">
  </div>

  <div class="form-group">
    <label for="lname">Last Name</label>
    <input type="text" class="form-control" id="lname"  placeholder="Last Name" name="last_name">
  </div>

  <div class="form-group">
    <label for="email">Email Address</label>
    <input type="email" class="form-control" id="email"  placeholder="Email Address" name="email">
  </div>


  <div class="form-group">
    <label for="level">User Type</label>
    <select id="level" class="form-control" name="level">
<option value="1">Professor</option>
<option value="2">Student</option>
    </select>
  </div>

  <div class="form-group">
  <label for="uphoto">User Profile Photo</label>
<input class="form-control" type="file" name="uphoto" id="uphoto"> 

  </div>

<div class="row">
<div class="col-4 mx-auto">
<button type="submit" class="btn btn-primary">Create Account</button>
</div>
</div>
<br><br>
</form>
</div>
<br><br>

             </div>
            
             </main>
             </div>
<script>
    $("#newu").addClass("actived");
    $("title").html("New User");
    </script>
<?php
$this->load->view('admin/footer.php');
?>