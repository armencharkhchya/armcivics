<!-- <section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <?= @$breadcrumbs ? $breadcrumbs : '' ?>
        </div>
    </div>
</section> -->
<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-12" data-aos="fade-up" data-aos-delay="100">
                <?php if (!empty($article)) : ?>
                    <h1 class="article-title">Դպրոց "<?= $article->school_id ?>"</h1>
                    <div class="mt-4 p-5 bg-light rounded">
                        <h5 class="fw-bold">Անվանում</h5>
                        <p class="lead"><?= $article->name; ?></p>
                        <h5 class="fw-bold">Նպատակ</h5>
                        <p class="lead"><?= $article->content; ?></p>
                    </div>
                <?php else : ?>
                    <h4 class="text-center text-danger fs-6"><?= $not_items; ?></h4>
                <?php endif; ?>
            </div>
        </div>
    </div>
    </div>
</section>