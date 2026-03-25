# To do list

![Screenshot of a to-do list app made in WebEngine](screenshot.png)

A basic database-driven to-do list with CSS styling and no JavaScript.

This blueprint will help you get on the way with introducing a database and page interaction, and acts as a good learning tool.

To run: `composer install` to set up the project, `gt migrate` to create the database, `gt run` to start the server, then visit http://localhost:8080 

## The database

This project uses an SQLite to persist its state, storing a `todo-list.sqlite` file in the project root. It is not built to be multi-user, so hosting this code online would mean that anyone can update the to-do list. Not too much work is required to add multi-user concurrency, but that's outside the scope of this blueprint.

There's only a single table `todo`, created in the `query/_migration/001-schema.sql` file (which can be executed using `gt migrate`).

The CRUD queries are stored in `query/todo` - there are only 4 query files: `create.sql`, `retrieve.sql`, `update.sql`, `delete.sql`.

## The model

Each record in the database is represented by an instance of `TodoItem`. This is handled by the `TodoList` class, which acts as a Repository, being constructed by the `ServiceLoader` with a reference to the database. 

## The page view and logic

There is only one page: `index`. The `index.html` stores the view, which is mainly static, apart from the `<li>` element that has the `data-list` attribute, indicating that it should be repeated for every item in the list.

The logic is stored in `index.php`. The `go()` function is executed every page view. Within the page there are `<button>` elements that have their `name` attribute set to `do`. Clicking these buttons executes the corresponding `do_*()` functions in `index.php`.

Any classes that are required for the `go` and `do` functions to do their job are passed as parameters to the functions, and their construction is handled once in the `ServiceLoader`.
