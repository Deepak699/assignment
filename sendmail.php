<?php
function sendmail($to, $sendbody)
{

    $url = 'https://api.sendgrid.com/';
    $sendgrid_apikey = getenv('SEND_GRID_API');
    $body = $sendbody;
    $params = array(
        'to' => $to,
        'toname' => 'sup',
        'subject' => 'XKCD Random comic',
        'html' => $body,
        'from' => getenv('FROM'),
        'fromname' => 'XKCD',
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
