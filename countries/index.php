<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>All Around the World</title>
	<link rel="stylesheet" href="style.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
</head>

<body>
<header>
		<h1>All Around the World</h1>
    <div><input type="text" id="search-input" placeholder="Search...">
    <button id="search-button">Search</button></div>
</header> 
  <div class="container">
    <table id="countries-table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Region</th>
          <th>Flag</th>
          <th>Capital</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
<script>
  $(document).ready(function() {
    // Make AJAX request to API endpoint and populate table
    $.ajax({
    url: 'https://restcountries.com/v3.1/all',
    dataType: 'json',
    success: function(data) {
      populateTable(data);
    },
    error: function(error) {
      console.error(error);
    }
    });
    // Add event listener for search button click
    $('#search-button').on('click', function() {
    searchTable();
    });
    // Add event listener for search input keyup
    $('#search-input').on('keyup', function() {
    searchTable();
    });
  });

  function populateTable(data) {
    // Loop through response data and populate table
    $.each(data, function(i, country) {
      $('#countries-table tbody').append(`
      <tr>
        <td>${country.name.common}</td>
        <td>${country.region}</td>
        <td><img src="${country.flags.svg}" width="50"></td>
        <td>${country.capital && country.capital[0]}</td>
      </tr>
      `);
    });
  }

  function searchTable() {
    var searchTerm = $('#search-input').val().toLowerCase();
    $('#countries-table tbody tr').each(function() {
    // Check if the row contains the search term in the name or capital column
    var name = $(this).find('td:eq(0)').text().toLowerCase();
    var capital = $(this).find('td:eq(3)').text().toLowerCase();
    if (name.includes(searchTerm) || capital.includes(searchTerm)) {
      $(this).show();
    } else {
      $(this).hide();
    }
    });
  };

    // Make AJAX request to API endpoint
    $.ajax({
      url: 'https://restcountries.com/v3.1/all',
      dataType: 'json',
      success: function(data) {
        // Loop through response data and populate table
        $.each(data, function(i, country) {
          $('#countries-table tbody').append(`
            <tr>
              <td>${country.name.common}</td>
              <td>${country.region}</td>
              <td><img src="${country.flags.svg}" width="50"></td>
              <td>${country.capital}</td>
            </tr>
          `);
        });
      },
      error: function(error) {
        console.error(error);
      }
    })

    $(document).ready(function() {
    $('#countries-table').DataTable();
    });
</script>
</body>

</html>
