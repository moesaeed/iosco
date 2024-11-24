<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// Retrieve form data from POST request
	$name = $_POST['name'] ?? '';
	$email = $_POST['email'] ?? '';
	$phone = $_POST['phone'] ?? '';
	$subject = $_POST['subject'] ?? '';
	$message = $_POST['message'] ?? '';
	$captcha = $_POST['captcha'] ?? '';

	// Prepare the data to send in JSON format
	$postData = json_encode([
		'name' => $name,
		'email' => $email,
		'phone' => $phone,
		'subject' => $subject,
		'message' => $message,
		'captcha' => $captcha,
	]);

	// Initialize cURL for the POST request
	$ch = curl_init('https://iosco.sitefinityapps.com//apicustom/Contact/Contact');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, [
		'Content-Type: application/json',
		'Content-Length: ' . strlen($postData),
	]);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

	// Execute the POST request
	$response = curl_exec($ch);
	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);

	echo $response;

} else {
	echo "Invalid request method";
}
