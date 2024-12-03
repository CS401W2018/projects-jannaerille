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
            <p>First Name: <?php print $_POST['firstName'] ?></p>
            <p>Last Name: <?php print $_POST['lastName'] ?></p>
            <p>Email: <?php print $_POST['email'] ?></p>
            <p>Feedback: <?php print $_POST['feedback'] ?></p>
        </main>
    </body>
</html>