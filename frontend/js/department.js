// Function to fetch department data using AJAX
function fetchDepartments() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost:8000/backend/controllers/list.php', true);

    // Set up the callback for when the request completes
    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                // Parse the JSON response
                const departments = JSON.parse(xhr.responseText);

                // Render the departments
                renderDepartments(departments);
            } catch (error) {
                console.error('Error parsing JSON:', error);
                document.getElementById('department-container').innerHTML = '<p>Error loading departments. Please try again later.</p>';
            }
        } else {
            console.error('Error fetching departments:', xhr.statusText);
            document.getElementById('department-container').innerHTML = '<p>Error loading departments. Please try again later.</p>';
        }
    };

    // Handle network errors
    xhr.onerror = function () {
        console.error('Network error occurred.');
        document.getElementById('department-container').innerHTML = '<p>Error loading departments. Please check your connection.</p>';
    };

    // Send the request
    xhr.send();
}

// Function to render department data
function renderDepartments(departments) {
    const container = document.getElementById('department-container');
    container.innerHTML = ''; // Clear existing content

    departments.forEach(department => {
        const departmentHTML = `
            <article class="department">
                <div class="department__image">
                    <img src="./${department.image_url}" alt="${department.name}">
                </div>
                <div class="department__info">
                    <h4>${department.name}</h4>
                    <p>${department.description}</p>
                    <p><strong>Highlights</strong>: ${department.highlights}</p>
                    <a href="department-details.php?id=${department.id}" class="btn btn-primary">Learn More</a>
                </div>
            </article>
        `;
        container.innerHTML += departmentHTML;
    });
}

// Fetch departments when the page loads
window.onload = fetchDepartments;