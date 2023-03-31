<h5>Call Detail Records</h5>
<?php
if (empty($details)) {
    echo '<p>No details recorded for this call.</p>';
    return;
}
?>
<?php foreach ($details as $detail) { ?>
    <div class="mt-5 border-bottom">
        <dl class="row">
            <dt class="col-md-3">Detail ID</dt>
            <dd class="col-md-9"><?=htmlentities($detail['id'])?></dd>
            <dt class="col-md-3">Call ID</dt>
            <dd class="col-md-9"><?=htmlentities($detail['call_id'])?></dd>
            <dt class="col-md-3">Date</dt>
            <dd class="col-md-9"><?=htmlentities($detail['date'])?></dd>
            <dt class="col-md-3">Time</dt>
            <dd class="col-md-9">
                <?=htmlentities(str_pad(floor((int)$detail['total_time_in_minutes'] / 60), 2, '0', STR_PAD_LEFT))?>:<?=htmlentities(str_pad((int)$detail['total_time_in_minutes'] % 60, 2, '0', STR_PAD_LEFT))?>
            </dd>
            <dt class="col-md-3">Details</dt>
            <dd class="col-md-9"><?=htmlentities($detail['details'])?></dd>
        </dl>
    </div>
<?php
}