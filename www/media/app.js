/**
 * Created by snowgirl on 4/14/17.
 */


/**
 * Very simple client app
 * @todo split into separate classes (views, cart, user, offer, professor.. any entity)
 * @todo add error handlers
 * @todo remove code duplicates if exists
 * @todo implement promises
 * @todo cache..
 * @todo or even better use React Js :)
 * @todo pagination on bottom scrolling...
 * @todo sorting...
 */
var classPickerApp = function (element, config) {
    this.iniArgs(element, config);
    this.syncClient(function (exists) {
        var cachedState = this.getState();
        this.iniDOM(exists ? (cachedState ? cachedState : this.constructor.STATE_CATALOG) : this.constructor.STATE_REGISTER);
    });
};

classPickerApp.prototype.iniArgs = function (element, config) {
    this.view = $('#' + element);
    this.config = $.extend(true, {
        perPage: 10
    }, config);
    this.storagePrefix = 'classPickerApp-';

    //@todo split common states values into state specific ones...
    this.page = 1;

    if (this.config['isCacheOffers']) {
        this.config['isCacheOffers'] = 'offers';
    }
};

classPickerApp.STATE_REGISTER = 0;
classPickerApp.STATE_CATALOG = 1;
classPickerApp.STATE_ORDER = 2;
classPickerApp.STATE_PAYED = 3;

classPickerApp.prototype.iniDOM = function (state, callback) {
    this.setState(state);

    if (this.isState(this.constructor.STATE_REGISTER)) {
        this.showViewRegister(callback);
    } else if (this.isState(this.constructor.STATE_CATALOG)) {
        this.showViewCatalog(callback);
    } else if (this.isState(this.constructor.STATE_ORDER)) {
        this.showViewOrder(callback);
    } else if (this.isState(this.constructor.STATE_PAYED)) {
        this.showViewPayed(callback);
    }
};

classPickerApp.prototype.getState = function () {
    return parseInt(this.getCache('state'));
};
classPickerApp.prototype.isState = function (state) {
    return state === this.getState();
};
classPickerApp.prototype.setState = function (state) {
    return this.setCache('state', state);
};

classPickerApp.prototype.clearOffersCache = function () {
    return this.clearCache('offers');
};

classPickerApp.prototype.syncClient = function (callback) {
    if (this.getClient()) {
        this.request(['user', this.getClient().id].join('/'), 'get', {}, function (code, body) {
            if ((200 == code) && body['user']) {
                this.setClient(body['user']);
                $.proxy(callback, this)(true);
            } else {
                this.clearClient();
                $.proxy(callback, this)(false);
            }
        });
    } else {
        $.proxy(callback, this)(false);
    }
};

classPickerApp.prototype.setClient = function (client) {
    return this.setCache('client', client);
};
classPickerApp.prototype.getClient = function () {
    return this.getCache('client');
};
classPickerApp.prototype.clearClient = function () {
    return this.clearCache('client');
};
classPickerApp.prototype.onClientModify = function (data, callback) {
    var uri;
    var method;

    if (this.getClient()) {
        uri = ['user', this.getClient().id].join('/');
        //we do partial updates only
        method = 'patch';
    } else {
        uri = 'user';
        //create
        method = 'post';
    }

    this.request(uri, method, data, function (code, body) {
        //@todo error processing

        if ([200, 201].indexOf(code) > -1) {
            this.setClient(body['user']);
            $.proxy(callback, this)();
        }
    });
};

classPickerApp.prototype.setCartOffers = function (offers) {
    return this.setCache('cart', offers);
};
classPickerApp.prototype.getCartOffers = function () {
    var output = this.getCache('cart');

    if (!output) {
        output = {};
    }

    return output;
};
classPickerApp.prototype.clearCart = function () {
    return this.clearCache('cart');
};
classPickerApp.prototype.getClientName = function () {
    var client = this.getClient();
    return [
        client.name,
        '[<span class="price">' + client['balance'] + '</span>]'
    ].join(' ');
};

classPickerApp.prototype.makeUri = function (path) {
    return this.config['apiEndpoint'] + '/' + path;
};

classPickerApp.prototype.clearStorage = function () {
    $([sessionStorage, localStorage]).each($.proxy(function (index, storage) {
        var arr = [];

        for (var i = 0; i < storage.length; i++) {
            if (this.storagePrefix == storage.key(i).substring(0, this.storagePrefix.length)) {
                arr.push(storage.key(i));
            }
        }

        for (i = 0; i < arr.length; i++) {
            storage.removeItem(arr[i]);
        }
    }, this));
};

/**
 * Simple Request Maker
 * @todo implement back end routes and use them here (build URIs by routes)
 *  *
 * @param uri
 * @param method
 * @param data
 * @param fn
 * @param cacheKey
 * @returns {*}
 */
classPickerApp.prototype.request = function (uri, method, data, fn, cacheKey) {
    if (cacheKey) {
        var cacheData = this.getCache(cacheKey);
//        console.log('Cache Key: ', cacheKey);
//        console.log('Cache Data: ', cacheData);
        if (cacheData) {
            $.proxy(fn, this)(cacheData.code, cacheData.body);
            return true;
        }
    }

    this.view.addClass('loading');

    return $.ajax({url: this.makeUri(uri), dataType: 'json', type: method, data: data})
        .always($.proxy(function (response, code) {
            this.view.removeClass('loading');

            var body;

            if (response) {
                code = response.hasOwnProperty('responseJSON') ? response['responseJSON']['code'] : response['code'];
                body = response.hasOwnProperty('responseJSON') ? response['responseJSON']['body'] : response['body'];
            }

            if (cacheKey) {
                this.setCache(cacheKey, {code: code, body: body});
            }

            $.proxy(fn, this)(code, body);
        }, this));
};
classPickerApp.prototype.normalizeView = function (className) {
    this.view.removeAttr('class').empty();

    if (this.getClient()) {

        var mapCurrentToPreviousState = {};
        mapCurrentToPreviousState[this.constructor.STATE_CATALOG] = $.proxy(function () {
            this.clearStorage();
            this.iniDOM(this.constructor.STATE_REGISTER);
        }, this);
        mapCurrentToPreviousState[this.constructor.STATE_ORDER] = $.proxy(function () {
            this.iniDOM(this.constructor.STATE_CATALOG);
        }, this);
        mapCurrentToPreviousState[this.constructor.STATE_PAYED] = $.proxy(function () {
            this.iniDOM(this.constructor.STATE_CATALOG);
        }, this);

        var currentState = this.getCache('state');

        if (mapCurrentToPreviousState.hasOwnProperty(currentState)) {
            var $btnBack = $('<button/>', {
                type: 'button',
                text: 'Back'
            });

            $btnBack.on('click', function () {
                mapCurrentToPreviousState[currentState]();
            });

            this.view.append($btnBack);

            var $btnClear = $('<button/>', {
                type: 'button',
                text: 'Clear'
            });

            $btnClear.on('click', $.proxy(function () {
                this.clearStorage();
//            this.clearGame();
                this.iniDOM(this.constructor.STATE_REGISTER);
            }, this));

            this.view.append($btnClear);
        }
    }

    this.view.addClass(className);
};
classPickerApp.prototype.genOfferView = function (offer) {
    var $offer = $('<div/>', {class: 'offer', 'data-id': offer.id});

    $offer.append($('<img/>', {
        class: 'offer-image',
        src: [this.config['imagesWebPath'], '/', offer['image']].join(''),
        title: offer['name'],
        alt: offer['image'] + ' photo'
    }));

    var $offerInfo = $('<div/>', {class: 'offer-info'});

    $offerInfo.append($('<div/>', {
        class: 'offer-name',
        text: offer['name'],
        title: 'Name "' + offer['name'] + '"'
    }));

//    console.log(offer['professor_id_to_name']);

    if (offer['professor_id_to_name']) {
        var $offerProfessors = $('<div/>', {class: 'offer-professors'});

        for (var id in offer['professor_id_to_name']) {
            if (offer['professor_id_to_name'].hasOwnProperty(id)) {
                $offerProfessors.append($('<span/>', {
                    class: 'offer-professor',
                    'data-id': id,
                    text: offer['professor_id_to_name'][id],
                    title: 'Professor "' + offer['professor_id_to_name'][id] + '"'
                }));
            }
        }

        $offerInfo.append($offerProfessors);
    }

    if (offer['datetime_to_duration']) {
        var $offerDateTimes = $('<div/>', {class: 'offer-datetimes'});

        for (var datetime in offer['datetime_to_duration']) {
            if (offer['datetime_to_duration'].hasOwnProperty(datetime)) {
                $offerDateTimes.append($('<span/>', {
                    class: 'offer-datetime',
                    'data-value': datetime,
                    //@todo format date, time and duration
                    text: [datetime, offer['datetime_to_duration'][datetime]].join(''),
                    title: [
                        'Date & Time "' + datetime + '"',
                        'Duration "' + offer['datetime_to_duration'][datetime] + '"'
                    ].join("\r\n")
                }));
            }
        }

        $offerInfo.append($offerDateTimes);
    }

    $offerInfo.append($('<div/>', {
        class: 'offer-description',
        text: offer['description'],
        title: 'Description "' + offer['description'] + '"'
    }));
    $offerInfo.append($('<div/>', {class: 'offer-price price', text: offer['price']}));

    var offerRating = Number(offer['rating'] > 0 ? (parseInt(offer['rating']) / parseInt(offer['vote_count'])) : 0).toFixed(2);
    var $offerRating = $('<div/>', {
        class: 'offer-rating',
        title: 'Offer Rating "' + offerRating + '"'
    });

    var i, l;

    if (offer['user_mark']) {
        for (i = 0, l = this.config['ratingStarsCount']; i < l; i++) {
            $offerRating.append($('<span/>', {class: 'offer-rating-star ' + (i + 1 == offer['user_mark'] ? 'rated' : '')}));
        }
    } else {
        $offerRating.addClass('can-rate');

        for (i = 0, l = this.config['ratingStarsCount']; i < l; i++) {
            $offerRating.append($('<span/>', {class: 'offer-rating-star empty'}));
        }

        $offerRating.on('click', '.offer-rating-star', $.proxy(function (ev) {
            var $star = $(ev.target);
            var offerId = $star.closest('.offer').attr('data-id');
            var mark = $star.index() + 1;
            this.makeRating(offerId, mark, function () {
                this.clearOffersCache();

                //fix for screen jumping
                var windowTop = $(window).scrollTop();
                this.iniDOM(this.constructor.STATE_CATALOG, function () {
                    $(window).scrollTop(windowTop);
                });
            });
        }, this));
    }

    $offerRating.append($('<span/>', {
        class: 'offer-rating-info',
        text: offerRating
    }));

    $offerInfo.append($offerRating);

    $offerInfo.append($('<button/>', {class: 'offer-buy', text: 'Add To Cart', type: 'button'}));

    $offer.append($offerInfo);

    return $offer;
};
classPickerApp.prototype.genOfferCartView = function (offer, quantity, total) {
    var className = [this.isState(this.constructor.STATE_CATALOG) ? 'small' : '', 'cart-offer'].join(' ');

    var $offer = $('<div/>', {class: className, 'data-id': offer.id});

    $offer.append($('<img/>', {
        class: className + '-image',
        src: [this.config['imagesWebPath'], '/', offer['image']].join(''),
        title: offer['name'],
        alt: offer['image'] + ' photo'
    }));

    var $offerInfo = $('<div/>', {class: className + '-info'});

    $offerInfo.append($('<div/>', {class: className + '-name', text: offer['name']}));

    $offerInfo.append($('<div/>', {class: className + '-total'})
        .append($('<span/>', {class: className + '-price price', text: offer['price']}))
        .append($('<span/>', {class: className + '-multi-sign'}))
        .append($('<span/>', {class: className + '-quantity', text: quantity}))
        .append($('<span/>', {class: className + '-equal-sign'}))
        .append($('<span/>', {
            class: className + '-price price',
            text: total
        })));

    var $btnInc = $('<button/>', {
        class: className + '-inc',
        text: '+',
        type: 'button'
    });

    $btnInc.on('click', $.proxy(function (ev) {
        var offerId = $(ev.target).closest('.cart-offer').attr('data-id');
        this.incCartOffer(offerId, function (offers) {
            //@todo error processing

            var callback = $.proxy(function () {
                this.$cart.empty().append(this.genCartView(offers, null));
            }, this);

            if (this.isState(this.constructor.STATE_ORDER)) {
                //fix for screen jumping
                var windowTop = $(window).scrollTop();
                callback();
                $(window).scrollTop(windowTop);
            } else {
                callback();
            }
        });
    }, this));

    $offerInfo.append($btnInc);

    var $btnDec = $('<button/>', {
        class: className + '-dec',
        text: '-',
        type: 'button'
    });

    $btnDec.on('click', $.proxy(function (ev) {
        var offerId = $(ev.target).closest('.cart-offer').attr('data-id');
        this.decCartOffer(offerId, function (offers) {
            //@todo error processing
            this.$cart.empty().append(this.genCartView(offers, null));
        });
    }, this));

    $offerInfo.append($btnDec);

    $offer.append($offerInfo);

    return $offer;
};

classPickerApp.prototype.showViewRegister = function () {
    this.normalizeView('pick-name register');

    var $h2 = $('<h2/>', {text: 'Reg'});

    this.view.append($h2);

    var $form = $('<form/>', {action: this.makeUri('user'), method: 'POST'});

    var defaults = {
        name: 'Customer #' + Math.floor(new Date().getTime() / 1000),
        balance: this.config['defaultBalance']
    };

    var $inputName = $('<input/>', {
        name: 'name',
        type: 'text',
        placeholder: defaults.name
    });

    $form.append($('<label/>').append($('<span/>', {text: 'Name'})).append($inputName));

    var $inputBalance = $('<input/>', {
        name: 'balance',
        type: 'number',
        placeholder: defaults.balance
    });

    $form.append($('<label/>').append($('<span/>', {text: 'Balance'})).append($inputBalance));

    var $btn = $('<button/>', {
        type: 'submit',
        text: 'OK'
    });

    $form.append($('<label/>').append($('<span/>')).append($btn));

    $form.on('submit', $.proxy(function (ev) {
        var form = objectifyForm($(ev.target).serializeArray());

        for (var name in form) {
            if (form.hasOwnProperty(name)) {
                if (0 == form[name].length) {
                    form[name] = defaults[name];
                }
            }
        }

        this.onClientModify(form, function () {
            this.iniDOM(this.constructor.STATE_CATALOG);
        });

        return false;
    }, this));

    this.view.append($form);
    $inputName.focus();
};

function objectifyForm(formArray) {
    var returnArray = {};

    for (var i = 0; i < formArray.length; i++) {
        returnArray[formArray[i]['name']] = formArray[i]['value'];
    }

    return returnArray;
}

classPickerApp.prototype.showViewCatalog = function (callback) {
    this.onCatalogOffersLoaded(function (offers) {
        this.normalizeView('catalog');

        var $h2 = $('<h2/>', {html: '<b>' + this.getClientName() + '</b>, awesome offers waintig for you!'});

        this.view.append($h2);

        var $offers = $('<div/>', {class: 'offers'});

        for (var id in offers) {
            if (offers.hasOwnProperty(id)) {
                var $offer = this.genOfferView(offers[id]);
                $offers.append($offer);
            }
        }

        $offers.on('click', '.offer-buy', $.proxy(function (ev) {
            var offerId = $(ev.target).closest('.offer').attr('data-id');
            this.incCartOffer(offerId, function () {
                this.$cart.empty().append(this.genCartView(offers, null));
            });
        }, this));

        this.view.append($offers);

        this.$cart = $('<div/>', {class: 'cart-wrapper'});

        this.$cart.append(this.genCartView(offers, null));

        this.view.append(this.$cart);

        callback && $.proxy(callback, this)();
    });
};
classPickerApp.prototype.showViewOrder = function () {
    /**
     * For simplicity we have additional calls...
     */
        //@todo remove unnecessary calls - we have this data already
    this.onCatalogOffersLoaded(function (offers) {
        this.normalizeView('order');

        var $h2 = $('<h2/>', {html: '<b>' + this.getClientName() + '</b>, here is your order!'});

        this.view.append($h2);

        this.$cart = $('<div/>', {class: 'cart-wrapper'});

        this.$cart.append(this.genCartView(offers));

        this.view.append(this.$cart);
    });
};
classPickerApp.prototype.showViewPayed = function () {
    this.normalizeView('payed');

    this.view.append($('<h2/>', {html: '<b>' + this.getClientName() + '</b>, Congrats!'}));
    this.view.append($('<div/>', {
        class: 'payed-text', html: [
            'Dear ' + this.getClient().name,
            'We\'ve withdrew money for the order you\'ve made',
            'You order is in the way!',
            'Good luck!'
        ].join('<br/>')
    }));
};
classPickerApp.prototype.onCatalogOffersLoaded = function (callback) {
    var uri = ['offers-for-catalog-list', this.getClient().id, 'page', this.page, 'per_page', this.config['perPage']].join('/');
    this.request(uri, 'get', {}, function (code, body) {
        //@todo error processing
        var offers = body['offers'];

        $.proxy(callback, this)(offers);

    }, this.config['isCacheOffers']);
};
classPickerApp.prototype.incCartOffer = function (offerId, callback) {
    /**
     * For simplicity we have additional calls...
     */
        //@todo remove unnecessary calls - we have this data already
    this.onCatalogOffersLoaded(function (offers) {
        if (!offers.hasOwnProperty(offerId)) {
            //@todo error processing
            return false;
        }

        var cartOfferIdToQuantity = this.getCartOffers();

        if (!cartOfferIdToQuantity.hasOwnProperty(offerId)) {
            cartOfferIdToQuantity[offerId] = 0;
        }

        cartOfferIdToQuantity[offerId]++;

        this.setCartOffers(cartOfferIdToQuantity);

        $.proxy(callback, this)(offers);
    });
};
classPickerApp.prototype.decCartOffer = function (offerId, callback) {
    /**
     * For simplicity we have additional calls...
     */
        //@todo remove unnecessary calls - we have this data already
    this.onCatalogOffersLoaded(function (offers) {
        if (!offers.hasOwnProperty(offerId)) {
            //@todo error processing
            return false;
        }

        var cartOfferIdToQuantity = this.getCartOffers();

        if (!cartOfferIdToQuantity.hasOwnProperty(offerId)) {
            cartOfferIdToQuantity[offerId] = 0;
        }

        cartOfferIdToQuantity[offerId]--;

        if (0 == cartOfferIdToQuantity[offerId]) {
            delete cartOfferIdToQuantity[offerId];
        }

        this.setCartOffers(cartOfferIdToQuantity);

        $.proxy(callback, this)(offers);
    });
};
classPickerApp.prototype.genCartView = function (offers) {
    var $cart = $('<div/>', {class: 'cart'});

    if (this.isState(this.constructor.STATE_CATALOG)) {
        $cart.append($('<h3/>', {class: 'cart-header', text: 'Your Cart'}));
    }

    var $offers = $('<div/>', {class: 'cart-offers'});

    var cartOfferIdToQuantity = this.getCartOffers();

    var total = 0;

    if (cartOfferIdToQuantity) {
        for (var id in cartOfferIdToQuantity) {
            if (cartOfferIdToQuantity.hasOwnProperty(id)) {
                var tmpTotal = parseFloat(offers[id]['price']) * parseInt(cartOfferIdToQuantity[id]);
                total += tmpTotal;
                $offers.append(this.genOfferCartView(offers[id], cartOfferIdToQuantity[id], Number(tmpTotal).toFixed(2)))
            }
        }
    }

    $cart.append($offers);

    if (total) {
        var $total = $('<div/>', {class: 'cart-total price', text: 'Total: ' + Number(total).toFixed(2)});

        var isNeedMoreMoney = total > this.getClient().balance;

        if (isNeedMoreMoney) {
            $total.addClass('overdraft');
        }

        $cart.append($total);

        if (!isNeedMoreMoney) {
            var $btnMakeOrder = $('<button/>', {
                class: 'cart-order',
                type: 'button',
                text: this.isState(this.constructor.STATE_CATALOG) ? 'Order' : 'Pay'
            });

            $btnMakeOrder.on('click', $.proxy(function () {
                if (this.isState(this.constructor.STATE_CATALOG)) {
                    this.iniDOM(this.constructor.STATE_ORDER);
                } else {
                    this.makeOrder(function () {
                        this.clearCart();
                        this.iniDOM(this.constructor.STATE_PAYED);
                    });
                }
            }, this));

            $cart.append($btnMakeOrder);
        }
    } else {
        $offers.append($('<div/>', {class: 'cart-empty', text: 'Empty'}));
    }

    return $cart;
};

classPickerApp.prototype.makeOrder = function (callback) {
    var uri = ['order', this.getClient().id].join('/');

    this.request(uri, 'post', {offer_id_to_quantity: this.getCartOffers()}, function (code, response) {
        //@todo error processing

        if ([200, 201].indexOf(code) > -1) {
            this.setClient(response['user']);
            $.proxy(callback, this)();
        }
    });
};

classPickerApp.prototype.makeRating = function (offerId, mark, callback) {
    //'rating/offer/{offer_id}/user/{user_id}/mark/{mark}'
    var uri = ['rating', 'offer', offerId, 'user', this.getClient().id, 'mark', mark].join('/');

    this.request(uri, 'post', {}, function (code, body) {
        //@todo error processing

        if ([200, 201].indexOf(code) > -1) {
            $.proxy(callback, this)();
        }
    });
};

classPickerApp.prototype.setCache = function (k, v) {
    var json = JSON.stringify(v);

    k = this.storagePrefix + k;

    if (sessionStorage) {
        sessionStorage.setItem(k, json);
    }

    if (localStorage) {
        localStorage.setItem(k, json);
    }
};
classPickerApp.prototype.getCache = function (k) {
    k = this.storagePrefix + k;

    var v;

    if (!v) {
        if (localStorage && (v = localStorage.getItem(k))) {
            v = JSON.parse(v);
        }
    }

    if (!v) {
        if (sessionStorage && (v = sessionStorage.getItem(k))) {
            v = JSON.parse(v);
        }
    }

    if (v) {
        this[k] = v;
    }

    return v;
};
classPickerApp.prototype.clearCache = function (k) {
    k = this.storagePrefix + k;

    if (sessionStorage) {
        sessionStorage.removeItem(k);
    }

    if (localStorage) {
        localStorage.removeItem(k);
    }
};