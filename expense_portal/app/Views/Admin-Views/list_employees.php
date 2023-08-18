<?= view('Templates/header') ?>

<div id="wrapper">
    <?= view('Templates/sidebar') ?>
    <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
            <h1 class="text-center">All Employees</h1>
            <div class="table-responsive">
                <table id="employeeTable" class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Employee Name</th>
                        <th>Employee Email</th>
                        <th>Department</th>
                        <th>Designation</th>
                        <th>Responsible Manager</th>
                        <th>Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- DataTables will populate the rows here -->
                    </tbody>
                </table>
            </div>
            </div>
    </div>
</div>

<?= view('Templates/footer') ?>

<script>
    $(document).ready(function() {
        $('#employeeTable').DataTable({
            "ajax": {
                "url": "/admin/getAllEmployeesData", // API endpoint
                "dataSrc": "data" // Dönen verinin kaynağı
            },
            "columns": [
                {"data": "employee_id"},
                {"data": "employee_name"},
                {"data": "email"},
                {"data": "department_name"},
                {"data": "designation_name"},
                {"data": "name"},
                {
                    "data": "employee_id",
                    "render": function(data, type, row) {
                        return '<a href="/admin/updateEmployee/' + data + '" class="btn btn-primary">Edit</a>';
                    }
                }
            ]
        });
    });
</script>
