<div class="media" id="c-<?= ($comment['id']) ?>" data-id="<?= ($comment['id']) ?>">
    <a class="media-left" href="<?= ($BASE) ?>/user/<?= ($comment['user_username']) ?>">
        <img class="profile-picture media-object img-rounded" src="<?= ($BASE) ?>/avatar/48-<?= ($comment['user_id']) ?>.png" srcset="<?= ($BASE) ?>/avatar/96-<?= ($comment['user_id']) ?>.png 2x" alt>
    </a>
    <div class="media-body">
        <p class="media-heading clearfix">
            <a href="<?= ($BASE) ?>/user/<?= ($comment['user_username']) ?>"><?= ($this->esc($comment['user_name'])) ?></a>
            <?php if ($menuitem == 'index'): ?>
                &gt; <a href="<?= ($BASE) ?>/issues/<?= ($comment['issue_id']) ?>" style="<?= ($issue['closed_date'] ? 'text-decoration: line-through;' : '') ?>"><?= ($this->esc($issue['name'])) ?></a>
            <?php endif; ?>
            <?php if (($user['role'] == 'admin' || $user['rank'] >= \Model\User::RANK_MANAGER) && $menuitem != 'index'): ?>
                <a class="comment-delete" title="<?= ($dict['delete']) ?>"><span class="close">&times;</span></a>
            <?php endif; ?>
        </p>
        <div class="tex"><?= ($this->parseText($comment['text'], array('hashtags' => false))) ?></div>
        <?php if ($comment['file_id']): ?>
            <div class="list-group" style="margin: 10px 0; display: inline-block;">
                <?php if ($comment['file_deleted_date']): ?>
                    
                        <div style="display: flex; align-items: center;" data-mime="<?= ($comment['file_content_type']) ?>" target="_blank" class="list-group-item">
                            <img style="margin-right: 5px;" src="<?= ($BASE) ?>/img/mime/16/<?= (\Helper\File::mimeIcon($comment['file_content_type'])) ?>.svg" alt>
                            <span style="text-decoration: line-through;"><?= ($this->esc($comment['file_filename'])) ?></span>
                            <span style="margin-left: 5px;" class="text-danger">[<?= ($dict['deleted']) ?>]</span>
                        </div>
                    
                    <?php else: ?>
                        <a style="display: flex; align-items: center;" href="<?= ($BASE) ?>/files/<?= ($comment['file_id']) ?>/<?= ($this->esc($comment['file_filename'])) ?>" data-mime="<?= ($comment['file_content_type']) ?>" target="_blank" class="list-group-item file-attachment">
                            <img style="margin-right: 5px;" src="<?= ($BASE) ?>/img/mime/16/<?= (\Helper\File::mimeIcon($comment['file_content_type'])) ?>.svg" alt>
                            <?= ($this->esc($comment['file_filename']))."
" ?>
                        </a>
                    
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <p class="text-muted">
            <small title="<?= (date('Y-m-d H:i:s', $this->utc2local($comment['created_date']))) ?>"><?= (date("D, M j, Y \\a\\t g:ia", $this->utc2local($comment['created_date']))) ?></small>
        </p>
    </div>
</div>
