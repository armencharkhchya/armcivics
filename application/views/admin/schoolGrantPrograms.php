<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-money" aria-hidden="true"></i></i>&nbsp;Դպրոցական դրամաշնորհային ծրագրեր (<?= $allCount; ?><small>նյութ</small>)
        </h1>
        <div class="row mt-3">
            <form action="<?php echo base_url('admin/schoolGrantPrograms'); ?>" method="get" class="col-sm-4">
                <input placeholder="Փնտրել" type="text" name="q" class="form-control" />
                <input type="submit" value="Որոնել" class="search" />
            </form>
            <form action="<?php echo base_url('admin/schoolGrantPrograms'); ?>" class="col-sm-4" method="get">
                <input placeholder="Ամսաթիվ" type="text" name="date" class="form-control datepicker" onchange="this.form.submit()" autocomplete="off" value="<?php echo $this->input->get('date') ?>" />
            </form>
        </div>
        <div class="row mt-3">
            <button class="btn btn-success pull-right mr-3 mb-3" type="button" data-toggle="modal" data-target="#schoolGrantsModal" aria-expanded="false" aria-controls="collapseAddItem">
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
                                    <b><?= $item->name_am ?></b>
                                    <span><i class="fa fa-calendar mr-1"></i><?= my_date(date($item->date), 'am', true);  ?></time></span>
                                </div>
                                <div class="col-sm-2 text-center">
                                    <button class="btn btn-sm btn-info mr-2 editSchoolGrants" data-toggle="modal" data-target="#schoolGrantsModal" title="Խմբագրել" data="<?= $item->id ?>">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger mr-2 deleteSchoolGrants" title="Հեռացնել" data="<?= $item->id ?>">
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
    <div id="schoolGrantsModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <form action="<?php echo site_url('admin/addOrUpdateSchoolGrants'); ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Ավելացնել դպրոցական դրամաշնորհային ծրագիր</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <label class="col-sm-3">Ծրագրի անվանում (հայերեն)<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="name_am" class="form-control" required />
                            </div>
                        </div>
                        <br />
                        <!-- <div class="row">
                            <label class="col-sm-3">Ծրագրի անվանում (ռուսերեն)<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="name_ru" class="form-control" required />
                            </div>
                        </div>
                        <br /> -->
                        <div class="row">
                            <label class="col-sm-3">Ծրագրի անվանում (անգլերեն)<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="name_en" class="form-control" required />
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <label class="col-sm-3">Նպատակ (հայերեն)</label>
                            <div class="col-sm-9">
                                <input type="text" name="purpose_am" class="form-control" />
                            </div>
                        </div>
                        <br />
                        <!-- <div class="row">
                            <label class="col-sm-3">Նպատակ (ռուսերեն)</label>
                            <div class="col-sm-9">
                                <input type="text" name="purpose_ru" class="form-control" />
                            </div>
                        </div>
                        <br /> -->
                         <div class="row">
                            <label class="col-sm-3">Նպատակ (անգլերեն)</label>
                            <div class="col-sm-9">
                                <input type="text" name="purpose_en" class="form-control" />
                            </div>
                        </div>
                        <br />                       
                        <div class="row">
                            <label class="col-sm-3">Շահառու խումբ/խմբեր (հայերեն)</label>
                            <div class="col-sm-9">
                                <input type="text" name="interest_groups_am" class="form-control" />
                            </div>
                        </div>
                        <br />
                        <!-- <div class="row">
                            <label class="col-sm-3">Շահառու խումբ/խմբեր (ռուսերեն)</label>
                            <div class="col-sm-9">
                                <input type="text" name="interest_groups_ru" class="form-control" />
                            </div>
                        </div>
                        <br /> -->
                         <div class="row">
                            <label class="col-sm-3">Շահառու խումբ/խմբեր (անգլերեն)</label>
                            <div class="col-sm-9">
                                <input type="text" name="interest_groups_en" class="form-control" />
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <label class="col-sm-3">Իրականացման վայր/եր (հայերեն)</label>
                            <div class="col-sm-9">
                                <input type="text" name="location_am" class="form-control" />
                            </div>
                        </div>
                        <br />
                        <!-- <div class="row">
                            <label class="col-sm-3">Իրականացման վայր/եր (ռուսերեն)</label>
                            <div class="col-sm-9">
                                <input type="text" name="location_ru" class="form-control" />
                            </div>
                        </div>
                        <br /> -->
                        <div class="row">
                            <label class="col-sm-3">Իրականացման վայր/եր (անգլերեն)</label>
                            <div class="col-sm-9">
                                <input type="text" name="location_en" class="form-control" />
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <label class="col-sm-3">Իրականացնող դպրոց և կամ կառույց/ներ (հայերեն)</label>
                            <div class="col-sm-9">
                                <input type="text" name="structure_am" class="form-control" />
                            </div>
                        </div>
                        <br />
                        <!-- <div class="row">
                            <label class="col-sm-3">Իրականացնող դպրոց և կամ կառույց/ներ (ռուսերեն)</label>
                            <div class="col-sm-9">
                                <input type="text" name="structure_ru" class="form-control" />
                            </div>
                        </div>
                        <br /> -->
                         <div class="row">
                            <label class="col-sm-3">Իրականացնող դպրոց և կամ կառույց/ներ (անգլերեն)</label>
                            <div class="col-sm-9">
                                <input type="text" name="structure_en" class="form-control" />
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <label class="col-sm-3">Գործողություններ և ակնկալվող արդյունքներ, վիճակագրություն (հայերեն)&nbsp;
                                <i class="fa fa-question-circle-o text-info cursor" aria-hidden="true" data-toggle="tooltip" title="Առանձնացված դաշտեր ըստ սեռի, տարիքի, բնակավայրի, այլ նկարագրիչների" style="vertical-align: text-top;"></i>
                            </label>
                            <div class="col-sm-9">
                                <input type="text" name="results_am" class="form-control" placeholder="" />
                            </div>
                        </div>
                        <br />
                        <!-- <div class="row">
                            <label class="col-sm-3">Գործողություններ և ակնկալվող արդյունքներ, վիճակագրություն (ռուսերեն)&nbsp;
                                <i class="fa fa-question-circle-o text-info cursor" aria-hidden="true" data-toggle="tooltip" title="Առանձնացված դաշտեր ըստ սեռի, տարիքի, բնակավայրի, այլ նկարագրիչների" style="vertical-align: text-top;"></i>
                            </label>
                            <div class="col-sm-9">
                                <input type="text" name="results_ru" class="form-control" placeholder="" />
                            </div>
                        </div>
                        <br /> -->
                        <div class="row">
                            <label class="col-sm-3">Գործողություններ և ակնկալվող արդյունքներ, վիճակագրություն (անգլերեն)&nbsp;
                                <i class="fa fa-question-circle-o text-info cursor" aria-hidden="true" data-toggle="tooltip" title="Առանձնացված դաշտեր ըստ սեռի, տարիքի, բնակավայրի, այլ նկարագրիչների" style="vertical-align: text-top;"></i>
                            </label>
                            <div class="col-sm-9">
                                <input type="text" name="results_en" class="form-control" placeholder="" />
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <label class="col-sm-3">Հաջողության պատմություններ (հայերեն)</label>
                            <div class="col-sm-9">
                                <textarea name="quotes_am" class="form-control" rows="10" style="resize: none;"></textarea>
                            </div>
                        </div>
                        <br />
                        <!-- <div class="row">
                            <label class="col-sm-3">Հաջողության պատմություններ (ռուսերեն)</label>
                            <div class="col-sm-9">
                                <textarea name="quotes_ru" class="form-control" rows="10" style="resize: none;"></textarea>
                            </div>
                        </div>
                        <br /> -->
                         <div class="row">
                            <label class="col-sm-3">Հաջողության պատմություններ (անգլերեն)</label>
                            <div class="col-sm-9">
                                <textarea name="quotes_en" class="form-control" rows="10" style="resize: none;"></textarea>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <label class="col-sm-3">Ժամանակահատված</label>
                            <div class="col-sm-5">
                                <input type="text" name="time" class="datetimepicker form-control" value="<?= $dateNow; ?>"/>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <label class="col-sm-3">Ամսաթիվ</label>
                            <div class="col-sm-5">
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