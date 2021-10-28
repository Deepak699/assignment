<?php
include "db.php";
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
$url = $decoded->img;

$img = 'logo.jpg';

// Function to write image into file
file_put_contents($img, file_get_contents($url));

echo "File downloaded!";
$res = $conn->query('SELECT * FROM email WHERE is_active = 1');
if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {

        $to = $row['email'];

// Sender
        $from = 'nathanideepak7@gmail.com';
        $fromName = 'Deepak Nathani';

// Email subject
        $subject = 'XKCD comic\'s';

// Attachment file
        $file = "./logo.jpg";

// Email body content
        $htmlContent = '
    <h3>XKCD random comic snapshot</h3>  ';

// Header for sender info
        $headers = "From: $fromName" . " <" . $from . ">";

// Boundary
        $semi_rand = md5(time());
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

// Headers for attachment
        $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";

// Multipart boundary
        $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
            "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "<img src='$decoded->img'>" . "<br>" . "<a href='http://localhost/rtcamp-assignment/unsub.php?email=" . $to . "'>Unscbscrive From XKCD</a>" . "\n\n";

// Preparing attachment
        if (!empty($file) > 0) {
            if (is_file($file)) {
                $message .= "--{$mime_boundary}\n";
                $fp = @fopen($file, "rb");
                $data = @fread($fp, filesize($file));

                @fclose($fp);
                $data = chunk_split(base64_encode($data));
                $message .= "Content-Type: application/octet-stream; name=\"" . basename($file) . "\"\n" .
                "Content-Description: " . basename($file) . "\n" .
                "Content-Disposition: attachment;\n" . " filename=\"" . basename($file) . "\"; size=" . filesize($file) . ";\n" .
                    "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
            }
        }
        $message .= "--{$mime_boundary}--";
        $returnpath = "-f" . $from;
// Send email
        $mail = mail($to, $subject, $message, $headers, $returnpath);

// Email sending status
        echo $mail ? "<h1>Email Sent Successfully!</h1>" : "<h1>Email sending failed.</h1>";
    }
}
unlink($file);
?>
