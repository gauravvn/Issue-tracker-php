<?php $types = array();
    foreach($issue_types as $type) {
        if($type['id'] > 0 && $type['id'] < 10) {
            array_push($types, $type['id']);
        }
    } ?>
<script>var BASE = '<?= ($BASE) ?>', issue_types = <?= (json_encode($types)) ?>;</script>
<script src="<?= ($BASE) ?>/js/jquery-3.6.3.min.js"></script>
<script src="<?= ($BASE) ?>/js/bootstrap.min.js"></script>
<script src="<?= ($BASE) ?>/js/mousetrap-1.6.5.min.js"></script>
<script src="<?= ($BASE) ?>/js/global.js"></script>

<?php foreach ((\Helper\Plugin::instance()->getJsFiles($PATH)?:[]) as $file): ?>
    <script src="<?= ($file) ?>"></script>
<?php endforeach; ?>
<?php foreach ((\Helper\Plugin::instance()->getJsCode($PATH)?:[]) as $code): ?>
    <?= ($code)."
" ?>
<?php endforeach; ?>
