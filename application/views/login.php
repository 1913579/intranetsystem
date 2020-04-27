<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>assets/img/favicon.png">
<!-- Bootstrap4 files-->
<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

<style>
body{
    background-color:#333;
}
.logo{
    width:100px;
    height:30px;
    margin:auto;
    margin-top:10px;
    margin-bottom:10px;
}
input{
border-radius:5px;
width:70%;
margin:auto;
margin-bottom:10px;
}
button{
    border-radius:5px;
width:50%;
margin:auto;
margin-bottom:10px;
border:0;
}
@media(max-width:800px){
    input{
width:100%;
    }
.button{
    width:70%;
}
}
</style>
</head>
<body>

<form action="<?php echo base_url();?>Login/process_login" method="post" autocomplete="off" >
<div class="container-fluid">
<div class="row h-100">
   <div class="col-sm-12 my-auto">
     <div class="card card-block col-lg-4 bg-primary" style="margin:auto">
   

     <img src="<?php echo base_url();?>assets/img/logo.png" class="logo" alt="logo"/>
  
     <div class="control-group text-center">
                                          <label >User Name:</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="uname" id="focusedInput" type="text"placeholder="Enter User Name" required >
                
                                          </div>
                                        </div>
                                        
                                        <div class="control-group text-center">
                                          <label >Password:</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="upass" id="focusedInput" type="password"placeholder="Enter Password" required>
                                           
                                          </div>
                                        </div>
                                        <div class="control-group text-center">
                                          <label ></label>
                                          <div class="controls">
                                               
<button type="submit" class="btn btn-light">Login</button>

<br>
<br>
                                          </div>
                                        </div>
                                        <?php echo $this->session->flashdata('Error');?>

     </div>


   </div>
</div>
</div>
</form>
<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
</body>
</html>