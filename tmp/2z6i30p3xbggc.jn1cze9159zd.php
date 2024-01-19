<div class="list-group issue-list-group">
    <?php foreach (($issues?:[]) as $item): ?>
        <a class="list-group-item" href="<?= ($BASE) ?>/issues/<?= ($item['id']) ?>">
            <span class="badge status"><?= ($this->esc(isset($dict[$item['status_name']]) ? $dict[$item['status_name']] : str_replace('_', ' ', $item['status_name']))) ?></span>
            <?php if ($item['owner_id'] != $user['id']): ?>
                <p class="pull-right badge-sibling hidden-xs group has-tooltip" title="<?= ($dict['cols']['assignee']) ?>">
                    <span class="fa fa-user"></span>&ensp;<?= ($this->esc($item['owner_name']))."
" ?>
                </p>
            <?php endif; ?>
            <?php if ($item['repeat_cycle']): ?>
                <p class="pull-right badge-sibling hidden-xs group has-tooltip" title="<?= ($dict['cols']['repeat_cycle']) ?>">
                    <span class="fa fa-repeat"></span>&ensp;<?= ($dict[$item['repeat_cycle']] ?: $item['repeat_cycle'])."
" ?>
                </p>
            <?php endif; ?>
            <p class="list-group-item-heading">
                #<?= ($item['id']) ?> - <?= ($this->esc($item['name']))."
" ?>
                <?php if ($item['priority'] != 0): ?>
                    <span class="label-<?= ($item['priority'] < 0 ? 'default' : 'danger') ?> priority" style="width: <?= (!$item['priority'] ? 0 : 1 + 1 * abs($item['priority'])) ?>px;"></span>
                <?php endif; ?>
            </p>
            <?php if (!empty($item['due_date']) && strtotime($item['due_date'])): ?>
                <p class="list-group-item-text">Due <?= (date("l, F j", strtotime($item['due_date']))) ?></p>
            <?php endif; ?>
            <?php if ($item['sprint_id']): ?>
                <?php $sprint_date_range=date('M j-', strtotime($item['sprint_start_date'])); ?>
                <?php if(date('Ym', strtotime($item['sprint_start_date'])) == date('Ym', strtotime($item['sprint_end_date']))) {
                        $sprint_date_range = $sprint_date_range . date('j', strtotime($item['sprint_end_date']));
                    } else {
                        $sprint_date_range = $sprint_date_range . date('M j', strtotime($item['sprint_end_date']));
                    } ?>
                <p class="list-group-item-text text-muted">
                    <span class="has-tooltip" title="<?= ($dict['sprint']) ?> #<?= ($item['sprint_id']) ?>: <?= ($sprint_date_range) ?>"><?= ($this->esc($item['sprint_name'])) ?></span>
                    <?php if ($item['type_id'] == $issue_type['project'] && $item['parent_id']): ?>
                        &mdash; <span class="has-tooltip" title="<?= ($dict['parent_project']) ?>"><?= (Base::instance()->format($dict['under_n'], '#' . $item['parent_id'] . ' - ' . @$item['parent_name'])) ?></span>
                    <?php endif; ?>
                </p>
            <?php endif; ?>
        </a>
    <?php endforeach; ?>
    <?php if (!count($issues)): ?>
        <li class="list-group-item disabled"><?= ($dict['no_matching_issues']) ?></li>
    <?php endif; ?>
</div>
