/* cartup cardown */
cartsliderdata = {};
cartsliderdata.isup = false;
cartsliderdata.userwording = false;
cartsliderdata.timer = null;

function cartup() {

    cartsliderdata.userwording = false;
    cartsliderdata.isup = true;
    $(".cartslider").css({
        "height": "80vh"
    });

    $(".cartslider_dim").fadeIn(200);

    $(".cartslider_smallview").css({ 'display': 'none' });
    setTimeout(function() {


        $(".cartslider_bigview").css({ 'display': 'inline' });

    }, 300);




}

function cartdown(speed = 100) {
    cartsliderdata.userwording = false;
    cartsliderdata.isup = false;

    $(".cartslider").css({
        "height": "9vh"
    })

    $(".cartslider_dim").css({ 'display': 'none' });

    $(".cartslider_bigview").css({ 'display': 'none' });
    setTimeout(function() {
        $(".cartslider_smallview").css({ 'display': 'flex' });




    }, 300);

}
/**/