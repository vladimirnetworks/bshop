function farsi_price(inp) {
    var inpc = inp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return topersiannumber(inpc);
}


function animate(from, to, time, func) {

    var start = new Date().getTime(),
        timer = setInterval(function() {
            var step = Math.min(1, (new Date().getTime() - start) / time);

            var x = from + step * (to - from);



            func(x);

            if (step == 1) clearInterval(timer);
        }, 25);

}

function hpu(act) {
    console.log("added " + act);
    history.pushState({ "act": act }, act, "?" + act);
}