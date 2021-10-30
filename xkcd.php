<?php
include __DIR__ . "\db.php";
include __DIR__ . "\sendxkcdmail.php";
$ch = curl_init();
$rand_no = rand(10, 500);
$url = "https://xkcd.com/$rand_no/info.0.json";
$op = '';
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, $url);

$resp = curl_exec($ch);

if ($e = curl_error($ch)) {
    echo $e;
} else {
    $decoded = json_decode($resp);?>
   <img src="<?php echo $decoded->img ?>" alt=""><?php
}

curl_close($ch);
$arr = array();
// $url = $decoded->img;

// $img = 'logo.jpg';

// // Function to write image into file
// file_put_contents($img, file_get_contents($url));

// echo "File downloaded!";
$res = $conn->query('SELECT * FROM email WHERE is_active = 1');
if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        sendXKCD($row['email'], $decoded->img, 'XKCD Comic');
    }
}
?>
