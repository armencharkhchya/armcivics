<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <i class="fa fa-play-circle-o" aria-hidden="true"></i>&nbsp;Տեսանյութեր (<?= $allCount ?? ''; ?><small>նյութ</small>)
    </h1>
    <div class="row mt-3">
      <form action="<?php echo base_url('admin/videos'); ?>" method="get" class="col-sm-4">
        <input placeholder="Փնտրել" type="text" name="q" class="form-control" />
        <input type="submit" value="Որոնել" class="search" />
      </form>
      <form action="<?php echo base_url('admin/videos/'); ?>" class="col-sm-4" method="get">
        <input placeholder="Ամսաթիվ" type="text" name="date" class="form-control datepicker" onchange="this.form.submit()" autocomplete="off" value="<?php echo $this->input->get('date') ?>" />
      </form>
    </div>
    <div class="row mt-3">
      <button class="btn btn-success pull-right mr-3 mb-3" type="button" data-toggle="modal" data-target="#videoModal" aria-expanded="false" aria-controls="collapseAddItem">
        Ավելացնել տեսանյութ
      </button>
    </div>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="module-ct">
          <?php if (!empty($items)) : ?>
            <?php foreach ($items as $key => $item) : ?>
              <?php $url = $item->url;
              parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);
              $unique_id = $my_array_of_vars['v'];
              ?>
              <div class="bt-link b-bottom">
                <div class="br-dashed col-sm-11 h-60">
                  <div class="small-pic">
                    <img src="http://img.youtube.com/vi/<?= $unique_id; ?>/mqdefault.jpg" />
                  </div>
                  <b><?= $item->title_am ?></b>
                  <span><i class="fa fa-calendar mr-1"></i><?= my_date(date($item->date), 'am', true);  ?></time>&nbsp;&nbsp;&nbsp;&nbsp;( <?php echo ($item->type == '1') ? 'Հաղորդում' : 'Տեսանյութ' ?> )</span>
                </div>
                <div class="col-sm-1 text-center">
                  <button class="btn btn-sm btn-info mr-2 editVideo" data-toggle="modal" data-target="#videoModal" title="Խմբագրել" data="<?= $item->id ?>">
                    <i class="fa fa-pencil"></i>
                  </button>
                  <button class="btn btn-sm btn-danger mr-2 trashVideo" title="Հեռացնել" data="<?= $item->id ?>">
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
  <div id="videoModal" class="modal fade">
    <div class="modal-dialog modal-lg">
      <form action="<?php echo site_url('admin/addOrUpdateVideos'); ?>" method="post">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Ավելացնել տեսանյութ</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <label class="col-sm-2">Վերնագիր (հայերեն)</label>
              <div class="col-sm-10">
                <input type="text" name="title_am" class="form-control" required />
              </div>
            </div>
            <br />
            <!-- <div class="row">
              <label class="col-sm-2">Վերնագիր (ռուսերեն)</label>
              <div class="col-sm-10">
                <input type="text" name="title_ru" class="form-control" required />
              </div>
            </div>
            <br /> -->
            <div class="row">
              <label class="col-sm-2">Վերնագիր (անգլերեն)</label>
              <div class="col-sm-10">
                <input type="text" name="title_en" class="form-control" required />
              </div>
            </div>
            <br />
            <div class="row">
              <label class="col-sm-2">Հղում</label>
              <div class="col-sm-10">
                <input type="text" name="url" class="form-control" required />
              </div>
            </div>
            <br />
            <div class="row">
              <label class="col-sm-2">Տեսակ</label>
              <div class="col-sm-10">
                <select class="form-control" name="type" required>
                  <option value="" selected>Ընտրել</option>
                  <option value="1">Հաղորդում</option>
                  <option value="2">Տեսանյութ</option>
                </select>
              </div>
            </div>
            <br>
            <div class="row">
              <label class="col-sm-2">Ամսաթիվ</label>
              <div class="col-sm-10">
                <input type="text" name="date" class="form-control datetimepicker" value="<?= $dateNow; ?>" />
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