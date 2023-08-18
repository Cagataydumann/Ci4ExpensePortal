<?= view('Templates/header') ?>



<!-- Page Wrapper -->
<div id="wrapper">
    <?= view('Templates/sidebar') ?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">



            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <!-- Display these sections for users with both admin and employee roles -->
                    <?php if (session()->get('isBoth')): ?>
                        <div class="row">
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Creating Expense Request</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="/employee/getExpenseForm">Create Expense Request</a></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Listing All Yours Requests</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="/employee/expense_requests">Expense Requests Lists</a></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Listing Your Employees Requests</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="/manager/viewReports">Expense Requests Lists</a></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Rest of the content for admin role -->

                </div>

                <!-- Content Row -->

                <div class="row">


                <!-- Content Row -->
                <div class="row">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Employees</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="employeeTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Employee Name</th>
                                        <th>Employee Email</th>
                                        <th>Department</th>
                                        <th>Designation</th>
                                        <th>Responsible Manager</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <!-- DataTables will populate the rows here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Expense Portal</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>



<?= view('Templates/footer') ?>
        <script>
            $(document).ready(function() {
                $('#employeeTable').DataTable({
                    "ajax": {
                        "url": "/manager/getAllEmployeesDataByManager/<?= session()->get('userId') ?>", // API endpoint
                        "dataSrc": "data"
                    },
                    "columns": [
                        {"data": "employee_id"},
                        {"data": "employee_name"},
                        {"data": "email"},
                        {"data": "department_name"},
                        {"data": "designation_name"},
                        {"data": "name"},
                    ]
                });
            });
        </script>