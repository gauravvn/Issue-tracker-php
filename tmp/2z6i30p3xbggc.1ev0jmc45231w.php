<!DOCTYPE html>
<html lang="<?= ($this->lang()) ?>">
<head>
    <?php echo $this->render('blocks/head.html',NULL,get_defined_vars(),0); ?>
    <?php if ($parse['markdown']): ?>
        <link rel="stylesheet" type="text/css" href="<?= ($BASE) ?>/css/easymde.min.css">
    <?php endif; ?>
</head>
<body>
<?php echo $this->render('blocks/navbar.html',NULL,get_defined_vars(),0); ?>
<div class="container">
    <?php echo $this->render('issues/edit-form.html',NULL,get_defined_vars(),0); ?>
    <?php echo $this->render('blocks/footer.html',NULL,get_defined_vars(),0); ?>
</div>
<script src="<?= ($BASE) ?>/js/bootstrap-datepicker.js"></script>
<script src="<?= ($BASE) ?>/js/typeahead.jquery.js"></script>
<?php if ($user_obj->date_picker()->js && $user_obj->date_picker()->language != 'en-US'): ?>
    <script src="<?= ($BASE) ?>/js/bootstrap-datepicker.<?= ($user_obj->date_picker()->language) ?>.min.js"></script>
<?php endif; ?>
<?php if ($parse['markdown'] && !$user_obj->option('disable_mde')): ?>
    <script src="<?= ($BASE) ?>/js/easymde.min.js"></script>
<?php endif; ?>
<script type="text/javascript">
$(function() {
    // Enable datepickers
    $('#due_date, #start_date').datepicker({
        format: 'yyyy-mm-dd',
        language: '<?= ($user_obj->date_picker()->language) ?>',
        todayHighlight: true,
        autoclose: true
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
                data: {'q': query},
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

    // Autofocus the first field
    $('#edit-form input[name="name"]').focus();

    // Prevent navigation with unsaved changes
    var $editForm = $('#edit-form'),
        formSerialized = $editForm.serialize();
    $(window).on('beforeunload', function() {
        if($editForm.length && $editForm.serialize() !== formSerialized) {
            return '<?= ($dict['unsaved_changes']) ?>';
        }
    });
    $editForm.submit(function() {
        $(window).off('beforeunload');
    });
});
if ('EasyMDE' in window) {
    var mde = new EasyMDE({
        autoDownloadFontAwesome: false,
        element: $('input[name="description"]')[0],
        toolbar: ['bold', 'italic', 'heading', '|', 'quote', 'unordered-list', 'ordered-list', '|', 'link', 'image', '|', 'preview', 'guide'],
        forceSync: true
    });
    mde.render();
}
</script>
</body>
</html>
