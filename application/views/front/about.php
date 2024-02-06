<!-- <section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <?= @$breadcrumbs ? $breadcrumbs : '' ?>
        </div>
    </div>
</section> -->
<section id="content">
    <div class="container">
        <h1 class="article-title"><?= $about->{'title_' . $lang} ?></h1>
        <div class="row">
            <?php if (!empty($about)) : ?>                
                <div class="col-sm-9" data-aos="fade-up" data-aos-delay="100">
                    <img class="lazyload mb-4 img-center" data-src="<?= base_url('images/static/'.$about->img); ?>" alt="<?= $about->{'title_' . $lang} ?>" onerror="this.style.display='none'" width="340" />
                    <p><?= $about->{'text_' . $lang} ?></p>
                </div>
            <?php else : ?>
                <h4 class="text-center text-danger fs-6"><?= $not_items; ?></h4>
            <?php endif; ?>
        </div>
    </div>
</section>