<div class="modal fade" id="mdl-manage-widgets" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" action="<?= ($BASE) ?>/user/dashboard" method="post">
            <input type="hidden" name="csrf-token" value="<?= $this->esc($csrf_token) ?>" />
            <input type="hidden" id="input-widgets" name="widgets" value="">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="<?= ($dict['close']) ?>">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><?= ($dict['manage_widgets']) ?></h4>
            </div>
            <div class="modal-body manage-widgets-list" style="text-transform: capitalize;">
                <h3><?= ($dict['available_widgets']) ?></h3>
                <div class="list-group widget-modal-box-disabled">
                    <?php foreach (($unused_widgets?:[]) as $widget): ?>
                        <div class="list-group-item widget-modal-widget" data-name="<?= ($widget) ?>">
                            <?= (isset($dict[$widget]) ? $dict[$widget] : str_replace('_', ' ', $widget))."
" ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <h3><?= ($dict['enabled_widgets']) ?></h3>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="list-group widget-modal-box">
                            <?php foreach (($dashboard['left']?:[]) as $widget): ?>
                                <div class="list-group-item widget-modal-widget" data-name="<?= ($widget) ?>">
                                    <?= (isset($dict[$widget]) ? $dict[$widget] : str_replace('_', ' ', $widget))."
" ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="list-group widget-modal-box">
                            <?php foreach (($dashboard['right']?:[]) as $widget): ?>
                                <div class="list-group-item widget-modal-widget" data-name="<?= ($widget) ?>">
                                    <?= (isset($dict[$widget]) ? $dict[$widget] : str_replace('_', ' ', $widget))."
" ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><?= ($dict['cancel']) ?></button>
                <button type="submit" class="btn btn-primary btn-sm"><?= ($dict['save']) ?></button>
            </div>
        </form>
    </div>
</div>

<script>
$(function() {
    var widgets = '';

    // Update widget JSON string and hidden input
    var updateWidgets = function() {
        var items = {left: [], right: []};
        $('.widget-modal-box').each(function(i, el) {
            $(el).find('.list-group-item').each(function() {
                items[i ? 'right' : 'left'].push($(this).attr('data-name'));
            });
        });

        widgets = JSON.stringify(items);
        $('#input-widgets').val(widgets);
    };

    // Enable widget arranging
    $('.widget-modal-box,.widget-modal-box-disabled').sortable({
        items: '.widget-modal-widget',
        connectWith: '.widget-modal-box,.widget-modal-box-disabled',
        placeholder: 'list-group-item',
        cursor: 'move',
        revert: 200,
        forcePlaceholderSize: true,
        tolerance: 'pointer',
        stop: function(event, ui) {
            updateWidgets();
        },
        distance: 10
    });

    // Initialize widget list on load
    updateWidgets();
});
</script>
