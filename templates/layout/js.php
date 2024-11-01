<!-- Js Config -->
<script type="text/javascript">
    var NN_FRAMEWORK = NN_FRAMEWORK || {};
    var CONFIG_BASE = '<?= $configBase ?>';
    var JS_AUTOPLAY = <?= ($_SERVER["SERVER_NAME"]!="localhost")?'true':'false' ?>;
    var ASSET = '<?= ASSET ?>';
    var WEBSITE_NAME = '<?= (!empty($setting['name' . $lang])) ? addslashes($setting['name' . $lang]) : '' ?>';
    var TIMENOW = '<?= date("d/m/Y", time()) ?>';
    var SHIP_CART = <?= (!empty($config['order']['ship'])) ? 'true' : 'false' ?>;
    var RECAPTCHA_ACTIVE = <?= (!empty($config['googleAPI']['recaptcha']['active'])) ? 'true' : 'false' ?>;
    var RECAPTCHA_SITEKEY = '<?= $config['googleAPI']['recaptcha']['sitekey'] ?>';
    var GOTOP = ASSET + 'assets/images/top.png';
    var LANG = {
        'no_keywords': '<?= chuanhaptukhoatimkiem ?>',
        'delete_product_from_cart': '<?= banmuonxoasanphamnay ?>',
        'no_products_in_cart': '<?= khongtontaisanphamtronggiohang ?>',
        'ward': '<?= phuongxa ?>',
        'back_to_home': '<?= vetrangchu ?>',
    };
    var LIST_SAVED = '';
    var CARTSITE = '<?= (CARTSITE) ? 'true' : 'false' ?>';
</script>
<!-- Js Files -->
<?php
    $js->set("js/jquery.min.js");
    $js->set("js/lazyload.min.js");
    $js->set("js/pagingnation.js");
    $js->set("bootstrap/bootstrap.js");
    $js->set("js/wow.min.js");
    $js->set("confirm/confirm.js");
    $js->set("holdon/HoldOn.js");
    //$js->set("easyticker/easy-ticker.js");
    //$js->set("fotorama/fotorama.js");
    $js->set("slick/slick.js");
    $js->set("fancybox3/jquery.fancybox.js");
    $js->set("photobox/photobox.js");
    // $js->set("simplenotify/simple-notify.js");
    // $js->set("fileuploader/jquery.fileuploader.min.js");
    //$js->set("datetimepicker/php-date-formatter.min.js");
    //$js->set("datetimepicker/jquery.mousewheel.js");
    //$js->set("datetimepicker/jquery.datetimepicker.js");
    $js->set("js/functions.js");
    //$js->set("js/comment.js");
    $js->set("js/toc.js");
    $js->set("js/apps.js");
    echo $js->get();
?>
<?php if($source!='index'){?>
    <script src="assets/magiczoomplus/magiczoomplus.js"></script> 
    <script src="assets/owlcarousel2/owl.carousel.js"></script> 
    <script src="assets/js/apps_nothome.js"></script> 
    <?php if($id!=''||$template=='static/static'){?>
    <script src="//sp.zalo.me/plugins/sdk.js"></script>
    <script async src="https://static.addtoany.com/menu/page.js"></script>    <?php /* css icon màu đen
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-547d33901b6ed4a0"></script>
    */ ?>
    <?php } ?>    
<?php } ?>
<?php if(CARTSITE==true){ ?> 
    <script src="assets/js/function_cart.js"></script>
<?php } ?>
<?php if($source=='index') { ?>
<script>
    $(document).ready(function() {
        $('.chay-slider').slick({
            lazyLoad: 'progressive', infinite: true, accessibility:true, vertical:false, slidesToShow: 1,  
            slidesToScroll: 1, autoplay:true,  autoplaySpeed:3000, speed:1000, arrows:true, 
            centerMode:false,  dots:false,  draggable:true,
        }); 
        $('.chay-tintuc-vertical').slick({
            lazyLoad: 'progressive', infinite: true, accessibility:true, vertical:true, slidesToShow: 3,  
            slidesToScroll: 1, autoplay:true,  autoplaySpeed:3000, speed:1000, arrows:true, 
            centerMode:false,  dots:false,  draggable:true,  responsive: [ 
            {  breakpoint: 800, settings: { slidesToShow: 3, slidesToScroll: 1,arrows:true ,vertical:true,} } ]
        });        
        $('.run_spnb').slick({
            lazyLoad: 'progressive', infinite: true, accessibility:true, vertical:false, slidesToShow: 4,  
            slidesToScroll: 1, autoplay:false,  autoplaySpeed:3000, speed:1000, arrows:false, 
            centerMode:false,  dots:false,  draggable:true,  responsive: [ 
            {  breakpoint: 800, settings: { slidesToShow: 2, slidesToScroll: 1,arrows:false ,vertical:false,} } ]
        }); 
        $('.run_bannerqc').slick({
            lazyLoad: 'progressive', infinite: true, accessibility:true, vertical:false, slidesToShow: 1,  
            slidesToScroll: 1, autoplay:false,  autoplaySpeed:3000, speed:1000, arrows:false, 
            centerMode:false,  dots:false,  draggable:true,  responsive: [ 
            {  breakpoint: 800, settings: { slidesToShow: 1, slidesToScroll: 1,arrows:false ,vertical:false,} } ]
        });
       
    });
</script>
<script>
    $(document).ready(function() {
        <?php foreach ($splistmenu as $k => $v) { ?>
                $(document).on('click', '.list_<?= $v['id'] ?> a', function(event) {
                    event.preventDefault();
                    $(this).parent('.list_<?= $v['id'] ?>').find('a').removeClass('active');
                    $(this).addClass('active');
                    init_paging_category_list('<?= $v['id'] ?>', 'list_<?= $v['id'] ?>', 'page_danhmuc_list<?= $v['id'] ?>', 8, 'product', 'san-pham', "and find_in_set('noibat',status)");
                });
                init_paging_category_list('<?= $v['id'] ?>', 'list_<?= $v['id'] ?>', 'page_danhmuc_list<?= $v['id'] ?>', 8, 'product', 'san-pham', "and find_in_set('noibat',status)");
            <?php } ?>
    });
</script>



<?php } ?>
<?php if (!empty($config['googleAPI']['recaptcha']['active'])) { ?>
    <!-- Js Google Recaptcha V3 -->
    <script src="https://www.google.com/recaptcha/api.js?render=<?= $config['googleAPI']['recaptcha']['sitekey'] ?>"></script>
    <script type="text/javascript">
        grecaptcha.ready(function(){
            /*báo giá*/
            /*document.getElementById('form-baogia').addEventListener("submit", function(event) {
                    event.preventDefault();
                    generateCaptcha('baogia', 'recaptchaResponseContact', 'form-baogia');
                }, false);*/

            /* Newsletter */
            document.getElementById('form-newsletter').addEventListener("submit", function(event) {
                event.preventDefault();
                generateCaptcha('Newsletter', 'recaptchaResponseNewsletter', 'form-newsletter');
            }, false);
            <?php if ($source == 'contact') { ?>
                /* Contact */
                document.getElementById('form-contact').addEventListener("submit", function(event) {
                    event.preventDefault();
                    generateCaptcha('contact', 'recaptchaResponseContact', 'form-contact');
                }, false);
            <?php } ?>
        });
    </script>
<?php } ?>
   
<?php if (!empty($config['oneSignal']['active'])) { ?>
    <!-- Js OneSignal -->
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <script type="text/javascript">
        var OneSignal = window.OneSignal || [];
        OneSignal.push(function() {
            OneSignal.init({
                appId: "<?= $config['oneSignal']['id'] ?>"
            });
        });
    </script>
<?php } ?>
<!-- Js Structdata -->
<?php include TEMPLATE . LAYOUT . "strucdata.php"; ?>
<!-- Js Addons -->
<?= $addons->set('script-main', 'script-main', 3); ?>
<?= $addons->get(); ?>
<!-- Js Body -->
<?= $func->decodeHtmlChars($setting['bodyjs']) ?>
<?php if(!COPYSITE) { ?>
<!-- Chống Copy -->
<script type="text/javascript">
    function clickIE() {
        if (document.all) {(message);return false;}
    }
    function clickNS(e) {
        if (document.layers||(document.getElementById&&!document.all)) {
            if (e.which==2||e.which==3) {
                return false; }
            }
        }
    if (document.layers) {
        document.captureEvents(Event.MOUSEDOWN);
        document.onmousedown=clickNS;
    } else {
        document.onmouseup=clickNS;
        document.oncontextmenu=clickIE;
        document.onselectstart=clickIE
    }
    document.oncontextmenu=new Function("return false")
</script>
<script type="text/javascript">
    function disableselect(e){
        return false
    }
    function reEnable(){
        return true
    }
    document.onselectstart=new Function ("return false")
    if (window.sidebar) {
        document.onmousedown=disableselect
        document.onclick=reEnable
    }
</script>
<script>
    $(document).keydown(function(event) {
        if(event.keyCode==123) {
            return false;
        }
        else if(event.ctrlKey && event.shiftKey && event.keyCode==73) {        
            return false;
        }
        else if(event.ctrlKey && event.keyCode==85) {        
            return false;
        }
    });
</script>
<?php } ?>
<!-- Sản phẩm yêu thích -->
<?php if(isset($_SESSION['list_saved']) and $_SESSION['list_saved']!='') { ?>
<script>
    var LIST_SAVED = <?php echo json_encode( array_column( json_decode($_SESSION['list_saved'], true), 'id' ) ) ?>;
    reloadLike(LIST_SAVED);
</script>
<?php } ?>
<?php /*if(count($chinhanh)>0){ ?>
<script>
    $(document).ready(function(e) {            
            var id_item = ''; 
            $(".item-ht").click(function(){
                $('.item-ht').removeClass('act-item');
                id_item = $(this).data('id');
                $(this).addClass('act-item');
                xuly();                                                 
            });
            function xuly(){
                $.ajax({
                    url: 'api/ajax_bando.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {id_item: id_item},                       
                    beforeSend: function(){
                        $("#loading").fadeIn(600);
                    },
                    success: function(result){
                        $("#loading").fadeOut(600);
                        $('.ht-right').html(result);                                        
                        return false;
                    }
                })              
            }           
    });
</script>
<?php }*/ ?>

<?php /*
<script>
    $(document).ready(function() {
        $('.baogia-form .guimail').click(function(){
            var ten = $('#fullname-baogia');
            var phone = $('#phone-baogia');
            var email = $('#email-baogia');
            if(isEmpty(ten.val(), "Vui lòng nhập họ tên.")){ ten.focus(); return false; }
            if(isEmpty(phone.val(), "Vui lòng nhập số điện thoại.")){ phone.focus(); return false; }
            if(isPhone(phone.val(), "Số điện thoại không hợp lệ")){ phone.focus(); return false; }
            if(isEmpty(email.val(), "Vui lòng nhập email.")){ email.focus(); return false; }  
            if(isEmail(email.val(), "Email không hợp lệ")){ email.focus(); return false; }  
        })
    });           
</script>
*/ ?>

 <?php /*
 <script type="text/javascript">
   $(document).ready(function(e) {
        $(document).on('click', '.sty_list', function(event) {
            var vitri = $(this).data('vitri');
            if($(this).hasClass('act')){
                // $(".load"+vitri).removeClass('mo');
                // $(".load"+vitri).addClass('dong');
                $(this).removeClass('act');
            } else {
                $(".container_load_info").removeClass('mo');
                $(".container_load_info").addClass('dong');
                $(".load"+vitri).removeClass('dong');
                $(".load"+vitri).addClass('mo');            
                $('.sty_list').removeClass('act');
                $(this).addClass('act');
                
            }        
        });
   });
</script>
 */ ?>