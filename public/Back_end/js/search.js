$(document).on('keyup','#search',function()
{
    var query = $(this).val();
    var _token = $('input[name="_token"]').val();
    $.ajax({
        url: '/search-ajax',
        method: 'POST',
        data: {query: query, _token:_token},
        success:function(data)
        {
            $('#search_autocomplete').fadeIn();
            $('#search_autocomplete').html(data);
        },

    });
});
// $(document).on('click','.li_search_ajax',function()
// {
//     $('#search').val($(this).text());
//     $('#search_autocomplete').fadeOut();
// });
$(document).on('mouseover','.li_search_ajax',function()
{
    $(this).css("background-color", "#0066ff");
    $(this).css("color", "white");

});
$(document).on('mouseout','.li_search_ajax',function()
{
    $(this).css("background-color", "white");
    $(this).css("color", "black");

});
