<?= view('Templates/header') ?>

<div id="wrapper">
    <?= view('Templates/sidebar') ?>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Create Expense Request</h1>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Expense Request Form</h6>
                            </div>
                            <div class="card-body">
                                <form action="/employee/createExpenseRequest" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="expense_date">Expense Date</label>
                                        <input type="date" class="form-control" id="expense_date" name="expense_date" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="expense_type">Expense Type</label>
                                        <select class="form-control" id="expense_type" name="expense_type" required>
                                            <?php foreach ($expenseTypes as $type) : ?>
                                                <option value="<?= $type['expense_type_id'] ?>"><?= $type['expense_type_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="company_name">Company Name</label>
                                        <input type="text" class="form-control" id="company_name" name="company_name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type="number" class="form-control" id="amount" name="amount" step="0.01" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="currency">Currency</label>
                                        <select class="form-control" id="currency" name="currency" required>
                                            <?php foreach ($currencies as $currency) : ?>
                                                <option value="<?= $currency['currency_id'] ?>"><?= $currency['currency_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="bill_attachment">Bill Attachment</label>
                                        <input type="file" class="form-control-file" id="bill_attachment" name="bill_attachment" accept=".pdf,.jpg,.jpeg,.png" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit Expense Request</button>
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

