<!DOCTYPE html>
<html lang="<?= ($this->lang()) ?>">
<head>
    <?php echo $this->render('blocks/head.html',NULL,get_defined_vars(),0); ?>
</head>
<body>
<?php echo $this->render('blocks/navbar.html',NULL,get_defined_vars(),0); ?>
<div class="container">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#profile" data-toggle="tab"><?= ($dict['profile']) ?></a></li>
        <li><a href="#settings" data-toggle="tab"><?= ($dict['settings']) ?></a></li>
        <li><a href="#password" data-toggle="tab"><?= ($dict['password']) ?></a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade in active" id="profile">
            <form class="form-horizontal" action="<?= ($BASE) ?>/user" method="post">
                <input type="hidden" name="csrf-token" value="<?= $this->esc($csrf_token) ?>" />
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="opass" class="col-sm-4 control-label label-sm"><?= ($dict['name']) ?></label>
                            <div class="col-sm-8">
                                <input class="form-control input-sm" id="name" name="name" type="text" value="<?= ($this->esc($user['name'])) ?>" maxlength="32">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="npass" class="col-sm-4 control-label label-sm"><?= ($dict['email_address']) ?></label>
                            <div class="col-sm-8">
                                <input class="form-control input-sm" id="email" name="email" type="email" value="<?= ($user['email']) ?>" maxlength="64">
                            </div>
                        </div>
                        <?php if ($user['role'] == 'admin'): ?>
                            <div class="form-group">
                                <label class="col-sm-4 control-label label-sm">API Key</label>
                                <div class="col-sm-8">
                                    <p class="form-control-static input-sm" style="font-family: monospace;"><?= ($user['api_key'] ?: 'No API Key') ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="npass" class="col-sm-4 control-label label-sm"><?= ($dict['theme']) ?></label>
                            <div class="col-sm-8">
                                <select name="theme" class="form-control input-sm">
                                    <option value="">[ <?= ($dict['default']) ?> ]</option>
                                    <?php foreach (($themes?:[]) as $item): ?>
                                        <option value="css/<?= ($item) ?>.css" <?= (($user['theme'] == 'css/'.$item.'.css') ? 'selected' : '') ?>><?= (str_replace(array("bootstrap-", ".min"), "", $item)) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="npass" class="col-sm-4 control-label label-sm"><?= ($dict['language']) ?></label>
                            <div class="col-sm-8">
                                <select name="language" class="form-control input-sm">
                                    <option value="">[ <?= ($dict['default']) ?> ]</option>
                                    <?php foreach (($languages?:[]) as $key=>$item): ?>
                                        <option value="<?= ($key) ?>" <?= (($user['language'] == $key) ? 'selected' : '') ?>><?= ($item) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="npass" class="col-sm-4 control-label label-sm"><?= ($dict['task_color']) ?></label>
                            <div class="col-sm-8">
                                <input class="form-control input-sm" id="color" name="task_color" type="color" value="<?= ($user['task_color'] ? '#' . $user['task_color'] : '') ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-success"><?= ($dict['save']) ?></button>
                </div>
            </form>
            <hr>
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?= ($dict['avatar']) ?></label>
                    <div class="col-sm-10">
                        <?php if (empty($user_obj->avatar_filename)): ?>
                            
                                <p><a href="https://www.gravatar.com/emails/" target="_blank" class="img-border img-border-rounded"><img src="<?= ($this->esc($user_obj->avatar(96))) ?>" srcset="<?= ($this->esc($user_obj->avatar(192))) ?> 2x" class="img-rounded profile-picture" alt="Gravatar"></a></p>
                            
                            <?php else: ?>
                                <p><img src="<?= ($this->esc($user_obj->avatar(96))) ?>" srcset="<?= ($this->esc($user_obj->avatar(192))) ?> 2x" class="img-rounded profile-picture" alt="<?= ($dict['avatar']) ?>"></p>
                            
                        <?php endif; ?>
                        <form class="clearfix" method="post" enctype="multipart/form-data" action="<?= ($BASE) ?>/user/avatar">
                            <input type="hidden" name="csrf-token" value="<?= $this->esc($csrf_token) ?>" />
                            <input type="file" name="avatar" id="input_avatar" class="pull-left">
                            <button type="submit" class="btn btn-default btn-sm pull-left nojs"><?= ($dict['upload']) ?></button>
                        </form>
                        <?php if (empty($user_obj->avatar_filename)): ?>
                            <p class="help-block"><a href="https://www.gravatar.com/emails/" target="_blank"><?= ($dict['edit_on_gravatar']) ?></a></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="settings">
            <form action="<?= ($BASE) ?>/user" method="post">
                <input type="hidden" name="csrf-token" value="<?= $this->esc($csrf_token) ?>" />
                <input type="hidden" name="action" value="options">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="disable_mde" value="1" <?= ($user_obj->option('disable_mde') ? 'checked' : '') ?>>
                        <?= ($dict['disable_editor'])."
" ?>
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="disable_due_alerts" value="1" <?= ($user_obj->option('disable_due_alerts') ? 'checked' : '') ?>>
                        <?= ($dict['disable_due_alerts'])."
" ?>
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="disable_self_notifications" value="1" <?= ($user_obj->option('disable_self_notifications') ? 'checked' : '') ?>>
                        <?= ($dict['disable_self_notifications'])."
" ?>
                    </label>
                </div>
                <button type="submit" class="btn btn-success btn-sm"><?= ($dict['save']) ?></button>
            </form>
        </div>
        <div class="tab-pane fade" id="password">
            <form class="form-horizontal" action="<?= ($BASE) ?>/user" method="post">
                <input type="hidden" name="csrf-token" value="<?= $this->esc($csrf_token) ?>" />
                <div class="form-group">
                    <label for="opass" class="col-lg-4 col-sm-2 control-label label-sm"><?= ($dict['current_password']) ?></label>
                    <div class="col-lg-6 col-sm-10">
                        <input class="form-control input-sm" id="opass" name="old_pass" type="password">
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="npass" class="col-lg-4 col-sm-2 control-label label-sm"><?= ($dict['new_password']) ?></label>
                    <div class="col-lg-6 col-sm-10">
                        <input class="form-control input-sm" id="npass" name="new_pass" type="password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="npass_confirm" class="col-lg-4 col-sm-2 control-label label-sm"><?= ($dict['confirm_password']) ?></label>
                    <div class="col-lg-6 col-sm-10">
                        <input class="form-control input-sm" id="npass_confirm" name="new_pass_confirm" type="password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-lg-offset-4 col-lg-8 col-sm-10">
                        <button type="submit" class="btn btn-success btn-sm"><?= ($dict['save']) ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php echo $this->render('blocks/footer.html',NULL,get_defined_vars(),0); ?>
</div>
<script type="text/javascript">
$('#input_avatar').change(function(e) {
    // Prevent navigation
    $('a:not([target])').click(function(e) {
        e.preventDefault();
    });

    // Show loading animation
    $('.help-block').remove();
    $(this).parents('form').parent().append('<img src="<?= ($BASE) ?>/img/ajax-loader.gif" alt="<?= ($dict['loading']) ?>" />');

    // Submit form
    $(this).parents('form').submit();
});
</script>
</body>
</html>
