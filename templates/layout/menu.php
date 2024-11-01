<div class="menu">
    <div class="wrap-content">
        <ul class="menu-main">
            <li class="flex_dmspp">
             
                    <a class="has-child <?php if ($com == 'san-pham') echo 'active'; ?> transition" href="san-pham" title="Danh mục sản phẩm">Danh mục sản phẩm</a>
                    <?=$func->formenu('product','san-pham');?>
            
                <div class="right_dmsp">
                    <i class="fa-solid fa-bars"></i>
                </div>
            </li>
            <li><a class="<?php if ($com == 'gioi-thieu') echo 'active'; ?> transition" href="gioi-thieu" title="<?= gioithieu ?>"><?= gioithieu ?></a></li>
            <li class="menu-line"></li>
            <li><a class="<?php if ($com == 'chinh-sach-si') echo 'active'; ?> transition" href="chinh-sach-si" title="Chính sách sỉ">Chính sách sỉ</a></li>
            <li class="menu-line"></li>
            <li><a class="<?php if ($com == 'video') echo 'active'; ?> transition" href="video" title="Video">Video</a></li>
            <li class="menu-line"></li>
            <li>
                <a class="has-child <?php if ($com == 'tin-tuc') echo 'active'; ?> transition" href="tin-tuc" title="<?= tintuc ?>"><?= tintuc ?></a>
                <?=$func->formenu('news','tin-tuc');?>
            </li>
            <li class="menu-line"></li>
            <li><a class="<?php if ($com == 'lien-he') echo 'active'; ?> transition" href="lien-he" title="<?= lienhe ?>"><?= lienhe ?></a></li>
            <li class="menu-line"></li>
            <li class="ml-auto">
                <div class="search w-clear">
                    <input type="text" id="keyword" placeholder="Tìm kiếm sản phẩm" onkeypress="doEnter(event,'keyword');" />
                    <p onclick="onSearch('keyword');"><i class="fas fa-search"></i></p>
                    <div style="display: none;" class="keyword-autocomplete"></div>
                </div>
            </li>
        </ul>
    </div>
</div>