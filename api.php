<?php

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://easy-instagramapi.p.rapidapi.com/v1/profile/nasa/media",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"x-rapidapi-host: easy-instagramapi.p.rapidapi.com",
		"x-rapidapi-key: ecbb503c3cmshf3f7418385b31f7p18180fjsne026cee64938"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}