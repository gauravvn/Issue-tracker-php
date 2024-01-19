<?php foreach (($updates?:[]) as $update): ?>
    <div class="media" id="u-<?= ($update['id']) ?>">
        <a class="media-left" href="<?= ($BASE) ?>/user/<?= ($update['user_username']) ?>">
            <img src="<?= ($BASE) ?>/avatar/48-<?= ($update['user_id']) ?>.png" srcset="<?= ($BASE) ?>/avatar/96-<?= ($update['user_id']) ?>.png 2x" class="media-object profile-picture img-rounded" alt>
        </a>
        <div class="media-body">
            <p class="media-heading">
                <?php if ($update['user_username']): ?>
                    
                        <a href="<?= ($BASE) ?>/user/<?= ($update['user_username']) ?>"><?= ($this->esc($update['user_name'])) ?></a>
                    
                    <?php else: ?>
                        <?= ($update['user_name'])."
" ?>
                    
                <?php endif; ?>
                on <span title="<?= (date('Y-m-d H:i:s', $this->utc2local($update['created_date']))) ?>"><?= (date("D, M j, Y \\a\\t g:ia", $this->utc2local($update['created_date']))) ?></span>
                <?php if ($update['notify']): ?>
                    &ensp;<span class="fa fa-envelope text-success" title="<?= ($dict['notifications_sent']) ?>"></span>
                <?php endif; ?>
                <?php if ($update['notify'] === 0): ?>
                    &ensp;<span class="fa fa-envelope text-danger" title="<?= ($dict['notifications_not_sent']) ?>"></span>
                <?php endif; ?>
            </p>
            <ul>
                <?php foreach (($update['changes']?:[]) as $change): ?>
                    <?php $humanreadable=\Helper\Update::instance()->humanReadableValues($change['field'], $change['old_value'], $change['new_value']); ?>
                    <?php if ($change['old_value']): ?>
                        
                            <?php if ($change['new_value'] !== ''): ?>
                                
                                    <?php if ($change['field'] == 'description'): ?>
                                        
                                            <li>
                                                <?= (Base::instance()->format($dict['a_changed'],'<b>'.$humanreadable['field'].'</b>')) ?><br>
                                                <?php $diff = new \Neos\Diff\Diff(
                                                    explode("\n", rtrim(str_replace(["\r\n", "\r"], "\n", $change['old_value']) . "\n")),
                                                    explode("\n", rtrim(str_replace(["\r\n", "\r"], "\n", $change['new_value']) . "\n")),
                                                    ["ignoreWhitespace" => true]
                                                ); ?>
                                                <?php $diff_renderer = new \Neos\Diff\Renderer\Html\HtmlInlineRenderer ?>
                                                <?= ($diff->render($diff_renderer))."
" ?>
                                            </li>
                                        
                                        <?php else: ?>
                                            <li><?= (Base::instance()->format($dict['a_changed_from_b_to_c'], '<b>'.$humanreadable['field'].'</b>', '<i>'.$this->esc($humanreadable['old']).'</i>', '<i>'.$this->esc($humanreadable['new']).'</i>')) ?></li>
                                        
                                    <?php endif; ?>
                                
                                <?php else: ?>
                                    <li><?= (Base::instance()->format($dict['a_removed'],'<b>'.$humanreadable['field'].'</b>')) ?></li>
                                
                            <?php endif; ?>
                        
                        <?php else: ?>
                            <li><?= (Base::instance()->format($dict['a_set_to_b'], '<b>'.$humanreadable['field'].'</b>', '<i>'.$this->esc($humanreadable['new']).'</i>')) ?></li>
                        
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
            <?php if ($update['comment_id']): ?>
                <div class="tex"><?= ($this->parseText($update['comment_text'], array('hashtags' => false))) ?></div>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>
<?php if (empty($updates)): ?>
    <p class="text-center text-muted"><?= ($dict['no_history_available']) ?></p>
<?php endif; ?>
