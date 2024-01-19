<!DOCTYPE html>
<html lang="<?= ($this->lang()) ?>">
<head>
    <?php echo $this->render('blocks/head.html',NULL,get_defined_vars(),0); ?>
</head>
<body>
<?php echo $this->render('blocks/navbar.html',NULL,get_defined_vars(),0); ?>
<div class="container">
    <?php echo $this->render('blocks/admin/tabs.html',NULL,get_defined_vars(),0); ?>
    <form action="<?= ($BASE) ?>/admin/users/save" method="post" class="form-horizontal" autocomplete="off">
        <input type="hidden" name="csrf-token" value="<?= $this->esc($csrf_token) ?>" />
        <?php if (empty($this_user)): ?>
            
                <legend><?= ($dict['new_user']) ?></legend>
            
            <?php else: ?>
                <legend><?= ($dict['edit_user']) ?></legend>
                <input type="hidden" name="user_id" value="<?= ($this_user['id']) ?>">
            
        <?php endif; ?>
        <div class="form-group">
            <label for="username" class="col-lg-2 control-label label-sm"><?= ($dict['username']) ?></label>
            <div class="col-lg-10">
                <input class="form-control input-sm" id="username" type="text" name="username" value="<?= ($this->esc(@$this_user['username'] ?: @$POST['username'])) ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-lg-2 control-label label-sm"><?= ($dict['email']) ?></label>
            <div class="col-lg-10">
                <input class="form-control input-sm" id="email" type="email" name="email" value="<?= ($this->esc(@$this_user['email'] ?: @$POST['email'])) ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-lg-2 control-label label-sm"><?= ($this->esc($dict['name'])) ?></label>
            <div class="col-lg-10">
                <input class="form-control input-sm" id="name" type="text" name="name" value="<?= ($this->esc(@$this_user['name'] ?: @$POST['name'])) ?>">
            </div>
        </div>
        <br>
        <div class="form-group">
            <label for="password" class="col-lg-2 control-label label-sm"><?= ($dict['password']) ?></label>
            <div class="col-lg-10">
                <input class="form-control input-sm" id="password" type="password" name="password">
            </div>
        </div>
        <div class="form-group">
            <label for="password_confirm" class="col-lg-2 control-label label-sm"><?= ($dict['confirm_password']) ?></label>
            <div class="col-lg-10">
                <input class="form-control input-sm" id="password_confirm" type="password" name="password_confirm">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <div class="checkbox checkbox-sm">
                    <label>
                        <input type="checkbox" name="temporary_password" value="1"> <?= ($dict['require_new_password'])."
" ?>
                    </label>
                </div>
            </div>
        </div>
        <?php if (@$this_user['id'] != $user['id']): ?>
            <div class="form-group">
                <label for="rank" class="col-lg-2 control-label label-sm"><?= ($dict['rank']) ?></label>
                <div class="col-lg-10">
                    <select class="form-control input-sm" id="rank" name="rank">
                        <?php foreach ((($user['rank'] >= \Model\User::RANK_SUPER ? range(0, 5) : range(0, 4))?:[]) as $rank): ?>
                            <option value="<?= ($rank) ?>" <?= ((empty($this_user) && $rank == \Model\User::RANK_USER || @$this_user['rank'] == $rank) ? "selected" : "") ?>><?= ($dict['ranks'][$rank]) ?> &mdash; <?= ($dict['rank_permissions'][$rank]) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        <?php endif; ?>
        <div class="form-group">
            <label for="task_color" class="col-lg-2 control-label label-sm"><?= ($dict['task_color']) ?></label>
            <div class="col-lg-10">
                <?php if(!empty($this_user)) $task_color = '#' . $this_user['task_color']; elseif(!empty($POST['task_color'])) $task_color = $POST['task_color']; ?>
                <input class="form-control input-sm" id="task_color" type="color" name="task_color" value="<?= ($this->esc(@$task_color ?: $rand_color)) ?>" maxlength="7">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <button type="submit" class="btn btn-primary btn-sm"><?= ($dict['save']) ?></button>
                <a href="<?= ($BASE) ?>/admin/users" class="btn btn-default btn-sm"><?= ($dict['cancel']) ?></a>
            </div>
        </div>
    </form>
    <?php echo $this->render('blocks/footer.html',NULL,get_defined_vars(),0); ?>
</div>
</body>
</html>
