<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <?= @$breadcrumbs ? $breadcrumbs : '' ?>
        </div>
    </div>
</section>
<section id="content">
    <div class="container">
        <div class="row justify-content-end mb-4 gy-3">
            <form action="<?php echo base_url('school_grant_programs/'); ?>" method="get" class="col-sm-4 position-relative">
                <input placeholder="<?php echo $this->lang->line('search'); ?>" type="text" name="q" class="form-control form-control form-control-sm" />
                <input type="submit" value="<?php echo $this->lang->line('search'); ?>" class="search" />
            </form>
            <form action="<?php echo base_url('school_grant_programs/'); ?>" method="get" class="col-sm-4 position-relative">
                <input placeholder="Ամսաթիվ" type="text" name="date" class="form-control form-control form-control-sm datepicker" onchange="this.form.submit()" autocomplete="off" value="<?php echo $this->input->get('date') ?>" />
            </form>
        </div>       
        <h1 class="article-title"><?= $title ?></h1>
        <?php if (!empty($items)) : ?>
            <div data-aos="fade-up" data-aos-delay="100">                
                <div class="row">
                    <div class="list-group list-group-flush">
                        <?php foreach ($items as $key => $item) : ?>
                            <a href="<?= base_url('school_grant_program/?id=' . $item->id); ?>" class="list-group-item d-flex justify-content-between align-items-center"><?= ($key + 1) . ' | ' . $item->name; ?><small class="text-info"><?= my_date($item->date, $lang); ?></small></a>
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