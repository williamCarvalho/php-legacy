[English](README.md) | [Portuguese](README.pt.md)

# 🔄 Legacy Modernization Project: PHP OO Monolith to REST API + Modern SPA

This repository demonstrates the refactoring and modernization strategy of a legacy monolithic PHP OO system, transforming it into a decoupled architecture based on a **RESTful API (Native PHP)** consumed by a **SPA Panel in React**.

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

- **Legacy & Backend API:** Native PHP (POO, PSR standards, PDO)
- **Modern Frontend:** React / Vue.js, Tailwind CSS (or MUI), Axios/Fetch
- **Database:** MySQL / PostgreSQL
- **Standards and Principles:** REST, MVC / Repository Pattern, SOLID (Single Responsibility and Dependency Inversion)

---

## 🚀 Key Benefits of Refactoring

1. **Code Reuse:** The new API allows future clients (mobile, third-party integrations) to consume the same data without modifying the backend.
2. **Reducing Coupling:** Rendering logic has been moved to the server, reducing the backend load by delivering compact JSON payloads.
3. **Ease of Testing:** Separating code into Controllers and Repositories allows for the isolation of SQL queries from business logic, facilitating more consistent testing.

---

## 📂 Code Overview

### Legacy Excerpt (`01-legacy/src/UserProcess.php`)

_(Excerpt illustrating the mix of HTML, direct POST processing, and SQL queries)_

### Modernized Excerpt (`02-modern-api/src/Controllers/UserController.php`)

_(Excerpt showing REST request handling, validation, and a JSON response with appropriate HTTP status codes)_
