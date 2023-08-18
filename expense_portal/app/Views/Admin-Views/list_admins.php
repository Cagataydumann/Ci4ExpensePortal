<?= view('Templates/header') ?>
<div id="wrapper">
    <?= view('Templates/sidebar') ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
        <h1 class="text-center">All Admins</h1>
        <div class="table-responsive">
            <table id="adminTable" class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
                </thead>
            </table>
        </div>
        </div>
    </div>
</div>

<?= view('Templates/footer') ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

<script>
    $(document).ready(function() {
        $('#adminTable').DataTable({
            "ajax": {
                "url": "/admin/getAdminsData", // API endpoint
                "dataSrc": "data" // Dönen verinin kaynağı
            },
            "columns": [
                {"data": "admin_id"},
                {"data": "admin_name"},
                {"data": "email"},
                {
                    "data": null,
                    "render": function(data, type, row) {
                        return '<a href="/admin/updateAdminAccount/' + data.admin_id + '" class="btn btn-primary">Edit</a>';
                    }
                }
            ]
        });
    });
</script>

<?= view('Templates/footer') ?>
