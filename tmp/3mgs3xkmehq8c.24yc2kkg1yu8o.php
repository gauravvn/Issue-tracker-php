<tr>
    <td colspan="2">
        <?= (str_repeat("&emsp;", $level))."
" ?>
        <?= ($issue['id']) ?> &ndash;
        <?php if ($issue['closed_date']): ?>
            
                <a href="<?= ($BASE) ?>/issues/<?= ($issue['id']) ?>" class="text-muted"><s><?= ($this->esc($issue['name'])) ?></s></a>
            
            <?php else: ?>
                <a href="<?= ($BASE) ?>/issues/<?= ($issue['id']) ?>"><?= ($this->esc($issue['name'])) ?></a>
            
        <?php endif; ?>
    </td>
    <td><?= ($issue['type_name']) ?></td>
    <td><?= ($issue['owner_name']) ?></td>
    <td><?= ($issue['author_name']) ?></td>
    <td><?= ($issue['priority_name']) ?></td>
    <td>
        <?php if ($issue['due_date']): ?>
            
            <?= (date("n/j/y", strtotime($issue['due_date'])))."
" ?>
            
            <?php else: ?>
                <?php if ($issue['sprint_end_date']): ?>
                    <?= (date("n/j/y", strtotime($issue['sprint_end_date'])))."
" ?>
                <?php endif; ?>
            
        <?php endif; ?>
    </td>
    <td>
        <?php if ($issue['sprint_start_date']): ?>
            <?= (date("n/j/y", strtotime($issue['sprint_start_date'])))."
" ?>
        <?php endif; ?>
    </td>
    <td><?= ($issue['hours_spent']) ?></td>
</tr>
