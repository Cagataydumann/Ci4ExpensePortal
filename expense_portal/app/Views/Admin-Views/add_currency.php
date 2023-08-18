<?= view('Templates/header') ?>

<div id="wrapper">
    <?= view('Templates/sidebar') ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Add Currency</h1>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Create New Currency</h6>
                            </div>
                            <div class="card-body">
                                <form method="post" action="/admin/CreateCurrency">
                                    <div class="form-group">
                                        <label for="currency_name">Currency</label>
                                        <input type="text" class="form-control" id="currency_name" name="currency_name" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Create Currency</button>
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
