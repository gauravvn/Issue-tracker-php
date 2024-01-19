<!DOCTYPE html>
<html lang="<?= ($this->lang()) ?>">
<head>
    <?php echo $this->render('blocks/head.html',NULL,get_defined_vars(),0); ?>
    <?php if ($parse['markdown'] && !$user_obj->option('disable_mde')): ?>
        <link rel="stylesheet" type="text/css" href="<?= ($BASE) ?>/css/easymde.min.css">
    <?php endif; ?>
</head>
<body>
<?php $fullwidth=true; ?>
<?php echo $this->render('blocks/navbar.html',NULL,get_defined_vars(),0); ?>
<div class="container-fluid">

    <div id="form-edit" style="display: none;">
        <?php echo $this->render('issues/edit-form.html',NULL,get_defined_vars(),0); ?>
        <hr>
    </div>

    <div id="alert" class="alert alert-success alert-popup alert-popup-center clearfix" style="display: none;">
        <button type="button" class="close">&times;</button>
        <span></span>
    </div>

    <?php if ($issue['deleted_date']): ?>
        <div id="alert" class="alert alert-danger">
            <?= ($dict['deleted_notice']) ?>&ensp;
            <form style="display: inline-block;" action="<?= ($BASE) ?>/issues/undelete/<?= ($issue['id']) ?>" method="post">
                <input type="hidden" name="csrf-token" value="<?= $this->esc($csrf_token) ?>" />
                <button type="submit" class="btn btn-default btn-xs"><?= ($dict['restore_issue']) ?></button>
            </form>
        </div>
    <?php endif; ?>

    <?php if (count($ancestors) > 1): ?>
        <div class="clearfix">
            <ol class="breadcrumb pull-left">
                <?php foreach (($ancestors?:[]) as $crumb): ?>
                    <?php if ($crumb['id'] != $issue['id']): ?>
                        <li class="active">
                            <a href="<?= ($BASE) ?>/issues/<?= ($crumb['id']) ?>">
                                <?= ($this->esc($crumb['name'])) ?> <small>#<?= ($crumb['id']) ?></small>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ol>
        </div>
    <?php endif; ?>
    <div class="clearfix">
        <h3 class="pull-left issue-heading">
            <a href="<?= ($BASE) ?>/issues/<?= ($issue['id']) ?>" class="nolink"><?= ($this->esc($issue['name'])) ?></a>
            <?php if ($issue['size_estimate']): ?>
                - <?= ($issue['size_estimate'])."
" ?>
            <?php endif; ?>
            <small>#<?= ($issue['id']) ?></small>
        </h3>
        <div class="pull-right">
            <?php if ($issue['status_closed']): ?>
                
                    <form style="display: inline-block;" action="<?= ($BASE) ?>/issues/reopen/<?= ($issue['id']) ?>" method="post">
                        <input type="hidden" name="csrf-token" value="<?= $this->esc($csrf_token) ?>" />
                        <button type="submit" id="btn-issue-reopen" class="btn btn-warning btn-xs">
                            <span class="fa fa-repeat"></span>&ensp;<?= ($dict['reopen'])."
" ?>
                        </button>
                    </form>
                
                <?php else: ?>
                    <form style="display: inline-block;" action="<?= ($BASE) ?>/issues/close/<?= ($issue['id']) ?>" method="post">
                        <input type="hidden" name="csrf-token" value="<?= $this->esc($csrf_token) ?>" />
                        <button type="submit" id="btn-issue-close" class="btn btn-success btn-xs">
                            <span class="fa fa-check"></span>&ensp;<?= ($dict['complete'])."
" ?>
                        </button>
                    </form>
                
            <?php endif; ?>
            <a id="btn-copy" href="#" class="btn btn-default btn-xs">
                <span class="fa fa-file"></span>&ensp;<?= ($dict['copy'])."
" ?>
            </a>
            <?php if ($watching): ?>
                
                    <button type="button" class="btn btn-default btn-xs" onclick="unwatch_issue();" id="watch-btn">
                        <span class="fa fa-eye-slash"></span>&ensp;<?= ($dict['unwatch'])."
" ?>
                    </button>
                
                <?php else: ?>
                    <button type="button" class="btn btn-default btn-xs" onclick="watch_issue();" id="watch-btn">
                        <span class="fa fa-eye"></span>&ensp;<?= ($dict['watch'])."
" ?>
                    </button>
                
            <?php endif; ?>
            <a id="btn-edit" href="<?= ($BASE) ?>/issues/edit/<?= ($issue['id']) ?>" class="btn btn-default btn-xs">
                <span class="fa fa-pencil"></span>&ensp;<?= ($dict['edit'])."
" ?>
            </a>
            <?php if ($user['role'] == 'admin' || $user['rank'] >= \Model\User::RANK_MANAGER || $user['id'] == $issue['author_id']): ?>
                <form style="display: inline-block;" action="<?= ($BASE) ?>/issues/delete/<?= ($issue['id']) ?>" method="post">
                    <input type="hidden" name="csrf-token" value="<?= $this->esc($csrf_token) ?>" />
                    <button type="submit" class="btn btn-danger btn-xs">
                        <span class="fa fa-remove"></span><span class="hidden-xs">&ensp;<?= ($dict['delete']) ?></span>
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-5">
            <?php if ($type['role'] == 'project'): ?>
                <p><a href="<?= ($BASE) ?>/issues/project/<?= ($issue['id']) ?>" class="btn btn-default btn-sm"><?= ($dict['project_overview']) ?></a></p>
            <?php endif; ?>

            <b><?= ($dict['cols']['author']) ?></b>
            <div class="issue-head clearfix">
                <img src="<?= ($this->esc($author->avatar(48))) ?>" srcset="<?= ($this->esc($author->avatar(96))) ?> 2x" class="profile-picture img-rounded" alt>
                <p class="pull-left">
                    <?php if ($author['username']): ?>
                        
                            <a href="<?= ($BASE) ?>/user/<?= ($author['username']) ?>"><?= ($this->esc($author['name'])) ?></a>
                        
                        <?php else: ?>
                            <?= ($this->esc($author['name']))."
" ?>
                        
                    <?php endif; ?>
                    <br><em><?= ($author['email'] ?: $author['username']) ?></em>
                </p>
            </div>

            <?php if ($owner['id']): ?>
                <b><?= ($dict['cols']['assignee']) ?></b>
                <div class="issue-head clearfix">
                    <img src="<?= ($this->esc($owner->avatar(48))) ?>" srcset="<?= ($this->esc($owner->avatar(96))) ?> 2x" class="profile-picture img-rounded" alt>
                    <p class="pull-left">
                        <?php if ($owner['username']): ?>
                            
                                <a href="<?= ($BASE) ?>/user/<?= ($owner['username']) ?>"><?= ($this->esc($owner['name'])) ?></a>
                            
                            <?php else: ?>
                                <?= ($this->esc($owner['name']))."
" ?>
                            
                        <?php endif; ?>
                        <br><em><?= ($owner['email'] ?: $owner['username']) ?></em>
                    </p>
                </div>
            <?php endif; ?>

            <dl class="dl-inline">
                <?php if ($issue['sprint_id']): ?>
                    <dt><?= ($dict['cols']['sprint']) ?></dt>
                    <dd><a href="<?= ($BASE) ?>/taskboard/<?= ($sprint['id']) ?>"><?= ($this->esc($sprint['name'])) ?> <?= (date('n/j', strtotime($sprint['start_date']))) ?>-<?= (date('n/j', strtotime($sprint['end_date']))) ?></a></dd>
                <?php endif; ?>

                <dt><?= ($dict['cols']['created']) ?></dt>
                <dd title="<?= (date('Y-m-d H:i:s', $this->utc2local($issue['created_date']))) ?>"><?= (date("M j, Y \\a\\t g:ia", $this->utc2local($issue['created_date']))) ?></dd>

                <dt><?= ($dict['cols']['type']) ?></dt>
                <dd><?= ($this->esc(isset($dict[$type['name']]) ? $dict[$type['name']] : str_replace('_', ' ', $type['name']))) ?></dd>

                <dt><?= ($dict['cols']['priority']) ?></dt>
                <dd><?= ($this->esc(isset($dict[$issue['priority_name']]) ? $dict[$issue['priority_name']] : str_replace('_', ' ', $issue['priority_name']))) ?></dd>

                <dt><?= ($dict['cols']['status']) ?></dt>
                <dd><?= ($this->esc(isset($dict[$issue['status_name']]) ? $dict[$issue['status_name']] : str_replace('_', ' ', $issue['status_name']))) ?></dd>

                <?php if ($issue['repeat_cycle']): ?>
                    <dt><?= ($dict['cols']['repeat_cycle']) ?></dt>
                    <dd><?= (ucfirst($issue['repeat_cycle'])) ?></dd>
                <?php endif; ?>

                <?php if (!empty($issue['hours_spent'])): ?>
                    <dt><?= ($dict['cols']['total_spent_hours']) ?></dt>
                    <dd><?= ($issue['hours_spent']) ?></dd>
                <?php endif; ?>

                <?php if (!empty($issue['hours_total'])): ?>
                    <dt><?= ($dict['cols']['hours_total']) ?></dt>
                    <dd><?= ($issue['hours_total'] ?: 0) ?></dd>

                    <dt><?= ($dict['cols']['hours_remaining']) ?></dt>
                    <dd><?= ($issue['hours_remaining'] ?: 0) ?></dd>
                <?php endif; ?>

                <?php if ($issue['start_date'] && strtotime($issue['start_date'])): ?>
                    <dt><?= ($dict['cols']['start_date']) ?></dt>
                    <dd><?= (date("D, M j, Y", strtotime($issue['start_date']))) ?></dd>
                <?php endif; ?>

                <?php if ($issue['due_date'] && strtotime($issue['due_date'])): ?>
                    <dt><?= ($dict['cols']['due_date']) ?></dt>
                    <dd><?= (date("D, M j, Y", strtotime($issue['due_date']))) ?></dd>
                <?php endif; ?>
            </dl>

            <?php \Helper\Plugin::instance()->callHook('render.issue_single.before_description', $issue) ?>

            <dl>
                <dt><?= ($dict['cols']['description']) ?>:</dt>
                <dd class="tex"><?= ($this->parseText($issue['description'])) ?></dd>
            </dl>

            <?php \Helper\Plugin::instance()->callHook('render.issue_single.after_description', $issue) ?>

            <hr class="hidden-lg">
        </div>

        <div class="col-lg-7">
            <?php \Helper\Plugin::instance()->callHook('render.issue_single.before_files', $issue) ?>

            <ul class="nav nav-tabs" role="tablist">
                <li class="disabled"><a><?= ($dict['files']) ?></a></li>
                <li class="active"><a href="#files-tiles" data-toggle="tab"><span class="fa fa-th-large"></span></a></li>
                <li><a href="#files-table" data-toggle="tab"><span class="fa fa-list"></span></a></li>
            </ul>

            <?php \Helper\Plugin::instance()->callHook('render.issue_single.before_comments', $issue) ?>

            <div class="tab-content">
                <?php if (!empty($files)): ?>
                    <div class="tab-pane fade in active" id="files-tiles">
                        <ul class="list-inline file-list">
                            <?php foreach (($files?:[]) as $file): ?>
                                <?php echo $this->render('blocks/file/thumb.html',NULL,get_defined_vars(),0); ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="files-table">
                        <div class="table-responsive">
                            <table class="table table-striped table-condensed file-list">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th data-sort="string"><?= ($dict['file_name']) ?></th>
                                        <th data-sort="string"><?= ($dict['uploaded_by']) ?></th>
                                        <th data-sort="int"><?= ($dict['upload_date']) ?></th>
                                        <th data-sort="int"><?= ($dict['file_size']) ?></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach (($files?:[]) as $file): ?>
                                        <tr id="ft-<?= ($file['id']) ?>" data-id="<?= ($file['id']) ?>">
                                            <td data-sort-value="<?= ($this->esc($file['content_type'])) ?>">
                                                <img src="<?= ($BASE) ?>/img/mime/16/<?= (\Helper\File::mimeIcon($file['content_type'])) ?>.svg" alt>
                                            </td>
                                            <td><a class="file-attachment" href="<?= ($BASE) ?>/files/<?= ($file['id']) ?>/<?= ($this->esc($file['filename'])) ?>" target="_blank"><?= ($this->esc($file['filename'])) ?></a></td>
                                            <td><?= ($this->esc($file['user_name'])) ?></td>
                                            <td data-sort-value="<?= (strtotime($file['created_date'])) ?>" title="<?= (date('Y-m-d H:i:s', $this->utc2local($file['created_date']))) ?>"><?= (date('M j, Y \a\t g:ia', $this->utc2local(strtotime($file['created_date'])))) ?></td>
                                            <td data-sort-value="<?= ($file['filesize']) ?>"><?= ($this->formatFilesize($file['filesize'])) ?></td>
                                            <td><button type="button" class="btn btn-xs btn-danger delete" title="<?= ($dict['delete']) ?>">&times;</button></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <p class="clear"></p>
                <?php endif; ?>
            </div>
            <p>
                <a class="btn btn-default btn-sm" data-toggle="modal" href="#" data-target="#upload"><?= ($dict['upload']) ?></a>
            </p>
            <br>
            <ul class="nav nav-tabs">
                <li class="active"><a href="#comments" data-toggle="tab"><?= ($dict['comments']) ?>&ensp;<span class="badge" id="comment_badge"><?= (count($comments)) ?></span></a></li>
                <li><a href="#history" data-toggle="tab" id="tab_history"><?= ($dict['history']) ?></a></li>
                <li><a href="#watchers" data-toggle="tab" id="tab_watchers"><?= ($dict['watchers']) ?></a></li>
                <?php if ($issue['parent_id']): ?>
                    <li><a href="#related-sibling" data-toggle="tab" id="tab_related-sibling"><?= ($dict['sibling_tasks']) ?></a></li>
                <?php endif; ?>
                <li><a href="#related-child" data-toggle="tab" id="tab_related-child"><?= ($dict['child_tasks']) ?></a></li>
                <li><a href="#dependencies" data-toggle="tab" id="tab_dependencies"><?= ($dict['dependencies']) ?>&ensp;<span class="badge" id="dependencies_badge"></span></a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="comments">
                    <div class="comments">
                        <form action="<?= ($BASE) ?>/issues/comment/save" method="POST" id="comment_form" class="form-horizontal">
                            <input type="hidden" name="csrf-token" value="<?= $this->esc($csrf_token) ?>" />
                            <input type="hidden" name="issue_id" value="<?= ($issue['id']) ?>">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <textarea class="form-control input-sm" id="comment_textarea" name="text" placeholder="<?= ($dict['write_a_comment']) ?>" rows="4"></textarea>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="checkbox checkbox-container-inline">
                                    <label>
                                        <input type="checkbox" name="notify" value="1" checked>
                                        <?= ($dict['send_notifications'])."
" ?>
                                    </label>
                                </div>&ensp;
                                <button type="button" class="btn btn-default btn-sm has-tooltip" title="<?= ($dict['upload_a_file']) ?>" data-placement="top" data-toggle="modal" data-target="#upload" id="btn-attach-file"><span class="fa fa-file"></span></button>
                                <button type="submit" class="btn btn-primary btn-sm"><?= ($dict['save_comment']) ?></button>
                            </div>
                        </form>
                        <?php foreach (($comments?:[]) as $comment): ?>
                            <?php echo $this->render('blocks/issue-comment.html',NULL,get_defined_vars(),0); ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="history">
                    <div class="col-sm-4 col-sm-offset-4">
                        <div class="progress progress-striped active">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="watchers">
                    <div class="col-sm-4 col-sm-offset-4">
                        <div class="progress progress-striped active">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
                <?php if ($issue['parent_id']): ?>
                    <div class="tab-pane fade" id="related-sibling">
                        <div class="col-sm-4 col-sm-offset-4">
                            <div class="progress progress-striped active">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="tab-pane fade" id="related-child">
                    <div class="col-sm-4 col-sm-offset-4">
                        <div class="progress progress-striped active">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="dependencies">
                    <div class="col-sm-4 col-sm-offset-4">
                        <div class="progress progress-striped active">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php echo $this->render('blocks/footer.html',NULL,get_defined_vars(),0); ?>
</div>

<form class="modal fade in" id="upload" tabindex="-1" method="post" enctype="multipart/form-data" action="<?= ($BASE) ?>/issues/upload">
    <input type="hidden" name="csrf-token" value="<?= $this->esc($csrf_token) ?>" />
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= ($dict['close']) ?></span></button>
                <h4 class="modal-title"><?= ($dict['upload_a_file']) ?></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="issue_id" value="<?= ($issue['id']) ?>" />
                <div class="form-group">
                    <input type="file" name="attachment">
                </div>
                <textarea class="form-control input-sm" id="file_comment_textarea" name="text" placeholder="<?= ($dict['write_a_comment']) ?>"></textarea>
            </div>
            <div class="modal-footer">
                <div class="checkbox checkbox-container-inline">
                    <label>
                        <input type="checkbox" name="notify" value="1" checked>
                        <?= ($dict['send_notifications'])."
" ?>
                    </label>
                </div>&ensp;
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><?= ($dict['cancel']) ?></button>
                <button type="submit" class="btn btn-sm btn-primary"><?= ($dict['upload']) ?></button>
            </div>
        </div>
    </div>
</form>

<div class="modal fade" id="modal-copy" tabindex="-1" role="dialog" aria-labelledby="modal-copy-label" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" action="<?= ($BASE) ?>/issues/copy/<?= ($issue['id']) ?>" method="post">
            <input type="hidden" name="csrf-token" value="<?= $this->esc($csrf_token) ?>" />
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= ($dict['close']) ?></span></button>
                <h4 class="modal-title" id="modal-copy-label"><?= ($dict['copy_issue']) ?></h4>
            </div>
            <div class="modal-body">
                <div id="pre-copy"><?= ($dict['copy_issue_details']) ?></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><?= ($dict['cancel']) ?></button>
                <button type="submit" id="btn-copy-confirm" class="btn btn-primary btn-sm"><?= ($dict['copy_issue']) ?></button>
            </div>
        </div>
    </div>
</div>

<script src="<?= ($BASE) ?>/js/bootstrap-datepicker.js"></script>
<script src="<?= ($BASE) ?>/js/stupidtable.min.js"></script>
<script src="<?= ($BASE) ?>/js/typeahead.jquery.js"></script>
<script src="<?= ($BASE) ?>/js/autosize.min.js"></script>
<?php if ($user_obj->date_picker()->js && $user_obj->date_picker()->language != 'en-US'): ?>
    <script src="<?= ($BASE) ?>/js/bootstrap-datepicker.<?= ($user_obj->date_picker()->language) ?>.min.js"></script>
<?php endif; ?>
<?php if ($parse['markdown'] && !$user_obj->option('disable_mde')): ?>
    <script src="<?= ($BASE) ?>/js/easymde.min.js"></script>
<?php endif; ?>
<script type="text/javascript">
$(function() {
    // Handle copy modal
    $("#btn-copy").click(function(e) {
        $("#modal-copy").modal("show");
        e.preventDefault();
    });
    $("#btn-copy-confirm").click(function(e) {
        var $btn = $(this);
        setTimeout(function () {
            $btn.prop('disabled', true)
                .addClass('disabled')
                .html('<?= (addslashes($dict['loading'])) ?>');
        }, 100);
    });

    var canDelete = parseInt("<?= (($user['role'] == 'admin' || $user['rank'] >= \Model\User::RANK_MANAGER) && $menuitem != 'index') ?>");

    autosize($('#comment_textarea'));

    // AJAX comment submission
    $('#comment_form').submit(function(e) {
        var $this = $(this);
        if($this.children('textarea').val() !== '') {
            $('#comment_form .btn').prop('disabled', true);
            $.post($this.attr('action'), $this.serialize(), function(data) {
                $('#comment_form .btn').prop('disabled', false);
                if(data.error) {
                    return;
                }
                // Append the new comment to the list
                $('#comment_form')
                    .after(
                        '<div class="media" id="c-' + data.id + '" data-id="' + data.id + '">' +
                            '<a class="media-left" href="<?= ($BASE) ?>/user/' + data.user_username + '">' +
                                '<img src="<?= ($this->esc($user_obj->avatar(48))) ?>" srcset="<?= ($this->esc($user_obj->avatar(96))) ?> 2x" class="media-object profile-picture img-rounded" alt>' +
                            '</a>' +
                            '<div class="media-body">' +
                                '<p class="media-heading">' +
                                    '<a href="<?= ($BASE) ?>/user/' + data.user_username + '">' + data.user_name + '</a>' +
                                    (canDelete ? '<a class="comment-delete" title="<?= ($dict['delete']) ?>"><span class="close">&times;</span></a>' : '') +
                                '</p>' +
                                '<div class="tex">' + data.text + '</div>' +
                                '<p class="text-muted"><small>' + data.date_formatted + '</small></p>' +
                            '</div>' +
                        '</div>');
                $('#comment_textarea').val('').html('');
                autosize.update($('#comment_textarea'));
                $('#comment_badge').text(parseInt($('#comment_badge').text()) + 1);
            }, 'json').fail(function() {
                $('#comment_form .btn').prop('disabled', false);
                showAlert('An error occurred saving this comment.');
            });

            $this.prop('disabled', true);
        }
        e.preventDefault();
    });

    // Load history, watchers, and related issues
    $.get(BASE + '/issues/<?= ($issue['id']) ?>/history', {}, function(data) {
        $('#history').empty().append(data.html);
        $('#tab_history').html('<?= (addslashes($dict['history'])) ?>&ensp;<span class="badge">' + data.total + '</span>');
    }, 'json').fail(function() {
        $('#history').empty().append($('<p />').addClass('text-center text-danger').text('<?= (addslashes($dict['error']['loading_issue_history'])) ?>'));
    });
    $.get(BASE + '/issues/<?= ($issue['id']) ?>/watchers', {}, function(data) {
        $('#watchers').empty().append(data.html);
        $('#tab_watchers').html('<?= (addslashes($dict['watchers'])) ?>&ensp;<span class="badge" id="watchers-badge">' + data.total + '</span>');

        // Add/remove watchers from tab
        $('#watchers-list').on('click', 'a.delete', function(e) {
            var $li = $(this).parents('li');
            $.post(BASE + '/issues/<?= ($issue['id']) ?>/watchers/delete', {
                user_id: $li.data('user-id')
            }).fail(function() {
                showAlert('Failed to remove watcher');
            });

            var matches = $('#watchers-list li').filter('[data-user-id=' + $li.data('user-id') + ']');
            $('#watchers-badge').text(parseInt($('#watchers-badge').text()) - matches.length);
            matches.remove();

            e.preventDefault();
        });
        $('#add-watcher').submit(function(e) {
            var $this = $(this);
            $.post(BASE + '/issues/<?= ($issue['id']) ?>/watchers', $this.serialize()).fail(function() {
                showAlert('Failed to add watcher');
            });

            var $select = $this.find('select');
            if(!$('#watchers-list li').filter('[data-user-id=' + $select.val() + ']').length) {
                $('<li />')
                    .attr('data-user-id', $select.val())
                    .html('<a href="#" class="delete text-danger"><span class="fa fa-remove"></span></a>&ensp;' + $select.children('option:selected').text())
                    .appendTo('#watchers-list');

                $('#watchers-badge').text(parseInt($('#watchers-badge').text()) + 1);
            }

            e.preventDefault();
        });

    }, 'json').fail(function() {
        $('#watchers').empty().append($('<p />').addClass('text-center text-danger').text('<?= (addslashes($dict['error']['loading_issue_watchers'])) ?>'));
    });
    if(parseInt('<?= ($issue['parent_id']) ?>')) {
        $.get(BASE + '/issues/<?= ($issue['parent_id']) ?>/related?exclude=<?= ($issue['id']) ?>', {}, function(data) {
            $('#related-sibling').empty().append(data.html);
            $('#tab_related-sibling').html($('#tab_related-sibling').text() + '&ensp;<span class="badge">' + data.open +' / '+ data.total + '</span>');
            $('#related-sibling table').stupidtable();
        }, 'json').fail(function() {
            $('#related-sibling').empty().append($('<p />').addClass('text-center text-danger').text('<?= (addslashes($dict['error']['loading_related_issues'])) ?>'));
        });
    }
    $.get(BASE + '/issues/<?= ($issue['id']) ?>/related', {}, function(data) {
        $('#related-child').empty().append(data.html);
        $('#tab_related-child').html($('#tab_related-child').text() + '&ensp;<span class="badge">' + data.open +' / '+ data.total + '</span>');
        $('#related-child table').stupidtable();
    }, 'json').fail(function() {
        $('#related-child').empty().append($('<p />').addClass('text-center text-danger').text('<?= (addslashes($dict['error']['loading_related_issues'])) ?>'));
    });

    // Load dependencies
    var load_dependencies = function() {
        $.get(BASE + '/issues/<?= ($issue['id']) ?>/dependencies', {}, function(data) {
            $('#dependencies').empty().append(data.html);
            $('#dependencies_badge').text(data.total);
            $('#dependencies table').stupidtable();

            $('#dependency_form input[name="dependency_id"],#dependent_form input[name="issue_id"]').typeahead({
                classNames: {
                    menu: 'dropdown-menu',
                }
            }, {
                async: true,
                limit: 10,
                source: function(query, syncResults, asyncResults) {
                    $.ajax({
                        url: BASE + '/issues/parent_ajax',
                        data: { 'q': query },
                        success: function(data) {
                            asyncResults(data.results);
                        },
                        dataType: 'json',
                        cache: false,
                    });
                },
                display: function(element) {
                    return element.id;
                },
                templates: {
                    suggestion: function(element) {
                        return '<div><span class="text-muted">#' + element.id + '</span> ' + new Option(element.text).innerHTML + '</div>';
                    }
                }
            });
        }, 'json').fail(function() {
            $('#dependencies').empty().append($('<p />').addClass('text-center text-danger').text('<?= (addslashes($dict['error']['loading_dependencies'])) ?>'));
        });
    };
    load_dependencies();

    // Add/remove dependencies from tab
    $('#dependencies').on('click', 'a.delete', function(e) {
        var $tr = $(this).parents('tr');
        $.post(BASE + '/issues/<?= ($issue['id']) ?>/dependencies/delete', {
            id: $tr.data('id')
        }).fail(function() {
            showAlert('Failed to remove dependency');
        });

        $tr.fadeOut(400, function(){
            $tr.remove();
        });

        $('#dependencies_badge').text(parseInt($('#dependencies_badge').text())  - 1);
        e.preventDefault();
    });
    $('#dependencies').on('submit', 'form', function(e) {
        var $this = $(this);
        $.post(BASE + '/issues/<?= ($issue['id']) ?>/dependencies', $this.serialize()).fail(function() {
            showAlert('Failed to add dependency');
        });

        e.preventDefault();
        load_dependencies();
    });

    // Handle inline edit form
    var hasClickedEdit = false;
    $("#btn-edit, #form-edit .close, #form-edit .btn-cancel").click(function(e) {
        if(!e.which || e.which == 1) {
            var $form = $('#form-edit');
            if ($form.is(':visible')) {
                $("#form-edit").slideUp("fast");
            } else {
                window.scrollTo(0, 0);
                $("#form-edit").slideDown("fast", function() {
                    $('#edit-form input[name="name"]').focus();
                });
            }
            if(!hasClickedEdit) {
                hasClickedEdit = true;
                if ('EasyMDE' in window) {
                    var mde = new EasyMDE({
                        autoDownloadFontAwesome: false,
                        element: $('input[name="description"]')[0],
                        toolbar: ['bold', 'italic', 'heading', '|', 'quote', 'unordered-list', 'ordered-list', '|', 'link', 'image', '|', 'preview', 'guide'],
                        forceSync: true
                    });
                    mde.render();
                }
            }
            e.preventDefault();
        }
    });

    // Enable datepickers
    $('#due_date, #start_date').datepicker({
        format: 'yyyy-mm-dd',
        language: '<?= ($user_obj->date_picker()->language) ?>',
        todayHighlight: true,
        autoclose: true
    });

    // Add file thumbnail popovers
    $('#files-tiles li').each(function() {
        $el = $(this);
        $el.popover({
            trigger: 'hover',
            html: true,
            delay: {
                show: 250,
                hide: 50
            },
            container: 'body',
            placement: 'auto right',
            content: '<b>' + $el.attr('data-name') + '</b><br>' + $el.attr('data-user') + '<br>' + $el.attr('data-date') + '<br>' +$el.attr('data-size')
        });
    });

    // Handle file deletion
    $('.file-list').on('click', '.delete', function(e) {
        var $file = $(this).parents('li, tr');
        $file.fadeTo(100, 0.5).popover('hide');
        $.post(BASE + '/issues/file/delete', {id: $file.data('id')}, function(data) {
            $('#alert span').html('<?= (addslashes($dict['file_deleted'])) ?> <a class="alert-link" href="javascript:void(0);" onclick="restoreFile(' + data.id + ')"><?= ($dict['undo']) ?></a>');
            $('#alert').show();
            $(".file-list li[data-id='" + data.id + "'], .file-list tr[data-id='" + data.id + "']").remove();
        }, 'json').fail(function() {
            showAlert('Failed to remove file');
        });
    });

    // Handle alert hide
    $('#alert .close').click(function(e) {
        $('#alert span').empty();
        $('#alert').hide();
    });

    // Handle comment deletion
    $('.comments').on('click', '.comment-delete', function(e) {
        if(confirm("<?= ($dict['comment_delete_confirm']) ?>")) {
            var $comment = $(this).parents(".media");
            $comment.css("text-decoration", "line-through");
            $.post(BASE + "/issues/comment/delete", {id: $comment.data("id")}, function() {
                $comment.remove();
            }, 'json').fail(function() {
                showAlert('Failed to remove comment');
            });
        }
    });

    // Handle attachment adding button
    $('#btn-attach-file').click(function(e) {
        $('#file_comment_textarea').val($('#comment_textarea').val());
    });

    // Reset file upload form on close
    $('#upload').on('hidden.bs.modal', function() {
        $('#upload')[0].reset();
    });

    // Enable typeahead
    $('input[name="parent_id"]').typeahead({
        classNames: {
            menu: 'dropdown-menu',
        }
    }, {
        async: true,
        limit: 10,
        source: function(query, syncResults, asyncResults) {
            $.ajax({
                url: BASE + '/issues/parent_ajax',
                data: { 'q': query },
                success: function(data) {
                    asyncResults(data.results);

                },
                dataType: 'json',
                cache: false,
            });
        },
        display: function(element) {
            return element.id;
        },
        templates: {
            suggestion: function(element) {
                return '<div><span class="text-muted">#' + element.id + '</span> ' + new Option(element.text).innerHTML + '</div>';
            }
        }
    });

    // Make file table sortable
    $('#files-table table').stupidtable();

    // Prevent navigation with unsaved changes
    var $editForm = $('#edit-form'),
        formSerialized = $editForm.serialize();
    $(window).on('beforeunload', function() {
        if($editForm.length && $editForm.serialize() !== formSerialized) {
            return '<?= (addslashes($dict['unsaved_changes'])) ?>';
        }
    });
    $editForm.submit(function() {
        $(window).off('beforeunload');
    });

});
function restoreFile(file_id) {
    $.post(BASE + '/issues/file/undelete', {id: file_id}, function(data) {
        window.location = window.location;
    }).fail(function() {
        showAlert('Failed to restore file');
    });
}
function watch_issue() {
    $.post(BASE + '/issues/<?= ($issue['id']) ?>/watchers', {user_id: '<?= ($user['id']) ?>'}).fail(function() {
        showAlert('Failed to watch issue');
    });
    $('#watch-btn').attr('onclick','unwatch_issue()').html('<span class="fa fa-eye-slash"></span>&ensp;<?= ($dict['unwatch']) ?>');
}
function unwatch_issue() {
    $.post(BASE + '/issues/<?= ($issue['id']) ?>/watchers/delete', {user_id: '<?= ($user['id']) ?>'}).fail(function() {
        showAlert('Failed to unwatch issue');
    });
    $('#watch-btn').attr('onclick','watch_issue()').html('<span class="fa fa-eye"></span>&ensp;<?= ($dict['watch']) ?>');
}
</script>
</body>
</html>
