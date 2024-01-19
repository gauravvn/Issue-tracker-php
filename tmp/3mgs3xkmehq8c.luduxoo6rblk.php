<!DOCTYPE html>
<html lang="<?= ($this->lang()) ?>">
<head>
    <?php echo $this->render('blocks/head.html',NULL,get_defined_vars(),0); ?>
</head>
<body class="login">

<h1 class="h2 text-center">
    <a href="<?= ($BASE) ?>/" class="nolink">
        <?php if (empty($site['logo'])): ?>
            <?= ($this->esc($site['name'])) ?>
            <?php else: ?>
                <img src="<?= ($site['logo']) ?>" alt="<?= ($this->esc($site['name'])) ?>">
            
        <?php endif; ?>
    </a>
</h1>

<br><br>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-4 <?= ($site['public_registration'] ? 'col-sm-offset-2' : 'col-sm-offset-4') ?>">
            <form action="<?= ($BASE) ?>/login" method="post" class="form-horizontal">
                <input type="hidden" name="csrf-token" value="<?= $this->esc($csrf_token) ?>" />
                <div class="clearfix">
                    <h3 class="col-md-8 col-md-offset-4"><?= ($dict['log_in']) ?></h3>
                </div>
                <input type="hidden" name="to" value="<?= ($this->esc((empty($to) ? '/' : $to))) ?>">
                <?php if (!empty($login['error'])): ?>
                    <p class="alert alert-danger"><?= ($login['error']) ?></p>
                <?php endif; ?>
                <div class="form-group">
                    <label for="username" class="col-md-4 control-label"><?= ($dict['username']) ?></label>
                    <div class="col-md-8">
                        <?php if (!empty($POST['username'])): ?>
                            
                                <input class="form-control" placeholder="<?= ($dict['username']) ?>" id="username" name="username" type="text" value="<?= ($this->esc($POST['username'])) ?>" required>
                            
                            <?php else: ?>
                                <input class="form-control" placeholder="<?= ($dict['username']) ?>" id="username" name="username" type="text" required autofocus>
                            
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-md-4 control-label"><?= ($dict['password']) ?></label>
                    <div class="col-md-8">
                        <?php if (!empty($POST['username'])): ?>
                            
                                <input class="form-control" placeholder="<?= ($dict['password']) ?>" id="password" name="password" type="password" required autofocus>
                            
                            <?php else: ?>
                                <input class="form-control" placeholder="<?= ($dict['password']) ?>" id="password" name="password" type="password" required>
                            
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-8 col-lg-offset-4">
                        <button type="submit" class="btn btn-primary"><?= ($dict['log_in']) ?></button>
                        <a href="<?= ($BASE) ?>/reset" class="btn btn-link"><?= ($dict['reset_password']) ?></a>
                    </div>
                </div>
            </form>
            <?php \Helper\Plugin::instance()->callHook('render.login.after_login') ?>
        </div>
        <?php if ($site['public_registration']): ?>
            <div class="col-sm-4">
                <form action="<?= ($BASE) ?>/register" method="post" class="form-horizontal">
                    <input type="hidden" name="csrf-token" value="<?= $this->esc($csrf_token) ?>" />
                    <div class="clearfix">
                        <h3 class="col-md-8 col-md-offset-4"><?= ($dict['register']) ?></h3>
                    </div>
                    <input type="hidden" name="to" value="<?= (empty($to) ? '/' : $to) ?>">
                    <?php if (!empty($register['error'])): ?>
                        <p class="alert alert-danger"><?= ($this->raw($register['error'])) ?></p>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="register-name" class="col-md-4 control-label"><?= ($dict['name']) ?></label>
                        <div class="col-md-8">
                            <input class="form-control" placeholder="<?= ($dict['name']) ?>" id="register-name" name="register-name" type="text" value="<?= ($this->esc(@$POST['register-name'])) ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="register-username" class="col-md-4 control-label"><?= ($dict['username']) ?></label>
                        <div class="col-md-8">
                            <input class="form-control" placeholder="<?= ($dict['username']) ?>" id="register-username" name="register-username" type="text" value="<?= ($this->esc(@$POST['register-username'])) ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="register-email" class="col-md-4 control-label"><?= ($dict['email_address']) ?></label>
                        <div class="col-md-8">
                            <input class="form-control" placeholder="<?= ($dict['email']) ?>" id="register-email" name="register-email" type="text" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="register-password" class="col-md-4 control-label"><?= ($dict['password']) ?></label>
                        <div class="col-md-8">
                            <input class="form-control" placeholder="<?= ($dict['password']) ?>" id="register-username" name="register-password" type="password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-8 col-lg-offset-4">
                            <button type="submit" class="btn btn-primary"><?= ($dict['register']) ?></button>
                        </div>
                    </div>
                </form>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php echo $this->render('blocks/footer-scripts.html',NULL,get_defined_vars(),0); ?>
<?php \Helper\Plugin::instance()->callHook('render.login.after_footer') ?>
</body>
</html>
