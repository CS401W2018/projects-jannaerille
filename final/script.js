document.getElementById('myForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);
    const data = {};
    for (let [key, value] of formData) {
        data[key] = value;
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

    // Check if first name is present
    if (!data.firstName || data.firstName.trim() === '') {
        errors.push('Please enter your first name');
    }

    // Check if last name is present
    if (!data.lastName || data.lastName.trim() === '') {
        errors.push('Please enter your last name');
    }

    // Check if email is present and valid
    if (!data.email || !/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(data.email)) {
        errors.push('Please enter a valid email address');
    }

    // Check if age is present and is a number
    if (!data.age || isNaN(data.age)) {
        errors.push('Please enter a valid age');
    }

    return errors;
}

function makeAjaxCall(data) {
    const xhr = new XMLHttpRequest();
    // Use GET for GitHub hosting or other static servers
    xhr.open('GET', 'formprocessing.html?' + new URLSearchParams(data).toString(), true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('message').innerHTML = 'Form submitted successfully!';
            document.getElementById('message').style.color = 'green';
            document.getElementById('myForm').reset();
        } else {
            document.getElementById('message').innerHTML = 'Error: ' + xhr.statusText;
            document.getElementById('message').style.color = 'red';
        }
    };
    xhr.send();
}