$(document).on('mouseover','.menu_item',function()
{
    $(this).find('ul').css('display','block').css('color','black')
    .css('top','auto').css('left','50px');
    
});

$(document).on('mouseleave','.panel-title',function()
{
    $(this).find('ul').css('display','none')

});

