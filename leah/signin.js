document.getElementById('signinForm').addEventListener('submit', async (event) => {
    event.preventDefault(); // Prevent default form submission

    // Get form data
    const fname = document.getElementById('fname').value;
    const lname = document.getElementById('lname').value;
    const uname = document.getElementById('uname').value;
    const email = document.getElementById('email').value;

    try {
        // Send data to PHP backend
        const response = await fetch('signup.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({ fname, lname, uname, email })
        });

        const result = await response.json();

        if (result.status === 'success') {
            alert(result.message);
            // Redirect or show success message
            window.location.href = 'login.php'; // Redirect to login page
        } else {
            alert(result.message);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    }
});
