  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
  	<div class="container" data-aos="zoom-out" data-aos-delay="100">
		<div class="content">
			<h1><?php echo $this->lang->line('welcome'); ?> <span>ArmCivics</span></h1>
  		<h2><?php echo $this->lang->line('welcome-text'); ?></h2>
  		<div class="d-flex">
  			<a href="#featured-services" class="btn-get-started scrollto"><?php echo $this->lang->line('news'); ?></a>
  			<a href="https://www.youtube.com/watch?v=L3GSfTTU07s&ab_channel=Armcivics4engage" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span><?php echo $this->lang->line('demo_video'); ?></span></a>
  		</div>
		</div>
  		
  	</div>
  </section><!-- End Hero -->

  <main id="main">

  	<!-- ======= Featured Services Section ======= -->
  	<section id="featured-services" class="featured-services">
  		<div class="container" data-aos="fade-up">

  			<div class="row justify-content-center">

  				<div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-3 mb-lg-0">
  					<div class="icon-box" data-aos="fade-up" data-aos-delay="200">
  						<div class="icon"><i class='bx bx-money-withdraw'></i></div>
  						<h4 class="title"><a href="<?php echo base_url($lang . '/students_funds'); ?>"><?php echo $this->lang->line('students-funds'); ?></a></h4>
  						<p class="description"><?php echo $this->lang->line('contribution-students'); ?></p>
  					</div>
  				</div>

  				<div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-3 mb-lg-0">
  					<div class="icon-box" data-aos="fade-up" data-aos-delay="100">
  						<div class="icon"><i class='bx bx-wallet-alt'></i></div>
  						<h4 class="title"><a href="<?php echo base_url($lang . '/school_grant_programs'); ?>"><?php echo $this->lang->line('school-grant-programs'); ?></a></h4>
  						<p class="description"><?php echo $this->lang->line('contribution-students'); ?></p>
  					</div>
  				</div>

  				<div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-3 mb-lg-0">
  					<div class="icon-box" data-aos="fade-up" data-aos-delay="300">
  						<div class="icon"><i class='bx bxs-wallet-alt'></i></div>
  						<h4 class="title"><a href="<?php echo base_url($lang . '/civil_society_crowdfunding'); ?>"><?php echo $this->lang->line('civil-society-crowdfunding'); ?></a></h4>
  						<p class="description"><?php echo $this->lang->line('national-level'); ?></p>
  					</div>
  				</div>

  			</div>

  		</div>
  	</section><!-- End Featured Services Section -->

  	<!-- ======= About Section ======= -->
  	<section id="about" class="about section-bg">
  		<div class="container" data-aos="fade-up">

  			<div class="section-title">
  				<h2><?php echo $this->lang->line('about'); ?></h2>
  				<h3><?php echo $this->lang->line('know more'); ?></h3>
  			</div>

  			<div class="row">
  				<div class="col-lg-5" data-aos="fade-right" data-aos-delay="100">
  					<img class="lazyload img-fluid" data-src="<?php echo cdn_st($about->img, 1106, 741); ?>" alt="<?php echo $about->{'title_' . $lang}; ?>" onerror="this.src = '<?php echo base_url('assets/img/default.png'); ?>'"/>
  				</div>
  				<div class="col-lg-7 pt-4 pt-lg-0 content d-flex flex-column justify-content-start" data-aos="fade-up" data-aos-delay="100">  					
  					<?php echo $about->{'text_' . $lang}; ?>
  				</div>
  			</div>
  			<div class="row mt-4 gy-3">
  				<div class="col-lg-3">
  					<a href="<?php echo base_url($lang . '/about/?l=about-ap'); ?>">
  						<div class="about-box aos-init aos-animate text-dark fw-bold" data-aos="fade-up" data-aos-delay="100">
  							<?php echo $this->lang->line('about-ap') ?>
  						</div>
  					</a>
  				</div>
  				<div class="col-lg-3">
  					<a href="<?php echo base_url($lang . '/about/?l=about-io'); ?>">
  						<div class="about-box aos-init aos-animate text-dark fw-bold" data-aos="fade-up" data-aos-delay="100">
  							<?php echo $this->lang->line('about-io') ?>
  						</div>
  					</a>
  				</div>
  				<div class="col-lg-3">
  					<a href="<?php echo base_url($lang . '/about/?l=about-fn'); ?>">
  						<div class="about-box aos-init aos-animate text-dark fw-bold" data-aos="fade-up" data-aos-delay="100">
  							<?php echo $this->lang->line('about-fn') ?>
  						</div>
  					</a>
  				</div>
  				<div class="col-lg-3">
  					<a href="<?php echo base_url($lang . '/about/?l=about-pr'); ?>">
  						<div class="about-box aos-init aos-animate text-dark fw-bold" data-aos="fade-up" data-aos-delay="100">
  							<?php echo $this->lang->line('about-pr') ?>
  						</div>
  					</a>
  				</div>
  			</div>
  		</div>
  	</section><!-- End About Section -->

  	<!-- ======= Services Section ======= -->
  	<section id="services" class="services">
  		<div class="container" data-aos="fade-up">

  			<div class="section-title">
  				<h2><?php echo $this->lang->line('library') ?></h2>
  				<h3><?php echo $this->lang->line('our-library') ?></h3>
  				<!-- <p>Լորեմ Իպսումը տպագրության և տպագրական արդյունաբերության համար նախատեսված մոդելային տեքստ է։</p> -->
  			</div>

  			<div class="row">
  				<div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
  					<div class="icon-box">
  						<a href="<?php echo base_url($lang . '/literature'); ?>">
  							<div class="icon"><i class="bx bx-book"></i></div>
  							<h4 class="text-dark"><?php echo $this->lang->line('literature') ?></h4>
  							<p class="text-dark">Լորեմ Իպսումը տպագրության և տպագրական արդյունաբերության համար նախատեսված մոդելային տեքստ է։ </p>
  						</a>
  					</div>
  				</div>

  				<div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
  					<div class="icon-box">
  						<a href="">
  							<div class="icon"><i class="bx bx-link"></i></div>
  							<h4 class="text-dark"><?php echo $this->lang->line('links') ?></h4>
  							<p class="text-dark">Լորեմ Իպսումը տպագրության և տպագրական արդյունաբերության համար նախատեսված մոդելային տեքստ է։ </p>
  						</a>
  					</div>
  				</div>

  				<div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="300">
  					<div class="icon-box">
  						<a href="<?php echo base_url($lang . '/multimedia') ?>">
  							<div class="icon"><i class="bx bx-video"></i></div>
  							<h4 class="text-dark"><?php echo $this->lang->line('multimedia') ?></h4>
  							<p class="text-dark">Լորեմ Իպսումը տպագրության և տպագրական արդյունաբերության համար նախատեսված մոդելային տեքստ է։</p>
  						</a>
  					</div>
  				</div>

  			</div>

  		</div>
  	</section><!-- End Services Section -->

  	<!-- ======= Testimonials Section ======= -->
  	<section id="testimonials" class="testimonials">
  		<div class="container" data-aos="zoom-in">

  			<div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
  				<div class="swiper-wrapper">

  					<div class="swiper-slide">
  						<div class="testimonial-item">
  							<img src="<?php echo base_url(); ?>assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="" onerror="this.src = '<?php echo base_url('assets/img/default.png'); ?>'">
  							<h3>Պողոսյան Պողոս</h3>
  							<h4><?php echo $this->lang->line('executive-director') ?></h4>
  							<p>
  								<i class="bx bxs-quote-alt-left quote-icon-left"></i>
  								Լորեմ Իպսումը տպագրության և տպագրական արդյունաբերության համար նախատեսված մոդելային տեքստ է։ Սկսած 1500-ականներից՝ Լորեմ Իպսումը հանդիսացել է տպագրական արդյունաբերության ստանդարտ մոդելային տեքստ
  								<i class="bx bxs-quote-alt-right quote-icon-right"></i>
  							</p>
  						</div>
  					</div><!-- End testimonial item -->

  					<div class="swiper-slide">
  						<div class="testimonial-item">
  							<img src="<?php echo base_url(); ?>assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="" onerror="this.src = '<?php echo base_url('assets/img/default.png'); ?>'">
  							<h3>Պողոսյան Պողոս</h3>
  							<h4><?php echo $this->lang->line('designer') ?></h4>
  							<p>
  								<i class="bx bxs-quote-alt-left quote-icon-left"></i>
  								Լորեմ Իպսումը տպագրության և տպագրական արդյունաբերության համար նախատեսված մոդելային տեքստ է։ Սկսած 1500-ականներից՝ Լորեմ Իպսումը հանդիսացել է տպագրական արդյունաբերության ստանդարտ մոդելային տեքստ
  								<i class="bx bxs-quote-alt-right quote-icon-right"></i>
  							</p>
  						</div>
  					</div><!-- End testimonial item -->

  					<div class="swiper-slide">
  						<div class="testimonial-item">
  							<img src="<?php echo base_url(); ?>assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="" onerror="this.src = '<?php echo base_url('assets/img/default.png'); ?>'">
  							<h3>Պողոսյան Պողոս</h3>
  							<h4>Խանութի սեփականատեր</h4>
  							<p>
  								<i class="bx bxs-quote-alt-left quote-icon-left"></i>
  								Լորեմ Իպսումը տպագրության և տպագրական արդյունաբերության համար նախատեսված մոդելային տեքստ է։ Սկսած 1500-ականներից՝ Լորեմ Իպսումը հանդիսացել է տպագրական արդյունաբերության ստանդարտ մոդելային տեքստ
  								<i class="bx bxs-quote-alt-right quote-icon-right"></i>
  							</p>
  						</div>
  					</div><!-- End testimonial item -->

  					<div class="swiper-slide">
  						<div class="testimonial-item">
  							<img src="<?php echo base_url(); ?>assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="" onerror="this.src = '<?php echo base_url('assets/img/default.png'); ?>'">
  							<h3>Պողոսյան Պողոս</h3>
  							<h4><?php echo $this->lang->line('freelancer') ?></h4>
  							<p>
  								<i class="bx bxs-quote-alt-left quote-icon-left"></i>
  								Լորեմ Իպսումը տպագրության և տպագրական արդյունաբերության համար նախատեսված մոդելային տեքստ է։ Սկսած 1500-ականներից՝ Լորեմ Իպսումը հանդիսացել է տպագրական արդյունաբերության ստանդարտ մոդելային տեքստ
  								<i class="bx bxs-quote-alt-right quote-icon-right"></i>
  							</p>
  						</div>
  					</div><!-- End testimonial item -->

  					<div class="swiper-slide">
  						<div class="testimonial-item">
  							<img src="<?php echo base_url(); ?>assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="" onerror="this.src = '<?php echo base_url('assets/img/default.png'); ?>'">
  							<h3>Պողոսյան Պողոս</h3>
  							<h4><?php echo $this->lang->line('entrepreneur') ?></h4>
  							<p>
  								<i class="bx bxs-quote-alt-left quote-icon-left"></i>
  								Լորեմ Իպսումը տպագրության և տպագրական արդյունաբերության համար նախատեսված մոդելային տեքստ է։ Սկսած 1500-ականներից՝ Լորեմ Իպսումը հանդիսացել է տպագրական արդյունաբերության ստանդարտ մոդելային տեքստ
  								<i class="bx bxs-quote-alt-right quote-icon-right"></i>
  							</p>
  						</div>
  					</div><!-- End testimonial item -->

  				</div>
  				<div class="swiper-pagination"></div>
  			</div>

  		</div>
  	</section><!-- End Testimonials Section -->

  	<!-- ======= multimedia Section ======= -->
  	<section id="multimedia" class="multimedia">
  		<div class="container" data-aos="fade-up">

  			<div class="section-title">
  				<h2><?php echo $this->lang->line('programs'); ?></h2>
  				<h3><?php echo $this->lang->line('programs'); ?> <?php echo $this->lang->line('span-videos'); ?></h3>
  				<!-- <p> Հաղորդումներ Տեսանյութեր Հաղորդումներ Տեսանյութեր Հաղորդումներ Տեսանյութեր Հաղորդումներ Տեսանյութեր</p> -->
  			</div>

  			<div class="row" data-aos="fade-up" data-aos-delay="100">
  				<div class="col-lg-12 d-flex justify-content-center">
  					<ul id="multimedia-flters">
  						<li data-filter="*" class="filter-active"><?php echo $this->lang->line('all'); ?></li>
  						<li data-filter=".filter-app"><?php echo $this->lang->line('programs'); ?></li>
  						<li data-filter=".filter-video"><?php echo $this->lang->line('videos'); ?></li>
  					</ul>
  				</div>
  			</div>

  			<div class="row multimedia-container" data-aos="fade-up" data-aos-delay="200">
  				<?php if(!empty($result)) : ?>
  					<?php foreach ($result as $key => $value) : ?>
  						<?php $url = $value->url;
							parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);
							$unique_id = $my_array_of_vars['v']; ?>
  						<div class="col-lg-4 col-md-6 multimedia-item filter-<?php echo ($value->type == '1') ? 'app' : 'video' ?>">
  							<img src="http://img.youtube.com/vi/<?php echo $unique_id; ?>/mqdefault.jpg" onerror="this.src = '<?php echo base_url('assets/img/default.png'); ?>'"/>
  							<div class="multimedia-info">
  								<h4><?php echo ($value->type == '1') ? $this->lang->line('programs') : $this->lang->line('videos') ?></h4>
  								<p><?php echo $value->{'title_' . $lang}; ?></p>
  								<a href="http://img.youtube.com/vi/<?php echo $unique_id; ?>/mqdefault.jpg" data-gallery="multimediaGallery" class="multimedia-lightbox preview-link" title="<?php echo $value->{'title_' . $lang}; ?>"><i class='bx bx-image-alt'></i></a>
  								<a href="javascript:void(0)" class="details-link play" title="<?php echo $this->lang->line('videos'); ?>" data-src="<?php echo $unique_id; ?>"><i class='bx bx-video'></i></a>
  							</div>
  						</div>
  					<?php endforeach;  ?>
  				<?php endif; ?>
  			</div>

  		</div>
  	</section>
  	<!-- End multimedia Section -->

  	<!-- ======= Team Section ======= -->
  	<!-- <section id="team" class="team section-bg">
  		<div class="container" data-aos="fade-up">
  			<div class="section-title">
  				<h2><?php echo $this->lang->line('team'); ?></h2>
  				<h3><?php echo $this->lang->line('our-team'); ?></h3>
  			</div>

  			<div class="row">
  				<?php if (!empty($team)) : ?>
  					<?php foreach ($team as $key => $value) : ?>
  						<div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
  							<div class="member">
  								<div class="member-img">
  									<img class="lazyload" data-src="<?php echo cdn_tm($value->img, 992, 950); ?>" alt="<?php echo $value->{'name_' . $lang} ?>" onerror="this.src = '<?php echo base_url('assets/img/default.png'); ?>'" />
  									<div class="social">
  										<?php if ($value->link_tv) : ?><a href="<?php echo $value->link_tv ?>"><i class="bi bi-twitter"></i></a><?php endif; ?>
  										<?php if ($value->link_fb) : ?><a href="<?php echo $value->link_fb ?>"><i class="bi bi-facebook"></i></a><?php endif; ?>
  										<?php if ($value->link_inst) : ?><a href="<?php echo $value->link_inst ?>"><i class="bi bi-instagram"></i></a><?php endif; ?>
  										<?php if ($value->link_in) : ?><a href="<?php echo $value->link_in ?>"><i class="bi bi-linkedin"></i></a><?php endif; ?>
  									</div>
  								</div>
  								<div class="member-info">
  									<h4><?php echo $value->{'name_' . $lang} ?></h4>
  									<span><?php echo $value->{'position_' . $lang} ?></span>
  								</div>
  							</div>
  						</div>
  					<?php endforeach;  ?>
  				<?php endif; ?>
  			</div>
  		</div>
  	</section> -->
	<!-- End Team Section -->

  	<!-- ======= Frequently Asked Questions Section ======= -->
  	<!-- <section id="faq" class="faq">
  		<div class="container" data-aos="fade-up">

  			<div class="section-title">
  				<h2><?php echo $this->lang->line('abbr-faq'); ?></h2>
  				<h3><?php echo $this->lang->line('faq'); ?></h3>
  			</div>

  			<div class="row justify-content-center">
  				<div class="col-xl-10">
  					<ul class="faq-list">

  						<li>
  							<div data-bs-toggle="collapse" class="collapsed question" href="#faq1">Լորեմ Իպսումը տպագրության և տպագրական արդյունաբերության <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
  							<div id="faq1" class="collapse" data-bs-parent=".faq-list">
  								<p>
  									Լորեմ Իպսումը տպագրության և տպագրական արդյունաբերության համար նախատեսված մոդելային տեքստ է։ Սկսած 1500-ականներից՝ Լորեմ Իպսումը հանդիսացել է տպագրական արդյունաբերության ստանդարտ մոդելային տեքստ
  								</p>
  							</div>
  						</li>

  						<li>
  							<div data-bs-toggle="collapse" href="#faq2" class="collapsed question">Լորեմ Իպսումը տպագրության և տպագրական արդյունաբերության <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
  							<div id="faq2" class="collapse" data-bs-parent=".faq-list">
  								<p>
  									Լորեմ Իպսումը տպագրության և տպագրական արդյունաբերության համար նախատեսված մոդելային տեքստ է։ Սկսած 1500-ականներից՝ Լորեմ Իպսումը հանդիսացել է տպագրական արդյունաբերության ստանդարտ մոդելային տեքստ
  								</p>
  							</div>
  						</li>

  						<li>
  							<div data-bs-toggle="collapse" href="#faq3" class="collapsed question">Լորեմ Իպսումը տպագրության և տպագրական արդյունաբերության <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
  							<div id="faq3" class="collapse" data-bs-parent=".faq-list">
  								<p>
  									Լորեմ Իպսումը տպագրության և տպագրական արդյունաբերության համար նախատեսված մոդելային տեքստ է։ Սկսած 1500-ականներից՝ Լորեմ Իպսումը հանդիսացել է տպագրական արդյունաբերության ստանդարտ մոդելային տեքստ
  								</p>
  							</div>
  						</li>

  						<li>
  							<div data-bs-toggle="collapse" href="#faq4" class="collapsed question">Լորեմ Իպսումը տպագրության և տպագրական արդյունաբերության <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
  							<div id="faq4" class="collapse" data-bs-parent=".faq-list">
  								<p>
  									Լորեմ Իպսումը տպագրության և տպագրական արդյունաբերության համար նախատեսված մոդելային տեքստ է։ Սկսած 1500-ականներից՝ Լորեմ Իպսումը հանդիսացել է տպագրական արդյունաբերության ստանդարտ մոդելային տեքստ
  								</p>
  							</div>
  						</li>

  						<li>
  							<div data-bs-toggle="collapse" href="#faq5" class="collapsed question">Լորեմ Իպսումը տպագրության և տպագրական արդյունաբերության <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
  							<div id="faq5" class="collapse" data-bs-parent=".faq-list">
  								<p>
  									Լորեմ Իպսումը տպագրության և տպագրական արդյունաբերության համար նախատեսված մոդելային տեքստ է։ Սկսած 1500-ականներից՝ Լորեմ Իպսումը հանդիսացել է տպագրական արդյունաբերության ստանդարտ մոդելային տեքստ
  								</p>
  							</div>
  						</li>

  						<li>
  							<div data-bs-toggle="collapse" href="#faq6" class="collapsed question">Լորեմ Իպսումը տպագրության և տպագրական արդյունաբերության <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
  							<div id="faq6" class="collapse" data-bs-parent=".faq-list">
  								<p>
  									Լորեմ Իպսումը տպագրության և տպագրական արդյունաբերության համար նախատեսված մոդելային տեքստ է։ Սկսած 1500-ականներից՝ Լորեմ Իպսումը հանդիսացել է տպագրական արդյունաբերության ստանդարտ մոդելային տեքստ
  								</p>
  							</div>
  						</li>

  					</ul>
  				</div>
  			</div>

  		</div>
  	</section> -->
	<!-- End Frequently Asked Questions Section -->

  	<!-- ======= Clients Section ======= -->
  	<section id="clients" class="clients section-bg">
  		<div class="container" data-aos="zoom-in">

  			<div class="section-title">
  				<h2><?php echo $this->lang->line('our-partners'); ?></h2>
  				<!-- <h3><?php echo $this->lang->line('our-partners'); ?></h3> -->
  				<p>Լորեմ Իպսումը տպագրության և տպագրական արդյունաբերության համար նախատեսված մոդելային տեքստ է։</p>
  			</div>

  			<div class="row gy-2 align-items-start">
  				<?php if(!empty($clients)): ?>
  					<?php foreach ($clients as $key => $value) : ?>
  						<div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
  							<a href="<?php echo $value->link ?>" class="text-center" target="_blank" title="<?php echo $value->{'name_' . $lang} ?>">
  								<img class="lazyload img-fluid" src="<?php echo base_url('images/client/'.$value->img); ?>" alt="<?php echo $value->{'name_' . $lang} ?>" onerror="this.src = '<?php echo base_url('assets/img/default.png'); ?>'"/>
  								<span><?php echo $value->{'name_' . $lang} ?></span>
  							</a>
  						</div>
  					<?php endforeach;  ?>
  				<?php endif; ?>
  			</div>

  		</div>
  	</section>
  	<!-- End Clients Section -->

  </main><!-- End #main -->