<?php
function sendXKCD($to, $img, $title)
{

    if (!empty($_SERVER['HTTP_HOST']) && !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
        $protocol = 'https';
    } else {
        $protocol = 'http';
    }

    $url = 'https://api.sendgrid.com/';
    $sendgrid_apikey = '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';
    $filename = 'image.png';
    $filePath = $img;
    $body = "<img src='" . $img . "'> <br> <a href='" . $protocol . "://" . $_SERVER['HTTP_HOST'] . "/rtcamp-assignment/unsub.php?email=" . $to . "'>Click Here to Unsub</a>";
    $params = array(
        'to' => $to,
        'toname' => 'sup',
        'subject' => 'XKCD Random comic',
        'html' => $body,
        'from' => 'hadeskerbecs455@gmail.com',
        'fromname' => 'XKCD',
        'files[' . $filename . ']' => file_get_contents($filePath),
        'type' => 'image/png',
    );

    $req = $url . 'api/mail.send.json';
    $session = curl_init($req);
    curl_setopt($session, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $sendgrid_apikey));
    curl_setopt($session, CURLOPT_POST, true);
    curl_setopt($session, CURLOPT_POSTFIELDS, $params);
    curl_setopt($session, CURLOPT_HEADER, false);
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($session);
    curl_close($session);
    print_r($res);
}
