<!DOCTYPE html>
<html lang="<?= ($this->lang()) ?>">
<head>
    <?php echo $this->render('blocks/head.html',NULL,get_defined_vars(),0); ?>
</head>
<body>
<?php echo $this->render('blocks/navbar.html',NULL,get_defined_vars(),0); ?>
<div class="container">
    <?php echo $this->render('blocks/admin/tabs.html',NULL,get_defined_vars(),0); ?>
    <form action="<?= ($BASE) ?>/admin/sprints/<?= ($sprint['id']) ?>" method="post" class="form-horizontal" autocomplete="off">
        <input type="hidden" name="csrf-token" value="<?= $this->esc($csrf_token) ?>" />
        <legend><?= ($dict['edit_sprint']) ?></legend>
        <div class="form-group">
            <label for="name" class="col-md-2 control-label label-sm"><?= ($dict['name']) ?></label>
            <div class="col-md-10">
                <input class="form-control input-sm" id="name" type="text" name="name" value="<?= ($this->esc($sprint['name'])) ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="start_date" class="col-md-2 control-label label-sm"><?= ($dict['start_date']) ?></label>
            <div class="col-md-4">
                <input class="form-control input-sm" id="start_date" type="text" name="start_date" value="<?= ($this->esc($sprint['start_date'])) ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label for="end_date" class="col-md-2 control-label label-sm"><?= ($dict['end_date']) ?></label>
            <div class="col-md-4">
                <input class="form-control input-sm" id="end_date" type="text" name="end_date" value="<?= ($this->esc($sprint['end_date'])) ?>" required>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-10 col-md-offset-2">
                <button type="submit" class="btn btn-primary btn-sm"><?= ($dict['save']) ?></button>
                <a href="<?= ($BASE) ?>/admin/sprints" class="btn btn-default btn-sm"><?= ($dict['cancel']) ?></a>
            </div>
        </div>
    </form>
    <?php echo $this->render('blocks/footer.html',NULL,get_defined_vars(),0); ?>
</div>
<script src="<?= ($BASE) ?>/js/bootstrap-datepicker.js"></script>
<?php if ($user_obj->date_picker()->js && $user_obj->date_picker()->language != 'en-US'): ?>
<script src="<?= ($BASE) ?>/js/bootstrap-datepicker.<?= ($user_obj->date_picker()->language) ?>.min.js"></script>
<?php endif; ?>
<script>
    $(function() {
        $('#start_date, #end_date').datepicker({
            format: 'yyyy-mm-dd',
            language: '<?= ($user_obj->date_picker()->language) ?>',
            todayHighlight: true,
            autoclose: true
        });
    });
</script>
</body>
</html>
