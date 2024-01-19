<ul class="nav nav-tabs">
    <li class="<?= ($PATH == '/admin' ? 'active':'') ?>"><a href="<?= ($BASE) ?>/admin/"><?= ($dict['overview']) ?></a></li>
    <?php if ($user['rank'] >= \Model\User::RANK_SUPER): ?>
        <li class="<?= (strpos($PATH, 'config') ? 'active':'') ?>"><a href="<?= ($BASE) ?>/admin/config"><?= ($dict['configuration']) ?></a></li>
    <?php endif; ?>
    <li class="<?= (strpos($PATH, 'plugins') ? 'active':'') ?>"><a href="<?= ($BASE) ?>/admin/plugins"><?= ($dict['plugins']) ?></a></li>
    <li class="<?= (strpos($PATH, 'users') ? 'active':'') ?>"><a href="<?= ($BASE) ?>/admin/users"><?= ($dict['users']) ?></a></li>
    <li class="<?= (strpos($PATH, 'groups') ? 'active':'') ?>"><a href="<?= ($BASE) ?>/admin/groups"><?= ($dict['groups']) ?></a></li>
    <li class="<?= (strpos($PATH, 'sprints') ? 'active':'') ?>"><a href="<?= ($BASE) ?>/admin/sprints"><?= ($dict['sprints']) ?></a></li>
</ul>
