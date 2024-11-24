<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data from POST request
    $email = $_POST['email'] ?? '';
    $firstName = $_POST['firstName'] ?? '';
    $lastName = $_POST['lastName'] ?? '';
    $captcha = $_POST['captcha'] ?? '';

    // Prepare the data to send in JSON format
    $postData = json_encode([
        'email' => $email,
        'firstName' => $firstName,
        'lastName' => $lastName,
        'captcha' => $captcha,
    ]);

    // Initialize cURL for the POST request
    $ch = curl_init('https://iosco.sitefinityapps.com/apicustom/PreRegister/PreRegister');
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
