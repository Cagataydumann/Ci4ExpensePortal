<?= view('Templates/header') ?>


<div id="wrapper">
    <?= view('Templates/sidebar') ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Employees</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <?php if (!empty($requests)) : ?>
                        <table id="reportTable">
                            <thead>
                            <tr>
                                <th>Expense Date</th>
                                <th>Expense Type</th>
                                <th>Company</th>
                                <th>Amount</th>
                                <th>Currency</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($requests as $row) : ?>
                                <tr>
                                    <td><?= $row['expense_date'] ?></td>
                                    <td><?= $expenseTypeMap[$row['expense_type']] ?></td>
                                    <td><?= $row['company_name'] ?></td>
                                    <td><?= $row['amount'] ?></td>
                                    <td><?= $currencyMap[$row['currency']] ?></td>
                                    <td><?= $row['status'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                    </div>
                </div>
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
                url: '/employee/expense_requests', // API endpoint
                method: 'GET',
                success: function(data) {
                    var expenseRequests = data.expenseRequests;

                    if ($.fn.DataTable.isDataTable('#reportTable')) {
                        $('#reportTable').DataTable().destroy();
                    }
                    $('#reportTable').DataTable({
                        data: expenseRequests,
                        columns: [
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
                            { data: 'status', name: 'status' },
                        ]
                    });
                },
                error: function(xhr, status, error) {
                    console.log('Ajax Error:', xhr.responseText);
                    console.log('Status:', status);
                    console.log('Error:', error);
                }
            }
        });
    });
</script>



