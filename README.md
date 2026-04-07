# Drole Task

Drole Task is a simple task management application designed to help users organize and track their daily tasks efficiently. It provides an intuitive interface for creating, updating, and completing tasks, with features like categorization and prioritization.

## Installation

1. **Clone the repository:**
    ```bash
    git clone https://github.com/yourusername/drole-task.git
    cd drole-task
    ```

2. **Install dependencies:**
    ```bash
    composer install
    npm install
    ```

3. **Set up the environment:**
    - Copy `.env.example` to `.env` and configure your database settings.
    - Generate an application key:
      ```bash
      php artisan key:generate
      ```

4. **Run migrations:**
    ```bash
    php artisan migrate
    ```

5. **Build assets:**
    ```bash
    npm run build
    ```

6. **Start the application:**
    ```bash
    php artisan serve
    ```
    Access the app at `http://localhost:8000`.

## Step-by-Step Guide to Using the Application

# User Guide: Student & Staff Management System

## 1. Authentication
* **Register or Log In:** Open the application and click **Register** to create a new account or **Log In** if you already have one.
* **Test Credentials:** For quick access, you can use:
    * **Email:** `test@example.com`
    * **Password:** `password`

---

## 2. Managing Records (Students & Staff)
* **Manual Entry:** 1. Navigate to the **Students** or **Staff** section via the sidebar.
    2. Click the **Add New** button.
    3. Fill in the **Name** and select the **Department** (e.g., CS, Maths, Physics). 
    4. For students, select the **Programme** (UG, PG, or PhD). This list filters automatically based on the chosen department.
    5. Click **Save** to add the record.
* **Searching & Filtering:** Use the search bar above the table to instantly filter records by name, department, or programme.

---

## 3. Bulk Import Functionality
To add large volumes of data at once, use the automated import feature:
* **Upload:** Click the **Import CSV/Excel** button and select your file (`.csv` or `.xlsx`).
* **Background Processing:** The system uses a **Queued Job** to process the file. You can continue using the application while the data is being imported in the background. use the below command to trigger the queues.

```bash
 php artisan queue:work
```

---

## 4. Exporting Data
* **Instant Download:** Click the **Export Excel** button located at the top of the management pages.
* **Data Format:** The system will generate an `.xlsx` file containing categorized columns: `ID`, `Name`, `Department`, and `Programme`. 
* **Process:** The export is synchronous and will start downloading to your browser immediately.

---

## 5. System Maintenance
* **Database Seeding:** Ensure the system administrator has run the seeders to populate the **Departments** (CS, Maths, Physics) and their respective **Programmes** (UG, PG, PhD).
* **Log Out:** Click on your profile icon in the top-right corner and select **Log Out** to securely end your session.

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request with your improvements.

## License

This project is licensed under the MIT License.
