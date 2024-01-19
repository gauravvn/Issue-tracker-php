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
            <a href="<?= ($BASE) ?>/admin/sprints/new" class="btn btn-default btn-sm"><span class="fa fa-plus"></span>&ensp;<?= ($dict['new']) ?></a>
        </div>
        <?php echo $this->render('blocks/admin/tabs.html',NULL,get_defined_vars(),0); ?>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-condensed">
            <thead>
                <tr>
                    <th><?= ($dict['cols']['id']) ?></th>
                    <th><?= ($dict['name']) ?></th>
                    <th><?= ($dict['start_date']) ?></th>
                    <th><?= ($dict['end_date']) ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (($sprints?:[]) as $sprint): ?>
                    <tr data-sprint-id="<?= ($sprint['id']) ?>" onclick="self.location='<?= ($BASE) ?>/admin/sprints/<?= ($sprint['id']) ?>'" style="cursor: pointer">
                        <td><a href="<?= ($BASE) ?>/admin/sprints/<?= ($sprint['id']) ?>"><?= ($sprint['id']) ?></a></td>
                        <td><?= ($this->esc($sprint['name'])) ?></td>
                        <td><?= ($sprint['start_date']) ?></td>
                        <td><?= ($sprint['end_date']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php echo $this->render('blocks/footer.html',NULL,get_defined_vars(),0); ?>
</div>
</body>
</html>
