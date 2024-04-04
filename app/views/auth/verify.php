<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Account</title>
</head>
<body>
    <h2>Verify Your Account</h2>
    <p>Please enter the verification code sent to your email:</p>
    <form action="verify.php" method="post">
        <input type="text" name="verification_code" placeholder="Verification Code" required>
        <button type="submit">Verify</button>
    </form>
</body>
</html>
