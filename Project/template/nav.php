<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo SetUrl() ?>">
                <?php echo APP_TITLE; ?>
            </a>
        </div>

        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo SetUrl() ?>">صفحه اصلی</a></li>
                <?php DispalyPageList(false); ?>
            </ul>

            <ul class="nav navbar-nav navbar-right">

                <?php if(UserLoggenIn()): ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            سلام
                            <?php $CurrentUser = GetCurrentUser(); ?>
                            <strong><?php echo $CurrentUser['firstname']; ?></strong>
                            <span class="caret"></span>
                        </a>
                    
                        <ul class="dropdown-menu">
                        <li><a href="<?php echo SetUrl('dashboard') ?>">صفحه کاربری</a></li>
                            <li><a href="<?php echo SetUrl('info') ?>">ویرایش صفحات</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?php echo SetUrl('logout') ?>">خروج</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li><a href="<?php echo SetUrl('login') ?>">ورود</a></li>
                <?php endif; ?>
                
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>