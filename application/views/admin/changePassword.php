<div class="content-wrapper">
    <section class="content-header">
        <h1>Փոխել գաղտնաբառը<small>Սահմանեք նոր գաղտնաբառ ձեր հաշվի համար</small></h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Մուտքագրեք մանրամասները</h3>
                    </div>
                    <form role="form" action="<?php echo site_url('admin/changePassword') ?>" method="post">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputPassword1">Հին գաղտնաբառ</label>
                                        <input type="password" class="form-control" id="inputOldPassword"
                                            placeholder="Հին գաղտնաբառ" name="oldPassword" maxlength="20" required>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputPassword1">Նոր գաղտնաբառ</label>
                                        <input type="password" class="form-control" id="inputPassword1"
                                            placeholder="Նոր գաղտնաբառ" name="newPassword" maxlength="20" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputPassword2">Հաստատել նոր գաղտնաբառը</label>
                                        <input type="password" class="form-control" id="inputPassword2"
                                            placeholder="Հաստատել նոր գաղտնաբառը" name="cNewPassword" maxlength="20"
                                            required>
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

                <?php  
                    $noMatch = $this->session->flashdata('nomatch');
                    if($noMatch)
                    {
                ?>
                <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('nomatch'); ?>
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