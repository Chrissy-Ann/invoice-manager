# Invoice Manager
- Name: Christina Hollands
- Student Number: 041131217
- Section Number: 300/301


1. What changes did you make when refactoring the project?

- When refactoring, I removed the template I was using before because there is no more repeated code, and I deleted the other pages. I also changed the navigation to use query strings instead of linking to another page.

2. In your own words, what are the guidelines for knowing when to use $_POST over query strings and $_GET?

- When the user is submitting a large amount of information, $_POST is better to use, because it can transmit more data at once. In this project, when adding a new invoice, we use post to because the user is filling in multiple fields which correspond to a few key-value pairs. To filter the invoice statuses, we use get because there is less information. Also, if the information being entered is sensitive, it shouldn't use get which would put it in the URL and make it visible.

3. What are some limitations to using sessions for persistent data? What could be done to overcome those limitations?

- When using sessions for persistent data, the major limitation is that when the browser is closed, the session ends and all the previously saved data is then lost. To save the data and keep it persistent, the best way is to use a database.

