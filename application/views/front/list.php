	<!-- <section class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<?= @$breadcrumbs ? $breadcrumbs : '' ?>
			</div>
		</div>
	</section> -->
	<section class="mh-60-vh">
		<div class="container">
			<h1 class="article-title"><?= @$title ?></h1>
            <p><?php echo @$category_text; ?></p>
			<div class="row gy-3">
				<?php if (!empty($items)) : ?>					
					<?php foreach ($items as $key => $item) : ?>
						<div class="col-sm-6 col-md-3 col-xs-12" data-aos="fade-up" data-aos-delay="100">
							<div class="feature-box shadow">
								<a href="<?= base_url('article?'.$item->name. '&i=' . $item->id); ?>">
									<figure>
										<img class="lazyload" data-src="<?= cdn($item->img, 300, 210); ?>" alt="<?= $item->name ?>" onerror="this.src = '<?php echo base_url('documents/img/default.png'); ?>'"/>
										<div class="time-box">
											<span class="date"><span><?= my_date(date($item->date), $lang); ?></span></span>
										</div>
									</figure>
								</a>
								<div class="px-3">									
									<h4 class="fw-bold"><a href="<?= base_url('article?'.$item->name. '&i=' . $item->id); ?>"><?= character_limiter($item->name, 60) ?></a></h4>
                                    <small class="text-muted"><?= character_limiter($item->text, 70) ?></small>
								</div>
							</div>
						</div>
					<?php endforeach ?>
					<div class="col-md-12 text-center">
						<?= $links; ?>
					</div>
				<?php else : ?>
					<h4 class="text-center text-danger fs-6"><?= $not_items; ?></h4>
				<?php endif; ?>
			</div>
		</div>
	</section>