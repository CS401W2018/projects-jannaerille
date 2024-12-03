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
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
            header("Location: kusinaperez.html");
            exit();
        }
        ?>
    </main>
</body>
</html>