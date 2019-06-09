$(document).ready(function () {
    $(document).on('click', Order.options.selectors.removeOrder, function () {
        Order.removeOrder($(this));
    });

    $(document).on('click', Order.options.selectors.pay, function () {
        Order.pay($(this));
    });
});

var Order = {
    options: {
        urls: {
            removeOrder: '/order/remove',
            pay: '/order/pay',
        },

        selectors: {
            removeOrder: '.order__remove',
            pay: '.order__pay',
            status: '.order__info-status',
            preloader: 'span.preloader',
        },
    },

    removeOrder: function (btn) {
        this.showPreloader(btn);
        $.ajax({
            url: this.options.urls.removeOrder,
            type: 'get',
            data: {
                id: btn.attr('id')
            }
        }).done(function (answ) {
            var response = $.parseJSON(answ);
            if (response.success) {
                btn.hide();
                $(Order.options.selectors.pay).hide();
                $(Order.options.selectors.status).text(response.data.status);
            } else {
                var error = '';
                $.each(response.errors, function (key, value) {
                    console.log(value);
                    error += value + '\n';
                });
                alert(error.trim());
                Order.hidePreloader(btn);
            }
            return true;
        });
    },

    pay: function (btn) {
        this.showPreloader(btn);
        $.ajax({
            url: this.options.urls.pay,
            type: 'get',
            data: {
                id: btn.attr('id')
            }
        }).done(function (answ) {
            var response = $.parseJSON(answ);
            if (response.success) {
                btn.hide();
                $(Order.options.selectors.removeOrder).hide();
                $(Order.options.selectors.status).text(response.data.status);
            } else {
                var error = '';
                $.each(response.errors, function (key, value) {
                    console.log(value);
                    error += value + '\n';
                });
                alert(error.trim());
                Order.hidePreloader(btn);
            }
            return true;
        });
    },

    showPreloader: function (btn) {
        btn.find(this.options.selectors.preloader).addClass('active');
    },

    hidePreloader: function (btn) {
        btn.find(this.options.selectors.preloader).removeClass('active');
    },
};