<?php if (!empty($errors)) : ?>
    <!-- Display errors -->
    <div class="alert alert-danger">
        <?php foreach ($errors as $error) : ?>
            <div>
                <?php echo $error ?>
            </div>
        <?php endforeach ?>
    </div>
<?php endif ?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="mb-3">
        <label class="form-label">Ticket Title</label>
        <input type="text" class="form-control" name="title" value="<?php echo $ticket['title'] ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Device</label>
        <input type="text" class="form-control" name="device" value="<?php echo $ticket['device'] ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">First Name</label>
        <input type="text" class="form-control" name="firstName" value="<?php echo $ticket['firstName'] ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Last Name</label>
        <input type="text" class="form-control" name="lastName" value="<?php echo $ticket['lastName'] ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Phone Number</label>
        <input type="text" class="form-control" name="phoneNumber" value="<?php echo $ticket['phoneNumber'] ?>">
    </div>
    <div class="mb-3">
        <select name="location">
            <option value="Blacktown">Blacktown</option>
            <option value="Castle Hill">Castle Hill</option>
            <option value="Bankstown">Bankstown</option>
            <option value="HQ">HQ</option>
        </select>
    </div>
    <div class="mb-3">
        <select name="status">
            <option value="Pending">Pending</option>
            <option value="In Progress">In Progress</option>
            <option value="Waiting For Response">Waiting For Response</option>
            <option value="Completed - Not Contacted">Completed - Not Contacted</option>
            <option value="Completed - Contacted">Completed - Contacted</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Quoted Price</label>
        <input type="number" step="0.1" class="form-control" name="quotedPrice" value="<?php echo $ticket['quotedPrice'] ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Ticket description</label>
        <textarea type="text" class="form-control" name="body"><?php echo $ticket['body'] ?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Booked By</label>
        <input type="text" class="form-control" name="bookedBy" value="<?php echo $ticket['bookedBy'] ?>">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>