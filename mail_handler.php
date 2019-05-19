<?php
    function post_captcha($user_response) {
        $fields_string = '';
        $fields = array(
            'secret' => '6Ld0m00UAAAAAIgNGbYvhrwbz9yGW1C9nS2aRx8k',
            'response' => $user_response
        );
        foreach($fields as $key=>$value)
        $fields_string .= $key . '=' . $value . '&';
        $fields_string = rtrim($fields_string, '&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

    // Call the function post_captcha
    $res = post_captcha($_POST['g-recaptcha-response']);

    if (!$res['success']) {
        // What happens when the CAPTCHA wasn't checked
        echo '<p>Please go back and make sure you check the security CAPTCHA box.</p><br>';
    } else {
        // If CAPTCHA is successfully completed...

        // Paste mail function or whatever else you want to happen here!
        echo '<br><p>CAPTCHA was completed successfully!</p><br>';
        // $to = "katoboylesheffield@gmail.com";
// 		$name = $_POST['Name'];
// 		$email = $_POST['Email'];
// 		$subject = "Website Comment";
// 		$headers = "From:" . $email;
// 		$message = "From: $name\r\nEmail: $email\r\nMessage: " .  $_POST['Message'];
// 		mail($to, $subject, $message, $headers);
// 		header('Location: index.html#contact');
// 			}
?>