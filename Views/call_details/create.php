<?php if (isset($error)) { ?>
    <div class="alert alert-danger my-4" role="alert">
        <?=htmlentities($error)?>
    </div>
<?php } ?>

<h5>Add Call Details</h5>

<form action="./call.php?id=<?=htmlentities($call['id'])?>" method="post">
    <div class="mb-3">
        <label for="date_input" class="form-label">Date:</label>
        <input type="date" class="form-control" id="date_input" name="date" value="<?=htmlentities((new DateTime())->format('Y-m-d'))?>" />
    </div>
    <div class="mb-3">
        <label for="details_input" class="form-label">Details:</label>
        <textarea class="form-control" id="details_input" name="details" rows="3" placeholder="e.g. Customer called and requested..."></textarea>
    </div>
    <div class="mb-3 row">
        <div class="col-md-6">
            <label for="hours_input" class="form-label">Hours:</label>
            <input type="number" class="form-control" id="hours_input" name="hours" min="0" max="100" value="0" />
        </div>
        <div class="col-md-6">
            <label for="minutes_input" class="form-label">Minutes:</label>
            <input type="number" class="form-control" id="minutes_input" name="minutes" min="0" max="60" value="0" />
        </div>
    </div>
    <input type="hidden" name="call_id" value="<?=htmlentities($call['id'])?>">
    <input type="submit" class="btn btn-primary" name="create_call_details_submit" value="Create call details" />
</form>
