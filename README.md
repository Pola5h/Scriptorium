This project follows the **Repository Design Pattern** while adhering to the **SOLID principles**:

1. **Single Responsibility Principle (SRP)** – Each layer has a distinct role:

   * The **repository** handles database interactions.
   * The **service** manages business logic.
   * The **controller** deals with HTTP requests and validation.

2. **Open/Closed Principle (OCP)** – Functionality can be extended by adding new services or repositories without modifying existing code.

3. **Liskov Substitution Principle (LSP)** – The **CommonRepository** and **CommonService** allow child classes (e.g., Book, Author, Publisher) to replace them without breaking functionality.

4. **Interface Segregation Principle (ISP)** – Specific repositories handle logic for their respective models, avoiding a single, overly complex repository.

5. **Dependency Inversion Principle (DIP)** – Services depend on abstract repositories rather than concrete Eloquent models, enhancing flexibility.


Here's a high-level flow map of how requests move through project:

```
Client (API request)
      │  
      ▼  
Routes (routes/api.php)
      │  
      ▼  
Controller (BookController, AuthorController, etc.)
      │  
      ▼  
Validation (ValidatesData trait + getRules())
      │  
      ▼  
Service Layer (BookService, AuthorService, etc.)
      │  
      ▼  
Repository Layer (BookRepository, AuthorRepository, etc.)
      │  
      ▼  
Model (Book, Author, Publisher)
      │  
      ▼  
Database (MySQL/PostgreSQL, etc.)
      │  
      ▼  
Response back to Client  
(Model → Repository → Service → Controller → JSON Response)
```

### Breakdown of the flow:
1. **Client makes a request** → Hits the correct route (`routes/api.php`).
2. **Controller processes the request** → Calls validation (`getRules()` method).
3. **Service applies business logic** → Calls the repository.
4. **Repository interacts with the database** → Retrieves or modifies data via Eloquent models.
5. **Response is sent back** → Data passes through service and controller, then returns as JSON.

This structure ensures:
- **Separation of concerns** (each layer has a specific role).
- **Modular & maintainable architecture** (easy to update and scale).
- **SOLID principles** (controllers don’t directly interact with the database).

### Helpful Blogs

1. [Structuring a Laravel Project with the Repository Pattern and Services - dev.to](https://dev.to/blamsa0mine/structuring-a-laravel-project-with-the-repository-pattern-and-services-11pm)

2. [Laravel 9 Repository Design Pattern CRUD Example - LaraInfo](https://larainfo.com/blogs/laravel-9-repository-design-pattern-crud-example/)

3. [Laravel Repository Pattern - Medium (Soulaimane YH)](https://medium.com/@soulaimaneyh/laravel-repository-pattern-da4e1e3efc01)

