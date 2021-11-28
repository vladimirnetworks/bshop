<script>


elemclicked = -1;
elementbackup = -1
$(".miniproduct").on("click",function(e) {
if (elemclicked != -1) {
  console.log("ihav");
elemclicked.addClass("col-4");
elemclicked.addClass("col-sm-3");
elemclicked.removeClass("col-12");

elemclicked.replaceWith(elementbackup);

} else {
    console.log("i dont hav");
}




var me_offset =  $(this).offset();
var me_top = me_offset.top;

var elem = $(this);

var myprevs = [];
var back_myprevs = [];
var keepon = true;

do {

elem = elem.prev();

if (elem.offset()) {

var prev_offset =  elem.offset();
var prev_top =  prev_offset.top;


if (me_top == prev_top) {
myprevs.push(elem);
back_myprevs.push(elem.clone(true, true));
}

} else {
  prev_top = -1000;
}



} while(me_top == prev_top);

for (var i = 0 ; i < myprevs.length ; i++) {
 myprevs[i].remove();

}

for (var i = 0 ; i < back_myprevs.length ; i++) {
/*  back_myprevs[i].click(function(e) {
       console.log("me");
  });
  */
$(this).after($(back_myprevs[i]));
}





elemclicked = $(this);
elementbackup = $(this).clone(true,true);

$(this).removeClass("col-4");
$(this).removeClass("col-sm-3");
$(this).addClass("col-12");





animate(document.documentElement.scrollTop,$(this).offset().top-50,200,function (x) {
  window.scrollTo(0, x);
});

$(this).css("background-color","#a9a9a9");

$(this).html('');

var vals = JSON.parse($(this).attr("data-me"));
var photoitems = [];
console.log(vals.photos);
for (var i=0;i<vals.photos.length;i++) {
   photoitems.push('<div class="myitem"><img style="width:100%" src="'+vals.photos[i].medium+'"  /></div>');
}

var mySwipe = new SwiperBox({
					items:photoitems					
					});



var cont = $('<div class="saving p-1 m-1 rounded " style="min-height:70vh;background-color:white;direction:rtl"></div>');

var photos = $('<div style="width:60vw;margin-right: auto;margin-left: auto;max-width:300px;"></div>');
photos.append($(mySwipe.HTMLElement));
var title = $('<div class="p-1 text-dark" style="font-size:120;font-weight:bold">'+vals.title+'</div>');
var price = $('<div class="p-1 text-success" style="font-size:150%;font-weight:bold">'+farsi_price(vals.price)+' تومان </div>');
var caption = $('<ul style="text-align: right;font-size:90%">'+vals.caption+'</ul>');

cont.append(photos);
cont.append(title);
cont.append(price);
cont.append(caption);





var kharid = $('<button class="btn btn-danger btn-lg m-2">خرید</button>');

kharid.click(function(e) {

var fly = $('<div class="fly" style="width:50vh;height:100px;background-color:red;position:fixed;bottom:50%;left:0px">fly</div>');

//$('.fly').remove();


var leftPos  = photos[0].getBoundingClientRect().left   + $(window)['scrollLeft']();
var rightPos = photos[0].getBoundingClientRect().right  + $(window)['scrollLeft']();
var topPos   = photos[0].getBoundingClientRect().top    + $(window)['scrollTop']();
var bottomPos= photos[0].getBoundingClientRect().bottom + $(window)['scrollTop']();


  console.log(topPos);

  var btm = $(window).height()-(xofsset.top)

fly.css({
  width:photos.width()+"px",
bottom:btm+"px",
height:photos.height()+"px",
left:xofsset.left+"px",
});

  // $('body').append(fly);

   fly.animate({bottom:"-100%"},1000),function() {
    //  $('.fly').remove();
   };
   

  addtocart({id:vals.id,title:vals.title,tinytitle:vals.tinytitle,price:parseInt(vals.price)});
});

cont.append(kharid);

$(this).append(cont);

$(this).unbind('click');




});
</script>