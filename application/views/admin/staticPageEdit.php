<div class="content-wrapper" style="background-color: white;">
    <section class="content-header">
        <h1>
            <i class="fa fa-file-text-o" aria-hidden="true"></i> Խմբագրել
        </h1>
        <hr>
        <div class="container-fluid">
            <div class="body-content">
                <div class="row">
                    <div class="col-sm-12">
                        <form action="<?= base_url('admin/staticPageEdit'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                            <input type="hidden" name="id" value="<?= $item->id; ?>">
                            <div class="form-group">
                                <label for="name">Անուն *</label>
                                <input type="text" name="title" value="<?= $item->title_am  ?>" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="text" style="width: 130px;">Ընտրել նկար</label>
                                <img id="picStatic" src="<?= base_url('images/static/') ?><?= $item->img; ?>" onerror="this.src = '<?php echo base_url('images/upload/no_image.png'); ?>'" width="50" />
                                <input id="pictureStatic" type="file" class="file d-inline-block ml-2" name="image_name" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label style="width: 130px;">Հեռացնել նկարը</label>
                                <input class="mr-1" type="checkbox" name="delete_pic">
                                <span>Նշելու դեպքում կհեռացվի նկարը</span>
                            </div>          
                            <div class="form-group">
                                <label for="text">Տեքստ</label>
                                <textarea id="longtextstatic" name="text_am" class="form-control" rows="20" style="resize: none;"><?= $item->text_am; ?></textarea>
                            </div>
                            <!-- <div class="form-group">
                                <label for="text">Տեքստ (ռուսերեն)</label>
                                <textarea id="longtextstatic" name="text_ru" class="form-control" rows="20" style="resize: none;"><?= $item->text_ru; ?></textarea>
                            </div> -->
                            <!-- <div class="form-group">
                                <label for="text">Տեքստ (անգլերեն)</label>
                                <textarea id="longtextstatic" name="text_en" class="form-control" rows="20" style="resize: none;"><?= $item->text_en; ?></textarea>
                            </div> -->
                            <div class="form-group text-right">
                                <input type="submit" name="btn" value="Պահպանել" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>