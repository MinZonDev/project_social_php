<?php
include '../app/assets/layout/header.php';
?>
<div class="container">
    <h1>User Profile</h1>
    <p>Welcome,
        <?php echo $data['username']; ?>!
    </p>
    <div class="profile-info">
        <p><img class="avatar" src="../app/assets/images/<?php echo $data['avatar']; ?>" alt="User Avatar"> </p>
        <p>Email:
            <?php echo $data['email']; ?>
        </p>
        <p><span>Bio:</span>
            <?php echo $data['bio']; ?>
        </p>
        <p><span>Location:</span>
            <?php echo $data['location']; ?>
        </p>
        <p><span>Website:</span>
            <?php echo $data['website']; ?>
        </p>
        <p><span>Date Joined:</span>
            <?php echo $data['datejoined']; ?>
        </p>
    </div>
    <button class="edit-button">Edit Profile</button>
</div>
<?php
include '../app/assets/layout/footer.php';
?>