<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <i class="fa fa-book" aria-hidden="true"></i>&nbsp;Գրադարան (<?= $allCount; ?><small>նյութ</small>)
    </h1>
    <div class="row mt-3">
      <form action="<?php echo base_url('admin/archive'); ?>" method="get" class="col-sm-4">
        <input placeholder="Փնտրել" type="text" name="q" class="form-control" />
        <input type="submit" value="Որոնել" class="search" />
      </form>
      <form action="<?php echo base_url('admin/archive/'); ?>" class="col-sm-4" method="get">
        <input placeholder="Ամսաթիվ" type="text" name="date" class="form-control datepicker" onchange="this.form.submit()" autocomplete="off" value="<?php echo $this->input->get('date') ?>" />
      </form>
    </div>
    <div class="row mt-3">
      <button class="btn btn-success pull-right mr-3 mb-3" type="button" data-toggle="modal" data-target="#archiveModal" aria-expanded="false" aria-controls="collapseAddItem">
        Ավելացնել նյութ
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
                    <img src="<?= base_url('documents/img/') . $item->img ?>" onerror="this.src = '<?php echo base_url('images/upload/no_image.png'); ?>'">
                  </div>
                  <b><?= $item->name_am ?></b>
                  <span><i class="fa fa-calendar mr-1"></i><?= my_date(date($item->date), 'am', true);  ?></time></span>
                  <span>
                    <a href="<?= site_url('documents/pdf/') . $item->pdf ?>" target="_blank">
                      <?= site_url('documents/pdf/') . $item->pdf ?>
                    </a>
                  </span>
                </div>
                <div class="col-sm-2 text-center">
                  <button class="btn btn-sm btn-info mr-2 editArchive" data-toggle="modal" data-target="#archiveModal" title="Խմբագրել" data="<?= $item->id ?>">
                    <i class="fa fa-pencil"></i>
                  </button>
                  <button class="btn btn-sm btn-danger mr-2 deleteArchive" title="Հեռացնել" data="<?= $item->id ?>">
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
<?php if ($role == ROLE_ADMIN) : ?>
  <div id="archiveModal" class="modal fade">
    <div class="modal-dialog modal-lg">
      <form action="<?php echo site_url('admin/addOrUpdateArchive'); ?>" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Ավելացնել նյութ</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <label class="col-sm-2">Վերնագիր (հայերեն)</label>
              <div class="col-sm-10">
                <input type="text" name="name_am" class="form-control title" required />
              </div>
            </div>
            <br />
            <!-- <div class="row">
              <label class="col-sm-2">Վերնագիր (ռուսերեն)</label>
              <div class="col-sm-10">
                <input type="text" name="name_ru" class="form-control title" required />
              </div>
            </div>
            <br /> -->
            <div class="row">
              <label class="col-sm-2">Վերնագիր (անգլերեն)</label>
              <div class="col-sm-10">
                <input type="text" name="name_en" class="form-control title" required />
              </div>
            </div>
            <br />
            <div class="row">
              <label class="col-sm-2">Ընտրել նկարը</label>
              <div class="col-sm-10">
                <img id="picPDF" onerror="this.src = '<?php echo base_url('images/upload/no_image.png'); ?>'" width="50" />
                <input id="picturePDF" type="file" class="file d-inline-block ml-2" name="image_name" accept="image/*">
              </div>
            </div>
            <br />
            <div class="row">
              <label class="col-sm-2">Ընտրել PDF</label>
              <div class="col-sm-10">
                <input name="file" type="file" accept="application/pdf">
              </div>
            </div>
            <br />
            <div class="row">
              <label class="col-sm-2">Դասարան</label>
              <div class="col-sm-10">
                <select class="form-control" name="type" required>
                  <option value="" selected>Ընտրել</option>
                  <option value="7">7-րդ դասարան</option>
                  <option value="8">8-րդ դասարան</option>
                  <option value="9">9-րդ դասարան</option>
                  <option value="10">10-րդ դասարան</option>
                  <option value="11">11-րդ դասարան</option>
                  <option value="12">12-րդ դասարան</option>
                  <option value="13">Այլ նյութեր</option>                  
                </select>
              </div>
            </div>
            <br />
            <div class="row">
              <label class="col-sm-2">Ամսաթիվ</label>
              <div class="col-sm-10">
                <input type="text" name="date" class="datetimepicker form-control" autocomplete="off" value="<?= $dateNow; ?>" />
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="item">
            <button type="submit" class="btn btn-success">Ավելացնել</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Փակել</button>
          </div>
        </div>
      </form>
    </div>
  </div>
<?php endif; ?>