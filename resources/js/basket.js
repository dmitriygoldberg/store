$(document).ready(function () {
    $(document).on('click', Basket.options.selectors.removeGoodFromBasket, function () {
        Basket.removeGood($(this));
    });

    $(document).on('click', Basket.options.selectors.addOrder, function () {
        Basket.addOrder($(this));
    });
});

var Basket = {
    options: {
        urls: {
            removeFromBasket: '/good/remove',
            addOrder: '/order/add'
        },

        selectors: {
            removeGoodFromBasket: '.basket__rm-good-btn',
            addOrder: '.basket__to-order',
            table: '.basket__table',
            tr: '.basket__good',
            goodPrice: '.basket__good-price',
            totalPrice: '.basket__total-price-value',
            emptyBlock: '.basket__empty',
            tableWrapper: '.basket__table-wrapper',
            preloader: '.preloader'
        }
    },

    removeGood: function (btn) {
        var tr = $(this.options.selectors.table).find('#' + btn.attr('id') + this.options.selectors.tr);
        var price = $('#' + btn.attr('id') + this.options.selectors.goodPrice).val();
        var totalPrice = $(this.options.selectors.totalPrice);

        $.ajax({
            url: this.options.urls.removeFromBasket,
            type: 'get',
            data: {
                id: btn.attr('id')
            }
        }).done(function (answ) {
            var response = $.parseJSON(answ);
            if (response.success) {
                if (response.data.emptyBasket) {
                    $(Basket.options.selectors.tableWrapper).removeClass('active');
                    $(Basket.options.selectors.emptyBlock).addClass('active');
                    return true;
                }

                tr.hide();
                totalPrice.text(totalPrice.text() - price);
            } else {
                var error = '';
                $.each(response.errors, function (key, value) {
                    console.log(value);
                    error += value + '\n';
                });
                alert(error.trim());
            }
            return true;
        });
    },

    addOrder: function (btn) {
        this.showPreloader(btn);
        $.ajax({
            url: this.options.urls.addOrder,
            type: 'get',
            data: {
                id: btn.attr('id')
            }
        }).done(function (answ) {
            var response = $.parseJSON(answ);
            if (response.success) {
                console.log(response);
                var orderId = response.data.orderId;
                $(location).attr('href', btn.attr('href') + '?id=' + orderId);
            } else {
                var error = '';
                $.each(response.errors, function (key, value) {
                    console.log(value);
                    error += value + '\n';
                });
                alert(error.trim());
                Basket.hidePreloader(btn);
            }
            return true;
        });
        return false;
    },

    showPreloader: function (btn) {
        console.log(btn.find(this.options.selectors.preloader));
        btn.find(this.options.selectors.preloader).addClass('active');
    },

    hidePreloader: function (btn) {
        btn.find(this.options.selectors.preloader).removeClass('active');
    },
};