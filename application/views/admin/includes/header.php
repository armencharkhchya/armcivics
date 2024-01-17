<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $pageTitle; ?></title>
  <link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/png" sizes="16x16">
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <!-- CSS -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/dist/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/dist/Ionicons/css/ionicons.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/dist/css/bootstrap-tagsinput.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/dist/css/_all-skins.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/dist/css/admin_main.css?v=0.02" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/dist/css/jquery.datetimepicker.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/dist/css/select2totree.css" rel="stylesheet" type="text/css" />
  <!-- JS -->
  <script src="<?php echo base_url(); ?>assets/dist/js/jquery.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/dist/js/tinymce/tinymce.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/dist/js/app.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/dist/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/dist/js/jquery.validate.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/dist/js/jquery.datetimepicker.full.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/dist/js/typeahead.bundle.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/dist/js/bootstrap-tagsinput.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/dist/js/select2.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/dist/js/select2totree.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/dist/js/admin.js" type="text/javascript"></script>
  <script type="text/javascript">
    var baseURL = "<?php echo base_url(); ?>";
    var dateNow = "<?php echo date('Y-m-d H:i:s'); ?>";
  </script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div id="loading">
    <img src="<?php echo base_url('assets/dist/img/loading.gif'); ?>">
  </div>
  <div class="wrapper">
    <header class="main-header">
      <a href="<?php echo base_url('admin'); ?>" class="logo">
        <span class="logo-mini"><b>Ա․</b>Վ․</span>
        <span class="logo-lg"><b>Ադմին․ Համակարգ</b></span>
      </a>
      <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown tasks-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                <i class="fa fa-history"></i>
              </a>
              <ul class="dropdown-menu">
                <li class="header"> Վերջին մուտքը : <i class="fa fa-clock-o"></i>
                  <?= empty($last_login) ? "Մուտք առաջին անգամ" : $last_login; ?></li>
              </ul>
            </li>
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo base_url('assets/dist/img/avatar5.png'); ?>" class="user-image" alt="User Image" />
                <span class="hidden-xs"><?php echo $name; ?></span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header">

                  <img src="<?php echo base_url('assets/dist/img/avatar5.png'); ?>" class="img-circle" alt="User Image" />
                  <p>
                    <?php echo $name; ?>
                    <small><?php echo $role_text; ?></small>
                  </p>

                </li>
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?php echo base_url('admin/profile'); ?>" class="btn btn-warning btn-flat"><i class="fa fa-user-circle"></i> Իմ էջը</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?php echo base_url('admin/logout'); ?>" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Դուրս գալ</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <aside class="main-sidebar">
      <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">

          <?php if ($role == ROLE_ADMIN) : ?>
            <li class="text-center" style="padding: 10px 0;">
              <button type="button" class="btn  shown-all-items<?php if ($getCountByShownNull > 0) : ?> btn-danger<?php else : ?> btn-success<?php endif; ?>">
                Չհաստատված <span class="badge"><?= $getCountByShownNull ?></span>
              </button>
            </li>
          <?php endif; ?>
          <li>
            <a href="<?php echo base_url('admin'); ?>">
              <i class="fa fa-home"></i> <span>Նյութեր</span></i>
            </a>
          </li>
          <li>
            <a href="<?php echo base_url('admin/categories'); ?>">
              <i class="fa fa-bars"></i> <span>Կատեգորիաներ</span></i>
            </a>
          </li>
          <li>
            <a href="<?php echo base_url('admin/videos'); ?>">
              <i class="fa fa-play-circle-o" style="font-size: 16px;"></i> <span>Մուլտիմեդիա</span></i>
            </a>
          </li>
          <li>
            <a href="<?php echo base_url('admin/archive'); ?>">
              <i class="fa fa-book"></i> <span>Գրականություն</span></i>
            </a>
          </li>
          <li>
            <a href="<?php echo base_url('admin/schoolGrantPrograms'); ?>">
              <i class="fa fa-money" aria-hidden="true"></i> <span>Դպր․ դր․ ծրագրեր</span></i>
            </a>
          </li>
          <li>
            <a href="<?php echo base_url('admin/civilSocietyCrowdfunding'); ?>">
              <i class="fa fa-money"></i> <span>Քաղ․ հաս․ դր․ ծրագրեր</span></i>
            </a>
          </li>
          <li>
            <a href="<?php echo base_url('admin/staticPages'); ?>">
              <i class="fa fa-file-text-o"></i> <span>Ստատիկ էջեր</span></i>
            </a>
          </li>
          <li>
            <a href="<?php echo base_url('admin/team'); ?>">
              <i class="fa fa-users"></i> <span>Մեր թիմը</span></i>
            </a>
          </li>
          <li>
            <a href="<?php echo base_url('admin/testimonials'); ?>">
              <i class="fa fa-comments"></i> <span>Կարծիքներ</span></i>
            </a>
          </li>
          <li>
            <a href="<?php echo base_url('admin/clients'); ?>">
              <i class="fa fa-users"></i> <span>Գործընկերներ</span></i>
            </a>
          </li>
          <?php if ($role == ROLE_ADMIN) : ?>
            <li>
              <a href="<?php echo base_url('admin/userListing'); ?>">
                <i class="fa fa-user-circle-o"></i>
                <span>Օգտվողներ</span>
              </a>
            </li>
          <?php endif; ?>
          <li>
            <a href="<?php echo base_url(); ?>admin/getSearchLogs">
              <i class="fa fa-search"></i>
              <span>Որոնված բառեր</span>
            </a>
          </li>
        </ul>
      </section>
    </aside>