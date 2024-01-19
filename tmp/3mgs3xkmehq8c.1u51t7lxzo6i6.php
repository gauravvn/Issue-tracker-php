<!DOCTYPE html>
<html lang="<?= ($this->lang()) ?>">
<head>
    <?php echo $this->render('blocks/head.html',NULL,get_defined_vars(),0); ?>
</head>
<body>
<?php echo $this->render('blocks/navbar.html',NULL,get_defined_vars(),0); ?>
<div class="container">
    <div class="clearfix">
        <div class="pull-right">
            <a href="<?= ($BASE) ?>/admin/users/new" class="btn btn-default btn-sm"><span class="fa fa-plus"></span>&ensp;<?= ($dict['new_user']) ?></a>
        </div>
        <?php echo $this->render('blocks/admin/tabs.html',NULL,get_defined_vars(),0); ?>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-condensed">
            <thead>
                <tr>
                    <th data-sort="int"><?= ($dict['cols']['id']) ?></th>
                    <th data-sort="string"><?= ($dict['username']) ?></th>
                    <th data-sort="string"><?= ($dict['email']) ?></th>
                    <th data-sort="string"><?= ($dict['name']) ?></th>
                    <th data-sort="string"><?= ($dict['role']) ?></th>
                    <th data-sort="string"><?= ($dict['task_color']) ?></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (($users?:[]) as $user): ?>
                    <tr data-user-id="<?= ($user['id']) ?>" style="cursor: pointer">
                        <td><a href="<?= ($BASE) ?>/admin/users/<?= ($user['id']) ?>"><?= ($user['id']) ?></a></td>
                        <td><?= ($this->esc($user['username'])) ?></td>
                        <td><?= ($this->esc($user['email'])) ?></td>
                        <td class="user-name"><?= ($this->esc($user['name'])) ?></td>
                        <td><?= (ucfirst($user['role'])) ?></td>
                        <td><span class="badge" style="background-color: #<?= ($this->esc($user['task_color'])) ?>;">&ensp;</span>&ensp;#<?= ($user['task_color']) ?></td>
                        <td>
                            <?php if ($user['id'] != $user_obj['id']): ?>
                                <button type="button" class="delete has-tooltip" title="<?= ($dict['deactivate']) ?>" aria-label="<?= ($dict['deactivate']) ?>">
                                    <span class="fa fa-remove"></span>
                                </button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <p>
        <a class="btn btn-default btn-sm" href="<?= ($BASE) ?>/admin/users/deleted"><?= ($dict['show_deactivated_users']) ?></a>
    </p>
    <?php echo $this->render('blocks/footer.html',NULL,get_defined_vars(),0); ?>
    <script src="<?= ($BASE) ?>/js/stupidtable.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('.table').stupidtable();
        $('.table').on('click', '.delete', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var userId = $(this).parents('tr').data('user-id');
            $('#mdl-delete form').attr('action', '<?= ($BASE) ?>/admin/users/' + userId + '/delete');
            $('#mdl-delete .user-name').text($(this).parents('tr').find('.user-name').text());
            $('#mdl-delete select option').filter('[value="' + userId + '"]').prop('disabled', true);
            $('#mdl-delete').modal('show');
        }).on('click', 'tbody tr', function(e) {
            self.location = '<?= ($BASE) ?>/admin/users/' + $(this).data('user-id');
        });
        $('#mdl-delete select').on('change', function(e) {
            $('#mdl-delete input[value="to-user"]').prop('checked', true);
        });
        $('#mdl-delete').on('hide.bs.modal', function(e) {
            $('#mdl-delete select option').prop('disabled', false);
        });
    });
    </script>
</div>
<div class="modal" id="mdl-delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" action="#" method="post">
            <input type="hidden" name="csrf-token" value="<?= $this->esc($csrf_token) ?>" />
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?= ($dict['deactivate']) ?> <span class="user-name"></span></h4>
            </div>
            <div class="modal-body">
                <div class="radio">
                    <label>
                        <input type="radio" name="reassign" value="no-change" checked>
                        Do not reassign issues
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="reassign" value="unassign">
                        Unassign issues
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="reassign" value="to-user">
                        Reassign issues to:
                    </label>
                </div>
                <div class="form-group">
                    <select name="reassign-to" class="form-control input-sm">
                        <?php foreach (($select_users?:[]) as $user): ?>
                            <option value="<?= ($user['id']) ?>"><?= ($user['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><?= ($dict['cancel']) ?></button>
                <button type="submit" class="btn btn-sm btn-primary"><?= ($dict['deactivate']) ?></button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
