<section id="content">
    <div class="row mx-0">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="topadd_bar shadow"><img class="lazyload" data-src="<?= base_url(); ?>assets/images/f0d33a2b1250c9bb3840c6f5.jpg" alt=""></div>
        </div>
    </div>
    <hr>
    <div class="container">
        <h1 class="mt-0"><?= $title ?></h1>
        <?= $breadcrumbs ?? '' ?>
        <div class="row">
            <div class="col-lg-8 col-sm-8 col-sm-8">
                <div class="contact_area wow fadeInLeftBig">
                    <form id="contact-form" class="contact_form">
                        <span class="error validation-name"></span>
                        <input class="form-control" type="text" name="name" placeholder="<?= $this->lang->line('name'); ?>">
                        <span class="error validation-email"></span>
                        <input class="form-control" type="mail" name="email" placeholder="<?= $this->lang->line('email'); ?>">
                        <span class="error validation-subject"></span>
                        <input class="form-control" type="text" name="subject" placeholder="<?= $this->lang->line('subject'); ?>">
                        <span class="error validation-text"></span>
                        <textarea class="form-control" cols="30" rows="10" name="text" placeholder="<?= $this->lang->line('message'); ?>"></textarea>
                        <input type="submit" value="<?= $this->lang->line('send'); ?>">
                    </form>
                </div>
            </div>
            <div class="col-lg-4 col-sm-4 col-sm-4">
                <div class="contact_address wow fadeInRightBig">
                    <h3><?= $this->lang->line('address'); ?></h3>
                    <p>Ք․ Երևան, Հանրապետության 1</p>
                    <h4><?= $this->lang->line('contactus'); ?></h4>
                    <address>
                        <p><i class="fa fa-mobile" aria-hidden="true" style="font-size: 20px; vertical-align: middle;"></i>&nbsp;&nbsp; (123) 456 78 90</p>
                        <a href="mailto:#"><i class="fa fa-envelope" aria-hidden="true" style="vertical-align: middle;"></i>&nbsp; first.last@email.com</a>
                    </address>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function do_ajax(ajax_url, ajax_data, ajax_callback, ajax_async, ajax_type) {
        ajax_type = ajax_type || 'json';
        ajax_async = ajax_async || true;
        return $.ajax({
            url: ajax_url,
            type: 'post',
            dataType: ajax_type,
            async: ajax_async,
            data: ajax_data,
            processData: false,
            contentType: false,
            success: ajax_callback,
            error: function(jqXHR, textStatus, errorThrown) {
                alert_error();
            }
        });
    }
    $(document).on('submit', '#contact-form', function(event) {
        event.preventDefault();
        $('#contact-form input[type=submit]').prop('disabled', true);
        $('#contact-form input[type=submit]').val('<?= $this->lang->line('sent'); ?>');
        $('.error').empty();

        var name = $('input[name=name]').val();
        var email = $('input[name=email]').val();
        var subject = $('input[name=subject]').val();
        var text = $('textarea[name=text]').val();
        var form_data = new FormData();

        form_data.append('submit', 'Value');
        form_data.append('name', name);
        form_data.append('email', email);
        form_data.append('subject', subject);
        form_data.append('text', text);
        form_data.append('lang', '<?= $lang; ?>');
        do_ajax('<?= base_url($lang . '/send_email'); ?>', form_data, function(result) {
            if (result.status == 'no-validate') {
                $('#Imageid').attr('src', result.src);
                $.each(result.ValidationErrors, function(key, value) {
                    if (value) {
                        $('.validation-' + key).text(value);
                    }
                });
            }
            $.toast({
                text: result.html,
                position: 'top-right',
                heading: '<?= $this->lang->line('attention'); ?>',
                bgColor: result.bg
            });
            $('#contact-form input[type=submit]').prop('disabled', false);
            $('#contact-form input[type=submit]').val('<?= $this->lang->line('send'); ?>')
        });
    });
</script>