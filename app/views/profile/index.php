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
    <?php if (!empty($tweets)): ?>
      <?php foreach ($tweets as $tweet): ?>
        <!-- post starts -->
        <div class="post">
          <div class="post__avatar">
            <img src="../app/assets/images/<?php echo isset($tweet['Avatar']) ? $tweet['Avatar'] : 'avatar.jpg'; ?>" alt="" />
          </div>

          <div class="post__body">
            <div class="post__header">
              <div class="post__headerText">
                <h3>
                  <?php echo isset($tweet['Username']) ? $tweet['Username'] : ''; ?>
                  <!-- Hiển thị tên người dùng -->
                </h3>
              </div>
              <div class="post__date">
                <p><?php echo isset($tweet['Timestamp']) ? $tweet['Timestamp'] : ''; ?></p>
                <!-- Hiển thị ngày đăng -->
              </div>
            </div>
            <div class="post__headerDescription">
              <p><?php echo isset($tweet['Content']) ? $tweet['Content'] : ''; ?></p>
            </div>
            <img src="../app/assets/images/<?php echo isset($tweet['ImageURL']) ? $tweet['ImageURL'] : ''; ?>" alt="" />
            <div class="post__footer">
              <span class="material-icons"> repeat </span>
              <span class="material-icons"> favorite_border </span>
              <span class="material-icons"> publish </span>
            </div>
          </div>
        </div>
        <!-- post ends -->
      <?php endforeach; ?>

    <?php else: ?>
      <p>No posts found.</p>
    <?php endif; ?>
</div>

<?php include '../app/assets/layout/footer.php'; ?>
