<tr>
    <td class="actions">
        <table bgcolor="#ecf0f1" style="border-radius: 0 0 4px 4px;" width="100%">
            <tr>
                <td colspan="3" height="15"></td>
            </tr>
            <tr>
                <td width="15"></td>
                <td width="100">
                    <a href="<?= ($site['url']) ?>issues/<?= ($issue['id']) ?>" style="color: #ffffff; text-decoration: none;">
                        <table bgcolor="#3498db" class="btn" width="100%" style="border-radius: 5px;">
                            <tr>
                                <td height="5"></td>
                            </tr>
                            <tr>
                                <td align="center" style="font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; color: #ffffff; text-decoration: none;">
                                    View Issue
                                </td>
                            </tr>
                            <tr>
                                <td height="5"></td>
                            </tr>
                        </table>
                    </a>
                </td>
                <td width="10"></td>
                <td style="font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; color: #95a5a6;">
                    <?php if ($imap['hostname']): ?>
                        Or reply to this message to leave a comment
                    <?php endif; ?>
                </td>
                <td width="15"></td>
            </tr>
            <tr>
                <td colspan="3" height="15"></td>
            </tr>
        </table>
    </td>
</tr>
