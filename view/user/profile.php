<div class="profile-form">
    <h2>Din profil</h2>
    <?= $gravatar ?>
    <?= $form ?>
</div>

<div class="profile-links">
    <h2>Links</h2>
    <ul>
        <li><a href="<?= $this->url("user/logout") ?>">Logga ut</a></li>
    </ul>
</div>
