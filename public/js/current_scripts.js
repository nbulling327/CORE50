//function to populate well register with past well names so that it can prefetch
$(document).ready(function () {
    var wellnames = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        identify: function(obj) { return obj.name; },
        prefetch: {
            url: "job_register.php",
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
            url: "job_registers.php",
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
        $("#job_date").removeAttr("hidden");
        var custom = $("#comp_choice").val();
        var parameters ={customer: custom};
        $.getJSON("search.php", parameters)
        .success(function(data, textStatus, jqXHR)
        {
          document.getElementById("test").options.length = 0;
          var obj=document.getElementById("test"); 
          for (var i = 0; i < data.length; i++)     {                
                opt = document.createElement("option");
                opt.value = data[i].id;
                opt.text=data[i].combo;
                obj.appendChild(opt);
            }
        });
    });
});

$(document).ready(function () {
                $('#datetimepicker1').datetimepicker({
                    format: 'MM/DD/YYYY'
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