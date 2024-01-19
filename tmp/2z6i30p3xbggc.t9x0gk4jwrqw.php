<div class="dashboard-widget" data-widget="watchlist">
    <h3 class="dashboard-widget-handle"><?= ($dict['my_watchlist']) ?>&ensp;<small><?= (count($watchlist)) ?></small>&ensp;</h3>
    <?php $issues=$watchlist; ?>
    <?php echo $this->render('blocks/dashboard-issue-list.html',NULL,get_defined_vars(),0); ?>
</div>
