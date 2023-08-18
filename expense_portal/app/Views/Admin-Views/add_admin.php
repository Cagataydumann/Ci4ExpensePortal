<?= view('Templates/header') ?>

<div id="wrapper">
    <?= view('Templates/sidebar') ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <h2>Add Admin</h2>
            <form id="addAdminForm" method="post" action="/admin/createAdminAccount">
                <div>
                    <label for="admin_name">Admin Name</label>
                    <input type="text" name="admin_name" required>
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" required>
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" name="password" required>
                </div>
                <button type="button" id="createAdminButton" class="btn btn-primary">Create Admin</button>
            </form>
        </div>
    </div>
</div>

<?= view('Templates/footer') ?>

<script>
    $(document).ready(function() {
        $('#adminTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/admin/createAdminAccount',
                method: 'POST'
            },
            columns: [
                { data: 'admin_name', name: 'admin_name' },
                { data: 'email', name: 'email' },
                { data: 'password', name: 'password' },
                { data: 'sys_admin', name: 'sys_admin' },
                { data: 'actions', name: 'actions' }
            ]
        });
        $('#createAdminButton').click(function() {
            $.ajax({
                url: '/admin/createAdminAccount',
                method: 'POST',
                data: $('#addAdminForm').serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#adminTable').DataTable().ajax.reload();
                        $('#addAdminForm')[0].reset();
                        if (response.redirect) {
                            window.location.href = response.redirect;
                        }
                        alert('Admin created successfully.'); // Burada uyarı mesajı ekleniyor
                    } else {
                        alert('Admin creation failed.');
                    }
                }
            });
        });
    });
</script>