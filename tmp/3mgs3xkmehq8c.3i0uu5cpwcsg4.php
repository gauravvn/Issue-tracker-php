<!DOCTYPE html>
<html lang="<?= ($this->lang()) ?>">
<head>
    <?php echo $this->render('blocks/head.html',NULL,get_defined_vars(),0); ?>
    <link rel="stylesheet" href="<?= ($BASE) ?>/css/backlog.css">
</head>
<body>
<?php echo $this->render('blocks/navbar.html',NULL,get_defined_vars(),0); ?>
<div class="container">
    <div class="row" id="backlog">
        <div class="col-md-6">
            <p>
                <a href="<?= ($BASE) ?>/backlog" class="btn btn-default btn-sm">
                <span class="fa fa-chevron-left"></span>&ensp;<?= ($dict['show_future_sprints'])."
" ?>
                </a>
            </p>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= ($dict['backlog'])."
" ?>
                </div>
                <div class="panel-body in" id="panel-0">
                    <ul class="list-group sortable" data-list-id="0">
                    </ul>
                </div>
                <p style="text-align:center;" class="text-muted">
                    <?= ($dict['backlog_old_help_text'])."
" ?>
                </p>
            </div>
        </div>
        <div class="col-md-6">
            <?php foreach (($sprints?:[]) as $key=>$sprint): ?>
                <div class="panel panel-default">
                    <div class="panel-heading has-buttons">
                        <a class="<?= ($key ? 'collapsed' : '') ?>" data-toggle="collapse" href="#panel-<?= ($sprint['id']) ?>"><?= ($sprint['name']) ?> <?= (date('n/j', strtotime($sprint['start_date']))) ?>-<?= (date('n/j', strtotime($sprint['end_date']))) ?></a>
                        <a href="<?= ($BASE) ?>/taskboard/<?= ($sprint['id']) ?>" class="btn btn-default btn-xs pull-right">
                            <span class="fa fa-list"></span> <?= ($dict['taskboard'])."
" ?>
                        </a>
                    </div>
                    <div class="panel-body <?= ($key ? 'collapse' : 'in') ?>" id="panel-<?= ($sprint['id']) ?>">
                        <ul class="list-group sortable" data-list-id="<?= ($sprint['id']) ?>">
                            <?php foreach (($sprint['projects']?:[]) as $project): ?>
                                <?php echo $this->render('backlog/item.html',NULL,get_defined_vars(),0); ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php echo $this->render('blocks/footer.html',NULL,get_defined_vars(),0); ?>
    <script src="<?= ($BASE) ?>/js/jquery-ui-dragsort.min.js"></script>
    <script src="<?= ($BASE) ?>/js/jquery.ui.touch-punch.min.js"></script>
    <script src="<?= ($BASE) ?>/js/backlog.js"></script>
</div>
</body>
</html>
