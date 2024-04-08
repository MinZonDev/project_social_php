<?php include '../app/assets/layout/header.php'; ?>
<div class="container">
    <div class="profile-section">
        <h1>Search</h1>
        <div class="profile-info">
            <p>Username:<?php echo $data['username']; ?></p>
            <p><img class="avatar" src="../app/assets/images/<?php echo $data['avatar']; ?>" alt="User Avatar"></p>
            <p>Email: <?php echo $data['email']; ?></p>
            <p><span>Bio:</span> <?php echo $data['bio']; ?></p>
            <p><span>Location:</span> <?php echo $data['location']; ?></p>
            <p><span>Website:</span> <?php echo $data['website']; ?></p>
            <p><span>Date Joined:</span> <?php echo $data['datejoined']; ?></p>
        </div>
    </div>
</div>
<?php include '../app/assets/layout/footer.php'; ?>