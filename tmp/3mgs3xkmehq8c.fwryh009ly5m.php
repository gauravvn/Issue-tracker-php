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
    <p>
        <a class="btn btn-link btn-sm" href="<?= ($BASE) ?>/admin/users"><span class="fa fa-chevron-left"></span>&ensp;Back</a>
        &ensp;<b>Deactivated Users</b>
    </p>
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
                <tr>
                    <td><?= ($user['id']) ?></a></td>
                    <td><?= ($this->esc($user['username'])) ?></td>
                    <td><?= ($this->esc($user['email'])) ?></td>
                    <td><?= ($this->esc($user['name'])) ?></td>
                    <td><?= (ucfirst($user['role'])) ?></td>
                    <td><span class="badge" style="background-color: #<?= ($user['task_color']) ?>;">&ensp;</span>&ensp;#<?= ($user['task_color']) ?></td>
                    <td>
                        <form action="<?= ($BASE) ?>/admin/users/<?= ($user['id']) ?>/undelete" method="post">
                            <input type="hidden" name="csrf-token" value="<?= $this->esc($csrf_token) ?>" />
                            <button type="submit" class="has-tooltip" title="<?= ($dict['reactivate']) ?>">
                                <span class="fa fa-repeat" style="transform: scaleX(-1);"></span>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php echo $this->render('blocks/footer.html',NULL,get_defined_vars(),0); ?>
    <script src="<?= ($BASE) ?>/js/stupidtable.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('.table').stupidtable();
    });
    </script>
</div>
</body>
</html>
