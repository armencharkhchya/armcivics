  
        <!-- <section class="contact position-relative pt-5">
            <div id="contact" style="position: absolute; top:-100px"></div>
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2><?php echo $this->lang->line('contact'); ?></h2>
                    <h3><span><?php echo $this->lang->line('contact_us'); ?></span></h3>
                    <p>Լորեմ Իպսումը տպագրության և տպագրական արդյունաբերության համար նախատեսված մոդելային տեքստ է։</p>
                </div>

                <div class="row gy-3 mb-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-6">
                        <div class="info-box">
                            <i class="bx bx-map"></i>
                            <h3><?php echo $this->lang->line('our_address'); ?></h3>
                            <p>ք․Երևան Հանրապետության 1 </p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="info-box">
                            <i class="bx bx-envelope"></i>
                            <h3><?php echo $this->lang->line('e-mail'); ?></h3>
                            <p>contact@example.com</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="info-box">
                            <i class="bx bx-phone-call"></i>
                            <h3><?php echo $this->lang->line('phone'); ?></h3>
                            <p>+1 5589 55488 55</p>
                        </div>
                    </div>
                </div>
                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-6 ">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3048.3437997384485!2d44.51785332907191!3d40.17916171207934!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x406abcefc1cb7e8d%3A0x8077b54fa568842!2zODAgSGFucmFwZXR1dHlhbiBwb2tob3RzLCBZZXJldmFuIDAwMTAsINCQ0YDQvNC10L3QuNGP!5e0!3m2!1sru!2sus!4v1667757981194!5m2!1sru!2sus"
                            width="100%" height="380" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="col-lg-6">
                        <form action="#" method="post" id="contactform" role="form" class="php-email-form text-end">
                            <div class="row">
                                <div class="col form-group">
                                    <span class="error validation-name"></span>
                                    <input type="text" name="name" class="form-control"
                                        placeholder="<?php echo $this->lang->line('your_name'); ?>">
                                </div>
                                <div class="col form-group">
                                    <span class="error validation-email"></span>
                                    <input type="email" class="form-control" name="email"
                                        placeholder="<?php echo $this->lang->line('e-mail'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="error validation-subject"></span>
                                <input type="text" class="form-control" name="subject"
                                    placeholder="<?php echo $this->lang->line('theme'); ?>">
                            </div>
                            <div class="form-group">
                                <span class="error validation-message"></span>
                                <textarea class="form-control" name="message" rows="5"
                                    placeholder="<?php echo $this->lang->line('message'); ?>"></textarea>
                            </div>
                            <button type="submit"><?php echo $this->lang->line('send'); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </section> -->
        <footer id="footer">
            <!-- <div class="footer-newsletter">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <h4><?= $this->lang->line('subscribe'); ?></h4>
                            <p><?= $this->lang->line('subscribing'); ?></p>
                            <form action="" method="post">
                                <input type="email" name="subscribe_email"><input id="subscribe" type="submit" value="&#x27A2;">
                            </form>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 footer-contact">
                            <h3>ArmCivics<span>.</span></h3>
                            <p>ք․Երևան <br>
                                Պռոշյան 2/2 (գործունեության հասցե)<br>
                                Հայաստանի հանրապետություն <br><br>
                                <strong><?= $this->lang->line('phone'); ?>:</strong> (010) 32-11-13; 32-11-14<br>
                                <strong><?= $this->lang->line('email'); ?>:</strong> ph-arm-office@ph-int.org<br>
                            </p>
                        </div>
                        <div class="col-lg-3 col-md-6 footer-links">
                            <h4><?= $this->lang->line('links'); ?></h4>
                            <ul>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Հղում 1</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Հղում 2</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Հղում 3</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-3 col-md-6 footer-links">
                            <h4><?= $this->lang->line('services'); ?></h4>
                            <ul>
                                <li><i class="bx bx-chevron-right"></i> <a
                                        href="<?php echo base_url('auth'); ?>"><?php echo $this->lang->line('students-funds'); ?></a>
                                </li>
                                <li><i class="bx bx-chevron-right"></i> <a
                                        href=""><?php echo $this->lang->line('school-grant-programs'); ?></a></li>
                                <li><i class="bx bx-chevron-right"></i> <a
                                        href=""><?php echo $this->lang->line('civil-society-crowdfunding'); ?></a></li>
                            </ul>
                        </div>
                        <div class="col-lg-3 col-md-6 footer-links">
                            <h4>Մեր սոցիալական ցանցերը</h4>
                            <p>Լորեմ Իպսումը տպագրության և տպագրական արդյունաբերության համար նախատեսված մոդելային տեքստ է։
                            </p>
                            <div class="social-links mt-3">
                                <a href="https://twitter.com/PH_Armenia" target="_blank"><i class="bx bxl-twitter"></i></a>
                                <a href="https://www.facebook.com/ArmCivics4Engage" target="_blank"><i
                                        class="bx bxl-facebook"></i></a>
                                <a href="https://www.instagram.com/armcivics4engage/" target="_blank"><i
                                        class="bx bxl-instagram"></i></a>
                                <a href="https://www.youtube.com/@Armcivics4engage" target="_blank"><i
                                        class='bx bxl-youtube'></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="container py-4">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <h6 class="fw-bold mh-40">«Քաղաքացիական կրթություն և մասնակցություն» ծրագիր</h6>
                        <p>Ծրագրի նպատակն է բարելավել Հայաստանում ֆորմալ և ոչ ֆորմալ քաղաքացիական
                            կրթության որակը՝ խթանելու Հայաստանում երիտասարդների հանրային
                            ներգրավվածությունը և ժողովրդավարական գործընթացները։</p>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <h6 class="fw-bold mh-40">Աջակցություն</h5>
                        <p>Կայքը հնարավոր է դարձել Ամերիկայի ժողովրդի աջակցությամբ՝ ԱՄՆ Միջազգային
                            զարգացման գործակալության միջոցով (ԱՄՆ ՄԶԳ):
                            Բովանդակության համար պատասխանատու են միմիայն հեղինակները և այն
                            պարտադիր չէ, որ արտահայտի ԱՄՆ ՄԶԳ կամ ԱՄՆ կառավարության տեսակետները:</p>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <h6 class="fw-bold mh-40">Հետադարձ կապ</h5>
                        <p>ք․Երևան <br>
                            Պռոշյան 2/2 (գործունեության հասցե)
                            Հայաստանի հանրապետություն <br><br>
                            <strong><?= $this->lang->line('phone'); ?>:</strong> (010) 32-11-13; 32-11-14<br>
                            <strong><?= $this->lang->line('email'); ?>:</strong> ph-arm-office@ph-int.org<br>
                        </p> 
                    </div>                        
                </div>
                <hr>
                <div class="copyright">
                    &copy; Հեղինակային իրավունք <strong><span>ArmCivics</span></strong>. Բոլոր իրավունքները պաշտպանված են
                </div>
                <div class="credits">
                    Ստեղծված է <a href="https://www.facebook.com/DigitalAgencie">DigitalAgencie</a> -ի կողմից
                </div>
            </div>
        </footer>
        <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <button type="button" class="close" onclick="stopVideo()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="embed-responsive embed-responsive-16by9">
                            <div id="player1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="preloader"></div>
        <div id="calendar-open"></div>
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
        <script src="<?= base_url(); ?>assets/js/main.js?v=0.01"></script>
        <script>
            $("#subscribe").click(function (e) {
                e.target.disabled = true;
                e.preventDefault();
                formData = new FormData();
                formData.append('email', $('[name=subscribe_email]').val())
                $.ajax({
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    dataType: 'json',
                    url: BASE_URL + LANG + '/subscribe',
                    data: formData,
                    success: function (response) {
                        if (response.status == '-1') {
                            $.toast({
                                text: response.errors,
                                position: 'top-right',
                                heading: '<?= $this->lang->line('
                                attention '); ?>',
                                bgColor: '#dc3545'
                            });
                        } else {
                            $.toast({
                                text: response.message,
                                position: 'top-right',
                                heading: '<?= $this->lang->line('
                                attention '); ?>',
                                bgColor: '#28a745'
                            });
                            // $('# basicToast.toast - body ').html(response.message)
                        }
                        e.target.disabled = false;
                    },
                    error: function (errResponse) {
                        console.log(errResponse);
                    }
                });

            });
        </script>
        <script>
            var tag = document.createElement('script');
            tag.src = "https://www.youtube.com/iframe_api";
            var firstScriptTag = document.getElementsByTagName('script')[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
            var player;
            $('.play').click(function () {
                var videoId = $(this).attr('data-src');
                player = new YT.Player('player1', {
                    height: '390',
                    width: '640',
                    videoId: videoId,
                    events: {
                        'onReady': onPlayerReady,
                        'onStateChange': onPlayerStateChange
                    }
                });
                $("#myModal").show();
                // setTimeout(() => {
                //     console.log(player.playerInfo.videoData.title)
                // }, 1000);
            })

            function onPlayerReady(event) {
                event.target.playVideo();
            }

            function onPlayerStateChange(event) {
                if (event.data == 0) {
                    stopVideo();
                }
            }

            function stopVideo() {
                player.destroy();
                $("#myModal").hide();
            }
            $(document).keyup(function (e) {
                if (e.keyCode === 27) stopVideo(); // esc
            });
        </script>
        <script>
            $(document).on('submit', '#contactform', function (event) {
                event.preventDefault();
                $('#contactform button[type=submit]').prop('disabled', true);
                $('#contactform button[type=submit]').val('<?= $this->lang->line('
                    sent '); ?>');
                $('.error').empty();
                var name = $('input[name=name]').val();
                var email = $('input[name=email]').val();
                var subject = $('input[name=subject]').val();
                var message = $('textarea[name=message]').val();
                var form_data = new FormData();
                form_data.append('submit', 'Value');
                form_data.append('name', name);
                form_data.append('email', email);
                form_data.append('subject', subject);
                form_data.append('message', message);
                form_data.append('lang', '<?= $lang; ?>');
                do_ajax('<?= base_url($lang . ' / send_email '); ?>', form_data, function (result) {
                    if (result.status == 'no-validate') {
                        $('#Imageid').attr('src', result.src);
                        $.each(result.ValidationErrors, function (key, value) {
                            if (value) {
                                $('.validation-' + key).text(value);
                            }
                        });
                    }
                    $.toast({
                        text: result.html,
                        position: 'top-right',
                        heading: '<?= $this->lang->line('
                        attention '); ?>',
                        bgColor: result.bg
                    });
                    $('#contactform button[type=submit]').prop('disabled', false);
                    $('#contactform button[type=submit]').val('<?= $this->lang->line('
                        send '); ?>')
                });
            });

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
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert_error();
                    }
                });
            }

            function get_ajax(ajax_url, ajax_data, ajax_callback, ajax_type) {
                ajax_type = ajax_type || 'json';
                return $.ajax({
                    url: ajax_url,
                    type: 'get',
                    dataType: ajax_type,
                    cache: false,
                    data: ajax_data,
                    success: ajax_callback,
                    processData: false,
                    contentType: false,
                });
            }
        </script>
   	</body>
</html>