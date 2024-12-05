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

    // Navigate to form processing page with form data in URL
    window.location.href = 'formprocessing.html?' + new URLSearchParams(data).toString();
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