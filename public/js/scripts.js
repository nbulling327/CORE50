$(function() {
    $('#company').magicSuggest({
        placeholder: 'Select Company',
        allowFreeEntries: false,
        data: 'comp_register.php',
        valueField: 'company',
        displayField: 'company',
        noSuggestionText: 'Please select Other if Company Not Found',
        selectionPosition: 'bottom',
        selectionStacked: true,
        
        renderer: function(data){
            return '<div class="country">' +
                '<div class="name">' + data.company + '</div>' +
                '<div style="clear:both;"></div>' +
                '<div style="clear:both;"></div>' +
                '</div>';
            },

        });
    });    

$(document).ready(function () {
var nflTeams = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('company'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  identify: function(obj) { return obj.company; },
  prefetch: {
      url: "comp_register.php",
      cacheKey: "change here!"
  }
});

function nflTeamsWithDefaults(q, sync) {
  nflTeams.search(q, sync);
  }
$('#default-suggestions .typeahead').typeahead({
  minLength: 0,
  highlight: true
},
{
  name: 'nfl-teams',
  display: 'company',
  source: nflTeamsWithDefaults
});});

$(document).ready(function () {
$.getJSON('comp_register.php', function(data) {
    //data is the JSON string
});

var temp = {"id":"0","company":"Halliburton","domain":"halliburton.com","id":"1","company":"Hess","domain":"hess.com","id":"5","company":"made up company","domain":"company.com","id":"4","company":"Saudi Aramco","domain":"saudiaramco.com","id":"2","company":"WPX","domain":"wpx.com","id":"3","company":"XTO","domain":"xto.com","id":"6","company":"Other","domain":"noaddress.com"};

var $select = $('#com_select'); 
 $select.find('option').remove();  
 $.each(temp,function(key, value) 
{
    $select.append('<option value=' + key + '>' + value + '</option>');
});

    
});