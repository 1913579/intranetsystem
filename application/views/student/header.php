
<html lang="eng">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.datatables.min.css"/>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style-employee.css?ssdjj">
    <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.datatables.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/front.js"></script>
    <title>DashBoard</title>
    
    
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark  bg-gradient fixed-top">
        <button class="navbar-toggler sideMenuToggler" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#"><img src="<?php echo base_url();?>assets/img/logo.png" class="logo" /></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto" >

    
      <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <?php
  foreach($user as $key=>$emp){
      $uphoto="profile.png";
      if($emp->uphoto!=""){
          $uphoto=$emp->uphoto;
      }
    ?>
    
 
          <img src='<?php echo base_url().'assets/profile/'.$uphoto;?>' class='gravatar' id="uprofile-s"/>
    <?php
  }
  ?>
  </a>
  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo base_url();?>Employee/profile">View Profile</a>
          <a class="dropdown-item" href="<?php echo base_url();?>Employee/requestchange">Request Change</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?php echo base_url();?>Student/process_logout">Logout Account</a>

        </div>
</li>



                
  </ul>

        </div>
    </nav>
    <div class="wraper d-flex">
        <div class="sideMenu">
            <div class="sidebar">
            <ul class="navbar-nav">
            <?php
  foreach($user as $key=>$emp){
      $uphoto="profile.png";
      if($emp->uphoto!=""){
          $uphoto=$emp->uphoto;
      }
    ?>
    
 
          <img src='<?php echo base_url().'assets/profile/'.$uphoto;?>' class='userP' id="uprofile-t"/>
          <span class="text text-center text-white"><?php echo $emp->uname;?> </span>
    <?php
  }
  ?>
<hr>  

                <li class="nav-item"><a href="<?php echo base_url();?>Student" class="nav-link slink" id="dashboard">
                        <i class="material-icons icon">
                            dashboard
                        </i><span class="text">Dashboard</span>
                    </a>
               
                </li>


                <li class="nav-item"><a href="<?php echo base_url();?>Student/newgroup" class="nav-link slink" id="newg">
                        <i class="material-icons icon">
                            group_add
                        </i><span class="text">New Group</span>
                    </a>
               
                </li>

                <li class="nav-item"><a href="<?php echo base_url();?>Student/groups" class="nav-link slink" id="groups">
                        <i class="material-icons icon">
                            people
                        </i><span class="text">Groups</span>
                    </a>
               
                </li>
                <li class="nav-item"><a href="<?php echo base_url();?>Student/work" class="nav-link slink" id="work">
                        <i class="material-icons icon">
                            work
                        </i><span class="text">Work</span>
                    </a>
               
                </li>
                <li class="nav-item"><a href="<?php echo base_url();?>Student/allstudentwork" class="nav-link slink" id="allwork">
                        <i class="material-icons icon">
                            group_work
                        </i><span class="text">All Students Work</span>
                    </a>
               
                </li>


            </ul>
            </div>
            
        </div>