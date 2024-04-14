<?php include '../app/assets/layout/header.php'; ?>

<div class="container">
    <h1>Tweets</h1>
    <div class="tweet-section">
        <!-- Form for adding a new tweet -->
        <form action="index.php?controller=TweetController&action=add" method="POST" enctype="multipart/form-data">
            <textarea name="content" rows="4" cols="50" placeholder="What's on your mind?"></textarea>
            <br>
            <input type="file" name="image">
            <br>
            <input type="submit" value="Post">
        </form>

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
                            <span class="material-icons"> repeat </span>
                            <?php if ($tweetModel->isTweetLiked($tweet['TweetID'], $_SESSION['user_id'])): ?>
                                <button class="material-icons" onclick="unlikeTweet(<?php echo $tweet['TweetID']; ?>)"> favorite </button>
                            <?php else: ?>
                                <button class="material-icons" onclick="likeTweet(<?php echo $tweet['TweetID']; ?>)"> favorite_border </button>
                            <?php endif; ?>
                            <span class="material-icons"> publish </span>
                            <span id="likeCount-<?php echo $tweet['TweetID']; ?>"><?php echo $tweet['LikeCount']; ?> Likes</span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No posts found.</p>
        <?php endif; ?>
    </div>
</div>

<script>
    function likeTweet(tweetId) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'index.php?controller=TweetController&action=likeTweet', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                var likeCountElement = document.getElementById('likeCount-' + tweetId);
                likeCountElement.textContent = xhr.responseText + ' Likes';
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
                likeCountElement.textContent = xhr.responseText + ' Likes';
            }
        };
        xhr.send('tweet_id=' + tweetId);
    }
</script>

<?php include '../app/assets/layout/footer.php'; ?>
