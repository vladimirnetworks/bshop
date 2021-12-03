function openprod(vals) {








    setTimeout(function() {
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0;
    }, 30);


    var photgals = JSON.parse(vals.photos);

    var photoitems = [];
    console.log(photgals);
    for (var i = 0; i < photgals.length; i++) {
        photoitems.push('<div class="myitem"><img style="width:100%" src="/' + photgals[i].medium + '"  /></div>');
    }

    var mySwipe = new SwiperBox({
        items: photoitems
    });



    var cont = $('<div class="saving  rounded " style="background-color:white;direction:rtl"></div>');

    var photos = $('<div style="width:50vw;margin-right: auto;margin-left: auto;max-width:300px;"></div>');
    photos.append($(mySwipe.HTMLElement));


    var title = $('<div class="text-dark" style="font-size:120%;font-weight:bold">' + vals.title + '</div>');
    var price = $('<div class="pt-1 text-success" style="font-size:150%;font-weight:bold">' + farsi_price(vals.price) + ' تومان </div>');
    var caption = $('<ul style="text-align: right;font-size:90%">' + vals.licaption + '</ul>');


    cont.append(photos);
    cont.append(title);
    cont.append(price);
    cont.append(caption);




    var kharid = $('<button class="btn btn-danger btn-lg m-2">خرید</button>');

    kharid.click(function(e) {



        var fly = $('<div class="fly" style="position:fixed;bottom:-100%;left:-100%;background-color:white;z-index:99991"></div>');
        $('.fly').remove();
        var cloned_photos = photos.clone();

        cloned_photos.css({
            width: "100%"
        });

        var pattern = /jpg/;
        var flyingimage = "";
        for (var i = 0; i < photoitems.length; i++) {

            if (pattern.test(photoitems[i].innerHTML)) {
                flyingimage = photoitems[i].innerHTML;
                break;
            }
        }

        fly.append($(flyingimage));

        //fly.append(title.clone());



        var position_from_top = photos.offset().top - $(window).scrollTop();

        xofsset = photos.offset();


        var btm = $(window).height() - (position_from_top + photos.height());

        fly.css({
            width: photos.width() + "px",
            bottom: btm + "px",
            height: photos.height() + "px",
            left: xofsset.left + "px",
        });

        $('body').append(fly);


        //$('#tr').get(0).play();



        fly.css({
            transition: 'all 1.5s'
        });



        $(".cartslider").css({
            "height": "30vh"
        });

        $(".cartslider_smallview").css({
            "align-items": "start"
        });




        setTimeout(function() {
            fly.css({
                bottom: "-100%",
                width: "1vw"
            });
        }, 200);


        $('.cartslider').removeClass("xshake");

        setTimeout(function() {

            $('.cartslider').addClass("xshake");
            //$('#shopp').get(0).play();

        }, 700);


        setTimeout(function() {

            $(".cartslider").css({
                "height": "9vh"
            });


            $(".cartslider_smallview").css({
                "align-items": "center"
            });


        }, 900);




        addtocart({
            id: vals.id,
            title: vals.title,
            tinytitle: vals.tinytitle,
            price: parseInt(vals.price)
        });


    });

    cont.append(kharid);

    $('.bigprod').empty();


    $('.bigprod').append(cont);
    $('.bigprod').append($('<hr>'));


}

function loadtoloader(target, path) {

    $(target).empty();

    apix.get(path, function(vals) {

        var xx = '<div style="transition: all .150s" class="rounded col-4 col-sm-3  p-2 text-center miniproduct" data-me=""> \
<div class=" h-100 " style="direction:rtl;flex-direction:column;display:flex"> \
<span>  <img class="mw-100" src="/' + vals.photo + '"></span> \
<div style="margin-top:auto"> \
<span style="color:#535353" href="product/47" class="d-block">' + vals.tinytitle + '</span> \
</div> \
<div style="margin-top:auto"> \
<span style="color:#232933">' + vals.price + '</span><span style="font-size:.714rem ; color:#232933">تومان \
</span> \
</div> \
</div> \
</div>';


        var jprod = $(xx);



        jprod.on("touchstart click", function() {
            jprod.css({
                "transform": 'scale(0.8)',
                "background-color": '#3781f0'
            });

            setTimeout(function() {
                jprod.css({
                    "transform": 'scale(1.0)',
                    "background-color": 'white'
                });
            }, 151);


        });


        /**/


        jprod.on("click", function(e) {


            hpu({ act: "product", prod: vals });

            openprod(vals);



        });
        /**/




        $(target).append(jprod);




    });
}










function loadcat() {
    $(".catmain").empty();

    apix.get("maincat", function(vals) {

        var catelem = $('<div class="bg-warning rounded-pill m-2 p-2" style="transition:all 0.1s;display:inline-block">' + vals.title + '</div>');

        catelem.on("touchstart click", function() {

            console.log("touchstart");

            $(this).css({ "transform": 'scale(0.3)' });

            $(this).removeClass("rounded-pill");
            $(this).addClass("rounded");

            setTimeout(function() {
                catelem.css({ "transform": 'scale(1.0)' });

                catelem.removeClass("rounded");
                catelem.addClass("rounded-pill");

            }, 151);

        });


        catelem.click(function() {
            $('.bigprod').empty();
            loadtoloader(".loader", "fromcat/" + vals.id);
        });



        $(".catmain").append(catelem);

    });
}