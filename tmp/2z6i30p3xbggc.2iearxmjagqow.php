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
            <a href="#" class="btn btn-default btn-sm" data-toggle="modal" data-target="#new" onclick="window.setTimeout('$(\'#input_name\').focus()',10);">
                <span class="fa fa-plus"></span>&ensp;<?= ($dict['new'])."
" ?>
            </a>
        </div>
        <?php echo $this->render('blocks/admin/tabs.html',NULL,get_defined_vars(),0); ?>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-condensed">
            <thead>
                <tr>
                    <th data-sort="int"><?= ($dict['cols']['id']) ?></th>
                    <th data-sort="string"><?= ($dict['name']) ?></th>
                    <th data-sort="int"><?= ($dict['members']) ?></th>
                    <th data-sort="string"><?= ($dict['task_color']) ?></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (($groups?:[]) as $group): ?>
                    <tr onclick="self.location='<?= ($BASE) ?>/admin/groups/<?= ($group['id']) ?>'" style="cursor: pointer">
                        <td><a href="<?= ($BASE) ?>/admin/groups/<?= ($group['id']) ?>"><?= ($group['id']) ?></a></td>
                        <td><?= ($this->esc($group['name'])) ?></td>
                        <td><?= ($group['count']) ?></td>
                        <td><span class="badge" style="background-color: #<?= ($group['task_color']) ?>;">&ensp;</span>&ensp;#<?= ($group['task_color']) ?></td>
                        <td class="clearfix">
                            <form class="pull-right" action="<?= ($BASE) ?>/admin/groups/<?= ($group['id']) ?>/delete" method="post">
                                <input type="hidden" name="csrf-token" value="<?= $this->esc($csrf_token) ?>" />
                                <button type="submit" class="has-tooltip" title="<?= ($dict['delete']) ?>" aria-label="<?= ($dict['delete']) ?>">
                                    <span class="fa fa-trash"></span>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php if (empty($groups)): ?>
        <p class="text-center"><?= ($dict['no_groups_exist']) ?></p>
    <?php endif; ?>
    <?php echo $this->render('blocks/footer.html',NULL,get_defined_vars(),0); ?>
    <script src="<?= ($BASE) ?>/js/stupidtable.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('.table').stupidtable();
    });
    </script>
</div>
<div class="modal" id="new" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" action="<?= ($BASE) ?>/admin/groups/new" method="post">
            <input type="hidden" name="csrf-token" value="<?= $this->esc($csrf_token) ?>" />
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="$('#input_name').val('');">&times;</button>
                <h4 class="modal-title"><?= ($dict['new']) ?></h4>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" id="input_name" name="name" placeholder="<?= ($dict['name']) ?>">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="$('#input_name').val('');"><?= ($dict['cancel']) ?></button>
                <button type="submit" class="btn btn-primary"><?= ($dict['save']) ?></button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
