[English](README.md) | [Portuguese](README.pt.md)

# 🔄 Legacy Modernization Project: PHP OO Monolith to REST API + Modern SPA

This repository demonstrates the refactoring and modernization strategy of a legacy monolithic PHP system, transforming it into a decoupled architecture based on a **RESTful API (Native PHP)** consumed by a **SPA Frontend in React**.

---

## 📊 Architecture: Before vs. After

### 🔴 Before (Legacy Monolith)

- **Tight Coupling:** Business logic, database access (SQL), and HTML/CSS rendering all mixed together in the same flow.
- **Maintainability:** High level of complexity in adding new features without causing side effects.
- **No Separation of Layers:** Requests handled directly via traditional forms with page reloads.

```text
[ Browser ] ---> [ Legacy PHP Script (SQL + Business Logic + HTML) ] ---> [ SQL Database ]
```

### 🟢 After (Decoupled Architecture)

- **Separation of Responsibilities:** Data/API layer completely isolated from the user interface.
- **Clean RESTful API:** Endpoints in native PHP structured using the Front Controller pattern, aligned with the JSON standard.
- **Reactive Frontend:** Modern SPA with local state management and asynchronous communication.

```text
[ React SPA ] ---> HTTP / JSON ---> [ PHP REST API (Router -> Controller -> Repository) ] ---> [ SQL Database ]
```

---

## 🛠️ Tech Stack

The project is structured as a monorepo, demonstrating the evolution from a legacy monolithic system to a modern, decoupled architecture:

### 1. Monolito Legado (`/01-legacy`)

- **Language:** PHP (procedural/OO)
- **Database:** MySQL (PDO)
- **Interface:** HTML5 / CSS3 with Bootstrap 5

### 2. Modern REST API (`/02-modern-api`)

- **Language:** PHP 8+ (OO)
- **Architecture:** Front Controller, Repository Pattern and SOLID Principles
- **Database:** MySQL (PDO and exception handling)
- **Communication:** RESTful API with CORS support and JSON payload

### 3. Modern SPA Frontend (`/03-frontend`)

- **Framework:** React (Vite)
- **UI Library:** Material UI (MUI)
- **State Management and Requests:** Native hooks (`useState`, `useEffect`, `useCallback`) and the native Fetch API with environment variables (`.env`)

---

## 🚀 Key Benefits of Refactoring

1. **Code Reuse:** The new API allows future clients (mobile, third-party integrations) to consume the same data without modifying the backend.
2. **Reducing Coupling:** Rendering logic has been moved to the server, reducing the backend load by delivering compact JSON payloads.
3. **Ease of Testing:** Separating code into Controllers and Repositories allows for the isolation of SQL queries from business logic, facilitating more consistent testing.

---

## 📂 Code Overview

### Legacy Monolith (`01-legacy/index.php`)

_(Demonstrates a mix of HTML, POST form processing and direct SQL queries within the same file)_

### Modern Backend - Routing (`02-modern-api/public/index.php`)

_(Single entry point responsible for handling CORS, normalizing URIs, and dispatching requests)_

### Modern Backend - Connection (`02-modern-api/src/database.php`)

_(Centralized database connection management using PDO)_

### Modern Backend - Repository (`02-modern-api/src/order-repository.php`)

_(Isolation of data persistence and SQL queries secured with Prepared Statements)_

### Modern Backend - Controller (`02-modern-api/src/order-controller.php`)

_(Snippet showing REST request handling, validation, and a JSON response with appropriate HTTP status codes)_

### Modern SPA Frontend (`03-frontend/src/App.jsx`)

_(React interface using Material UI (MUI), managing reactive state, forms and asynchronous data consumption via Fetch)_
