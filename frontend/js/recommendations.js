document.addEventListener("DOMContentLoaded", function () {
    function fetchRecommendations() {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "http://localhost:8000/backend/controllers/recommendation.php", true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                try {
                    const recommendations = JSON.parse(xhr.responseText);
                    renderRecommendations(recommendations);
                } catch (error) {
                    console.error("Error parsing JSON:", error);
                    document.querySelector("#departmentContainer").innerHTML = "<p>Error loading recommendations. Please try again later.</p>";
                }
            } else {
                console.error("Error fetching recommendations:", xhr.statusText);
                document.querySelector("#departmentContainer").innerHTML = "<p>Error loading recommendations. Please try again later.</p>";
            }
        };

        xhr.onerror = function () {
            console.error("Network error occurred.");
            document.querySelector("#departmentContainer").innerHTML = "<p>Error loading recommendations. Please check your connection.</p>";
        };
        xhr.send();
    }

    function renderRecommendations(recommendations) {
        const container = document.querySelector("#departmentContainer");
        container.innerHTML = ""; // Clear existing content

        recommendations.forEach((recommendation) => {
            const card = document.createElement("div");
            card.className = "card p-4 rounded-md shadow";

            // Add image
            const img = document.createElement("img");
            img.src = recommendation.department_image || "https://placehold.co/300x200"; // Use placeholder if no image URL
            img.alt = recommendation.name || "Department Image";
            img.className = "w-full h-40 object-cover rounded-md mb-4";
            card.appendChild(img);

            // Add department name
            const title = document.createElement("h3");
            title.className = "font-bold";
            title.textContent = recommendation.name || "Unknown Department";
            card.appendChild(title);

            // Add description
            const description = document.createElement("p");
            description.className = "text-sm text-gray-300";
            description.textContent = recommendation.reason || "No description available.";
            card.appendChild(description);

            // Add button
            const button = document.createElement("button");
            button.className = "mt-2 btn-secondary px-3 py-1 rounded";
            button.textContent = "View Details";
            button.addEventListener("click", () => {
                alert(`Viewing details for ${recommendation.name}`);
            });
            card.appendChild(button);

            // Append card to container
            container.appendChild(card);
        });
    }

    // Fetch recommendations on page load
    fetchRecommendations();
});