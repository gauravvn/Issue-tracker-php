<!DOCTYPE html>
<html lang="<?= ($this->lang()) ?>">
<head>
    <?php echo $this->render('blocks/head.html',NULL,get_defined_vars(),0); ?>
    <?php if ($user['api_key']): ?>
        <link rel="alternate" type="application/atom+xml" title="<?= ($dict['assigned_issues']) ?>" href="<?= ($site['url']) ?>atom.xml?type=assigned&amp;user=<?= ($this_user['username']) ?>&amp;key=<?= ($user['api_key']) ?>" />
        <link rel="alternate" type="application/atom+xml" title="<?= ($dict['created_issues']) ?>" href="<?= ($site['url']) ?>atom.xml?type=created&amp;user=<?= ($this_user['username']) ?>&amp;key=<?= ($user['api_key']) ?>" />
    <?php endif; ?>
</head>
<body>
    <?php $fullwidth=true; ?>
    <?php echo $this->render('blocks/navbar.html',NULL,get_defined_vars(),0); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 clearfix">
                <div class="pull-left" style="margin-right: 15px;">
                    <img src="<?= ($this->esc($this_user->avatar(128))) ?>" srcset="<?= ($this->esc($this_user->avatar(256))) ?> 2x" class="img-rounded profile-picture" alt>
                </div>
                <div class="pull-left">
                    <h3>
                        <?= ($this->esc($this_user['name']))."
" ?>
                        <?php if ($this_user['deleted_date']): ?>
                            &ensp;<small class="label label-danger"><?= ($dict['deleted']) ?></small>
                        <?php endif; ?>
                    </h3>
                    <p><?= ($dict['username']) ?>: <?= ($this_user['username']) ?></p>
                    <?php if ($this_user['role'] != 'group'): ?>
                        <p><?= ($dict['email']) ?>: <?= ($this_user['email']) ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php if ($this_user['role'] != 'group'): ?>
                <div class="col-md-8 hidden-xs">
                    <canvas id="stats" width="600" height="130"></canvas>
                </div>
            <?php endif; ?>
        </div>
        <br>

        <div role="tabpanel">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#user-created" data-toggle="tab"><?= ($dict['created_issues']) ?>&ensp;<span class="badge"><?= ($created_issues['total']) ?></span></a></li>
                <li><a href="#user-assigned" data-toggle="tab"><?= ($dict['assigned_issues']) ?>&ensp;<span class="badge"><?= ($assigned_issues['total']) ?></span></a></li>
                <li><a href="#user-overdue" data-toggle="tab"><?= ($dict['overdue_issues']) ?>&ensp;<span class="badge"><?= ($overdue_issues['total']) ?></span></a></li>
                <?php if ($this_user['role'] != 'group'): ?>
                    <li><a href="#user-tree" data-toggle="tab"><?= ($dict['issue_tree']) ?></a></li>
                <?php endif; ?>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="user-created">
                    <?php $issues=$created_issues; ?>
                    <?php echo $this->render('blocks/issue-list.html',NULL,get_defined_vars(),0); ?>
                </div>
                <div class="tab-pane fade" id="user-assigned">
                    <?php $issues=$assigned_issues; ?>
                    <?php echo $this->render('blocks/issue-list.html',NULL,get_defined_vars(),0); ?>
                </div>
                <div class="tab-pane fade" id="user-overdue">
                    <?php $issues=$overdue_issues; ?>
                    <?php echo $this->render('blocks/issue-list.html',NULL,get_defined_vars(),0); ?>
                </div>
                <?php if ($this_user['role'] != 'group'): ?>
                    <div class="tab-pane fade" id="user-tree">
                        <p><?= ($dict['loading']) ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php echo $this->render('blocks/footer.html',NULL,get_defined_vars(),0); ?>
    </div>
    <script src="<?= ($BASE) ?>/js/chart.min.js"></script>
    <?php if ($this_user['role'] != 'group'): ?>
        <?php $stats=$this_user->stats(); ?>
        <script>
        var jsonData = {
            labels: '<?= (json_encode(array_values($stats['labels']))) ?>',
            spent: '<?= (json_encode(array_values($stats['spent']))) ?>',
            closed: '<?= (json_encode(array_values($stats['closed']))) ?>',
            created: '<?= (json_encode(array_values($stats['created']))) ?>'
        };
        var charts = {
            data: {
                labels: JSON.parse(jsonData.labels),
                datasets: [{
                    data: JSON.parse(jsonData.spent),
                    label: "<?= ($dict['cols']['total_spent_hours']) ?>",
                    borderColor: "#2ecc71",
                    pointBackgroundColor: "#2ecc71",
                    pointBorderColor: "#2ecc71",
                },{
                    data: JSON.parse(jsonData.closed),
                    label: "<?= ($dict['closed']) ?>",
                    borderColor: "#3498db",
                    pointBackgroundColor: "#3498db",
                    pointBorderColor: "#3498db",
                },{
                    data: JSON.parse(jsonData.created),
                    label: "<?= ($dict['cols']['created']) ?>",
                    borderColor: "#9b59b6",
                    pointBackgroundColor: "#9b59b6",
                    pointBorderColor: "#9b59b6",
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    position: 'left',
                    labels: {
                        boxWidth: 1
                    }
                },
                animation: {
                    duration: 250
                },
                tooltips: {
                    mode: 'x-axis',
                    titleSpacing: 0,
                    titleMarginBottom: 3,
                    yPadding: 4,
                },
                hover: {
                    mode: 'x-axis'
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                elements: {
                    line: {
                        tension: 0.3,
                        borderWidth: 2,
                    },
                    point: {
                        radius: 2,
                        hoverRadius: 3,
                        hitRadius: 15,
                    }
                }
            }
        };

        Chart.defaults.global.defaultFontColor = "rgba(127,127,127,1)";
        Chart.defaults.scale.gridLines.color = "rgba(127,127,127,.3)";
        Chart.defaults.scale.gridLines.zeroLineColor = "rgba(127,127,127,.3)";

        $(document).ready(function() {

            // Preload issue tree
            $.get(BASE + '/user/<?= ($this_user['username']) ?>/tree', {}, function(data) {
                $('#user-tree').html(data);
            }).fail(function() {
                $('#user-tree').empty().append($('<p />').addClass('text-center text-danger').text('<?= ($dict['error']['404_text']) ?>'));
            });

            // Render chart
            var ctx = document.getElementById("stats").getContext("2d");
            charts.chart = new Chart(ctx, {
                type: 'line',
                data: charts.data,
                options: charts.options
            });

        });
        </script>
    <?php endif; ?>
</body>
</html>
