<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Tickets</h1>
  <div class="btn-toolbar mb-2 mb-md-0">
  </div>
</div>

<p>
  <a class="btn btn-success" href="/tickets/create">Create Ticket</a>
</p>

<form action="">
  <div class="input-group mb-3">
    <input type="text" class="form-control" placeholder="Search for Ticket Titles" name="search" value="<?php echo $search ?>">
    <div class="input-group-append">
      <button class="btn btn-outline-secondary" type="submit">Search</button>
    </div>
  </div>
</form>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Title</th>
      <th scope="col">Device</th>
      <th scope="col">Client Name</th>
      <th scope="col">Status</th>
      <th scope="col">Date Due</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($tickets as $ticket) : ?>
      <tr>
        <td><?php echo $ticket['title'] ?></td>
        <td><?php echo $ticket['device'] ?></td>
        <td><?php echo $ticket['firstName'] . ' ' . $ticket['lastName'] ?></td>
        <td><?php echo $ticket['status'] ?></td>
        <td><?php echo $ticket['dateDue'] ?></td>
        <td>
          <a href="/tickets/view?id=<?php echo $ticket['id'] ?>" type="button" class="btn btn-sm btn-outline-info">View</a>
          <a href="/tickets/update?id=<?php echo $ticket['id'] ?>" type="button" class="btn btn-sm btn-outline-primary">Edit</a>
          <form style="display: inline-block;" method="post" action="/tickets/delete">
            <input type="hidden" name="id" value="<?php echo $ticket['id'] ?>">
            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
          </form>

        </td>
      </tr>

    <?php endforeach ?>

  </tbody>
</table>