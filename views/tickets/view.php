<?php ob_start(); //Check header data 
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?php echo $ticket['title'] ?></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
    </div>
    <div>
        <a href="/tickets/update?id=<?php echo $ticket['id'] ?>" type="button" class="btn btn-sm btn-outline-primary">Edit</a>
        <form style="display: inline-block;" method="post" action="/tickets/delete">
            <input type="hidden" name="id" value="<?php echo $ticket['id'] ?>">
            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
        </form>
    </div>
</div>

<div>
    <h6>Client Name: <?php echo $ticket['firstName'] . ' ' . $ticket['lastName'] ?></h6>
    <h6>Phone Number: <?php echo $ticket['phoneNumber'] ?></h6>
    <h6>Device: <?php echo $ticket['device'] ?></h6>
    <h6>Status: <?php echo $ticket['status'] ?></h6>
    <h6>Date Due: <?php echo $ticket['dateDue'] ?></h6>
    <h6>Date Booked: <?php echo $ticket['createdDate'] ?></h6>
    <h6>Location: <?php echo $ticket['location'] ?></h6>
    <h6>Quoted Price: <?php echo $ticket['quotedPrice'] ?></h6>
    <hr>
    <p>
    <h6>Ticket Description</h6>
    <?php echo $ticket['body'] ?>
    </p>
</div>
<hr>
<div>
    <h6>Notes</h6>
    <?php foreach ($notes as $note) : ?>
        <p>
            <?php echo $note['body'] ?>
        </p>
    <?php endforeach ?>
</div>

<hr>
<!-- Error Handling -->
<?php if (!empty($errors)) : ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error) : ?>
            <div>
                <?php echo $error ?>
            </div>
        <?php endforeach ?>
    </div>
<?php endif ?>

<!-- Note Form -->
<form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label class="form-label">Add A Note</label>
        <textarea type="text" class="form-control" name="body"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>