<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form fields and remove any potential whitespace
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $subject = trim($_POST["subject"]);
    $message = trim($_POST["message"]);

    // Check that data was sent to the mailer.
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        // Set a 400 (bad request) response code and exit.
        http_response_code(400);
        echo "Please complete all fields and try again.";
        exit;
    }

    // Set the recipient email address.
    // FIXME: Update this to your desired email address.
    $recipient = "agsoftware.developer24@gmail.com";

    // Set the email subject.
    $email_subject = "New contact form submission from $name";

    // Build the email content.
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Subject: $subject\n\n";
    $email_content .= "Message:\n$message\n";

    // Build the email headers.
    $email_headers = "From: $name <$email>";

    // Send the email.
    if (mail($recipient, $email_subject, $email_content, $email_headers)) {
        // Set a 200 (okay) response code.
        http_response_code(200);
        echo "Thank you! Your message has been sent.";
    } else {
        // Set a 500 (internal server error) response code.
        http_response_code(500);
        echo "Oops! Something went wrong and we couldn't send your message.";
    }
} else {
    // Not a POST request, set a 403 (forbidden) response code.
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
?>
