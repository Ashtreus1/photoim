<div class="flex flex-wrap justify-center items-center gap-4 p-10">
  	<a 
	    href="<?= basePath('/creation-post') ?>"
      <button class="btn bg-blue-600 shadow-none border-none text-gray-200">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
        <path fill="currentColor" d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2z" />
        </svg>
        New Post
      </button>
    </a>
  <label class="input rounded-full bg-transparent border border-gray-200">
    <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
      <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor">
        <circle cx="11" cy="11" r="8"></circle>
        <path d="m21 21-4.3-4.3"></path>
      </g>
    </svg>
    <input type="search" class="bg-transparent focus:outline-none" placeholder="Search" />
  </label>

  <div class="flex flex-wrap items-center gap-2">
    <a href="<?= basePath('/feed') ?>">
      <button class="px-4 py-1 bg-transparent rounded-full hover:bg-blue-600 cursor-pointer transition-colors duration-300<?= empty($selectedTag) || $selectedTag === 'All' ? ' bg-blue-600 text-white' : '' ?>">
        All
      </button>
    </a>
    <?php
    $limit = 6;
    foreach (array_slice($tags, 0, $limit) as $tag):
      $isActive = isset($selectedTag) && $selectedTag === $tag;
      ?>
      <a href="<?= basePath('/feed?tag=') . urlencode($tag) ?>">
        <button class="px-4 py-1 bg-transparent rounded-full hover:bg-blue-600 cursor-pointer transition-colors duration-300<?= $isActive ? ' bg-blue-600 text-white' : '' ?>">
          <?= htmlspecialchars($tag) ?>
        </button>
      </a>
    <?php endforeach; ?>
    <?php if (count($tags) > $limit): ?>
      <div class="relative group">
        <button class="px-4 py-1 bg-transparent rounded-full hover:bg-blue-600 transition-colors duration-300">
          More
        </button>
        <div class="absolute z-10 invisible opacity-0 translate-y-2 group-hover:visible group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 bg-gray-200 border rounded shadow-md p-2">
          <?php foreach (array_slice($tags, $limit) as $tag):
            $isActive = isset($selectedTag) && $selectedTag === $tag;
            ?>
            <a href="<?= basePath('/feed?tag=') . urlencode($tag) ?>">
              <div class="px-2 py-1 hover:bg-blue-600 cursor-pointer transition-colors duration-300<?= $isActive ? ' bg-blue-600 text-white' : '' ?>">
                <?= htmlspecialchars($tag) ?>
              </div>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
  <?php if (!empty($selectedTag) && $selectedTag !== 'All'): ?>
    <div class="w-full text-center my-4">
      <span class="inline-block px-4 py-2 rounded-full bg-blue-600 text-white font-semibold text-lg">
        Showing images for tag: <?= htmlspecialchars($selectedTag) ?>
      </span>
    </div>
  <?php endif; ?>
</div>

<div class="m-10 p-6 grid grid-cols-2 md:grid-cols-4 gap-6">
  <?php
    if (!empty($images)) {
      $columns = array_chunk($images, ceil(count($images) / 4));
      foreach ($columns as $column) {
        echo '<div class="grid gap-4 cursor-pointer">';
        foreach ($column as $image) {
          $imagePath = $image['image_path'];

  ?>
          <div class="relative group overflow-hidden rounded-lg mb-6 bg-white shadow">
            <a href="<?= basePath('/view-page?image=' . urlencode($imagePath)) ?>">
              <img class="transition-transform duration-300 group-hover:scale-105"
                  style="max-width:100%; height:auto; display:block; margin:0 auto;"
                  src="<?= htmlspecialchars($imagePath) ?>"
                  alt="<?= htmlspecialchars($title) ?>">
            </a>
          </div>
  <?php
        }
        echo '</div>';
      }
    }
  ?>
</div>

