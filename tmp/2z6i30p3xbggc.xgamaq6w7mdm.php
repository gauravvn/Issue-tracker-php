<!DOCTYPE html>
<html lang="<?= ($this->lang()) ?>">
<head>
    <?php echo $this->render('blocks/head.html',NULL,get_defined_vars(),0); ?>
</head>
<body>
    <?php $fullwidth=true; ?>
    <?php echo $this->render('blocks/navbar.html',NULL,get_defined_vars(),0); ?>
    <div class="container-fluid">
        <?php if (!empty($GET['deleted'])): ?>
            <p class="alert alert-success"><?= (Base::instance()->format($dict['deleted_success'],intval($GET['deleted']))) ?>&ensp;<a class="alert-link" href="<?= ($BASE) ?>/issues/undelete/<?= ($GET['deleted']) ?>"><?= ($dict['restore_issue']) ?></a></p>
        <?php endif; ?>
        <?php echo $this->render('blocks/issue-list.html',NULL,get_defined_vars(),0); ?>
        <div class="clearfix">
            <p class="pull-right hidden-xs">
                <span class="text-muted">Showing <?= (($issues['limit'] * $issues['pos']) + 1) ?>&ndash;<?= ($issues['limit'] * ($issues['pos'] + 1) > $issues['total'] ? $issues['total'] : $issues['limit'] * ($issues['pos'] + 1)) ?> of <?= ($issues['total']) ?></span>
            </p>
        </div>
        <?php if ($issues['count']): ?>
            <div class="text-center">
                <ul class="pagination pagination-sm" style="margin: 15px 0;">
                    <li <?php if($issues['pos'] == 0) echo 'class="disabled"' ?>><a href="<?= ($BASE) ?>/issues?page=<?= ($issues['pos'] ? $issues['pos'] - 1 : 0) ?>&amp;<?= ($this->esc($filter_get)) ?>">&laquo;</a></li>
                    <?php foreach (($pages?:[]) as $page): ?>
                        <li <?php if($page == $issues['pos']) echo 'class="active"' ?>><a href="<?= ($BASE) ?>/issues?page=<?= ($page) ?>&amp;<?= ($filter_get) ?>"><?= ($page + 1) ?></a></li>
                    <?php endforeach; ?>
                    <li <?php if($issues['pos'] == $issues['count'] - 1) echo 'class="disabled"' ?>><a href="<?= ($BASE) ?>/issues?page=<?= (($issues['pos'] < $issues['count'] - 1) ? $issues['pos'] + 1 : $issues['count'] - 1) ?>&amp;<?= ($this->esc($filter_get)) ?>">&raquo;</a></li>
                </ul>
            </div>
        <?php endif; ?>
        <?php echo $this->render('blocks/footer.html',NULL,get_defined_vars(),0); ?>
    </div>
    <script src="<?= ($BASE) ?>/js/bootstrap-datepicker.js"></script>
    <?php if ($user_obj->date_picker()->js && $user_obj->date_picker()->language != 'en-US'): ?>
        <script src="<?= ($BASE) ?>/js/bootstrap-datepicker.<?= ($user_obj->date_picker()->language) ?>.min.js"></script>
    <?php endif; ?>
    <script>var datepickerLanguage='<?= ($user_obj->date_picker()->language) ?>';</script>
</body>
</html>
