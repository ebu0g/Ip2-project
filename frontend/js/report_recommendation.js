document.addEventListener("DOMContentLoaded", async function () {
    const chartContainer = document.getElementById("recommendedChart").getContext("2d");

    // Fetch recommendations data from the backend
    async function fetchRecommendations() {
        try {
            const response = await fetch("http://localhost:8000/backend/controllers/recommendation.php");
            if (!response.ok) {
                throw new Error(`Failed to fetch recommendations. Status: ${response.status}`);
            }
            const data = await response.json();

            // Process the data with AI scoring
            const scoredData = processWithAIModel(data);

            // Render the chart with the scored data
            renderRecommendationChart(scoredData);
        } catch (error) {
            console.error("Error fetching recommendations:", error);
        }
    }

    // AI Agent Model to calculate scores
    function processWithAIModel(data) {
        return data.map((item) => {
            // Example scoring logic: Assign a score based on skills and international demand
            const skillScore = item.skill.split(",").length * 10; // Number of skills * 10
            const demandScore = item.reason.length; // Length of the reason as a proxy for demand
            const internationalScore = Math.random() * 50; // Simulated international score (replace with real AI logic)

            // Final score is a weighted sum of the above factors
            const finalScore = skillScore + demandScore + internationalScore;

            return {
                name: item.name,
                score: Math.round(finalScore), // Round the score for simplicity
                color: generateRandomColor(), // Assign a random color for the chart
            };
        });
    }

    // Generate a random color for the chart bars
    function generateRandomColor() {
        const letters = "0123456789ABCDEF";
        let color = "#";
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    // Render the bar chart
    function renderRecommendationChart(data) {
        const departmentNames = data.map((item) => item.name);
        const departmentScores = data.map((item) => item.score);
        const departmentColors = data.map((item) => item.color);

        new Chart(chartContainer, {
            type: "bar",
            data: {
                labels: departmentNames, // Department names as labels
                datasets: [
                    {
                        label: "Department Scores",
                        data: departmentScores, // Scores as data
                        backgroundColor: departmentColors, // Colors for each bar
                        borderColor: "#ffffff",
                        borderWidth: 1,
                    },
                ],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: "top",
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                const index = context.dataIndex;
                                return `${data[index].name}: ${data[index].score}`;
                            },
                        },
                    },
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: "Departments",
                        },
                    },
                    y: {
                        title: {
                            display: true,
                            text: "Scores",
                        },
                        beginAtZero: true,
                    },
                },
            },
        });
    }

    // Fetch and render the chart
    fetchRecommendations();
});