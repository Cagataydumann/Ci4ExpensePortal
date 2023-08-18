# User Manual
Expense Portal
Expense Portal is a small-scale management application example that can be used by employees, managers, and administrators. Through this portal, employees can create and view expense requests, while managers can approve or reject expense requests created by employees. Additionally, managers can add new employees and departments, update or delete employee information. The system administrator (sys_admin) has all these capabilities along with the ability to create and manage administrator accounts.

## Usage:
Log in with the sys_admin user and create administrator accounts.
Then log in with the created admin accounts.

## Creating a Department
Log in with an admin account.
Go to the main panel and select the "Create Department" option.
Alternatively, choose the "Utilities" option in the Side-Bar and then select "Add Department" from the options that appear.
Fill in the required information and click the "Create Department" button.

## Creating a Designation
Log in with an admin account.
Go to the main panel and select the "Create Designation" option.
Alternatively, choose the "Utilities" option in the Side-Bar and then select "Add Designation" from the options that appear.
Fill in the required information and click the "Create Designation" button.

## Creating a Currency
Log in with an admin account.
Go to the main panel and select the "Add Currency" option.
Alternatively, choose the "Utilities" option in the Side-Bar and then select "Add Currency" from the options that appear.
Fill in the required information and click the "Create Currency" button.

## Creating an Expense Type
Log in with an admin account.
Go to the main panel and select the "Create Designation" option.
Alternatively, choose the "Utilities" option in the Side-Bar and then select "Add Expense Type" from the options that appear.
Fill in the required information and click the "Create Expense Type" button.

## Creating an Employee
Log in with an admin account.
Go to the main panel and click on the "components" option in the Side-Bar.
Select "Create Employee" from the options that appear.
Fill in the required information and click the "Create Employee" button.

## Creating an Admin
Log in with the administrator account designated as sysadmin.
Go to the main panel and click on the "components" option in the Side-Bar.
Select "Admin Create" from the options that appear.
Fill in the required information and click the "Create Admin" button.

## Assigning a Manager
Log in with an admin account.
Go to the main panel and click on the relevant person from the list of employees.
Click the "Edit" button.
Fill in the required information, select "is Manager" as "Yes," and save.

## Creating an Expense Report
Log in with a personnel or manager account.
Go to the main panel and select the "Create Expense Request" option.
Fill in the required information and click the "Submit Expense Request" button.
Click the "Choose File" button to add an attachment and upload your file.

## Viewing Expense Reports
Log in with a personnel account.
Go to the main panel and select the "Tables" option in the Side-Bar.
Select "Expense Requests" from the options that appear.

## Approving/Rejecting Expense Reports
Log in with a manager account.
Go to the main panel and select the "Tables" option in the Side-Bar.
Select "Expense Reports" from the options that appear.
Click on the relevant expense report to view details.
You can approve or reject the expense report.
If desired, you can download the expense report using the "Create PDF Report" button.

## Generating Reports for All Expenses
Log in with an admin account.
Go to the main panel and select the "Tables" option in the Side-Bar.
Select "Expense Reports" from the options that appear.
Then click the "Generate Expense Reports" button to create a PDF report.

## Portal Usage Details
Sys_admin account details:
--- email: test@test.com
--- password: 123

- You can log in to the system and use it with these credentials.
- Email sending is handled by the mailtrap.io system.
- The system email must be a real email.
- If a user wants to test email sending, they should modify their own email test information in the EmailController. (Currently, the system uses Çağatay Duman's Gmail address and Mailtrap.io credentials.)