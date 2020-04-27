<?php
$this->load->view('student/header');
?>

<div class="content">
    <main>
        <div class="container-fluid">
        <br clear="all">
            <div class="row">
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
            </div>
            <div class="row">
                <div class="col-xl-12 col-md-12 mb-4">
                    <form method="POST" action="<?php echo base_url()?>Student/submitcomment/<?php echo $work['id']; ?>">
                    <div class="card shadow" >
                        <div class="card-body">
                            <div class="form-group">
                                <label for="comment">Add Comment</label>
                                <textarea class="form-control" id="comment" rows="3" required name="comment"></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary float-right">Add Comment</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <?php if($comments){ ?><h5>Recent Comments</h5><?php } ?>
            <div class="row">
                <?php if($comments) { foreach($comments as $comment){ ?>
                <div class="col-xl-12 col-md-12">
                    <div class="card shadow" >
                        <div class="card-body">
                            <img class="float-left mr-2"  src="<?php echo base_url(); ?>assets/profile/<?php echo $comment['uphoto']; ?>" width="30" height="30">
                            <h5><?php echo  $comment['comment']; ?></h5>
                        </div>
                    </div>
                </div>
                <?php } }?> 
            </div>
        </div>
    </main>
</div>
<?php
$this->load->view('student/footer.php');
?>