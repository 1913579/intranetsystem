<?php
$this->load->view('student/header');
?>
<div class="content">
    <div class="container-fluid">
        <br clear="all">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <form method="POST" action="<?php echo base_url() ?>Student/submitstudentwork/<?php echo $work_id ?>" enctype="multipart/form-data">
                     
                  <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                    <textarea  class="form-control" id="exampleInputEmail1" rows="12" name="description"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">File</label>
                    <input type="file" class="form-control" id="exampleInputPassword1" name="attachment">
                  </div>
                  <button type="submit" class="btn btn-primary mt-2">Submit</button>
                </form>
            </div>
        </div>
    </div
</div>
<?php
$this->load->view('student/footer.php');
?>