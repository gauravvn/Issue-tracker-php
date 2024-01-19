<?php $headings=array('id', 'title', 'type', 'priority', 'status', 'parent_id', 'author', 'assignee', 'sprint', 'repeat_cycle', 'created', 'due'); ?>
<?php $bulkUpdate=isset($statuses) && isset($groups) && isset($users) && isset($priorities) && isset($sprints) && isset($issue_types); ?>
<?php if (!empty($GET['status']) && $GET['status'] != 'open'): ?>
<?php $headings[] = 'closed' ?>
<?php endif; ?>
<?php $randid=rand(); ?>
<form action="<?= ($BASE) ?>/issues" method="get" class="table-responsive filter-form" id="form-filter-issues-<?= ($randid) ?>">
    <?php if (!empty($heading_links_enabled)): ?>
        <input type="hidden" name="orderby" value="<?= ($this->esc((!empty($GET['orderby']) ? $GET['orderby'] : 'priority'))) ?>" />
        <input type="hidden" name="ascdesc" value="<?= ($this->esc((!empty($GET['ascdesc']) ? $GET['ascdesc'] : 'desc'))) ?>" />
    <?php endif; ?>
    <table class="table table-striped table-hover table-condensed issue-list">
        <thead>
            <?php if (!empty($show_filters)): ?>
                <?php echo $this->render('blocks/issue-list/filters.html',NULL,get_defined_vars(),0); ?>
            <?php endif; ?>
            <tr>
                <?php if ($bulkUpdate): ?>
                    <th><input type="checkbox" class="chk-toggle-all"></th>
                <?php endif; ?>
                <?php if (!empty($heading_links_enabled)): ?>
                    
                        <?php foreach (($headings?:[]) as $heading): ?>
                            <th class="nowrap"><a href="#" class="issue-sort nolink" id="<?= ($heading) ?>">
                                <?php if (!empty($GET['orderby']) && $GET['orderby'] == $heading): ?>
                                    
                                        <?php if (!empty($GET['ascdesc']) && $GET['ascdesc'] == 'asc'): ?>
                                            <span class="fa fa-chevron-up"></span>
                                            <?php else: ?><span class="fa fa-chevron-down"></span>
                                        <?php endif; ?>
                                    
                                <?php endif; ?>
                                <?= (!empty($dict['cols'][$heading]) ? $dict['cols'][$heading] : ucwords(str_replace(array('_', 'id'), array(' ', 'ID'), $heading)))."
" ?>
                            </a></th>
                        <?php endforeach; ?>
                    
                    <?php else: ?>
                        <?php foreach (($headings?:[]) as $heading): ?>
                            <th class="nowrap"><?= (!empty($dict['cols'][$heading]) ? $dict['cols'][$heading] : ucwords(str_replace(array('_', 'id'), array(' ', 'ID'), $heading))) ?></th>
                        <?php endforeach; ?>
                    
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach (($issues['subset']?:[]) as $item): ?>
                <?php echo $this->render('blocks/issue-list/issue.html',NULL,get_defined_vars(),0); ?>
            <?php endforeach; ?>
        </tbody>

    </table>
</form>

<?php if ($bulkUpdate): ?>
    <?php echo $this->render('blocks/issue-list/bulk-update.html',NULL,get_defined_vars(),0); ?>
<?php endif; ?>

<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
    $.ajax({
        url: BASE + '/js/typeahead.jquery.js',
        cache: true,
        dataType: "script",
        success: function() {
            $('input[data-typeahead="issues"]').typeahead({
                classNames: {
                    menu: 'dropdown-menu'
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
                        cache: false
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
            }).bind('typeahead:select', function() {
                $('#form-filter-issues-<?= ($randid) ?>').submit();
            });
        }
    });
});
</script>
