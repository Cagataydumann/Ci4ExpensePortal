<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Expense Portal<sup>v1</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <?php if (session()->get('isLoggedIn')): ?>
    <li class="nav-item active">
        <?php if (session()->get('userType') === 'admin'): ?>
            <a class="nav-link" href="/admin/dashboard"><i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        <?php elseif (session()->get('userType') === 'employee'): ?>
            <a class="nav-link" href="/employee/dashboard"><i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        <?php elseif (session()->get('userType') === 'manager'): ?>
            <a class="nav-link" href="/manager/dashboard"><i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        <?php endif; ?>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <?php if (session()->get('userType') === 'admin'): ?>
                <a href="/admin/createEmployee" class="collapse-item">Create Employee</a>
                <?php endif; ?>
                <?php if (session()->get('sys_admin') == 1): ?>
                    <a href="/admin/addAdmin" class="collapse-item"">Admin Create</a>
                <?php endif; ?>
            </div>

        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
           aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <?php if (session()->get('userType') === 'admin'): ?>
                <a href="/admin/getCreateDepartment" class="collapse-item">Add Department</a>
                <a href="/admin/getCreateDesignation" class="collapse-item">Add Designation</a>
                <a href="/admin/getCreateExpenseType" class="collapse-item">Add Expense Type</a>
                <a href="/admin/getCreateCurrency" class="collapse-item">Add Currency</a>
                <?php endif; ?>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
           aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Logout Screen:</h6>
                <a class="collapse-item" href="<?= site_url('logout') ?>">Logout</a>
            </div>
        </div>
    </li>


    <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTables"
               aria-expanded="true" aria-controls="collapseTables">
                <i class="fas fa-fw fa-table"></i>
                <span>Tables</span>
            </a>
            <div id="collapseTables" class="collapse" aria-labelledby="headingTables" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Table Options:</h6>
                    <?php if (session()->get('userType') === 'admin'): ?>
                    <a class="collapse-item" href="/admin/getAllEmployees">Employees</a>
                    <a class="collapse-item" href="/admin/viewAllExpenseReports">Expense Reports</a>
                    <a class="collapse-item" href="/admin/getAllManagers">Managers</a>
                    <?php endif; ?>
                    <?php if (session()->get('sys_admin') == 1): ?>
                        <a class="collapse-item" href="/admin/getAllAdmins">Admins</a>
                    <?php endif; ?>
                    <?php if ((session()->get('userType') === 'employee') || (session()->get('userType') === 'manager')): ?>
                        <a class="collapse-item" href="/employee/expense_requests">Expense Requests</a>
                    <?php endif; ?>
                    <?php if (session()->get('userType') === 'manager'): ?>
                        <a class="collapse-item" href="/manager/viewReports">Expense Reports</a>
                    <?php endif; ?>
                </div>
            </div>
        </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    <?php endif; ?>
</ul>
<!-- End of Sidebar -->
