<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
            color: #333;
            line-height: 1.6;
        }

        h1, h2 {
            text-align: center;
            margin-top: 50px;
            color: #555;
        }

        a {
            display: block;
            text-align: center;
            margin: 20px auto; /* Center the button vertically */
            text-decoration: none;
            color: #007bff;
            border: 1px solid #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
            width: 200px; /* Set a fixed width for the button */
        }

        a:hover {
            background-color: #007bff;
            color: #fff;
        }
    </style>

</head>
<body>
    <h1>Registration Successful</h1>
    <?php
    session_start();
    $ownerID = $_SESSION['ownerID'];

    $email = $_SESSION['email'];
    $username = $_SESSION['username'];
    echo "<h2>Congratulations $username with User ID: $ownerID. 
    You Have Successfully Created An Account With AutoMotive Services 
    With The Following Email: $email</h2>";
    ?>
    <a href="login_page.php">Log in</a>

</body>
</html>
