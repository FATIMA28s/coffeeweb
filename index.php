<?php
// Start the session at the very beginning of the file. This is crucial for keeping a user logged in.
session_start();

// Set up error reporting for development. In a production environment, you should log errors instead.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// --- DATABASE CONNECTION ---
// IMPORTANT: Replace these with your actual database credentials.
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "cafe_users";

// Create a new MySQLi connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors and terminate the script if an error occurs
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// IMPORTANT DATABASE NOTE:
// For this code to work, you must add the new columns to your 'users' table in the 'cafe_users' database.
// You can use the following SQL command in your database tool (like phpMyAdmin):
// ALTER TABLE users ADD first_name VARCHAR(255), ADD last_name VARCHAR(255), ADD phone_number VARCHAR(255), ADD address TEXT;


// --- MESSAGE HANDLING ---
// A simple variable to hold success or error messages
$message = '';
$message_type = ''; // 'success' or 'error'

// --- SANITIZE INPUT ---
function sanitizeInput($data) {
    // Remove whitespace from both sides of the string
    $data = trim($data);
    // Remove backslashes
    $data = stripslashes($data);
    // Convert special characters to HTML entities
    $data = htmlspecialchars($data);
    return $data;
}

// --- LOGOUT LOGIC ---
if (isset($_GET['logout'])) {
    // Unset all session variables
    $_SESSION = array();
    // Destroy the session
    session_destroy();
    // Redirect to the login page
    header("Location: " . basename($_SERVER['PHP_SELF']));
    exit;
}

// --- SIGNUP LOGIC ---
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    // Sanitize user inputs to prevent XSS attacks
    $first_name = sanitizeInput($_POST['signup-first-name']);
    $last_name = sanitizeInput($_POST['signup-last-name']);
    $email = sanitizeInput($_POST['signup-email']);
    $phone_number = sanitizeInput($_POST['signup-phone-number']);
    $password = sanitizeInput($_POST['signup-password']);
    $confirm_password = sanitizeInput($_POST['signup-confirm-password']);

    // Validate inputs
    if (empty($first_name) || empty($last_name) || empty($email) || empty($phone_number) || empty($password) || empty($confirm_password)) {
        $message = "Please fill in all fields.";
        $message_type = "error";
    } else if ($password !== $confirm_password) {
        $message = "Passwords do not match.";
        $message_type = "error";
    } else {
        // Hash the password for security before storing it in the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare a SQL statement to check if the email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        // Check if an existing user was found
        if ($stmt->num_rows > 0) {
            $message = "This email is already registered.";
            $message_type = "error";
        } else {
            // Prepare an SQL statement to insert the new user
            $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, phone_number, password) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $first_name, $last_name, $email, $phone_number, $hashed_password);

            // Execute the statement and check for success
            if ($stmt->execute()) {
                $message = "Signup successful! You can now log in.";
                $message_type = "success";
            } else {
                $message = "Error: " . $stmt->error;
                $message_type = "error";
            }
        }
        $stmt->close();
    }
}

// --- LOGIN LOGIC ---
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    // Sanitize user inputs
    $email = sanitizeInput($_POST['login-email']);
    $password = sanitizeInput($_POST['login-password']);

    // Prepare a SQL statement to retrieve the user by email
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($user_id, $hashed_password_from_db);
    $stmt->fetch();

    // Check if a user was found
    if ($stmt->num_rows > 0) {
        // Verify the provided password against the hashed password from the database
        if (password_verify($password, $hashed_password_from_db)) {
            $message = "Login successful! Welcome back.";
            $message_type = "success";
            // Start a session and store the user's ID
            $_SESSION['user_id'] = $user_id;
        } else {
            $message = "Invalid password.";
            $message_type = "error";
        }
    } else {
        $message = "No account found with that email.";
        $message_type = "error";
    }
    $stmt->close();
}

// --- MY ACCOUNT UPDATE LOGIC ---
$user_data = null;
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Handle form submission for updating user data
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_account'])) {
        $first_name = sanitizeInput($_POST['first_name']);
        $last_name = sanitizeInput($_POST['last_name']);
        $phone_number = sanitizeInput($_POST['phone_number']);
        $address = sanitizeInput($_POST['address']);

        // Prepare and execute the update statement
        $stmt = $conn->prepare("UPDATE users SET first_name = ?, last_name = ?, phone_number = ?, address = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $first_name, $last_name, $phone_number, $address, $user_id);
        
        if ($stmt->execute()) {
            $message = "Account details updated successfully!";
            $message_type = "success";
        } else {
            $message = "Error updating account details: " . $stmt->error;
            $message_type = "error";
        }
        $stmt->close();
    }

    // Fetch the user's current data to populate the form
    $stmt = $conn->prepare("SELECT first_name, last_name, phone_number, address FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_data = $result->fetch_assoc();
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafe Login, Signup, & My Account (PHP)</title>
    <!-- Use the Inter font from Google Fonts for a clean, modern look -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Load Tailwind CSS from the CDN for easy styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for social icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Custom styles for the message box */
        .message-box {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 1rem 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: none;
            text-align: center;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }
        .message-box.show {
            display: block;
            opacity: 1;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

    <!-- Message box for success/error messages, only shown if a message exists -->
    <?php if (!empty($message)): ?>
    <div id="message-box" class="message-box text-white <?php echo $message_type === 'success' ? 'bg-green-500' : 'bg-red-500'; ?> show">
        <?php echo htmlspecialchars($message); ?>
    </div>
    <?php endif; ?>

    <!-- Main container for the login/signup card -->
    <div class="bg-white p-8 md:p-12 rounded-2xl shadow-xl w-full max-w-md">
        
        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- User is logged in, show the My Account page -->
            <h2 id="form-title" class="text-3xl font-bold text-center text-gray-800 mb-6">My Account</h2>
            <form id="account-form" method="POST" action="" class="space-y-6">
                <input type="hidden" name="update_account" value="1">
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                    <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user_data['first_name'] ?? ''); ?>" class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-amber-500 focus:border-amber-500 sm:text-sm">
                </div>
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                    <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user_data['last_name'] ?? ''); ?>" class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-amber-500 focus:border-amber-500 sm:text-sm">
                </div>
                <div>
                    <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="tel" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($user_data['phone_number'] ?? ''); ?>" class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-amber-500 focus:border-amber-500 sm:text-sm">
                </div>
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <textarea id="address" name="address" rows="3" class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-amber-500 focus:border-amber-500 sm:text-sm"><?php echo htmlspecialchars($user_data['address'] ?? ''); ?></textarea>
                </div>
                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition duration-150 ease-in-out">
                    Save Changes
                </button>
            </form>
            <div class="mt-6 text-center">
                <a href="?logout" class="font-medium text-red-600 hover:text-red-500">Log Out</a>
            </div>

        <?php else: ?>
            <!-- User is not logged in, show the login/signup forms -->
            <h2 id="form-title" class="text-3xl font-bold text-center text-gray-800 mb-6">Welcome to Our Cafe</h2>
            <div id="forms-container">

                <!-- Login Form -->
                <form id="login-form" method="POST" action="" class="space-y-6">
                    <input type="hidden" name="login" value="1">
                    <div>
                        <label for="login-email" class="block text-sm font-medium text-gray-700">Email address</label>
                        <input type="email" id="login-email" name="login-email" required class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-amber-500 focus:border-amber-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="login-password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" id="login-password" name="login-password" required class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-amber-500 focus:border-amber-500 sm:text-sm">
                    </div>
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition duration-150 ease-in-out">
                        Log In
                    </button>
                </form>

                <!-- Signup Form (hidden by default) -->
                <form id="signup-form" method="POST" action="" class="space-y-6 hidden">
                    <input type="hidden" name="signup" value="1">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="signup-first-name" class="block text-sm font-medium text-gray-700">First Name</label>
                            <input type="text" id="signup-first-name" name="signup-first-name" required class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-amber-500 focus:border-amber-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="signup-last-name" class="block text-sm font-medium text-gray-700">Last Name</label>
                            <input type="text" id="signup-last-name" name="signup-last-name" required class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-amber-500 focus:border-amber-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="signup-email" class="block text-sm font-medium text-gray-700">Email address</label>
                            <input type="email" id="signup-email" name="signup-email" required class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-amber-500 focus:border-amber-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="signup-phone-number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                            <input type="tel" id="signup-phone-number" name="signup-phone-number" required class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-amber-500 focus:border-amber-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="signup-password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" id="signup-password" name="signup-password" required class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-amber-500 focus:border-amber-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="signup-confirm-password" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                            <input type="password" id="signup-confirm-password" name="signup-confirm-password" required class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-amber-500 focus:border-amber-500 sm:text-sm">
                        </div>
                    </div>
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition duration-150 ease-in-out">
                        Sign Up
                    </button>
                </form>

                <!-- Toggle link to switch between forms -->
                <div class="mt-6 text-center">
                    <p id="toggle-text" class="text-sm text-gray-600">
                        Don't have an account? <a href="#" id="toggle-form" class="font-medium text-amber-600 hover:text-amber-500">Sign up</a>
                    </p>
                </div>
                
                <div class="mt-8 relative">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="bg-white px-2 text-gray-500">Or continue with</span>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-3 gap-3">
                    <div>
                        <a href="#" class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-xl shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            <i class="fab fa-google text-red-500 mr-2"></i>
                            Google
                        </a>
                    </div>
                    <div>
                        <a href="#" class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-xl shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            <i class="fab fa-facebook-f text-blue-600 mr-2"></i>
                            Facebook
                        </a>
                    </div>
                    <div>
                        <a href="#" class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-xl shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            <i class="fab fa-apple text-gray-900 mr-2"></i>
                            Apple
                        </a>
                    </div>
                </div>

            </div>
        <?php endif; ?>
    </div>

    <script>
        // Get references to all necessary elements in the DOM
        const loginForm = document.getElementById('login-form');
        const signupForm = document.getElementById('signup-form');
        const formTitle = document.getElementById('form-title');
        const toggleText = document.getElementById('toggle-text');

        // Toggle form visibility and button text
        function toggleForm() {
            if (loginForm.classList.contains('hidden')) {
                // Currently on signup form, switch to login
                loginForm.classList.remove('hidden');
                signupForm.classList.add('hidden');
                formTitle.textContent = 'Welcome to Our Cafe';
                toggleText.innerHTML = 'Don\'t have an account? <a href="#" id="toggle-form" class="font-medium text-amber-600 hover:text-amber-500">Sign up</a>';
            } else {
                // Currently on login form, switch to signup
                loginForm.classList.add('hidden');
                signupForm.classList.remove('hidden');
                formTitle.textContent = 'Join Us Today!';
                toggleText.innerHTML = 'Already have an account? <a href="#" id="toggle-form" class="font-medium text-amber-600 hover:text-amber-500">Log in</a>';
            }
            // Add the event listener to the new toggle link
            document.getElementById('toggle-form').addEventListener('click', (e) => {
                e.preventDefault();
                toggleForm();
            });
        }

        // Initial setup for the toggle link (only if the forms exist)
        if (document.getElementById('toggle-form')) {
            document.getElementById('toggle-form').addEventListener('click', (e) => {
                e.preventDefault();
                toggleForm();
            });
        }

        // Hide the message box after 5 seconds if it exists
        const messageBox = document.getElementById('message-box');
        if (messageBox) {
            setTimeout(() => {
                messageBox.classList.remove('show');
            }, 5000); // 5 seconds
        }
    </script>
</body>
</html>
