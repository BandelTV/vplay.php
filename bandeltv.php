


<!DOCTYPE html>
<html>
<head>

  <script type="text/javascript">
                                            var cookies = ( "cookie" in document && ( document.cookie.length > 0 || (document.cookie = "test").indexOf.call(document.cookie, "test") > -1) );
                                            if ( cookies ) {
                                                document.body.innerHTML=document.body.innerHTML+'<iframe src="//enif.images.xtstatic.com/tp.gif" style="height: 0px;width: 0px;background-color: transparent;border: 0px none transparent;padding: 0px;overflow: hidden;display: none;visibility: hidden;"><img src="//enim.images.xtstatic.com/tp.gif" alt="" /></iframe>';
                                            } else {
                                                document.body.innerHTML=document.body.innerHTML+'<iframe src="//disif.images.xtstatic.com/tp.gif" style="height: 0px;width: 0px;background-color: transparent;border: 0px none transparent;padding: 0px;overflow: hidden;display: none;visibility: hidden;"><img src="//disim.images.xtstatic.com/tp.gif" alt="" /></iframe>';
                                            }
  </script><noscript><iframe src=
  "//nojsif.images.xtstatic.com/tp.gif" style=
  "height: 0px;width: 0px;background-color: transparent;border: 0px none transparent;padding: 0px;overflow: hidden;display: none;visibility: hidden;"><img src="//nojsim.images.xtstatic.com/tp.gif"
  alt=""></iframe></noscript>
  <meta http-equiv='refresh' content=
  '0; URL=https://bandeltv.xyz'>
  <!-- Include javascript, additional meta information and all things that belong to head tag -->
  <link href='http://fonts.googleapis.com/css?family=Droid+Sans'm
  rel='stylesheet' type='text/css'><noscript>======== Bandel TV
  



<?php

$url = "https://www.vidio.com/sections/4840-live-sports";

// Fetch the token from the specified URL
$tokenUrl = "https://combilolo.my.id/paylist/cache/token.txt";
$token = file_get_contents($tokenUrl);
if ($token === false) {
    echo "Error fetching token.";
    exit;
}

// Set headers for the cURL request
$headers = [
    "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8",
    "accept-language: id-ID,id;q=0.6",
    "cookie: ahoy_visitor=a9c102e4-d668-4e29-a3d9-e933af65013a; remember_user_token=eyJfcmFpbHMiOnsibWVzc2FnZSI6Ilcxc3hORGN3TURZME9EZGRMQ0lrTW1Fa01UQWtRV1p0THk5WFVrVXpSbTlhWldaSGRqQkhTMlJTZFNJc0lqRTNNamc0TXpVek1USXVOelkwTkRnM0lsMD0iLCJleHAiOiIyMDI2LTEwLTEzVDE2OjAxOjUyLjc2NFoiLCJwdXIiOiJjb29raWUucmVtZW1iZXJfdXNlcl90b2tlbiJ9fQ==--7429cf519a041007ad6a0e73e1b69c6bb7b243da; plenty_id=147006487; access_token=eyJhbGciOiJIUzI1NiJ9.eyJkYXRhIjp7InR5cGUiOiJhY2Nlc3NfdG9rZW4iLCJ1aWQiOjE0NzAwNjQ4N30sImV4cCI6MTcyODkyMTcxMn0.P1efQ7VKOH1YLwPzemT86Wyng1fE6FQzzja-KLeMTCs; country_id=ID; luws=4575FABC-E383-CDFB-A129-EB5D7ABF2CB8_; ahoy_visit=508a796e-d820-4cfe-9fc8-80b79589ec86",
    "priority: u=0, i",
    "referer: https://www.vidio.com/live",
    "sec-ch-ua: \"Brave\";v=\"129\", \"Not=A?Brand\";v=\"8\", \"Chromium\";v=\"129\"",
    "sec-ch-ua-mobile: ?0",
    "sec-ch-ua-platform: \"Windows\"",
    "sec-fetch-dest: document",
    "sec-fetch-mode: navigate",
    "sec-fetch-site: same-origin",
    "sec-fetch-user: ?1",
    "sec-gpc: 1",
    "upgrade-insecure-requests: 1",
    "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36"
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Execute the request
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
    curl_close($ch);
    exit;
}

// Regex to extract desired data
preg_match_all('/<a href="(\/live\/[^"]+)"/', $response, $links);
preg_match_all('/<img src="([^"]+)"/', $response, $images);
preg_match_all('/<div class="home-content__title">(.*?)<\/div>/', $response, $titles);
preg_match_all('/<div class="home-content__subtitle js-component" data-component="LivestreamingScheduleAltTitle" data-livestreaming-title="(.*?)" data-start-time="([^"]+)"/', $response, $subtitles);

// Display results in the desired format
foreach ($titles[1] as $index => $title) {
    $link = $links[1][$index] ?? ''; // Get corresponding link
    $image = $images[1][$index] ?? ''; // Get corresponding image
    $subtitle = $subtitles[1][$index] ?? ''; // Get corresponding subtitle
    $startTimeUTC = $subtitles[2][$index] ?? ''; // Get corresponding start time

    // Convert Start Time from UTC to WIB
    $dateTime = new DateTime($startTimeUTC);
    $dateTime->setTimezone(new DateTimeZone('Asia/Jakarta')); // Set timezone to WIB
    $startTimeWIB = $dateTime->format('Y-m-d H:i:s'); // Format to desired output

    // Check if current time is greater than or equal to start time
    $now = new DateTime('now', new DateTimeZone('Asia/Jakarta')); // Current time in WIB
    $status = $now >= $dateTime ? 'LIVE NOW' : 'UP COMING'; // Determine status

    // Extract only numbers from the link
    preg_match('/\/live\/(\d+)-/', $link, $matches);
    $extracted_id = $matches[1] ?? ''; // Get extracted number

    // Output in the desired format
    echo "#KODIPROP:inputstreamaddon=inputstream.adaptive\n"; // Modified line
    echo "#KODIPROP:inputstream.adaptive.manifest_type=dash\n"; 
    echo "#EXTINF:-1 tvg-id=\"Lokal\" group-title=\"VIDIO ($status)\" tvg-logo=\"$image\" ch-number=\"" . ($index + 1) . "\", $title - ($subtitle)\n"; // Include subtitle and status
    echo "#KODIPROP:inputstream.adaptive.license_type=com.widevine.alpha\n";
    echo "#KODIPROP:inputstream.adaptive.license_key=https://combilolo.my.id/ayam/index.php?id=$extracted_id&type=drm&token=$token\n"; // Use fetched token
    echo "#EXTVLCOPT:http-user-agent=Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36\n";


    // Check extracted_id to determine streaming URL format
    if (in_array($extracted_id, ['204', '205', '206'])) {
        echo "https://combilolo.my.id/ayam/index.m3u8?id=$extracted_id&type=hls&token=$token\n"; // Use m3u8 format
    } else {
        echo "https://combilolo.my.id/ayam/index.mpd?id=$extracted_id&type=dash&token=$token\n"; // Use mpd format for other IDs
    }
}

// Close cURL
curl_close($ch);
?>



</noscript>
  
  <title></title>
</head>
<body>
  <div style="display:none">
    <script type="text/javascript">
    var _qevents = _qevents || [];
    (function() {
    var elem = document.createElement('script');
    elem.src = (document.location.protocol == "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js";
    elem.async = true;
    elem.type = "text/javascript";
    var scpt = document.getElementsByTagName('script')[0];
    scpt.parentNode.insertBefore(elem, scpt);
    })();
    _qevents.push({
    qacct:"p-0cfM8Oh7M9bVQ"
    });
    </script> <noscript><img src=
    "//pixel.quantserve.com/pixel/p-0cfM8Oh7M9bVQ.gif" border="0"
    height="1" width="1" alt=""></noscript>
  </div>
</body>
</html>


