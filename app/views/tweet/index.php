<?php include '../app/assets/layout/header.php'; ?>

<div class="container">
    <h1>Tweets</h1>
    <div class="tweet-section">
        <!-- Form for adding a new tweet -->
        <form action="index.php?controller=TweetController&action=add" method="POST">
            <textarea name="content" rows="4" cols="50" placeholder="What's on your mind?"></textarea>
            <br>
            <input type="submit" value="Post">
        </form>

        <!-- Display tweets -->
        <?php foreach ($tweets as $tweet) : ?>
            <div class="tweet">
                <p><?php echo $tweet['Content']; ?></p>
                <p>Posted by: <?php echo $tweet['UserID']; ?></p>
                <p>Posted at: <?php echo $tweet['Timestamp']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include '../app/assets/layout/footer.php'; ?>
