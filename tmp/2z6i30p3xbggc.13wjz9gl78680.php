<div class="dashboard-widget" data-widget="tasks">
    <h3 class="dashboard-widget-handle"><?= ($dict['my_tasks']) ?>&ensp;<small><?= (count($tasks)) ?></small>&ensp;
        <a class="btn btn-xs btn-default has-tooltip" href="<?= ($BASE) ?>/issues/new/<?= ($issue_type['task']) ?>" title="<?= ($dict['add_task']) ?>"><span class="fa fa-plus"></span></a>
    </h3>
    <?php $issues=$tasks; ?>
    <?php echo $this->render('blocks/dashboard-issue-list.html',NULL,get_defined_vars(),0); ?>
</div>
