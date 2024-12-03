<!DOCTYPE html>
<html lang ="en">
    <head>
        <title>Signed Up</title>
        <meta charset="utf-8">
        <link rel = "stylesheet" href = "styles.css">
    </head>
    <body>
        <main>
            <h1>Thank you for signing up!</h1>
            <?php
            // Enable error reporting for debugging
            error_reporting(E_ALL);
            ini_set('display_errors', 1);

            // Function to sanitize input
            function sanitizeInput($input) {
                $input = trim($input);
                $input = stripslashes($input);
                $input = htmlspecialchars($input);
                return $input;
            }

            // Initialize response array
            $response = [
                'status' => 'error',
                'message' => ''
            ];

            // Check if the request method is POST
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Collect and sanitize form data
                $firstName = isset($_POST['firstName']) ? sanitizeInput($_POST['firstName']) : '';
                $lastName = isset($_POST['lastName']) ? sanitizeInput($_POST['lastName']) : '';
                $email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : '';
                $age = isset($_POST['age']) ? intval($_POST['age']) : 0;
                $feedback = isset($_POST['feedback']) ? sanitizeInput($_POST['feedback']) : '';

                // Basic validation
                $errors = [];

                // First Name validation
                if (empty($firstName)) {
                    $errors[] = "First Name is required.";
                } elseif (strlen($firstName) < 2) {
                    $errors[] = "First Name must be at least 2 characters long.";
                }

                // Last Name validation
                if (empty($lastName)) {
                    $errors[] = "Last Name is required.";
                } elseif (strlen($lastName) < 2) {
                    $errors[] = "Last Name must be at least 2 characters long.";
                }

                // Email validation
                if (empty($email)) {
                    $errors[] = "Email is required.";
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors[] = "Invalid email format.";
                }

                // Age validation
                if ($age < 0 || $age > 120) {
                    $errors[] = "Please enter a valid age.";
                }

                // If no errors, process the form
                if (empty($errors)) {
                    // Example: You can replace this with your actual processing logic
                    // Such as saving to database, sending email, etc.
                    $logFile = 'registrations.txt';
                    $registrationData = "Date: " . date('Y-m-d H:i:s') . "\n" .
                                        "Name: $firstName $lastName\n" .
                                        "Email: $email\n" .
                                        "Age: $age\n" .
                                        "Feedback: $feedback\n" .
                                        "-------------------\n";

                    // Append to log file
                    file_put_contents($logFile, $registrationData, FILE_APPEND);

                    // Set success response
                    $response['status'] = 'success';
                    $response['message'] = 'Thank you for registering! We will keep you updated.';
                } else {
                    // Set error response with all validation errors
                    $response['message'] = implode('<br>', $errors);
                }
            } else {
                // If not a POST request
                $response['message'] = 'Invalid request method.';
            }

            // Send JSON response
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
            ?>
        </main>
    </body>
</html>