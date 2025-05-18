document.addEventListener('DOMContentLoaded', async () => {
    const totalUsersElement = document.getElementById('totalUsers'); // Select the <p> tag by its ID

    try {
        // Fetch data from the backend
        const response = await fetch('http://localhost:8000/backend/controllers/users_dash.php');

        if (!response.ok) {
            throw new Error(`Network response was not ok. Status: ${response.status}`);
        }

        const data = await response.json();

        // Validate the response format
        if (typeof data.count !== 'number') {
            throw new Error('Invalid response format. Expected "count" as a number.');
        }

        // Update the <p> tag with the total users count
        totalUsersElement.textContent = `${data.count}`;
    } catch (error) {
        console.error('Error fetching total users:', error);
        totalUsersElement.textContent = 'Error loading data';
    }
});