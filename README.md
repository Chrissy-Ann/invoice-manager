# Invoice Manager
- Task: Refactor the Invoice Manager to be a database-driven web application.

1. Beyond incorporating the invoice_manager.sqlite database, what other refactoring did you do for this part of the project?

- Other than adding in the database, I created more functions in functions.php for the CRUD operations, instead of putting all the code on the main web pages. I edited the $statuses array in data.php to retrieve the statuses from the database. I also made a template of the inputs, like in the movie-mayhe demo, for the forms in update.php and add.php, because I was repeating the code.

2. In your own words, why is it important to use prepared statements and when should you use them?

- It is important to use prepared statements to avoid SQL injection. This is when a user submits malicious input, such as SQL instructing the database to delete data. Prepared statements should be used whenever data is received from a user to be sent to the database, such as a form with user inputs to add, update or delete something from the database.

3. How did using a database to manage the data differ from using a session array? Which do you prefer and why?

- Using a database means that the data stays persistent even between sessions, when the browser is closed. I prefer databases when a lot of data is being handled, because it is more robust than using sessions.
