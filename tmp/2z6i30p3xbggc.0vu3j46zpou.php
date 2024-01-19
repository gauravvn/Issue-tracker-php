<tr class="issue-filters">
    <td colspan="<?= ($bulkUpdate ? 2 : 1) ?>">
        <?php if (!empty($show_export)): ?>
            <a class="btn btn-default btn-xs" href="<?= ($BASE) ?>/issues/export?<?= (http_build_query($_GET)) ?>">
                <span class="fa fa-save"></span>&ensp;<?= ($dict['export'])."
" ?>
            </a>
        <?php endif; ?>
    </td>
    <td>
        <input type="text" class="form-control input-sm" name="name" value="<?= ($this->esc(@$GET['name'])) ?>">
    </td>
    <td>
        <select class="form-control input-sm" name="type_id">
            <option value="">--</option>
            <?php foreach (($types?:[]) as $item): ?>
                <?php if (!empty($GET['type_id']) && $GET['type_id'] == $item['id']): ?>
                    <option value="<?= ($item['id']) ?>" selected><?= (isset($dict[$item['name']]) ? $dict[$item['name']] : str_replace('_', ' ', $item['name'])) ?></option>
                    <?php else: ?><option value="<?= ($item['id']) ?>"><?= (isset($dict[$item['name']]) ? $dict[$item['name']] : str_replace('_', ' ', $item['name'])) ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
    </td>
    <td>
        <select class="form-control input-sm" name="priority_id">
            <option value="">--</option>
            <?php foreach (($priorities?:[]) as $item): ?>
                <?php if (!empty($GET['priority_id']) && $GET['priority_id'] == $item['id']): ?>
                    <option value="<?= ($item['id']) ?>" selected><?= (isset($dict[$item['name']]) ? $dict[$item['name']] : str_replace('_', ' ', $item['name'])) ?></option>
                    <?php else: ?><option value="<?= ($item['id']) ?>"><?= (isset($dict[$item['name']]) ? $dict[$item['name']] : str_replace('_', ' ', $item['name'])) ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
    </td>
    <td>
        <select class="form-control input-sm" name="status">
            <option value="">--</option>
            <optgroup label="<?= ($dict['general']) ?>">
                <?php if (!empty($GET['status']) && $GET['status'] == 'open'): ?>
                    <option value="open" selected><?= ($dict['open']) ?></option>
                    <?php else: ?><option value="open"><?= ($dict['open']) ?></option>
                <?php endif; ?>
                <?php if (!empty($GET['status']) && $GET['status'] == 'closed'): ?>
                    <option value="closed" selected><?= ($dict['closed']) ?></option>
                    <?php else: ?><option value="closed"><?= ($dict['closed']) ?></option>
                <?php endif; ?>
            </optgroup>
            <optgroup label="<?= ($dict['exact_match']) ?>">
                <?php foreach (($statuses?:[]) as $item): ?>
                    <?php if (!empty($GET['status']) && $GET['status'] == $item['id']): ?>
                        <option value="<?= ($item['id']) ?>" selected><?= (isset($dict[$item['name']]) ? $dict[$item['name']] : str_replace('_', ' ', $item['name'])) ?></option>
                        <?php else: ?><option value="<?= ($item['id']) ?>"><?= (isset($dict[$item['name']]) ? $dict[$item['name']] : str_replace('_', ' ', $item['name'])) ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </optgroup>
        </select>
    </td>
    <td>
        <input type="text" class="form-control input-sm" name="parent_id" data-typeahead="issues" id="filter-input-parent-id" value="<?= ($this->esc(@$GET['parent_id'])) ?>" />
    </td>
    <td>
        <select class="form-control input-sm" name="author_id">
            <option value="">--</option>
            <option value="<?= ($user['id']) ?>"><?= ($this->esc($user['name'])) ?></option>
            <optgroup label="<?= ($dict['groups']) ?>">
                <?php foreach (($groups?:[]) as $item): ?>
                    <?php if (!empty($GET['author_id']) && $GET['author_id'] == $item['id']): ?>
                        <option value="<?= ($item['id']) ?>" selected><?= ($this->esc($item['name'])) ?></option>
                        <?php else: ?><option value="<?= ($item['id']) ?>"><?= ($this->esc($item['name'])) ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </optgroup>
            <optgroup label="<?= ($dict['users']) ?>">
                <?php foreach (($users?:[]) as $item): ?>
                    <?php if (!empty($GET['author_id']) && $GET['author_id'] == $item['id']): ?>
                        <option value="<?= ($item['id']) ?>" selected><?= ($this->esc($item['name'])) ?></option>
                        <?php else: ?><option value="<?= ($item['id']) ?>"><?= ($this->esc($item['name'])) ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </optgroup>
        </select>
    </td>
    <td>
        <select class="form-control input-sm" name="owner_id">
            <option value="">--</option>
            <option value="<?= ($user['id']) ?>"><?= ($this->esc($user['name'])) ?></option>
            <optgroup label="<?= ($dict['groups']) ?>">
                <?php foreach (($groups?:[]) as $item): ?>
                    <?php if (!empty($GET['owner_id']) && $GET['owner_id'] == $item['id']): ?>
                        <option value="<?= ($item['id']) ?>" selected><?= ($this->esc($item['name'])) ?></option>
                        <?php else: ?><option value="<?= ($item['id']) ?>"><?= ($this->esc($item['name'])) ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </optgroup>
            <optgroup label="<?= ($dict['users']) ?>">
                <?php foreach (($users?:[]) as $item): ?>
                    <?php if (!empty($GET['owner_id']) && $GET['owner_id'] == $item['id']): ?>
                        <option value="<?= ($item['id']) ?>" selected><?= ($this->esc($item['name'])) ?></option>
                        <?php else: ?><option value="<?= ($item['id']) ?>"><?= ($this->esc($item['name'])) ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </optgroup>
            <?php if ($user['rank'] >= \Model\User::RANK_MANAGER && !empty($deleted_users)): ?>
                <optgroup label="<?= ($dict['deactivated_users']) ?>">
                    <?php foreach (($deleted_users?:[]) as $item): ?>
                        <?php if (!empty($GET['owner_id']) && $GET['owner_id'] == $item['id']): ?>
                            <option value="<?= ($item['id']) ?>" selected><?= ($this->esc($item['name'])) ?></option>
                            <?php else: ?><option value="<?= ($item['id']) ?>"><?= ($this->esc($item['name'])) ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </optgroup>
            <?php endif; ?>
        </select>
    </td>
    <td>
        <select class="form-control input-sm" name="sprint_id">
            <option value="">--</option>
            <?php if (!empty($GET['sprint_id']) && $GET['sprint_id'] == '-1'): ?>
                <option value="-1" selected><?= ($dict['no_sprint']) ?></option>
                <?php else: ?><option value="-1"><?= ($dict['no_sprint']) ?></option>
            <?php endif; ?>
            <?php foreach (($sprints?:[]) as $item): ?>
                <?php if (!empty($GET['sprint_id']) && $GET['sprint_id'] == $item['id']): ?>
                    <option value="<?= ($item['id']) ?>" selected><?= (date("M j, Y", strtotime($item['start_date']))) ?></option>
                    <?php else: ?><option value="<?= ($item['id']) ?>"><?= (date("M j, Y", strtotime($item['start_date']))) ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php if (!empty($old_sprints)): ?>
                <optgroup label="<?= ($dict['previous_sprints']) ?>">
                    <?php foreach (($old_sprints?:[]) as $item): ?>
                        <?php if (!empty($GET['sprint_id']) && $GET['sprint_id'] == $item['id']): ?>
                            <option value="<?= ($item['id']) ?>" selected><?= (date("M j, Y", strtotime($item['start_date']))) ?></option>
                            <?php else: ?><option value="<?= ($item['id']) ?>"><?= (date("M j, Y", strtotime($item['start_date']))) ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </optgroup>
            <?php endif; ?>
        </select>
    </td>
    <td>
        <select class="form-control input-sm" name="repeat_cycle">
            <option value="">--</option>
            <optgroup label="<?= ($dict['general']) ?>">
                <?php if (!empty($GET['repeat_cycle']) && $GET['repeat_cycle'] == 'repeat'): ?>
                    <option value="repeat" selected><?= ($dict['repeating']) ?></option>
                    <?php else: ?><option value="repeat"><?= ($dict['repeating']) ?></option>
                <?php endif; ?>
                <?php if (empty($GET['repeat_cycle'])): ?>
                    <option value="" selected><?= ($dict['not_repeating']) ?></option>
                    <?php else: ?><option value=""><?= ($dict['not_repeating']) ?></option>
                <?php endif; ?>
            </optgroup>
            <optgroup label="<?= ($dict['exact_match']) ?>">
                <?php if (!empty($GET['repeat_cycle']) && $GET['repeat_cycle'] == 'daily'): ?>
                    <option value="daily" selected><?= ($dict['daily']) ?></option>
                    <?php else: ?><option value="daily"><?= ($dict['daily']) ?></option>
                <?php endif; ?>
                <?php if (!empty($GET['repeat_cycle']) && $GET['repeat_cycle'] == 'weekly'): ?>
                    <option value="weekly" selected><?= ($dict['weekly']) ?></option>
                    <?php else: ?><option value="weekly"><?= ($dict['weekly']) ?></option>
                <?php endif; ?>
                <?php if (!empty($GET['repeat_cycle']) && $GET['repeat_cycle'] == 'monthly'): ?>
                    <option value="monthly" selected><?= ($dict['monthly']) ?></option>
                    <?php else: ?><option value="monthly"><?= ($dict['monthly']) ?></option>
                <?php endif; ?>
                <?php if (!empty($GET['repeat_cycle']) && $GET['repeat_cycle'] == 'quarterly'): ?>
                    <option value="quarterly" selected><?= ($dict['quarterly']) ?></option>
                    <?php else: ?><option value="quarterly"><?= ($dict['quarterly']) ?></option>
                <?php endif; ?>
                <?php if (!empty($GET['repeat_cycle']) && $GET['repeat_cycle'] == 'semi_annually'): ?>
                    <option value="semi_annually" selected><?= ($dict['semi_annually']) ?></option>
                    <?php else: ?><option value="semi_annually"><?= ($dict['semi_annually']) ?></option>
                <?php endif; ?>
                <?php if (!empty($GET['repeat_cycle']) && $GET['repeat_cycle'] == 'annually'): ?>
                    <option value="annually" selected><?= ($dict['annually']) ?></option>
                    <?php else: ?><option value="annually"><?= ($dict['annually']) ?></option>
                <?php endif; ?>
                <?php if (!empty($GET['repeat_cycle']) && $GET['repeat_cycle'] == 'sprint'): ?>
                    <option value="sprint" selected><?= ($dict['sprint']) ?></option>
                    <?php else: ?><option value="sprint"><?= ($dict['sprint']) ?></option>
                <?php endif; ?>
            </optgroup>
        </select>
    </td>
    <td></td>
    <?php if (!empty($GET['status']) && $GET['status'] != 'open'): ?>
        <td></td>
    <?php endif; ?>
    <td class="text-right">
        <noscript>
            <button type="submit" class="btn btn-xs btn-primary"><?= ($dict['submit']) ?></button>
        </noscript>
    </td>
</tr>
