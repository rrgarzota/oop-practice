<?php
require_once 'header.php';

// get the current page
if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}

// formula for PHP pagination
$no_of_records_per_page = 10;
$offset = ($pageno - 1) * $no_of_records_per_page;

// get the total no of pages
$person = new Person($db);
$total_rows = $person->getTotalCount();
$total_pages = ceil($total_rows / $no_of_records_per_page);

// sql query for pagination
$data = $person->getData($offset, $no_of_records_per_page);

?>


<div class="row pt-4">
    <div class="col-8">
        <?php
           if (isset($_GET['msg'])) {
        ?>
        <div class="alert alert-success alert-admissable fade show" role="alert">
            Person successfully <?php echo $_GET['msg'] ?>!
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                &times;
            </button>
        </div>
        <?php
           }
        ?>
    </div>
    <div class="col-4 text-right">
        <a href="form.php?action=create" class="btn btn-success rounded-0 px-5">Create new</a>
    </div>
</div>
<div class="table-responsive mt-4">
    <table class="table table-bordered table-sm" id="tbl_person"> 
        <thead class="thead-dark">
            <tr class="d-flex">
                <th class="col-1">#</th>
                <th class="col-4">First Name</th>
                <th class="col-4">Last Name</th>
                <th class="col-3 text-center">
                    <i class="fa fa-cog"></i>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data as $value): ?>
            <tr class="d-flex">
                <td  class="col-1"><?php echo $value['person_id']; ?></td>
                <td  class="col-4"><?php echo $value['name_first']; ?></td>
                <td  class="col-4"><?php echo $value['name_last']; ?></td>
                <td  class="col-3 text-center">
                    <a href="form.php?action=update&id=<?php echo $value['person_id'] ?>" class="btn btn-warning rounded-0">Edit</a>
                    <button class="btn btn-warning rounded-0 delete">Delete</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <ul class="pagination">
        <li><a href="?pageno=1">First</a></li>
        <li class="<?php echo $pageno <= 1 ? 'disabled' : ''; ?>">
            <a href="<?php echo $pageno <= 1 ? '#' : '?pageno='.($pageno - 1); ?>">Prev</a>
        </li>
        <li class="<?php echo $pageno >= $total_pages ? 'disabled' : ''; ?>">
            <a href="<?php echo $pageno >= $total_pages ? '#' : '?pageno='.($pageno + 1); ?>">Next</a>
        </li>
        <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
    </ul>
</div>



<?php
require_once 'footer.php';
