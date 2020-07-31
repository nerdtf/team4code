To install the application you need:
- Download the project from the repository;
- Install Laravel (full tutorial here -> https://laravel.com/docs/7.x/installation);
- Set up your own database named "posts";
- Configure .env file;
- Register migrations and seeds (command: php artisan migrate --seed, also described in the documentation) Done!

The project has a main page, where the <nav> element is located at the top of the page, which stores in itself, a button to return to the main page, a link to contacts             (the page is not available if the user is not logged in). There are "Register" button and the "Login" button.
The registration button creates a new user and assigns the jwt token to him, and writes his data to the table.
The 'Login' button has an email and password input field. If the user is successfully logged in, their name will be displayed at the top of the page. Due entering, there           is a check for fields  email and password = admin / admin if it's true, the user will be transferred to the settings page for the name, password and email of the                   administrator. Next, the user is transferred to a page with a table of users, where he can create new users, edit and delete them. All these manipulations happen without           reloading the page.
