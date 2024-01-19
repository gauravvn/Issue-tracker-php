<ul class="list-unstyled" id="watchers-list">
    <?php foreach (($watchers?:[]) as $watcher): ?>
        <li data-user-id="<?= ($watcher['id']) ?>">
            <a href="#" class="delete text-danger"><span class="fa fa-remove"></span></a>&ensp;<?= ($this->esc($watcher['name']))."
" ?>
        </li>
    <?php endforeach; ?>
</ul>
<form class="form-inline" id="add-watcher">
    <div class="form-group">
        <select name="user_id" class="form-control input-sm" id="watcherselect">
            <?php foreach (($users?:[]) as $user): ?>
                <option value="<?= ($user['id']) ?>"><?= ($this->esc($user['name'])) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-sm btn-primary"><?= ($dict['add_watcher']) ?></button>
    </div>
</form>
