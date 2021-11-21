function createCookie(name, value, days) {
    var expires;

    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    } else {
        expires = "";
    }
    document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
}

function readCookie(name) {
    var nameEQ = encodeURIComponent(name) + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ')
            c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0)
            return decodeURIComponent(c.substring(nameEQ.length, c.length));
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name, "", -1);
}

//////////////


function sc(nam,val) {
    createCookie(nam,val,365*10);
}

function gc(nam) {
    return readCookie(nam);
}


function cart(inp=null) {

    if (inp!=null) {
        createCookie('cart', JSON.stringify(inp), 365*10);
    }

    var cart = null;
    if (readCookie("cart")) {
       cart = JSON.parse(readCookie("cart"));
    } else {
       createCookie('cart', JSON.stringify({}), 365*10); 
       cart = {};
    }

    return cart;
}


function me() {
    return readCookie('base_address')+":"+readCookie('x_address');
}

function toyou(path,data,onloadx) {
    var xhttp = new XMLHttpRequest();


    xhttp.onload = function() {
        if (onloadx !=null) {
        onloadx(this.responseText)
    } 
    }
   



    xhttp.open("POST", "/api/"+path+"?"+Math.random());
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send(JSON.stringify({"me":me(),"data":data}));
}


//util
function topersiannumber(str) {
    var numbers = [/[0۰٠]/g,/[1۱١]/g,/[2۲٢]/g,/[3۳٣]/g,/[4۴٤]/g,/[5۵٥]/g,/[6۶٦]/g,/[7۷٧]/g,/[8۸٨]/g,/[9۹٩]/g];
    var persiannumbers = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
    
    
    for(var i=0; i<numbers.length; i++)
    {
        str = str.replace(numbers[i],persiannumbers[i]);
    }
    return str;
    
    }