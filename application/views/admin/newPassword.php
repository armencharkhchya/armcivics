<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Վերականգնել գաղտնաբառը</title>
    <link rel="icon" href="<?php echo base_url(); ?>favicon.png" type="image/png" sizes="16x16">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="<?php echo base_url(); ?>assets/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/dist/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="#"><b>Ադմին համակարգ</b></a>
      </div>
      <div class="login-box-body">
        <p class="login-box-msg">Վերականգնել գաղտնաբառը</p>
        <?php $this->load->helper('form'); ?>
        <div class="row">
            <div class="col-md-12">
                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
            </div>
        </div>
        <?php $this->load->helper('form'); $error = $this->session->flashdata('error'); if($error) { ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('error'); ?>                    
            </div>
        <?php } ?>
        <form action="<?php echo base_url('login/createPasswordUser'); ?>" method="post">
          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Էլ․հասցե" name="email" value="<?php echo $email; ?>" readonly required />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            <input type="hidden" name="activation_code"  value="<?php echo $activation_code; ?>" required />
          </div>
          <hr>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Գաղտնաբառ" name="password" required />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Հաստատել գաղտնաբառը" name="cpassword" required />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-7">    
              <!-- <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>  -->                       
            </div>
            <div class="col-xs-5">
              <input type="submit" class="btn btn-primary btn-block btn-flat" value="Հաստատել" />
            </div>
          </div>
        </form>
      </div>
    </div>
    <script src="<?php echo base_url(); ?>assets/dist/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/bootstrap.min.js"></script>
  </body>
</html>