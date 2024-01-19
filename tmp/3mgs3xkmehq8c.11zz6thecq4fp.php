<!DOCTYPE html>
<html lang="<?= ($this->lang()) ?>">
<head>
    <?php echo $this->render('blocks/head.html',NULL,get_defined_vars(),0); ?>
    <?php if ($user['api_key']): ?>
        <link rel="alternate" type="application/atom+xml" title="<?= ($dict['assigned_issues']) ?>" href="<?= ($site['url']) ?>atom.xml?type=assigned&amp;user=<?= ($user['username']) ?>&amp;key=<?= ($user['api_key']) ?>" />
        <link rel="alternate" type="application/atom+xml" title="<?= ($dict['created_issues']) ?>" href="<?= ($site['url']) ?>atom.xml?type=created&amp;user=<?= ($user['username']) ?>&amp;key=<?= ($user['api_key']) ?>" />
        <link rel="alternate" type="application/atom+xml" title="All Issues" href="<?= ($site['url']) ?>atom.xml?type=all&amp;key=<?= ($user['api_key']) ?>" />
    <?php endif; ?>
</head>
<body class="dashboard">
<?php $fullwidth=true; ?>
<?php echo $this->render('blocks/navbar.html',NULL,get_defined_vars(),0); ?>
<div class="container-fluid dashboard-container">

    <a class="btn btn-default btn-xs" data-toggle="modal" data-target="#mdl-manage-widgets">
        <span class="fa fa-bars"></span>&ensp;<?= ($dict['manage_widgets'])."
" ?>
    </a>
    <?php if ($sprint && $sprint['id']): ?>
        <a class="btn btn-default btn-xs" href="<?= ($BASE) ?>/taskboard">
            <span class="fa fa-list"></span>&ensp;<?= ($dict['taskboard'])."
" ?>
        </a>
    <?php endif; ?>

    <div class="row">
        <div class="col-sm-5">
            <?php foreach (($dashboard['left']?:[]) as $widget): ?>
                <?php echo $this->render('user/dashboard-widgets/' . $widget . '.html',NULL,get_defined_vars(),0); ?>
            <?php endforeach; ?>
        </div>
        <div class="col-sm-7">
            <?php foreach (($dashboard['right']?:[]) as $widget): ?>
                <?php echo $this->render('user/dashboard-widgets/' . $widget . '.html',NULL,get_defined_vars(),0); ?>
            <?php endforeach; ?>
        </div>
    </div>

    <?php echo $this->render('blocks/footer.html',NULL,get_defined_vars(),0); ?>
    <script src="<?= ($BASE) ?>/js/jquery-ui-dragsort.min.js"></script>
    <script src="<?= ($BASE) ?>/js/jquery.ui.touch-punch.min.js"></script>

    <?php echo $this->render('user/dashboard-widget-modal.html',NULL,get_defined_vars(),0); ?>
</div>
</body>
</html>
