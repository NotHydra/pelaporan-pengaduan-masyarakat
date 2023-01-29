<div class="card-header">
    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0"><?php echo $pageItemObject["title"]; ?></h1>
        </div>

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/<?php echo $originalPath; ?>/<?php echo $pageItemObject["link"]; ?>"><?php echo $pageItemObject["title"]; ?></a></li>

                <?php
                if ($extraTitle != null) {
                ?>
                    <li class="breadcrumb-item active"><?php echo $extraTitle; ?></li>
                <?php
                };
                ?>
            </ol>
        </div>
    </div>
</div>