$(document).ready(function() {
  // Initialize table
  var table = $('#countries-table').DataTable({
    "pageLength": 10,
    "deferRender": true,
    "order": [[0, "desc"]],
    "columns": [
      { "data": "name"}, 
      { "data": "region" }, 
      { "data": "flag", "orderable": false }, 
      { "data": "capital" },
      { "data": null, "orderable": false, "render": function(data, type, row) {
          return '<input type="checkbox" class="favorite-checkbox" data-name="' + row.name.common + '">';
        }
      }
    ],
    "sorting": true,
  });

  // Handle row selection
  var selectedCountries = {};
  $('#countries-table tbody').on('click', '.favorite-checkbox', function() {
    var countryName = $(this).data('name');
    if ($(this).is(':checked')) {
      selectedCountries[countryName] = table.row($(this).closest('tr')).data();
    } else {
      delete selectedCountries[countryName];
    }
    localStorage.setItem('selectedCountries', JSON.stringify(selectedCountries));
  });

  // Populate table with data
  function populateTable(data) {
    // Loop through response data and populate table
    $.each(data, function(i, country) {
      var favoriteChecked = '';
      if (selectedCountries[country.name.common]) {
        favoriteChecked = 'checked';
      }
      $('#countries-table tbody').append(`
        <tr>
          <td>${country.name.common}</td>
          <td>${country.region}</td>
          <td><img src="${country.flags.svg}" width="50"></td>
          <td>${country.capital && country.capital[0]}</td>
          <td><input type="checkbox" class="favorite-checkbox" data-name="${country.name.common}" ${favoriteChecked}></td>
        </tr>
      `);
    });
  }

  // Load selected countries from localStorage
  var storedSelectedCountries = JSON.parse(localStorage.getItem('selectedCountries'));
  if (storedSelectedCountries) {
    selectedCountries = storedSelectedCountries;
  }

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
});
