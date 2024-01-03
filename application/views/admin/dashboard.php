<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <i class="fa fa-home" aria-hidden="true"></i> Ամբողջը (<?= $allCount; ?><small>նյութ</small>)
    </h1>
    <div class="row mt-3">
      <form action="<?php echo base_url('admin'); ?>" method="get" class="col-sm-3">
        <input placeholder="Փնտրել" type="text" name="q" class="form-control" />
        <input type="submit" value="Որոնել" class="search" />
      </form>
      <form action="<?php echo base_url('admin'); ?>" class="col-sm-3" method="get">
        <select name="c_id" class="select2ToTree" style="width: 100%" onchange="this.form.submit()"></select>
      </form>
      <form action="<?php echo base_url('admin'); ?>" class="col-sm-3" method="get">
        <input placeholder="Ամսաթիվ" type="text" name="date" class="form-control datepicker" onchange="this.form.submit()" autocomplete="off" value="<?php echo $this->input->get('date') ?>" />
      </form>
      <form action="<?php echo base_url('admin'); ?>" class="col-sm-3" method="get">
        <input type="checkbox" name="publish" onChange="this.form.submit()" <?php if ($this->input->get('publish') == 'on') : ?>checked='checked' <?php endif; ?> />
        &nbsp;<label for="course"><?php if ($this->input->get('publish') == 'on') : ?>Ամբողջ նյութերը<?php else : ?>Չհաստատված նյութեր <?php endif; ?></label>
      </form>
    </div>
    <div class="row mt-3">
      <button class="btn btn-success pull-right mr-3 mb-3 addItem" type="button" data-toggle="modal" data-target="#itemModal" aria-expanded="false" aria-controls="collapseAddItem">
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
                    <img src="<?= base_url('images/upload/') . $item->img ?>" onerror="this.src = '<?php echo base_url('images/upload/no_image.png'); ?>'">
                  </div>
                  <b><?= $item->name ?></b>
                  <span><i class="fa fa-calendar mr-1"></i><?= my_date(date($item->date), 'am', true);  ?></time>&nbsp;&nbsp;&nbsp;&nbsp;(տեղադրող՝ <?= $item->user_name ?>)</span>
                  <span>
                    <a href="<?= site_url('articles/article/') . $item->id ?>" target="_blank">
                      <?= site_url('articles/article/') . $item->id ?>
                    </a>
                  </span>
                </div>
                <div class="col-sm-2 text-center">
                  <button class="btn btn-sm btn-info mr-2 editItem" data-toggle="modal" data-target="#itemModal" title="Խմբագրել" data="<?= $item->id ?>">
                    <i class="fa fa-pencil"></i>
                  </button>
                  <button class="btn btn-sm btn-danger mr-2 trashItem" title="Հեռացնել" data="<?= $item->id ?>">
                    <i class="fa fa-trash"></i>
                  </button>
                  <?php if ($role == ROLE_ADMIN) : ?>
                    <!-- <button class="btn btn-sm btn-warning sendItem mr-2" title="Ողարկել նամակ" data="<?= $item->id ?>">
                      <i class="fa fa-send-o"></i>
                    </button> -->
                    <button class="shown btn btn-sm publishItem <?php if ($item->publish == 1) : ?> btn-success <?php else : ?> btn-danger <?php endif; ?>" title="<?php if ($item->publish == 1) : ?> Չցուցադրել <?php else : ?> Ցուցադրել <?php endif; ?>" data="<?= $item->id ?>">
                      <i class="fa fa-circle-o" data="<?= $item->publish ?>"></i>
                    </button>
                  <?php endif; ?>
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
<div id="itemModal" class="modal fade">
  <div class="modal-dialog modal-lg">
    <form action="<?= site_url('admin/addOrUpdateItem'); ?>" method="post" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Ավելացնել նյութ</h4>
        </div>
        <div class="modal-body">
          <label>Վերնագիր (հայերեն)<span class="text-danger">*</span></label>
          <input type="text" name="name_am" class="form-control" required />
          <br />
          <!-- <label>Վերնագիր (ռուսերեն)<span class="text-danger">*</span></label>
          <input type="text" name="name_ru" class="form-control" required />
          <br /> -->
          <label>Վերնագիր (անգլերեն)<span class="text-danger">*</span></label>
          <input type="text" name="name_en" class="form-control" required />
          <br />
          <label>Տեքստ (հայերեն)<span class="text-danger">*</span></label>
          <textarea name="text_am" class="form-control" rows="10" style="resize: none;" required></textarea>
          <br />
          <!-- <label>Տեքստ (ռուսերեն)<span class="text-danger">*</span></label>
          <textarea name="text_ru" class="form-control" rows="10" style="resize: none;" required></textarea>
          <br /> -->
          <label>Տեքստ (անգլերեն)<span class="text-danger">*</span></label>
          <textarea name="text_en" class="form-control" rows="10" style="resize: none;" required></textarea>
          <br />
          <label>Նյութեր (հայերեն)</label>
          <textarea id="longtext_am" name="longtext_am" class="form-control longtext" rows="20" style="resize: none;height: 300px"></textarea>
          <br />
          <!-- <label>Նյութեր (ռուսերեն)</label>
          <textarea id="longtext_ru" name="longtext_ru" class="form-control longtext" rows="20" style="resize: none;height: 300px"></textarea>
          <br /> -->
           <label>Նյութեր (անգլերեն)</label>
          <textarea id="longtext_en" name="longtext_en" class="form-control longtext" rows="20" style="resize: none;height: 300px"></textarea>
          <br />
          <div class="row">
            <label class="col-sm-2 col-form-label">Ընտրել նկարը</label>
            <div class="col-sm-10">
              <label class="pull-left mr-2" style="width: 95px; margin-bottom: 0"><img id="pic" src="" onerror="this.src = '<?php echo base_url('images/upload/no_image.png'); ?>'" class="img-thumbnail" /> </label>
              <input id="picture" type="file" class="form-control file w-75" name="image_name" accept="image/*">
            </div>
          </div>
          <br />
          <div class="row">
              <label class="col-sm-2">Ընտրել PDF</label>
              <div class="col-sm-10">
                <input  type="file" class="form-control" name="file[]" accept=".pdf, .csv, .docx, .doc, .xlsx, .xls, .txt, .xml" multiple>	
                <div class="row cont_input_files"></div>	
              </div>
            </div>
          <br />
          <div class="row">
            <label class="col-sm-2 col-form-label">Հեռացնել նկարը</label>
            <div class="col-sm-10">
              <input class="pull-left mr-2" type="checkbox" name="delete_pic">
              <span>Նշելու դեպքում կհեռացվի նկարը</span>
            </div>
          </div>
          <br />
          <div class="row">
            <label class="col-sm-2 col-form-label">Գլխավոր</label>
            <div class="col-sm-10">
              <input id="checkbox" class="pull-left mr-2" type="checkbox" name="general">
              <span>Նշելու դեպքում նյութը կպատկերվի գլխավոր սլայդերում</span>
            </div>
          </div>
          <br />
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Բաժիններ</label>
            <div class="col-sm-5">
              <select style="width: 100%" class="select2ToTree itemSelect" name="category" required></select>
            </div>
          </div>
          <br />         
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Ամսաթիվ</label>
            <div class="col-sm-5">
              <input type="text" name="date" id="date" class="form-control datetimepicker" value="<?= $dateNow ?>" autocomplete="off" />
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">բանալի բառեր</label>
            <div class="col-sm-5">
              <input id="tagsinput" type="text" class="form-control tagsinput" name="tags" autocomplete="off" spellcheck="false" value="">
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
<script>
  	function deleteFile(el, id){
	 var r = confirm("Հեռացնե՞լ նյութը։");
        if (r == true) {
            $.ajax({
                url: baseURL + "admin/deleteFile/" + id,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                  if(response.status == 1){
                    $(el).parent().remove();
                      alert('Գործողությունը կատարված է։');
                      } else {                         
                          alert('Խափանում։');
                      }
                  },
                error: function (errResponse) {
                    console.log(errResponse);
                }
            });
        } else {
          alert('Ոչ մի գործողություն տեղի չի ունեցել :)');
        }
	}
</script>