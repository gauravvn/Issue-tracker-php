<li class="list-group-item <?= ($project['status_closed'] ? 'completed' : '') ?>" style="border-left: 4px solid #<?= ($project['owner_task_color']) ?>;" data-id="<?= ($project['id']) ?>" data-type-id="<?= ($project['type_id']) ?>" data-user-id="<?= ($project['owner_id']) ?>" data-points="<?= ($project['size_estimate']) ?>">
    <span class="badge"><?= ($project['priority_name']) ?></span>
    <span class="title">
        <?= ($project['type_name'])."
" ?>
        <a href="<?= ($BASE) ?>/issues/<?= ($project['id']) ?>" target="_blank">#<?= ($project['id']) ?></a>&ensp;
        <?= ($this->esc($project['name']))."
" ?>
        <?php if ($project['size_estimate']): ?>
         - <?= ($project['size_estimate'])."
" ?>
        <?php endif; ?>
    </span>
</li>
