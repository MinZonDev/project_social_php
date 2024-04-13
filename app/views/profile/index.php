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
        <?php if ($data['is_current_user']): ?>
            <a href="http://localhost/project_social_php/public/index.php?controller=ProfileController&action=edit" class="edit-button">Edit Profile</a>
        <?php else: ?>
            <?php if ($data['is_following']): ?>
                <a href="#" class="unfollow-button">Unfollow</a>
            <?php else: ?>
                <a href="#" class="follow-button">Follow</a>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <!-- Bottom section for user posts -->
    <div class="feed">
        <h2>User Posts</h2>
        <?php if (!empty($data['tweets'])): ?>
            <ul>
                <?php foreach ($data['tweets'] as $tweet): ?>
                    <li><?php echo $tweet['Content']; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No posts found.</p>
        <?php endif; ?>
    </div>
</div>

<?php include '../app/assets/layout/footer.php'; ?>
