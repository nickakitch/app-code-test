<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create a call</li>
    </ol>
</nav>

<?php if (isset($error)) { ?>
    <div class="alert alert-danger my-4" role="alert">
        <?=htmlentities($error)?>
    </div>
<?php } ?>

<form action="./create-call.php" method="post">
    <div class="mb-3">
        <label for="call_date_input" class="form-label">Date:</label>
        <input type="date" class="form-control" id="call_date_input" name="call_date" value="<?=htmlentities((new DateTime())->format('Y-m-d'))?>" />
    </div>
    <div class="mb-3">
        <label for="call_it_person_input" class="form-label">IT Person:</label>
        <input type="text" maxlength="32" class="form-control" name="call_it_person" id="call_it_person_input" placeholder="e.g. John Doe" />
    </div>
    <div class="mb-3">
        <label for="call_username_input" class="form-label">Username:</label>
        <input type="text" maxlength="32" class="form-control" name="call_username" id="call_username_input" placeholder="e.g. your.username" />
    </div>
    <div class="mb-3">
        <label for="call_subject_input" class="form-label">Call subject:</label>
        <input type="text" maxlength="64" class="form-control" name="call_subject" id="call_subject_input" placeholder="e.g. Assistance with updating phone number" />
        <div id="call_subject_help" class="form-text">Short description of the reason for the call.</div>
    </div>
    <div class="mb-3">
        <label for="call_details_input" class="form-label">Details:</label>
        <textarea class="form-control" id="call_details_input" name="call_details" rows="3" placeholder="e.g. Customer called and requested..."></textarea>
    </div>
    <div class="mb-3">
        <label for="call_status" class="form-label">Status:</label>
        <select class="form-select" aria-label="Default select example" id="call_status" name="call_status">
            <option value="new" selected>New</option>
            <option value="in-progress">In Progress</option>
            <option value="completed">Completed</option>
        </select>
    </div>
    <input type="submit" class="btn btn-primary" name="create_call_submit" value="Create call" />
</form>