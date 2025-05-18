document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const filterCategory = document.getElementById("filterCategory");
    const departmentContainer = document.getElementById("departmentContainer");

    // Fetch and render departments
    function fetchDepartments(category = "all", search = "") {
        const url = `http://localhost:8000/backend/models/searchFilter.php?category=${category}&search=${search}`;
        fetch(url)
            .then((response) => response.json())
            .then((departments) => {
                renderDepartments(departments);
            })
            .catch((error) => {
                console.error("Error fetching departments:", error);
                departmentContainer.innerHTML = "<p>Error loading departments. Please try again later.</p>";
            });
    }

    // Render departments dynamically
    function renderDepartments(departments) {
        departmentContainer.innerHTML = ""; // Clear existing content

        if (departments.length === 0) {
            departmentContainer.innerHTML = "<p>No departments found.</p>";
            return;
        }

        departments.forEach((department) => {
            const card = document.createElement("div");
            card.className = "card p-4 rounded-md shadow";

            // Add image
            const img = document.createElement("img");
            img.src = department.image_url || "https://placehold.co/300x200"; // Placeholder if no image
            img.alt = department.name || "Department Image";
            img.className = "w-full h-40 object-cover rounded-md mb-4";
            card.appendChild(img);

            // Add department name
            const title = document.createElement("h3");
            title.className = "font-bold";
            title.textContent = department.name || "Unknown Department";
            card.appendChild(title);

            // Add description
            const description = document.createElement("p");
            description.className = "text-sm text-gray-300";
            description.textContent = department.description || "No description available.";
            card.appendChild(description);

            // Add button
            const button = document.createElement("button");
            button.className = "mt-2 btn-secondary px-3 py-1 rounded";
            button.textContent = "View Details";
            button.addEventListener("click", () => {
                alert(`Viewing details for ${department.name}`);
            });
            card.appendChild(button);

            // Append card to container
            departmentContainer.appendChild(card);
        });
    }

    // Event listeners for search and filter
    searchInput.addEventListener("input", () => {
        const search = searchInput.value.trim();
        const category = filterCategory.value;
        fetchDepartments(category, search);
    });

    filterCategory.addEventListener("change", () => {
        const search = searchInput.value.trim();
        const category = filterCategory.value;
        fetchDepartments(category, search);
    });

    // Initial fetch
    fetchDepartments();
});