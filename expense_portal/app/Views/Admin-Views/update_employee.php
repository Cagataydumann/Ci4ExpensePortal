<?= view('Templates/header') ?>

<div id="wrapper">
    <?= view('Templates/sidebar') ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Update Employee</h1>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Edit Employee Information</h6>
                            </div>
                            <div class="card-body">
                                <form id="updateEmployeeForm" action="/admin/updateEmployee/<?= $employee['employee_id'] ?>" method="post">
                                    <div class="form-group">
                                        <label for="employee_name">Employee Name</label>
                                        <input type="text" class="form-control" id="employee_name" name="employee_name" value="<?= $employee['employee_name'] ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?= $employee['email'] ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="manager_id">Manager</label>
                                        <select class="form-control" id="manager_id" name="manager_id" required>
                                            <?php foreach ($managers as $manager): ?>
                                                <option value="<?= $manager['manager_id'] ?>" <?= ($manager['manager_id'] == $employee['manager_id']) ? 'selected' : '' ?>><?= $manager['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="department">Department</label>
                                        <select class="form-control" id="department" name="department_id" required>
                                            <?php foreach ($departments as $department): ?>
                                                <option value="<?= $department['department_id'] ?>"><?= $department['department_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="designation">Designation</label>
                                        <select class="form-control" id="designation" name="designation_id" required>
                                            <?php foreach ($designations as $designation): ?>
                                                <option value="<?= $designation['designation_id'] ?>"><?= $designation['designation_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <?php if (session()->get('sys_admin') == 1): ?>
                                    <div class="form-group">
                                        <label for="is_manager">Is Manager?</label>
                                        <select name="is_manager" class="form-control">
                                            <option value="0" <?php if ($employee['is_manager'] == 0) echo 'selected'; ?>>No</option>
                                            <option value="1" <?php if ($employee['is_manager'] == 1) echo 'selected'; ?>>Yes</option>
                                        </select>
                                    </div>
                                    <?php endif; ?>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                                <form action="<?= site_url('/admin/deleteEmployee/' . $employee['employee_id']) ?>" method="post" onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>

                                <div id="message" class="mt-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('Templates/footer') ?>

<script>
    $(document).ready(function() {
        $('#updateEmployeeForm').submit(function(event) {
            event.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    console.log(response)
                    if (response.success) {
                        // Show success message and redirect if needed
                        $('#message').html('<div class="alert alert-success">Operation successful.</div>');
                        if (response.redirect) {
                            setTimeout(function() {
                                window.location.href = response.redirect;
                            }, 1000);
                        }
                    } else {
                        // Show error message
                        $('#message').html('<div class="alert alert-danger">Operation failed.</div>');
                    }
                }
            });
        });
    });
</script>
