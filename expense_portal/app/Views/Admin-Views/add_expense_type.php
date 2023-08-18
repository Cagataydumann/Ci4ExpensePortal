<?= view('Templates/header') ?>

<div id="wrapper">
    <?= view('Templates/sidebar') ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Add Expense Type</h1>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Create New Expense Type</h6>
                            </div>
                            <div class="card-body">
                                <form method="post" action="/admin/CreateExpenseType">
                                    <div class="form-group">
                                        <label for="expense_type_name">Expense Type</label>
                                        <input type="text" class="form-control" id="expense_type_name" name="expense_type_name" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Create Expense Type</button>
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
