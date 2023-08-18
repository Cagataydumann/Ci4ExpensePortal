<?= view('Templates/header') ?>

<div id="wrapper">
    <?= view('Templates/sidebar') ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Add Employee</h1>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Create New Employee Account</h6>
                            </div>
                            <div class="card-body">
                                <!-- Validasyon hatalarını göster -->
                                <?php if(isset($validation)): ?>
                                    <div class="alert alert-danger">
                                        <ul>
                                            <?php foreach ($validation->getErrors() as $error): ?>
                                                <li><?= $error ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                                <form id="addEmployeeForm" method="post" action="/admin/createEmployeeAccount">
                                    <div class="form-group">
                                        <label for="employee_name">Employee Name</label>
                                        <input type="text" class="form-control" id="employee_name" name="employee_name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="manager_id">Manager</label>
                                        <select class="form-control" id="manager_id" name="manager_id" required>
                                            <?php foreach ($managers as $manager): ?>
                                                <option value="<?= $manager['manager_id'] ?>"><?= $manager['name'] ?></option>
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
                                    <button type="submit" class="btn btn-primary">Create Employee</button>
                                </form>
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
        $('#addEmployeeForm').submit(function(event) {
            event.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Show success message and redirect
                        $('#message').html('<div class="alert alert-success">' + response.message + ' Redirecting to dashboard...</div>');
                        setTimeout(function() {
                            window.location.href = '/admin/dashboard';
                        }, 1000);
                    } else {
                        // Show error message
                        $('#message').html('<div class="alert alert-danger">' + response.message + '</div>');
                        console.error('AJAX Error');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Request Error:', error);
                    console.error('Response:', xhr.responseText);
                }
            });
        });
    });
</script>



