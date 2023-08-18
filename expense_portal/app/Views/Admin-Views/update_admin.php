<?= view('Templates/header') ?>

<div id="wrapper">
    <?= view('Templates/sidebar') ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
        <h2>Edit Admin</h2>
        <form method="post">
            <div class="form-group">
                <label for="admin_name">Admin Name</label>
                <input type="text" class="form-control" name="admin_name" value="<?= $admin['admin_name'] ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="<?= $admin['email'] ?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
        <form action="<?= site_url('/admin/deleteAdminAccount/' . $admin['admin_id']) ?>" onsubmit="return confirm('Are you sure you want to delete this admin?');">
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        <div id="message" class="mt-3"></div>
        </div>
    </div>
</div>

<?= view('Templates/footer') ?>

<script>
    $(document).ready(function() {
        $('form').submit(function(event) {
            event.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#message').html('<div class="alert alert-success">Operation successful.</div>');
                        if (response.redirect) {
                            setTimeout(function() {
                                window.location.href = response.redirect;
                            }, 1000);
                        }
                    } else {
                        $('#message').html('<div class="alert alert-danger">Operation failed.</div>');
                    }
                }
            });
        });
    });
</script>
