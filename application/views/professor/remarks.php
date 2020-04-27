<?php
$this->load->view('professor/header');
?>
<div class="content">
    <main>
        <div class="container-fluid">
        <br clear="all">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <form method="POST" action="<?php echo base_url() ?>Professor/giveremarks/<?php echo  $work_id ?>">
                      <div class="form-group">
                        <label for="remarks">Remarks</label>
                        <select class="custom-select" id="remarks" name="remarks" required>
                          <option value="A">A</option>
                          <option value="B">B</option>
                          <option value="C">C</option>
                          <option value="D">D</option>
                          <option value="E">E</option>
                          <option value="F">F</option>
                        </select>
                      </div>
                     <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
<?php
$this->load->view('professor/footer.php');
?>