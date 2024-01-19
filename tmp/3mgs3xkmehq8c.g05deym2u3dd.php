<!DOCTYPE html>
<html lang="<?= ($this->lang()) ?>">

<head>
    <?php echo $this->render('blocks/head.html',NULL,get_defined_vars(),0); ?>
    <link rel="stylesheet" href="<?= ($BASE) ?>/css/backlog.css">
    <style type="text/css">
    </style>
</head>

<body class="is-loading <?= ($user['rank'] >= \Model\User::RANK_MANAGER ? 'is-sortable' : '') ?>">
    <?php echo $this->render('blocks/navbar.html',NULL,get_defined_vars(),0); ?>
    <div class="container">
        <div class="row" id="backlog">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading has-buttons">
                        <?= ($dict['backlog']) ?>&ensp;
                        <div class="btn-group btn-group-xs">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                    <span class="fa fa-filter"></span>&ensp; <?= ($dict['groups'])."
" ?>
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="#" data-group-id="all" data-user-ids="all">
                                            <?= ($dict['all_projects'])."
" ?>
                                        </a>
                                    </li>
                                    <li class="active">
                                        <a href="#" data-my-groups data-user-ids="<?= (implode(',', $user_obj->getSharedGroupUserIds())) ?>">
                                            <?= ($dict['my_groups'])."
" ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" data-group-id="<?= ($user['id']) ?>" data-user-ids="<?= ($user['id']) ?>">
                                            <?= ($dict['my_projects'])."
" ?>
                                        </a>
                                    </li>
                                    <?php if (count($groups)): ?>
                                        <li class="divider"></li>
                                        <?php foreach (($groups?:[]) as $group): ?>
                                            <li>
                                                <a href="#" data-group-id="<?= ($group->id) ?>" data-user-ids="<?= (implode(',', $group->getGroupUserIds())) ?>">
                                                    <?= ($this->esc($group['name']))."
" ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                    <?= ($dict['cols']['type'])."
" ?>
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <?php foreach (($project_types?:[]) as $type): ?>
                                        <li class="active">
                                            <a href="#" data-type-id="<?= ($type['id']) ?>">
                                                <?= (isset($dict[$type['name']]) ? $dict[$type['name']] : str_replace('_', ' ', $type['name']))."
" ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <a href="<?= ($BASE) ?>/issues/new/<?= ($issue_type['project']) ?>" class="btn btn-default btn-xs pull-right">
                            <span class="fa fa-plus"></span> <?= ($dict['add_project'])."
" ?>
                        </a>
                    </div>
                    <div class="panel-body in" id="panel-0">
                        <div class="panel-head-points text-muted">
                            <span><?= ($dict['backlog_points']) ?>:</span>
                            <span class="points-label">0</span>
                        </div>
                        <ul class="list-group sortable" data-list-id="0">
                            <?php foreach (($backlog?:[]) as $project): ?>
                                <?php echo $this->render('backlog/item.html',NULL,get_defined_vars(),0); ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tab-sprints" data-toggle="tab"><?= ($dict['sprints']) ?></a>
                    </li>
                    <li>
                        <a href="#tab-unsorted" data-toggle="tab"><?= ($dict['unsorted_items']) ?></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-sprints">
                        <?php foreach (($sprints?:[]) as $key=>$sprint): ?>
                            <div class="panel panel-default">
                                <div class="panel-heading has-buttons">
                                    <a class="<?= ($key ? 'collapsed' : '') ?>" data-toggle="collapse" href="#panel-<?= ($sprint['id']) ?>">
                                        <?= ($sprint['name']) ?> &mdash; <?= (date('n/j', strtotime($sprint['start_date']))) ?>-<?= (date('n/j', strtotime($sprint['end_date'])))."
" ?>
                                    </a>
                                    <a href="<?= ($BASE) ?>/taskboard/<?= ($sprint['id']) ?>" data-base-href="<?= ($BASE) ?>/taskboard/<?= ($sprint['id']) ?>" class="sprint-board btn btn-default btn-xs pull-right">
                                        <span class="fa fa-list"></span> <?= ($dict['taskboard'])."
" ?>
                                    </a>
                                </div>
                                <div class="panel-body <?= ($key ? 'collapse' : 'in') ?>" id="panel-<?= ($sprint['id']) ?>">
                                    <div class="panel-head-points text-muted">
                                        <span><?= ($dict['backlog_points']) ?>:</span>
                                        <span class="points-label-completed">0</span> /
                                        <span class="points-label">0</span>
                                    </div>
                                    <ul class="list-group sortable" data-list-id="<?= ($sprint['id']) ?>">
                                        <?php foreach (($sprint['projects']?:[]) as $project): ?>
                                            <?php echo $this->render('backlog/item.html',NULL,get_defined_vars(),0); ?>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <p class="text-center">
                            <a href="<?= ($BASE) ?>/backlog/old"><?= ($dict['show_previous_sprints']) ?></a>
                        </p>
                    </div>
                    <div class="tab-pane" id="tab-unsorted">
                        <ul class="list-group sortable">
                            <?php foreach (($unsorted?:[]) as $project): ?>
                                <?php echo $this->render('backlog/item.html',NULL,get_defined_vars(),0); ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $this->render('blocks/footer.html',NULL,get_defined_vars(),0); ?>
        <?php if ($user['rank'] >= \Model\User::RANK_MANAGER): ?>
            <script type="text/javascript">var sortBacklog = true;</script>
        <?php endif; ?>
        <script src="<?= ($BASE) ?>/js/sortable.min.js"></script>
        <script src="<?= ($BASE) ?>/js/backlog.js"></script>
    </div>
</body>
</html>
