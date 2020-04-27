<?php
$this->load->view('professor/header');
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
                        <p class="card-text"><?php echo $work['submit_desc']?></p>
                      </div>
                      <div class="card-footer">
                         <a href="<?php echo base_url() ?>Download?p=assets/documents/<?php echo $work['submitted_doc']?>"><i class="material-icons icon">
                            get_app
                        </i></a>
                        <?php if($work['is_approved'] == 0 ) { ?><a href="<?php echo base_url() ?>Professor/remarks/<?php echo $work['id'] ?>" class="btn btn-primary float-right">Give Remarks</a><?php } else{echo "<h6 class='float-right'>Given Grade is:".$work['remarks']."</h6>"; }?>
                      </div>
                    </div>
                </div>
                <?php } }?>
            </div>
        </div>
    </main>
</div>
<script>
    $("#submittedwork").addClass("actived");
    </script>
<?php
$this->load->view('professor/footer.php');
?>