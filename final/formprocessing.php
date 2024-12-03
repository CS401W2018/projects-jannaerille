<!DOCTYPE html>
<html lang="en">
<head>
    <title>Signed Up</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <main>
        <h1>Thank You for Signing Up!</h1>

        <?php
        // Check if the form was submitted via POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Sanitize and display user input
            $firstName = htmlspecialchars($_POST['firstName'] ?? '');
            $lastName = htmlspecialchars($_POST['lastName'] ?? '');
            $email = htmlspecialchars($_POST['email'] ?? '');
            $age = htmlspecialchars($_POST['age'] ?? '');
            $feedback = htmlspecialchars($_POST['feedback'] ?? '');

            echo "<p>First Name: $firstName</p>";
            echo "<p>Last Name: $lastName</p>";
            echo "<p>Email: $email</p>";
            echo "<p>Age: $age</p>";
            echo "<p>Feedback: $feedback</p>";
        } else {
            // Redirect to the form page if accessed directly
            header("Location: kusinaperez.html");
            exit();
        }
        ?>
    </main>
</body>
</html>