# Backend Project - FCT Job Application

This is the backend project for the job application at **FCT**.

Front-end: https://github.com/rafiuskdev/fct-test-frontend

## 🚀 Technologies

- PHP 8.2
- Laravel 12
- Docker
- Nginx
- Pexels API

## 🏗️ Architecture & Patterns

- Clean Architecture
- Repository Pattern
- Service Layer Pattern
- DTO Pattern
- SOLID Principles
- PSR-4 Autoloading

## 📦 Dependencies

Before you begin, ensure you have the following installed:
- Docker & Docker Compose 

## 🛠️ Setup

1. Clone the repository
2. Copy `.env.example` to `.env`
3. Set up your Pexels API key in `.env` (you can use this example key: `BzMjOjkwJP3D9v8IlcuKt8aTZ70RtdWMsl5sgp9GMIGiK25cCPqoF2Gb`)
4. Run the application using Docker:

```bash
docker-compose up -d
```

The application will be available at `http://localhost:8000`

## 📡 API Endpoints

### Video Search
```
GET /api/videos
```

Query Parameters:
- `query` (optional): Search term
- `page` (required): Page number
- `per_page` (required): Items per page
- `locale` (optional): Language code
- `size` (optional): Video size
- `is_popular` (required): Boolean
- `orientation` (optional): Video orientation

### Get Video by ID
```
GET /api/videos/{id}
```

## 🏗️ Project Structure

```
src/
└── Core/
    ├── Domain/
    │   ├── Entities/
    │   ├── Repositories/
    │   └── Services/
    └── Infra/
        ├── Http/
        │   ├── Controllers/
        │   └── Requests/
        └── Repositories/
```

## 🔧 Development

To start development:

```bash
docker-compose up -d
```