## Installation & updates

`composer create-project codeigniter4/appstarter` then `composer update` whenever
there is a new release of the framework.

When updating, check the release notes to see if there are any changes you might need to apply
to your `app` folder. The affected files can be copied or merged from
`vendor/codeigniter4/framework/app`.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

```python
# Write out the full comprehensive README.md file
readme_content = """# StaffHub — Company Employee Directory

A lightweight, modern Employee Directory CRUD application built using **CodeIgniter 4**, **MySQL 8.0**, and **Bootstrap 5**. The entire production and development environment is containerized using **Docker** and **Docker Compose**, allowing for an immediate "plug-and-play" deployment workflow on environments like ParrotOS, Debian, or any Docker-enabled operating system.

---

## 🏗️ Architecture Overview

The application architecture separates the presentation/logic layers from the persistent data tier using isolated container networks. 

* **`web` Container:** Runs an Apache HTTP server with PHP 8.2. It mounts the local source directory, overrides the default Apache virtual host configurations dynamically, and serves CodeIgniter's public-facing controller hub.
* **`db` Container:** Runs an isolated MySQL 8.0 instance. Data is persisted directly to your host machine via named Docker volumes so your employee data remains safe even if containers are stopped or rebuilt.

---

## Step-by-Step Installation & Setup

Follow these exact terminal steps to orchestrate the environment, download system dependencies, run database migrations, and spin up the directory.

### Prerequisites
Ensure your ParrotOS host machine has Docker and the Docker Compose plugin installed and active:

```
bash
sudo systemctl start docker

```

### 1. Configure the Environment Configuration (`.env`)

CodeIgniter uses an `.env` file at the root level to map database credentials and core application rules. Duplicate the system default template:

```bash
cp env .env

```

Open the newly created `.env` file in your preferred text editor (e.g., `nano .env` or `micro .env`) and ensure the following core configurations are uncommented and updated:

```ini
# Environment Target
CI_ENVIRONMENT = development

# App Host Config
app.baseURL = 'http://localhost:8080/'

# Database Connectivity Profiles
database.default.hostname = db
database.default.database = employee_db
database.default.username = ci_user
database.default.password = ci_password
database.default.DBDriver = MySQLi
database.default.port = 3306

```

> ⚠️ **Crucial Detail:** Notice that `database.default.hostname` is configured to point directly to `db` instead of `localhost` or `127.0.0.1`. This instructs CodeIgniter's MySQLi database client engine to traverse Docker's internal DNS network routing straight to your database container container service.

### 2. Boot the Docker Orchestration Infrastructure

Launch the dual-container topology in detached mode (running safely in the background):

```bash
docker-compose up -d

```

To confirm that both the Apache runtime engine and the MySQL database engine are completely online, execute:

```bash
docker-compose ps

```

### 3. Install Framework Packages & Seed Database Tables

Because the environment is completely fresh, you must instruct the container to download CodeIgniter's underlying framework vendors, construct the required database schemas, and seed initial records:

```bash
# 1. Download and map the required vendor dependencies inside the PHP container
docker-compose exec web composer install

# 2. Run Database Migrations to auto-construct the 'employees' structural schema
docker-compose exec web php spark migrate

# 3. Seed initial records (Alice, Bob, Charlie) into the directory for inspection
docker-compose exec web php spark db:seed EmployeeSeeder

```

### 4. Access the Running Directory

Open your web browser and load up your portal layout:
👉 **[http://localhost:8080/employees](https://www.google.com/search?q=http://localhost:8080/employees)**

---

## 🛠️ Docker Administration & Operational Commands

Here are standard system administration patterns to keep in mind when modifying or monitoring your app:

### Fixing Runtime File Permissions

If Apache throws an access warning or fails to write internal cache matrices on your ParrotOS host file system, unlock CodeIgniter's core file pipeline with:

```bash
chmod -R 777 writable

```

### Reviewing Container Runtime Diagnostics

If database connections are hanging or you are tracking application errors, trace live, color-coded internal engine outputs with:

```bash
docker-compose logs -f

```

### Cleaning or Stopping the Application

To shut down the webserver and database routing cleanly without dropping or losing your underlying SQL row records, run:

```bash
docker-compose down

```

If you wish to do a total infrastructure factory reset (which completely wipes out your system data tables and volumes to perform a fresh architectural rebuild), pass the volume flag:

```bash
docker-compose down -v

```

---

## 📂 Core Feature Directory Matrix

* **Create:** Dynamic input processing forms mapping strict constraints (`valid_email`, `is_unique` flags, minimum length checks) utilizing CodeIgniter's core `Validator`.
* **Read:** Complete structural employee dashboard wrapped dynamically inside Bootstrap 5 layout components.
* **Update:** Isolated item identifier routing tracking specific changes while maintaining column uniqueness exceptions.
* **Delete:** Inline JavaScript execution confirmation handling safe server-side records destruction and emitting validation notifications via Flash Sessions.
"""

with open("README.md", "w") as f:
f.write(readme_content.strip())
print("README.md file written successfully.")
