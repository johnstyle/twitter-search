<form action="" method="get">
    <input type="hidden" name="controller" value="<?php echo CONTROLLER; ?>" />
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Filters</h3>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label>Min followers</label>
                <div class="input-group spinner">
                    <input type="text" name="min-followers" class="form-control" value="<?php echo $controller->minFollowers; ?>">
                    <div class="input-group-btn-vertical">
                        <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                        <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Min friends</label>
                <div class="input-group spinner">
                    <input type="text" name="min-friends" class="form-control" value="<?php echo $controller->minFriends; ?>">
                    <div class="input-group-btn-vertical">
                        <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                        <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Min tweets</label>
                <div class="input-group spinner">
                    <input type="text" name="min-tweets" class="form-control" value="<?php echo $controller->minTweets; ?>">
                    <div class="input-group-btn-vertical">
                        <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                        <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Min activity days</label>
                <div class="input-group spinner">
                    <input type="text" name="min-activity-days" class="form-control" value="<?php echo $controller->minActivityDays; ?>">
                    <div class="input-group-btn-vertical">
                        <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                        <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Language</label>
                <select class="form-control" name="language">
                    <option value="">All</option>
                    <option value="fr"<?php if('fr' === $controller->language): ?> selected="selected"<?php endif; ?>>FR</option>
                </select>
            </div>
            <div class="form-group">
                <label>Following</label>
                <select class="form-control" name="following">
                    <option value="">All</option>
                    <option value="0"<?php if(0 === $controller->following): ?> selected="selected"<?php endif; ?>>Only not following</option>
                    <option value="1"<?php if(1 === $controller->following): ?> selected="selected"<?php endif; ?>>Only following</option>
                </select>
            </div>
            <div class="form-group">
                <label>Following back</label><br />
                <select class="form-control" name="following-back">
                    <option value="">All</option>
                    <option value="0"<?php if(0 === $controller->followingBack): ?> selected="selected"<?php endif; ?>>Only not following back</option>
                    <option value="1"<?php if(1 === $controller->followingBack): ?> selected="selected"<?php endif; ?>>Only following back</option>
                </select>
            </div>
        </div>
        <div class="panel-footer">
            <a href="?controller=<?php echo CONTROLLER; ?>" class="btn btn-default">Reset</a>
            <button type="submit" class="btn btn-success pull-right">Submit</button>
        </div>
    </div>
</form>
