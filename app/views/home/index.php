<?php 
    include '../app/assets/layout/header.php';
?>
<!-- feed starts -->
    <div class="feed">
      <div class="feed__header">
        <h2>Home</h2>
      </div>

      <!-- tweetbox starts -->
      <div class="tweetBox">
        <form>
          <div class="tweetbox__input">
            <img
              src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png"
              alt=""
            />
            <input type="text" placeholder="What's happening?" />
          </div>
          <button class="tweetBox__tweetButton">Tweet</button>
        </form>
      </div>
      <!-- tweetbox ends -->

      <!-- post starts -->
      <div class="post">
        <div class="post__avatar">
          <img
            src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png"
            alt=""
          />
        </div>

        <div class="post__body">
          <div class="post__header">
            <div class="post__headerText">
              <h3>
                Somanath Goudar
                <span class="post__headerSpecial"
                  ><span class="material-icons post__badge"> verified </span>@somanathg</span
                >
              </h3>
            </div>
            <div class="post__headerDescription">
              <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
            </div>
          </div>
          <img
            src="https://www.focus2move.com/wp-content/uploads/2020/01/Tesla-Roadster-2020-1024-03.jpg"
            alt=""
          />
          <div class="post__footer">
            <span class="material-icons"> repeat </span>
            <span class="material-icons"> favorite_border </span>
            <span class="material-icons"> publish </span>
          </div>
        </div>
      </div>
      <!-- post ends -->

      <!-- post starts -->
      <div class="post">
        <div class="post__avatar">
          <img
            src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png"
            alt=""
          />
        </div>

        <div class="post__body">
          <div class="post__header">
            <div class="post__headerText">
              <h3>
                Somanath Goudar
                <span class="post__headerSpecial"
                  ><span class="material-icons post__badge"> verified </span>@somanathg</span
                >
              </h3>
            </div>
            <div class="post__headerDescription">
              <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
            </div>
          </div>
          <img
            src="https://www.focus2move.com/wp-content/uploads/2020/01/Tesla-Roadster-2020-1024-03.jpg"
            alt=""
          />
          <div class="post__footer">
            <span class="material-icons"> repeat </span>
            <span class="material-icons"> favorite_border </span>
            <span class="material-icons"> publish </span>
          </div>
        </div>
      </div>
      <!-- post ends -->
    </div>
    <!-- feed ends -->
<?php 
    include '../app/assets/layout/footer.php';
?>