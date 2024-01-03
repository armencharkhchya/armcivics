<!doctype html>
<html lang="<?php echo $lang; ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>
    <link href="<?= base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
    <link href="<?php echo base_url('assets/css/signin.css') ?>" rel="stylesheet">
</head>

<body class="text-center">
    <main class="form-signin">
        <form>
            <h1 class="h3 mb-3 fw-normal"><?php echo $this->lang->line('pl_login') ?></h1>
            <button class="w-100 btn btn-lg btn-outline-success" type="button" onclick="">account.emis.am</button>
            <p class="mt-4 text-muted">&copy; <?php echo $this->lang->line('NCET') ?> <?php echo date('Y'); ?></p>
        </form>
    </main>
</body>

</html>