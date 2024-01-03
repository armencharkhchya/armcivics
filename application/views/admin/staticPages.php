<div class="content-wrapper" style="background-color: white;">
    <section class="content-header">
        <h1>
            <i class="fa fa-file-text-o" aria-hidden="true"></i> Ստատիկ էջեր
        </h1>
        <hr>
        <div class="container-fluid">
            <div class="body-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 1px;" class="text-center">N</th>
                                <th class="text-left">Վերնագիր</th>
                                <th style="width: 200px;" class="text-center">Ամսաթիվ</th>
                                <th style="width: 1px;" class="text-center">Խմբագրել</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $key => $item) : ?>
                                <tr>
                                    <td><?= $key + 1; ?></td>
                                    <td><?= $item->title_am; ?></td>
                                    <td class="text-center"><?= my_date(date($item->date), 'am'); ?></td>
                                    <td class="text-center"><a href="<?= base_url('admin/staticPageEdit/') . $item->id; ?>" title="Խմբագրել"><i class="fa fa-edit text-success" style="font-size: 20px;"></i></a></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>