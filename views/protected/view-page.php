<section class="content">
  <main class="main">    <section class="post-section">
      <img src="<?= $imagePath ?>" alt="Post Image" class="main-image" />      <div class="post-content">        <h2 class="main-caption"><?= htmlspecialchars($imageDetails['title'] ?? pathinfo(basename($imagePath), PATHINFO_FILENAME)) ?></h2>
        <p class="author"><?= htmlspecialchars($imageDetails['username'] ?? 'Unknown User') ?></p>
        <div class="tags"><?= htmlspecialchars($imageDetails['description'] ?? '#Photography') ?></div>

        <!-- Comments -->
        <div class="comment-scroll">

          <div class="comment-box">
          <h3 class="comment-author">Lhanz Hubilla</h3>
          <p class="comment-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          </div>

          <div class="comment-box">
            <h3 class="comment-author">Lhanz Hubilla</h3>
            <p class="comment-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          </div>

          <div class="comment-box">
            <h3 class="comment-author">Lhanz Hubilla</h3>
            <p class="comment-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          </div>

          <div class="comment-box">
            <h3 class="comment-author">Lhanz Hubilla</h3>
            <p class="comment-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          </div>
        </div>
        <!-- Comment Input -->
        <div class="comment-input-box">
          <input type="text" placeholder="Comment here as Lhanz Hubilla" />
        </div>
      </div>
    </section>
  </main>
</section>
