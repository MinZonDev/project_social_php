<?php include '../app/assets/layout/header.php'; ?>

<div class="container">
    <!-- Top section for user profile -->
    <div class="profile-section">
        <h1>User Profile</h1>
        <p>Welcome, <?php echo $data['username']; ?>!</p>
        <div class="profile-info">
            <p><img style="width: 180px; height: 180px;" class="avatar" src="../app/assets/images/<?php echo $data['avatar']; ?>" alt="User Avatar"></p>
            <p>Email: <?php echo $data['email']; ?></p>
            <p><span>Bio:</span> <?php echo $data['bio']; ?></p>
            <p><span>Location:</span> <?php echo $data['location']; ?></p>
            <p><span>Website:</span> <?php echo $data['website']; ?></p>
            <p><span>Date Joined:</span> <?php echo $data['datejoined']; ?></p>
        </div>
        <a href="http://localhost/project_social_php/public/index.php?controller=ProfileController&action=edit" class="edit-button">Edit Profile</a>
    </div>

    <!-- Bottom section for user posts -->
    <div class="feed">
        <!-- Add user posts here -->
    </div>
</div>

<?php include '../app/assets/layout/footer.php'; ?>
