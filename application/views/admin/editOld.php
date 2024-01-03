<?php
$userId = $userInfo->userId;
$name = $userInfo->name;
$email = $userInfo->email;
$mobile = $userInfo->mobile;
$roleId = $userInfo->roleId;
?>
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Օգտագործողի կառավարում
        <small>Ավելացնել / խմբագրել օգտագործող</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Մուտքագրեք օգտվողի տվյալները</h3>
                    </div>
                    <form role="form" action="<?php echo base_url('admin/editUser') ?>" method="post" id="editUser" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">Անունը</label>
                                        <input type="text" class="form-control" id="fname" placeholder="Անունը" name="fname" value="<?php echo $name; ?>" maxlength="128">
                                        <input type="hidden" value="<?php echo $userId; ?>" name="userId" id="userId" />    
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Էլ․հասցե</label>
                                        <input type="email" class="form-control" id="email" placeholder="Էլ․հասցե" name="email" value="<?php echo $email; ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Գաղտնաբառ</label>
                                        <input type="password" class="form-control" id="password" placeholder="Գաղտնաբառ" name="password" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cpassword">Հաստատել գաղտնաբառը</label>
                                        <input type="password" class="form-control" id="cpassword" placeholder="Հաստատել գաղտնաբառը" name="cpassword" maxlength="20">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Բջջայինի համար</label>
                                        <input type="text" class="form-control" id="mobile" placeholder="Բջջայինի համար" name="mobile" value="<?php echo $mobile; ?>" maxlength="10">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Դերը</label>
                                        <select class="form-control" id="role" name="role">
                                            <option value="0">Ընտրեք դերը</option>
                                            <?php if(!empty($roles)): ?>
                                                <?php foreach ($roles as $rl): ?>
                                                    <option value="<?php echo $rl->roleId; ?>" <?php if($rl->roleId == $roleId) {echo "selected=selected";} ?>><?php echo $rl->role ?></option>
                                                <?php endforeach ?>
                                            <?php endif; ?>        
                                        </select>
                                    </div>
                                </div>    
                            </div>
                        </div>
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Հաստատել" />
                            <input type="reset" class="btn btn-default" value="Չեղարկել" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>    
    </section>
</div>
<script src="<?php echo base_url(); ?>assets/dist/js/editUser.js" type="text/javascript"></script>