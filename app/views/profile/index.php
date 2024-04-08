<?php 
include '../app/assets/layout/header.php'; 
require_once '../app/models/TweetModel.php';
require_once '../app/models/User.php';
?>

<div class="container">
    <!-- Top section for user profile -->
    <div class="profile-section">
        <h1>User Profile</h1>
        <p>Welcome, <?php echo isset($data['username']) ? $data['username'] : ''; ?>!</p>
        <div class="profile-info">
            <?php if (isset($data['avatar'])) : ?>
                <p><img class="avatar" src="../app/assets/images/<?php echo $data['avatar']; ?>" alt="User Avatar"></p>
            <?php endif; ?>
            <p>Email: <?php echo isset($data['email']) ? $data['email'] : ''; ?></p>
            <p><span>Bio:</span> <?php echo isset($data['bio']) ? $data['bio'] : ''; ?></p>
            <p><span>Location:</span> <?php echo isset($data['location']) ? $data['location'] : ''; ?></p>
            <p><span>Website:</span> <?php echo isset($data['website']) ? $data['website'] : ''; ?></p>
            <p><span>Date Joined:</span> <?php echo isset($data['datejoined']) ? $data['datejoined'] : ''; ?></p>
        </div>
        <a href="http://localhost/project_social_php/public/index.php?controller=ProfileController&action=edit" class="edit-button">Edit Profile</a>
    </div>

    <!-- Bottom section for user posts -->
    <div class="feed">
        <?php 
        // Kiểm tra xem có bài tweet nào tồn tại không
        if (isset($data['tweets']) && is_array($data['tweets'])) : ?>
            <?php foreach ($data['tweets'] as $tweet) : ?>
                <div class="post">
                    <div class="post__avatar">
                        <!-- Hiển thị avatar của người đăng bài tweet -->
                        <img src="../app/assets/images/<?php echo isset($tweet['avatar']) ? $tweet['avatar'] : ''; ?>" alt="User Avatar">
                    </div>
                    <div class="post__body">
                        <div class="post__header">
                            <div class="post__headerText">
                                <!-- Hiển thị tên người đăng bài tweet -->
                                <h3><?php echo isset($tweet['username']) ? $tweet['username'] : ''; ?></h3>
                            </div>
                            <div class="post__headerDescription">
                                <!-- Hiển thị nội dung của bài tweet -->
                                <p><?php echo isset($tweet['content']) ? $tweet['content'] : ''; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <!-- Hiển thị thông báo nếu không có bài tweet nào được tìm thấy -->
            <p>No tweets found.</p>
        <?php endif; ?>
    </div>
</div>

<?php include '../app/assets/layout/footer.php'; ?>
