<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Chirp</title>
  <!-- <link rel="stylesheet" href="../app/assets/css/styles.css" /> -->
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      --twitter-color: #50b7f5;
      --twitter-background: #e6ecf0;
    }

    .sidebarOption {
      display: flex;
      align-items: center;
      cursor: pointer;
    }

    .sidebarOption .material-icons,
    .fa-twitter {
      padding: 20px;
    }

    .sidebarOption h2 {
      font-weight: 800;
      font-size: 20px;
      margin-right: 20px;
    }

    .sidebarOption:hover {
      background-color: var(--twitter-background);
      border-radius: 30px;
      color: var(--twitter-color);
      transition: color 100ms ease-out;
    }

    .sidebarOption.active {
      color: var(--twitter-color);
    }

    .sidebar__tweet {
      width: 100%;
      background-color: var(--twitter-color);
      border: none;
      color: white;
      font-weight: 900;
      border-radius: 30px;
      height: 50px;
      margin-top: 20px;
    }

    body {
      display: flex;
      height: 100vh;
      max-width: 1300px;
      margin-left: auto;
      margin-right: auto;
      padding: 0 10px;
    }

    .sidebar {
      border-right: 1px solid var(--twitter-background);
      flex: 0.2;

      min-width: 250px;
      margin-top: 20px;
      padding-left: 20px;
      padding-right: 20px;
    }

    .fa-twitter {
      color: var(--twitter-color);
      font-size: 30px;
    }

    .post__header {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .post__headerText {
      flex: 1;
      /* Dãn ngang toàn bộ phần bên trái */
    }

    .post__date {
      margin-left: 10px;
      /* Khoảng cách giữa ngày đăng và tên người dùng */
    }


    /* feed */
    .feed {
      flex: 0.5;
      border-right: 1px solid var(--twitter-background);
      min-width: fit-content;
      overflow-y: scroll;
    }

    .feed__header {
      position: sticky;
      top: 0;
      background-color: white;
      z-index: 100;
      border: 1px solid var(--twitter-background);
      padding: 15px 20px;
    }

    .feed__header h2 {
      font-size: 20px;
      font-weight: 800;
    }

    .feed::-webkit-scrollbar {
      display: none;
    }

    .feed {
      -ms-overflow-style: none;
      scrollbar-width: none;
    }

    /* tweet box */
    .tweetbox__input img {
      border-radius: 50%;
      height: 40px;
    }

    .tweetBox {
      padding-bottom: 10px;
      border-bottom: 8px solid var(--twitter-background);
      padding-right: 10px;
    }

    .tweetBox form {
      display: flex;
      flex-direction: column;
    }

    .tweetbox__input {
      display: flex;
      padding: 20px;
    }

    .tweetbox__input input {
      flex: 1;
      margin-left: 20px;
      font-size: 20px;
      border: none;
      outline: none;
    }

    .tweetBox__tweetButton {
      background-color: var(--twitter-color);
      border: none;
      color: white;
      font-weight: 900;

      border-radius: 30px;
      width: 80px;
      height: 40px;
      margin-top: 20px;
      margin-left: auto;
    }

    /* post */
    .post__avatar img {
      border-radius: 50%;
      height: 40px;
    }

    .post {
      display: flex;
      align-items: flex-start;
      border-bottom: 1px solid var(--twitter-background);
      padding-bottom: 10px;
    }

    .post__body img {
      width: 450px;
      object-fit: contain;
      border-radius: 20px;
    }

    .post__footer {
      display: flex;
      justify-content: space-between;
      margin-top: 10px;
    }

    .post__badge {
      font-size: 14px !important;
      color: var(--twitter-color);
      margin-right: 5px;
    }

    .post__headerSpecial {
      font-weight: 600;
      font-size: 12px;
      color: gray;
    }

    .post__headerText h3 {
      font-size: 15px;
      margin-bottom: 5px;
    }

    .post__headerDescription {
      margin-bottom: 10px;
      font-size: 15px;
    }

    .post__body {
      flex: 1;
      padding: 10px;
    }

    .post__avatar {
      padding: 20px;
    }

    /* widgets */
    .widgets {
      flex: 0.3;
    }

    .widgets__input {
      display: flex;
      align-items: center;
      background-color: var(--twitter-background);
      padding: 10px;
      border-radius: 20px;
      margin-top: 10px;
      margin-left: 20px;
    }

    .widgets__input input {
      border: none;
      background-color: var(--twitter-background);
    }

    .widgets__searchIcon {
      color: gray;
    }

    .widgets__widgetContainer {
      margin-top: 15px;
      margin-left: 20px;
      padding: 20px;
      background-color: #f5f8fa;
      border-radius: 20px;
    }

    .widgets__widgetContainer h2 {
      font-size: 18px;
      font-weight: 800;
    }

    .sidebarLink {
      display: flex;
      align-items: center;
      text-decoration: none;
      /* Loại bỏ gạch chân mặc định */
      color: inherit;
      /* Kế thừa màu chữ từ phần tử cha */
    }

    .sidebarLink:hover {
      background-color: var(--twitter-background);
      border-radius: 30px;
      color: var(--twitter-color);
      transition: color 100ms ease-out;
    }

    .container {
      display: flex;
      width: 50%;
      flex-direction: column;
      align-items: center;
    }

    .profile-section {
      width: 100%;
      margin-bottom: 20px;
    }

    .profile-info {
      margin-top: 20px;
    }

    .profile-info p {
      display: flex;
      align-items: center;
    }

    .profile-info p span {
      margin-right: 10px;
    }

    .edit-button {
      display: block;
      margin-top: 20px;
    }

    .feed {
      flex: 1;
      width: 100%;
      background-color: white;
      border-radius: 15px;
      overflow-y: auto;
      padding: 20px;
    }

    /* CSS cho các tweet */
    .tweet {
      border: 1px solid #ccc;
      margin-bottom: 20px;
      padding: 10px;
      border-radius: 5px;
    }

    .tweet-content {
      margin-bottom: 10px;
    }

    .tweet-image img {
      max-width: 100%;
      height: auto;
      display: block;
      margin-top: 10px;
      border-radius: 5px;
    }

    .tweet-actions {
      display: flex;
      justify-content: space-between;
      margin-top: 10px;
    }

    .action-button {
      background-color: #007bff;
      color: #fff;
      border: none;
      padding: 5px 10px;
      border-radius: 3px;
      cursor: pointer;
    }

    .like-button {
      background-color: #28a745;
    }

    .retweet-button {
      background-color: #17a2b8;
    }

    .comment-button {
      background-color: #ffc107;
    }

    /* CSS cho khung đăng bài viết */
    .tweet-section {
      background-color: #f8f9fa;
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 20px;
      margin-bottom: 20px;
    }

    .tweet-section textarea {
      width: 100%;
      padding: 10px;
      box-sizing: border-box;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      resize: vertical;
    }

    .tweet-section input[type="file"] {
      margin-bottom: 10px;
    }

    .tweet-section input[type="submit"] {
      background-color: #007bff;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }

    .tweet-section input[type="submit"]:hover {
      background-color: #0056b3;
    }

    /* CSS cho khung tìm kiếm và kết quả */
    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
    }

    h1,
    h2 {
      font-size: 24px;
      margin-bottom: 10px;
    }

    form {
      margin-bottom: 20px;
    }

    input[type="text"] {
      width: 300px;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
      font-size: 16px;
    }

    button[type="submit"] {
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }

    button[type="submit"]:hover {
      background-color: #0056b3;
    }

    ul {
      list-style-type: none;
      padding: 0;
    }

    ul li {
      margin-bottom: 10px;
    }

    ul li a {
      text-decoration: none;
      display: flex;
      align-items: center;
    }

    .user-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      margin-right: 10px;
    }

    .no-users-found {
      color: #ff0000;
      font-style: italic;
    }
    
  </style>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
    crossorigin="anonymous" />
</head>

<body>
  <!-- sidebar starts -->
  <div class="sidebar">
    <i class="fab fa-twitter"></i>
    <div class="sidebarOption">
      <a href="http://localhost/project_social_php/public/index.php?controller=HomeController&action=index"
        class="sidebarLink">
        <span class="material-icons"> home </span>
        <h2>Home</h2>
      </a>
    </div>

    <div class="sidebarOption">
      <a href="http://localhost/project_social_php/public/index.php?controller=UserController&action=searchPage&error=query"
        class="sidebarLink">
        <span class="material-icons"> search </span>
        <h2>Explore</h2>
      </a>
    </div>

    <div class="sidebarOption">
      <span class="material-icons"> notifications_none </span>
      <h2>Notifications</h2>
    </div>

    <div class="sidebarOption">
      <span class="material-icons"> mail_outline </span>
      <h2>Messages</h2>
    </div>

    <div class="sidebarOption">
      <span class="material-icons"> bookmark_border </span>
      <h2>Bookmarks</h2>
    </div>

    <div class="sidebarOption">
      <span class="material-icons"> list_alt </span>
      <h2>Lists</h2>
    </div>

    <div class="sidebarOption">
      <a href="http://localhost/project_social_php/public/index.php?controller=ProfileController&action=showByUsername&username=minzon"
        class="sidebarLink">
        <span class="material-icons"> perm_identity </span>
        <h2>Profile</h2>
      </a>
    </div>



    <div class="sidebarOption">
      <a href="http://localhost/project_social_php/public/index.php?controller=TweetController&action=show"
        class="sidebarLink">
        <span class="material-icons"> more_horiz </span>
        <h2>More</h2>
      </a>
    </div>
    <button class="sidebar__tweet">Tweet</button>
  </div>
  <!-- sidebar ends -->