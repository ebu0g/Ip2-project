document.addEventListener("DOMContentLoaded", function () {
    function fetchDepartmentData() {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'http://localhost:8000/backend/controllers/about.php', true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                try {
                    const about = JSON.parse(xhr.responseText); // Parse the JSON response
                    console.log('Backend Response:', about); // Debugging log
                    renderDepartmentData(about); // Render the department count
                } catch (error) {
                    console.error('Error parsing JSON:', error);
                    document.querySelector("#departmentCount").textContent = "Error";
                }
            } else {
                console.error('Error fetching department data:', xhr.statusText);
                document.querySelector("#departmentCount").textContent = "Error";
            }
        };

        xhr.onerror = function () {
            console.error('Network error occurred.');
            document.querySelector("#departmentCount").textContent = "Error";
        };

        xhr.send();
    }

    function renderDepartmentData(about) {
        const departmentCountElement = document.querySelector("#departmentCount");

        // Check if department_number exists in the response
        if (about && about.department_number !== undefined) {
            console.log('Rendering department number:', about.department_number); // Debugging log
            // Dynamically update the department number
            departmentCountElement.textContent = `${about.department_number}`;
        } else {
            console.error('department_number is undefined in the response');
            departmentCountElement.textContent = "Unavailable";
        }
    }

    // Fetch department data on page load
    fetchDepartmentData();
});