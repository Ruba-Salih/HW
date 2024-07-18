/* FileName: FormValidation.php
   Author: Raghad
   CreationDate: 10/07/24
   Purpose: The assets/formValidation.js file handles client-side validation for different forms on the page.
*/

document.addEventListener('DOMContentLoaded', function() {
    // Add Task Form Validation
    const addTaskForm = document.getElementById('addTaskForm');
    if (addTaskForm) {
        addTaskForm.addEventListener('submit', function(event) {
            event.preventDefault();
            let errors = [];

            let title = document.getElementById('title').value.trim();
            let description = document.getElementById('description').value.trim();
            let dueDate = document.getElementById('due_date').value;
            let category = document.getElementById('category').value.trim();

            if (title === '') errors.push('Title is required.');
            if (description === '') errors.push('Description is required.');
            if (!isValidDate(dueDate)) errors.push('Due Date must be a valid date.');
            if (category === '') errors.push('Category is required.');

            if (errors.length > 0) {
                alert('Errors:\n' + errors.join('\n'));
            } else {
                this.submit();
            }
        });
    }

    // Login Form Validation
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            event.preventDefault();
            let errors = [];

            let username = document.getElementById('username').value.trim();
            let password = document.getElementById('password').value.trim();

            if (username === '') errors.push('Username is required.');
            if (password === '') errors.push('Password is required.');

            if (errors.length > 0) {
                alert('Errors:\n' + errors.join('\n'));
            } else {
                this.submit();
            }
        });
    }

    // Register Form Validation
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', function(event) {
            event.preventDefault();
            let errors = [];

            let username = document.getElementById('username').value.trim();
            let password = document.getElementById('password').value.trim();

            if (username === '') errors.push('Username is required.');
            if (password === '') errors.push('Password is required.');
            if (password.length < 6) errors.push('Password must be at least 6 characters long.');

            if (errors.length > 0) {
                alert('Errors:\n' + errors.join('\n'));
            } else {
                this.submit();
            }
        });
    }

    // Function to validate date format (YYYY-MM-DD)
    function isValidDate(dateString) {
        let regex = /^\d{4}-\d{2}-\d{2}$/;
        if (!dateString.match(regex)) return false;

        let date = new Date(dateString);
        let timestamp = date.getTime();

        if (typeof timestamp !== 'number' || Number.isNaN(timestamp)) return false;

        return dateString === date.toISOString().split('T')[0];
    }
});