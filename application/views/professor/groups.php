<?php
$this->load->view('professor/header');
?>
<div class="content">
    <div class="container-fluid">
        <br clear="all">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                <div class="card-header bg-primary" style="padding:0;">
                <h6 class="m-0 font-weight-bold text-light">
                
                <a href="<?php echo base_url().'Admin/newgroup/'?>" class="btn-top-card">Add New Group</a>
                </h6>
                </div>
                <div class="card-body">
            
            
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Nu</th>
                        <th>Group Name</th>
                        <th>Group</th>
                        <th>Work</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tfoot>
                        <tr>
                        <th>Nu</th>
                        <th>Group Name</th>
                        <th>Group</th>
                        <th>Work</th>
                        <th>Delete</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php if(!empty($groups)){
                            foreach($groups as $group){
                                echo "<tr>";
                                echo "<td>".$group->id."</td>";
                                echo "<td>".$group->name."</td>";
                                echo "<td><a href='".base_url()."Professor/team/".$group->id."'>Group Members</a></td>";
                                echo "<td><a href='".base_url()."Professor/assignwork/".$group->id."'>Assign Work</a></td>";
                                echo "<td><a href='".base_url()."Professor/deletegroup/".$group->id."'>Delete</a></td>";
                                echo "</tr>";
                            }
                        } ?>
                    </tbody>
                    </table>
                </div>
                </div>
                
            </div>
            
            </div> 
        </div>
    </div>
</div>


<script>
    $("#groups").addClass("actived");
    </script>
<?php
$this->load->view('professor/footer.php');
?>