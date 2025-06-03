# Invoice Manager
- Name: Christina Hollands
- Student Number: 041131217
- Section Number: 300/301


1. What validation techniques did you use for this project?

- I created a sanitize and a validate function in functions.php. In the sanitization function I converted the one value in the data array that is 
supposed to be an int from a string, and stripped the white space, slashes and special characters. In the validate function, I used empty() to check whether an input had a value, because all inputs are required. For the client name, it had to be under 255 characters, so I did a simple numerical comparison using strlen(). It also could only be spaces and letters, so I used a regular expression and preg_match to test it. For the next two inputs, I used FILTER_VALIDATE to test whether the value was in email or numerical form. For the final input, the select list, I checked whether the value was in the $statuses array using in_array(), also making sure the value wasn't 'all', which was in the array but not a valid input. I also used html validation by including the attribute 'required' in the html input tag.

2. In your own words, why is it important to add validation to the forms?

- It is important to add validation to forms to ensure that the data received is in the proper format. If you are using the data after it is received and it isn't in the proper format, you might get an error. It is also important to help users, by giving them feedback about what they are doing wrong with their input so they know how to fix it. Validation also protects against malicious input, protecting the website and the program.

3. What improvements or changes would you make to the project either in additional features or improvement in the existing code?

- It would be best to retrieve and store the data in a database instead of an array, because now the data is only kept persistent within the session. Once the browser closes, the data resets. It might also be helpful to be able to sort the invoices, instead of only being able to filter by status. For example, sorting alphabetically by client name. It would also be helpful to be able to search for a specific invoice number or client name, especially if there is a very long list of invoices.