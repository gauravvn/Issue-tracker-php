<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Issue #<?= ($issue['id']) ?> - <?= ($this->esc($issue['name'])) ?> updated</title>
    <?php echo $this->render('notification/blocks/_head.html',NULL,get_defined_vars(),0); ?>
</head>
<body style="margin: 0; padding: 0;">
    <span style="font-size:0px;"> --- --- </span>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td bgcolor="#ffffff">
                <div align="center" style="padding: 0px 15px 0px 15px;">
                    <table width="600" class="wrapper">

                        <?php echo $this->render('notification/blocks/logo.html',NULL,get_defined_vars(),0); ?>

                        <!-- Header -->
                        <tr>
                            <td bgcolor="#2c3e50" style="border-radius: 4px 4px 0 0;" class="header">
                                <table width="100%">
                                    <tr>
                                        <td colspan="3" height="45"></td>
                                    </tr>
                                    <tr>
                                        <td width="15"></td>
                                        <td style="font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 18px; color: #ffffff; line-height: 1.5;">
                                            Issue <a href="<?= ($site['url']) ?>issues/<?= ($issue['id']) ?>" style="font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 18px; color: #ffffff; text-decoration: underline; line-height: 1.5;">#<?= ($issue['id']) ?> &ndash; <?= ($this->esc($issue['name'])) ?></a> updated
                                        </td>
                                        <td width="15"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" height="15"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <!-- Message -->
                        <tr>
                            <td class="body">
                                <table style="border: 1px solid #ecf0f1; border-top: 0;" width="100%">
                                    <tr>
                                        <td colspan="3" height="15"></td>
                                    </tr>
                                    <tr>
                                        <td width="15"></td>
                                        <td>

                                            <!-- Update -->
                                            <table width="100%">
                                                <tr>
                                                    <td width="48" valign="top" class="profile-img">
                                                        <img src="<?= ($site['url']) ?>avatar/48-<?= ($update['user_id']) ?>.png" srcset="<?= ($site['url']) ?>/avatar/96-<?= ($update['user_id']) ?>.png 2x" alt="" width="48" height="48">
                                                    </td>
                                                    <td width="15"></td>
                                                    <td valign="top">
                                                        <table width="100%">
                                                            <tr>
                                                                <td>
                                                                    <a href="<?= ($site['url']) ?>user/<?= ($update['user_username']) ?>" style="font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; line-height: 1.5;font-size: 16px; font-weight: bold; color: #15bc9c; text-decoration: none;">
                                                                        <?= ($this->esc($update['user_name']))."
" ?>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td height="3"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <ul style="padding-left: 20px; margin: 5px 0 5px 0;">
                                                                        <?php foreach (($changes?:[]) as $change): ?>
                                                                            <?php $human_readable=\Helper\Update::instance()->humanReadableValues($change['field'], $change['old_value'], $change['new_value']); ?>
                                                                            <li style="font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; color: #2c3e50; line-height: 1.5; margin-left: 0;">
                                                                                <?php if ($change['old_value']): ?>
                                                                                    
                                                                                        <?php if ($change['new_value'] !== ''): ?>
                                                                                            
                                                                                                <?php if ($change['field'] == 'description'): ?>
                                                                                                    
                                                                                                        <span style="font-weight: bold; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; color: #2c3e50; line-height: 1.5;">
                                                                                                            <?= ($human_readable['field'])."
" ?>
                                                                                                        </span>
                                                                                                        changed
                                                                                                    
                                                                                                    <?php else: ?>
                                                                                                        <span style="font-weight: bold; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; color: #2c3e50; line-height: 1.5;">
                                                                                                            <?= ($human_readable['field'])."
" ?>
                                                                                                        </span>
                                                                                                        changed from
                                                                                                        <span style="font-style: italic; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; color: #2c3e50; line-height: 1.5;">
                                                                                                            <?= ($this->esc($human_readable['old']))."
" ?>
                                                                                                        </span>
                                                                                                        to
                                                                                                        <span style="font-style: italic; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; color: #2c3e50; line-height: 1.5;">
                                                                                                            <?= ($this->esc($human_readable['new']))."
" ?>
                                                                                                        </span>
                                                                                                    
                                                                                                <?php endif; ?>
                                                                                            
                                                                                            <?php else: ?>
                                                                                                <span style="font-weight: bold; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; color: #2c3e50; line-height: 1.5;">
                                                                                                    <?= ($human_readable['field'])."
" ?>
                                                                                                </span>
                                                                                                removed
                                                                                            
                                                                                        <?php endif; ?>
                                                                                    
                                                                                    <?php else: ?>
                                                                                        <span style="font-weight: bold; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; color: #2c3e50; line-height: 1.5;">
                                                                                            <?= ($human_readable['field'])."
" ?>
                                                                                        </span>
                                                                                        set to
                                                                                        <span style="font-style: italic; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; color: #2c3e50; line-height: 1.5;">
                                                                                            <?= ($this->esc($human_readable['new']))."
" ?>
                                                                                        </span>
                                                                                    
                                                                                </li>
                                                                            <?php endif; ?>
                                                                        <?php endforeach; ?>
                                                                    </ul>
                                                                </td>
                                                            </tr>

                                                            <?php if ($update['comment_id']): ?>
                                                                <tr>
                                                                    <td height="3"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; color: #2c3e50; line-height: 1.5;">
                                                                        <?= ($this->parseText($update['comment_text']))."
" ?>
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>

                                                            <tr>
                                                                <td height="3"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; color: #95a5a6; line-height: 1.5;">
                                                                    <?= (date("D, M j, Y \\a\\t g:ia", $this->utc2local($update['created_date'])))."
" ?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>

                                        </td>
                                        <td width="15"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" height="15"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <?php echo $this->render('notification/blocks/actions.html',NULL,get_defined_vars(),0); ?>
                        <?php echo $this->render('notification/blocks/footer.html',NULL,get_defined_vars(),0); ?>

                    </table>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>
