<div class="content-wrapper" style="background-color: white;">
    <section class="content-header">
        <h1>
            <i class="fa fa-bars" aria-hidden="true"></i> Կատեգորիաներ 
        </h1>
        <hr>
        <div class="container-fluid">
            <div class="d-flex justify-content-end">
                <button class="btn btn-success" data-toggle='modal' data-target='#addCategory'>Ավելացնել</button>
            </div>
            <div class="body-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 1px;" class="text-center">N</th>
                                <th class="text-left">Կատեգորիայի անվանումը</th>
                                <th class="text-center">Խմբագրել</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo $categories; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- The modal editCategory -->
<div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Կատեգորիաի խմբագրում</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="editCategories">Ծնող կատեգորիա</label>
                    <select id="editCategories" class="select2ToTree" style="width: 100%"></select>
                </div>
                <div class="form-group">
                    <label>Կատեգորիայի անվանումը (հայերեն)</label>
                    <input type="text" class="form-control" name="edit_1">
                </div>
                <!-- <div class="form-group">
                    <label>Կատեգորիայի անվանումը (ռուսերեն)</label>
                    <input type="text" class="form-control" name="edit_2">
                </div> -->
                <div class="form-group">
                    <label>Կատեգորիայի անվանումը (անգլերեն)</label>
                    <input type="text" class="form-control" name="edit_3">
                </div>
                <div class="form-group group-category">
                    <label for="editCategories">Կատեգորիաի խմբավորում</label>
                    <select id="order_by" class="form-control">
                        <option value="0">Ընտրել</option>
                        <?php for ($i=1; $i <= $gen_categories_length; $i++): ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php endfor; ?>                
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="item">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Փակել</button>
                <button type="button" class="btn btn-success" data-edit="category">Պահպանել</button>
            </div>
        </div>
    </div>
</div>

<!-- The modal addCategory -->
<div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Ավելացնել կատեգորիա</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="addCategories">Ծնող կատեգորիա</label>
                    <select id="addCategories" style="width: 100%" class="select2ToTree"></select>
                </div>
                <div class="form-group">
                    <label>Կատեգորիայի անվանումը (հայերեն)</label>
                    <input type="text" class="form-control" name="add_1">
                </div>
                <!-- <div class="form-group">
                    <label>Կատեգորիայի անվանումը (ռուսերեն)</label>
                    <input type="text" class="form-control" name="add_2">
                </div> -->
                <div class="form-group">
                    <label>Կատեգորիայի անվանումը (անգլերեն)</label>
                    <input type="text" class="form-control" name="add_3">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Փակել</button>
                <button type="button" class="btn btn-success" data-add="category">Պահպանել</button>
            </div>
        </div>
    </div>
</div>