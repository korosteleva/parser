<?php

header('Content-Type: text/html; charset=utf-8');

/**
 * Created by PhpStorm.
 * User: Tatiana
 * Date: 03.08.2016
 * Time: 22:30
 */

require_once "simple_html_dom.php";

$html = file_get_html($_GET['url']);

$agencyUrlParsed = parse_url($_GET['url']);
$agencyUrl = $agencyUrlParsed['scheme'] . '://' . $agencyUrlParsed['host'];

// Has agency?
$hasAgency = $html->find('div[id=vitrina]');
if (!empty($hasAgency)) {


    foreach ($hasAgency as $agencyInfo) {

        var_dump($agencyInfo->find('#vitrina-title', 0)->plaintext);
        var_dump($agencyUrl . $agencyInfo->find('#vitrina-title img', 0)->src);
    }
} else {
    print('Owner');
}
print('<br/>');
print('<br/>');



print('Photos');
print('<br/>');
$photos = $html->find('.big_photo');
foreach ($photos as $photo) {

    print($agencyUrl . $photo->href);
    print('<br/>');
}
print('<br/>');
print('<br/>');


print('Info');
print('<br/>');
print($html->find('.adv_text', 0)->plaintext);
print('<br/>');

print('Price: ' . $html->find('.price', 0)->plaintext);
print('<br/>');
print('<br/>');

print('Views: <br/>');
$views = $html->find('.views');

foreach ($views as $i => $view) {
    $viewText = trim($view->plaintext);

    if ( preg_match('/^Объявление №(.*)/', $viewText)
        || preg_match('/^Объявление просмотрели(.*)/', $viewText)
        || preg_match('/^Дата(.*)/', $viewText)
    ) {
        print($viewText);
        print('<br/>');
    }


}