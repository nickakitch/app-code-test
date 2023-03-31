<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Call <?=htmlentities($call['id'])?></li>
    </ol>

    <dl class="row">
        <dt class="col-sm-3">ID</dt>
        <dd class="col-sm-9"><?=htmlentities($call['id'])?></dd>
        <dt class="col-sm-3">Date</dt>
        <dd class="col-sm-9"><?=htmlentities($call['date'])?></dd>
        <dt class="col-sm-3">IT Person</dt>
        <dd class="col-sm-9"><?=htmlentities($call['it_person'])?></dd>
        <dt class="col-sm-3">Username</dt>
        <dd class="col-sm-9"><?=htmlentities($call['username'])?></dd>
        <dt class="col-sm-3">Subject</dt>
        <dd class="col-sm-9"><?=htmlentities($call['subject'])?></dd>
        <dt class="col-sm-3">Details</dt>
        <dd class="col-sm-9"><?=htmlentities($call['details'])?></dd>
        <dt class="col-sm-3">Time</dt>
        <dd class="col-sm-9">
            <?=htmlentities(str_pad(floor((int)$call['total_time_in_minutes'] / 60), 2, '0', STR_PAD_LEFT))?>:<?=htmlentities(str_pad((int)$call['total_time_in_minutes'] % 60, 2, '0', STR_PAD_LEFT))?>
        </dd>
    </dl>

</nav>