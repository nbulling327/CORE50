
$(function() {
    $('#company').magicSuggest({
        
        placeholder: 'Select...',
        allowFreeEntries: false,
        data: 'comp_register.php',
        valueField: 'company',
        displayField: 'company',
        selectionPosition: 'bottom',
        selectionStacked: true,
    });
    console.log(company);
    });