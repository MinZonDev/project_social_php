<?php include '../app/assets/layout/header.php'; ?>

<div class="container">
  <!-- feed starts -->
  <div class="feed">
    <div class="feed__header">
      <h2>Home</h2>
    </div>

    <?php if (!empty($tweets)): ?>
      <?php foreach ($tweets as $tweet): ?>
        <!-- post starts -->
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
              <button onclick="likeTweet(<?php echo $tweet['TweetID']; ?>)">
                <span class="material-icons"> favorite_border </span>
              </button>
              <button>
                <span class="material-icons"> repeat </span>
              </button>
              <button>
                <span class="material-icons"> publish </span>
              </button>
            </div>
            <?php if (isset($tweet['LikeCount'])): ?>
              <p id="likeCount-<?php echo $tweet['TweetID']; ?>">
                <?php echo $tweet['LikeCount']; ?> Likes <?php echo $tweet['RetweetCount']; ?> Retweets
              </p>
            <?php endif; ?>
            <?php if (isset($tweet['CommentCount'])): ?>
              <p><?php echo $tweet['CommentCount']; ?> Comments</p>
            <?php endif; ?>
          </div>
        </div>
        <!-- post ends -->
      <?php endforeach; ?>

    <?php else: ?>
      <p>No posts found.</p>
    <?php endif; ?>
  </div>
  <!-- feed ends -->

</div>

<?php include '../app/assets/layout/footer.php'; ?>

<script>
  function likeTweet(tweetId) {
    // Gửi yêu cầu Ajax để thực hiện like bài viết
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'app/views/home/like_tweet.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        // Cập nhật số lượng lượt thích trên giao diện người dùng
        var likeCountElement = document.getElementById('likeCount-' + tweetId);
        likeCountElement.textContent = xhr.responseText + ' Likes';
      }
    };
    xhr.send('tweet_id=' + tweetId);
  }
</script>