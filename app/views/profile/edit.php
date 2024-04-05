<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>
<body>
    <h2>Edit Profile</h2>
    <form action="index.php?controller=ProfileController&action=update" method="POST">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" value="<?php echo $data['username']; ?>"><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo $data['email']; ?>"><br><br>

        <label for="bio">Bio:</label><br>
        <textarea id="bio" name="bio"><?php echo $data['bio']; ?></textarea><br><br>

        <label for="location">Location:</label><br>
        <input type="text" id="location" name="location" value="<?php echo $data['location']; ?>"><br><br>

        <label for="website">Website:</label><br>
        <input type="text" id="website" name="website" value="<?php echo $data['website']; ?>"><br><br>

        <input type="submit" value="Update">
    </form>
</body>
</html>
