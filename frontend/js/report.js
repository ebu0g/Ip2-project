// Fetch data for the Department Distribution Chart
  async function fetchDepartmentDistribution() {
    try {
      const response = await fetch('http://localhost:8000/backend/controllers/report.php');
      if (!response.ok) {
        throw new Error('Failed to fetch department distribution data');
      }
      const data = await response.json();

      // Extract labels and data from the response
      const labels = data.map(item => item.name); // Assuming 'name' is the department name
      const values = data.map(item => item.percent); // Assuming 'percent' is the percentage
      const colors = data.map(item => item.colors); // Assuming 'colors' is the color for each department

      // Render the chart
      renderDepartmentChart(labels, values, colors);
    } catch (error) {
      console.error('Error fetching department distribution data:', error);
    }
  }

  // Render the Department Distribution Chart
  function renderDepartmentChart(labels, values, colors) {
    const ctx1 = document.getElementById('departmentChart').getContext('2d');
    new Chart(ctx1, {
      type: 'doughnut',
      data: {
        labels: labels,
        datasets: [{
          data: values,
          backgroundColor: colors,
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'top',
          },
        },
      },
    });
  }

  // Fetch and render the chart on page load
  fetchDepartmentDistribution();

    