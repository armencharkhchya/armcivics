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
            <div class="col-md-9 col-sm-12 text-left mainnews">
                <h1 class="article-title"><?= $article->name ?></h1>
                <?php if (!empty($article)) : ?>                    
                    <div class="mt-4 p-5 bg-light rounded" data-aos="fade-up" data-aos-delay="100">
                        <h5 class="fw-bold"><?= $this->lang->line('purpose'); ?></h5>
                        <p class="lead"><?= $article->purpose; ?></p>
                        <hr class="my-4">
                        <h5 class="fw-bold"><?= $this->lang->line('interest_groups'); ?></h5>
                        <p class="lead"><?= $article->interest_groups; ?></p>
                        <hr class="my-4">
                        <h5 class="fw-bold"><?= $this->lang->line('location'); ?></h5>
                        <p class="lead"><?= $article->location; ?></p>
                        <hr class="my-4">
                        <h5 class="fw-bold"><?= $this->lang->line('structure'); ?></h5>
                        <p class="lead"><?= $article->structure; ?></p>
                        <hr class="my-4">
                        <h5 class="fw-bold"><?= $this->lang->line('quotes'); ?></h5>
                        <p class="lead"><?= $article->quotes; ?></p>
                        <hr class="my-4">
                        <h5 class="fw-bold"><?= $this->lang->line('results'); ?></h5>
                        <p class="lead"><?= $article->results; ?></p>
                        <hr class="my-4">
                        <h5 class="fw-bold"><?= $this->lang->line('time'); ?></h5>
                        <p class="lead"><?= $article->time; ?></p>
                        <hr class="my-4">
                        <h5 class="fw-bold"><?= $this->lang->line('status'); ?></h5>
                        <p class="lead"><?= $article->status == '1' ? $this->lang->line('current') : $this->lang->line('completed'); ?></p>
                    </div>
                <?php else : ?>
                    <h4 class="text-center text-danger fs-6"><?= $not_items; ?></h4>
                <?php endif; ?>
            </div>
        </div>
    </div>
    </div>
</section>