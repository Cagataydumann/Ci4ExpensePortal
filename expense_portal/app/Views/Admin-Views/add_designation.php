<?= view('Templates/header') ?>

<div id="wrapper">
    <?= view('Templates/sidebar') ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Add Designation</h1>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Create New Designation</h6>
                            </div>
                            <div class="card-body">
                                <form method="post" action="/admin/CreateDesignation">
                                    <div class="form-group">
                                        <label for="designation_name">Designation</label>
                                        <input type="text" class="form-control" id="designation_name" name="designation_name" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Create Designation</button>
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
