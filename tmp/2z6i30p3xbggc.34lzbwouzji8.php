<!DOCTYPE html>
<html lang="<?= ($this->lang()) ?>">
<head>
    <?php echo $this->render('blocks/head.html',NULL,get_defined_vars(),0); ?>
</head>
<body>
<?php echo $this->render('blocks/navbar.html',NULL,get_defined_vars(),0); ?>
<div class="container">
    <?php echo $this->render('blocks/admin/tabs.html',NULL,get_defined_vars(),0); ?>

    <p id="alert-release" class="alert alert-info clearfix hidden" aria-hidden="true">
        <a href="https://github.com/Alanaktion/phproject/releases" target="_blank" class="btn btn-default btn-xs pull-right"><?= ($dict['releases']) ?></a>
        <?= ($dict['release_available'])."
" ?>
    </p>

    <div class="row">
        <div class="col-sm-4">
            <div class="well well-sm text-center">
                <h4><?= ($dict['users']) ?></h4>
                <h2><?= ($count_user) ?></h2>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="well well-sm text-center">
                <h4><?= ($dict['issues']) ?></h4>
                <h2><?= ($count_issue) ?></h2>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="well well-sm text-center">
                <h4><?= ($dict['comments']) ?></h4>
                <h2><?= ($count_issue_comment) ?></h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 col-sm-6">
            <h4><?= ($dict['database']) ?></h4>
            <b><?= ($dict['hostname']) ?>:</b> <?= ($this->esc($db['host'])) ?>:<?= ($this->esc($db['port'])) ?><br>
            <b><?= ($dict['schema']) ?>:</b> <?= ($this->esc($db['name'])) ?><br>
            <b><?= ($dict['username']) ?>:</b> <?= ($this->esc($db['user'])) ?><br>
            <b><?= ($dict['password']) ?>:</b> ********<br>
            <b><?= ($dict['current_version']) ?>:</b> <?= ($version) ?><br>
            <b>MySQL version:</b> <?= ($db['instance']->getAttribute(\PDO::ATTR_SERVER_VERSION))."
" ?>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="clearfix">
                <h4 class="pull-left"><?= ($dict['cache']) ?></h4>
                <form class="pull-right" action="<?= ($BASE) ?>/admin" method="post" style="margin-top: 10px;">
                    <input type="hidden" name="csrf-token" value="<?= $this->esc($csrf_token) ?>" />
                    <input type="hidden" name="action" value="clearcache">
                    <button type="submit" class="btn btn-warning btn-xs"><?= ($dict['clear_cache']) ?></button>
                </form>
            </div>
            <p><b><?= ($dict['cache_mode']) ?>:</b> <?= ($CACHE) ?></p>
            <small><?= ($dict['timeouts']) ?></small><br>
            <b><?= ($dict['queries']) ?>:</b> <?= ($cache_expire['db']) ?><br>
            <b><?= ($dict['minify']) ?>:</b> <?= ($cache_expire['minify']) ?><br>
            <b><?= ($dict['attachments']) ?>:</b> <?= ($cache_expire['attachments']) ?><br>
        </div>
        <div class="col-md-3 col-sm-6">
            <h4><?= ($dict['outgoing_mail']) ?></h4>
            <?php if ($mail['from']): ?>
                
                    <p><b><?= ($dict['from_address']) ?>:</b> <?= ($mail['from']) ?></p>
                
                <?php else: ?>
                    <?= ($dict['smtp_not_enabled'])."
" ?>
                
            <?php endif; ?>
            <h4><?= ($dict['incoming_mail']) ?></h4>
            <?php if (@$imap['hostname']): ?>
                
                    <b><?= ($dict['hostname']) ?>:</b> <?= ($imap['hostname']) ?><br>
                    <b><?= ($dict['username']) ?>:</b> <?= ($imap['username']) ?><br>
                    <b><?= ($dict['password']) ?>:</b> <?= (str_repeat("*", strlen($imap['password']))) ?><br>
                
                <?php else: ?>
                    <?= ($dict['imap_not_enabled'])."
" ?>
                
            <?php endif; ?>
        </div>
        <div class="col-md-3 col-sm-6">
            <h4><?= ($dict['miscellaneous']) ?></h4>
            <p>
                <b><?= ($dict['debug_level']) ?>:</b> <?= ($DEBUG) ?><br>
                <b><?= ($dict['session_lifetime']) ?>:</b> <?= (gmdate("z\\d G\\h", $JAR['expire'])) ?><br>
                <b><?= ($dict['max_upload_size']) ?>:</b> <?= (round($files['maxsize']/1024/1024, 2)) ?>MB
            </p>
            <p>
                <small>Gravatar</small><br>
                <b><?= ($dict['max_rating']) ?>:</b> <?= ($gravatar['rating']) ?><br>
                <b><?= ($dict['default']) ?>:</b> <?= ($gravatar['default']) ?><br>
            </p>
        </div>
    </div>

    <?php echo $this->render('blocks/footer.html',NULL,get_defined_vars(),0); ?>
</div>
<script>
$(function() {
    // Check for new releases
    $.get(BASE + '/admin/releaseCheck', function(data) {
        if (data.error) {
            return console.error('Failed to check for a new release.');
        }
        if (data.update_available) {
            $alert = $('#alert-release');
            if (data.description_html) {
                $description = $('<div />').css({
                    'max-height': '200px',
                    'overflow-y': 'auto'
                }).html(data.description_html);
                $alert.append('<hr>').append($description);
            }
            $alert.removeClass('hidden').removeAttr('aria-hidden');
        }
    }, 'json');
});
</script>
</body>
</html>
