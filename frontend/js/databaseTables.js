const databaseLink = document.getElementById('databaseLink');
    const databaseTables = document.getElementById('databaseTables');
    let isVisible = false; // Track visibility of the table names

    databaseLink.addEventListener('click', (e) => {
      e.preventDefault();

      if (isVisible) {
        // Hide the table names if already visible
        databaseTables.classList.add('hidden');
        databaseTables.innerHTML = ''; // Clear the content
        isVisible = false;
      } else {
        // Fetch table names from the backend
        fetch('http://localhost:8000/backend/controllers/dashbord.php')
          .then((response) => {
            if (!response.ok) {
              throw new Error('Network response was not ok');
            }
            return response.json();
          })
          .then((tables) => {
            databaseTables.innerHTML = ''; // Clear previous content
            tables.forEach((table) => {
              const div = document.createElement('div');
              div.className = 'table-box';
              div.textContent = table;
              databaseTables.appendChild(div);
            });
            databaseTables.classList.remove('hidden'); // Show the section
            isVisible = true;
          })
          .catch((error) => {
            console.error('Error fetching table names:', error);
            databaseTables.innerHTML = '<p class="text-red-500">Error loading table names. Please try again later.</p>';
            databaseTables.classList.remove('hidden');
            isVisible = true;
          });
      }
    });