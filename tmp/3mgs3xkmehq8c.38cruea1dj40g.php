<form id="edit-form" class="form-horizontal well" action="<?= ($BASE) ?>/issues/save" method="post">
    <input type="hidden" name="csrf-token" value="<?= $this->esc($csrf_token) ?>" />
    <?php if (!empty($issue)): ?>
        <a href="<?= ($BASE) ?>/issues/<?= ($issue['id']) ?>" class="close"><span aria-hidden="true">&times;</span><span class="sr-only"><?= ($dict['close']) ?></span></a>
        <input type="hidden" name="id" value="<?= ($issue['id']) ?>">
        <input type="hidden" name="hash_state" value="<?= ($this->esc(json_encode($issue->hashState()))) ?>">
    <?php endif; ?>
    <input type="hidden" name="type_id" value="<?= ($type['id']) ?>">
    <?php if (empty($issue)): ?>
        
            <h3><?= (Base::instance()->format($dict['new_n'], isset($dict[$type['name']]) ? $dict[$type['name']] : str_replace('_', ' ', $type['name']))) ?></h3>
            <?php if (!empty($parent)): ?>
                <h6><?= (Base::instance()->format($dict['under_n'], $parent['name'])) ?></h6>
            <?php endif; ?>
        
        <?php else: ?>
            <h3><?= (Base::instance()->format($dict['edit_n'], isset($dict[$type['name']]) ? $dict[$type['name']] : str_replace('_', ' ', $type['name']))) ?></h3>
        
    <?php endif; ?>
    <div class="form-group">
        <label class="col-md-2 control-label"><?= ($dict['cols']['title']) ?></label>
        <div class="col-md-7">
            <input type="text" class="form-control" name="name" value="<?= ($this->esc(empty($issue) ? '' : $issue['name'])) ?>" autocomplete="off" required>
        </div>
        <label class="col-md-2 control-label label-sm"><?= ($dict['cols']['size_estimate']) ?></label>
        <div class="col-md-1">
            <input type="text" class="form-control" name="size_estimate" value="<?= (@$issue['size_estimate']) ?>" autocomplete="off" maxlength="20">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label label-sm"><?= ($dict['cols']['description']) ?></label>
        <div class="col-md-10">
            <textarea class="form-control input-sm" name="description" rows="7"><?= ($this->esc(empty($issue) ? $type['default_description'] : $issue['description'])) ?></textarea>
        </div>
    </div>
    <?php if (!empty($issue)): ?>
        <div class="form-group">
            <label class="col-md-2 control-label label-sm"><?= ($dict['cols']['type']) ?></label>
            <div class="col-md-10">
                <select class="form-control input-sm" name="type_id">
                    <?php foreach (($issue_types?:[]) as $item): ?>
                        <option value="<?= ($item['id']) ?>" <?= ($issue['type_id'] == $item['id'] ? "selected" : '') ?>><?= ($this->esc(isset($dict[$item['name']]) ? $dict[$item['name']] : str_replace('_', ' ', $item['name']))) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    <?php endif; ?>
    <div class="form-group">
        <label class="col-md-2 control-label label-sm"><?= ($dict['cols']['priority']) ?></label>
        <div class="col-md-10">
            <select class="form-control input-sm" name="priority">
                <?php foreach (($priorities?:[]) as $item): ?>
                    <?php if (empty($issue) || !isset($issue['priority'])): ?>
                        
                            <option value="<?= ($item['value']) ?>" <?= ($item['value'] == $issue_priority['default'] ? "selected" : '') ?>><?= ($this->esc(isset($dict[$item['name']]) ? $dict[$item['name']] : str_replace('_', ' ', $item['name']))) ?></option>
                        
                        <?php else: ?>
                            <option value="<?= ($item['value']) ?>" <?= ($issue['priority'] == $item['value'] ? "selected" : '') ?>><?= ($this->esc(isset($dict[$item['name']]) ? $dict[$item['name']] : str_replace('_', ' ', $item['name']))) ?></option>
                        
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label label-sm"><?= ($dict['cols']['status']) ?></label>
        <div class="col-md-10">
            <select class="form-control input-sm" name="status">
                <?php foreach (($statuses?:[]) as $item): ?>
                    <option value="<?= ($item['id']) ?>" <?= (!empty($issue) && $issue['status'] == $item['id'] ? "selected" : "") ?>><?= ($this->esc(isset($dict[$item['name']]) ? $dict[$item['name']] : str_replace('_', ' ', $item['name']))) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <?php if ($user['role']=='admin'): ?>
        <div class="form-group">
            <label class="col-md-2 control-label label-sm"><?= ($dict['cols']['author']) ?></label>
            <div class="col-md-10">
                <select class="form-control input-sm" name="author_id">
                    <?php if (@$issue['author_id']): ?>
                        <?php $author = new \Model\User; $author->load($issue['author_id']); ?>
                        <?php if ($author['deleted_date']): ?>
                            <option value="<?= ($author['id']) ?>" style="text-decoration: line-through;" selected><?= ($this->esc($author['name'])) ?></option>
                        <?php endif; ?>
                    <?php endif; ?>
                    <option value="<?= ($user['id']) ?>" <?= (empty($issue) ? 'selected' : '') ?>><?= ($this->esc($user['name'])) ?></option>
                    <optgroup label="<?= ($dict['groups']) ?>">
                        <?php foreach (($groups?:[]) as $group): ?>
                            <?php if (!empty($issue) && $issue['author_id'] == $group['id']): ?>
                                <option value="<?= ($group['id']) ?>" selected><?= ($this->esc($group['name'])) ?></option>
                                <?php else: ?><option value="<?= ($group['id']) ?>"><?= ($this->esc($group['name'])) ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </optgroup>
                    <optgroup label="<?= ($dict['users']) ?>">
                        <?php foreach (($users?:[]) as $item): ?>
                            <?php if (!empty($issue) && $issue['author_id'] == $item['id']): ?>
                                <option value="<?= ($item['id']) ?>" selected><?= ($this->esc($item['name'])) ?></option>
                                <?php else: ?><option value="<?= ($item['id']) ?>"><?= ($this->esc($item['name'])) ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </optgroup>
                </select>
            </div>
        </div>
    <?php endif; ?>
    <div class="form-group">
        <label class="col-md-2 control-label label-sm"><?= ($dict['cols']['assignee']) ?></label>
        <div class="col-md-10">
            <select class="form-control input-sm" name="owner_id">
                <option value="0"><?= ($dict['not_assigned']) ?></option>
                <?php if (@$issue['owner_id'] ?? $owner_id): ?>
                    <?php $owner = new \Model\User; $owner->load($issue['owner_id'] ?? $owner_id); ?>
                    <?php if ($owner['deleted_date']): ?>
                        <option value="<?= ($owner['id']) ?>" style="text-decoration: line-through;" selected><?= ($this->esc($owner['name'])) ?></option>
                    <?php endif; ?>
                <?php endif; ?>
                <option value="<?= ($user['id']) ?>" <?= (empty($issue) && empty($owner_id) ? 'selected' : '') ?>><?= ($this->esc($user['name'])) ?></option>
                <optgroup label="<?= ($dict['groups']) ?>">
                    <?php foreach (($groups?:[]) as $group): ?>
                        <?php if (($issue['owner_id'] ?? $owner_id) == $group['id']): ?>
                            <option value="<?= ($group['id']) ?>" selected><?= ($this->esc($group['name'])) ?></option>
                            <?php else: ?><option value="<?= ($group['id']) ?>"><?= ($this->esc($group['name'])) ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </optgroup>
                <optgroup label="<?= ($dict['users']) ?>">
                    <?php foreach (($users?:[]) as $item): ?>
                        <?php if (($issue['owner_id'] ?? $owner_id) == $item['id']): ?>
                            <option value="<?= ($item['id']) ?>" selected><?= ($this->esc($item['name'])) ?></option>
                            <?php else: ?><option value="<?= ($item['id']) ?>"><?= ($this->esc($item['name'])) ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </optgroup>
            </select>
        </div>
    </div>

    <?php if (!empty($issue)): ?>
        
            <div class="form-group">
                <label class="col-md-2 control-label label-sm"><?= ($dict['cols']['total_spent_hours']) ?></label>
                <div class="col-md-6">
                    <input class="form-control input-sm" type="text" name="hours_spent" autocomplete="off" value="<?= ($issue['hours_spent']) ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label label-sm"><?= ($dict['cols']['hours_total']) ?></label>
                <div class="col-md-6">
                    <input class="form-control input-sm" type="text" name="hours_total" autocomplete="off" value="<?= ($issue['hours_total']) ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label label-sm"><?= ($dict['cols']['hours_remaining']) ?></label>
                <div class="col-md-6">
                    <input class="form-control input-sm" type="text" name="hours_remaining" autocomplete="off" value="<?= ($issue['hours_remaining']) ?>">
                </div>
            </div>
        
        <?php else: ?>
            <div class="form-group">
                <label class="col-md-2 control-label label-sm"><?= ($dict['cols']['hours_total']) ?></label>
                <div class="col-md-6">
                    <input class="form-control input-sm" type="text" name="hours" autocomplete="off">
                </div>
            </div>
        
    <?php endif; ?>

    <div class="form-group">
        <label class="col-md-2 control-label label-sm"><?= ($dict['cols']['start_date']) ?></label>
        <div class="col-md-6">
            <input class="form-control input-sm" id="start_date" type="text" name="start_date" autocomplete="off" value="<?= (empty($issue) ? '' : $issue['start_date']) ?>">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label label-sm"><?= ($dict['cols']['due_date']) ?></label>
        <div class="col-md-6">
            <input class="form-control input-sm" id="due_date" type="text" name="due_date" autocomplete="off" value="<?= (empty($issue) ? '' : $issue['due_date']) ?>">
            <label class="checkbox-inline">
                <input type="checkbox" name="due_date_sprint" value="1" <?php if(@$issue['due_date_sprint']) echo 'checked' ?>>
                <?= ($dict['set_sprint_from_due_date'])."
" ?>
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label label-sm"><?= ($dict['cols']['repeat_cycle']) ?></label>
        <div class="col-md-6">
            <select class="form-control input-sm" name="repeat_cycle">
                <option value=""><?= ($dict['not_repeating']) ?></option>
                <option value="daily" <?= (!empty($issue) && $issue['repeat_cycle'] == 'daily' ? "selected" : "") ?>><?= ($dict['daily']) ?></option>
                <option value="weekly" <?= (!empty($issue) && $issue['repeat_cycle'] == 'weekly' ? "selected" : "") ?>><?= ($dict['weekly']) ?></option>
                <option value="monthly" <?= (!empty($issue) && $issue['repeat_cycle'] == 'monthly' ? "selected" : "") ?>><?= ($dict['monthly']) ?></option>
                <option value="quarterly" <?= (!empty($issue) && $issue['repeat_cycle'] == 'quarterly' ? "selected" : "") ?>><?= ($dict['quarterly']) ?></option>
                <option value="semi_annually" <?= (!empty($issue) && $issue['repeat_cycle'] == 'semi_annually' ? "selected" : "") ?>><?= ($dict['semi_annually']) ?></option>
                <option value="annually" <?= (!empty($issue) && $issue['repeat_cycle'] == 'annually' ? "selected" : "") ?>><?= ($dict['annually']) ?></option>
                <option value="sprint" <?= (!empty($issue) && $issue['repeat_cycle'] == 'sprint' ? "selected" : "") ?>><?= ($dict['sprint']) ?></option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label label-sm"><?= ($dict['cols']['parent_id']) ?></label>
        <div class="col-md-6">
            <input class="form-control input-sm" type="text" name="parent_id" autocomplete="off" value="<?= (@$issue['parent_id'] ?: @$parent['id']) ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label label-sm"><?= ($dict['cols']['sprint']) ?></label>
        <div class="col-md-6">
            <select class="form-control input-sm" name="sprint_id">
                <option value=""><?= ($dict['no_sprint']) ?></option>
                <?php foreach (($sprints?:[]) as $item): ?>
                    <?php if (!empty($issue) && $issue['sprint_id'] == $item['id'] || empty($issue) && !empty($parent) && $parent['sprint_id'] == $item['id']): ?>
                        
                            <option value="<?= ($item['id']) ?>" selected><?= ($this->esc($item['name'])) ?> &ndash; <?= (date('n/j', strtotime($item['start_date']))) ?>-<?= (date('n/j', strtotime($item['end_date']))) ?></option>
                        
                        <?php else: ?>
                            <option value="<?= ($item['id']) ?>"><?= ($this->esc($item['name'])) ?> &ndash; <?= (date('n/j', strtotime($item['start_date']))) ?>-<?= (date('n/j', strtotime($item['end_date']))) ?></option>
                        
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php if (!empty($old_sprints)): ?>
                    <optgroup label="<?= ($dict['previous_sprints']) ?>">
                        <?php foreach (($old_sprints?:[]) as $item): ?>
                            <?php if (!empty($issue) && $issue['sprint_id'] == $item['id'] || empty($issue) && !empty($parent) && $parent['sprint_id'] == $item['id']): ?>
                                
                                    <option value="<?= ($item['id']) ?>" selected><?= ($this->esc($item['name'])) ?> &ndash; <?= (date('n/j', strtotime($item['start_date']))) ?>-<?= (date('n/j', strtotime($item['end_date']))) ?></option>
                                
                                <?php else: ?>
                                    <option value="<?= ($item['id']) ?>"><?= ($this->esc($item['name'])) ?> &ndash; <?= (date('n/j', strtotime($item['start_date']))) ?>-<?= (date('n/j', strtotime($item['end_date']))) ?></option>
                                
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </optgroup>
                <?php endif; ?>
            </select>
        </div>
    </div>

    <?php if (!empty($issue)): ?>
        
            <?php \Helper\Plugin::instance()->callHook('render.issue_edit.after_fields', $issue) ?>
        
        <?php else: ?>
            <?php \Helper\Plugin::instance()->callHook('render.issue_create.after_fields') ?>
        
    <?php endif; ?>

    <hr>
    <?php if (!empty($issue)): ?>
        <div class="form-group">
            <label class="col-md-2 control-label label-sm"><?= ($dict['comment']) ?></label>
            <div class="col-md-10">
                <textarea class="form-control input-sm" name="comment" rows="3"><?= ($this->esc(!empty($comment) && is_string($comment) ? $comment : "")) ?></textarea>
            </div>
        </div>

        <?php if (!empty($issue)): ?>
            <?php \Helper\Plugin::instance()->callHook('render.issue_edit.after_comments', $issue) ?>
        <?php endif; ?>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-offset-2 col-md-10 clearfix">
            <div class="pull-right" style="margin-left: 15px;">
                <?php if (!empty($issue)): ?>
                    <a href="<?= ($BASE) ?>/issues/<?= ($issue['id']) ?>" class="btn btn-default btn-sm btn-cancel"><?= ($dict['cancel']) ?></a>
                    <button type="reset" class="btn btn-default btn-sm"><?= ($dict['reset']) ?></button>
                <?php endif; ?>
                <?php if (empty($issue)): ?>
                    
                        <button type="submit" class="btn btn-primary btn-sm"><?= (Base::instance()->format($dict['create_n'], isset($dict[$type['name']]) ? $dict[$type['name']] : str_replace('_', ' ', $type['name']))) ?></button>
                    
                    <?php else: ?>
                        <button type="submit" class="btn btn-primary btn-sm"><?= (Base::instance()->format($dict['save_n'], isset($dict[$type['name']]) ? $dict[$type['name']] : str_replace('_', ' ', $type['name']))) ?></button>
                    
                <?php endif; ?>
            </div>
            <div class="pull-right">
                <div class="checkbox checkbox-container-inline">
                    <label>
                        <input type="checkbox" name="notify" value="1" checked>
                        <?= ($dict['send_notifications'])."
" ?>
                    </label>
                </div>
            </div>
        </div>
    </div>
</form>
