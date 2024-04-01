<?php
    // //Include file kết nối MySQL
    include 'config/connect.php';
?>

<!-- <?php
// //Tạo bảng Users
// $sql = "CREATE TABLE IF NOT EXISTS Users (
//     UserID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     Username VARCHAR(50) NOT NULL,
//     Email VARCHAR(100) NOT NULL,
//     Password VARCHAR(255) NOT NULL,
//     Avatar VARCHAR(255),
//     Bio TEXT,
//     Location VARCHAR(100),
//     Website VARCHAR(255),
//     DateJoined TIMESTAMP DEFAULT CURRENT_TIMESTAMP
// )";

// if ($conn->query($sql) === TRUE) {
//     echo "Table Users created successfully\n";
// } else {
//     echo "Error creating table Users: " . $conn->error;
// }

// // Tạo bảng Tweets
// $sql = "CREATE TABLE IF NOT EXISTS Tweets (
//     TweetID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     UserID INT(6) UNSIGNED,
//     Content TEXT,
//     Timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//     RetweetID INT(6) UNSIGNED,
//     RetweetCount INT(6) DEFAULT 0,
//     LikeCount INT(6) DEFAULT 0,
//     FOREIGN KEY (UserID) REFERENCES Users(UserID),
//     FOREIGN KEY (RetweetID) REFERENCES Tweets(TweetID)
// )";

// if ($conn->query($sql) === TRUE) {
//     echo "Table Tweets created successfully\n";
// } else {
//     echo "Error creating table Tweets: " . $conn->error;
// }

// // Tạo bảng Retweets
// $sql = "CREATE TABLE IF NOT EXISTS Retweets (
//     RetweetID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     UserID INT(6) UNSIGNED,
//     OriginalTweetID INT(6) UNSIGNED,
//     Timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//     FOREIGN KEY (UserID) REFERENCES Users(UserID),
//     FOREIGN KEY (OriginalTweetID) REFERENCES Tweets(TweetID)
// )";

// if ($conn->query($sql) === TRUE) {
//     echo "Table Retweets created successfully\n";
// } else {
//     echo "Error creating table Retweets: " . $conn->error;
// }

// // Tạo bảng Likes
// $sql = "CREATE TABLE IF NOT EXISTS Likes (
//     LikeID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     UserID INT(6) UNSIGNED,
//     TweetID INT(6) UNSIGNED,
//     Timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//     FOREIGN KEY (UserID) REFERENCES Users(UserID),
//     FOREIGN KEY (TweetID) REFERENCES Tweets(TweetID)
// )";

// if ($conn->query($sql) === TRUE) {
//     echo "Table Likes created successfully\n";
// } else {
//     echo "Error creating table Likes: " . $conn->error;
// }

// // Tạo bảng Comments
// $sql = "CREATE TABLE IF NOT EXISTS Comments (
//     CommentID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     UserID INT(6) UNSIGNED,
//     TweetID INT(6) UNSIGNED,
//     Content TEXT,
//     Timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//     FOREIGN KEY (UserID) REFERENCES Users(UserID),
//     FOREIGN KEY (TweetID) REFERENCES Tweets(TweetID)
// )";

// if ($conn->query($sql) === TRUE) {
//     echo "Table Comments created successfully\n";
// } else {
//     echo "Error creating table Comments: " . $conn->error;
// }

// // Tạo bảng Followers
// $sql = "CREATE TABLE IF NOT EXISTS Followers (
//     FollowerID INT(6) UNSIGNED,
//     FollowingID INT(6) UNSIGNED,
//     Timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//     FOREIGN KEY (FollowerID) REFERENCES Users(UserID),
//     FOREIGN KEY (FollowingID) REFERENCES Users(UserID)
// )";

// if ($conn->query($sql) === TRUE) {
//     echo "Table Followers created successfully\n";
// } else {
//     echo "Error creating table Followers: " . $conn->error;
// }

// // Tạo bảng Hashtags
// $sql = "CREATE TABLE IF NOT EXISTS Hashtags (
//     HashtagID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     Tag VARCHAR(255)
// )";

// if ($conn->query($sql) === TRUE) {
//     echo "Table Hashtags created successfully\n";
// } else {
//     echo "Error creating table Hashtags: " . $conn->error;
// }

// // Tạo bảng TweetHashtags
// $sql = "CREATE TABLE IF NOT EXISTS TweetHashtags (
//     TweetHashtagID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     TweetID INT(6) UNSIGNED,
//     HashtagID INT(6) UNSIGNED,
//     FOREIGN KEY (TweetID) REFERENCES Tweets(TweetID),
//     FOREIGN KEY (HashtagID) REFERENCES Hashtags(HashtagID)
// )";

// if ($conn->query($sql) === TRUE) {
//     echo "Table TweetHashtags created successfully\n";
// } else {
//     echo "Error creating table TweetHashtags: " . $conn->error;
// }

// // Tạo bảng Messages
// $sql = "CREATE TABLE IF NOT EXISTS Messages (
//     MessageID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     SenderID INT(6) UNSIGNED,
//     ReceiverID INT(6) UNSIGNED,
//     Content TEXT,
//     Timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//     Seen BOOLEAN,
//     FOREIGN KEY (SenderID) REFERENCES Users(UserID),
//     FOREIGN KEY (ReceiverID) REFERENCES Users(UserID)
// )";

// if ($conn->query($sql) === TRUE
// ) {
//     echo "Table Messages created successfully\n";
// } else {
//     echo "Error creating table Messages: " . $conn->error;
// }

// // Tạo bảng Notifications
// $sql = "CREATE TABLE IF NOT EXISTS Notifications (
//     NotificationID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     UserID INT(6) UNSIGNED,
//     NotificationType ENUM('like', 'retweet', 'follow', 'comment', 'message'),
//     SourceUserID INT(6) UNSIGNED,
//     TweetID INT(6) UNSIGNED,
//     CommentID INT(6) UNSIGNED,
//     MessageID INT(6) UNSIGNED,
//     Timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//     Seen BOOLEAN,
//     FOREIGN KEY (UserID) REFERENCES Users(UserID),
//     FOREIGN KEY (SourceUserID) REFERENCES Users(UserID),
//     FOREIGN KEY (TweetID) REFERENCES Tweets(TweetID),
//     FOREIGN KEY (CommentID) REFERENCES Comments(CommentID),
//     FOREIGN KEY (MessageID) REFERENCES Messages(MessageID)
// )";

// if ($conn->query($sql) === TRUE) {
//     echo "Table Notifications created successfully\n";
// } else {
//     echo "Error creating table Notifications: " . $conn->error;
// }

// Đóng kết nối MySQL
// $conn->close();
?> -->
