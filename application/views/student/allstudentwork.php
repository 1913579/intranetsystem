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
                        <p class="card-text"><?php echo $work['submit_desc']?></p>
                      </div>
                      <div class="card-footer">
                         <a href="<?php echo base_url() ?>Download?p=assets/documents/<?php echo $work['submitted_doc']; ?>"><i class="material-icons icon">
                            get_app
                        </i></a>
                        <a  href="<?php echo base_url()?>Student/askquestion/<?php echo $work['id'] ?>" class="btn btn-primary float-right">Ask Question</a>
                      </div>
                    </div>
                </div>
                <?php } }?>
            </div>
        </div>
    </main>
</div>
<script>
    $("#allwork").addClass("actived");
    </script>
<?php
$this->load->view('student/footer.php');
?>