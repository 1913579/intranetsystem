<?php
$this->load->view('student/header');
?>
<div class="content">
    <div class="container-fluid">
        <br clear="all">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <form method="POST" action="<?php echo base_url() ?>Student/newassignwork/<?php echo $group_id ?>" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="title">Work Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                  </div>    
                  <div class="form-group">
                    <label for="exampleInputEmail1">Work Description</label>
                    <textarea  class="form-control" id="exampleInputEmail1" rows="12" name="description" required></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Attachment</label>
                    <input type="file" class="form-control" id="exampleInputPassword1" name="attachment" required>
                  </div>
                  <button type="submit" class="btn btn-primary mt-2">Assign</button>
                </form>
            </div>
        </div>
    </div
</div>

<?php
$this->load->view('student/footer.php');
?>