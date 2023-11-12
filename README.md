# OsaBus Currency Converter Application

This is a test project for the PHP developer position at OsaBus. It features a currency converter that utilizes an external API to fetch currency rates and perform conversions.

## Requirements

- Docker
- Docker Compose

## Installation and Setup

Clone the repository and navigate into the directory:

```bash
git clone https://github.com/janisdombr/osotest.git
cd osotest 
```

## Build and run the Docker containers:

```bash
docker-compose up --build -d
```

The application will be accessible at:

- Frontend: [http://localhost:8080](http://localhost:8080)
- Backend API: [http://localhost](http://localhost)

## Running Backend Tests
To execute PHPUnit tests inside the backend container:
```bash
docker-compose exec backend ./vendor/bin/phpunit
```
Ensure that the `backend` service is active before running the tests.
## Project Structure
`frontend/`: Contains Vue.js application files.
`backend/`: Contains CodeIgniter application files and PHPUnit tests.
