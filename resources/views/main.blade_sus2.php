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


<style>


#nav {
     -o-transition:.5s;
  -ms-transition:.5s;
  -moz-transition:.5s;
  -webkit-transition:.5s;

  transition:.2s;position:fixed;bottom:0px;left:0px;width:100%;background-color:white;height:80%;opacity:0.97;
  z-index:99999;

  border:1px solid grey;
}




</style>

<style>
body {

}
a,a:visited {
  text-decoration:none;
}


input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}


input[type=number] {
  -moz-appearance: textfield;
}
</style>
</head>

<body>


<div class="p-0 p-md-4 p-lg-5 text-white bg-dark text-center text-md-end">
behkiana - phone : 066-42448787
</div>



<div class="container">
@yield('main')  
</div>


  
<div id="nav">
    
    <div id="navmenu"></div>
    
</div>

<script>
function d(i) {
    return document.getElementById(i);
}

 var n = d('nav');
var container = d('nav');


    start = 0;
    mainpos = 0;
    stpx = 0;
    numx = 0;
    movied = true;
    mousedown = true;
    
    fasel = 0;
    
    posit = 0;
	
	fttm = 0;
	ttm = 0;
	
	lasttm = 0;
	
	leforright = 0;
    
    swipStart = function(e) {
	leforright = 0;
        e.preventDefault();
        mousedown = true;
        if (typeof e.changedTouches !== 'undefined') {
            start = e.changedTouches[0].pageY;
        } else {
            start = e.pageY;
        };

        var body = document.getElementsByTagName('body')[0];
		
         fasel = body.clientHeight - start;
         posit = start-n.offsetTop;
		 
		 
		 
		 fttm = fasel+((start-start)-n.clientHeight)+posit;
		 
		 
    };

swiping = function(e) {
        
         var body = document.getElementsByTagName('body')[0];
        
        
        
       
     
 
        if (mousedown) {

            e.preventDefault();
            e.stopPropagation();
            if (typeof e.changedTouches !== 'undefined') {
                var dif = e.changedTouches[0].pageY - start;
				
				var pagexx = e.changedTouches[0].pageY;

            } else {
                var dif = e.pageY - start;
                
                var pagexx = e.pageY;
                

            };
			
	
	
		
            
			ttm = fasel+((start-pagexx)-n.clientHeight)+posit;
          
		  	leforright = ttm-lasttm;
		  
			lasttm = ttm;
            
			
            
            
            
            
            n.style.transition = 'none';
            
          

           
            
            if (ttm <= 0) {
           
            console.log(ttm);
           
              //  n.style.bottom = ttm + "px"; 


            }
           

        }
    };
	


  

	
    swipEnd = function(e) {
        mousedown = false;
		
		if (typeof e.changedTouches !== 'undefined') {
            var dif = e.changedTouches[0].pageY - start;
        } else {
            var dif = e.pageY - start;
        };
		
      

	
	  n.style.transition = '.2s';
	  
	  if (leforright  >= 0) {
	   
	   n.style.bottom = "0px";
	  } else {

	   if (leforright != 0) {

	   n.style.bottom = "-"+(n.clientHeight.toString()-50)+"px";
	   }


	  };
	  
	  
	   
    };

    mouseout = function(e) {

        if (mousedown) {
            swipEnd(e);
        }

    };
    
    
    n.addEventListener("mousedown", swipStart, true);
    n.addEventListener("mousemove", swiping, true);
    n.addEventListener("mouseup", swipEnd, true);
    n.addEventListener("mouseout", mouseout, true);
	
	n.addEventListener("touchstart", this.swipStart, true);
    n.addEventListener("touchmove", this.swiping, true);
    n.addEventListener("touchend", this.swipEnd, true)  ;
    

</script>
</body>
</html>