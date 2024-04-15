<?php include '../app/assets/layout/header.php'; ?>

<div class="container">
    <!-- Top section for user profile -->

    <div class="feed">
        <div class="profile-section">
            <h1>User Profile</h1>
            <?php if (!empty($data)): ?> <!-- Kiểm tra xem dữ liệu có tồn tại không -->
                <div class="profile-info">
                    <p><img style="width: 180px; height: 180px;" class="avatar"
                            src="../app/assets/images/<?php echo $data['avatar']; ?>" alt="User Avatar"></p>
                    <p>Email: <?php echo $data['email']; ?></p>
                    <p><span>Bio:</span> <?php echo $data['bio']; ?></p>
                    <p><span>Location:</span> <?php echo $data['location']; ?></p>
                    <p><span>Website:</span> <?php echo $data['website']; ?></p>
                    <p><span>Date Joined:</span> <?php echo $data['datejoined']; ?></p>
                    <p><span>Followers:</span> <?php echo $data['followers_count']; ?></p>
                    <p><span>Following:</span> <?php echo $data['following_count']; ?></p>
                </div>
                <?php if ($data['is_current_user']): ?>
                    <a href="http://localhost/project_social_php/public/index.php?controller=ProfileController&action=edit"
                        class="edit-button">Edit Profile</a>
                <?php else: ?>
                    <?php if ($data['is_following']): ?>
                        <!-- Nếu đang follow, hiển thị nút Unfollow -->
                        <a href="#" onclick="confirmUnfollow(<?php echo $user['UserID']; ?>);" class="unfollow-button">Unfollow</a>
                    <?php else: ?>
                        <!-- Nếu chưa follow, hiển thị nút Follow -->
                        <a href="index.php?controller=ProfileController&action=follow&userId=<?php echo $user['UserID']; ?>"
                            class="follow-button">Follow</a>
                    <?php endif; ?>
                <?php endif; ?>
            <?php else: ?>
                <p>No user data available.</p> <!-- Hiển thị thông báo nếu không có dữ liệu -->
            <?php endif; ?>
        </div>

        <!-- Display tweets -->
        <?php if (!empty($tweets)): ?>
            <?php foreach ($tweets as $tweet): ?>
                <div class="post">
                    <div class="post__avatar">
                        <img src="../app/assets/images/<?php echo isset($tweet['Avatar']) ? $tweet['Avatar'] : 'avatar.jpg'; ?>"
                            alt="" />
                    </div>

                    <div class="post__body">
                        <div class="post__header">
                            <div class="post__headerText">
                                <h3>
                                    <?php echo isset($tweet['Username']) ? $tweet['Username'] : ''; ?>
                                </h3>
                            </div>
                            <div class="post__date">
                                <p><?php echo isset($tweet['Timestamp']) ? $tweet['Timestamp'] : ''; ?></p>
                            </div>
                        </div>
                        <div class="post__headerDescription">
                            <p><?php echo isset($tweet['Content']) ? $tweet['Content'] : ''; ?></p>
                        </div>
                        <img src="../app/assets/images/<?php echo isset($tweet['ImageURL']) ? $tweet['ImageURL'] : ''; ?>"
                            alt="" />
                        <div class="post__footer">
                            <!-- Nút sửa và xóa -->
                            <?php if ($tweet['UserID'] === $_SESSION['user_id']): ?>
                                <button class="material-icons" onclick="editTweet(<?php echo $tweet['TweetID']; ?>)"> edit </button>
                                <button class="material-icons" onclick="deleteTweet(<?php echo $tweet['TweetID']; ?>)"> delete
                                </button>
                            <?php endif; ?>
                            <!-- Nút like và số lượt like -->
                            <?php if ($tweetModel->isTweetLiked($tweet['TweetID'], $_SESSION['user_id'])): ?>
                                <button id="likeButton-<?php echo $tweet['TweetID']; ?>" class="material-icons"
                                    onclick="unlikeTweet(<?php echo $tweet['TweetID']; ?>)"> favorite </button>
                            <?php else: ?>
                                <button id="likeButton-<?php echo $tweet['TweetID']; ?>" class="material-icons"
                                    onclick="likeTweet(<?php echo $tweet['TweetID']; ?>)"> favorite_border </button>
                            <?php endif; ?>
                            <span class="material-icons"> publish </span>
                            <span id="likeCount-<?php echo $tweet['TweetID']; ?>"><?php echo $tweet['LikeCount']; ?>
                                Likes</span>
                        </div>
                        <!-- Form chỉnh sửa bài viết -->
                        <form id="editTweetForm-<?php echo $tweet['TweetID']; ?>" class="edit-tweet-form"
                            style="display: none;">
                            <textarea id="editTweetContent-<?php echo $tweet['TweetID']; ?>" rows="4"
                                cols="50"><?php echo $tweet['Content']; ?></textarea>
                            <br>
                            <button type="button" onclick="saveEditedTweet(<?php echo $tweet['TweetID']; ?>)">Save</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No posts found.</p>
        <?php endif; ?>
    </div>
</div>
<!-- Thêm mã JavaScript -->
<script>
    function confirmUnfollow(userId) {
        var result = confirm("Are you sure you want to unfollow this user?");
        if (result) {
            window.location.href = 'index.php?controller=ProfileController&action=unfollow&userId=' + userId + '&confirm=true';
        }
    }
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