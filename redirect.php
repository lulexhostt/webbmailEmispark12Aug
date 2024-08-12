<?php
if (isset($_GET['email'])) {
    $email = $_GET['email'];

    // Extract domain name from email address
    $domain = substr(strrchr($email, "@"), 1);

    // Construct the redirect URL
    $redirectURL = "https://" . $domain;

    // Perform the redirect
    header("Location: $redirectURL");
    exit();
}
?>
