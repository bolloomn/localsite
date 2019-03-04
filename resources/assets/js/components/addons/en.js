!function (e, n) {
    "object" == typeof exports && "undefined" != typeof module ? module.exports = n() : "function" == typeof define && define.amd ? define(n) : (e.__vee_validate_locale__en = e.__vee_validate_locale__en || {}, e.__vee_validate_locale__en.js = n())
}(this, function () {
    "use strict";
    var e, n = {
        name: "en", messages: {
            _default: function (e) {
                return "The " + e + " value is not valid."
            }, after: function (e, n) {
                var t = n[0];
                return "The " + e + " must be after " + (n[1] ? "or equal to " : "") + t + "."
            }, alpha_dash: function (e) {
                return "The " + e + " field may contain alpha-numeric characters as well as dashes and underscores."
            }, alpha_num: function (e) {
                return "The " + e + " field may only contain alpha-numeric characters."
            }, alpha_spaces: function (e) {
                return "The " + e + " field may only contain alphabetic characters as well as spaces."
            }, alpha: function (e) {
                return "The " + e + " field may only contain alphabetic characters."
            }, before: function (e, n) {
                var t = n[0];
                return "The " + e + " must be before " + (n[1] ? "or equal to " : "") + t + "."
            }, between: function (e, n) {
                return "The " + e + " field must be between " + n[0] + " and " + n[1] + "."
            }, confirmed: function (e) {
                return "The " + e + " confirmation does not match."
            }, credit_card: function (e) {
                return "The " + e + " field is invalid."
            }, date_between: function (e, n) {
                return "The " + e + " must be between " + n[0] + " and " + n[1] + "."
            }, date_format: function (e, n) {
                return "The " + e + " must be in the format " + n[0] + "."
            }, decimal: function (e, n) {
                void 0 === n && (n = []);
                var t = n[0];
                return void 0 === t && (t = "*"), "The " + e + " field must be numeric and may contain " + (t && "*" !== t ? t : "") + " decimal points."
            }, digits: function (e, n) {
                return "The " + e + " field must be numeric and exactly contain " + n[0] + " digits."
            }, dimensions: function (e, n) {
                return "The " + e + " field must be " + n[0] + " pixels by " + n[1] + " pixels."
            }, email: function (e) {
                return "The " + e + " field must be a valid email."
            }, ext: function (e) {
                return "The " + e + " field must be a valid file."
            }, image: function (e) {
                return "The " + e + " field must be an image."
            }, in: function (e) {
                return "The " + e + " field must be a valid value."
            }, integer: function (e) {
                return "The " + e + " field must be an integer."
            }, ip: function (e) {
                return "The " + e + " field must be a valid ip address."
            }, length: function (e, n) {
                var t = n[0], i = n[1];
                return i ? "The " + e + " length must be between " + t + " and " + i + "." : "The " + e + " length must be " + t + "."
            }, max: function (e, n) {
                return "The " + e + " field may not be greater than " + n[0] + " characters."
            }, max_value: function (e, n) {
                return "The " + e + " field must be " + n[0] + " or less."
            }, mimes: function (e) {
                return "The " + e + " field must have a valid file type."
            }, min: function (e, n) {
                return "The " + e + " field must be at least " + n[0] + " characters."
            }, min_value: function (e, n) {
                return "The " + e + " field must be " + n[0] + " or more."
            }, not_in: function (e) {
                return "The " + e + " field must be a valid value."
            }, numeric: function (e) {
                return "The " + e + " field may only contain numeric characters."
            }, regex: function (e) {
                return "The " + e + " field format is invalid."
            }, required: function (e) {
                return "Заавал бөглө"
            }, size: function (e, n) {
                var t, i, a, r = n[0];
                return "The " + e + " size must be less than " + (t = r, i = 1024, a = 0 == (t = Number(t) * i) ? 0 : Math.floor(Math.log(t) / Math.log(i)), 1 * (t / Math.pow(i, a)).toFixed(2) + " " + ["Byte", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"][a]) + "."
            }, url: function (e) {
                return "The " + e + " field is not a valid URL."
            }
        }, attributes: {}
    };
    return "undefined" != typeof VeeValidate && VeeValidate.Validator.localize(((e = {})[n.name] = n, e)), n
});