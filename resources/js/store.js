$(document).ready(function () {
    $(document).on('click', Store.options.selectors.addGoodToBasket, function () {
        Store.addToBasket($(this));
    });
});

var Store = {
    options: {
        urls: {
            addToBasket: '/good/add',
        },

        selectors: {
            addGoodToBasket: '.store__good-basket',
            goodGoBasket: '.store__good-go-to-basket',
            preloader: 'span.preloader',
        },
    },

    addToBasket: function (btn) {
        this.showPreloader(btn);
        $.ajax({
            url: this.options.urls.addToBasket,
            type: 'get',
            data: {
                id: btn.attr('id')
            }
        }).done(function (answ) {
            var response = $.parseJSON(answ);
            if (response.success) {
                btn.hide();
                $('#' + btn.attr('id') + Store.options.selectors.goodGoBasket).addClass('active');
            } else {
                var error = '';
                $.each(response.errors, function (key, value) {
                    console.log(value);
                    error += value + '\n';
                });
                alert(error.trim());
                Store.hidePreloader(btn);
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