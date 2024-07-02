<?php include('header.php'); ?>
<?php include('dbcon.php'); ?>
<div class="box1">
    <h2>All Students</h2>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Students</button>
</div>
<table class="table table-hover table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Age</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM students";
        $result = mysqli_query($connection, $query);

        if (!$result) {
            die("Query Failed: " . mysqli_error($connection));
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['last_name']; ?></td>
                    <td><?php echo $row['age']; ?></td>
                </tr>
                <?php
                if (isset($_GET['success']) && $_GET['success'] == 1) {
                    echo "<div class='alert alert-success'>Student added successfully!</div>";
                }
            }
        }
        ?>
    </tbody>
</table>

<!-- Modal -->
<form action="add_student.php" method="post">
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Students</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="f_name">First Name</label>
                        <input type="text" name="f_name" class="form-control" required>
                        <label for="l_name">Last Name</label>
                        <input type="text" name="l_name" class="form-control" required>
                        <label for="age">Age</label>
                        <input type="number" name="age" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Add Student</button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php include('footer.php'); ?>
