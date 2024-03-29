<tr data-id="<?= ($item['id']) ?>" class="<?= ($item['status_closed'] ? 'closed' : '') ?>">
    <?php if ($bulkUpdate): ?>
        <td><input type="checkbox" name="id[]" value="<?= ($item['id']) ?>"></td>
    <?php endif; ?>
    <td><a href="<?= ($BASE) ?>/issues/<?= ($item['id']) ?>" class="<?= ($item['status_closed'] ? 'text-muted' : '') ?>"><?= ($item['id']) ?></a></td>
    <td><a href="<?= ($BASE) ?>/issues/<?= ($item['id']) ?>" class="<?= ($item['status_closed'] ? 'text-muted' : '') ?>"><?= ($this->esc($item['name'])) ?></a></td>
    <td><?= (isset($dict[$item['type_name']]) ? $dict[$item['type_name']] : str_replace('_', ' ', $item['type_name'])) ?></td>
    <td><?= (isset($dict[$item['priority_name']]) ? $dict[$item['priority_name']] : str_replace('_', ' ', $item['priority_name'])) ?></td>
    <td><?= (isset($dict[$item['status_name']]) ? $dict[$item['status_name']] : str_replace('_', ' ', $item['status_name'])) ?></td>
    <td><?= ($item['parent_id'] ?: '') ?></td>
    <?php if ($item['author_username']): ?>
        
            <td><a href="<?= ($BASE) ?>/user/<?= ($item['author_username']) ?>" rel="author"><?= ($this->esc($item['author_name'])) ?></a></td>
        
        <?php else: ?>
            <td><?= ($this->esc($item['author_name'])) ?></td>
        
    <?php endif; ?>
    <?php if ($item['owner_username']): ?>
        
            <td><a href="<?= ($BASE) ?>/user/<?= ($item['owner_username']) ?>"><?= ($this->esc($item['owner_name'])) ?></a></td>
        
        <?php else: ?>
            <td><?= ($this->esc($item['owner_name'])) ?></td>
        
    <?php endif; ?>
    <td><?= (!empty($item['sprint_start_date']) ? date("n/j/y", strtotime($item['sprint_start_date'])) : "") ?></td>
    <td><?= (isset($dict[$item['repeat_cycle']]) ? ucwords($dict[$item['repeat_cycle']]) : $dict['not_repeating']) ?></td>
    <td title="<?= (date('Y-m-d H:i:s', $this->utc2local($item['created_date']))) ?>"><?= (date("n/j/y", $this->utc2local($item['created_date']))) ?></td>
    <td><?= (!empty($item['due_date']) ? date("n/j/y", strtotime($item['due_date'])) : "") ?></td>
    <?php if (!empty($GET['status']) && $GET['status'] != 'open'): ?>
        <td><?= (!empty($item['closed_date']) ? date("n/j/y", $this->utc2local($item['closed_date'])) : "") ?></td>
    <?php endif; ?>
</tr>
