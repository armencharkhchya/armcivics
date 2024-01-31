<script src="<?php echo base_url(); ?>assets/dist/js/tinymce/tinymce.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/app.js" type="text/javascript"></script>
<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <?= @$breadcrumbs ? $breadcrumbs : '' ?>
        </div>
    </div>
</section>
<section style="min-height: calc(100vh - 511px)">
    <div class="container">       
        <div class="row">   
            <div class="col-12">
                <h1 class="article-title"><?= $title ?></h1>
                <div class="row mb-3">
                    <div class="col-12 text-end">
                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addEditModal"><?= $this->lang->line('add'); ?></button>
                    </div>
                </div>
                <?php if (!empty($items)) : ?>
                    <div data-aos="fade-up" data-aos-delay="100" class="table-responsive">                
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center" style="width: 5%">#</th>
                                    <th scope="col"><?= $this->lang->line('name'); ?></th>
                                    <th scope="col" class="text-center" style="width: 5%"><?= $this->lang->line('status'); ?></th>
                                    <th scope="col" class="text-center" style="width: 15%"><?= $this->lang->line('action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($items as $key => $item) : ?>
                                    <tr>
                                        <th scope="row" class="text-center"><?= $item->id; ?></th>
                                        <td><?= $item->name; ?></td>
                                        <td class="text-center"><?= $item->status == 1 ? '<span class="text-success">'.$this->lang->line('enabled').'</span>' : '<span class="text-danger">'.$this->lang->line('disabled').'</span>' ?></td>
                                        <td class="text-center">
                                            <a href="javascript:void(0)" class="edit" data-bs-toggle="modal" data-bs-target="#addEditModal" data-id="<?= $item->id; ?>"><i class="bi bi-pencil-square me-3 text-success fs-5"></i></a>
                                            <a href="javascript:void(0)"><i class="bi bi-trash3 text-danger fs-5"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach;  ?>                            
                            </tbody>
                        </table>
                        <?= $links; ?>
                    </div>
                <?php else : ?>
                    <h4 class="text-center text-danger fs-6"><?= $not_items; ?></h4>
                <?php endif; ?>
            </div>
        </div>
    </div>
    </div>
</section>

<div class="modal fade" id="addEditModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="addOrUpdateItem" action="<?= base_url('profile/addOrUpdateItem'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="school_id" value="<?php echo $this->input->get('i'); ?>">
                <div class="modal-header">
                    <h5 class="modal-title"><?= $this->lang->line('add'); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">       
                    <div class="mb-3">
                        <label class="form-label"><?= $this->lang->line('title'); ?> (<?= $this->lang->line('armenian'); ?>) <span class="text-danger">*</span></label>
                        <input type="text" name="name_am" class="form-control" required autocomplete="off"/>
                    </div>    
                    <!-- <div class="mb-3">
                        <label class="form-label"><?= $this->lang->line('title'); ?> (<?= $this->lang->line('russian'); ?>) <span class="text-danger">*</span></label>
                        <input type="text" name="name_ru" class="form-control" required autocomplete="off"/>
                    </div>   -->
                    <!-- <div class="mb-3">
                        <label class="form-label"><?= $this->lang->line('title'); ?> (<?= $this->lang->line('english'); ?>) <span class="text-danger">*</span></label>
                        <input type="text" name="name_en" class="form-control" required autocomplete="off"/>
                    </div>  -->
                    <div class="mb-3">
                        <label class="form-label"><?= $this->lang->line('text'); ?> (<?= $this->lang->line('armenian'); ?>)</label>
                        <textarea id="longtext_am" name="longtext_am" class="form-control longtext" rows="20" style="resize: none;height: 300px"></textarea>
                    </div>
                    <!-- <div class="mb-3">
                        <label class="form-label"><?= $this->lang->line('text'); ?> (<?= $this->lang->line('russian'); ?>)</label>
                        <textarea id="longtext_ru" name="longtext_ru" class="form-control longtext" rows="20" style="resize: none;height: 300px"></textarea>
                    </div> -->
                    <!-- <div class="mb-3">
                        <label class="form-label"><?= $this->lang->line('text'); ?> (<?= $this->lang->line('english'); ?>)</label>
                        <textarea id="longtext_en" name="longtext_en" class="form-control longtext" rows="20" style="resize: none;height: 300px"></textarea>
                    </div> -->
                    <div class="mb-3">
                        <label class="form-label"><?= $this->lang->line('status')?></span></label>
                    <div class="form-control">
                        <input class="form-check-input" type="radio" id="disabled" name="status" value="0">
                        <label class="form-check-label"><?= $this->lang->line('disabled')?></label>                 
                        <input class="form-check-input ms-3" type="radio" id="enabled" name="status" value="1">
                        <label class="form-check-label"><?= $this->lang->line('enabled')?></label>
                    </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><?= $this->lang->line('date')?></label>
                        <input type="text" name="date" class="form-control datetimepicker" value="<?= date('Y-m-d H:i:s'); ?>" autocomplete="off" />
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="item" value="">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= $this->lang->line('close'); ?></button>
                    <button type="submit" class="btn btn-primary"><?= $this->lang->line('save'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
     $('.edit').click(function () {
        var id = $(this).attr('data-id');
        $('#addEditModal .modal-title').text('<?= $this->lang->line('edit'); ?>');
        $.ajax({
            type: 'POST',
            url: '<?= base_url('profile/getProgramById') ?>',
            data: {id: id},
            success: function (data) {
                var item = JSON.parse(data);
                $('[name=name_am]').val(item.name_am);
                // $('[name=name_ru]').val(item.name_ru);
                // $('[name=name_en]').val(item.name_en);
                var iframe_am = $('#longtext_am__ifr');
                // var iframe_ru = $('#longtext_ru__ifr');
                // var iframe_en = $('#longtext_en__ifr');
                iframe_am.ready(function () {         
                iframe_am.contents().find("body").html('');
                    iframe_am.contents().find("body").append(item.longtext_am);
                }); 
                // iframe_ru.ready(function () {         
                // iframe_ru.contents().find("body").html('');
                //     iframe_ru.contents().find("body").append(item.longtext_ru);
                // });
                // iframe_en.ready(function () {         
                // iframe_en.contents().find("body").html('');
                //     iframe_en.contents().find("body").append(item.longtext_en);
                // });
                if(item.status == 1) {
                    $('#enabled').prop('checked', true);
                }else {
                    $('#disabled').prop('checked', true);
                }
                
                $("[name=date]").val(item.date);
                $('[name=item]').val(item.id);
            }
        })
    });
  
    $('#addOrUpdateItem').submit(function (e) {
    $('#preloader').show();    
    e.preventDefault();
    formData = new FormData(e.target);
    $.ajax({
        url: $("#addOrUpdateItem").attr('action'),
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        dataType: 'json',
        success: function (response) {
            $('#preloader').hide();    
            var type = 'error';
            if (response.status == '1') {
                type = 'success'
            }           
            Swal.fire({
                type: type,
                title: response.message
                }
            );
            if(Swal.isVisible()){
                $(document).on('click', function () {
                    location.reload();
                });
            }
        }
    })
})

    $('#addEditModal').on('hide.bs.modal', function (e) {
        $('#addEditModal .modal-title').text('<?= $this->lang->line('add'); ?>');
        $('#addEditModal button[type=submit]').text('<?= $this->lang->line('add'); ?>');
        $(this)
        .find("input,textarea,select")
        .val('')
        .end()
        .find("input[type=checkbox], input[type=radio]")
        .prop("checked", "")
        .end();   
    })
</script>