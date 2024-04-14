* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
  background-color: #f0f3f5;
}

.sidebar {
  background-color: #ffffff;
  border-right: 1px solid #dfe3e6;
  padding: 20px;
}

.sidebar .sidebarOption {
  display: flex;
  align-items: center;
  padding: 10px 0;
  transition: background-color 0.3s;
}

.sidebar .sidebarOption:hover {
  background-color: #f5f8fa;
  border-radius: 30px;
}

.sidebar .sidebarOption a {
  text-decoration: none;
  color: inherit;
  display: flex;
  align-items: center;
}

.sidebar .sidebarOption .material-icons,
.fa-twitter {
  font-size: 24px;
  margin-right: 10px;
}

.sidebar .sidebar__tweet {
  width: 100%;
  background-color: #1da1f2;
  border: none;
  color: white;
  font-weight: 800;
  border-radius: 9999px;
  padding: 15px 20px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.sidebar .sidebar__tweet:hover {
  background-color: #1991db;
}

.feed {
  background-color: #ffffff;
  border-radius: 15px;
  padding: 20px;
  margin-left: 20px;
}

.feed__header {
  border-bottom: 1px solid #dfe3e6;
  padding-bottom: 10px;
  margin-bottom: 20px;
}

.feed__header h2 {
  font-size: 20px;
  font-weight: 800;
}

.tweetBox {
  border-bottom: 8px solid #f0f3f5;
  padding-bottom: 20px;
}

.tweetBox form {
  display: flex;
  align-items: center;
}

.tweetBox__input img {
  border-radius: 50%;
  height: 40px;
}

.tweetBox__input input {
  flex: 1;
  margin-left: 20px;
  font-size: 18px;
  padding: 10px;
  border: none;
  border-radius: 20px;
  background-color: #f5f8fa;
}

.tweetBox__tweetButton {
  background-color: #1da1f2;
  border: none;
  color: white;
  font-weight: 800;
  border-radius: 9999px;
  padding: 15px 20px;
  margin-left: auto;
  cursor: pointer;
  transition: background-color 0.3s;
}

.tweetBox__tweetButton:hover {
  background-color: #1991db;
}

.post {
  border-bottom: 1px solid #dfe3e6;
  padding-bottom: 20px;
  margin-bottom: 20px;
}

.post__avatar img {
  border-radius: 50%;
  height: 40px;
}

.post__headerText h3 {
  font-size: 16px;
  font-weight: 800;
  margin-bottom: 5px;
}

.post__headerSpecial {
  font-size: 14px;
  color: #657786;
}

.post__headerDescription {
  font-size: 14px;
  color: #657786;
  margin-bottom: 10px;
}

.post__body img {
  max-width: 100%;
  border-radius: 15px;
  margin-top: 10px;
}

.post__footer {
  display: flex;
  align-items: center;
}

.post__footer .material-icons {
  font-size: 20px;
  margin-right: 10px;
  color: #657786;
  cursor: pointer;
}

.widgets {
  background-color: #ffffff;
  padding: 20px;
  border-radius: 15px;
}

.widgets__input {
  background-color: #f5f8fa;
  border-radius: 20px;
  padding: 10px;
  margin-bottom: 20px;
}

.widgets__input input {
  border: none;
  background-color: transparent;
  outline: none;
  font-size: 16px;
  color: #1da1f2;
}

.widgets__searchIcon {
  color: #657786;
}

.widgets__widgetContainer {
  background-color: #f5f8fa;
  border-radius: 15px;
  padding: 20px;
  margin-bottom: 20px;
}

.widgets__widgetContainer h2 {
  font-size: 18px;
  font-weight: 800;
  margin-bottom: 10px;
}

.sidebarLink:hover {
  background-color: #f5f8fa;
  border-radius: 30px;
  color: #1da1f2;
  transition: color 0.3s;
}
