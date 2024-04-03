-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 03, 2024 lúc 07:15 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `chirp_social`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `CommentID` int(6) UNSIGNED NOT NULL,
  `UserID` int(6) UNSIGNED DEFAULT NULL,
  `TweetID` int(6) UNSIGNED DEFAULT NULL,
  `Content` text DEFAULT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `followers`
--

CREATE TABLE `followers` (
  `FollowerID` int(6) UNSIGNED DEFAULT NULL,
  `FollowingID` int(6) UNSIGNED DEFAULT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hashtags`
--

CREATE TABLE `hashtags` (
  `HashtagID` int(6) UNSIGNED NOT NULL,
  `Tag` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `likes`
--

CREATE TABLE `likes` (
  `LikeID` int(6) UNSIGNED NOT NULL,
  `UserID` int(6) UNSIGNED DEFAULT NULL,
  `TweetID` int(6) UNSIGNED DEFAULT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `messages`
--

CREATE TABLE `messages` (
  `MessageID` int(6) UNSIGNED NOT NULL,
  `SenderID` int(6) UNSIGNED DEFAULT NULL,
  `ReceiverID` int(6) UNSIGNED DEFAULT NULL,
  `Content` text DEFAULT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `Seen` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notifications`
--

CREATE TABLE `notifications` (
  `NotificationID` int(6) UNSIGNED NOT NULL,
  `UserID` int(6) UNSIGNED DEFAULT NULL,
  `NotificationType` enum('like','retweet','follow','comment','message') DEFAULT NULL,
  `SourceUserID` int(6) UNSIGNED DEFAULT NULL,
  `TweetID` int(6) UNSIGNED DEFAULT NULL,
  `CommentID` int(6) UNSIGNED DEFAULT NULL,
  `MessageID` int(6) UNSIGNED DEFAULT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `Seen` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `retweets`
--

CREATE TABLE `retweets` (
  `RetweetID` int(6) UNSIGNED NOT NULL,
  `UserID` int(6) UNSIGNED DEFAULT NULL,
  `OriginalTweetID` int(6) UNSIGNED DEFAULT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tweethashtags`
--

CREATE TABLE `tweethashtags` (
  `TweetHashtagID` int(6) UNSIGNED NOT NULL,
  `TweetID` int(6) UNSIGNED DEFAULT NULL,
  `HashtagID` int(6) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tweets`
--

CREATE TABLE `tweets` (
  `TweetID` int(6) UNSIGNED NOT NULL,
  `UserID` int(6) UNSIGNED DEFAULT NULL,
  `Content` text DEFAULT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `RetweetID` int(6) UNSIGNED DEFAULT NULL,
  `RetweetCount` int(6) DEFAULT 0,
  `LikeCount` int(6) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `UserID` int(6) UNSIGNED NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Avatar` varchar(255) DEFAULT NULL,
  `Bio` text DEFAULT NULL,
  `Location` varchar(100) DEFAULT NULL,
  `Website` varchar(255) DEFAULT NULL,
  `DateJoined` timestamp NOT NULL DEFAULT current_timestamp(),
  `verification_code` varchar(150) NOT NULL,
  `verification_status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Email`, `Password`, `Avatar`, `Bio`, `Location`, `Website`, `DateJoined`, `verification_code`, `verification_status`) VALUES
(1, 'test', 'test@gmail.com', '$2y$10$YOPla0sDtpYloG6K2izfY.dU/2RfXZzZs31dJUCNbS9PeS7c4YLai', NULL, NULL, NULL, NULL, '2024-03-27 10:39:46', '', 0),
(3, 'minzondev', 'minzondev@outlook.com', '$2y$10$.05E00hAY7QT5GrLAB3Ftuk90RKEFBxBnov5z..9RlDJLDh67Ggya', NULL, NULL, NULL, NULL, '2024-04-03 17:06:45', '1a7ede8e1a09f0d54f826e17b7fa5afb', 0),
(4, '', 'minzondev@outlook.com', '$2y$10$HbhFl01rpePb4xU0j6zhDORKSW2kUoPeOIgqdDIb0Z.8M1dX56lVS', NULL, NULL, NULL, NULL, '2024-04-03 17:13:56', 'dfdc271129aabffb900b4b475bbf08ec', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`CommentID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `TweetID` (`TweetID`);

--
-- Chỉ mục cho bảng `followers`
--
ALTER TABLE `followers`
  ADD KEY `FollowerID` (`FollowerID`),
  ADD KEY `FollowingID` (`FollowingID`);

--
-- Chỉ mục cho bảng `hashtags`
--
ALTER TABLE `hashtags`
  ADD PRIMARY KEY (`HashtagID`);

--
-- Chỉ mục cho bảng `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`LikeID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `TweetID` (`TweetID`);

--
-- Chỉ mục cho bảng `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`MessageID`),
  ADD KEY `SenderID` (`SenderID`),
  ADD KEY `ReceiverID` (`ReceiverID`);

--
-- Chỉ mục cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`NotificationID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `SourceUserID` (`SourceUserID`),
  ADD KEY `TweetID` (`TweetID`),
  ADD KEY `CommentID` (`CommentID`),
  ADD KEY `MessageID` (`MessageID`);

--
-- Chỉ mục cho bảng `retweets`
--
ALTER TABLE `retweets`
  ADD PRIMARY KEY (`RetweetID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `OriginalTweetID` (`OriginalTweetID`);

--
-- Chỉ mục cho bảng `tweethashtags`
--
ALTER TABLE `tweethashtags`
  ADD PRIMARY KEY (`TweetHashtagID`),
  ADD KEY `TweetID` (`TweetID`),
  ADD KEY `HashtagID` (`HashtagID`);

--
-- Chỉ mục cho bảng `tweets`
--
ALTER TABLE `tweets`
  ADD PRIMARY KEY (`TweetID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `RetweetID` (`RetweetID`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `CommentID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `hashtags`
--
ALTER TABLE `hashtags`
  MODIFY `HashtagID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `likes`
--
ALTER TABLE `likes`
  MODIFY `LikeID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `messages`
--
ALTER TABLE `messages`
  MODIFY `MessageID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `notifications`
--
ALTER TABLE `notifications`
  MODIFY `NotificationID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `retweets`
--
ALTER TABLE `retweets`
  MODIFY `RetweetID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tweethashtags`
--
ALTER TABLE `tweethashtags`
  MODIFY `TweetHashtagID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tweets`
--
ALTER TABLE `tweets`
  MODIFY `TweetID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`TweetID`) REFERENCES `tweets` (`TweetID`);

--
-- Các ràng buộc cho bảng `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `followers_ibfk_1` FOREIGN KEY (`FollowerID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `followers_ibfk_2` FOREIGN KEY (`FollowingID`) REFERENCES `users` (`UserID`);

--
-- Các ràng buộc cho bảng `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`TweetID`) REFERENCES `tweets` (`TweetID`);

--
-- Các ràng buộc cho bảng `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`SenderID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`ReceiverID`) REFERENCES `users` (`UserID`);

--
-- Các ràng buộc cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`SourceUserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `notifications_ibfk_3` FOREIGN KEY (`TweetID`) REFERENCES `tweets` (`TweetID`),
  ADD CONSTRAINT `notifications_ibfk_4` FOREIGN KEY (`CommentID`) REFERENCES `comments` (`CommentID`),
  ADD CONSTRAINT `notifications_ibfk_5` FOREIGN KEY (`MessageID`) REFERENCES `messages` (`MessageID`);

--
-- Các ràng buộc cho bảng `retweets`
--
ALTER TABLE `retweets`
  ADD CONSTRAINT `retweets_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `retweets_ibfk_2` FOREIGN KEY (`OriginalTweetID`) REFERENCES `tweets` (`TweetID`);

--
-- Các ràng buộc cho bảng `tweethashtags`
--
ALTER TABLE `tweethashtags`
  ADD CONSTRAINT `tweethashtags_ibfk_1` FOREIGN KEY (`TweetID`) REFERENCES `tweets` (`TweetID`),
  ADD CONSTRAINT `tweethashtags_ibfk_2` FOREIGN KEY (`HashtagID`) REFERENCES `hashtags` (`HashtagID`);

--
-- Các ràng buộc cho bảng `tweets`
--
ALTER TABLE `tweets`
  ADD CONSTRAINT `tweets_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `tweets_ibfk_2` FOREIGN KEY (`RetweetID`) REFERENCES `tweets` (`TweetID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
