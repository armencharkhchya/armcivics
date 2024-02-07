<div class="container">
    <div class="row">
        <div class="col-9 position-relative">
            <div class="border-end position-absolute" style="width: 2px;right: -1px;top: 20px; height: calc(100% - 40px);"></div>
            <section id="carouselMainSlider" class="carousel carousel-dark slide" data-bs-ride="false" data-bs-interval="false">
                <div class="carousel-inner">
                    <?php foreach($slider as $key => $item): ?>
                        <a href="<?= base_url('article?'.$item->{"name_".$lang}. '&i=' . $item->id); ?>">                            
                            <div class="carousel-item <?php echo $key == 0 ? 'active' : ''; ?>" data-bs-interval="10000">
                                <img class="lazyload d-block w-100" data-src="<?= cdn($item->img, 960, 480); ?>" alt=""
                                    onerror="this.src = '<?php echo base_url('documents/img/default.png'); ?>'">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5><?php echo $item->{"name_".$lang}; ?></h5>
                                    <!-- <p class="m-0"><?php echo word_limiter($item->{"text_".$lang}, 8); ?></p> -->
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
                    <div class="section-title row pb-1 bg-light">
                        <h3>  
                            <a href="<?php echo base_url('about'); ?>" class="text-dark">
                                <?php echo $this->lang->line('know more'); ?>
                            </a>
                        </h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-5" data-aos="fade-right" data-aos-delay="100">
                            <a href="<?php echo base_url('about'); ?>" class="text-dark">
                                <img class="lazyload img-fluid" data-src="<?php echo cdn_st($about->img, 380, 290); ?>"
                                    alt="<?php echo $about->{'title_' . $lang}; ?>"
                                onerror="this.src = '<?php echo base_url('assets/img/default.png'); ?>'" />
                            </a>
                        </div>
                        <div class="col-lg-7 pt-4 pt-lg-0 content d-flex flex-column justify-content-start"
                            data-aos="fade-up" data-aos-delay="100">
                            <a href="<?php echo base_url('about'); ?>" class="text-dark"><?php echo $about->{'text_' . $lang}; ?></a>
                        </div>
                    </div>                   
                </div>                               
            </section>           
            <section id="eventful" class="eventful">
                <div class="container" data-aos="fade-up">
                    <div class="section-title row pb-1 pt-2 bg-light">
                        <h3 class="text-start"><?php echo $this->lang->line('eventful') ?></h3>
                    </div>
                    <div class="row">
                        <div class="col-6 border py-3" data-aos="zoom-in" data-aos-delay="100">
                            <a href="<?= base_url('article?'.$eventful_1->name. '&i=' . $eventful_1->id); ?>" class="text-dark">
                                <div class="row">
                                    <h6 class="text-center text-uppercase fs-6 mb-3"><?php echo character_limiter($eventful_1->name, 30); ?></h6>
                                    <div class="col-4">
                                        <img class="lazyload d-block w-100" data-src="<?= cdn($eventful_1->img, 960, 480); ?>" alt=""
                                        onerror="this.src = '<?php echo base_url('documents/img/default.png'); ?>'">
                                    </div>
                                    <div class="col-8"><?php echo word_limiter($eventful_1->text, 15); ?></div>
                                </div>
                            </a>
                        </div>      
                        <div class="col-6 border py-3" data-aos="zoom-in" data-aos-delay="100">
                            <a href="<?= base_url('article?'.$eventful_2->name. '&i=' . $eventful_2->id); ?>" class="text-dark">
                                <div class="row">
                                    <h6 class="text-center text-uppercase fs-6 mb-3"><?php echo character_limiter($eventful_2->name, 30); ?></h6>
                                    <div class="col-4">
                                        <img class="lazyload d-block w-100" data-src="<?= cdn($eventful_2->img, 960, 480); ?>" alt=""
                                        onerror="this.src = '<?php echo base_url('documents/img/default.png'); ?>'">
                                    </div>
                                    <div class="col-8"><?php echo word_limiter($eventful_2->text, 15); ?></div>
                                </div>
                            </a>
                        </div>                                    
                    </div>
                </div>
            </section>
            <section id="featured-services" class="featured-services">
                <div class="container" data-aos="fade-up">
                    <div class="row justify-content-center">
                        <div class="col-md-6 col-lg-6 d-flex align-items-stretch mb-3 mb-lg-0">
                            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
                                <div class="icon"><i class='bx bx-money-withdraw'></i></div>
                                <h4 class="title"><a
                                        href="<?php echo base_url('students_funds'); ?>"><?php echo $this->lang->line('students-funds'); ?></a>
                                </h4>
                                <p class="description"><?php echo $this->lang->line('contribution-students'); ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 d-flex align-items-stretch mb-3 mb-lg-0">
                            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                                <div class="icon"><i class='bx bx-wallet-alt'></i></div>
                                <h4 class="title"><a
                                        href="<?php echo base_url('school_grant_programs'); ?>"><?php echo $this->lang->line('school-grant-programs'); ?></a>
                                </h4>
                                <p class="description"><?php echo $this->lang->line('contribution-students'); ?>
                                </p>
                            </div>
                        </div>
                        <!-- <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-3 mb-lg-0">
                            <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
                                <div class="icon"><i class='bx bxs-wallet-alt'></i></div>
                                <h4 class="title"><a
                                        href="<?php echo base_url('civil_society_crowdfunding'); ?>"><?php echo $this->lang->line('civil-society-crowdfunding'); ?></a>
                                </h4>
                                <p class="description"><?php echo $this->lang->line('national-level'); ?></p>
                            </div>
                        </div> -->
                    </div>
                </div>
            </section>
            <section id="services" class="services">
                <div class="container" data-aos="fade-up">
                    <div class="section-title pb-1 pt-2 bg-light">
                        <!-- <h2><?php echo $this->lang->line('library') ?></h2> -->
                        <h3><?php echo $this->lang->line('our-library') ?></h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 d-flex align-items-stretch" data-aos="zoom-in"
                            data-aos-delay="100">
                            <div class="icon-box">
                                <a href="<?php echo base_url('literature'); ?>">                                   
                                    <h4 class="text-dark"><?php echo $this->lang->line('literature') ?></h4>
                                    <p class="text-dark">Լորեմ Իպսումը տպագրության և տպագրական արդյունաբերության
                                        համար
                                        նախատեսված մոդելային տեքստ է։ </p>
                                    <div class="mt-2"><img src="<?php echo base_url('assets/img/grakanutyun.jpg') ?>" alt="grakanutyun" class="img-thumbnail img-fluid"></div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in"
                            data-aos-delay="300">
                            <div class="icon-box">
                                <a href="<?php echo base_url('multimedia') ?>">
                                    <h4 class="text-dark"><?php echo $this->lang->line('videos') ?></h4>
                                    <p class="text-dark">Լորեմ Իպսումը տպագրության և տպագրական արդյունաբերության
                                        համար
                                        նախատեսված մոդելային տեքստ է։</p>
                                    <div class="mt-2"><img src="<?php echo base_url('assets/img/tesadaran.jpg') ?>" alt="tesadaran" class="img-thumbnail img-fluid"></div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="multimedia" class="multimedia">
                <div class="container" data-aos="fade-up">                   
                    <div class="row mb-2" data-aos="fade-up" data-aos-delay="100">
                        <div class="col-lg-12 d-flex justify-content-center">
                            <ul id="multimedia-flters">                               
                                <li data-filter=".filter-app"><?php echo $this->lang->line('programs'); ?></li>
                                <li data-filter=".filter-video"><?php echo $this->lang->line('video'); ?></li>
                                <li data-filter="*" class="filter-active"><?php echo $this->lang->line('all'); ?>
                                </li>
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
        </div>
        <div class="col-3">
            <section id="civic_education" class="youtube position-relative">
                 <img src="http://img.youtube.com/vi/hcglYBbIu1Y/mqdefault.jpg" class="card-img-top img-fluid w-100" />                
                        <svg version="1.1" class="play" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="50px" width="50px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve" data-src="hcglYBbIu1Y">
                        <path class="stroke-solid" fill="none" stroke="white" d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7
                            C97.3,23.7,75.7,2.3,49.9,2.5"></path>
                        <path class="stroke-dotted" fill="none" stroke="white" d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7
                            C97.3,23.7,75.7,2.3,49.9,2.5"></path>
                        <path class="icon" fill="white" d="M38,69c-1,0.5-1.8,0-1.8-1.1V32.1c0-1.1,0.8-1.6,1.8-1.1l34,18c1,0.5,1,1.4,0,1.9L38,69z"></path>
                    </svg>
                <!-- <iframe width="560" height="200" src="https://www.youtube.com/embed/hcglYBbIu1Y?si=EWuYsfu4jNbwyp-E" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe> -->
            </section>   
            <section id="announcements" class="section-bg px-2 py-1">
                <div class="bg-light">
                    <a href="<?php echo base_url('announcements'); ?>">
                        <p class="text-uppercase mb-0 announcements"><?php echo $this->lang->line('announcements'); ?></p>
                    </a>
                </div> 
                <hr class="my-2">               
                <a href="<?= base_url('article?'.$item->{"name_".$lang}. '&i=' . $item->id); ?>">
                    <div class="mb-1 text-dark fw-bold lh-20"><?php echo $announcement->name; ?></div>
                    <small class="text-muted"><?= my_date(date($announcement->date), $lang); ?></small>
                    <p class="text-dark mt-1 mb-0 lh-20"><small><?php echo $announcement->text; ?></small></p>
                </a>
            </section>         
            <?php if(!empty($testimonials)): ?>  
            <section id="testimonials" class="testimonials py-0 mt-4">
                <div data-aos="zoom-in">
                    <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                        <div class="swiper-wrapper">
                            <?php foreach($testimonials as $item): ?>
                            <div class="swiper-slide">
                                <div class="testimonial-item">
                                    <img src="<?php echo base_url(); ?>images/testimonials/<?= $item->img ?>"
                                        class="testimonial-img" alt=""
                                        onerror="this.src = '<?php echo base_url('assets/img/default.png'); ?>'"> 
                                </div>
                               
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </section>
            <?php endif; ?>
            <section class="pt-0 mt-4">
                <a href="<?php echo base_url('pyd') ?>">
                    <img src="<?php echo base_url('assets/img/Screenshot_2.png'); ?>" alt="announcements" class="img-fluid w-100">
                </a>                
            </section>
            <?php if (!empty($video)) : ?> 
                <?php   $url = $video[0]->url;
                        parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);
                        $unique_id = $my_array_of_vars['v'];
                ?>
                <section class="pt-0">
                    <!-- <img src="http://img.youtube.com/vi/<?= $unique_id; ?>/mqdefault.jpg" class="card-img-top" /> -->
                    <iframe width="560" height="200" src="https://www.youtube.com/embed/<?= $unique_id; ?>?si=PNHGPJqQK1fjPGU7" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        <!-- <svg version="1.1" class="play" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="50px" width="50px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve" data-src="<?= $unique_id; ?>">
                        <path class="stroke-solid" fill="none" stroke="white" d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7
                            C97.3,23.7,75.7,2.3,49.9,2.5"></path>
                        <path class="stroke-dotted" fill="none" stroke="white" d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7
                            C97.3,23.7,75.7,2.3,49.9,2.5"></path>
                        <path class="icon" fill="white" d="M38,69c-1,0.5-1.8,0-1.8-1.1V32.1c0-1.1,0.8-1.6,1.8-1.1l34,18c1,0.5,1,1.4,0,1.9L38,69z"></path>
                    </svg> -->
                </section>
            <?php endif; ?>
            <section class="pt-0">
                <a href="">
                    <img src="<?php echo base_url('assets/img/Screenshot_3.png'); ?>" alt="announcements" class="img-fluid w-100">
                </a>                
            </section>
            <section class="pt-0">
                <div class="fb-page" 
                    data-href="https://www.facebook.com/ArmCivics4Engage" 
                    data-tabs="timeline" 
                    data-width="" 
                    data-height="300" 
                    data-small-header="false" 
                    data-adapt-container-width="true"
                    data-hide-cover="false" 
                    data-show-facepile="true">
                    <blockquote cite="https://www.facebook.com/ArmCivics4Engage" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/ArmCivics4Engage">Քաղաքացիական կրթություն և մասնակցություն/ACE</a></blockquote>
                </div>         
            </section>
        </div>
    </div>
</div>