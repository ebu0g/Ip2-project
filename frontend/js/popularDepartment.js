document.addEventListener("DOMContentLoaded", function () {
    // Function to fetch popular departments
    function fetchPopularDepartments() {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "http://localhost:8000/backend/controllers/popularDepartmentRetrieve.php", true);

        xhr.onload = function () {
            if (xhr.status === 200) {
                try {
                    // Parse the JSON response
                    const popularDepartments = JSON.parse(xhr.responseText);

                    // Render the popular departments
                    renderPopularDepartments(popularDepartments);
                } catch (error) {
                    console.error("Error parsing JSON:", error);
                    document.getElementById("popular-departments").innerHTML = "<p>Error loading popular departments. Please try again later.</p>";
                }
            } else {
                console.error("Error fetching popular departments:", xhr.statusText);
                document.getElementById("popular-departments").innerHTML = "<p>Error loading popular departments. Please try again later.</p>";
            }
        };

        xhr.onerror = function () {
            console.error("Network error occurred.");
            document.getElementById("popular-departments").innerHTML = "<p>Error loading popular departments. Please check your connection.</p>";
        };

        xhr.send();
    }

    // Function to render popular departments
    function renderPopularDepartments(departments) {
        const container = document.getElementById("popular-departments");
        container.innerHTML = ""; // Clear any existing content

        // Loop through the departments and create HTML for each
        departments.forEach(department => {
            const departmentElement = document.createElement("div");
            departmentElement.classList.add("department");

            departmentElement.innerHTML = `
                <div class="department__image">
                    <img src="${department.image_url}" alt="${department.name}">
                </div>
                <div class="department__info">
                    <h4>${department.name}</h4>
                    <p>${department.description}</p>
                </div>
            `;

            container.appendChild(departmentElement);
        });
    }

    // Fetch popular departments when the page loads
    fetchPopularDepartments();
});