<?php include '../app/assets/layout/header.php'; ?>

<div class="container">
    <h1>Tweets</h1>
    <div class="tweet-section">
        <!-- Form for adding a new tweet -->
        <form id="addTweetForm" action="index.php?controller=TweetController&action=add" method="POST"
            enctype="multipart/form-data">
            <textarea id="tweetContent" name="content" rows="4" cols="50" placeholder="What's on your mind?"></textarea>
            <br>
            <input type="file" name="image">
            <br>
            <input type="submit" value="Post">
        </form>

        <!-- Display tweets -->
        <?php if (!empty($tweets)): ?>
            <?php foreach ($tweets as $tweet): ?>
                <div class="post">
                    <!-- Existing code for displaying tweet content -->

                    <!-- Display comments -->
                    <div class="comments">
                        <?php if (isset($tweet['Comments']) && is_array($tweet['Comments']) && !empty($tweet['Comments'])): ?>
                            <?php foreach ($tweet['Comments'] as $comment): ?>
                                <div class="comment">
                                    <div class="comment__avatar">
                                        <img src="../app/assets/images/<?php echo isset($comment['Avatar']) ? $comment['Avatar'] : 'avatar.jpg'; ?>"
                                            alt="" />
                                    </div>
                                    <div class="comment__body">
                                        <div class="comment__header">
                                            <span class="comment__username"><?php echo $comment['Username']; ?></span>
                                            <span class="comment__timestamp"><?php echo $comment['Timestamp']; ?></span>
                                        </div>
                                        <div class="comment__content">
                                            <p><?php echo $comment['Content']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No comments yet.</p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No posts found.</p>
        <?php endif; ?>
    </div>
</div>

<script>
    function editTweet(tweetId) {
        // Ẩn nội dung bài viết và hiển thị form chỉnh sửa
        document.getElementById('editTweetForm-' + tweetId).style.display = 'block';
        document.querySelector('.post__headerDescription p').style.display = 'none';
    }

    function saveEditedTweet(tweetId) {
        var editedContent = document.getElementById('editTweetContent-' + tweetId).value;
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'index.php?controller=TweetController&action=editTweet', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                // Xử lý phản hồi sau khi chỉnh sửa thành công (ví dụ: reload trang)
                window.location.reload();
            }
        };
        xhr.send('tweet_id=' + tweetId + '&content=' + editedContent);
    }

    function likeTweet(tweetId) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'index.php?controller=TweetController&action=likeTweet', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                var likeCountElement = document.getElementById('likeCount-' + tweetId);
                var likeButton = document.getElementById('likeButton-' + tweetId);
                likeButton.innerHTML = 'favorite'; // Thay đổi nút thành "favorite"
                likeButton.setAttribute('onclick', 'unlikeTweet(' + tweetId + ')'); // Thay đổi hàm xử lý onclick
                likeCountElement.textContent = xhr.responseText + ' Likes'; // Cập nhật số lượt like
            }
        };
        xhr.send('tweet_id=' + tweetId);
    }

    function unlikeTweet(tweetId) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'index.php?controller=TweetController&action=unlikeTweet', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                var likeCountElement = document.getElementById('likeCount-' + tweetId);
                var likeButton = document.getElementById('likeButton-' + tweetId);
                likeButton.innerHTML = 'favorite_border'; // Thay đổi nút thành "favorite_border"
                likeButton.setAttribute('onclick', 'likeTweet(' + tweetId + ')'); // Thay đổi hàm xử lý onclick
                likeCountElement.textContent = xhr.responseText + ' Likes'; // Cập nhật số lượt like
            }
        };
        xhr.send('tweet_id=' + tweetId);
    }
    function deleteTweet(tweetId) {
        // Hiển thị hộp thoại xác nhận trước khi xóa bài viết
        var confirmation = confirm("Are you sure you want to delete this tweet?");
        if (confirmation) {
            // Nếu người dùng đồng ý xóa, gửi yêu cầu xóa đến server
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'index.php?controller=TweetController&action=deleteTweet', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    // Xử lý phản hồi sau khi xóa thành công
                    // Ví dụ: reload trang để cập nhật danh sách tweet
                    window.location.reload();
                }
            };
            xhr.send('tweet_id=' + tweetId);
        } else {
            // Nếu người dùng không đồng ý xóa, không thực hiện gì cả
            return;
        }
    }
</script>

<?php include '../app/assets/layout/footer.php'; ?>