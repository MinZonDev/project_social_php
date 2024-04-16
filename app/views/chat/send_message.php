<?php
// send_message.php

// Xử lý gửi tin nhắn từ người dùng
// Lấy dữ liệu từ POST request
$senderID = $_POST['senderID'];
$receiverID = $_POST['receiverID'];
$messageContent = $_POST['message'];

// Gửi tin nhắn đến người nhận, lưu vào cơ sở dữ liệu, v.v.
// Code xử lý gửi tin nhắn ở đây

// Ví dụ trả về một phản hồi JSON nếu cần
$response = array('status' => 'success');
echo json_encode($response);
