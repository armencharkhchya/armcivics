<div class="container">
    <div class="row">
        <div class="col-9 position-relative">
            <div class="border-end position-absolute h-100 p-0" style="width: 2px;right: -1px;top: 20px;"></div>
            <section id="carouselMainSlider" class="carousel carousel-dark slide" data-bs-ride="false" data-bs-interval="false">
                <!-- <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselMainSlider" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselMainSlider" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselMainSlider" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div> -->
                <div class="carousel-inner">
                    <?php foreach($slider as $key => $item): ?>
                        <a href="<?= base_url($lang . '/article?'.$item->{"name_".$lang}. '&i=' . $item->id); ?>">                            
                            <div class="carousel-item <?php echo $key == 0 ? 'active' : ''; ?>" data-bs-interval="10000">
                                <img class="lazyload d-block w-100" data-src="<?= cdn($item->img, 960, 480); ?>" alt=""
                                    onerror="this.src = '<?php echo base_url('documents/img/default.png'); ?>'">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5><?php echo $item->{"name_".$lang}; ?></h5>
                                    <p class="m-0"><?php echo word_limiter($item->{"text_".$lang}, 8); ?></p>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselMainSlider"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>                  
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselMainSlider"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </section>
            <section id="about" class="about section-bg">
                <div class="px-4" data-aos="fade-up">
                    <div class="section-title">
                        <h2><?php echo $this->lang->line('about'); ?></h2>
                        <h3><?php echo $this->lang->line('know more'); ?></h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-5" data-aos="fade-right" data-aos-delay="100">
                            <img class="lazyload img-fluid" data-src="<?php echo cdn_st($about->img, 380, 290); ?>"
                                alt="<?php echo $about->{'title_' . $lang}; ?>"
                                onerror="this.src = '<?php echo base_url('assets/img/default.png'); ?>'" />
                        </div>
                        <div class="col-lg-7 pt-4 pt-lg-0 content d-flex flex-column justify-content-start"
                            data-aos="fade-up" data-aos-delay="100">
                            <?php echo $about->{'text_' . $lang}; ?>
                        </div>
                    </div>
                    <div class="row mt-4 gy-3">
                        <div class="col-lg-3">
                            <a href="<?php echo base_url($lang . '/about/?l=about-ap'); ?>">
                                <div class="about-box aos-init aos-animate text-dark fw-bold" data-aos="fade-up"
                                    data-aos-delay="100">
                                    <?php echo $this->lang->line('about-ap') ?>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="<?php echo base_url($lang . '/about/?l=about-io'); ?>">
                                <div class="about-box aos-init aos-animate text-dark fw-bold" data-aos="fade-up"
                                    data-aos-delay="100">
                                    <?php echo $this->lang->line('about-io') ?>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="<?php echo base_url($lang . '/about/?l=about-fn'); ?>">
                                <div class="about-box aos-init aos-animate text-dark fw-bold" data-aos="fade-up"
                                    data-aos-delay="100">
                                    <?php echo $this->lang->line('about-fn') ?>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="<?php echo base_url($lang . '/about/?l=about-pr'); ?>">
                                <div class="about-box aos-init aos-animate text-dark fw-bold" data-aos="fade-up"
                                    data-aos-delay="100">
                                    <?php echo $this->lang->line('about-pr') ?>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            <section id="eventful" class="eventful">
                <div class="container" data-aos="fade-up">
                    <div class="section-title pb-3">
                        <h3 class="mt-0"><?php echo $this->lang->line('eventful') ?></h3>
                    </div>
                    <div class="row">
                        <?php foreach($eventful as $key => $item): ?>
                        <div class="col-6 border py-3" data-aos="zoom-in" data-aos-delay="100">
                            <a href="<?= base_url($lang . '/article?'.$item->{"name_".$lang}. '&i=' . $item->id); ?>" class="text-dark">
                                <div class="row">
                                    <h6 class="text-center text-uppercase fs-6 mb-3"><?php echo $item->{"name_".$lang}; ?></h6>
                                    <div class="col-4">
                                        <img class="lazyload d-block w-100" data-src="<?= cdn($item->img, 960, 480); ?>" alt=""
                                        onerror="this.src = '<?php echo base_url('documents/img/default.png'); ?>'">
                                    </div>
                                    <div class="col-8">
                                        <b><?php echo word_limiter($item->{"text_".$lang}, 8); ?></b>
                                    </div>
                                </div>
                            </a>
                        </div> 
                        <?php endforeach; ?>                                          
                    </div>
                </div>
            </section>
            <section id="featured-services" class="featured-services">
                <div class="container" data-aos="fade-up">
                    <div class="row justify-content-center">
                        <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-3 mb-lg-0">
                            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
                                <div class="icon"><i class='bx bx-money-withdraw'></i></div>
                                <h4 class="title"><a
                                        href="<?php echo base_url($lang . '/students_funds'); ?>"><?php echo $this->lang->line('students-funds'); ?></a>
                                </h4>
                                <p class="description"><?php echo $this->lang->line('contribution-students'); ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-3 mb-lg-0">
                            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                                <div class="icon"><i class='bx bx-wallet-alt'></i></div>
                                <h4 class="title"><a
                                        href="<?php echo base_url($lang . '/school_grant_programs'); ?>"><?php echo $this->lang->line('school-grant-programs'); ?></a>
                                </h4>
                                <p class="description"><?php echo $this->lang->line('contribution-students'); ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-3 mb-lg-0">
                            <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
                                <div class="icon"><i class='bx bxs-wallet-alt'></i></div>
                                <h4 class="title"><a
                                        href="<?php echo base_url($lang . '/civil_society_crowdfunding'); ?>"><?php echo $this->lang->line('civil-society-crowdfunding'); ?></a>
                                </h4>
                                <p class="description"><?php echo $this->lang->line('national-level'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="services" class="services">
                <div class="container" data-aos="fade-up">
                    <div class="section-title">
                        <h2><?php echo $this->lang->line('library') ?></h2>
                        <h3><?php echo $this->lang->line('our-library') ?></h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in"
                            data-aos-delay="100">
                            <div class="icon-box">
                                <a href="<?php echo base_url($lang . '/literature'); ?>">
                                    <div class="icon"><i class="bx bx-book"></i></div>
                                    <h4 class="text-dark"><?php echo $this->lang->line('literature') ?></h4>
                                    <p class="text-dark">Լորեմ Իպսումը տպագրության և տպագրական արդյունաբերության
                                        համար
                                        նախատեսված մոդելային տեքստ է։ </p>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in"
                            data-aos-delay="200">
                            <div class="icon-box">
                                <a href="">
                                    <div class="icon"><i class="bx bx-link"></i></div>
                                    <h4 class="text-dark"><?php echo $this->lang->line('links') ?></h4>
                                    <p class="text-dark">Լորեմ Իպսումը տպագրության և տպագրական արդյունաբերության
                                        համար
                                        նախատեսված մոդելային տեքստ է։ </p>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in"
                            data-aos-delay="300">
                            <div class="icon-box">
                                <a href="<?php echo base_url($lang . '/multimedia') ?>">
                                    <div class="icon"><i class="bx bx-video"></i></div>
                                    <h4 class="text-dark"><?php echo $this->lang->line('multimedia') ?></h4>
                                    <p class="text-dark">Լորեմ Իպսումը տպագրության և տպագրական արդյունաբերության
                                        համար
                                        նախատեսված մոդելային տեքստ է։</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="testimonials" class="testimonials">
                <div class="container" data-aos="zoom-in">
                    <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="testimonial-item">
                                    <img src="<?php echo base_url(); ?>assets/img/testimonials/testimonials-1.jpg"
                                        class="testimonial-img" alt=""
                                        onerror="this.src = '<?php echo base_url('assets/img/default.png'); ?>'">
                                    <h3>Պողոսյան Պողոս</h3>
                                    <h4><?php echo $this->lang->line('executive-director') ?></h4>
                                    <p>
                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                        Լորեմ Իպսումը տպագրության և տպագրական արդյունաբերության համար նախատեսված
                                        մոդելային
                                        տեքստ է։ Սկսած 1500-ականներից՝ Լորեմ Իպսումը հանդիսացել է տպագրական
                                        արդյունաբերության
                                        ստանդարտ մոդելային տեքստ
                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="testimonial-item">
                                    <img src="<?php echo base_url(); ?>assets/img/testimonials/testimonials-2.jpg"
                                        class="testimonial-img" alt=""
                                        onerror="this.src = '<?php echo base_url('assets/img/default.png'); ?>'">
                                    <h3>Պողոսյան Պողոս</h3>
                                    <h4><?php echo $this->lang->line('designer') ?></h4>
                                    <p>
                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                        Լորեմ Իպսումը տպագրության և տպագրական արդյունաբերության համար նախատեսված
                                        մոդելային
                                        տեքստ է։ Սկսած 1500-ականներից՝ Լորեմ Իպսումը հանդիսացել է տպագրական
                                        արդյունաբերության
                                        ստանդարտ մոդելային տեքստ
                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="testimonial-item">
                                    <img src="<?php echo base_url(); ?>assets/img/testimonials/testimonials-3.jpg"
                                        class="testimonial-img" alt=""
                                        onerror="this.src = '<?php echo base_url('assets/img/default.png'); ?>'">
                                    <h3>Պողոսյան Պողոս</h3>
                                    <h4>Խանութի սեփականատեր</h4>
                                    <p>
                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                        Լորեմ Իպսումը տպագրության և տպագրական արդյունաբերության համար նախատեսված
                                        մոդելային
                                        տեքստ է։ Սկսած 1500-ականներից՝ Լորեմ Իպսումը հանդիսացել է տպագրական
                                        արդյունաբերության
                                        ստանդարտ մոդելային տեքստ
                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="testimonial-item">
                                    <img src="<?php echo base_url(); ?>assets/img/testimonials/testimonials-4.jpg"
                                        class="testimonial-img" alt=""
                                        onerror="this.src = '<?php echo base_url('assets/img/default.png'); ?>'">
                                    <h3>Պողոսյան Պողոս</h3>
                                    <h4><?php echo $this->lang->line('freelancer') ?></h4>
                                    <p>
                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                        Լորեմ Իպսումը տպագրության և տպագրական արդյունաբերության համար նախատեսված
                                        մոդելային
                                        տեքստ է։ Սկսած 1500-ականներից՝ Լորեմ Իպսումը հանդիսացել է տպագրական
                                        արդյունաբերության
                                        ստանդարտ մոդելային տեքստ
                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="testimonial-item">
                                    <img src="<?php echo base_url(); ?>assets/img/testimonials/testimonials-5.jpg"
                                        class="testimonial-img" alt=""
                                        onerror="this.src = '<?php echo base_url('assets/img/default.png'); ?>'">
                                    <h3>Պողոսյան Պողոս</h3>
                                    <h4><?php echo $this->lang->line('entrepreneur') ?></h4>
                                    <p>
                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                        Լորեմ Իպսումը տպագրության և տպագրական արդյունաբերության համար նախատեսված
                                        մոդելային
                                        տեքստ է։ Սկսած 1500-ականներից՝ Լորեմ Իպսումը հանդիսացել է տպագրական
                                        արդյունաբերության
                                        ստանդարտ մոդելային տեքստ
                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </section>
            <section id="multimedia" class="multimedia pt-5">
                <div class="container" data-aos="fade-up">
                    <div class="section-title">
                        <h2><?php echo $this->lang->line('programs'); ?></h2>
                        <h3><?php echo $this->lang->line('programs'); ?>
                            <?php echo $this->lang->line('span-videos'); ?></h3>
                    </div>
                    <div class="row" data-aos="fade-up" data-aos-delay="100">
                        <div class="col-lg-12 d-flex justify-content-center">
                            <ul id="multimedia-flters">
                                <li data-filter="*" class="filter-active"><?php echo $this->lang->line('all'); ?>
                                </li>
                                <li data-filter=".filter-app"><?php echo $this->lang->line('programs'); ?></li>
                                <li data-filter=".filter-video"><?php echo $this->lang->line('videos'); ?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row multimedia-container" data-aos="fade-up" data-aos-delay="200">
                        <?php if(!empty($videos)) : ?>
                        <?php foreach ($videos as $key => $value) : ?>
                        <?php $url = $value->url;
                    parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);
                    $unique_id = $my_array_of_vars['v']; ?>
                        <div
                            class="col-lg-4 col-md-6 multimedia-item filter-<?php echo ($value->type == '1') ? 'app' : 'video' ?>">
                            <img src="http://img.youtube.com/vi/<?php echo $unique_id; ?>/mqdefault.jpg"
                                onerror="this.src = '<?php echo base_url('assets/img/default.png'); ?>'" />
                            <div class="multimedia-info">
                                <h4><?php echo ($value->type == '1') ? $this->lang->line('programs') : $this->lang->line('videos') ?>
                                </h4>
                                <p><?php echo $value->{'title_' . $lang}; ?></p>
                                <a href="http://img.youtube.com/vi/<?php echo $unique_id; ?>/mqdefault.jpg"
                                    data-gallery="multimediaGallery" class="multimedia-lightbox preview-link"
                                    title="<?php echo $value->{'title_' . $lang}; ?>"><i
                                        class='bx bx-image-alt'></i></a>
                                <a href="javascript:void(0)" class="details-link play"
                                    title="<?php echo $this->lang->line('videos'); ?>"
                                    data-src="<?php echo $unique_id; ?>"><i class='bx bx-video'></i></a>
                            </div>
                        </div>
                        <?php endforeach;  ?>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            <section id="clients" class="clients section-bg">
                <div class="container" data-aos="zoom-in">
                    <div class="section-title">
                        <h2><?php echo $this->lang->line('our-partners'); ?></h2>
                        <p>Լորեմ Իպսումը տպագրության և տպագրական արդյունաբերության համար նախատեսված մոդելային
                            տեքստ է։</p>
                    </div>
                    <div class="row gy-2 align-items-start">
                        <?php if(!empty($clients)): ?>
                        <?php foreach ($clients as $key => $value) : ?>
                        <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                            <a href="<?php echo $value->link ?>" class="text-center" target="_blank"
                                title="<?php echo $value->{'name_' . $lang} ?>">
                                <img class="lazyload img-fluid"
                                    src="<?php echo base_url('images/client/'.$value->img); ?>"
                                    alt="<?php echo $value->{'name_' . $lang} ?>"
                                    onerror="this.src = '<?php echo base_url('assets/img/default.png'); ?>'" />
                                <span><?php echo $value->{'name_' . $lang} ?></span>
                            </a>
                        </div>
                        <?php endforeach;  ?>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-3">
            <section id="announcements">
                <img src="<?php echo base_url('assets/img/announcements.png'); ?>" alt="announcements" class="img-fluid">
                <div class="section-bg mt-4 px-2 py-3">
                    <p class="text-uppercase mb-0 text-primary"><?php echo $this->lang->line('announcement'); ?>.</p>
                    <a href="<?= base_url($lang . '/article?'.$item->{"name_".$lang}. '&i=' . $item->id); ?>">
                        <div class="text-primary mb-1"><?php echo $announcement->name; ?></div>
                        <small class="text-muted"><?= my_date(date($announcement->date), $lang); ?></small>
                        <p class="text-dark mt-1 mb-0 fs-6"><?php echo $announcement->text; ?></p>
                    </a>
                </div>
            </section>
            <section class="pt-0">
                <a href="">
                    <img src="<?php echo base_url('assets/img/Screenshot_1.png'); ?>" alt="announcements" class="img-fluid w-100">
                </a>                
            </section>
            <section class="pt-0">
                <a href="">
                    <img src="<?php echo base_url('assets/img/Screenshot_2.png'); ?>" alt="announcements" class="img-fluid w-100">
                </a>                
            </section>
        </div>
    </div>
</div>