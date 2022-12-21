<?php
$curl = curl_init("https://samples.openweathermap.org/data/2.5/weather?q=London,uk&appid=b6907d289e10d714a6e88b30761fae22");
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($curl);
if ($data === false) {
    var_dump(curl_error($curl));
} else {
    $data = json_decode($data, true);
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
}
curl_close($curl);