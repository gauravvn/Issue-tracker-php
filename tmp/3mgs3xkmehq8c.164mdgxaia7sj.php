<!-- Hotkeys -->
<div class="modal" id="modal-hotkeys" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= ($dict['close']) ?></span></button>
                <h4 class="modal-title"><?= ($dict['hotkeys']) ?></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <p><b><?= ($dict['hotkeys_global']) ?></b></p>
                        <dl class="dl-inline">
                            <dt>?</dt>
                            <dd><?= ($dict['show_hotkeys']) ?></dd>
                            <dt>/</dt>
                            <dd><?= ($dict['issue_search']) ?></dd>
                            <dt>shift+b</dt>
                            <dd><?= ($dict['browse']) ?></dd>
                            <dt>r</dt>
                            <dd><?= ($dict['reload_page']) ?></dd>
                            <?php foreach (($issue_types?:[]) as $type): ?>
                                <?php if ($type['id'] > 0 && $type['id'] < 10): ?>
                                    <dt><?= (Base::instance()->format($dict['press_x_then_y'],'n',$type['id'])) ?></dt>
                                    <dd><?= (Base::instance()->format($dict['new_n'],$type['name'])) ?></dd>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </dl>
                    </div>
                    <div class="col-sm-6">
                        <p><b><?= ($dict['issues']) ?></b></p>
                        <dl class="dl-inline">
                            <dt>w</dt>
                            <dd><?= ($dict['watch']) ?>/<?= ($dict['unwatch']) ?></dd>
                            <dt>e</dt>
                            <dd><?= ($dict['edit']) ?></dd>
                            <dt>c</dt>
                            <dd><?= ($dict['write_a_comment']) ?></dd>
                            <dt>ctrl+enter</dt>
                            <dd><?= ($dict['save']) ?></dd>
                            <dt>shift+c</dt>
                            <dd><?= ($dict['mark_complete']) ?></dd>
                            <dt>shift+r</dt>
                            <dd><?= ($dict['reopen']) ?></dd>
                        </dl>
                        <br>
                        <p><b><?= ($dict['navigation']) ?></b></p>
                        <?php $altKey = '<kbd class="accesskey-modifier">alt</kbd>';
                            echo \Base::instance()->get('dict.use_with_x', $altKey); ?>:
                        <dl class="dl-inline">
                            <dt>h</dt>
                            <dd><?= ($dict['dashboard']) ?></dd>
                            <dt>n</dt>
                            <dd><?= ($dict['new']) ?>&hellip;</dd>
                            <dt>b</dt>
                            <dd><?= ($dict['browse']) ?>&hellip;</dd>
                            <?php if ($user['role']=='admin'): ?>
                                <dt>s</dt>
                                <dd><?= ($dict['sprints']) ?></dd>
                                <dt>a</dt>
                                <dd><?= ($dict['administration']) ?></dd>
                            <?php endif; ?>
                            <dt>u</dt>
                            <dd><?= ($dict['user']) ?></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
