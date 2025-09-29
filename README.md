
# **AssignPlatform** - Assignment Management System

AssignPlatform is an interactive **web application** designed for academic institutions. It allows **professors** to distribute assignments and manage submissions from **students** in a streamlined manner. Students can view, complete, and submit their assignments directly through the platform.

---

## **Table of Contents**

- [Overview](#overview)
- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
---

## **Overview**

AssignPlatform simplifies the assignment distribution process for professors and enhances the submission workflow for students. The system is built using **PHP** , **MySQL**, **XSL** and **XML** providing an efficient and secure environment for academic work management.

**Key functionalities include:**
- Professors can create, edit, and assign tasks.
- Students can view assignments, submit their work, and track progress.
 

---

## **Features**

- **Assignment Creation & Management**: Professors can create assignments and provide descriptions.
- **Submission Tracking**: Students can submit their assignments .
- **Responsive Design**: The platform adapts seamlessly to any device.
- **Secure Login**: User authentication for students and professors.

---

## **Installation**

To get **AssignPlatform** up and running locally, follow these steps:

### 1. Clone the repository:

```bash
git clone https://github.com/SotirisXaram/AssignPlatform
```

### 2. Navigate to the project folder:

```bash
cd AssignPlatform
```

### 3. Install **XAMPP** (if not already installed).
   
   - XAMPP: [XAMPP Download](https://www.apachefriends.org/download.html)

### 4. Start XAMPP:
   - Open the XAMPP Control Panel and start Apache and MySQL services.
 

### 5. Create / Import the database schema into MySQL::
 
   - Open phpMyAdmin via http://localhost/phpmyadmin/.

   - Create a new database (e.g., assignplatform_db).
 
   - Edit the config.php file to enter the db name , username and password . 

   - You can also use the dummy export.sql provided to simulate data (Import it to phpmyadmin, no password by default).

 
### 6. Place the project in the XAMPP web directory:
Move or copy the AssignPlatform project folder to the htdocs directory of your XAMPP installation. Typically, the htdocs folder is located at C:\xampp\htdocs on Windows or /Applications/XAMPP/htdocs/ on macOS.

### 7. Start the PHP development server:
Open your web browser and visit http://localhost/AssignPlatform/ (make sure your project folder is named AssignPlatform or match it accordingly).
 
 
## **Usage**

Once installed, you can begin by logging in as either a **professor** or **student**.

### **For Professors**:
- **Create Assignments**: Go to the “Assignments” tab and click on “Create Assignment.”
- **Grade Submissions**: View submitted assignments .
- **Manage Students**: View all student profiles and their assignment progress.

### **For Students**:
- **View Assignments**: Navigate to the “Assignments” tab to view and download assignments.
- **Submit Work**: Submit your completed assignments by attaching files .



---

## **Acknowledgements**

- [PHP](https://www.php.net/)
- [MySQL](https://www.mysql.com/)
- [Bootstrap](https://getbootstrap.com/)

