<?php
// Test email functionality
header('Content-Type: text/html; charset=UTF-8');

echo "<h1>Email Test Pagina</h1>";

// Check if mail function exists
if (function_exists('mail')) {
    echo "<p>✅ PHP mail() functie is beschikbaar</p>";
} else {
    echo "<p>❌ PHP mail() functie is NIET beschikbaar</p>";
}

// Check server info
echo "<h2>Server Informatie</h2>";
echo "<p><strong>Server:</strong> " . $_SERVER['HTTP_HOST'] . "</p>";
echo "<p><strong>PHP Versie:</strong> " . phpversion() . "</p>";
echo "<p><strong>Server Software:</strong> " . $_SERVER['SERVER_SOFTWARE'] . "</p>";

// Check if we can send a test email
echo "<h2>Test Email Verzenden</h2>";

$to = 'mihriskraamzorg@hotmail.com';
$subject = 'Test email van website';
$message = "Dit is een test email om te controleren of de mail functie werkt.\n\n";
$message .= "Tijd: " . date('d-m-Y H:i:s') . "\n";
$message .= "Server: " . $_SERVER['HTTP_HOST'] . "\n";

$headers = [
    'From: test@' . $_SERVER['HTTP_HOST'],
    'Content-Type: text/plain; charset=UTF-8',
    'X-Mailer: PHP/' . phpversion()
];

$test_mail_sent = mail($to, $subject, $message, implode("\r\n", $headers));

if ($test_mail_sent) {
    echo "<p>✅ Test email succesvol verzonden naar $to</p>";
} else {
    echo "<p>❌ Test email kon niet worden verzonden</p>";
    echo "<p>Controleer de server logs voor meer details</p>";
}

// Check error logs
echo "<h2>Error Log Informatie</h2>";
$error_log = ini_get('error_log');
if ($error_log) {
    echo "<p><strong>Error log locatie:</strong> $error_log</p>";
} else {
    echo "<p><strong>Error log:</strong> Niet geconfigureerd</p>";
}

// Check if we can write to logs
if (is_writable($error_log)) {
    echo "<p>✅ Error log is schrijfbaar</p>";
} else {
    echo "<p>❌ Error log is NIET schrijfbaar</p>";
}

echo "<hr>";
echo "<p><a href='index.html'>Terug naar het formulier</a></p>";
?>

