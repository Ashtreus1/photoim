<div class="cover-photo-container">
    <img class="cover-photo" src="design/photos/cover2.webp" alt="Cover Photo">
</div>
<main class="profile-content">
    <div class="profile-header-wrapper">
        <div class="profile-picture-wrapper">
            <img class="profile-picture" src="<?= isset($userData['avatar_path']) && $userData['avatar_path'] ? basePath('/' . ltrim($userData['avatar_path'], '/')) : basePath('/assets/images/user/avatar1.png') ?>" alt="Profile Picture">
        </div>

        <div class="profile-details">
            <div class="profile-info">
                <div class="profile-text">
                    <h1><?= htmlspecialchars($userData['username']) ?></h1>
                </div>
            </div>

            <div class="profile-actions">
                <button class="edit-profile-button btn" onclick="my_modal_2.showModal()">
                    <div class="edit-icon"><span class="material-symbols-outlined">edit</span></div>
                    <span>Edit Profile</span>
                </button>
            </div>
        </div>
    </div>


    <nav class="profile-nav">
        <div>Post</div>
        <div>Pins</div>
        <div>About</div>
    </nav>

    <hr class="divider">

    <section class="posts">
        <div class="post">
            <img src="design/photos/post1.webp" alt="Post Image">
            <div class="caption-details">
                <div class="caption-text">
                    <div class="caption">My brother died IJBOL</div>
                    <div class="tags">#Deadge #LOL #2Gether4Ever</div>
                </div>
                
                <div class="likes">
                    <div class="like-icon"><span class="material-symbols-outlined">favorite</span></div>
                    <span>4.3k</span>
                </div>
            </div>
        </div>

        <div class="post">
            <img src="design/photos/user_profile.jpg" alt="Post Image">
            <div class="caption-details">
                <div class="caption-text">
                    <div class="caption">New profile pic</div>
                    <div class="tags">#Pfp #pics</div>
                </div>
                
                <div class="likes">
                    <div class="like-icon"><span class="material-symbols-outlined">favorite</span></div>
                    <span>4.3k</span>
                </div>
            </div>
        </div>
    </section>
</main>

<dialog id="my_modal_2" class="modal">
  <div class="modal-box w-full max-w-md">
    <h3 class="text-lg font-bold mb-4">Edit Profile</h3>

    <form action="/photoim/public/update-profile.php" method="POST" enctype="multipart/form-data" class="space-y-4">

      <!-- Username -->
      <div>
        <label for="username" class="block mb-1 font-medium">Username</label>
        <input
          type="text"
          id="username"
          name="username"
          value="<?= htmlspecialchars($userData['username']) ?>"
          class="w-full border px-3 py-2 rounded"
          required
        />
      </div>

      <!-- Email (read-only) -->
      <div>
        <label for="email" class="block mb-1 font-medium">Email</label>
        <input
          type="email"
          id="email"
          name="email"
          value="<?= isset($userData['email']) ? htmlspecialchars($userData['email']) : '' ?>"
          class="w-full border px-3 py-2 rounded bg-gray-100"
          readonly
        />
      </div>

      <!-- Profile Picture -->
      <div>
        <label for="avatar" class="block mb-1 font-medium">Profile Picture</label>
        <input
          type="file"
          id="avatar"
          name="avatar"
          accept="image/*"
          class="w-full"
        />
      </div>

      <!-- Cover Photo -->
      <div>
        <label for="cover" class="block mb-1 font-medium">Cover Photo</label>
        <input
          type="file"
          id="cover"
          name="cover"
          accept="image/*"
          class="w-full"
        />
      </div>

      <!-- Submit Button -->
      <div class="flex justify-end gap-2 pt-4">
        <form method="dialog">
          <button class="btn bg-gray-200">Cancel</button>
        </form>
        <button type="submit" class="btn bg-blue-600 text-white">Save Changes</button>
      </div>
    </form>
  </div>

  <form method="dialog" class="modal-backdrop">
    <button>close</button>
  </form>
</dialog>
