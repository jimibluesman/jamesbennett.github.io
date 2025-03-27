<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name    = strip_tags(trim($_POST["name"]));
  $email   = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
  $subject = strip_tags(trim($_POST["subject"]));
  $message = trim($_POST["message"]);

  // Your email address
  $to = "jamesbennettcorp@gmail.com";
  $email_subject = "New Contact Form Submission: $subject";
  $email_body = "You have received a new message from your website contact form.\n\n" .
                "Name: $name\n" .
                "Email: $email\n" .
                "Subject: $subject\n\n" .
                "Message:\n$message";

  $headers = "From: $name <$email>\r\n";
  $headers .= "Reply-To: $email\r\n";

  if (mail($to, $email_subject, $email_body, $headers)) {
    http_response_code(200);
    echo "Message sent successfully.";
  } else {
    http_response_code(500);
    echo "Oops! Something went wrong, and we couldn't send your message.";
  }
} else {
  http_response_code(403);
  echo "There was a problem with your submission. Please try again.";
}
?>

