<?php

use Model\Friend;

$results = Friend::$data;

?><div class="row">
    <div class="col-sm-12 col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Friend</h3>
            </div>
            <div class="panel-body">

                <?php include DIR_PUBLIC_HTML . '/part/table.php'; ?>

            </div>
        </div>

    </div>
</div>
