<?= view('Templates/header') ?>

<div id="wrapper">
    <?= view('Templates/sidebar') ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <h2>View Reports</h2>
            <a href="<?= site_url('admin/generateAllExpenseReports') ?>" class="btn btn-primary mb-3">Generate Expense Reports</a>
            <div class="table-responsive">
                <table id="reportTable" class="table">
                    <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Request Date</th>
                        <th>Expense Type ID</th>
                        <th>Company</th>
                        <th>Amount</th>
                        <th>Currency ID</th>
                        <th>Bill</th>
                        <th>Status</th>
                        <th>Description</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<?= view('Templates/footer') ?>

<script>
    $(document).ready(function() {
        $('#reportTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/admin/viewAllExpenseReports', // API endpoint
                method: 'GET'
            },
            columns: [
                { data: 'employee_id', name: 'employee_id' },
                { data: 'expense_date', name: 'expense_date' },
                { data: 'expense_type', name: 'expense_type' },
                { data: 'company_name', name: 'company_name' },
                { data: 'amount', name: 'amount' },
                { data: 'currency', name: 'currency' },
                { data: 'bill_attachment', name: 'bill_attachment' },
                { data: 'status', name: 'status' },
                { data: 'description', name: 'description' }
            ]
        });
    });
</script>
