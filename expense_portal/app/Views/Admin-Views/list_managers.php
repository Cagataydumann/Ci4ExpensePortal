<?= view('Templates/header') ?>

<div id="wrapper">
    <?= view('Templates/sidebar') ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <h1 class="text-center">All Managers</h1>
            <div class="table-responsive">
                <table id="managerTable" class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Manager Name</th>
                        <th>Manager Email</th>
                        <th>Department</th>
                        <th>Designation</th>
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
        $('#managerTable').DataTable({
            "ajax": {
                "url": "/admin/getAllManagersData", // API endpoint
                "dataSrc": "data"
            },
            "columns": [
                {"data": "manager_id"},
                {"data": "name"},
                {"data": "email"},
                {"data": "department_name"},
                {"data": "designation"},
            ]
        });
    });
</script>
