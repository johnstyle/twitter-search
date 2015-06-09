<?php

use Model\User;

include __DIR__ . '/../bootstrap.php';

$language = isset($_GET['language']) && '' !== (string) $_GET['language'] ? (string) $_GET['language'] : DEFAULT_LANGUAGE;
$minFollowers = isset($_GET['min-followers']) && 0 !== (int) $_GET['min-followers'] ? (int) $_GET['min-followers'] : DEFAULT_MIN_FOLLOWERS;
$minFriends = isset($_GET['min-friends']) && 0 !== (int) $_GET['min-friends'] ? (int) $_GET['min-friends'] : DEFAULT_MIN_FRIENDS;
$minTweets = isset($_GET['min-tweets']) && 0 !== (int) $_GET['min-tweets'] ? (int) $_GET['min-tweets'] : DEFAULT_MIN_TWEETS;
$minActivityDays = isset($_GET['min-activity-days']) && 0 !== (int) $_GET['min-activity-days'] ? (int) $_GET['min-activity-days'] : DEFAULT_MIN_ACTIVITY_DAYS;

User::load(array(
    'following' => 1,
    'following_back' => 1,
    'language' => $language,
    'minFollowers' => $minFollowers,
    'minFriends' => $minFriends,
    'minTweets' => $minTweets,
    'minActivityDays' => $minActivityDays,
));

?><!DOCTYPE html>
<html>
<head>
    <title>Social</title>
    <link rel="stylesheet" href="bower_components/DataTables/media/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="bower_components/datatables-bootstrap3/BS3/assets/css/datatables.css">
    <link rel="stylesheet" href="bower_components/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="bower_components/DataTables/media/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="bower_components/datatables-bootstrap3/BS3/assets/js/datatables.js"></script>
    <script type="text/javascript" src="script.js"></script>
</head>
<body>
<header class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="./">Twitter Dashboard</a>
        </div>
    </div>
</header>
<div class="container-fluid">
    <div class="row">

        <section class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

            <div class="row">
                <div class="col-sm-12 col-md-12">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Users</h3>
                        </div>
                        <div class="panel-body">

                            <table class="table">
                                <thead>
                                <tr>
                                    <th>User</th>
                                    <th style="text-align:right">Followers</th>
                                    <th style="text-align:right">Friends</th>
                                    <th style="text-align:right">Tweets</th>
                                    <th style="text-align:right">Favorites</th>
                                    <th style="text-align:center">Lang</th>
                                    <th>Location</th>
                                    <th>Description</th>
                                    <th style="text-align:center">Verified</th>
                                    <th style="text-align:center">Created at</th>
                                    <th style="text-align:center">Last tweet</th>
                                    <th style="text-align:center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach(User::$data as $i=>$data): ?>
                                    <tr>
                                        <td class="td-profile">
                                            <a href="https://twitter.com/<?php echo $data['screen_name']; ?>" target="_blank">
                                                <img src="<?php echo $data['profile_image_url_https']; ?>">
                                                <?php echo $data['screen_name']; ?>
                                            </a>
                                        </td>
                                        <td style="text-align:right"><?php echo $data['followers_count']; ?></td>
                                        <td style="text-align:right"><?php echo $data['friends_count']; ?></td>
                                        <td style="text-align:right"><?php echo $data['statuses_count']; ?></td>
                                        <td style="text-align:right"><?php echo $data['favourites_count']; ?></td>
                                        <td style="text-align:center"><?php echo $data['lang']; ?></td>
                                        <td><?php echo $data['location']; ?></td>
                                        <td class="td-description"><?php echo $data['description']; ?></td>
                                        <td style="text-align:center"><?php echo (int) $data['verified']; ?></td>
                                        <td style="text-align:center"><?php echo date('Y-m-d', strtotime($data['created_at'])); ?></td>
                                        <td class="td-lasttweet"><?php echo date('Y-m-d H:i:s', strtotime($data['last_status'])); ?></td>
                                        <td style="text-align:right">
                                            <a href="?action=hide&id=<?php echo $data['id']; ?>" class="btn btn-xs btn-default" title="Ignore"><i class="fa fa-eye-slash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
            </div>

        </section>

        <aside class="col-sm-3 col-md-2 sidebar">

            <form action="" method="get">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Filter</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Min followers</label>
                            <div class="input-group spinner">
                                <input type="text" name="min-followers" class="form-control" value="<?php echo $minFollowers; ?>">
                                <div class="input-group-btn-vertical">
                                    <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                                    <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Min friends</label>
                            <div class="input-group spinner">
                                <input type="text" name="min-friends" class="form-control" value="<?php echo $minFriends; ?>">
                                <div class="input-group-btn-vertical">
                                    <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                                    <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Min tweets</label>
                            <div class="input-group spinner">
                                <input type="text" name="min-tweets" class="form-control" value="<?php echo $minTweets; ?>">
                                <div class="input-group-btn-vertical">
                                    <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                                    <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Min activity days</label>
                            <div class="input-group spinner">
                                <input type="text" name="min-activity-days" class="form-control" value="<?php echo $minActivityDays; ?>">
                                <div class="input-group-btn-vertical">
                                    <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                                    <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Language</label>
                            <select class="form-control" name="language">
                                <option value="fr">FR</option>
                            </select>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>

        </aside>

    </div>
</div>
</body>
</html>
