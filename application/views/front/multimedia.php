<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <?= @$breadcrumbs ? $breadcrumbs : '' ?>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row justify-content-end mb-4 gy-3">
            <form action="<?php echo base_url('multimedia'); ?>" method="get" class="col-sm-4 position-relative">
                <input placeholder="<?= $this->lang->line('search') ?>" type="text" name="q" class="form-control form-control-sm" />
                <input type="submit" value="<?= $this->lang->line('search') ?>" class="search" />
            </form>
            <form action="<?php echo base_url('multimedia'); ?>" class="col-sm-3" method="get">
                <select name="type" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="" selected><?= $this->lang->line('select') ?></option>
                    <option value="1"><?= $this->lang->line('programs') ?></option>
                    <option value="2"><?= $this->lang->line('videos') ?></option>
                </select>
            </form>
        </div>
        <h1 class="article-title"><?= $title ?></h1>
        <?php if (!empty($result)) : ?>           
            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <?php foreach ($result as $key => $value) : ?>
                    <?php $url = $value->url;
                    parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);
                    $unique_id = $my_array_of_vars['v']; ?>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card" style="height: 23rem;">
                            <img src="http://img.youtube.com/vi/<?= $unique_id; ?>/mqdefault.jpg" class="card-img-top" />
                            <div class="card-body">
                                <h5 class="card-title text-info"><?php echo ($value->type == '1') ? $this->lang->line('program') : $this->lang->line('video') ?></h5>
                                <p class="card-text" style="max-width: 88%"><?= $value->{'title_' . $lang}; ?></p>
                                <a href="javascript:void(0)" class="btn btn-outline-primary play btn-play r-16 b-16 position-absolute" title="<?= $this->lang->line('video'); ?>" data-src="<?= $unique_id; ?>"><i class='bx bx-video'></i></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach;  ?>
                <?= $links; ?>
            </div>
        <?php else : ?>
            <h4 class="text-center text-danger fs-6"><?= $not_items; ?></h4>
        <?php endif; ?>
    </div>
</section>