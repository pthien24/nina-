<div class="grid-pro-detail w-clear">
    <div class="flex_sanphammm">
        <div class="left-pro-detail ">
            <?php if(CARTSITEADVANCE==true){ // giỏ hàng nâng cao?>
            
                <div class="productTop1_fotorama">
                    <div class="fotorama"
                        data-width="740"
                        data-maxwidth="100%"
                        data-allowfullscreen="true"
                        data-nav="thumbs">
                        <img id="Zoom-1" src="<?=THUMBS?>/740x740x1/<?=UPLOAD_PRODUCT_L.$rowDetail['photo']?>">
                        <?php foreach ($rowDetailPhoto as $key => $value) { ?>
                        <img src="<?=THUMBS?>/740x740x1/<?=UPLOAD_PRODUCT_L.$value['photo']?>">
                        <?php } ?>
                    </div>
                </div>           
            
            <?php }else{ ?>
                <a id="Zoom-1" class="MagicZoom" data-options="zoomMode: on; hint: off; rightClick: true; selectorTrigger: hover; expandCaption: false; history: false;" href="<?= ASSET . THUMBS ?>/540x540x2/<?= UPLOAD_PRODUCT_L . $rowDetail['photo'] ?>" title="<?= $rowDetail['name' . $lang] ?>">
                    <?= $func->getImage(['isLazy' => false, 'sizes' => '540x540x2', 'isWatermark' => WATERMARKPRODUCT, 'prefix' => 'product', 'upload' => UPLOAD_PRODUCT_L, 'image' => $rowDetail['photo'], 'alt' => $rowDetail['name' . $lang]]) ?>
                </a>
                <?php if ($rowDetailPhoto) {
                    if (count($rowDetailPhoto) > 0) { ?>
                        <div class="gallery-thumb-pro">
                            <div class="owl-page owl-carousel owl-theme owl-pro-detail" data-items="screen:0|items:5|margin:10" data-nav="1" data-navcontainer=".control-pro-detail">
                                <div>
                                    <a class="thumb-pro-detail" data-zoom-id="Zoom-1" href="<?= ASSET . THUMBS ?>/540x540x2/<?= UPLOAD_PRODUCT_L . $rowDetail['photo'] ?>" title="<?= $rowDetail['name' . $lang] ?>">
                                        <?= $func->getImage(['isLazy' => false, 'sizes' => '540x540x2', 'isWatermark' => WATERMARKPRODUCT, 'prefix' => 'product', 'upload' => UPLOAD_PRODUCT_L, 'image' => $rowDetail['photo'], 'alt' => $rowDetail['name' . $lang]]) ?>
                                    </a>
                                </div>
                                <?php foreach ($rowDetailPhoto as $v) { ?>
                                    <div>
                                        <a class="thumb-pro-detail" data-zoom-id="Zoom-1" href="<?= ASSET . THUMBS ?>/540x540x2/<?= UPLOAD_PRODUCT_L . $v['photo'] ?>" title="<?= $rowDetail['name' . $lang] ?>">
                                            <?= $func->getImage(['isLazy' => false, 'sizes' => '540x540x2', 'isWatermark' => WATERMARKPRODUCT, 'prefix' => 'product', 'upload' => UPLOAD_PRODUCT_L, 'image' => $v['photo'], 'alt' => $rowDetail['name' . $lang]]) ?>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="control-pro-detail control-owl transition"></div>
                        </div>
                <?php }
                } ?>
        <?php } ?>
        </div>
        <div class="right-pro-detail ">
            <p class="title-pro-detail mb-2"><?= $rowDetail['name' . $lang] ?></p>
            <?php /*
            <div class="comment-pro-detail mb-3">
                <div class="comment-star mb-0 mr-2">
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                    <span style="width: <?= $comment->avgStar() ?>%">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </span>
                </div>
                <div class="comment-count"><a>(<?= $comment->total ?> nhận xét)</a></div>
            </div>
            */ ?>
           
            <div class="desc-pro-detail"><?= nl2br($func->decodeHtmlChars($rowDetail['desc' . $lang])) ?></div>
            <div class="flex_sl_gia">
                <div class="left_sl_gia">
                    <li class="w-clear1">
                        <label class="attr-label-pro-detail"><?= gia ?>:</label>
                        <div class="attr-content-pro-detail">
                            <?php if ($rowDetail['sale_price']) { ?>
                                <span class="price-new-pro-detail"><?= $func->formatMoney($rowDetail['sale_price']) ?></span>
                                <span class="price-old-pro-detail"><?= $func->formatMoney($rowDetail['regular_price']) ?></span>
                            <?php } else { ?>
                                <span class="price-new-pro-detail"><?= ($rowDetail['regular_price']) ? $func->formatMoney($rowDetail['regular_price']) : lienhe ?></span>
                            <?php } ?>
                        </div>
                    </li>
                </div>
               <div class="right_sl_gia">
                <?php if(CARTSITE==true){ ?>
                        <li class="w-clear2">
                            <label class="attr-label-pro-detail d-block"><?= soluong ?>:</label>
                            <div class="attr-content-pro-detail d-block">
                                <div class="quantity-pro-detail">
                                    <span class="quantity-minus-pro-detail">-</span>
                                    <input type="number" class="qty-pro" min="1" value="1" readonly />
                                    <span class="quantity-plus-pro-detail">+</span>
                                </div>
                            </div>
                        </li>                    
                    <?php } ?>
               </div>
            </div>
            <ul class="attr-pro-detail">
                <?php if (!empty($rowDetail['code'])) { ?>
                    <li class="w-clear">
                        <label class="attr-label-pro-detail"><?= masp ?>:</label>
                        <div class="attr-content-pro-detail"><?= $rowDetail['code'] ?></div>
                    </li>
                <?php } ?>
                <?php if (!empty($productBrand['id'])) { ?>
                    <li class="w-clear">
                        <label class="attr-label-pro-detail"><?= thuonghieu ?>:</label>
                        <div class="attr-content-pro-detail"><a class="text-decoration-none" href="<?= $productBrand[$sluglang] ?>" title="<?= $productBrand['name' . $lang] ?>"><?= $productBrand['name' . $lang] ?></a></div>
                    </li>
                <?php } ?>

                


                <?php 
                if(CARTSITE==true){ 
                    if(CARTSITEADVANCE==true){ // giỏ hàng nâng cao?>
               
                    <?php if(($rowSize)) { ?>
                        <p class="pro_guarantee__label proprice_item_label f-title mb-0">Size: </p>
                        <div class="proprice_group">
                            <?php foreach ($rowSize as $k => $v) {
                                $productSize = $d->rawQuery("select id_parent, size, price_new from table_variants1 where id_parent = ? and size = ? order by price_new asc, price_old asc", array($rowDetail['id'], $v['id']));
                                $gia_min = 0;
                                foreach ($productSize as $key => $value) {
                                    if($value['price_new'] > 0) {
                                        $gia_min = $value['price_new'];
                                        break;
                                    }
                                    else {
                                        $gia_min = 0;
                                    }
                                }
                            ?>
                            <div class="proprice_item proprice_item_size" data-id="<?=$v['id']?>" data-tab="<?=$k?>" data-min_price="<?=($gia_min>0) ? number_format($gia_min) : 0?>">
                                <a class="transition proprice_action">
                                    <span><?=$v['name'.$lang]?></span>
                                </a>
                            </div>
                            <?php } ?>
                        </div>
                        <?php } ?>

                        <?php /* if(($rowColor)){ ?>
                        <p class="pro_guarantee__label proprice_item_label f-title mb-0">Màu sắc:</p>
                        <div class="prod_details_color">
                            <?php foreach ($rowColor as $k => $v) {
                                $productColor = $d->rawQuery("select id_parent, color, photo from table_variants where id_parent = ? and color = ?", array($rowDetail['id'], $v['id']));
                            ?>
                                <div class="align-items-center">
                                    <?php foreach ($productColor as $key2 => $value2) {
                                        $color_name = $d->rawQueryOne("select namevi, id, color from table_color where id = ?", array($value2['color']));
                                        $variants_check = $d->rawQueryOne("select id from table_product_sale where id_parent = ? and id_color = ? limit 1",array($rowDetail['id'],$value2['color']));
                                        /*if(!$variants_check['id'] or $variants_check['id']=='' or $variants_check['id']==0) continue;
                                    ?>
                                    <div class="proprice_item_color proprice_item1" 
                                        data-photo="<?=$value2['photo']?>" 
                                        data-img="<?=THUMBS?>/740x740x1/<?=UPLOAD_PRODUCT_L.$value2['photo']?>" 
                                        data-id="<?=$value2['color']?>" data-id_prod="<?=$rowDetail['id']?>">
                                        <span class="sty_color d-block" style="background: #<?=$color_name['color']?>;"></span>
                                    </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                        <?php } */?>
                        
                        
                <?php 

                    }else{ 
                        // gio hang co ban 
                        //Dành cho giỏ hàng size - color không đổi giá 
                    ?>               
                   <?php /* <li class="color-block-pro-detail w-clear">
                        <label class="attr-label-pro-detail d-block"><?= mausac ?>:</label>
                        <div class="attr-content-pro-detail d-block">
                            <?php foreach ($rowColor as $k => $v) { ?>
                                <?php if ($v['type_show'] == 1) { ?>
                                    <label for="color-pro-detail-<?= $v['id'] ?>" class="color-pro-detail text-decoration-none" data-idproduct="<?= $rowDetail['id'] ?>" style="background-image: url(<?= UPLOAD_COLOR_L . $v['photo'] ?>)">
                                        <input type="radio" value="<?= $v['id'] ?>" id="color-pro-detail-<?= $v['id'] ?>" name="color-pro-detail">
                                    </label>
                                <?php } else { ?>
                                    <label for="color-pro-detail-<?= $v['id'] ?>" class="color-pro-detail text-decoration-none" data-idproduct="<?= $rowDetail['id'] ?>" style="background-color: #<?= $v['color'] ?>">
                                        <input type="radio" value="<?= $v['id'] ?>" id="color-pro-detail-<?= $v['id'] ?>" name="color-pro-detail">
                                    </label>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </li>
                    
                    <li class="size-block-pro-detail w-clear">
                        <label class="attr-label-pro-detail d-block"><?= kichthuoc ?>:</label>
                        <div class="attr-content-pro-detail d-block">
                            <?php foreach ($rowSize as $k => $v) { ?>
                                <label for="size-pro-detail-<?= $v['id'] ?>" class="size-pro-detail text-decoration-none">
                                    <input type="radio" value="<?= $v['id'] ?>" id="size-pro-detail-<?= $v['id'] ?>" name="size-pro-detail">
                                    <?= $v['name' . $lang] ?>
                                </label>
                            <?php } ?>
                        </div>
                    </li>
                    */ ?>
                    
                <?php } //*/ ?>
                <?php } //*/ ?>

                
                <li class="w-clear">
                    <label class="attr-label-pro-detail"><?= luotxem ?>:</label>
                    <div class="attr-content-pro-detail"><?= $rowDetail['view'] ?></div>
                </li>
            </ul>
            <?php if(CARTSITE==true){ ?>
                <div class="cart-pro-detail">
                    <a class="btn btn-success addcart rounded-0 mr-2" data-id="<?=$rowDetail['id'] ?>" data-action="addnow">
                        <i class="fas fa-shopping-bag mr-1"></i>
                        <span>Thêm vào giỏ hàng</span>
                    </a>
                    <a class="btn btn-dark addcart rounded-0" data-id="<?=$rowDetail['id'] ?>" data-action="buynow">
                        <i class="fas fa-shopping-bag mr-1"></i>
                        <span>Mua ngay</span>
                    </a>
                </div>
            <?php } ?>
            <div class="detail_phonee">
                <a class="detail_hl1" href="tel:<?= preg_replace('/[^0-9]/', '', $optsetting['hotline']); ?>"><?=$func->formatPhone($optsetting['hotline']) ?></a>
                <a class="detail_hl1" href="tel:<?= preg_replace('/[^0-9]/', '', $optsetting['hotline2']); ?>"><?=$func->formatPhone($optsetting['hotline2']) ?></a>
            </div>
            <div class="social-plugin social-plugin-pro-detail w-clear">
                <?php
                $params = array();
                $params['oaid'] = $optsetting['oaidzalo'];
                echo $func->markdown('social/share', $params);
                ?>
            </div>
            
        </div>
        <div class="next_cssp1">
            <?php if(count($bannercssp) ) { ?>
                <div class="bannercssp">
                    <p class="pic-bennercssp"><img onerror="this.src='<?=THUMBS?>/380x66x1/assets/images/noimage.png';" src="<?=THUMBS?>/380x66x1/<?=UPLOAD_PHOTO_L.$bannercssp[0]['photo']?>" alt="<?=$bannercssp[0]['name'.$lang]?>" width="380" height="66"></p>
                </div>
            <?php } ?>
            <div class="next_cssp">
                <div class="title_cssp">Chính sách sản phẩm</div>
                <div class="cssp">
                    <?php foreach($cssp as $k => $v) { ?> 
                        <div class="flex_cssp">
                            <div class="left_cssp">
                                <p class="pic-cssp scale-img"><img onerror="this.src='<?=THUMBS?>/80x80x2/assets/images/noimage.png';" src="<?=THUMBS?>/80x80x2/<?=UPLOAD_NEWS_L.$v['photo']?>" alt="<?=$v['name'.$lang]?>" width="80" height="80"></p>
                            </div>
                            <div class="right_cssp">
                                <p class="name-cssp text-split"><?=$v['name'.$lang]?></p>
                                <p class="desc-cssp text-split"><?=$v['desc'.$lang]?></p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            
        </div>
    </div>
    <?php /*
    <div class="tags-pro-detail w-clear">
        <?php if (!empty($rowTags)) {
            foreach ($rowTags as $v) { ?>
                <a class="btn btn-sm btn-danger rounded" href="<?= $v[$sluglang] ?>" title="<?= $v['name' . $lang] ?>"><i class="fas fa-tags"></i><?= $v['name' . $lang] ?></a>
        <?php }
        } ?>
    </div>
    */ ?>
    <div class="tabs-pro-detail">
        <ul class="nav nav-tabs" id="tabsProDetail" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="info-pro-detail-tab" data-toggle="tab" href="#info-pro-detail" role="tab"><?= thongtinsanpham ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="commentfb-pro-detail-tab" data-toggle="tab" href="#commentfb-pro-detail" role="tab"><?= binhluan ?></a>
            </li>
        </ul>
        <div class="tab-content pt-4 pb-4" id="tabsProDetailContent">
            <div class="tab-pane fade show autoHeight active" id="info-pro-detail" role="tabpanel">
                <?php /*
                <div class="meta-toc">
                    <div class="box-readmore">
                        <ul class="toc-list" data-toc="article" data-toc-headings="h1, h2, h3"></ul>
                    </div>
                </div>
                */ ?>
                <div class="autoHeight w-clear" id="toc-content"><?= $func->decodeHtmlChars($rowDetail['content' . $lang]) ?></div>
            </div>
            <div class="tab-pane fade" id="commentfb-pro-detail" role="tabpanel">
                <div class="fb-comments" data-href="<?= $func->getCurrentPageURL() ?>" data-numposts="3" data-colorscheme="light" data-width="100%"></div>
            </div>
        </div>
    </div>
    <?php //include TEMPLATE . "product/comment.php"; ?>
</div>
<div class="title-main"><span><?= sanphamcungloai ?></span></div>
<div class="content-main w-clear">
    <?php if (!empty($product)) {
        echo $func->GetProducts($product, 'boxProduct');
    } else { ?>
        <div class="col-12">
            <div class="alert alert-warning w-100" role="alert">
                <strong><?= khongtimthayketqua ?></strong>
            </div>
        </div>
    <?php } ?>
    <div class="clear"></div>
    <div class="col-12">
        <div class="pagination-home w-100"><?= (!empty($paging)) ? $paging : '' ?></div>
    </div>
</div>
<?php if($recently_viewed) { ?>
<div class="title-main"><span><?= sanphamdaxem ?></span></div>
<div class="content-main w-clear">
    <?php if (!empty($product)) {
        echo $func->GetProducts($recently_viewed, 'boxProduct');
    } else { ?>
        <div class="col-12">
            <div class="alert alert-warning w-100" role="alert">
                <strong><?= khongtimthayketqua ?></strong>
            </div>
        </div>
    <?php } ?>
    <div class="clear"></div>
</div>
<?php } ?>