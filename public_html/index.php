<?php

use Model\Block;
use Model\Follower;
use Model\Friend;

include __DIR__ . '/../bootstrap.php';

?><!DOCTYPE html>
<html>
<head>
    <title>Social</title>
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="bower_components/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css">
    <link rel="stylesheet" href="bower_components/bootstrap-toggle/css/bootstrap-toggle.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./">Twitter Dashboard</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li<?php if('home' === CONTROLLER): ?> class="active"<?php endif; ?>><a href="?controller=home">Dashboard</a></li>
                    <li<?php if('search' === CONTROLLER): ?> class="active"<?php endif; ?>><a href="?controller=search">Search</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="https://twitter.com/<?php echo TWITTER_SCREEN_NAME; ?>" target="_blank">@<?php echo TWITTER_SCREEN_NAME; ?></a></li>
                    <li<?php if('friend' === CONTROLLER): ?> class="active"<?php endif; ?>><a href="?controller=friend"><span class="text-success"><?php echo Friend::count(); ?> friends</span></a></li>
                    <li<?php if('follower' === CONTROLLER): ?> class="active"<?php endif; ?>><a href="?controller=follower"><span class="text-success"><?php echo Follower::count(); ?> followers</span></a></li>
                    <li<?php if('block' === CONTROLLER): ?> class="active"<?php endif; ?>><a href="?controller=block"><span class="text-warning"><?php echo Block::count(); ?> blocked</span></a></li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid">
        <div class="row">

            <section class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

                <?php include DIR_PUBLIC_HTML . '/controller/' . CONTROLLER . '/main.php'; ?>

            </section>

            <aside class="col-sm-3 col-md-2 sidebar">

                <?php include DIR_PUBLIC_HTML . '/controller/' . CONTROLLER . '/sidebar.php'; ?>

            </aside>

        </div>
    </div>

    <script type="text/javascript" src="bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="bower_components/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>
    <script type="text/javascript" src="bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>
