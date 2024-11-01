<?php
if (!defined('SOURCES')) die("Error");

/* Query allpage */
//$cap_1_news = $func->get_cap('noibat','tin-tuc','news_list',100);
$favicon = $cache->get("select photo from #_photo where type = ? and act = ? and find_in_set('hienthi',status) limit 0,1", array('favicon', 'photo_static'), 'fetch', 7200);
$logo = $cache->get("select id, photo, options from #_photo where type = ? and act = ? limit 0,1", array('logo', 'photo_static'), 'fetch', 7200);
$banner = $cache->get("select photo from #_photo where type = ? and act = ? limit 0,1", array('banner', 'photo_static'), 'fetch', 7200);
$slogan = $cache->get("select name$lang from #_static where type = ? limit 0,1", array('slogan'), 'fetch', 7200);
$social = $cache->get("select name$lang, photo, link from #_photo where type = ? and find_in_set('hienthi',status) order by numb,id desc", array('social'), 'result', 7200);
// $splist = $cache->get("select name$lang, slugvi, slugen, id from #_product_list where type = ? and find_in_set('hienthi',status) order by numb,id desc", array('san-pham'), 'result', 7200);
// $ttlist = $cache->get("select name$lang, slugvi, slugen, id from #_news_list where type = ? and find_in_set('hienthi',status) order by numb,id desc", array('tin-tuc'), 'result', 7200);
$footer = $cache->get("select name$lang, content$lang from #_static where type = ? limit 0,1", array('footer'), 'fetch', 7200);
// $tagsProduct = $cache->get("select name$lang, slugvi, slugen, id from #_tags where type = ? and find_in_set('noibat',status) and find_in_set('hienthi',status) order by numb,id desc", array('san-pham'), 'result', 7200);
// $tagsNews = $cache->get("select name$lang, slugvi, slugen, id from #_tags where type = ? and find_in_set('noibat',status) and find_in_set('hienthi',status) order by numb,id desc", array('tin-tuc'), 'result', 7200);
$cssp= $cache->get("select name$lang, slugvi, slugen, desc$lang,  id, photo from #_news where type = ? and find_in_set('hienthi',status) order by numb,id desc limit 0,3", array('chinh-sach-sp'), 'result', 7200);
$ten_ct = $cache->get("select name$lang, desc$lang from #_static where type = ? limit 0,1", array('ten-cong-ty'), 'fetch', 7200);
$bannercssp = $cache->get("select name$lang,id, photo from #_photo where type = ? and find_in_set('hienthi',status) order by numb,id desc ", array('bannercssp'), 'result', 7200);

$policy = $cache->get("select name$lang, slugvi, slugen, id, photo from #_news where type = ? and find_in_set('hienthi',status) order by numb,id desc", array('chinh-sach'), 'result', 7200);
//$chinhanh = $cache->get("select name$lang,id, options from #_news where type = ? and find_in_set('hienthi',status) order by numb,id desc", array('chi-nhanh'), 'result', 7200);
/* Get statistic */
$counter = $statistic->getCounter();
$online = $statistic->getOnline();

/* Newsletter */
if (!empty($_POST['submit-newsletter'])) {
    $responseCaptcha = $_POST['recaptcha_response_newsletter'];
    $resultCaptcha = $func->checkRecaptcha($responseCaptcha);
    $scoreCaptcha = (!empty($resultCaptcha['score'])) ? $resultCaptcha['score'] : 0;
    $actionCaptcha = (!empty($resultCaptcha['action'])) ? $resultCaptcha['action'] : '';
    $testCaptcha = (!empty($resultCaptcha['test'])) ? $resultCaptcha['test'] : false;
    $dataNewsletter = (!empty($_POST['dataNewsletter'])) ? $_POST['dataNewsletter'] : null;

    /* Valid data */
    /*if (empty($dataNewsletter['email'])) {
        $flash->set('error', 'Email không được trống');
    }

    if (!empty($dataNewsletter['email']) && !$func->isEmail($dataNewsletter['email'])) {
        $flash->set('error', 'Email không hợp lệ');
    }

    $error = $flash->get('error');
    
    if (!empty($error)) {
        $func->transfer($error, $configBase, false);
    }*/

    /* Save data */
    if (($scoreCaptcha >= 0.5 && $actionCaptcha == 'Newsletter') || $testCaptcha == true) {
        $data = array();
        $data['email'] = htmlspecialchars($dataNewsletter['email']);
        /*$data['fullname'] = htmlspecialchars($dataNewsletter['fullname']);
        $data['phone'] = htmlspecialchars($dataNewsletter['phone']);
        $data['address'] = htmlspecialchars($dataNewsletter['address']);
        $data['content'] = htmlspecialchars($dataNewsletter['content']);*/
        $data['date_created'] = time();
        $data['type'] = 'dangkynhantin';

        if ($d->insert('newsletter', $data)) {
            $func->transfer("Đăng ký nhận tin thành công. Chúng tôi sẽ liên hệ với bạn sớm.", $configBase);
        } else {
            $func->transfer("Đăng ký nhận tin thất bại. Vui lòng thử lại sau.", $configBase, false);
        }
    } else {
        $func->transfer("Đăng ký nhận tin thất bại. Vui lòng thử lại sau.", $configBase, false);
    }
}
