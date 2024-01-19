<!DOCTYPE html>
<html lang="<?= ($this->lang()) ?>">
<head>
    <?php echo $this->render('blocks/head.html',NULL,get_defined_vars(),0); ?>
</head>
<body>
<?php echo $this->render('blocks/navbar.html',NULL,get_defined_vars(),0); ?>
<div class="container">
    <?php echo $this->render('blocks/admin/tabs.html',NULL,get_defined_vars(),0); ?>
    <div class="table-responsive">
        <table class="table table-striped table-condensed">
            <thead>
                <tr>
                    <th><?= ($dict['name']) ?></th>
                    <th><?= ($dict['cols']['author']) ?></th>
                    <th><?= ($dict['version']) ?></th>
                    <?php if ($user['rank'] >= \Model\User::RANK_SUPER): ?>
                        <th></th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach (($plugins?:[]) as $key=>$plugin): ?>
                    <?php $meta=$plugin->_meta(); ?>
                    <tr>
                        <td><?= ($this->esc($meta['package'])) ?></td>
                        <td><?= ($this->esc($meta['author'])) ?></td>
                        <td><?= ($meta['version']) ?></td>
                        <td>
                            <?php if ($user['rank'] >= \Model\User::RANK_SUPER && is_callable(array($plugin, '_admin'))): ?>
                                <a href="<?= ($BASE) ?>/admin/plugins/<?= ($key) ?>">Details</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php echo $this->render('blocks/footer.html',NULL,get_defined_vars(),0); ?>
</div>
</body>
</html>
