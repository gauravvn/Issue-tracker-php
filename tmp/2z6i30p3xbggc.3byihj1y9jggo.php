<!DOCTYPE html>
<html lang="<?= ($LANGUAGE) ?>">
<head>
    <?php echo $this->render('blocks/head.html',NULL,get_defined_vars(),0); ?>
</head>
<body>
    <?php echo $this->render('blocks/navbar.html',NULL,get_defined_vars(),0); ?>
    <div class="container">
        <h1><?= ($dict['issue_tags']) ?></h1>
        <?php if (!$cloud): ?>
            <p><?= ($dict['no_tags_created']) ?></p>
        <?php endif; ?>
        <p><?= ($dict['tag_help_1']) ?><br>
            <small><?= ($dict['tag_help_2']) ?></small>
        </p>

        <ul class="nav nav-tabs">
            <li class="active"><a href="#tag-list" data-toggle="tab"><?= ($dict['list']) ?></a></li>
            <li><a href="#tag-cloud" data-toggle="tab"><?= ($dict['cloud']) ?></a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="tag-list">
                <table class="table table-compact table-striped tag-list">
                    <thead>
                        <tr>
                            <th data-sort="string"><?= ($dict['name']) ?></th>
                            <th data-sort="int"><?= ($dict['count']) ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (($list?:[]) as $item): ?>
                            <tr>
                                <td><a href="<?= ($BASE) ?>/tag/<?= ($item['tag']) ?>"><?= ($item['tag']) ?></a></td>
                                <td><?= ($item['freq']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="tag-cloud">
                <?php $tagSizeMin = 14;
                    $tagSizeMax = 60;
                    $tagFreqMin = null;
                    $tagFreqMax = 0;
                    foreach ($cloud as $item) {
                        if ($tagFreqMin === null || $item['freq'] < $tagFreqMin) $tagFreqMin = $item['freq'];
                        if ($tagFreqMax < $item['freq']) $tagFreqMax = $item['freq'];
                    }
                    $sizes = [];
                    foreach ($cloud as $item) {
                        $sizes[$item['tag']] = ($item['freq'] - $tagFreqMin) / ($tagFreqMax - $tagFreqMin) * ($tagSizeMax - $tagSizeMin) + $tagSizeMin;
                    } ?>
                <div class="tag-cloud">
                    <?php foreach (($cloud?:[]) as $item): ?>
                        <a href="<?= ($BASE) ?>/tag/<?= ($item['tag']) ?>" style="font-size: <?= ($sizes[$item['tag']]) ?>px;"><?= ($item['tag']) ?></a>&ensp;
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php echo $this->render('blocks/footer.html',NULL,get_defined_vars(),0); ?>
        <script src="<?= ($BASE) ?>/js/stupidtable.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function() {
            $('.table').stupidtable();
        });
        </script>
    </div>
</body>
</html>
