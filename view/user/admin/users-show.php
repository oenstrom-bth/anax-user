<div class="show-users">
    <h1>All users</h1>
    <table>
        <thead>
            <tr>
                <th></th>
                <th>Role</th>
                <th>Username</th>
                <th>Email</th>
                <th>Created</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
            <tr>
                <td>
                    <a href="<?= $this->url("user/admin/users/update/{$user->id}") ?>">Edit</a>
                    <a href="<?= $this->url("user/admin/users/delete/{$user->id}") ?>" onclick="return confirm('Are you sure?')">X</a>
                </td>
                <td><?= $user->role ?></td>
                <td><?= $user->username ?></code></td>
                <td><?= $user->email ?></td>
                <td><?= $user->created ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
