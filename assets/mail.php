<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $subject = trim($_POST["subject"]);
    $message = trim($_POST["message"]);


    function mailing($name, $email, $subject, $message)
    {

        if (empty($name) || empty($email) || empty($subject) || empty($message)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Please complete all fields and try again.";
            exit;
        }
        $mail = new PHPMailer();

        // Set the SMTP server details
        $mail->isSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'agsoftware24@hotmail.com';
        $mail->Password = 'talha12345';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Set the sender and recipient
        $mail->setFrom('agsoftware24@hotmail.com', 'Support');
        $mail->addAddress('support@atfinternational.com', 'Support');

        // Set email subject and body

        $htmlBody = "
		<!DOCTYPE html>
		<html>
		<head>
		  	<style>
				table {
					width: 100%;
					border-collapse: collapse;
					margin-bottom: 20px;
				}
				th, td {
					border: 1px solid #ddd;
					padding: 8px;
					text-align: left;
				}
				th {
					background-color: #f2f2f2;
				}
		  	</style>
		</head>
		<body>
		  	<h2>User Feedback</h2>
		  	<table>
				<tr>
					<th>Field</th>
					<th>Value</th>
				</tr>
				<tr>
					<td>Client Name</td>
					<td>$name</td>
				</tr>
				<tr>
					<td>Client Email</td>
					<td>$email</td>
				</tr>
			
				<tr>
					<td>Message</td>
					<td>$message</td>
				</tr>
			
		  	</table>
		</body>
		</html>
		";
        $mail->Subject = $subject;
        $mail->Body = $htmlBody;
        $mail->isHTML(true);

        try {
            $mail->send();
            echo 'Email sent successfully';
        } catch (Exception $e) {
            echo 'Failed to send email. Error: ' . $mail->ErrorInfo;
        }
    }

    mailing($name, $email, $subject, $message);

    //     // Send the email.
    //     if (mail($recipient, $email_subject, $email_content, $email_headers)) {
    //         // Set a 200 (okay) response code.
    //         http_response_code(200);
    //         echo "Thank you! Your message has been sent.";
    //     } else {
    //         // Set a 500 (internal server error) response code.
    //         http_response_code(500);
    //         echo "Oops! Something went wrong and we couldn't send your message.";
    //     }
    // } else {
    //     // Not a POST request, set a 403 (forbidden) response code.
    //     http_response_code(403);
    //     echo "There was a problem with your submission, please try again.";
    // }
}
