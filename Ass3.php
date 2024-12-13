<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UOB Student Nationality Data</title>
  <!-- Link to Pico CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/picocss@1.6.0/dist/pico.min.css">
  <!-- Table CSS -->
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    main{
      margin: 20px auto;
      max-width: 1200px;
    }

    .table-container {
      overflow-x: auto;
      margin-top: 20px;
      border-radius: 8px;
      border: 1px solid #e0e0e0;
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    thead {
      background-color: #f9f9f9;
    }

    th, td {
      text-align: left;
      padding: 12px 16px;
      font-size: 14px;
      border-bottom: 1px solid #e0e0e0;
    }

    tr:nth-child(even) {
      background-color: #f8f8f8;
    }
  </style>
</head>
<body>
  <main>
    <div class="table-container">
    <!-- Table create -->
    <table>
    <thead>
      <tr>
        <th>Year</th>
        <th>Semester</th>
        <th>The Programs</th>
        <th>Nationality</th>
        <th>Colleges</th>
        <th>Number of Students</th>
      </tr>
    </thead>
    <tbody id="table-body">
    <script>
      // fetch data from the Bahrain Open Data Portal API
      const url = 'https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100';

      fetch(url)
      .then(response => {
        if (!response.ok) {
        throw new Error('Error: Unable to fetch data from the API.');}
        return response.json();})
      .then(data => {
        const results = data.results || [];
        const tableBody = document.getElementById('table-body');

        if (results.length > 0) {
          // To clear any existing row
          tableBody.innerHTML = '';

          // To generate the rows dynamically based on the data
          results.forEach(record => {
            const row = document.createElement('tr');
          //Print the data in the table
            row.innerHTML = `
              <td>${record.year || 'N/A'}</td>
              <td>${record.semester || 'N/A'}</td>
              <td>${record.the_programs || 'N/A'}</td>
              <td>${record.nationality || 'N/A'}</td>
              <td>${record.colleges || 'N/A'}</td>
              <td>${record.number_of_students || 'N/A'}</td>`;

            tableBody.appendChild(row);});
        } else {
          // print this if there are no results, show "No data available"
          tableBody.innerHTML = `
          <tr>
            <td colspan="6" style="text-align: center;">No data available</td>
          </tr>
          `;}})
      .catch(error => {
      console.error('Error fetching data:', error);});
    </script>
    </tbody>
    </table>
    </div>
  </main>
</body>
</html>

