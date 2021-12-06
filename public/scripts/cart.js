function Cart() {

    var self = this;
    this.prods = {};

    this.eech = function(e) {
        var self = this;
        Object.keys(this.prods).forEach(function(key) {
            e(self.prods[key])
        });

    }


    this.empty = function() {

        self.prods = {};
        self.triggerAllChangeListeners();
    }

    this.loadfromjson = function(jsonx) {
        this.prods = JSON.parse(jsonx);

        $(document).ready(function() {
            self.triggerAllChangeListeners();
        });

    }

    this.items = function() {
        var x = [];
        self.eech(function(i) {
            x.push(i);
        });
        return x;
    }

    this.total = function() {
        var tot = {
            amount: 0,
            count: 0
        }
        this.eech(function(prod) {
            tot.count += prod.count;
            tot.amount += prod.price * prod.count;
        });
        return tot;
    }


    this.getItem = function(id) {
        if (self.prods.hasOwnProperty(id)) {
            return self.prods[id];
        } else {
            return null;
        }

    }

    this.changeListeners = [];

    this.addChangeListener = function(e) {
        self.changeListeners.push(e);
    }

    this.triggerAllChangeListeners = function() {



        document.cookie = "zcart=" + JSON.stringify(this.prods) + '; path=/';

        for (i = 0; i < self.changeListeners.length; i++) {
            self.changeListeners[i]();
        }
    }

    this.add = function(prod) {
        if (!self.prods[prod.id]) {
            var newprod = prod;
            newprod.count = 1;
            self.prods[prod.id] = newprod;
        }

        this.triggerAllChangeListeners();

    }


    this.changeCount = function(prodid, num) {
        if (self.prods[prodid]) {
            self.prods[prodid].count = num;
        }
        if (num < 1) {
            delete self.prods[prodid];
        }

        this.triggerAllChangeListeners();

    }


    return this;
}