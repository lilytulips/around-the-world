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
           <th class="sortable">Name</th>
          <th class="sortable">Region</th>
          <th>Flag</th>
          <th class="sortable">Capital</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
<script>
  $(document).ready(function() {
    //Initialize table
    $('#countries-table').DataTable({   
      "pageLength": 10,
      "deferRender": true,
      "order": [[0, "desc"]],
      "columns": [
        { "data": "name"}, 
        { "data": "region" }, 
        { "data": "flag", "orderable": false }, 
        { "data": "capital" }
    ],
      sorting: true,
    });
    $('.sortable').on('click', function() {
        var column = table.column($(this).index());
        var direction = column.order() == 'asc' ? 'desc' : 'asc';
        column.order(direction).draw();
    });
    
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
    var name = country.name.common;
    var region = country.region;
    var flag = country.flags.svg;
    var capital = country.capital && country.capital[0];

    // Create a new row with highlighted search terms
    var newRow = $('<tr>');
    var nameCell = $('<td>').html(name);
    var regionCell = $('<td>').html(region);
    var flagCell = $('<td>').html(`<img src="${flag}" width="50">`);
    var capitalCell = $('<td>').html(capital);
    newRow.append(nameCell);
    newRow.append(regionCell);
    newRow.append(flagCell);
    newRow.append(capitalCell);
    $('#countries-table tbody').append(newRow);
  });
  }

  function searchTable() {
  var searchTerm = $('#search-input').val().trim().toLowerCase();
  $('#countries-table tbody tr').each(function() {
    // Check if the row contains the search term in the name or capital column
    var name = $(this).find('td:eq(0)').text().toLowerCase();
    var capital = $(this).find('td:eq(3)').text().toLowerCase();
    var match = name.indexOf(searchTerm) > -1 || capital.indexOf(searchTerm) > -1;
    if (match) {
      $(this).find('td').each(function() {
        var text = $(this).text();
        if (text.toLowerCase().indexOf(searchTerm) > -1) {
          var html = text.replace(new RegExp(searchTerm, 'gi'), '<span class="highlighted">$&</span>');
          $(this).html(html);
        }
      });
      $(this).show();
        } else {
      $(this).find('td').each(function() {
        $(this).html($(this).text());
      });
      $(this).hide();
    }
    });
  }

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
</script>
</body>
</html>
<footer>Built by <b>Aisyah Raihana 2023</b> for <b>Jazari Robot</b></footer>
