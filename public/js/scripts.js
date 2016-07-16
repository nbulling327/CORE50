$(function() {
    $('#ms-filter').magicSuggest({
        placeholder: 'Select...',
        allowFreeEntries: false,
        data: [{
            name: 'Anadarko',
               }, {
           name: 'Saudi Aramco'
        }],
        selectionPosition: 'bottom',
        selectionStacked: true,
        selectionRenderer: function(data){
            return data.name + ' (<b>' + data.nb + '</b>)';
        }
    });
});