

### 1. **Clone the Repository**:

URL of Git repository.

```bash
git clone [https://github.com/Fatima-Zaka/library-management.git]
cd [Library Managment]
```

### 2. **Install Project Dependencies**:

Assuming you're using Composer for a Laravel project:

```bash
composer install
```

### 3. **Environment Configuration**:

Copy the `.env.example` file to `.env`.

```bash
cp .env.example .env
```
configuring database connections and any other environment-specific details in the `.env` file.

### 4. **Generate Application Key**:

Since Laravel requires an app key for encryption:

```bash
php artisan key:generate
```
Of course, let's focus on setting up the database and testing the API using Postman.

### 5. Setting up the Database:

#### **Create a New Database**:
1. Launch your database management tool (like phpMyAdmin, MySQL Workbench, etc.).
2. Create a new database on your local system named after the project or as you see fit.

#### **Import the `.sql` file**:
Assuming the `.sql` file is in a directory named `database_backup` in the project:

**Using Command Line (for MySQL)**:
```bash
mysql -u [YOUR_DB_USERNAME] -p [YOUR_DB_NAME] < database_backup/database_name.sql
```

Enter your password when prompted.
### 6. **Database Migrations**:

If your project utilizes database migrations:

```bash
php artisan migrate
```

### 7. **Start the Local Development Server**:

start the Laravel development server:

```bash
php artisan serve
```

The project should now be running at `http://localhost:8000`.

### 8. Testing the API using Postman:

#### **Import Postman Collection**:
1. Open Postman.
2. Click on the "Import" button at the top left.
3. Choose the Postman collection `.json` file related to the project.
4. After importing, you'll see the collection with all the endpoints in the sidebar.

#### **Setup Environment Variables (if provided)**:
1. In Postman, click on the gear icon (top right) to manage environments.
2. Click "Import" and choose the environment `.json` file.
3. Make sure to select the imported environment from the environment dropdown (next to the gear icon).

#### **Testing Endpoints**:
1. Click on any endpoint in the collection to load it.
2. Ensure the base URL is correct (it should be `http://localhost:8000` or wherever your project is running).
3. Send requests and verify the responses.

By following these steps, you'll have the database set up and be ready to test the API using Postman.

### 8. **Update Base URL**:

Update the base URL to `http://localhost:8000`. Otherwise, You should manually update the base URL in the collection.
  
## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
