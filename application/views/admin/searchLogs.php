<div class="content-wrapper">
    <section class="content-header">
        <h1><i class="fa fa-search" aria-hidden="true"></i> Որոնված բառեր</h1>
    </section>
    <hr>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-bordered table-striped table-condensed">
                    <thead class="bg-info">
                        <tr>
                            <th scope="col">Որոնված բառեր</th>
                            <th scope="col">Որոնված քանակ</th>
                            <th scope="col">Առկա քանակ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($datas) ): ?>
                            <?php foreach ($datas as $key => $item): ?>
                            <tr>
                                <td><?= $item->datas; ?></td>
                                <td><?= $item->counts; ?></td>
                                <td><?= $item->count; ?></td>
                            </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <h4 class="text-center text-danger fs-6"><?= $not_items; ?></h4>
                        <?php endif; ?>
                    </tbody>
                </table>
                <div class="text-center"><?= $links; ?></div>
            </div>
        </div>
    </section>
</div>
</div>