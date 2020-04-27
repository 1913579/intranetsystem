<?php
$this->load->view('admin/header');
?>
        <div class="content">
        <main>
        <div class="container-fluid">


                
      <style>
    .result li{
        margin: 0;
        padding: 7px 10px;
        border: 1px solid #CCCCCC;
        border-top: none;
        cursor: pointer;
		list-style-type:none;
        height:60px;
    }
	.result{
		margin:0;
		padding:0;
	}
    .result li:hover{
        background: #f2f2f2;
    }
	.result li.selected {background:yellow}
	#group-info{
		width:100%;
		height:200px;
	}
    .leftimage{
        float:left;
    }
    .leftimage img{
width:50px;
height:50px;
    }
    .rightimage{
        height:50px;
        line-height:50px;
float:left;
    }
    .fullwidth{
        width:100%;
    }
    .img70{
        margin-top:5px;
        margin-bottom:5px;
        width:70px;
        height:70px;
        border-radius:50%;
    }
      </style>
<br clear="all">

         <?php
foreach($projects as $key=>$project){
    $teamlead=$project->t_lead;
   
?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
   <div class="card-header py-3">
     <h6 class="m-0 font-weight-bold text-primary">Team</h6>
   </div>
   <div class="card-body">
     
        <br clear="all">
               




                                       

                                      
<div class="col-lg-6">

                                        <div class="control-group">
                                        <label >Team Members:</label>
                                          <div class="controls">
                                          <div class="search-box">
        <input type="text" autocomplete="off" id="SearchU" class="fullwidth" placeholder="Search Employee..." />
        <ul class="result"></ul>
    </div>
                     
                                          </div>
                                        </div>

                                        </div>
<br clear="all">
                                        <div id="users_names" class="row">
                                     
             <?php
             if($team!=null){
             $i=0;
foreach($team as $key=>$tmember){
    $tid= $team[$i]['id'];
    $uphoto="profile.png";
    if($team[$i]['uphoto']!=""){
        $uphoto=$team[$i]['uphoto'];
    }
    
?>
   <div class="col-lg-3 col-sm-6 text-center" id="usert<?php echo $team[$i]['id'];?>">
            <div class="card">
                <div class="card-block">
                    <div class="card-title bg-primary">
                    <img src="<?php echo base_url();?>assets/profile/<?php echo $uphoto;?>" class="img70"/>
                    </div>
                    <div class="card-text">
                  <strong>  Name:<?php echo $team[$i]['uname'];?><br>
                    <div id="lead<?php echo $tid;?>" class="userlead<?php echo $team[$i]['user_id'];?>">
                    <?php if($team[$i]['user_id']==$teamlead){
                  echo "<span class='text-warning'>Team Leader*</span>";
                    }else{
                                          
                    ?>
                    <a href="#" onclick="teamlead('<?php echo $tid;?>')"class="text-success">  Make Team Lead</a>
                    <?php
}
?>
</div>
                    <div id="remove<?php echo $tid;?>">
                    <a href="#" onclick="remove('<?php echo $tid;?>')" class="text-danger"> Remove Member</a>
                    </a>
                    </div>
                    </strong>
                    </div>
                    
                </div>
                </div>
              
                </div>
                <?php
$i++;
}
             }else{
               
             }
?>
           
       
      

                                      


         
</div>
</div>
</div>
<?php
}?>
       
                  
    
<script src="<?php echo base_url();?>assets/ckeditor/ckeditor.js"></script>

          <script>


$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        if(inputVal.length==0){
$(".result").html("");
        }
		if(inputVal.length>1){
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.post("<?php echo base_url();?>Admin/searchUser", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
		}
    });
  
    // Set search input value on click of result item
    $(document).on("click", ".result li", function(){
       $(this).parents(".search-box").find('input[type="text"]').val("");
        $('.result').html("");
    });
});
 
 
 
function addMember($id){
    $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>Admin/addMember",
            data: {
            uid:$id,
            pid:<?php echo $pid;?>		
			}
        }).done(function (result) {
		if(result=="duplicate"){
            alert("User is already part of team.");
		}else{
            $("#users_names").html( result+$("#users_names").html());
			
        }
        });	 
        

}

 function teamlead(tid){
     msg='<span class="text-warning">Team Leader*</span>';
     
    $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>Admin/teamLead",
            data: {
            tid:tid	
			}
        }).done(function (result) {
		if(result=="already"){
            alert("User is already team leader.");
		}else{
            if(result==true){
            $("#lead"+tid).html(msg);
            }else{
               var classId=$(".userlead"+result).attr("id");
               
               var arrayc=classId.split("d");
               
                mymsg='<a href="#" onclick="teamlead('+result+')" class="text-success">  Make Team Lead</a>';
                $(".userlead"+result).html(mymsg);
                $("#lead"+tid).html(msg);
            }
        }
        });	
            
}
function remove(tid){
    $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>Admin/removemem",
            data: {
            tid:tid	
			}
        }).done(function (result) {
		if(result=="already"){
            alert("User is already removed.");
		}else{
           
            $("#usert"+tid).css("display","none");	
        }
        });	
}
</script>
                    
            </main>
        </div>
    </div>
<?php
$this->load->view('admin/footer.php');
?>