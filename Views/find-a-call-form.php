<h2 class="mb-3">Find a call:</h2>
<form action="./calls.php" method="post">
    <div class="mb-3">
        <label for="call_id_input" class="form-label">Call ID:</label>
        <input type="number" class="form-control" id="call_id_input" placeholder="e.g 123"/>
    </div>
    <div class="mb-3">
        <label for="user_name_input" class="form-label">User name:</label>
        <input type="text" class="form-control" id="user_name_input" placeholder="e.g John Doe"/>
    </div>
    <div class="mb-3">
        <label for="call_date_input" class="form-label">Date:</label>
        <input type="date" class="form-control" id="call_date_input"/>
    </div>
    <input type="submit" class="btn btn-primary" name="find_call_submit" value="Find a call" />
</form>