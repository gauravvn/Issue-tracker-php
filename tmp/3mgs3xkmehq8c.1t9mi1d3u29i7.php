<div class="dashboard-widget" data-widget="my_comments">
    <h3 class="dashboard-widget-handle"><?= ($dict['my_comments']) ?></h3>
    <div class="comments">
        <?php $issue = new \Model\Issue() ?>
        <?php foreach (($my_comments?:[]) as $comment): ?>
            <?php $issue->load($comment['issue_id']) ?>
            <?php echo $this->render('blocks/issue-comment.html',NULL,get_defined_vars(),0); ?>
        <?php endforeach; ?>
    </div>
</div>
