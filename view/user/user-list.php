<?php foreach ($users as $user) : ?>
<div class="user">
    <?= $user->getGravatar(true) ?>
    <?= $user->username ?>
</div>
<?php endforeach; ?>
