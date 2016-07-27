
//function to populate well register with past well names so that it can prefetch
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

//function to populate well registers with past well numbers so that it can prefetch
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
        $("#scrollable-dropdown-menu").removeAttr("hidden");
        var custom = $("#comp_choice").val();
        var parameters ={customer: custom};
        $.getJSON("search.php", parameters)
        .done(function(data, textStatus, jqXHR)
        {
          var obj=document.getElementById("test"); 
          for (var i = 0; i < data.length; i++)     {                
                opt = document.createElement("option");
                opt.value = data[i].combo;
                opt.text=data[i].combo;
                obj.appendChild(opt);
            }
        });
    });
});

$(document).ready(function () {
    $.getJSON("single_job_data.php", function(json){
        var plotarea=$("#placeholder");
        var data = [json.data];
        $.plot(plotarea,data);
    });
});    
    


//function to active select picker for Job District, etc.
$(document).ready(function() {
  $('.selectpicker').selectpicker({
    style: 'btn-default',
    dropupauto: 'false',
    size: 4
  });
});
