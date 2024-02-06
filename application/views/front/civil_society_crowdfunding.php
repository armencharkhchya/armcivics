<!-- <section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <?= @$breadcrumbs ? $breadcrumbs : '' ?>
        </div>
    </div>
</section> -->
<section id="content">
    <div class="container">
        <div class="row justify-content-end mb-4 gy-3">
            <form action="<?php echo base_url('civil_society_crowdfunding/'); ?>" method="get" class="col-sm-6 col-md-4 position-relative mb-3 mb-sm-0">
                <input placeholder="<?php echo $this->lang->line('search'); ?>" type="text" name="q" class="form-control form-control form-control-sm" />
                <input type="submit" value="<?php echo $this->lang->line('search'); ?>" class="search" />
            </form>
            <form action="<?php echo base_url('civil_society_crowdfunding/'); ?>" method="get" class="col-sm-6 col-md-2 position-relative">
                <input placeholder="Ամսաթիվ" type="text" name="date" class="form-control form-control form-control-sm datepicker" onchange="this.form.submit()" autocomplete="off" value="<?php echo $this->input->get('date') ?>" />
            </form>
            <form action="<?php echo base_url('civil_society_crowdfunding'); ?>" class="col-sm-2" method="get">
               <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                    <option value="" selected>Կարգավիճակ</option>
                    <option value="1">Ընթացիկ</option>
                    <option value="0">Ավարտված</option>
                </select>
            </form>
        </div>
        <?php if (!empty($items)) : ?>
             <h1 class="article-title"><?= $title ?></h1>
            <div class="table-responsive"  data-aos="fade-up" data-aos-delay="100">
                <table class="table table-bordered align-middle lh-sm p-2">
                    <thead class="table-light text-center">
                        <tr>
                            <th scope="col"><?= $this->lang->line('project_name'); ?></th>
                            <th scope="col"><?= $this->lang->line('purpose'); ?></th>
                            <th scope="col"><?= $this->lang->line('date'); ?></th>
                            <th scope="col"><?= $this->lang->line('status'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($items as $key => $item) : ?>
                            <tr>
                                <th scope="row"><a href="<?= base_url('civil_society_crowdfund/?id=' . $item->id); ?>" class="text-decoration-underline text-dark"><small><?= $item->name; ?></small></a></th>
                                <td><?= $item->purpose; ?></td>
                                <td><small class="text-muted text-nowrap"><?= my_date($item->date, $lang); ?></small></td>
                                <td class="text-center"><?= $item->status == 1 ? '<small class="text-success">Ընթացիկ</small>' : '<small class="text-danger">Ավարտված</small' ?></td>
                            </tr>
                        <?php endforeach;  ?>
                    </tbody>
                </table>
            </div>
            <?= $links; ?>
        <?php else : ?>
            <h4 class="text-center text-danger fs-6"><?= $not_items; ?></h4>
        <?php endif; ?>
    </div>
</section>