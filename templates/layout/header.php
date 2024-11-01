<div class="header">
    <div class="header-top">
        <div class="wrap-content">
            <p class="info-header"><marquee scrollamount="4"><?= $slogan['name' . $lang] ?></marquee></p>
            <p class="info-header"><i class="fas fa-envelope"></i>Email: <?= $optsetting['email'] ?></p>
            <p class="info-header"><i class="fa-solid fa-phone"></i>Hotline: <?= $func->formatPhone($optsetting['hotline']) ?></p>
            <?php /* <i class="fa-regular fa-location-dot"></i>
            <ul class="social social-header list-unstyled p-0 m-0">
                <?php foreach ($social as $k => $v) { ?>
                    <li class="d-inline-block align-top mr-1">
                        <a href="<?= $v['link'] ?>" target="_blank">
                            <?= $func->getImage(['sizes' => '30x30x2', 'upload' => UPLOAD_PHOTO_L, 'image' => $v['photo'], 'alt' => $v['name' . $lang]]) ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
            */ ?>
            <?php /*
            <div class="lang-header">
                <a href="ngon-ngu/vi/"><?= $func->getImage(['size-error' => '35x25x1', 'upload' => 'assets/images/', 'image' => 'vi.jpg', 'alt' => 'Tiếng Việt']) ?></a>
                <a href="ngon-ngu/en/"><?= $func->getImage(['size-error' => '35x25x1', 'upload' => 'assets/images/', 'image' => 'en.jpg', 'alt' => 'Tiếng Anh']) ?></a>
            </div>
            */ ?>
            <?php /*
            <?php if (array_key_exists($loginMember, $_SESSION) && $_SESSION[$loginMember]['active'] == true) { ?>
                <div class="user-header">
                    <a href="account/thong-tin">
                        <span>Hi, <?= $_SESSION[$loginMember]['username'] ?></span>
                    </a>
                    <a href="account/dang-xuat">
                        <i class="fas fa-sign-out-alt"></i>
                        <span><?= dangxuat ?></span>
                    </a>
                </div>
            <?php } else { ?>
                <div class="user-header">
                    <a href="account/dang-nhap">
                        <i class="fas fa-sign-in-alt"></i>
                        <span><?= dangnhap ?></span>
                    </a>
                    <a href="account/dang-ky">
                        <i class="fas fa-user-plus"></i>
                        <span><?= dangky ?></span>
                    </a>
                </div>
            <?php } ?>
            */ ?>
        </div>
    </div>
    <div class="header-bottom">
        <div class="wrap-content">
            <a class="logo-header" href="">
                <?= $func->getImage(['sizes' => '238x94x1', 'upload' => UPLOAD_PHOTO_L, 'image' => $logo['photo'], 'alt' => $setting['name' . $lang]]) ?>
            </a>   
            <div class="bn">
                <div class="desc-banner text-split"><?=$func->decodeHtmlChars($ten_ct['desc'.$lang])?></div>
                <p class="name-banner text-split"><?=$ten_ct['name'.$lang]?></p>
                <p class="diachi">Địa chỉ: <?= $optsetting['address'] ?></p>
            </div>         
            <a class="hotline-header">
                <div class="left_hd">
                    <img src="assets/images/hd_hl.png">
                </div>
                <div class="right_hd">
                    <p>Hotline tư vấn:</p>
                    <p class="hl1"><?=$func->formatPhone($optsetting['hotline']) ?></p>
                    <p class="hl1"><?=$func->formatPhone($optsetting['hotline2']) ?></p>
                </div>
            </a>
        </div>
    </div>
</div>