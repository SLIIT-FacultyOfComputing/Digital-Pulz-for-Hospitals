$(document).ready(function(){
    // show popup when you click on the link
    $('.show-popup').click(function(event){
        event.preventDefault(); // disable normal link function so that it doesn't refresh the page
        var docHeight = $(document).height(); //grab the height of the page
        var scrollTop = $(window).scrollTop(); //grab the px value from the top of the page to where you're scrolling
        $('.overlay-bg').show().css({'height' : docHeight}); //display your popup and set height to the page height
        $('.overlay-content').css({'top': scrollTop+20+'px'}); //set the content 20px from the window top
    });
 
    // hide popup when user clicks on close button
    $('.close-btn').click(function(){
        $('.overlay-bg').hide(); // hide the overlay
    });
 
    // hides the popup if user clicks anywhere outside the container
    $('.overlay-bg').click(function(){
        $('.overlay-bg').hide();
    })
    // prevents the overlay from closing if user clicks inside the popup overlay
    $('.overlay-content').click(function(){
        return false;
    });
 
});