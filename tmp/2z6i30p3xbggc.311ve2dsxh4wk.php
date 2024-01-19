<a class="btn btn-default btn-sm" data-toggle="modal" href="#" data-target="#bulk-actions"><?= ($dict['bulk_update']) ?></a>
<div class="modal fade" id="bulk-actions" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content form-horizontal" action="<?= ($BASE) ?>/issues/bulk_update" method="post">
            <input type="hidden" name="csrf-token" value="<?= $this->esc($csrf_token) ?>" />
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only"><?= ($dict['close']) ?></span>
                </button>
                <h4 class="modal-title"><?= ($dict['bulk_update']) ?></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label label-sm"><?= ($dict['cols']['status']) ?></label>
                    <div class="col-sm-9">
                        <select class="form-control input-sm bulk-input" name="status">
                            <option value=""><?= ($dict['choose_option']) ?></option>
                            <?php foreach (($statuses?:[]) as $item): ?>
                                <option value="<?= ($item['id']) ?>" ><?= ($this->esc($item['name'])) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <?php if ($user['role']=='admin'): ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label label-sm"><?= ($dict['cols']['author']) ?></label>
                        <div class="col-sm-9">
                            <select class="form-control input-sm" name="author_id">
                                <option value=""><?= ($dict['choose_option']) ?></option>
                                <option value="<?= ($user['id']) ?>"><?= ($this->esc($user['name'])) ?></option>
                                <optgroup label="<?= ($dict['groups']) ?>">
                                    <?php foreach (($groups?:[]) as $group): ?>
                                        <option value="<?= ($group['id']) ?>"><?= ($this->esc($group['name'])) ?></option>
                                    <?php endforeach; ?>
                                </optgroup>
                                <optgroup label="<?= ($dict['users']) ?>">
                                    <?php foreach (($users?:[]) as $item): ?>
                                        <option value="<?= ($item['id']) ?>"><?= ($this->esc($item['name'])) ?></option>
                                    <?php endforeach; ?>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label class="col-sm-3 control-label label-sm"><?= ($dict['cols']['assignee']) ?></label>
                    <div class="col-sm-9">
                        <select class="form-control input-sm bulk-input" name="owner_id">
                            <option value=""><?= ($dict['choose_option']) ?></option>
                            <option value="-1"><?= ($dict['not_assigned']) ?></option>
                            <option value="<?= ($user['id']) ?>"><?= ($this->esc($user['name'])) ?></option>
                            <optgroup label="Groups">
                                <?php foreach (($groups?:[]) as $group): ?>
                                    <option value="<?= ($group['id']) ?>"><?= ($this->esc($group['name'])) ?></option>
                                <?php endforeach; ?>
                            </optgroup>
                            <optgroup label="Users">
                                <?php foreach (($users?:[]) as $item): ?>
                                    <option value="<?= ($item['id']) ?>"><?= ($this->esc($item['name'])) ?></option>
                                <?php endforeach; ?>
                            </optgroup>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label label-sm"><?= ($dict['cols']['start_date']) ?></label>
                    <div class="col-sm-9">
                        <input class="form-control input-sm bulk-input" id="start_date" type="text" name="start_date"  value="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label label-sm"><?= ($dict['cols']['due_date']) ?></label>
                    <div class="col-sm-9">
                        <input class="form-control input-sm bulk-input" id="due_date" type="text" name="due_date" value="">
                        <label class="checkbox-inline">
                            <input type="checkbox" name="due_date_sprint" value="1">
                            <?= ($dict['set_sprint_from_due_date'])."
" ?>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label label-sm"><?= ($dict['cols']['parent_id']) ?></label>
                    <div class="col-sm-9">
                        <input class="form-control input-sm bulk-input" type="text" name="parent_id" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label label-sm"><?= ($dict['cols']['priority']) ?></label>
                    <div class="col-sm-9">
                        <select class="form-control input-sm bulk-input" name="priority">
                            <option value=""><?= ($dict['choose_option']) ?></option>
                            <?php foreach (($priorities?:[]) as $item): ?>
                                <option value="<?= ($item['value']) ?>"><?= ($this->esc($item['name'])) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label label-sm"><?= ($dict['cols']['sprint']) ?></label>
                    <div class="col-sm-9">
                        <select class="form-control input-sm bulk-input" name="sprint_id">
                            <option value=""><?= ($dict['choose_option']) ?></option>
                            <option value="-1"><?= ($dict['no_sprint']) ?></option>
                            <?php foreach (($sprints?:[]) as $item): ?>
                                <option value="<?= ($item['id']) ?>" ><?= ($this->esc($item['name'])) ?> <?= (date('n/j', strtotime($item['start_date']))) ?>-<?= (date('n/j', strtotime($item['end_date']))) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label label-sm"><?= ($dict['cols']['type']) ?></label>
                    <div class="col-sm-9">
                        <select class="form-control input-sm bulk-input" name="type_id">
                            <option value=""><?= ($dict['choose_option']) ?></option>
                            <?php foreach (($issue_types?:[]) as $item): ?>
                                <option value="<?= ($item['id']) ?>"><?= ($this->esc($item['name'])) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="update_copy" value="1">
                                <?= ($dict['update_copy'])."
" ?>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="checkbox checkbox-container-inline">
                    <label>
                        <input type="checkbox" name="notify" value="1" checked>
                        <?= ($dict['send_notifications']) ?>&nbsp;
                    </label>
                </div>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><?= ($dict['cancel']) ?></button>
                <button type="submit" id="bulk-submit" class="btn btn-sm btn-primary"><?= ($dict['submit']) ?></button>
            </div>
            <input type="hidden" id="url_query" name="url_query" value="<?= ($this->esc(http_build_query($_GET))) ?>" />
        </form>
    </div>
</div>
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
    $('#bulk-submit').click(function() {
        $('#bulk-actions form :input[isacopy]').remove();
        $('.filter-form :checkbox:checked').not(':submit').clone().attr('type', 'hidden').attr('isacopy','y').appendTo('#bulk-actions form');
    });
    $('#due_date, #start_date').datepicker({
        format: 'yyyy-mm-dd',
        language: datepickerLanguage,
        orientation: 'top auto',
        clearBtn: true,
        todayHighlight: true,
        autoclose: true
    });
});
</script>
