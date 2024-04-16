<?php include '../app/assets/layout/header.php'; ?>

<div class="container">

    <h2 class="edit-heading">Edit Profile</h2>
    <form class="edit-form" action="index.php?controller=ProfileController&action=update" method="POST" enctype="multipart/form-data">
        

        <label class="edit-label" for="email">Email:</label><br>
        <input class="edit-input" type="email" id="email" name="email" value="<?php echo $data['email']; ?>"><br><br>

        <label class="edit-label" for="avatar">Avatar:</label><br>
        <img class="edit-avatar" src="../assets/images/<?php echo $data['avatar']; ?>" alt="Avatar"><br>
        <input class="edit-input" type="file" id="avatar" name="avatar"><br><br>

        <label class="edit-label" for="bio">Bio:</label><br>
        <textarea class="edit-textarea" id="bio" name="bio"><?php echo $data['bio']; ?></textarea><br><br>

        <label class="edit-label" for="location">Location:</label><br>
        <input class="edit-input" type="text" id="location" name="location" value="<?php echo $data['location']; ?>"><br><br>

        <label class="edit-label" for="website">Website:</label><br>
        <input class="edit-input" type="text" id="website" name="website" value="<?php echo $data['website']; ?>"><br><br>

        <input class="edit-submit" type="submit" value="Update">
    </form>

</div>

<?php include '../app/assets/layout/footer.php'; ?>
