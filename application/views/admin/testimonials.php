<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <i class="fa fa-comments" aria-hidden="true"></i> Կարծիքներ
    </h1>
    <div class="row mt-3">
      <button class="btn btn-success pull-right mr-3 mb-3" type="button" data-toggle="modal" data-target="#testimonialsModal" aria-expanded="false" aria-controls="collapseAddItem">
        Ավելացնել կարծիք
      </button>
    </div>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="module-ct">
          <?php if (!empty($items)) : ?>
            <?php foreach ($items as $key => $item) : ?>
              <div class="bt-link b-bottom">
                <div class="br-dashed col-sm-10 h-60">
                  <div class="small-pic">
                    <img src="<?= base_url('images/testimonials/') . $item->img ?>" onerror="this.src = '<?php echo base_url('images/upload/no_image.png'); ?>'">
                  </div>                 
                </div>
                <div class="col-sm-2 text-center">                 
                  <button class="btn btn-sm btn-danger mr-2 trashTestimonials" title="Հեռացնել" data="<?= $item->id ?>">
                    <i class="fa fa-trash"></i>
                  </button>
                </div>
              </div>
            <?php endforeach ?>
            <div class="text-center"><?= $links; ?></div>
          <?php else : ?>
            <h4 class="text-center text-danger fs-6"><?= $not_items; ?></h4>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- modal -->
<div id="testimonialsModal" class="modal fade">
  <div class="modal-dialog modal-lg">
    <form action="<?php echo site_url('admin/addTestimonials'); ?>" method="post" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Ավելացնել կարծիք</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <label class="col-sm-2">Ընտրել նկարը</label>
            <div class="col-sm-10">
              <img id="picTestimonials" onerror="this.src = '<?php echo base_url('images/upload/no_image.png'); ?>'" width="50" />
              <input id="pictureTestimonials" type="file" class="file d-inline-block ml-2" name="image_name" accept="image/*">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Ավելացնել</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Փակել</button>
        </div>
      </div>
    </form>
  </div>
</div>