<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" type="text/css" href="../css/styleReg.css"/>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>
    <div id="container">
        <h1>Registration</h1>
        <div id="form">
            <form name="registrationForm" action="../scripts/registerScript.php" method="POST">
                <!-- Login Details -->
                <input type="text" name="user" placeholder="Email" required><br>
                <input type="password" name="pass" placeholder="Set Password" required><br>
                <input type="password" name="confirmPass" placeholder="Confirm Password" required><br>

                <!-- Personal Details -->
                <input type="text" name="name" placeholder="Name" required><br>
                <input type="text" name="lastName" placeholder="Last Name" required><br>
                <input type="text" name="Address" placeholder="Address" required><br>
                <input type="text" name="CellNumber" placeholder="Cell Number" required><br>

                <input type="submit" value="Next" name="submit">
            </form>
        </div>
    </div>
</body>
</html>
