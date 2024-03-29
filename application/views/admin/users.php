<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-user-circle-o"></i> Օգտվողների կառավարում
            <small>Ավելացնել, փոփոխել, հեռացնել</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url('admin/addNew'); ?>"><i class="fa fa-plus"></i> Ավելացնել</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Օգտվողների ցուցակը</h3>
                        <div class="box-tools">
                            <form action="<?php echo base_url('admin/userListing') ?>" method="POST" id="searchList">
                                <div class="input-group">
                                    <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Որոնել" />
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>Անուն</th>
                                <th>Էլ․ հասցե</th>
                                <th>Հեռախոս</th>
                                <th>Դերը</th>
                                <th>Ստեղծվել է</th>
                                <th class="text-center">Գործողություններ</th>
                            </tr>
                            <?php if (!empty($userRecords)) : ?>
                                <?php foreach ($userRecords as $record) : ?>
                                    <tr>
                                        <td><?php echo $record->name ?></td>
                                        <td><?php echo $record->email ?></td>
                                        <td><?php echo $record->mobile ?></td>
                                        <td><?php echo $record->role ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($record->createdDtm)) ?></td>
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-primary" href="<?= base_url('admin/loginHistory/') . $record->userId; ?>" title="Մուտքի պատմություն"><i class="fa fa-history"></i></a> |
                                            <a class="btn btn-sm btn-info" href="<?php echo base_url('admin/editOld/') . $record->userId; ?>" title="Խմբագրել"><i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-sm btn-danger deleteUser" href="#" data-userid="<?php echo $record->userId; ?>" title="Հեռացնել"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php endif; ?>
                        </table>
                    </div>
                    <div class="box-footer clearfix">
                        <?php echo $this->pagination->create_links(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('ul.pagination li a').click(function(e) {
            e.preventDefault();
            var link = jQuery(this).get(0).href;
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "userListing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>