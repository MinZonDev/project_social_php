<?php
// get_messages.php

// Xử lý lấy tin nhắn từ cơ sở dữ liệu
// Lấy dữ liệu từ GET request
$senderID = $_GET['senderID'];
$receiverID = $_GET['receiverID'];

// Lấy tin nhắn từ cơ sở dữ liệu giữa hai người dùng
// Code xử lý lấy tin nhắn ở đây và trả về dưới dạng JSON
$messages = array(
    array('sender' => 'User 1', 'content' => 'Hello'),
    array('sender' => 'User 2', 'content' => 'Hi there'),
    // Thêm các tin nhắn khác vào đây
);

// Trả về tin nhắn dưới dạng JSON
echo json_encode($messages);
