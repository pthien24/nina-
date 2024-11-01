<div class="footer">
    <div class="top_ft">
        <div class="footer-article">
            <div class="wrap-content">
                <div class="wap_footer">
                    <div class="footer-news">
                        <p class="footer-title"><?=$setting['name' . $lang] ?></p>
                        <div class="footer-info"><?=$func->decodeHtmlChars($footer['content' . $lang]) ?></div>
                        <?php /* ?>
                        <ul>
                            <li class="w-clear"><i class="fas fa-map-marker-alt"></i><span></span><?=$optsetting['address']?></li>
                            <li class="w-clear"><i class="fas fa-phone-volume"></i><span></span><?=$optsetting['phone']?></li>
                            <li class="w-clear"><i class="fas fa-envelope"></i><span></span><?=$optsetting['email']?></li>
                            <li class="w-clear"><i class="fas fa-globe"></i><span></span><?=$optsetting['website']?></li>
                        </ul><?php */ ?>
                    </div>
                    <div class="footer-news">
                        <p class="footer-title">chính sách khách hàng</p>
                        <ul class="footer-ul">
                            <?php foreach ($policy as $v) { ?>
                                <li><a href="<?= $v[$sluglang] ?>" title="<?= $v['name' . $lang] ?>"><?= $v['name' . $lang] ?></a></li>
                            <?php } ?>
                        </ul>
                                        
                    </div>
                    <div class="footer-news">
                        <p class="footer-title">Fanpage facebook</p>
                        <?= $addons->set('fanpage-facebook', 'fanpage-facebook', 2); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php /*
        <div class="footer-tags">
            <div class="wrap-content">
                <p class="footer-title">Tags sản phẩm:</p>
                <ul class="footer-tags-lists w-clear mb-3">
                    <?php foreach ($tagsProduct as $v) { ?>
                        <li class="mr-1 mb-1"><a class="btn btn-sm btn-danger rounded" href="<?= $v[$sluglang] ?>" target="_blank" title="<?= $v['name' . $lang] ?>"><?= $v['name' . $lang] ?></a></li>
                    <?php } ?>
                </ul>
                <p class="footer-title">Tags tin tức:</p>
                <ul class="footer-tags-lists w-clear">
                    <?php foreach ($tagsNews as $v) { ?>
                        <li class="mr-1 mb-1"><a class="btn btn-sm btn-danger rounded" href="<?= $v[$sluglang] ?>" target="_blank" title="<?= $v['name' . $lang] ?>"><?= $v['name' . $lang] ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        */ ?>
        <div class="footer-powered">
            <div class="wrap-content">
                <div class="wap_copy">
                    <div class="footer-copyright">2023 Copyright <?=$setting['name'.$lang]?>. Design by Nina.vn</div>
                    <div class="footer-statistic">
                        <span><?= dangonline ?>: <?= $online ?></span>
                        <span><?= homnay ?>: <?= $counter['today'] ?></span>
                        <?php /*
                        <span><?= homqua ?>: <?= $counter['yesterday'] ?></span>
                        <span><?= trongtuan ?>: <?= $counter['week'] ?></span>
                        <span><?= trongthang ?>: <?= $counter['month'] ?></span>
                        */ ?>
                        <span><?= tongtruycap ?>: <?= $counter['total'] ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php /*if(count($chinhanh)>0){ 
            $optnews0 = (isset($chinhanh[0]['options']) && $chinhanh[0]['options'] != '') ? json_decode($chinhanh[0]['options'],true) : null;?>
        <div class="box-hethong">
            <div class="ht-left">
                <?php for($i=0;$i<count($chinhanh);$i++){
                    $optnews = (isset($chinhanh[$i]['options']) && $chinhanh[$i]['options'] != '') ? json_decode($chinhanh[$i]['options'],true) : null;
                    ?>
                    <div class="item-ht" data-id="<?=$chinhanh[$i]['id']?>">
                        <span class="ten"><i class="fal fa-map-marker-alt"></i> <?=$chinhanh[$i]['name'.$lang]?></span> 
                    </div>
                <?php } ?>
            </div>
            <div class="ht-right">
                <?=$optnews0['bando']?>
            </div>   
        </div>
    <?php }else{*/ ?>
    <?php echo $addons->set('footer-map', 'footer-map', 6); //} ?>    
    <?php /* $addons->set('messages-facebook', 'messages-facebook', 2);*/ ?>
</div>
<a class="cart-fixed liked-fixed text-decoration-none" href="yeu-thich" title="Danh sách yêu thích">
    <i class="fas fa-heart"></i>
    <span class="count-like"><?= (!empty($_SESSION['list_saved'])) ? count(json_decode($_SESSION['list_saved'], true)) : 0 ?></span>
</a>
<?php if ($com != 'gio-hang' and CARTSITE) { ?>
    <a class="cart-fixed text-decoration-none" href="gio-hang" title="Giỏ hàng">
        <i class="fas fa-shopping-bag"></i>
        <span class="count-cart"><?= (!empty($_SESSION['cart'])) ? count($_SESSION['cart']) : 0 ?></span>
    </a>
<?php } ?>
<a class="btn-zalo btn-frame text-decoration-none" target="_blank" href="https://zalo.me/<?= preg_replace('/[^0-9]/', '', $optsetting['zalo']); ?>">
    <div class="animated infinite zoomIn kenit-alo-circle"></div>
    <div class="animated infinite pulse kenit-alo-circle-fill"></div>
    <i><?= $func->getImage(['size-error' => '35x35x2', 'upload' => 'assets/images/', 'image' => 'zl.png', 'alt' => 'Zalo']) ?></i>
</a>
<a class="btn-phone btn-frame text-decoration-none" href="tel:<?= preg_replace('/[^0-9]/', '', $optsetting['hotline']); ?>">
    <div class="animated infinite zoomIn kenit-alo-circle"></div>
    <div class="animated infinite pulse kenit-alo-circle-fill"></div>
    <i><?= $func->getImage(['size-error' => '35x35x2', 'upload' => 'assets/images/', 'image' => 'hl.png', 'alt' => 'Hotline']) ?></i>
</a>