<?php include '../app/assets/layout/header.php'; ?>

<div class="container">
    <h1>Tweets</h1>
    <div class="tweet-section">
        <!-- Form for adding a new tweet -->
        <form action="index.php?controller=TweetController&action=add" method="POST" enctype="multipart/form-data">
            <textarea name="content" rows="4" cols="50" placeholder="What's on your mind?"></textarea>
            <br>
            <input type="file" name="image"> <!-- Trường input cho phép chọn hình ảnh -->
            <br>
            <input type="submit" value="Post">
        </form>

        <!-- Display tweets -->
        <?php foreach ($tweets as $tweet): ?>
            <div class="tweet">
                <div class="tweet-content">
                    <p><?php echo $tweet['Content']; ?></p>
                    <div style="display: flex; justify-content: space-between;">
                        <p>Posted by: <?php echo $tweet['Username']; ?></p>
                        <p style="margin-right: 0;">Posted at: <?php echo $tweet['Timestamp']; ?></p>
                    </div>
                </div>
                <?php if ($tweet['ImageURL']): ?>
                    <div class="tweet-image">
                        <img style="width: 150px;" src="../app/assets/images/<?php echo $tweet['ImageURL']; ?>" alt="Tweet Image"> <!-- Thay đổi đường dẫn tới thư mục lưu trữ ảnh -->
                    </div>
                <?php endif; ?>

                <!-- Thêm nút yêu thích, retweet, comment -->
                <div class="tweet-actions">
                    <button class="action-button like-button">Like</button>
                    <button class="action-button retweet-button">Retweet</button>
                    <button class="action-button comment-button">Comment</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include '../app/assets/layout/footer.php'; ?>