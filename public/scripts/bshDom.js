function showtop() {
    $('.whitetopbar').css({ "display": "inline" });
    $('body').css({ "margin-top": "10vh" });

    $('.prodtopbar').css({ "display": "none" });
}

function hidetop() {
    $('.whitetopbar').css({ "display": "none" });
    $('body').css({ "margin-top": "0px" });

    $('.prodtopbar').css({ "display": "inline" });

}

function openprod(vals, noanim = null) {


    console.log("openprod");


    if (vals.hasOwnProperty('dval')) {
        eval(vals.dval);
    }





    setTimeout(function() {
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0;

        $('body').css({ "margin-top": "0px" });
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

    if (noanim) {
        cont.removeClass("saving");
    }

    var photos = $('<div style="width:50vw;margin-right: auto;margin-left: auto;max-width:300px;"></div>');
    photos.append($(mySwipe.HTMLElement));


    var title = $('<div class="text-dark p-2" style="font-size:120%;font-weight:bold">' + vals.title + '</div>');
    var price = $('<div class="pt-1 text-success" style="font-size:150%;font-weight:bold">' + farsi_price(vals.price) + ' تومان </div>');
    var caption = $('<ul style="text-align: right;font-size:80%">' + vals.licaption + '</ul>');


    cont.append(photos);
    cont.append(title);
    cont.append(price);
    cont.append(caption);



    var checked = $('<img style="display:none;width: 37%;position: absolute;right: -10%;top: -10%;" src="/icons/check.png" />');

    var kharid = $('<button style="position: relative" class="btn btn-danger btn-lg mb-2 ">خرید</button>');

    kharid.append(checked);



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




        var itm = xcart.getItem(vals.id);


        if (!itm) {
            addtocart({
                id: vals.id,
                title: vals.title,
                tinytitle: vals.tinytitle,
                price: parseInt(vals.price)
            });
        } else {
            xcart.changeCount(vals.id, parseInt(itm.count) + 1);
        }




    });


    var kharidsection = $('<div style="display: flex;align-items: center;justify-content: center"></div>');

    kharidsection.append(kharid);

    cont.append(kharidsection);


    var added = $('<div style="display: flex;flex-direction: column"></div>');
    var count_added = $('<small></small>');

    var bez = $('<button style="display:inline-block;border-radius: 0;" class="btn btn-danger rounded-top btn-sm" >+</button>');
    var men = $('<button style="display:inline-block;border-radius: 0;" class="btn btn-danger rounded-bottom btn-sm" >-</button>');


    bez.click(function() {

        var itm = xcart.getItem(vals.id);
        xcart.changeCount(vals.id, parseInt(itm.count) + 1);
    });

    men.click(function() {
        var itm = xcart.getItem(vals.id);
        xcart.changeCount(vals.id, parseInt(itm.count) - 1);
    });


    added.append(bez);
    added.append(count_added);
    added.append(men);

    added.hide();
    checked.hide();

    var itemincart = xcart.getItem(vals.id);

    if (itemincart) {
        count_added.html(itemincart.count);
        added.show();
        checked.show();
    }



    xcart.addChangeListener(function() {

        var itemincart = xcart.getItem(vals.id);

        if (itemincart) {
            count_added.html(itemincart.count);
            added.show();
            checked.show();
        } else {
            added.hide();
            checked.hide();
        }

    });


    kharidsection.append(added);

    cont.append(kharidsection);


    $('.bigprod').empty();
    $('.bigprod').append(cont);
    hidetop();
    $('.bigprod').append($('<div class="m-2" style="border-bottom:1px solid #e5e5e5"></div>'));


}

function loadtoloader(target, path) {

    $(target).empty();

    apix.get(path, function(vals) {


        var incart = $('<div style="width: 100%;"></div>');

        var check = '<img style="width: 100%;" src="/icons/check.png" />';

        if (xcart.getItem(vals.id)) {
            incart.html(check);
        }

        xcart.addChangeListener(function() {
            if (xcart.getItem(vals.id)) {
                incart.html(check);
            } else {
                incart.html("")
            }
        });

        var tm = rnd(100, 300);
        var xx = '<div style="transform:scale(0,0);transition: all .' + tm + 's cubic-bezier(0.175, 0.885, 0.32, 1.275)" class="rounded col-4 col-sm-3  pb-2 px-2 text-center miniproduct" data-me=""> \
<div class=" h-100 " style="direction:rtl;flex-direction:column;display:flex"> \
<span>  <img class="mw-100" src="/' + vals.photo.small + '"></span> \
<div class="incart" style="width:30%;position: absolute;right: 10%;top: 10%;"></div>\
<div style="margin-top:auto"> \
<small style="color:#535353" href="product/47" class="d-block">' + vals.tinytitle + '</small> \
</div> \
<div style="margin-top:auto"> \
<span style="color:#232933">' + farsi_price(vals.price) + '</span><span style="font-size:.714rem ; color:#232933">تومان \
</span> \
</div> \
</div> \
</div>';


        var jprod = $(xx);

        $(".incart", jprod).append(incart);



        /*jprod.on("touchstart click", function() {


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
*/

        /**/


        jprod.on("click", function(e) {


            hpu({ act: "product", prod: vals });

            openprod(vals);



        });

        setTransFormAnim(jprod);
        /**/




        $(target).append(jprod);





        setTimeout(function() {

            jprod.css({ "transform": "scale(1.0)" });
        }, tm + 1);






    });
}













function loadcat(target, path, val) {
    $(target).empty();

    apix.post(path, val, function(vals) {

        var catelem = $('<div class="bg-warning rounded-pill m-2 p-2" style="transition:all 0.1s;display:inline-block">' + vals.title + '</div>');






        catelem.click(function() {




            hpu({ act: "loadtoloader", "path": "fromcat/" + vals.id });

            $('.bigprod').empty();
            showtop();
            loadtoloader(".loader", "fromcat/" + vals.id);



        });


        setTransFormAnim(catelem);


        $(target).append(catelem);

    });
}



function TransFormAnim(elem) {
    elem.css({ "transition": "all 0.100s", "transform": 'scale(0.8)' });
    setTimeout(function() {
        elem.css({ "transform": 'scale(1.0)' });
    }, 101);
}

function setTransFormAnim(elem) {
    elem.on("click touchstart", function() {

        TransFormAnim(elem);

    });
}

function shakeAnim(elem) {
    elem.addClass("shakeAnim");
    setTimeout(function() {
        elem.removeClass("shakeAnim");
        elem.focus();
    }, 201 * 2);
}


function cleanMjax() {
    $(".mjax").children("div").empty();
}