function about() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost:8000/backend/controllers/about.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                const about = JSON.parse(xhr.responseText); // Parse the JSON response
                console.log('Backend Response:', about); // Log the response for debugging
                renderAboutPage(about); // Render the department count
            } catch (error) {
                console.error('Error parsing JSON:', error);
                document.querySelector(".department_number").innerHTML = "<h3>Error parsing JSON</h3>";
            }
        } else {
            console.error('Error fetching about data:', xhr.statusText);
            document.querySelector(".department_number").innerHTML = "<h3>Error fetching about data</h3>";
        }
    };

    xhr.onerror = function () {
        console.error('Network error occurred.');
        document.querySelector(".department_number").innerHTML = "<h3>Network error occurred.</h3>";
    };

    xhr.send();
}

function renderAboutPage(about) {
    const departmentNumberElement = document.querySelector(".department_number");

    // Check if department_number exists in the response
    if (about && about.department_number !== undefined) {
        console.log('Rendering department number:', about.department_number); // Debugging log
        // Dynamically update the department number
        departmentNumberElement.innerHTML = `${about.department_number}+`;
    } else {
        console.error('department_number is undefined in the response');
        departmentNumberElement.innerHTML = "<h3>Data unavailable</h3>";
    }
}