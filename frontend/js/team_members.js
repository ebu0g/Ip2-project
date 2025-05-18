document.addEventListener("DOMContentLoaded", () => {
    const teamContainer = document.querySelector(".team__container");
    const apiUrl = "http://localhost:8000/backend/controllers/team_memeber_controllers.php";

    // Fetch team members data from the backend
    fetch(apiUrl)
        .then(response => {
            if (!response.ok) {
                throw new Error("Failed to fetch team members data");
            }
            return response.json();
        })
        .then(data => {
            // Clear existing content in the container
            teamContainer.innerHTML = "";

            // Loop through the team members and generate HTML
            data.forEach(member => {
                const memberHTML = `
                    <article class="team__member">
                        <div class="team-member-image">
                            <img src="${member.image_url}" alt="${member.name}">
                        </div>
                        <div class="team__member-info">
                            <h4>${member.name}</h4>
                            <p>${member.role}</p>
                        </div>
                        <div class="team__member-socials">
                            <a href="${member.instagram_url}" target="_blank"><i class="uil uil-instagram"></i></a>
                            <a href="${member.twitter_url}" target="_blank"><i class="uil uil-twitter-alt"></i></a>
                            <a href="${member.linkedin_url}" target="_blank"><i class="uil uil-linkedin-alt"></i></a>
                        </div>
                    </article>
                `;
                teamContainer.innerHTML += memberHTML;
            });
        })
        .catch(error => {
            console.error("Error:", error);
            teamContainer.innerHTML = "<p>Error loading team members. Please try again later.</p>";
        });
});