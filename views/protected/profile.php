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
    <div class="modal-box">
        <h3 class="text-lg font-bold">Hello!</h3>
        <p class="py-4">PANO NA YUNG SUNOD</p>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>