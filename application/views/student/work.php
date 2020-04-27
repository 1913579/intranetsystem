<?php
$this->load->view('student/header');
?>
<div class="content">
    <main>
        <div class="container-fluid">
        <br clear="all">
            <div class="row">
                <?php if($works){ foreach($works as $work ){ ?>
                <div class="col-xl-12 col-md-12 mb-4">
                    <div class="card shadow" >
                      <div class="card-body">
                        <h5 class="card-title"><?php echo $work['title']?></h5>
                        <p class="card-text"><?php echo $work['description']?></p>
                      </div>
                      <div class="card-footer">
                         <a href="<?php echo base_url() ?>Download?p=assets/documents/<?php echo $work['attachment']; ?>"><i class="material-icons icon">
                            get_app
                        </i></a>
                        <?php if($work['is_approved']  == 1){ ?><h6 class="ml-3 float-right">Grade : <?php echo $work['remarks']?></h6> <?php } ?>
                        <?php if($work['is_submitted'] == 0){ ?>
                        <a href="<?php echo base_url() ?>Student/submitwork/<?php echo $work['id'] ?>" class="btn btn-primary float-right">Submit Work</a>
                        <?php } else{ echo "<h6 class='float-right'>Work Submitted</h6>"; } ?>
                      </div>
                    </div>
                </div>
                <?php } }?>
            </div>
        </div>
    </main>
</div>
<script>
    $("#work").addClass("actived");
    </script>
<?php
$this->load->view('student/footer.php');
?>