<?php /*
// Sản phẩm nổi bật phân trang
// Sản phẩm nổi bật phân trang theo danh mục cấp 1
// Sản phẩm nổi bật phân trang theo tab danh mục cấp 1
// Sản phẩm nổi bật phân trang theo tab cố định
// Sản phẩm nổi bật phân trang theo for cấp 1 tab cấp 2
// Sản phẩm nổi bật có nút xem thêm
// Sản phẩm nổi bật có nút xem thêm for danh mục cấp 1
// Sản phẩm nổi bật có nút xem thêm tab danh mục cấp 1
// Sản phẩm nổi bật có nút xem thêm tab cố định
// Chạy slick theo tab loại cố định
// Chạy slick theo tab cấp 1
// Chạy slick theo for cấp 1 tab cấp 2
// Vào layout/copde index.php để biết đầy đủ code
*/ ?>



<!-- Sản phẩm nổi bật -->
<div class="box_spnb">
    <div class="wrap-product wrap-content">
        <div class="top_text">
            <div class="text_index"><span>Sản phẩm nổi bật</span></div>
            <p class="slogann"><?= $slogan['name' . $lang] ?></p>
            <img src="assets/images/line.png">
        </div>

        <div class="run_spnb">
            <?= $func->GetProducts($sanphamnb, '',false) ?>
        </div>
    </div>
</div>

<div class="box_sanpham">
    <?php foreach ($splistmenu as $key => $value) {
        $spcatmenu = $d->rawQuery("select name$lang, slugvi, id from #_product_cat where type = ? and find_in_set('hienthi',status) and id_list = ? order by numb,id desc", array('san-pham', $value['id']));
    ?>
        <div class="wrap-product">
            <div class="wrap-content">
                

                <div class="top_text">
                    <div class="text_index m-0"><span><?= $value['name' . $lang] ?></span></div>
                    <p class="slogann"><?= $slogan['name' . $lang] ?></p>
                    <img src="assets/images/line.png">
                </div>
                    
               
                <div class="list_monnb banchay_list list_<?= $value['id'] ?> ml-3">
                    <?php foreach ($spcatmenu as $key2 => $value2) { ?>
                        <a class="mr-2 font-weight-bold" data-id="<?= $value2['id'] ?>"><?= $value2['name' . $lang] ?></a>
                    <?php } ?>
                </div>
                <div class="page_danhmuc page_danhmuc_list<?= $value['id'] ?>"></div>
                <div class="clear"></div>
            </div>
        </div>
    <?php } ?>
</div>



<div class="box_banner">
    <div class="run_bannerqc">
        <?php foreach($bannerqc as $k => $v) { ?> 
            <p class="pic-bannerqc"><img onerror="this.src='<?=THUMBS?>/1366x350x1/assets/images/noimage.png';" src="<?=THUMBS?>/1366x350x1/<?=UPLOAD_PHOTO_L.$v['photo']?>" alt="<?=$v['name'.$lang]?>" width="1366" height="350"></p>

        <?php } ?> 
    </div>
</div>

<div class="box_tieuchi_video">
    <div class="flex_tc_vd">
        <div class="left_tc_vd">
            <div class="wap_1200">
                <p class="tc1">tại sao chọn phương quốc</p>
                <p class="slogann"><?= $slogan['name' . $lang] ?></p>
                <p class="img_tc"> <img src="assets/images/line_tc.png"></p>
                <div class="tieuchi">
                    <?php foreach($tieuchi as $k => $v) { ?>
                        <div class="flex_tieuchi">
                            <div class="left_tc">
                                <p class="pic-tieuchi scale-img"><img onerror="this.src='<?=THUMBS?>/40x40x2/assets/images/noimage.png';" src="<?=THUMBS?>/40x40x2/<?=UPLOAD_NEWS_L.$v['photo']?>" alt="<?=$v['name'.$lang]?>" width="40" height="40"></p>
                            </div>
                            <div class="right_tc">
                                <p class="name-tieuchi text-split"><?=$v['name'.$lang]?></p>
                                <p class="desc-tieuchi text-split"><?=$v['desc'.$lang]?></p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="right_tc_vd">
            <div class="videohome-intro1">
                <?php /*echo $addons->set('video-fotorama', 'video-fotorama', 4);*/ ?>                    
                <?php /*echo $addons->set('video-slick', 'video-slick', 4);*/ ?>
                <?php echo $addons->set('video-img-slick', 'video-img-slick', 4);?>
                <?php /*echo $addons->set('video-select', 'video-select', 4);*/  ?>
            </div>
        </div>
    </div>
</div>
