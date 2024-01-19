<?php $dblog = $db['instance']->log();
    $total = preg_match_all('/\([0-9\.]{3,}ms\)/', $dblog, $matches);
    $cached = substr_count($dblog, '[CACHED]'); ?>
<?php if ($DEBUG == 3): ?>
    <br>
    <div class="well well-sm log"><?= ($this->esc($dblog)) ?></div>
<?php endif; ?>
<footer class="row">
    <div class="col-xs-4">
        <form class="visible-sm visible-xs" method="<?= ($BASE) ?>/logout" method="post">
            <input type="hidden" name="csrf-token" value="<?= $this->esc($csrf_token) ?>" />
            <button type="submit" class="btn btn-default btn-xs">
                <?= ($dict['log_out'])."
" ?>
            </button>
        </form>
    </div>
    <div class="col-xs-8">
        <p class="text-right text-muted">
            <?php if ($dblog): ?>
                <span title="<?= (Base::instance()->format($dict['n_total_queries_n_cached'],$total,$cached)) ?>"><?= (Base::instance()->format($dict['n_queries'],($total - $cached))) ?></span> &middot;
            <?php endif; ?>
            <?php if (!empty($microtime)): ?>
                <?php $pagemtime=microtime(true) - $microtime; ?>
                <span title="<?= (Base::instance()->format($dict['page_generated_in_n_seconds'],round($pagemtime, 10))) ?>"><?= (round($pagemtime * 1000, 0)) ?>ms</span> &middot;
            <?php endif; ?>
            <span title="Real usage: <?= (memory_get_peak_usage(true)) ?> bytes"><?= (\Helper\View::instance()->formatFilesize(memory_get_peak_usage())) ?></span>
            <?php if ($revision): ?>
                &middot; <a class="nolink" title="<?= (Base::instance()->format($dict['current_commit_n'],$revision)) ?>" href="https://github.com/Alanaktion/phproject/commit/<?= ($revision) ?>" target="_blank"><?= (substr($revision, 0, 7)) ?></a>
            <?php endif; ?>
            <?php if ($plugins): ?>
                &middot; <?= (count($plugins)) ?> <?= ($dict['plugins'])."
" ?>
            <?php endif; ?>
        </p>
    </div>
</footer>
<?php if (!empty($user['id'])) echo $this->render('blocks/footer-modals.html',NULL,get_defined_vars(),0); ?>
<?php echo $this->render('blocks/footer-scripts.html',NULL,get_defined_vars(),0); ?>
