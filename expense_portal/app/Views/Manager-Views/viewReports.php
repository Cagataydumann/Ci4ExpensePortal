<?= view('Templates/header') ?>

<div id="wrapper">
    <?= view('Templates/sidebar') ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
    <h2>View Reports</h2>
    <div class="table-responsive">
        <table id="reportTable" class="table">
            <thead>
            <tr>
                <th>Employee Name</th>
                <th>Request Date</th>
                <th>Type</th>
                <th>Company</th>
                <th>Amount</th>
                <th>Currency</th>
                <th>Bill</th>
                <th>Status</th>
                <th>Description</th>
                <th>Details</th>
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
        var expenseTypeMap = <?= json_encode($expenseTypeMap) ?>;
        var currencyMap = <?= json_encode($currencyMap) ?>;
        $('#reportTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/manager/viewReports', // API endpoint
                method: 'GET'
            },
            columns: [
                { data: 'employee_name', name: 'employee_name' },
                { data: 'expense_date', name: 'expense_date' },
                {
                    data: 'expense_type',
                    name: 'expense_type',
                    render: function(data, type, row) {
                        return expenseTypeMap[data];
                    }
                },
                { data: 'company_name', name: 'company_name' },
                { data: 'amount', name: 'amount' },
                {
                    data: 'currency',
                    name: 'currency',
                    render: function(data, type, row) {
                        return currencyMap[data];
                    }
                },
                { data: 'bill_attachment', name: 'bill_attachment' },
                { data: 'status', name: 'status' },
                { data: 'description', name: 'description' },
                {
                    data: 'details',
                    render: function(data, type, row) {
                        return '<a href="/manager/viewReportDetails/' + row.request_id + '" class="btn btn-primary">Details</a>';
                    }
                }
            ]
        });
    });
</script>
