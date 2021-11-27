<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="description" content="Webpage description goes here" />
  <meta charset="utf-8">
  <title>{{$pageTitle}}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">



  <link rel="stylesheet" href="/bs4/bootstrap.min.css">
  <script src="/bs4/jquery.min.js"></script>
  <script src="/bs4/popper.min.js"></script>
  <script src="/bs4/bootstrap.min.js"></script>
  <script src="/bs4/cook.js?{{time()}}"></script>

<script>

function SwiperBox(fields) {
    var self = this;

    this.HTMLElement = document.createElement("div");

    this.HTMLElement.style.width = "100%";
	
    this.HTMLElement.style.overflow = "hidden";
    this.HTMLElement.style.position = "relative";
    this.HTMLElement.style.direction = "ltr";
	

	
    var container = document.createElement("div");

    container.style.position = "absolute";
    container.style.left = "0px";
    container.style.top = "0px";
    container.style.width = "100%";
    container.style.height = "100%";
    container.style.whiteSpace = "nowrap";

    var ratio = document.createElement("img");
	//this is 1X1 png image so you can change it to any ratio you want
    ratio.src = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAIAAACQd1PeAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAMSURBVBhXY/j//z8ABf4C/qc1gYQAAAAASUVORK5CYII=';
     if (typeof fields.ratio !== 'undefined') {
		 ratio.src = fields.ratio;
	 }
	ratio.style.width = "100%";
    ratio.style.visibility = "hidden";

    this.HTMLElement.appendChild(ratio);
    this.HTMLElement.appendChild(container);

    var elem_conts = [];

    for (var i = 0; i < fields.items.length; i++) {

        var itm = document.createElement("div");
        itm.style.width = "100%";
        itm.style.height = "100%";
        itm.style.display = "inline-block";
        itm.style.position = "relative";

        var itmcont = document.createElement("div");
        itmcont.style.position = "absolute";
        itmcont.style.left = "0px";
        itmcont.style.top = "0px";
        itmcont.style.width = "100%";
        itmcont.style.height = "100%";
		
		if (typeof fields.items[i] == 'object') {
			itmcont.appendChild(fields.items[i])
		} else {
			var titm = document.createElement("div");
			titm.innerHTML = fields.items[i];
			titm.style.width = "inherit";
			titm.style.height = "inherit";
		    itmcont.appendChild(titm);
			fields.items[i] = titm;
		}

        itm.appendChild(itmcont);

        elem_conts.push(itm)
        container.appendChild(itm);

    }

    this.start = 0;
    this.mainpos = 0;
    this.stpx = 0;
    this.numx = 0;
    this.movied = true;
    this.mousedown = false;

    this.swipStart = function(e) {
        e.preventDefault();
        self.mousedown = true;
        if (typeof e.changedTouches !== 'undefined') {
            self.start = e.changedTouches[0].pageX;
        } else {
            self.start = e.pageX;
        }

    }

    this.swiping = function(e) {

        if (self.mousedown) {

            e.preventDefault();
            e.stopPropagation();
            if (typeof e.changedTouches !== 'undefined') {
                var dif = e.changedTouches[0].pageX - self.start;

            } else {
                var dif = e.pageX - self.start;

            }
            container.style.transition = 'none';
            container.style.left = self.mainpos + dif + "px";

        }
    }
	
    this.GoTo = function(gotox) {
        
        container.style.transition = 'all 0.1s';
        if (gotox > 0 && gotox <= container.children.length) {

            self.numx = gotox - 1;
            self.stpx = elem_conts[self.numx].offsetLeft * -1;
            self.mainpos = self.stpx;
            container.style.left = self.mainpos + "px";

        }
    }

    this.swiptoLeft = function() {
        if (self.numx < (container.children.length) - 1) {
            self.numx++;
            self.stpx = elem_conts[self.numx].offsetLeft * -1;
        }
        self.swipp();
    }


    this.swiptoRight = function() {
        if (self.numx > 0) {
            self.numx--;
            self.stpx = elem_conts[self.numx].offsetLeft * -1;
        }
        self.swipp();
    }
  
   this.swipp = function() {
        self.mainpos = self.stpx;
        container.style.left = self.mainpos + "px";
	   if (typeof self.onSwipe !== 'undefined') {
		   self.onSwipe(self.numx,fields.items[self.numx]);
	   }
		
    }
	
    this.swipEnd = function(e) {
        self.mousedown = false;
        if (typeof e.changedTouches !== 'undefined') {
            var dif = e.changedTouches[0].pageX - self.start;
        } else {
            var dif = e.pageX - self.start;
        }
        self.mainpos = self.mainpos + dif;
        container.style.transition = 'all 0.1s';
        var maxallowed = container.children.length - 1;
        var minallowed = 0;
        var elemoffset = 0;
		
        if (dif < 0) {
            self.swiptoLeft();
        } else if (dif > 0) {
            self.swiptoRight();
        } else if (dif==0) {
			if (typeof self.onClick !== 'undefined') {
				self.onClick(self.numx,fields.items[self.numx]);
			} 
		}
	   
    }

    this.mouseout = function(e) {

        if (self.mousedown) {
            self.swipEnd(e);
        }

    }

    this.resizeFix = function() {
        self.start = 0;
        self.stpx = elem_conts[self.numx].offsetLeft * -1;
		self.mainpos = self.stpx;
        container.style.left = self.stpx + "px";
    }



    //mouse	
    this.HTMLElement.addEventListener("mousedown", this.swipStart, true)
    this.HTMLElement.addEventListener("mousemove", this.swiping, true)
    this.HTMLElement.addEventListener("mouseup", this.swipEnd, true)
    this.HTMLElement.addEventListener("mouseout", this.mouseout, true)

    //touch	
    this.HTMLElement.addEventListener("touchstart", this.swipStart, true)
    this.HTMLElement.addEventListener("touchmove", this.swiping, true)
    this.HTMLElement.addEventListener("touchend", this.swipEnd, true)

    window.addEventListener("resize", function(e) {
		if (typeof self !== 'undefined') {
            self.resizeFix()
		}
    });

    return this;
}
</script>


<style>
@keyframes zoominoutsinglefeatured {
  0% {
      transform: scale(1,1);
  }
  50% {
      transform: scale(1.2,1.2);
  }
  100% {
      transform: scale(1,1);
  }
}


.saving {

  animation: zoominoutsinglefeatured .5s 1 ;
}

body {
  margin-top:5vh;
}
</style>
</head>


<body>

@yield('main')  


<script>

function farsi_price(inp) {
var inpc = inp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
return topersiannumber(inpc);
}


function animate(from,to,time,func) {
   
    var start = new Date().getTime(),
        timer = setInterval(function() {
            var step = Math.min(1,(new Date().getTime()-start)/time);
            
            var x = from+step*(to-from);
            
            console.log(x);
            
            func(x);
            
            if( step == 1) clearInterval(timer);
        },25);
   
}
</script>

<script>

$(".miniproductddd").click(function(e) {

    var me_offset = $(this).offset();
    var me_top = me_offset.top;
    var elem = $(this);
    var mynext = [];
    var back_mynext = [];
    var keepon = true;
   
    do {
   
        elem = elem.next();

        if (elem.offset()) {

            var next_offset = elem.offset();
            var next_top = next_offset.top;


            if (me_top == next_top) {
                mynext.push(elem);
                back_mynext.push(elem.clone(true, true));
            }

        } else {
            next_top = -1000;
         
        }



    } while (me_top == next_top);


var lastt = mynext[mynext.length-1];

if (typeof lastt === 'undefined') {
lastt = $(this);
}

myprodbox = $('<div style="height:200px" class="prodbox col-12 p-2  border border primary rounded">this is product</div>');
$('.prodbox').remove();
lastt.after(myprodbox);


animate(document.documentElement.scrollTop,myprodbox.offset().top-50,200,function (x) {
  window.scrollTo(0, x);
});


 
});



$(".miniproductx").click(function(e) {

    var me_offset = $(this).offset();
    var me_top = me_offset.top;
    var elem = $(this);
    var mynext = [];
    var back_mynext = [];
    var keepon = true;
   
    do {

   
        elem = elem.next();

        if (elem.offset()) {

            var next_offset = elem.offset();
            var next_top = next_offset.top;


            if (me_top == next_top) {
                mynext.push(elem);
                back_mynext.push(elem.clone(true, true));
            }

        } else {
            next_top = -1000;
         
        }



    } while (me_top == next_top);




if (false) {

}

console.log(back_mynext[back_mynext.length-1].html());

    for (var i = 0 ; i < mynext.length ; i++) {
      // console.log(mynext[i].html());
    }

     var tdis = $(this).clone(true,true);
     $(this).replaceWith(back_mynext[back_mynext.length-1]);

     mynext[back_mynext.length-1].replaceWith(tdis);

   
});

</script>

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
cont.append(kharid);

$(this).append(cont);

$(this).unbind('click');




});
</script>

<div style="position:fixed;height:5vh;backgroung-color:white;top:0px;left:0px;">behkiana</div>
</body>
</html>