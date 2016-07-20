$(document).ready(function() {
  $('.selectpicker').selectpicker({
    style: 'btn-default',
    dropupauto: 'false',
    size: 4
  });
});


$(document).ready(function () {
    var wellnames = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        identify: function(obj) { return obj.name; },
        prefetch: {
            url: "well_register.php",
            cache:"false",
        }
    });
// passing in `null` for the `options` arguments will result in the default
// options being used
    $('#prefetch_name .typeahead').typeahead(null,{
        hint:true,
        minLength: 1,
        display:'name',
    source: wellnames
    });
});  

$(document).ready(function () {
    var wellnumbers = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('number'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        identify: function(obj) { return obj.number; },
        prefetch: {
            url: "well_registers.php",
            cache:"false",
        }
    });
// passing in `null` for the `options` arguments will result in the default
// options being used
    $('#prefetch_number .typeahead').typeahead(null,{
        hint:true,
        minLength: 1,
        display:'number',
    source: wellnumbers
    });
});

$(document).ready(function () { 
    $("#post_well_customer").change(function(event){
        $("#post_well_choice").removeAttr("hidden");
    });
});

/**
 * Try to implement query for customer name well choices
 * 
*$("#q").typeahead({
*        autoselect: true,
*        highlight: true,
*        minLength: 1
*    },
*    {
*        source: search,
*        templates: {
*            empty: "There are no places found yet",
*            suggestion: _.template("<p><%- place_name %>, <%- admin_name1 %>, <%- postal_code %></p>")
*        }
*    });
*
*
*function search(query, cb)
*{
*    // get places matching query (asynchronously)
*    var parameters = {
*        geo: query
*    };
*    $.getJSON("search.php", parameters)
*    .done(function(data, textStatus, jqXHR) {
*
*        // call typeahead's callback with search results (i.e., places)
*        cb(data);
*    })
*    .fail(function(jqXHR, textStatus, errorThrown) {
*
*        // log error to browser's console
*        console.log(errorThrown.toString());
*    });
*}   
*/ 
