<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/bootstrap-datepicker3.min.css" />
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Մուտք գործելու պատմություն
        <small>հետևել մուտքի պատմությանը</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
          <form action="<?php echo base_url('admin/loginHistory') ?>" method="POST" id="searchList">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 form-group">
              <div class="input-group">
                <input id="fromDate" type="text" name="fromDate" value="<?php echo $fromDate; ?>" class="form-control datepicker" placeholder="Սկսած ամսաթվից՝" autocomplete="off" />
                <span class="input-group-addon"><label for="fromDate"><i class="fa fa-calendar"></i></label></span>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 form-group">
              <div class="input-group">
                <input id="toDate" type="text" name="toDate" value="<?php echo $toDate; ?>" class="form-control datepicker" placeholder="Մինչև ամսաթիվը՝" autocomplete="off" />
                <span class="input-group-addon"><label for="toDate"><i class="fa fa-calendar"></i></label></span>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
              <input id="searchText" type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control" placeholder="Որոնում․․․"/>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 form-group">
              <button type="submit" class="btn btn-md btn-primary btn-block searchList pull-right"><i class="fa fa-search" aria-hidden="true"></i></button> 
            </div>
            <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 form-group">
              <button class="btn btn-md btn-default btn-block pull-right resetFilters"><i class="fa fa-refresh" aria-hidden="true"></i></button>
            </div>
          </form>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?= !empty($userInfo) ? $userInfo->name." : ".$userInfo->email : "Բոլոր օգտատերերը" ?></h3>
                    <div class="box-tools">
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>Սեսսիայի տվյալները</th>
                      <th>IP հասցե</th>
                      <th>Բրաուզերը</th>
                      <th>Ամբողջ տվյալները</th>
                      <th>Պլատֆորմ</th>
                      <th>Ամսաթիվ-ժամ</th>
                    </tr>
                    <?php if(!empty($userRecords)): ?>
                      <?php foreach ($userRecords as $record): ?>
                        <tr>
                          <td><?php echo json_decode($record->sessionData)->name.' <small>('.json_decode($record->sessionData)->roleText.' )</small>' ?></td>
                          <td><?php echo $record->machineIp ?></td>
                          <td><?php echo $record->userAgent ?></td>
                          <td><?php echo $record->agentString ?></td>
                          <td><?php echo $record->platform ?></td>
                          <td><?php echo $record->createdDtm ?></td>
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
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;
            jQuery("#searchList").attr("action", link);
            jQuery("#searchList").submit();
        });

        jQuery('.datepicker').datepicker({
          autoclose: true,
          format : "dd-mm-yyyy"
        });
        jQuery('.resetFilters').click(function(){
          $(this).closest('form').find("input[type=text]").val("");
        })
    });
</script>
