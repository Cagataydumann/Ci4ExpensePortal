<?= view('Templates/header') ?>

<div id="wrapper">
    <?= view('Templates/sidebar') ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
    <h2>View Reports</h2>
    <?php if (!empty($requests)) : ?>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th>Request Date</th>
                    <th>Type</th>
                    <th>Company</th>
                    <th>Amount</th>
                    <th>Currency</th>
                    <th>Bill</th>
                    <th>Status</th>
                    <th>Description</th>
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
                        <td><?= $row['bill_attachment'] ?></td>
                        <td><?= $row['status'] ?></td>
                        <td>
                            <?= $row['description'] ?>
                            <?php if ($row['status'] === 'pending') : ?>
                                <form method="post" action="<?= site_url('/manager/approveRejectReport/' . $row['request_id']) ?>" style="display: inline;">
                                    <textarea name="description" placeholder="Enter your note here"></textarea>
                                    <button type="submit" name="status" value="approved" class="btn btn-success btn-sm">Approve</button>
                                    <button type="submit" name="status" value="rejected" class="btn btn-danger btn-sm">Reject</button>
                                </form>
                            <?php else : ?>
                                <a href="<?= site_url('/manager/viewReportDetails/' . $row['request_id']) ?>" class="btn btn-primary btn-sm">Details</a>
                                <a href="<?= site_url('/manager/generateExpenseReport/' . $row['request_id']) ?>" class="btn btn-primary btn-sm">Generate Report</a>
                            <?php endif; ?>
                        </td>
                        <td>

                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
        </div>
    </div>
</div>

<?= view('Templates/footer') ?>

