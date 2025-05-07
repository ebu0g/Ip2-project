document.addEventListener("DOMContentLoaded", function () {
    fetchCategories(); // Fetch categories when the DOM is fully loaded
});

function fetchCategories() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost:8000/backend/controllers/categories.php', true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                const categories = JSON.parse(xhr.responseText); // Parse the JSON response
                // Render the categories
                renderCategories(categories);
            } catch (error) {
                console.error('Error parsing JSON:', error);
                document.querySelector(".categories__right").innerHTML = "<p>Error loading categories. Please try again later.</p>";
            }
        } else {
            console.error('Error fetching categories:', xhr.statusText);
            document.querySelector(".categories__right").innerHTML = "<p>Error loading categories. Please try again later.</p>";
        }
    };

    xhr.onerror = function () {
        console.error("Network error occurred.");
        document.querySelector(".categories__right").innerHTML = "<p>Error loading categories. Please check your connection.</p>";
    };

    xhr.send();
}

function renderCategories(categories) {
    const container = document.querySelector(".categories__right"); // Select the container
    container.innerHTML = ""; // Clear any existing content

    // Loop through the categories and create HTML for each
    categories.forEach(category => {
        const categoryElement = document.createElement("article");
        categoryElement.classList.add("category");

        categoryElement.innerHTML = `
            <span class="category__icon"><i class="${category.icon}"></i></span>
            <h5>${category.name}</h5>
            <p>${category.supplementaryinfo}</p>
        `;

        container.appendChild(categoryElement);
    });
}