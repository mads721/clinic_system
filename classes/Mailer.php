<?php
// Fixed Mailer.php with SSL certificate verification fix
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Mailer {
    public $mail; // Made public for debugging
    
    public function __construct() {
        // Ensure PHPMailer is included
        require_once $_SERVER['DOCUMENT_ROOT'] . '/web-proto/PHPMailer/src/Exception.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/web-proto/PHPMailer/src/PHPMailer.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/web-proto/PHPMailer/src/SMTP.php';
        
        
        $this->mail = new PHPMailer(true); // true enables exceptions
        
        // Configure mail settings for Gmail
        $this->mail->isSMTP();
        $this->mail->Host       = 'smtp.gmail.com';          // Gmail SMTP server
        $this->mail->SMTPAuth   = true;                      // Enable authentication
        $this->mail->Username   = 'maderickph7777@gmail.com'; // Your Gmail address
        $this->mail->Password   = 'droz whgo qeci gsel';       // Your Gmail app password
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use STARTTLS
        $this->mail->Port       = 587;                       // Standard port for STARTTLS
        
        // FIX: Disable SSL certificate verification
        $this->mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        
        // Set default sender information
        $this->mail->setFrom('maderickph7777@gmail.com', 'E/C Care Dental Clinic');
        $this->mail->isHTML(true);                           // Set email format to HTML
        $this->mail->CharSet = 'UTF-8';
        
        // Add connection timeout (in seconds)
        $this->mail->Timeout = 30;
    }
    
    /**
     * Send an email with improved error handling
     */
    public function sendMail($to, $subject, $message, $attachments = []) {
        try {
            // Reset recipients
            $this->mail->clearAddresses();
            $this->mail->clearAttachments();
            
            // Add recipient
            $this->mail->addAddress($to);
            
            // Set subject & body
            $this->mail->Subject = $subject;
            $this->mail->Body    = $message;
            $this->mail->AltBody = strip_tags($message); // Plain text alternative
            
            // Add attachments if any
            if (!empty($attachments)) {
                foreach ($attachments as $attachment) {
                    if (file_exists($attachment)) {
                        $this->mail->addAttachment($attachment);
                    }
                }
            }
            
            // Send the email
            $result = $this->mail->send();
            
            // Log successful sending
            error_log("Email sent successfully to: {$to}");
            
            return $result;
        } catch (Exception $e) {
            // Detailed error logging
            $errorMessage = "Mail error: " . $this->mail->ErrorInfo;
            error_log($errorMessage);
            
            // Additional SMTP debug info if available
            if (property_exists($this->mail, 'SMTPDebug') && $this->mail->SMTPDebug > 0) {
                error_log("SMTP Debug: " . print_r($this->mail->Debugoutput, true));
            }
            
            // Throw the exception up so it can be caught and handled
            throw new Exception($errorMessage);
        }
    }
    
    /**
     * Test the email configuration with detailed error reporting
     */
    public function testConnection($testEmail) {
        try {
            $subject = "Eld Care System - Email Test";
            $message = "
            <html>
            <body>
                <h2>Eld Care Email System Test</h2>
                <p>This is a test email to verify that your email configuration works correctly.</p>
                <p>If you're seeing this, your PHPMailer configuration is working!</p>
                <p>Time sent: " . date('Y-m-d H:i:s') . "</p>
            </body>
            </html>";
            
            // Enable debug output for the test
            $originalDebugLevel = $this->mail->SMTPDebug;
            $this->mail->SMTPDebug = 2; // Detailed debug output
            
            // Use output buffering to capture debug output
            ob_start();
            $result = $this->sendMail($testEmail, $subject, $message);
            $debugOutput = ob_get_clean();
            
            // Restore original debug level
            $this->mail->SMTPDebug = $originalDebugLevel;
            
            if ($result) {
                return "Test email sent successfully to {$testEmail}";
            } else {
                return "Failed to send test email. Debug output: " . $debugOutput;
            }
        } catch (Exception $e) {
            return "Error testing email: " . $e->getMessage();
        }
    }
    
    /**
     * Check Gmail configuration
     */
    public function checkGmailConfig() {
        $issues = [];
        
        // Check if the app password looks valid (16 characters, no spaces)
        $password = str_replace(' ', '', $this->mail->Password);
        if (strlen($password) !== 16) {
            $issues[] = "App password format may be incorrect. Gmail app passwords are 16 characters.";
        }
        
        // Check if the email address matches the username
        if ($this->mail->Username !== $this->mail->From) {
            $issues[] = "From email ({$this->mail->From}) doesn't match SMTP username ({$this->mail->Username}).";
        }
        
        return $issues;
    }
}
?>