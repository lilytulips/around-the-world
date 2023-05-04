  $(document).ready(function() {
    //Initialize table
    var table = $('#countries-table').DataTable({   
    "deferRender": true,
    "pageLength": 10,
    "order": [[0, "desc"]],
    "columns": [
      
      { "data": "name"}, 
      { "data": "region" }, 
      { "data": "flag", "orderable": false }, 
      { "data": "capital" },
      { "data": "favorite", "orderable": false}
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
      populateTable(data)
    },
    error: function(error) {
      console.error(error);
    }
    });

    // Add event listener for favorite checkboxes
    $('#countries-table tbody').on('click', '.favorite-checkbox', function() {
    var tr = $(this).closest('tr');
    var row = table.row(tr);
    var country = row.data();
    country.favorite = !country.favorite;
    row.data(country).draw();
    
    // Save favorites to localStorage
    var favorites = [];
    $('#countries-table tbody tr').each(function() {
      var country = table.row(this).data();
      if (country.favorite) {
        favorites.push(country.name.common);
      }
    });
    localStorage.setItem('favorites', JSON.stringify(favorites));
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
  <td><input type="checkbox" class="favorite-checkbox"></td>
</tr>
      `);
    });
  }

  /// Make AJAX request to API endpoint and populate table
  $.ajax({
    url: 'https://restcountries.com/v3.1/all',
    dataType: 'json',
    success: function(data) {
      // Get favorites from localStorage
      var favorites = JSON.parse(localStorage.getItem('favorites')) || [];
      
      // Loop through response data and populate table
      $.each(data, function(i, country) {
        var isFavorite = favorites.includes(country.name.common);
        country.favorite = isFavorite;
        
        $('#countries-table tbody').append(`
          <tr>
            <td>${country.name.common}</td>
            <td>${country.region}</td>
            <td><img src="${country.flags.svg}" width="50"></td>
            <td>${country.capital && country.capital[0]}</td>
            <td><input type="checkbox" class="favorite-checkbox"${isFavorite ? ' checked' : ''}></td>
          </tr>
        `);
      });
      
      // Update table to show favorites
      table.draw();
    },
    error: function(error) {
      console.error(error);
    }
  });
