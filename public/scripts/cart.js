

function Cart() {

    var self = this;
    this.prods = {};

    this.eech = function(e) {
        var self = this;
        Object.keys(this.prods).forEach(function(key) {
            e(self.prods[key])
        });

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

    this.changeListeners = [];

    this.addChangeListener = function(e) {
        self.changeListeners.push(e);
    }

    this.triggerAllChangeListeners = function() {
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


      this.changeCount = function(prodid,num) {
        if (self.prods[prodid]) {
            self.prods[prodid].count = num;
        }
        if (num<1) {
          delete self.prods[prodid];
        }

        this.triggerAllChangeListeners();

    }


    return this;
}