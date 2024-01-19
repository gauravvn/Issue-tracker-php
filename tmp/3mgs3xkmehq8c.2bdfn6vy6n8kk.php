<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Issue #<?= ($issue['id']) ?> - <?= ($this->esc($issue['name'])) ?> created</title>
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
                                            Issue <a href="<?= ($site['url']) ?>issues/<?= ($issue['id']) ?>" style="font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 18px; color: #ffffff; text-decoration: underline; line-height: 1.5;">#<?= ($issue['id']) ?> &ndash; <?= ($this->esc($issue['name'])) ?></a> created
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

                                            <!-- Creation -->
                                            <table width="100%">
                                                <tr>
                                                    <td style="font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; color: #2c3e50; line-height: 1.5;">
                                                        <ul style="padding-left: 20px; margin: 5px 0 5px 0;">
                                                            <li style="font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; color: #2c3e50; line-height: 1.5;">
                                                                <span style="font-weight: bold; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; color: #2c3e50; line-height: 1.5;">Author:</span>
                                                                <?= ($this->esc($issue['author_name']))."
" ?>
                                                            </li>
                                                        </ul>
                                                        <ul style="padding-left: 20px; margin: 5px 0 5px 0;">
                                                            <li style="font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; color: #2c3e50; line-height: 1.5;">
                                                                <span style="font-weight: bold; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; color: #2c3e50; line-height: 1.5;">Assigned to:</span>
                                                                <?= ($this->esc($issue['owner_name']))."
" ?>
                                                            </li>
                                                        </ul>
                                                        <ul style="padding-left: 20px; margin: 5px 0 5px 0;">
                                                            <li style="font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; color: #2c3e50; line-height: 1.5;">
                                                                <span style="font-weight: bold; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; color: #2c3e50; line-height: 1.5;">Priority:</span>
                                                                <?= ($this->esc($issue['priority_name']))."
" ?>
                                                            </li>
                                                        </ul>
                                                        <ul style="padding-left: 20px; margin: 5px 0 5px 0;">
                                                            <li style="font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; color: #2c3e50; line-height: 1.5;">
                                                                <span style="font-weight: bold; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; color: #2c3e50; line-height: 1.5;">Status:</span>
                                                                <?= ($this->esc($issue['status_name']))."
" ?>
                                                            </li>
                                                        </ul>
                                                        <span style="font-weight: bold; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; color: #2c3e50; line-height: 1.5;">Description:</span><br>
                                                        <?= (nl2br(htmlentities(strip_tags($issue['description']))))."
" ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="3"></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; color: #95a5a6; line-height: 1.5;">
                                                        <?= (date("D, M j, Y \\a\\t g:ia", $this->utc2local($issue['created_date'])))."
" ?>
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
