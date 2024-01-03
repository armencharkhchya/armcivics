<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <?= @$breadcrumbs ? $breadcrumbs : '' ?>
        </div>
    </div>
</section>
<section id="content">
    <div class="container">
        <?php if (!empty($items)) : ?>
            <h1 class="article-title"><?= $title ?></h1>
            <div data-aos="fade-up" data-aos-delay="100">                
                <div class="row">
                    <div class="list-group list-group-flush">
                        <?php foreach ($items as $key => $item) : ?>
                            <a href="<?= base_url($lang . '/students_fund/?id=' . $item->id); ?>" class="list-group-item d-flex justify-content-between align-items-center"><?= ($key + 1) . ' | ' . $item->name; ?><small class="text-info"><?= my_date($item->date, $lang); ?></small></a>
                        <?php endforeach;  ?>
                    </div>
                    <?= $links; ?>
                </div>
            </div>
        <?php else : ?>
            <h4 class="text-center text-danger fs-6"><?= $not_items; ?></h4>
        <?php endif; ?>
    </div>
</section>