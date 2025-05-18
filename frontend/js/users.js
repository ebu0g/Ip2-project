document.addEventListener('DOMContentLoaded', async () => {
    const totalUsersElement = document.querySelector('.card p.text-2xl.font-semibold'); // Select the <p> tag for rendering

    try {
        // Fetch data from the backend
        const response = await fetch('http://localhost:8000/backend/controllers/users_dash.php');

        if (!response.ok) {
            throw new Error(`Network response was not ok. Status: ${response.status}`);
        }

        const data = await response.json();

        // Validate the response format
        if (typeof data.count !== 'number') {
            throw new Error('Invalid response format. Expected department_number as a number.');
        }

        // Update the <p> tag with the department number
        totalUsersElement.textContent = `${data.count}`;
    } catch (error) {
        console.error('Error fetching department number:', error);
        totalUsersElement.textContent = 'Error loading data';
    }
});