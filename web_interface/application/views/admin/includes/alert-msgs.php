 <?php
    if(!empty($this->session->flashdata('error'))){
        ?>
        <div class="alert alert-danger alert-dismissible fade show">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Danger!</strong> <?php echo $this->session->flashdata('error'); ?>
        </div>
        <?php
    }elseif(!empty($this->session->flashdata('success'))){
        ?>
        <div class="alert alert-success alert-dismissible fade show">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
        </div>
        <?php
    }

    // echo '<pre>';
    // print_r($_SESSION);
    // echo '</pre>';
    
    unset($_SESSION['__ci_vars']);
    ?>