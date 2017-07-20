Validation.addAllThese([
    ['validate-custom-price', 'This field depends by field \"Currency\". It cannot be empty if \"Currency\" was selected.', function(v) {
        var currency_code = $('currency_code') ? $('currency_code').getValue() : $$('.validate-currency-code')[0].getValue();
        return !(Validation.get('IsEmpty').test(v) && currency_code > -1);
    }],
    ['validate-currency-code', 'This field depends by field \"Price on another currency\". You need to choose \"Currency\" if You filled field \"Price on another currency\".', function(v) {
        var custom_price = $('custom_price') ? $('custom_price').getValue() : $$('.validate-custom-price')[0].getValue();
        return !(v < 0 && !Validation.get('IsEmpty').test(custom_price));
    }],
]);