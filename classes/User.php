<?php
class User {
    private $conn;
    private $table = "users";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Register a new user (with dynamic role)
    public function register($firstName, $lastName, $email, $password, $role) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL query to insert user details with selected role
        $stmt = $this->conn->prepare("INSERT INTO users (first_name, last_name, email, password, role) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $firstName, $lastName, $email, $hashedPassword, $role);
        
        // Execute and check if the query is successful
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    private function generateOTP() {
        return sprintf("%06d", mt_rand(1, 999999));
    }
    public function registerWithOTP($firstName, $lastName, $email, $password, $role) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $otp = $this->generateOTP();
        $otpExpiry = date('Y-m-d H:i:s', strtotime('+15 minutes')); // OTP valid for 15 minutes
        
        // Begin transaction
        $this->conn->begin_transaction();
        
        try {
            // Prepare SQL query to insert user details with selected role and OTP info
            $stmt = $this->conn->prepare("INSERT INTO users (first_name, last_name, email, password, role, otp_code, otp_expiry, is_verified) VALUES (?, ?, ?, ?, ?, ?, ?, 0)");
            $stmt->bind_param("sssssss", $firstName, $lastName, $email, $hashedPassword, $role, $otp, $otpExpiry);
            
            // Execute query
            $stmt->execute();
            
            // Commit transaction
            $this->conn->commit();
            
            return $otp; // Return the OTP so it can be sent to the user
        } catch (Exception $e) {
            // Rollback transaction on error
            $this->conn->rollback();
            return false;
        }
    }
    
    // Verify the OTP code
    public function verifyOTP($email, $otp) {
        $currentDateTime = date('Y-m-d H:i:s');
        
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ? AND otp_code = ? AND otp_expiry > ? AND is_verified = 0");
        $stmt->bind_param("sss", $email, $otp, $currentDateTime);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // OTP is valid, update user as verified
            $userId = $result->fetch_assoc()['id'];
            $updateStmt = $this->conn->prepare("UPDATE users SET is_verified = 1, otp_code = NULL, otp_expiry = NULL WHERE id = ?");
            $updateStmt->bind_param("i", $userId);
            return $updateStmt->execute();
        }
        
        return false; // Invalid OTP or expired
    }
    
    // Check if email exists but is unverified
    public function getUnverifiedUser($email) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ? AND is_verified = 0");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }
    
    // Resend OTP for existing unverified user
    public function resendOTP($email) {
        $otp = $this->generateOTP();
        $otpExpiry = date('Y-m-d H:i:s', strtotime('+15 minutes'));
        
        $stmt = $this->conn->prepare("UPDATE users SET otp_code = ?, otp_expiry = ? WHERE email = ? AND is_verified = 0");
        $stmt->bind_param("sss", $otp, $otpExpiry, $email);
        
        if ($stmt->execute() && $stmt->affected_rows > 0) {
            return $otp;
        }
        
        return false;
    }

    public function getUserByEmail($email, $checkVerified = true) {
        if ($checkVerified) {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ? AND is_verified = 1");
        } else {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        }
        
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }
    
    public function getAllUsers() {
        $query = "SELECT * FROM users";
        $result = $this->conn->query($query);
    
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    
        return $users;
    }
    public function getAllUsersByRole($role) {
        $query = "SELECT * FROM users WHERE role = ?";
        $stmt = $this->conn->prepare($query);
    
        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }
    
        $stmt->bind_param("s", $role);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    
        return $users;
    }
    
    public function getUserById($userId) {
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateUser($userId, $firstName, $lastName, $email, $role, $gender, $birthdate, $contactNumber, $address) {
        $query = "UPDATE users SET first_name = ?, last_name = ?, email = ?, role = ?, gender = ?, birthdate = ?, contact_number = ?, address = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssssssi", $firstName, $lastName, $email, $role, $gender, $birthdate, $contactNumber, $address, $userId);
        return $stmt->execute();
    }

    public function registerWithContactAndDetails($firstName, $lastName, $email, $password, $role, $contact, $gender, $birthdate, $address) {
        // Hash the password before storing it
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT); // bcrypt hashing

        // Prepare an insert query with the hashed password
        $stmt = $this->conn->prepare("INSERT INTO users (first_name, last_name, email, password, role, contact_number, gender, birthdate, address) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Bind parameters
        $stmt->bind_param("sssssssss", $firstName, $lastName, $email, $hashedPassword, $role, $contact, $gender, $birthdate, $address);

        // Execute the query
        if ($stmt->execute()) {
            return $this->conn->insert_id; // Return the ID of the newly created user
        } else {
            return false; // Registration failed
        }
    }

    public function loginUser($email, $password) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Debugging: Check if we fetched the correct user
            // var_dump($user); // This will show the user data from the DB

            if (password_verify($password, $user['password'])) {
                // Store user info in session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_full_name'] = $user['first_name'] . ' ' . $user['last_name']; // Ensure the fields exist
                $_SESSION['role'] = $user['role'];
                return true;
            }
        }

        return false; // Failed login
    }

    // Password Reset Methods
    
    /**
     * Create password reset token and set expiration
     * @param string $email User's email address
     * @return array|bool Array with token and expiration on success, false on failure
     */
    public function createPasswordResetToken($email) {
        // First verify if the email exists
        $userData = $this->getUserByEmail($email);
        
        if (!$userData) {
            return false; // Email doesn't exist
        }
        
        // Generate a secure random token
        $token = bin2hex(random_bytes(32));
        
        // Set expiry time (1 hour from now)
        $expires = date('Y-m-d H:i:s', strtotime('+7 hours'));
        
        // Add debugging to see the SQL and parameter values
        // error_log("User ID: " . $userData['id'] . ", Token: $token, Expires: $expires");
        
        // Update user with the reset token
        $query = "UPDATE users SET reset_token = ?, reset_token_expires = ? WHERE id = ?";
        
        // Add error handling for the prepare statement
        $stmt = $this->conn->prepare($query);
        
        if ($stmt === false) {
            // Log the SQL error
            error_log("Prepare failed: " . $this->conn->error);
            return false;
        }
        
        // Make sure we're using the correct variable types and order
        $stmt->bind_param("ssi", $token, $expires, $userData['id']);
        
        // Execute the query
        if (!$stmt->execute()) {
            // Log the execution error
            error_log("Execute failed: " . $stmt->error);
            $stmt->close();
            return false;
        }
        
        $stmt->close();
        
        // Return user data with the token
        return [
            'id' => $userData['id'],
            'email' => $userData['email'],
            'token' => $token
        ];
    }
    
    /**
     * Validate a password reset token
     * @param string $token Reset token
     * @return array|bool User data on success, false if invalid/expired
     */
    public function validateResetToken($token) {
        $query = "SELECT id, email FROM users WHERE reset_token = ? AND reset_token_expires > NOW()";
        $stmt = $this->conn->prepare($query);
        
        if ($stmt === false) {
            error_log("Prepare failed in validateResetToken: " . $this->conn->error);
            return false;
        }
        
        $stmt->bind_param("s", $token);
        
        if (!$stmt->execute()) {
            error_log("Execute failed in validateResetToken: " . $stmt->error);
            $stmt->close();
            return false;
        }
        
        $result = $stmt->get_result();
        
        if ($result->num_rows === 0) {
            $stmt->close();
            return false;
        }
        
        $userData = $result->fetch_assoc();
        $stmt->close();
        
        return $userData;
    }
    
    
    /**
     * Reset user's password and clear token
     * @param string $token Reset token
     * @param string $newPassword New password (unhashed)
     * @return bool True on success, false on failure
     */
    public function resetPassword($token, $newPassword) {
        // Validate token first
        $user = $this->validateResetToken($token);
        
        if (!$user) {
            return false;
        }
        
        // Hash the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        
        // Update password and clear reset token
        $query = "UPDATE users SET 
                 password = ?, 
                 reset_token = NULL, 
                 reset_token_expires = NULL 
                 WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $hashedPassword, $user['id']);
        
        return $stmt->execute();
    }
    
    /**
     * Get user by reset token
     * @param string $token Reset token
     * @return array|bool User data or false if not found
     */
    public function getUserByResetToken($token) {
        $query = "SELECT id, email FROM users WHERE reset_token = ?";
        $stmt = $this->conn->prepare($query);
        
        if ($stmt === false) {
            error_log("Prepare failed in getUserByResetToken: " . $this->conn->error);
            return false;
        }
        
        $stmt->bind_param("s", $token);
        
        if (!$stmt->execute()) {
            error_log("Execute failed in getUserByResetToken: " . $stmt->error);
            $stmt->close();
            return false;
        }
        
        $result = $stmt->get_result();
        
        if ($result->num_rows === 0) {
            $stmt->close();
            return false;
        }
        
        $userData = $result->fetch_assoc();
        $stmt->close();
        
        return $userData;
    }
    
    
    /**
     * Check if a user's reset token has expired
     * @param string $token Reset token
     * @return bool True if expired, false if valid
     */
    public function isResetTokenExpired($token) {
        $query = "SELECT id FROM users WHERE reset_token = ? AND reset_token_expires <= NOW()";
        $stmt = $this->conn->prepare($query);
        
        if ($stmt === false) {
            error_log("Prepare failed in isResetTokenExpired: " . $this->conn->error);
            return false;
        }
        
        $stmt->bind_param("s", $token);
        
        if (!$stmt->execute()) {
            error_log("Execute failed in isResetTokenExpired: " . $stmt->error);
            $stmt->close();
            return false;
        }
        
        $result = $stmt->get_result();
        $isExpired = ($result->num_rows > 0);
        $stmt->close();
        
        return $isExpired;
    }

    public function updatePasswordByEmail($email, $hashedPassword) {
        $sql = "UPDATE users SET password = ? WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $hashedPassword, $email);
        return $stmt->execute();
    }
    
    public function clearResetToken($email) {
        $query = "UPDATE users SET reset_token = NULL, reset_token_expires = NULL WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        
        if ($stmt === false) {
            error_log("Prepare failed in clearResetToken: " . $this->conn->error);
            return false;
        }
        
        $stmt->bind_param("s", $email);
        $success = $stmt->execute();
        $stmt->close();
        
        return $success;
    }
    
    
    
}
?>