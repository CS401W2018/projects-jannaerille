document.getElementById('movie-ticket-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);
    const data = {};
    for (let [key, value] of formData) {
        if (key === 'snack[]') {
            if (!data.snack) {
                data.snack = [];
            }
            data.snack.push(value);
        } else {
            data[key] = value;
        }
    }

    const errors = validateForm(data);
    if (errors.length > 0) {
        alert(errors.join('\n'));
        return;
    }

    console.log(data);

    makeAjaxCall(data);
});

function validateForm(data) {
    const errors = [];

    // Check if name is present
    if (!data.name || data.name.trim() === '') {
        errors.push('Please enter your full name');
    }

    // Check if email is present and valid
    if (!data.email ||!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(data.email)) {
        errors.push('Please enter a valid email address');
    }

    // Check if phone number is present and valid
    if (!data.phone ||!/^\d{3}-\d{3}-\d{4}$/.test(data.phone)) {
        errors.push('Please enter a valid phone number (123-456-7890)');
    }

    // Check if passwords match
    if (data.password!== data['password-verify']) {
        errors.push('Passwords do not match');
    }

    // Check if date is selected
    if (!data.date) {
        errors.push('Please select a date');
    }

    // Check if ticket type is selected
    if (!data['ticket-type']) {
        errors.push('Please select a ticket type');
    }

    // Check if movie is selected
    if (!data.movie) {
        errors.push('Please select a movie');
    }

    return errors;
}

function makeAjaxCall(data) {
    const xhr = new XMLHttpRequest();
    // Use GET for GitHub hosting or other static servers
    xhr.open('GET', 'submit.json', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            document.getElementById('submission-status').innerHTML = response.message;

            // Modify the form to indicate it has been submitted
            document.getElementById('movie-ticket-form').reset();
            document.getElementById('submission-status').style.color = 'green';
        } else {
            document.getElementById('submission-status').innerHTML = 'Error: ' + xhr.statusText;
            document.getElementById('submission-status').style.color = 'red';
        }
    };
    xhr.send();
}