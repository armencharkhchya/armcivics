<!DOCTYPE html>
<html lang="<?= $lang ?? 'am'; ?>" class="no-js">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name='keywords' content='<?= $keywords ?? '' ?>' />
	<meta name="description" content="<?= $description ?? $this->lang->line('description'); ?>">
	<meta name="author" content="Digital agencie">
	<!-- Shareable -->
	<meta property="og:type" content="article" />
	<meta property="og:title" content="<?= @$title ? strip_tags($title) : $this->lang->line('s_title'); ?>" />
	<meta property="og:description" content="<?= $description ?? $this->lang->line('description'); ?>" />
	<meta property="og:image" content="<?= $image ?? base_url('assets/images/logo.png'); ?>" />
	<meta property="og:url" content="<?= current_url(); ?>" />
	<meta property="og:site_name" content="<?= $this->lang->line('s_name'); ?>" />
	<title><?= @$title ? strip_tags($title) : $this->lang->line('s_title'); ?></title>

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="<?= base_url(); ?>favicon.ico">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link href="<?= base_url(); ?>assets/vendor/aos/aos.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets/css/jquery.fancybox.min.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets/scripts/toast/jquery.toast.min.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url(); ?>assets/dist/css/select2totree.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url(); ?>assets/css/jquery.datetimepicker.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url(); ?>assets/css/style.css?v=0.31" rel="stylesheet">

	<script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
	<script src="<?= base_url(); ?>assets/vendor/purecounter/purecounter_vanilla.js"></script>
	<script src="<?= base_url(); ?>assets/vendor/aos/aos.js"></script>
	<script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url(); ?>assets/vendor/glightbox/js/glightbox.min.js"></script>
	<script src="<?= base_url(); ?>assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
	<script src="<?= base_url(); ?>assets/vendor/swiper/swiper-bundle.min.js"></script>
	<script src="<?= base_url(); ?>assets/vendor/waypoints/noframework.waypoints.js"></script>
	<script src="<?= base_url(); ?>assets/vendor/php-email-form/validate.js"></script>
	<script src="<?= base_url(); ?>assets/js/jquery.fancybox.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/cp-lightimg.js"></script>
	<script src="<?= base_url(); ?>assets/scripts/toast/jquery.toast.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/lazysizes.js"></script>
	<script src="<?= base_url(); ?>assets/dist/js/select2.min.js" type="text/javascript"></script>
	<script src="<?= base_url(); ?>assets/dist/js/select2totree.js" type="text/javascript"></script>
	<script src="<?= base_url(); ?>assets/js/jquery.datetimepicker.full.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/sweetalert2.all.min.js"></script>  
    <script src='<?= base_url(); ?>assets/vendor/fullcalendar/index.global.js'></script>
    <script src="<?= base_url(); ?>assets/vendor/fullcalendar/locales-all.global.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/moment.min.js"></script>
	<script>
		var BASE_URL = "<?= base_url(); ?>"
		var LANG = "<?= $lang; ?>"
		var sections = "<?= $this->lang->line('sections'); ?>"
	</script>
	<script>
		// Internet Explorer 6-11
		var isIE = /*@cc_on!@*/ false || !!document.documentMode
		if (isIE) {
			$("html").append(
				'<h2 class="warning text-danger text-center p-3 lh-40">Ուշադրություն, Ձեր web browser-ը չի կարող ապահովել կայքի լիարժեք աշխատանքը։ Խնդիրներից խուսափելու համար օգտվեք հետևյալ browser-ներից՝' +
				'<br><a href="https://www.google.com/chrome/" target="_blank">Google Chrome</a>' +
				'<br><a href="https://www.opera.com/" target="_blank">Opera</a>' +
				'<br><a href="https://www.mozilla.org/" target="_blank">Firefox Browser</a>' +
				'<br><a href="https://www.microsoft.com/en-us/edge" target="_blank">Microsoft Egde</a>' +
				'</h2>');
		}
	</script>
</head>

<body>
	<!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
	<!-- Begin Body Wrapper -->
    <div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/hy_AM/sdk.js#xfbml=1&version=v15.0&appId=850213488720450&autoLogAppEvents=1" nonce="f9AaTh9n"></script>
	<!-- ======= Top Bar ======= -->
    <div class="search-panel">
        <a href="<?= base_url(); ?>"><?= $this->input->server('SERVER_NAME') ?></a>
        <span class="search-panel-close closeSearchModal"></span>
        <form action="<?= site_url('find'); ?>" class="search_form" method="get" accept-charset="utf-8">
            <input type="text" size="40" name="q" placeholder="<?= $this->lang->line('search') ?>" autocomplete="off" lang="<?= $lang; ?>" maxlength="100" required>
            <button type="submit">
                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" fill="#fff" width="26px" height="26px" viewBox="0 0 512 512" style="enable-background:new 0 0 36 36;" xml:space="preserve">
                    <g>
                        <path d="M508.874,478.708L360.142,329.976c28.21-34.827,45.191-79.103,45.191-127.309c0-111.75-90.917-202.667-202.667-202.667
                        S0,90.917,0,202.667s90.917,202.667,202.667,202.667c48.206,0,92.482-16.982,127.309-45.191l148.732,148.732
                        c4.167,4.165,10.919,4.165,15.086,0l15.081-15.082C513.04,489.627,513.04,482.873,508.874,478.708z M202.667,362.667
                        c-88.229,0-160-71.771-160-160s71.771-160,160-160s160,71.771,160,160S290.896,362.667,202.667,362.667z"></path>
                    </g>
                </svg>
            </button>
        </form>
    </div>
    <div class="calendar-panel bg-white">
        <span class="title">Միջոցառումներ</span>
        <span class="calendar-panel-close closeCalendarModal"></span>
        <div id="calendar"></div>
    </div>
	<section id="topbar" class="py-2 py-lg-0">
		<div class="container-fluid px-lg-5 d-flex justify-content-center justify-content-md-between align-items-center">
			<div class="me-auto">	
                <img src="<?php echo base_url('assets/img/armcivics.png'); ?>" height="12" alt="armcivics" style="object-fit: contain;" class="mt-2 w-100 logo d-lg-block d-none">
                <b class="d-lg-none d-block">«Քաղացիական կրթություն և մասնակցություն» ծրագիր</b>
			</div>
			<div class="social-links d-none d-md-flex align-items-center">
				<a href="https://www.facebook.com/ArmCivics4Engage" target="_blank"><i class="bi bi-facebook"></i></a>
				<a href="https://www.instagram.com/armcivics4engage/" target="_blank"><i class="bi bi-instagram"></i></a>
				<a href="https://www.youtube.com/@Armcivics4engage" target="_blank"><i class='bx bxl-youtube'></i></a>
			</div>
			<a href="<?= base_url('auth'); ?>" class="auth"><i class='bx bx-log-in-circle'></i></a>
		</div>
	</section>

	<!-- ======= Header ======= -->
	<header id="header" class="align-items-center d-lg-block d-flex">
		<div class="container-fluid px-lg-5 d-flex align-items-center justify-content-between position-relative">
            <a href="<?= base_url(); ?>" class="text-black d-lg-block d-none">
                <img src="<?php echo base_url('assets/img/text.png'); ?>" height="50" alt="text" style="object-fit: contain;" class="w-100">	
            </a>
			<h1 class="mb-0 d-lg-none d-block"><a href="<?= base_url(); ?>">A.C.</a></h1>			
			<form action="<?php echo base_url('category/'); ?>" method="get" class="w-100 ms-2 me-2 me-lg-0 ms-lg-3 d-lg-none d-block">
				<select name="id" class="select2ToTree form-control" onchange="this.form.submit()"></select>
			</form>		
			<nav class="navbar">				
				<ul>
                    <li>
                        <img src="<?php echo base_url('assets/img/partners.png'); ?>" height="43" alt="partners" style="width: 100%;object-fit: contain;">
                    </li>
				</ul>
			</nav>
			<a href="javascript:void(0)" class="openSearchModalMobile d-lg-none d-block"><i class="bi bi-search"></i></a>
		</div>        
		<nav class="d-lg-block d-none">
			<ul class="nav justify-content-center">
                <li><a href="<?php echo base_url('about'); ?>"><?php echo $this->lang->line('about-ap') ?></a></li>													
				<?php if (!empty($categories)) : ?>
					<?php foreach ($categories as $key => $item): ?>
						<li> 
							<a href="<?= base_url('category/?id='.$item->id); ?>"><?= $item->text; ?></a>													
							<?php if (@$item->children) : ?>
								<ul>													
									<?php foreach ($item->children as $key1 => $item1) : ?>
										<li>
											<a href='<?= base_url('category/?id='.$item1->id); ?>'><?= $item1->text; ?></a>
											<?php if (@$item1->children) : ?>
												<ul>
													<?php foreach ($item1->children as $key2 => $item2) : ?>
														<li>
															<a href="<?= base_url('category/?id='.$item2->id); ?>"><?= $item2->text; ?></a>
															<?php if (@$item2->children) : ?>
																<ul>
																	<?php foreach ($item2->children as $key3 => $item3) : ?>
																		<li>
																			<a href="<?= base_url('category/?id='.$item3->id); ?>"><?= $item3->text; ?></a>
																			<?php if (@$item3->children) : ?>
																				<ul>
																					<?php foreach ($item3->children as $key4 => $item4) : ?>
																						<li>
																							<a href="<?= base_url('category/?id='.$item4->id); ?>"><?= $item4->text; ?></a>
																						</li>
																					<?php endforeach ?>																	
																				</ul>
																			<?php endif; ?>
																		</li>
																	<?php endforeach ?>																	
																</ul>
															<?php endif; ?>
														</li>
													<?php endforeach ?>																	
												</ul>
											<?php endif; ?>
										</li>
									<?php endforeach ?>
								</ul>
							<?php endif; ?>
						</li>
					<?php endforeach ?>
				<?php endif; ?>	
                <li style="background: #173c69;">
                    <div class="float-end border-start" style="margin: 3px 6px">
                        <button class="btn py-1 search_icon"><i class="bi bi-search text-white"></i></button>
                        <form class="search_bar" autocomplete="off" action="<?= site_url('find'); ?>" method="get" accept-charset="utf-8">
    						<input type="text" size="40" name="q" placeholder="<?= $this->lang->line('search') ?>" autocomplete="off" lang="<?= $lang; ?>" maxlength="100" required="">
    					</form>
                        <button class="openCalendarModal btn py-1" title="<?= $this->lang->line('events'); ?>"><i class="bi bi-calendar3 fs-5 text-white"></i></button>
                    </div>
                    <a href="<?php echo base_url(); ?>#services"><?= $this->lang->line('useful_resources'); ?></a>                
                </li>	
                <!-- <li style="background: #173c69;">
                    <div class="float-end bg-white" style="margin: 3px 6px">
                        <button class="openSearchModal btn py-1"><i class="bi bi-search"></i></button>
                        <button class="openCalendarModal btn py-1" title="<?= $this->lang->line('events'); ?>"><i class="bi bi-calendar3 fs-5"></i></button>
                    </div>
                    <a href="#contact"><?= $this->lang->line('contactus'); ?></a>
                
                </li>	 -->
             
		</nav>
	</header>