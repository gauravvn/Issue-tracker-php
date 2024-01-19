<!DOCTYPE html>
<html lang="<?= ($this->lang()) ?>">
<head>
    <?php echo $this->render('blocks/head.html',NULL,get_defined_vars(),0); ?>
</head>
<body>
<?php echo $this->render('blocks/navbar.html',NULL,get_defined_vars(),0); ?>
<div class="container">
    <?php echo $this->render('blocks/admin/tabs.html',NULL,get_defined_vars(),0); ?>
    <div class="row">
        <div class="col-sm-8">
            <p class="alert alert-success alert-popup saved" style="display: none;"><?= ($dict['group_name_saved']) ?></p>
            <form onsubmit="return false;">
                <div class="form-group">
                    <label class="sr-only" for="group-name"><?= ($dict['group_name']) ?></label>
                    <input type="text" class="form-control input-lg" id="group-name" name="name" value="<?= ($this->esc($group['name'])) ?>">
                </div>
            </form>
            <ul id="members" class="list-unstyled">
                <?php foreach (($members?:[]) as $member): ?>
                    <li data-user-id="<?= ($member['user_id']) ?>">
                        <a href="#" class="delete text-danger has-tooltip" data-placement="right" title="<?= ($dict['delete']) ?>" aria-label="<?= ($dict['delete']) ?>">
                            <span class="fa fa-remove"></span>
                        </a>&nbsp;
                        <?php if ($member['manager']): ?>
                            
                                <span class="manager text-warning has-tooltip" data-placement="right" title="<?= ($dict['manager']) ?>" aria-label="<?= ($dict['manager']) ?>">
                                    <span class="fa fa-star"></span>
                                </span>
                            
                            <?php else: ?>
                                <form style="display: inline-block;" action="<?= ($BASE) ?>/admin/groups/<?= ($group['id']) ?>/setmanager/<?= ($member['id']) ?>" method="post">
                                    <input type="hidden" name="csrf-token" value="<?= $this->esc($csrf_token) ?>" />
                                    <button type="submit" class="manager text-muted has-tooltip" data-placement="right" title="<?= ($dict['set_as_manager']) ?>">
                                        <span class="fa fa-star-o"></span>
                                    </button>
                                </form>
                            
                        <?php endif; ?>
                        &nbsp;
                        <?= ($member['user_name'])."
" ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="col-sm-4">
            <form id="adduser">
                <input type="hidden" name="action" value="add_member">
                <input type="hidden" name="group_id" value="<?= ($group['id']) ?>">
                <div class="form-group">
                    <select name="user[]" style="height: 160px;" class="form-control" multiple>
                        <?php foreach (($users?:[]) as $item): ?>
                            <option value="<?= ($item['id']) ?>"><?= ($this->esc($item['name'])) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-primary"><?= ($dict['add_to_group']) ?></button>
                </div>
            </form>
            <form>
                <div class="checkbox">
                    <label>
                        <?php if ($group['api_visible']): ?>
                            
                                <input type="checkbox" id="chk-api-visibility" name="value" value="1" checked>
                            
                            <?php else: ?>
                                <input type="checkbox" id="chk-api-visibility" name="value" value="1">
                            
                        <?php endif; ?>
                        <?= ($dict['api_visible'])."
" ?>
                    </label>
                </div>
            </form>
            <form class="form-horizontal">
                <div class="form-group">
                    <label for="task_color" class="col-xs-4 control-label label-sm"><?= ($dict['task_color']) ?></label>
                    <div class="col-xs-6">
                        <input class="form-control input-sm" id="task_color" type="color" name="task_color" value="#<?= ($group['task_color']) ?>" maxlength="7">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php echo $this->render('blocks/footer.html',NULL,get_defined_vars(),0); ?>
</div>
<script type="text/javascript">
$(function(){
    $('#group-name').change(function(e) {
        if($(this).val().length > 0) {
            $.post('<?= ($BASE) ?>/admin/groups/ajax', {
                action: 'change_title',
                group_id: '<?= ($group['id']) ?>',
                name: $(this).val()
            }, function(data) {
                $('.saved').show();
                window.setTimeout(function(){
                    $('.saved').fadeOut(400);
                }, 3000);
            }, 'json').fail(function() {
                showAlert('Failed to change group name');
            });
        }
    });
    $('#members').on('click', 'a.delete', function(e) {
        $li = $(this).parents('li');
        if(confirm('Are you sure you want to remove this user?')) {
            $.post('<?= ($BASE) ?>/admin/groups/ajax', {
                action: 'remove_member',
                group_id: '<?= ($group['id']) ?>',
                user_id: $li.data('user-id')
            }, function(data) {
                if(data.deleted) {
                    $li.remove();
                }
            }, 'json').fail(function() {
                showAlert('Failed to remove user from group');
            });
        }
        e.preventDefault();
    });
    $('#adduser').submit(function(e) {
        $.post('<?= ($BASE) ?>/admin/groups/ajax', $(this).serialize()).fail(function() {
            showAlert('Failed to add user to group');
        });
        $('#adduser select option:selected').each(function(i) {
            $this = $(this);
            $('<li />').data('user-id', $this.val()).html('<a href="#" class="delete text-danger"><span class="fa fa-remove"></span></a>&ensp;' + $this.text()).appendTo('#members');
        });
        e.preventDefault();
    });
    $('#chk-api-visibility').change(function(e) {
        $.post('<?= ($BASE) ?>/admin/groups/ajax',{
            action: 'change_api_visibility',
            group_id: '<?= ($group['id']) ?>',
            value: $(this).prop('checked') + 0
        }, function() {}, 'json').fail(function() {
            showAlert('Failed to update API visibility');
        });
    });
    $('#task_color').change(function(e) {
        $.post('<?= ($BASE) ?>/admin/groups/ajax',{
            action: 'change_task_color',
            group_id: '<?= ($group['id']) ?>',
            value: $(this).val()
        }, function() {}, 'json').fail(function() {
            showAlert('Failed to update task color');
        });
    });
});
</script>
</body>
</html>
