<p>
    <?php if ($parent['type_id'] == $issue_type['project']): ?>
        <a class="btn btn-default btn-sm" href="<?= ($BASE) ?>/issues/new/<?= ($issue_type['project']) ?>/<?= ($parent['id']) ?>"><?= ($dict['new_sub_project']) ?></a>
    <?php endif; ?>
    <a class="btn btn-default btn-sm" href="<?= ($BASE) ?>/issues/new/<?= ($issue_type['task']) ?>/<?= ($parent['id']) ?>"><?= ($dict['new_task']) ?></a>
    <a class="btn btn-default btn-sm" href="<?= ($BASE) ?>/issues?parent_id=<?= ($parent['id']) ?>"><?= ($dict['browse']) ?></a>
    <span class="hidden-xs">&ensp;<?= (Base::instance()->format($dict['under_n'],'<a href="' . $BASE . '/issues/' . $parent['id'] . '">#' . $parent['id'] . ' ' . $this->esc($parent['name']) . '</a>')) ?></span>
</p>

<?php if (!empty($issues)): ?>
    
        <div class="table-responsive">
            <table class="table table-striped table-condensed issue-list">
                <thead>
                    <tr>
                        <th data-sort="int"><?= ($dict['cols']['id']) ?></th>
                        <th data-sort="string"><?= ($dict['cols']['title']) ?></th>
                        <th data-sort="string"><?= ($dict['cols']['author']) ?></th>
                        <th data-sort="string"><?= ($dict['cols']['assignee']) ?></th>
                        <th data-sort="int"><?= ($dict['cols']['created']) ?></th>
                        <th data-sort="int"><?= ($dict['cols']['priority']) ?></th>
                        <th data-sort="int"><?= ($dict['cols']['due']) ?></th>
                        <th data-sort="int"><?= ($dict['cols']['status']) ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (($issues?:[]) as $item): ?>
                        <tr data-id="<?= ($item['id']) ?>" class="<?= ($item['status_closed'] ? 'closed' : '') ?>">
                            <td><a href="<?= ($BASE) ?>/issues/<?= ($item['id']) ?>" class="<?= ($item['status_closed'] ? 'text-muted' : '') ?>"><?= ($item['id']) ?></a></td>
                            <td><a href="<?= ($BASE) ?>/issues/<?= ($item['id']) ?>" class="<?= ($item['status_closed'] ? 'text-muted' : '') ?>"><?= ($this->esc($item['name'])) ?></a></td>
                            <td><a href="<?= ($BASE) ?>/user/<?= ($item['author_username']) ?>"><?= ($this->esc($item['author_name'])) ?></a></td>
                            <td><a href="<?= ($BASE) ?>/user/<?= ($item['owner_username']) ?>"><?= ($this->esc($item['owner_name'])) ?></a></td>
                            <td data-sort-value="<?= (strtotime($item['created_date'])) ?>" title="<?= (date('Y-m-d H:i:s', strtotime($item['created_date']))) ?>"><?= (date("n/j/y", strtotime($item['created_date']))) ?></td>
                            <td data-sort-value="<?= ($item['priority']) ?>"><?= ($this->esc($item['priority_name'])) ?></td>
                            <td data-sort-value="<?= ($item['due_date'] ? strtotime($item['due_date']) : 0) ?>"><?= (!empty($item['due_date']) ? date("n/j", strtotime($item['due_date'])) : "") ?></td>
                            <td data-sort-value="<?= ($item['status']) ?>"><?= ($this->esc($item['status_name'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    
    <?php else: ?>
        <p class="text-center text-muted"><?= ($dict['no_related_issues']) ?></p>
    
<?php endif; ?>
