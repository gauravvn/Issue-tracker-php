<div class="dashboard-widget" data-widget="projects">
    <h3 class="dashboard-widget-handle"><?= ($dict['my_projects']) ?>&ensp;<small><?= (count($projects)) ?></small>&ensp;
        <a class="btn btn-xs btn-default has-tooltip" href="<?= ($BASE) ?>/issues/new/<?= ($issue_type['project']) ?>" title="<?= ($dict['add_project']) ?>"><span class="fa fa-plus"></span></a>
    </h3>
    <?php $issues=$projects; ?>
    <?php echo $this->render('blocks/dashboard-issue-list.html',NULL,get_defined_vars(),0); ?>
</div>
