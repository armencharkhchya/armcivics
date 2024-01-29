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
            <form action="<?php echo base_url('literature'); ?>" method="get" class="col-sm-4 position-relative">
                <input placeholder="<?php echo $this->lang->line('search'); ?>" type="text" name="q" class="form-control form-control form-control-sm" />
                <input type="submit" value="<?php echo $this->lang->line('search'); ?>" class="search" />
            </form>
            <form action="<?php echo base_url('literature'); ?>" class="col-sm-2" method="get">
                <select name="type" class="form-select form-control form-select-sm" onchange="this.form.submit()">
                    <option value="" selected><?php echo $this->lang->line('classes'); ?></option>
                    <option value="7">7<?php echo $this->lang->line('-th grade'); ?></option>
                    <option value="8">8<?php echo $this->lang->line('-th grade'); ?></option>
                    <option value="9">9<?php echo $this->lang->line('-th grade'); ?></option>
                    <option value="10">10<?php echo $this->lang->line('-th grade'); ?></option>
                    <option value="11">11<?php echo $this->lang->line('-th grade'); ?></option>
                    <option value="12">12<?php echo $this->lang->line('-th grade'); ?></option>
                    <option value="13"><?php echo $this->lang->line('any'); ?></option>
                </select>
            </form>
        </div>
        <h1 class="article-title"><?= $title ?></h1>
        <?php if (!empty($items)) : ?>            
            <div class="row">
                <?php foreach ($items as $key => $item) : ?>
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="card">
                            <div class="row g-0">
                                <div class="col-4">
                                    <img class="lazyload img-fluid rounded-start fit-cover" data-src="<?= cdn_lt($item->img, 140, 140); ?>" alt="<?= $item->{'name_' . $lang} ?>" onerror="this.src = '<?php echo base_url('documents/img/default.png'); ?>'" style="height: 140px"/>
                                </div>
                                <div class="col-8">
                                    <div class="card-body position-relative h-100">
                                        <h6 class="card-title"><?= $item->{'name_' . $lang}; ?></h6>
                                        <div class="d-flex align-items-center justify-content-between card-body__text-btn">
                                            <p class="card-text mb-0 text-info"><?php echo $item->type < 13 ? $item->type.' '.$this->lang->line('-th grade') : $this->lang->line('any'); ?></p>
                                            <a href="<?php echo base_url('documents/pdf/' . $item->pdf) ?>" class="btn-play" title="<?= $item->{'name_' . $lang}; ?>" target="_blank"><i class='bx bxs-file-pdf text-danger fs-2'></i></a>
                                        </div>
                                    </div>
                                </div>
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