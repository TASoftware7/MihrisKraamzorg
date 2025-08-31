<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

// Get form data - prefer POST data over JSON
$input = $_POST;

// If no POST data, try to get JSON data
if (empty($input)) {
    $json_input = file_get_contents('php://input');
    if ($json_input) {
        $input = json_decode($json_input, true);
    }
}

// Log what we received for debugging
error_log("Form data received: " . print_r($input, true));

// Validate required fields
$required_fields = ['naam', 'email', 'telefoon', 'due_date'];
$missing_fields = [];

foreach ($required_fields as $field) {
    if (empty($input[$field])) {
        $missing_fields[] = $field;
    }
}

if (!empty($missing_fields)) {
    error_log("Missing required fields: " . implode(', ', $missing_fields));
    http_response_code(400);
    echo json_encode(['error' => 'Missing required fields: ' . implode(', ', $missing_fields)]);
    exit;
}

// Validate email format
if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid email format']);
    exit;
}

// Prepare email content
$to = 'mihriskraamzorg@hotmail.com';
$subject = 'Nieuwe aanmelding kraamzorg via website';

$message = "Nieuwe aanmelding ontvangen via de website:\n\n";
$message .= "👤 Persoonlijke gegevens:\n";
$message .= "Naam: " . htmlspecialchars($input['naam']) . "\n";
$message .= "Email: " . htmlspecialchars($input['email']) . "\n";
$message .= "Telefoon: " . htmlspecialchars($input['telefoon']) . "\n";
$message .= "Uitgerekende datum: " . htmlspecialchars($input['due_date']) . "\n\n";

$message .= "🏥 Verzekering & Locatie:\n";
$message .= "Zorgverzekeraar: " . htmlspecialchars($input['zorgverzekeraar'] ?? 'Niet opgegeven') . "\n";
$message .= "Woonplaats: " . htmlspecialchars($input['plaats'] ?? 'Niet opgegeven') . "\n";
$message .= "BSN: " . htmlspecialchars($input['bsn'] ?? 'Niet opgegeven') . "\n";
$message .= "Polisnummer: " . htmlspecialchars($input['polisnummer'] ?? 'Niet opgegeven') . "\n\n";

if (!empty($input['bericht'])) {
    $message .= "💬 Toelichting:\n";
    $message .= htmlspecialchars($input['bericht']) . "\n\n";
}

$message .= "📅 Aanmelding ontvangen op: " . date('d-m-Y H:i:s') . "\n";
$message .= "🌐 Verzonden via: " . $_SERVER['HTTP_HOST'] . "\n";

// Email headers
$headers = [
    'From: Mihri\'s Kraamzorg <noreply@' . $_SERVER['HTTP_HOST'] . '>',
    'Reply-To: ' . $input['email'],
    'Content-Type: text/plain; charset=UTF-8',
    'X-Mailer: PHP/' . phpversion(),
    'MIME-Version: 1.0'
];

// Send email
$mail_sent = mail($to, $subject, $message, implode("\r\n", $headers));

// Log the attempt with more details
error_log("Email send attempt to $to: " . ($mail_sent ? 'SUCCESS' : 'FAILED'));
error_log("Email subject: $subject");
error_log("Email message length: " . strlen($message));
error_log("Server: " . $_SERVER['HTTP_HOST']);
error_log("PHP mail function available: " . (function_exists('mail') ? 'YES' : 'NO'));

if ($mail_sent) {
    // Also send confirmation email to user
    $user_subject = 'Bevestiging aanmelding kraamzorg';
    $user_message = "Beste " . htmlspecialchars($input['naam']) . ",\n\n";
    $user_message .= "Bedankt voor je aanmelding bij Mihri's Kraamzorg!\n\n";
    $user_message .= "We hebben je aanmelding ontvangen en nemen binnen 1 werkdag contact met je op.\n\n";
    $user_message .= "Met vriendelijke groet,\n";
    $user_message .= "Mihri's Kraamzorg\n";
    $user_message .= "mihriskraamzorg@hotmail.com\n";
    $user_message .= "06-12345678";
    
    $user_headers = [
        'From: Mihri\'s Kraamzorg <noreply@' . $_SERVER['HTTP_HOST'] . '>',
        'Reply-To: mihriskraamzorg@hotmail.com',
        'Content-Type: text/plain; charset=UTF-8',
        'X-Mailer: PHP/' . phpversion(),
        'MIME-Version: 1.0'
    ];
    
    $user_mail_sent = mail($input['email'], $user_subject, $user_message, implode("\r\n", $user_headers));
    error_log("User confirmation email to {$input['email']}: " . ($user_mail_sent ? 'SUCCESS' : 'FAILED'));
    
    echo json_encode([
        'success' => true,
        'message' => 'Aanmelding succesvol verzonden! We nemen binnen 1 werkdag contact met je op.'
    ]);
} else {
    error_log("Failed to send email to $to");
    http_response_code(500);
    echo json_encode(['error' => 'Failed to send email. Please try again or contact us directly.']);
}
?>
