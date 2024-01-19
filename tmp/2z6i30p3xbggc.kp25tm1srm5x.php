<div class="dashboard-widget" data-widget="repeat_work">
    <h3 class="dashboard-widget-handle"><?= ($dict['repeat_work']) ?>&ensp;<small><?= (count($repeat_work)) ?></small>&ensp;</h3>
    <?php $issues=$repeat_work; ?>
    <?php echo $this->render('blocks/dashboard-issue-list.html',NULL,get_defined_vars(),0); ?>
</div>
