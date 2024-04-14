<?php
// like_tweet.php

// Kiểm tra xem yêu cầu có phải là yêu cầu POST không và có chứa tweet_id không
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tweet_id'])) {
    // Lấy tweet_id từ yêu cầu POST
    $tweetId = $_POST['tweet_id'];

    // Thực hiện logic để cập nhật số lượng lượt thích trong cơ sở dữ liệu
    // Ví dụ:
    // Cập nhật số lượng lượt thích trong cơ sở dữ liệu tương ứng với tweet_id

    // Sau khi cập nhật thành công, trả về số lượng lượt thích mới
    $newLikeCount = 10; // Thay thế 10 bằng số lượng lượt thích mới từ cơ sở dữ liệu
    echo $newLikeCount;
} else {
    // Trả về lỗi nếu yêu cầu không hợp lệ
    http_response_code(400);
    echo "Bad request";
}
?>
