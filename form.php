<?php
    require_once 'header.php';

    $title = '';
    $action = '';
    $person_data = '';
    $fname = '';
    $lname = '';
    $id = '';

    if (isset($_GET['action'])) 
    {
        $action = $_GET['action'];

        if ($_GET['action'] === 'create') {
            $title = 'Create New';
        } else {
            $title = 'Update';
        }
    }

    if (isset($_GET['id']))
    {
        $person = new Person($db);
        $person_data = $person->getById($_GET['id']);
        $fname = !empty($person_data) ? $person_data['name_first'] : '';
        $lname = !empty($person_data) ? $person_data['name_last'] : '';
        $id = $_GET['id'];
    }

?>

<div class="row">
    <div class="col-12 mt-5">
        <h2><?php echo $title; ?> Person</h2>
        <hr>
    </div>
</div>
<form action="process.php" method="POST">
    <div class="row">
        <div class="col-lg-4 col-md-8 col-sm-10 col-12 mt-5">
            <div class="form-group">
                <label for="fname">First Name:</label>
                <input type="text" class="rounded-0 form-control" placeholder="Enter first name" id="fname" name="fname" value="<?php echo $fname ;?>">
            </div
            <div class="form-group">
                <label for="lname">Last Name:</label>
                <input type="text" class="rounded-0 form-control" placeholder="Enter last name" id="lname" name="lname" value="<?php echo $lname; ?>">
            </div>
            <input type="hidden" name="action" value="<?php echo $action; ?>">    
            <input type="hidden" name="id" value="<?php echo $id; ?>">        
        </div>
        <button type="submit" class="btn btn-success rounded-0 mt-3">Submit</button>
    </div>
</form>

<?php
require_once 'footer.php';