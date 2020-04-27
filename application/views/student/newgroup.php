<?php
$this->load->view('student/header');
?>
<div class="content">
    <div class="container-fluid">
    <br clear="all">
        <div class="row">
            <div class="col-lg-6 mx-auto">
            <form method="POST" action="<?php base_url() ?>addnewgroup">
                <div class="form-group">
                    <label for="exampleInputEmail1">Group Name</label>
                    <input type="text" class="form-control"  placeholder="Enter Group Name" name="group_name">
                </div>
                <button type="submit" class="btn btn-primary">Add Group</button>
            </form>
            </div>
        </div>
    </div>
</div>

<script>
    $("#newg").addClass("actived");
    </script>
<?php
$this->load->view('student/footer.php');
?>