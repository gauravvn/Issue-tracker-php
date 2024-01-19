<tr>
    <td class="logo">
        <table width="100%">
            <tr>
                <td height="20"></td>
            </tr>
            <tr>
                <td>
                    <a href="<?= ($site['url']) ?>" style="font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; color: #2c3e50; font-size: 24px; text-decoration: none;">
                        <?php if (!empty($mail['logo']) || (!empty($site['logo']) && strpos($site['logo'], 'http') === 0)): ?>
                            
                                <img alt="<?= ($this->esc($site['name'])) ?>" src="<?= (@$mail['logo'] ?: $site['logo']) ?>" style="font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; color: #2c3e50; font-size: 24px; vertical-align: bottom;" border="0">
                            
                            <?php else: ?><?= ($this->esc($site['name'])) ?>
                        <?php endif; ?>
                    </a>
                </td>
            </tr>
            <tr>
                <td height="20"></td>
            </tr>
        </table>
    </td>
</tr>
