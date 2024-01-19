<div class="dashboard-widget" data-widget="subprojects">
    <h3 class="dashboard-widget-handle"><?= ($dict['my_subprojects']) ?>&ensp;<small><?= (count($subprojects)) ?></small></h3>
    <?php $issues=$subprojects; ?>
    <?php echo $this->render('blocks/dashboard-issue-list.html',NULL,get_defined_vars(),0); ?>
</div>
