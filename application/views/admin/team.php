<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <i class="fa fa-users" aria-hidden="true"></i> Մեր թիմը
    </h1>
    <div class="row mt-3">
      <button class="btn btn-success pull-right mr-3 mb-3" type="button" data-toggle="modal" data-target="#teamModal" aria-expanded="false" aria-controls="collapseAddItem">
        Ավելացնել թիմի անդամ
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
                    <img src="<?= base_url('images/team/') . $item->img ?>" onerror="this.src = '<?php echo base_url('images/upload/no_image.png'); ?>'">
                  </div>
                  <b><?= $item->name_am ?></b>
                  <span>Պաշտոն՝ &nbsp;<?= $item->position_am ?></span>
                </div>
                <div class="col-sm-2 text-center">
                  <button class="btn btn-sm btn-info mr-2 editTeam" data-toggle="modal" data-target="#teamModal" title="Խմբագրել" data="<?= $item->id ?>">
                    <i class="fa fa-pencil"></i>
                  </button>
                  <button class="btn btn-sm btn-danger mr-2 trashTeam" title="Հեռացնել" data="<?= $item->id ?>">
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
<div id="teamModal" class="modal fade">
  <div class="modal-dialog modal-lg">
    <form action="<?php echo site_url('admin/addOrUpdateTeam'); ?>" method="post" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Ավելացնել թիմի անդամ</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <label class="col-sm-2">Անուն</label>
            <div class="col-sm-10">
              <input type="text" name="name_am" class="form-control title" required />
            </div>
          </div>
          <br />
          <!-- <div class="row">
            <label class="col-sm-2">Անուն (ռուսերեն)</label>
            <div class="col-sm-10">
              <input type="text" name="name_ru" class="form-control title" required />
            </div>
          </div>
          <br /> -->
          <!-- <div class="row">
            <label class="col-sm-2">Անուն (անգլերեն)</label>
            <div class="col-sm-10">
              <input type="text" name="name_en" class="form-control title" required />
            </div>
          </div>
          <br /> -->
          <div class="row">
            <label class="col-sm-2">Պաշտոն</label>
            <div class="col-sm-10">
              <input type="text" name="position_am" class="form-control title" />
            </div>
          </div>
          <br />
          <!-- <div class="row">
            <label class="col-sm-2">Պաշտոն (ռուսերեն)</label>
            <div class="col-sm-10">
              <input type="text" name="position_ru" class="form-control title" />
            </div>
          </div>
          <br /> -->
          <!-- <div class="row">
            <label class="col-sm-2">Պաշտոն (անգլերեն)</label>
            <div class="col-sm-10">
              <input type="text" name="position_en" class="form-control title" />
            </div>
          </div>
          <br /> -->
          <div class="row">
            <label class="col-sm-2">Ֆեյսբուք</label>
            <div class="col-sm-10">
              <input type="text" name="link_fb" class="form-control title" />
            </div>
          </div>
          <br />
          <div class="row">
            <label class="col-sm-2">Թվիթեր</label>
            <div class="col-sm-10">
              <input type="text" name="link_tv" class="form-control title" />
            </div>
          </div>
          <br />
          <div class="row">
            <label class="col-sm-2">Ինստագրամ</label>
            <div class="col-sm-10">
              <input type="text" name="link_inst" class="form-control title" />
            </div>
          </div>
          <br />
          <div class="row">
            <label class="col-sm-2">Լինկդին</label>
            <div class="col-sm-10">
              <input type="text" name="link_in" class="form-control title" />
            </div>
          </div>
          <br />
          <div class="row">
            <label class="col-sm-2">Ընտրել նկարը</label>
            <div class="col-sm-10">
              <img id="picTeam" onerror="this.src = '<?php echo base_url('images/upload/no_image.png'); ?>'" width="50" />
              <input id="pictureTeam" type="file" class="file d-inline-block ml-2" name="image_name" accept="image/*">
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