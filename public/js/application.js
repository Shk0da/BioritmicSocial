$.ajaxSetup({headers: {'X-CSRF-Token': $('input[name=_token]').val()}});

+function (t) {
    "use strict";
    function e() {
        var t = document.createElement("bootstrap"), e = {
            WebkitTransition: "webkitTransitionEnd",
            MozTransition: "transitionend",
            OTransition: "oTransitionEnd otransitionend",
            transition: "transitionend"
        };
        for (var i in e)if (void 0 !== t.style[i])return {end: e[i]};
        return !1
    }

    t.fn.emulateTransitionEnd = function (e) {
        var i = !1, o = this;
        t(this).one("bsTransitionEnd", function () {
            i = !0
        });
        var s = function () {
            i || t(o).trigger(t.support.transition.end)
        };
        return setTimeout(s, e), this
    }, t(function () {
        t.support.transition = e(), t.support.transition && (t.event.special.bsTransitionEnd = {
            bindType: t.support.transition.end,
            delegateType: t.support.transition.end,
            handle: function (e) {
                return t(e.target).is(this) ? e.handleObj.handler.apply(this, arguments) : void 0
            }
        })
    })
}(jQuery), +function (t) {
    "use strict";
    function e(e) {
        return this.each(function () {
            var o = t(this), s = o.data("bs.affix"), n = "object" == typeof e && e;
            s || o.data("bs.affix", s = new i(this, n)), "string" == typeof e && s[e]()
        })
    }

    var i = function (e, o) {
        this.options = t.extend({}, i.DEFAULTS, o), this.$target = t(this.options.target).on("scroll.bs.affix.data-api", t.proxy(this.checkPosition, this)).on("click.bs.affix.data-api", t.proxy(this.checkPositionWithEventLoop, this)), this.$element = t(e), this.affixed = null, this.unpin = null, this.pinnedOffset = null, this.checkPosition()
    };
    i.VERSION = "3.3.5", i.RESET = "affix affix-top affix-bottom", i.DEFAULTS = {
        offset: 0,
        target: window
    }, i.prototype.getState = function (t, e, i, o) {
        var s = this.$target.scrollTop(), n = this.$element.offset(), a = this.$target.height();
        if (null != i && "top" == this.affixed)return i > s ? "top" : !1;
        if ("bottom" == this.affixed)return null != i ? s + this.unpin <= n.top ? !1 : "bottom" : t - o >= s + a ? !1 : "bottom";
        var r = null == this.affixed, l = r ? s : n.top, h = r ? a : e;
        return null != i && i >= s ? "top" : null != o && l + h >= t - o ? "bottom" : !1
    }, i.prototype.getPinnedOffset = function () {
        if (this.pinnedOffset)return this.pinnedOffset;
        this.$element.removeClass(i.RESET).addClass("affix");
        var t = this.$target.scrollTop(), e = this.$element.offset();
        return this.pinnedOffset = e.top - t
    }, i.prototype.checkPositionWithEventLoop = function () {
        setTimeout(t.proxy(this.checkPosition, this), 1)
    }, i.prototype.checkPosition = function () {
        if (this.$element.is(":visible")) {
            var e = this.$element.height(), o = this.options.offset, s = o.top, n = o.bottom, a = Math.max(t(document).height(), t(document.body).height());
            "object" != typeof o && (n = s = o), "function" == typeof s && (s = o.top(this.$element)), "function" == typeof n && (n = o.bottom(this.$element));
            var r = this.getState(a, e, s, n);
            if (this.affixed != r) {
                null != this.unpin && this.$element.css("top", "");
                var l = "affix" + (r ? "-" + r : ""), h = t.Event(l + ".bs.affix");
                if (this.$element.trigger(h), h.isDefaultPrevented())return;
                this.affixed = r, this.unpin = "bottom" == r ? this.getPinnedOffset() : null, this.$element.removeClass(i.RESET).addClass(l).trigger(l.replace("affix", "affixed") + ".bs.affix")
            }
            "bottom" == r && this.$element.offset({top: a - e - n})
        }
    };
    var o = t.fn.affix;
    t.fn.affix = e, t.fn.affix.Constructor = i, t.fn.affix.noConflict = function () {
        return t.fn.affix = o, this
    }, t(window).on("load", function () {
        t('[data-spy="affix"]').each(function () {
            var i = t(this), o = i.data();
            o.offset = o.offset || {}, null != o.offsetBottom && (o.offset.bottom = o.offsetBottom), null != o.offsetTop && (o.offset.top = o.offsetTop), e.call(i, o)
        })
    })
}(jQuery), +function (t) {
    "use strict";
    function e(e) {
        return this.each(function () {
            var i = t(this), s = i.data("bs.alert");
            s || i.data("bs.alert", s = new o(this)), "string" == typeof e && s[e].call(i)
        })
    }

    var i = '[data-dismiss="alert"]', o = function (e) {
        t(e).on("click", i, this.close)
    };
    o.VERSION = "3.3.5", o.TRANSITION_DURATION = 150, o.prototype.close = function (e) {
        function i() {
            a.detach().trigger("closed.bs.alert").remove()
        }

        var s = t(this), n = s.attr("data-target");
        n || (n = s.attr("href"), n = n && n.replace(/.*(?=#[^\s]*$)/, ""));
        var a = t(n);
        e && e.preventDefault(), a.length || (a = s.closest(".alert")), a.trigger(e = t.Event("close.bs.alert")), e.isDefaultPrevented() || (a.removeClass("in"), t.support.transition && a.hasClass("fade") ? a.one("bsTransitionEnd", i).emulateTransitionEnd(o.TRANSITION_DURATION) : i())
    };
    var s = t.fn.alert;
    t.fn.alert = e, t.fn.alert.Constructor = o, t.fn.alert.noConflict = function () {
        return t.fn.alert = s, this
    }, t(document).on("click.bs.alert.data-api", i, o.prototype.close)
}(jQuery), +function (t) {
    "use strict";
    function e(e) {
        return this.each(function () {
            var o = t(this), s = o.data("bs.button"), n = "object" == typeof e && e;
            s || o.data("bs.button", s = new i(this, n)), "toggle" == e ? s.toggle() : e && s.setState(e)
        })
    }

    var i = function (e, o) {
        this.$element = t(e), this.options = t.extend({}, i.DEFAULTS, o), this.isLoading = !1
    };
    i.VERSION = "3.3.5", i.DEFAULTS = {loadingText: "loading..."}, i.prototype.setState = function (e) {
        var i = "disabled", o = this.$element, s = o.is("input") ? "val" : "html", n = o.data();
        e += "Text", null == n.resetText && o.data("resetText", o[s]()), setTimeout(t.proxy(function () {
            o[s](null == n[e] ? this.options[e] : n[e]), "loadingText" == e ? (this.isLoading = !0, o.addClass(i).attr(i, i)) : this.isLoading && (this.isLoading = !1, o.removeClass(i).removeAttr(i))
        }, this), 0)
    }, i.prototype.toggle = function () {
        var t = !0, e = this.$element.closest('[data-toggle="buttons"]');
        if (e.length) {
            var i = this.$element.find("input");
            "radio" == i.prop("type") ? (i.prop("checked") && (t = !1), e.find(".active").removeClass("active"), this.$element.addClass("active")) : "checkbox" == i.prop("type") && (i.prop("checked") !== this.$element.hasClass("active") && (t = !1), this.$element.toggleClass("active")), i.prop("checked", this.$element.hasClass("active")), t && i.trigger("change")
        } else this.$element.attr("aria-pressed", !this.$element.hasClass("active")), this.$element.toggleClass("active")
    };
    var o = t.fn.button;
    t.fn.button = e, t.fn.button.Constructor = i, t.fn.button.noConflict = function () {
        return t.fn.button = o, this
    }, t(document).on("click.bs.button.data-api", '[data-toggle^="button"]', function (i) {
        var o = t(i.target);
        o.hasClass("btn") || (o = o.closest(".btn")), e.call(o, "toggle"), t(i.target).is('input[type="radio"]') || t(i.target).is('input[type="checkbox"]') || i.preventDefault()
    }).on("focus.bs.button.data-api blur.bs.button.data-api", '[data-toggle^="button"]', function (e) {
        t(e.target).closest(".btn").toggleClass("focus", /^focus(in)?$/.test(e.type))
    })
}(jQuery), +function (t) {
    "use strict";
    function e(e) {
        return this.each(function () {
            var o = t(this), s = o.data("bs.carousel"), n = t.extend({}, i.DEFAULTS, o.data(), "object" == typeof e && e), a = "string" == typeof e ? e : n.slide;
            s || o.data("bs.carousel", s = new i(this, n)), "number" == typeof e ? s.to(e) : a ? s[a]() : n.interval && s.pause().cycle()
        })
    }

    var i = function (e, i) {
        this.$element = t(e), this.$indicators = this.$element.find(".carousel-indicators"), this.options = i, this.paused = null, this.sliding = null, this.interval = null, this.$active = null, this.$items = null, this.options.keyboard && this.$element.on("keydown.bs.carousel", t.proxy(this.keydown, this)), "hover" == this.options.pause && !("ontouchstart" in document.documentElement) && this.$element.on("mouseenter.bs.carousel", t.proxy(this.pause, this)).on("mouseleave.bs.carousel", t.proxy(this.cycle, this))
    };
    i.VERSION = "3.3.5", i.TRANSITION_DURATION = 600, i.DEFAULTS = {
        interval: 5e3,
        pause: "hover",
        wrap: !0,
        keyboard: !0
    }, i.prototype.keydown = function (t) {
        if (!/input|textarea/i.test(t.target.tagName)) {
            switch (t.which) {
                case 37:
                    this.prev();
                    break;
                case 39:
                    this.next();
                    break;
                default:
                    return
            }
            t.preventDefault()
        }
    }, i.prototype.cycle = function (e) {
        return e || (this.paused = !1), this.interval && clearInterval(this.interval), this.options.interval && !this.paused && (this.interval = setInterval(t.proxy(this.next, this), this.options.interval)), this
    }, i.prototype.getItemIndex = function (t) {
        return this.$items = t.parent().children(".item"), this.$items.index(t || this.$active)
    }, i.prototype.getItemForDirection = function (t, e) {
        var i = this.getItemIndex(e), o = "prev" == t && 0 === i || "next" == t && i == this.$items.length - 1;
        if (o && !this.options.wrap)return e;
        var s = "prev" == t ? -1 : 1, n = (i + s) % this.$items.length;
        return this.$items.eq(n)
    }, i.prototype.to = function (t) {
        var e = this, i = this.getItemIndex(this.$active = this.$element.find(".item.active"));
        return t > this.$items.length - 1 || 0 > t ? void 0 : this.sliding ? this.$element.one("slid.bs.carousel", function () {
            e.to(t)
        }) : i == t ? this.pause().cycle() : this.slide(t > i ? "next" : "prev", this.$items.eq(t))
    }, i.prototype.pause = function (e) {
        return e || (this.paused = !0), this.$element.find(".next, .prev").length && t.support.transition && (this.$element.trigger(t.support.transition.end), this.cycle(!0)), this.interval = clearInterval(this.interval), this
    }, i.prototype.next = function () {
        return this.sliding ? void 0 : this.slide("next")
    }, i.prototype.prev = function () {
        return this.sliding ? void 0 : this.slide("prev")
    }, i.prototype.slide = function (e, o) {
        var s = this.$element.find(".item.active"), n = o || this.getItemForDirection(e, s), a = this.interval, r = "next" == e ? "left" : "right", l = this;
        if (n.hasClass("active"))return this.sliding = !1;
        var h = n[0], d = t.Event("slide.bs.carousel", {relatedTarget: h, direction: r});
        if (this.$element.trigger(d), !d.isDefaultPrevented()) {
            if (this.sliding = !0, a && this.pause(), this.$indicators.length) {
                this.$indicators.find(".active").removeClass("active");
                var c = t(this.$indicators.children()[this.getItemIndex(n)]);
                c && c.addClass("active")
            }
            var p = t.Event("slid.bs.carousel", {relatedTarget: h, direction: r});
            return t.support.transition && this.$element.hasClass("slide") ? (n.addClass(e), n[0].offsetWidth, s.addClass(r), n.addClass(r), s.one("bsTransitionEnd", function () {
                n.removeClass([e, r].join(" ")).addClass("active"), s.removeClass(["active", r].join(" ")), l.sliding = !1, setTimeout(function () {
                    l.$element.trigger(p)
                }, 0)
            }).emulateTransitionEnd(i.TRANSITION_DURATION)) : (s.removeClass("active"), n.addClass("active"), this.sliding = !1, this.$element.trigger(p)), a && this.cycle(), this
        }
    };
    var o = t.fn.carousel;
    t.fn.carousel = e, t.fn.carousel.Constructor = i, t.fn.carousel.noConflict = function () {
        return t.fn.carousel = o, this
    };
    var s = function (i) {
        var o, s = t(this), n = t(s.attr("data-target") || (o = s.attr("href")) && o.replace(/.*(?=#[^\s]+$)/, ""));
        if (n.hasClass("carousel")) {
            var a = t.extend({}, n.data(), s.data()), r = s.attr("data-slide-to");
            r && (a.interval = !1), e.call(n, a), r && n.data("bs.carousel").to(r), i.preventDefault()
        }
    };
    t(document).on("click.bs.carousel.data-api", "[data-slide]", s).on("click.bs.carousel.data-api", "[data-slide-to]", s), t(window).on("load", function () {
        t('[data-ride="carousel"]').each(function () {
            var i = t(this);
            e.call(i, i.data())
        })
    })
}(jQuery), +function (t) {
    "use strict";
    function e(e) {
        var i, o = e.attr("data-target") || (i = e.attr("href")) && i.replace(/.*(?=#[^\s]+$)/, "");
        return t(o)
    }

    function i(e) {
        return this.each(function () {
            var i = t(this), s = i.data("bs.collapse"), n = t.extend({}, o.DEFAULTS, i.data(), "object" == typeof e && e);
            !s && n.toggle && /show|hide/.test(e) && (n.toggle = !1), s || i.data("bs.collapse", s = new o(this, n)), "string" == typeof e && s[e]()
        })
    }

    var o = function (e, i) {
        this.$element = t(e), this.options = t.extend({}, o.DEFAULTS, i), this.$trigger = t('[data-toggle="collapse"][href="#' + e.id + '"],[data-toggle="collapse"][data-target="#' + e.id + '"]'), this.transitioning = null, this.options.parent ? this.$parent = this.getParent() : this.addAriaAndCollapsedClass(this.$element, this.$trigger), this.options.toggle && this.toggle()
    };
    o.VERSION = "3.3.5", o.TRANSITION_DURATION = 350, o.DEFAULTS = {toggle: !0}, o.prototype.dimension = function () {
        var t = this.$element.hasClass("width");
        return t ? "width" : "height"
    }, o.prototype.show = function () {
        if (!this.transitioning && !this.$element.hasClass("in")) {
            var e, s = this.$parent && this.$parent.children(".panel").children(".in, .collapsing");
            if (!(s && s.length && (e = s.data("bs.collapse"), e && e.transitioning))) {
                var n = t.Event("show.bs.collapse");
                if (this.$element.trigger(n), !n.isDefaultPrevented()) {
                    s && s.length && (i.call(s, "hide"), e || s.data("bs.collapse", null));
                    var a = this.dimension();
                    this.$element.removeClass("collapse").addClass("collapsing")[a](0).attr("aria-expanded", !0), this.$trigger.removeClass("collapsed").attr("aria-expanded", !0), this.transitioning = 1;
                    var r = function () {
                        this.$element.removeClass("collapsing").addClass("collapse in")[a](""), this.transitioning = 0, this.$element.trigger("shown.bs.collapse")
                    };
                    if (!t.support.transition)return r.call(this);
                    var l = t.camelCase(["scroll", a].join("-"));
                    this.$element.one("bsTransitionEnd", t.proxy(r, this)).emulateTransitionEnd(o.TRANSITION_DURATION)[a](this.$element[0][l])
                }
            }
        }
    }, o.prototype.hide = function () {
        if (!this.transitioning && this.$element.hasClass("in")) {
            var e = t.Event("hide.bs.collapse");
            if (this.$element.trigger(e), !e.isDefaultPrevented()) {
                var i = this.dimension();
                this.$element[i](this.$element[i]())[0].offsetHeight, this.$element.addClass("collapsing").removeClass("collapse in").attr("aria-expanded", !1), this.$trigger.addClass("collapsed").attr("aria-expanded", !1), this.transitioning = 1;
                var s = function () {
                    this.transitioning = 0, this.$element.removeClass("collapsing").addClass("collapse").trigger("hidden.bs.collapse")
                };
                return t.support.transition ? void this.$element[i](0).one("bsTransitionEnd", t.proxy(s, this)).emulateTransitionEnd(o.TRANSITION_DURATION) : s.call(this)
            }
        }
    }, o.prototype.toggle = function () {
        this[this.$element.hasClass("in") ? "hide" : "show"]()
    }, o.prototype.getParent = function () {
        return t(this.options.parent).find('[data-toggle="collapse"][data-parent="' + this.options.parent + '"]').each(t.proxy(function (i, o) {
            var s = t(o);
            this.addAriaAndCollapsedClass(e(s), s)
        }, this)).end()
    }, o.prototype.addAriaAndCollapsedClass = function (t, e) {
        var i = t.hasClass("in");
        t.attr("aria-expanded", i), e.toggleClass("collapsed", !i).attr("aria-expanded", i)
    };
    var s = t.fn.collapse;
    t.fn.collapse = i, t.fn.collapse.Constructor = o, t.fn.collapse.noConflict = function () {
        return t.fn.collapse = s, this
    }, t(document).on("click.bs.collapse.data-api", '[data-toggle="collapse"]', function (o) {
        var s = t(this);
        s.attr("data-target") || o.preventDefault();
        var n = e(s), a = n.data("bs.collapse"), r = a ? "toggle" : s.data();
        i.call(n, r)
    })
}(jQuery), +function (t) {
    "use strict";
    function e(e) {
        var i = e.attr("data-target");
        i || (i = e.attr("href"), i = i && /#[A-Za-z]/.test(i) && i.replace(/.*(?=#[^\s]*$)/, ""));
        var o = i && t(i);
        return o && o.length ? o : e.parent()
    }

    function i(i) {
        i && 3 === i.which || (t(s).remove(), t(n).each(function () {
            var o = t(this), s = e(o), n = {relatedTarget: this};
            s.hasClass("open") && (i && "click" == i.type && /input|textarea/i.test(i.target.tagName) && t.contains(s[0], i.target) || (s.trigger(i = t.Event("hide.bs.dropdown", n)), i.isDefaultPrevented() || (o.attr("aria-expanded", "false"), s.removeClass("open").trigger("hidden.bs.dropdown", n))))
        }))
    }

    function o(e) {
        return this.each(function () {
            var i = t(this), o = i.data("bs.dropdown");
            o || i.data("bs.dropdown", o = new a(this)), "string" == typeof e && o[e].call(i)
        })
    }

    var s = ".dropdown-backdrop", n = '[data-toggle="dropdown"]', a = function (e) {
        t(e).on("click.bs.dropdown", this.toggle)
    };
    a.VERSION = "3.3.5", a.prototype.toggle = function (o) {
        var s = t(this);
        if (!s.is(".disabled, :disabled")) {
            var n = e(s), a = n.hasClass("open");
            if (i(), !a) {
                "ontouchstart" in document.documentElement && !n.closest(".navbar-nav").length && t(document.createElement("div")).addClass("dropdown-backdrop").insertAfter(t(this)).on("click", i);
                var r = {relatedTarget: this};
                if (n.trigger(o = t.Event("show.bs.dropdown", r)), o.isDefaultPrevented())return;
                s.trigger("focus").attr("aria-expanded", "true"), n.toggleClass("open").trigger("shown.bs.dropdown", r)
            }
            return !1
        }
    }, a.prototype.keydown = function (i) {
        if (/(38|40|27|32)/.test(i.which) && !/input|textarea/i.test(i.target.tagName)) {
            var o = t(this);
            if (i.preventDefault(), i.stopPropagation(), !o.is(".disabled, :disabled")) {
                var s = e(o), a = s.hasClass("open");
                if (!a && 27 != i.which || a && 27 == i.which)return 27 == i.which && s.find(n).trigger("focus"), o.trigger("click");
                var r = " li:not(.disabled):visible a", l = s.find(".dropdown-menu" + r);
                if (l.length) {
                    var h = l.index(i.target);
                    38 == i.which && h > 0 && h--, 40 == i.which && h < l.length - 1 && h++, ~h || (h = 0), l.eq(h).trigger("focus")
                }
            }
        }
    };
    var r = t.fn.dropdown;
    t.fn.dropdown = o, t.fn.dropdown.Constructor = a, t.fn.dropdown.noConflict = function () {
        return t.fn.dropdown = r, this
    }, t(document).on("click.bs.dropdown.data-api", i).on("click.bs.dropdown.data-api", ".dropdown form", function (t) {
        t.stopPropagation()
    }).on("click.bs.dropdown.data-api", n, a.prototype.toggle).on("keydown.bs.dropdown.data-api", n, a.prototype.keydown).on("keydown.bs.dropdown.data-api", ".dropdown-menu", a.prototype.keydown)
}(jQuery), +function (t) {
    "use strict";
    function e(e, o) {
        return this.each(function () {
            var s = t(this), n = s.data("bs.modal"), a = t.extend({}, i.DEFAULTS, s.data(), "object" == typeof e && e);
            n || s.data("bs.modal", n = new i(this, a)), "string" == typeof e ? n[e](o) : a.show && n.show(o)
        })
    }

    var i = function (e, i) {
        this.options = i, this.$body = t(document.body), this.$element = t(e), this.$dialog = this.$element.find(".modal-dialog"), this.$backdrop = null, this.isShown = null, this.originalBodyPad = null, this.scrollbarWidth = 0, this.ignoreBackdropClick = !1, this.options.remote && this.$element.find(".modal-content").load(this.options.remote, t.proxy(function () {
            this.$element.trigger("loaded.bs.modal")
        }, this))
    };
    i.VERSION = "3.3.5", i.TRANSITION_DURATION = 300, i.BACKDROP_TRANSITION_DURATION = 150, i.DEFAULTS = {
        backdrop: !0,
        keyboard: !0,
        show: !0
    }, i.prototype.toggle = function (t) {
        return this.isShown ? this.hide() : this.show(t)
    }, i.prototype.show = function (e) {
        var o = this, s = t.Event("show.bs.modal", {relatedTarget: e});
        this.$element.trigger(s), this.isShown || s.isDefaultPrevented() || (this.isShown = !0, this.checkScrollbar(), this.setScrollbar(), this.$body.addClass("modal-open"), this.escape(), this.resize(), this.$element.on("click.dismiss.bs.modal", '[data-dismiss="modal"]', t.proxy(this.hide, this)), this.$dialog.on("mousedown.dismiss.bs.modal", function () {
            o.$element.one("mouseup.dismiss.bs.modal", function (e) {
                t(e.target).is(o.$element) && (o.ignoreBackdropClick = !0)
            })
        }), this.backdrop(function () {
            var s = t.support.transition && o.$element.hasClass("fade");
            o.$element.parent().length || o.$element.appendTo(o.$body), o.$element.show().scrollTop(0), o.adjustDialog(), s && o.$element[0].offsetWidth, o.$element.addClass("in"), o.enforceFocus();
            var n = t.Event("shown.bs.modal", {relatedTarget: e});
            s ? o.$dialog.one("bsTransitionEnd", function () {
                o.$element.trigger("focus").trigger(n)
            }).emulateTransitionEnd(i.TRANSITION_DURATION) : o.$element.trigger("focus").trigger(n)
        }))
    }, i.prototype.hide = function (e) {
        e && e.preventDefault(), e = t.Event("hide.bs.modal"), this.$element.trigger(e), this.isShown && !e.isDefaultPrevented() && (this.isShown = !1, this.escape(), this.resize(), t(document).off("focusin.bs.modal"), this.$element.removeClass("in").off("click.dismiss.bs.modal").off("mouseup.dismiss.bs.modal"), this.$dialog.off("mousedown.dismiss.bs.modal"), t.support.transition && this.$element.hasClass("fade") ? this.$element.one("bsTransitionEnd", t.proxy(this.hideModal, this)).emulateTransitionEnd(i.TRANSITION_DURATION) : this.hideModal())
    }, i.prototype.enforceFocus = function () {
        t(document).off("focusin.bs.modal").on("focusin.bs.modal", t.proxy(function (t) {
            this.$element[0] === t.target || this.$element.has(t.target).length || this.$element.trigger("focus")
        }, this))
    }, i.prototype.escape = function () {
        this.isShown && this.options.keyboard ? this.$element.on("keydown.dismiss.bs.modal", t.proxy(function (t) {
            27 == t.which && this.hide()
        }, this)) : this.isShown || this.$element.off("keydown.dismiss.bs.modal")
    }, i.prototype.resize = function () {
        this.isShown ? t(window).on("resize.bs.modal", t.proxy(this.handleUpdate, this)) : t(window).off("resize.bs.modal")
    }, i.prototype.hideModal = function () {
        var t = this;
        this.$element.hide(), this.backdrop(function () {
            t.$body.removeClass("modal-open"), t.resetAdjustments(), t.resetScrollbar(), t.$element.trigger("hidden.bs.modal")
        })
    }, i.prototype.removeBackdrop = function () {
        this.$backdrop && this.$backdrop.remove(), this.$backdrop = null
    }, i.prototype.backdrop = function (e) {
        var o = this, s = this.$element.hasClass("fade") ? "fade" : "";
        if (this.isShown && this.options.backdrop) {
            var n = t.support.transition && s;
            if (this.$backdrop = t(document.createElement("div")).addClass("modal-backdrop " + s).appendTo(this.$body), this.$element.on("click.dismiss.bs.modal", t.proxy(function (t) {
                    return this.ignoreBackdropClick ? void(this.ignoreBackdropClick = !1) : void(t.target === t.currentTarget && ("static" == this.options.backdrop ? this.$element[0].focus() : this.hide()))
                }, this)), n && this.$backdrop[0].offsetWidth, this.$backdrop.addClass("in"), !e)return;
            n ? this.$backdrop.one("bsTransitionEnd", e).emulateTransitionEnd(i.BACKDROP_TRANSITION_DURATION) : e()
        } else if (!this.isShown && this.$backdrop) {
            this.$backdrop.removeClass("in");
            var a = function () {
                o.removeBackdrop(), e && e()
            };
            t.support.transition && this.$element.hasClass("fade") ? this.$backdrop.one("bsTransitionEnd", a).emulateTransitionEnd(i.BACKDROP_TRANSITION_DURATION) : a()
        } else e && e()
    }, i.prototype.handleUpdate = function () {
        this.adjustDialog()
    }, i.prototype.adjustDialog = function () {
        var t = this.$element[0].scrollHeight > document.documentElement.clientHeight;
        this.$element.css({
            paddingLeft: !this.bodyIsOverflowing && t ? this.scrollbarWidth : "",
            paddingRight: this.bodyIsOverflowing && !t ? this.scrollbarWidth : ""
        })
    }, i.prototype.resetAdjustments = function () {
        this.$element.css({paddingLeft: "", paddingRight: ""})
    }, i.prototype.checkScrollbar = function () {
        var t = window.innerWidth;
        if (!t) {
            var e = document.documentElement.getBoundingClientRect();
            t = e.right - Math.abs(e.left)
        }
        this.bodyIsOverflowing = document.body.clientWidth < t, this.scrollbarWidth = this.measureScrollbar()
    }, i.prototype.setScrollbar = function () {
        var t = parseInt(this.$body.css("padding-right") || 0, 10);
        this.originalBodyPad = document.body.style.paddingRight || "", this.bodyIsOverflowing && this.$body.css("padding-right", t + this.scrollbarWidth)
    }, i.prototype.resetScrollbar = function () {
        this.$body.css("padding-right", this.originalBodyPad)
    }, i.prototype.measureScrollbar = function () {
        var t = document.createElement("div");
        t.className = "modal-scrollbar-measure", this.$body.append(t);
        var e = t.offsetWidth - t.clientWidth;
        return this.$body[0].removeChild(t), e
    };
    var o = t.fn.modal;
    t.fn.modal = e, t.fn.modal.Constructor = i, t.fn.modal.noConflict = function () {
        return t.fn.modal = o, this
    }, t(document).on("click.bs.modal.data-api", '[data-toggle="modal"]', function (i) {
        var o = t(this), s = o.attr("href"), n = t(o.attr("data-target") || s && s.replace(/.*(?=#[^\s]+$)/, "")), a = n.data("bs.modal") ? "toggle" : t.extend({remote: !/#/.test(s) && s}, n.data(), o.data());
        o.is("a") && i.preventDefault(), n.one("show.bs.modal", function (t) {
            t.isDefaultPrevented() || n.one("hidden.bs.modal", function () {
                o.is(":visible") && o.trigger("focus")
            })
        }), e.call(n, a, this)
    })
}(jQuery), +function (t) {
    "use strict";
    function e(e) {
        return this.each(function () {
            var o = t(this), s = o.data("bs.tooltip"), n = "object" == typeof e && e;
            (s || !/destroy|hide/.test(e)) && (s || o.data("bs.tooltip", s = new i(this, n)), "string" == typeof e && s[e]())
        })
    }

    var i = function (t, e) {
        this.type = null, this.options = null, this.enabled = null, this.timeout = null, this.hoverState = null, this.$element = null, this.inState = null, this.init("tooltip", t, e)
    };
    i.VERSION = "3.3.5", i.TRANSITION_DURATION = 150, i.DEFAULTS = {
        animation: !0,
        placement: "top",
        selector: !1,
        template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
        trigger: "hover focus",
        title: "",
        delay: 0,
        html: !1,
        container: !1,
        viewport: {selector: "body", padding: 0}
    }, i.prototype.init = function (e, i, o) {
        if (this.enabled = !0, this.type = e, this.$element = t(i), this.options = this.getOptions(o), this.$viewport = this.options.viewport && t(t.isFunction(this.options.viewport) ? this.options.viewport.call(this, this.$element) : this.options.viewport.selector || this.options.viewport), this.inState = {
                click: !1,
                hover: !1,
                focus: !1
            }, this.$element[0] instanceof document.constructor && !this.options.selector)throw new Error("`selector` option must be specified when initializing " + this.type + " on the window.document object!");
        for (var s = this.options.trigger.split(" "), n = s.length; n--;) {
            var a = s[n];
            if ("click" == a)this.$element.on("click." + this.type, this.options.selector, t.proxy(this.toggle, this)); else if ("manual" != a) {
                var r = "hover" == a ? "mouseenter" : "focusin", l = "hover" == a ? "mouseleave" : "focusout";
                this.$element.on(r + "." + this.type, this.options.selector, t.proxy(this.enter, this)), this.$element.on(l + "." + this.type, this.options.selector, t.proxy(this.leave, this))
            }
        }
        this.options.selector ? this._options = t.extend({}, this.options, {
            trigger: "manual",
            selector: ""
        }) : this.fixTitle()
    }, i.prototype.getDefaults = function () {
        return i.DEFAULTS
    }, i.prototype.getOptions = function (e) {
        return e = t.extend({}, this.getDefaults(), this.$element.data(), e), e.delay && "number" == typeof e.delay && (e.delay = {
            show: e.delay,
            hide: e.delay
        }), e
    }, i.prototype.getDelegateOptions = function () {
        var e = {}, i = this.getDefaults();
        return this._options && t.each(this._options, function (t, o) {
            i[t] != o && (e[t] = o)
        }), e
    }, i.prototype.enter = function (e) {
        var i = e instanceof this.constructor ? e : t(e.currentTarget).data("bs." + this.type);
        return i || (i = new this.constructor(e.currentTarget, this.getDelegateOptions()), t(e.currentTarget).data("bs." + this.type, i)), e instanceof t.Event && (i.inState["focusin" == e.type ? "focus" : "hover"] = !0), i.tip().hasClass("in") || "in" == i.hoverState ? void(i.hoverState = "in") : (clearTimeout(i.timeout), i.hoverState = "in", i.options.delay && i.options.delay.show ? void(i.timeout = setTimeout(function () {
            "in" == i.hoverState && i.show()
        }, i.options.delay.show)) : i.show())
    }, i.prototype.isInStateTrue = function () {
        for (var t in this.inState)if (this.inState[t])return !0;
        return !1
    }, i.prototype.leave = function (e) {
        var i = e instanceof this.constructor ? e : t(e.currentTarget).data("bs." + this.type);
        return i || (i = new this.constructor(e.currentTarget, this.getDelegateOptions()), t(e.currentTarget).data("bs." + this.type, i)), e instanceof t.Event && (i.inState["focusout" == e.type ? "focus" : "hover"] = !1), i.isInStateTrue() ? void 0 : (clearTimeout(i.timeout), i.hoverState = "out", i.options.delay && i.options.delay.hide ? void(i.timeout = setTimeout(function () {
            "out" == i.hoverState && i.hide()
        }, i.options.delay.hide)) : i.hide())
    }, i.prototype.show = function () {
        var e = t.Event("show.bs." + this.type);
        if (this.hasContent() && this.enabled) {
            this.$element.trigger(e);
            var o = t.contains(this.$element[0].ownerDocument.documentElement, this.$element[0]);
            if (e.isDefaultPrevented() || !o)return;
            var s = this, n = this.tip(), a = this.getUID(this.type);
            this.setContent(), n.attr("id", a), this.$element.attr("aria-describedby", a), this.options.animation && n.addClass("fade");
            var r = "function" == typeof this.options.placement ? this.options.placement.call(this, n[0], this.$element[0]) : this.options.placement, l = /\s?auto?\s?/i, h = l.test(r);
            h && (r = r.replace(l, "") || "top"), n.detach().css({
                top: 0,
                left: 0,
                display: "block"
            }).addClass(r).data("bs." + this.type, this), this.options.container ? n.appendTo(this.options.container) : n.insertAfter(this.$element), this.$element.trigger("inserted.bs." + this.type);
            var d = this.getPosition(), c = n[0].offsetWidth, p = n[0].offsetHeight;
            if (h) {
                var f = r, u = this.getPosition(this.$viewport);
                r = "bottom" == r && d.bottom + p > u.bottom ? "top" : "top" == r && d.top - p < u.top ? "bottom" : "right" == r && d.right + c > u.width ? "left" : "left" == r && d.left - c < u.left ? "right" : r, n.removeClass(f).addClass(r)
            }
            var g = this.getCalculatedOffset(r, d, c, p);
            this.applyPlacement(g, r);
            var m = function () {
                var t = s.hoverState;
                s.$element.trigger("shown.bs." + s.type), s.hoverState = null, "out" == t && s.leave(s)
            };
            t.support.transition && this.$tip.hasClass("fade") ? n.one("bsTransitionEnd", m).emulateTransitionEnd(i.TRANSITION_DURATION) : m()
        }
    }, i.prototype.applyPlacement = function (e, i) {
        var o = this.tip(), s = o[0].offsetWidth, n = o[0].offsetHeight, a = parseInt(o.css("margin-top"), 10), r = parseInt(o.css("margin-left"), 10);
        isNaN(a) && (a = 0), isNaN(r) && (r = 0), e.top += a, e.left += r, t.offset.setOffset(o[0], t.extend({
            using: function (t) {
                o.css({top: Math.round(t.top), left: Math.round(t.left)})
            }
        }, e), 0), o.addClass("in");
        var l = o[0].offsetWidth, h = o[0].offsetHeight;
        "top" == i && h != n && (e.top = e.top + n - h);
        var d = this.getViewportAdjustedDelta(i, e, l, h);
        d.left ? e.left += d.left : e.top += d.top;
        var c = /top|bottom/.test(i), p = c ? 2 * d.left - s + l : 2 * d.top - n + h, f = c ? "offsetWidth" : "offsetHeight";
        o.offset(e), this.replaceArrow(p, o[0][f], c)
    }, i.prototype.replaceArrow = function (t, e, i) {
        this.arrow().css(i ? "left" : "top", 50 * (1 - t / e) + "%").css(i ? "top" : "left", "")
    }, i.prototype.setContent = function () {
        var t = this.tip(), e = this.getTitle();
        t.find(".tooltip-inner")[this.options.html ? "html" : "text"](e), t.removeClass("fade in top bottom left right")
    }, i.prototype.hide = function (e) {
        function o() {
            "in" != s.hoverState && n.detach(), s.$element.removeAttr("aria-describedby").trigger("hidden.bs." + s.type), e && e()
        }

        var s = this, n = t(this.$tip), a = t.Event("hide.bs." + this.type);
        return this.$element.trigger(a), a.isDefaultPrevented() ? void 0 : (n.removeClass("in"), t.support.transition && n.hasClass("fade") ? n.one("bsTransitionEnd", o).emulateTransitionEnd(i.TRANSITION_DURATION) : o(), this.hoverState = null, this)
    }, i.prototype.fixTitle = function () {
        var t = this.$element;
        (t.attr("title") || "string" != typeof t.attr("data-original-title")) && t.attr("data-original-title", t.attr("title") || "").attr("title", "")
    }, i.prototype.hasContent = function () {
        return this.getTitle()
    }, i.prototype.getPosition = function (e) {
        e = e || this.$element;
        var i = e[0], o = "BODY" == i.tagName, s = i.getBoundingClientRect();
        null == s.width && (s = t.extend({}, s, {width: s.right - s.left, height: s.bottom - s.top}));
        var n = o ? {
            top: 0,
            left: 0
        } : e.offset(), a = {scroll: o ? document.documentElement.scrollTop || document.body.scrollTop : e.scrollTop()}, r = o ? {
            width: t(window).width(),
            height: t(window).height()
        } : null;
        return t.extend({}, s, a, r, n)
    }, i.prototype.getCalculatedOffset = function (t, e, i, o) {
        return "bottom" == t ? {
            top: e.top + e.height,
            left: e.left + e.width / 2 - i / 2
        } : "top" == t ? {
            top: e.top - o,
            left: e.left + e.width / 2 - i / 2
        } : "left" == t ? {top: e.top + e.height / 2 - o / 2, left: e.left - i} : {
            top: e.top + e.height / 2 - o / 2,
            left: e.left + e.width
        }
    }, i.prototype.getViewportAdjustedDelta = function (t, e, i, o) {
        var s = {top: 0, left: 0};
        if (!this.$viewport)return s;
        var n = this.options.viewport && this.options.viewport.padding || 0, a = this.getPosition(this.$viewport);
        if (/right|left/.test(t)) {
            var r = e.top - n - a.scroll, l = e.top + n - a.scroll + o;
            r < a.top ? s.top = a.top - r : l > a.top + a.height && (s.top = a.top + a.height - l)
        } else {
            var h = e.left - n, d = e.left + n + i;
            h < a.left ? s.left = a.left - h : d > a.right && (s.left = a.left + a.width - d)
        }
        return s
    }, i.prototype.getTitle = function () {
        var t, e = this.$element, i = this.options;
        return t = e.attr("data-original-title") || ("function" == typeof i.title ? i.title.call(e[0]) : i.title)
    }, i.prototype.getUID = function (t) {
        do t += ~~(1e6 * Math.random()); while (document.getElementById(t));
        return t
    }, i.prototype.tip = function () {
        if (!this.$tip && (this.$tip = t(this.options.template), 1 != this.$tip.length))throw new Error(this.type + " `template` option must consist of exactly 1 top-level element!");
        return this.$tip
    }, i.prototype.arrow = function () {
        return this.$arrow = this.$arrow || this.tip().find(".tooltip-arrow")
    }, i.prototype.enable = function () {
        this.enabled = !0
    }, i.prototype.disable = function () {
        this.enabled = !1
    }, i.prototype.toggleEnabled = function () {
        this.enabled = !this.enabled
    }, i.prototype.toggle = function (e) {
        var i = this;
        e && (i = t(e.currentTarget).data("bs." + this.type), i || (i = new this.constructor(e.currentTarget, this.getDelegateOptions()), t(e.currentTarget).data("bs." + this.type, i))), e ? (i.inState.click = !i.inState.click, i.isInStateTrue() ? i.enter(i) : i.leave(i)) : i.tip().hasClass("in") ? i.leave(i) : i.enter(i)
    }, i.prototype.destroy = function () {
        var t = this;
        clearTimeout(this.timeout), this.hide(function () {
            t.$element.off("." + t.type).removeData("bs." + t.type), t.$tip && t.$tip.detach(), t.$tip = null, t.$arrow = null, t.$viewport = null
        })
    };
    var o = t.fn.tooltip;
    t.fn.tooltip = e, t.fn.tooltip.Constructor = i, t.fn.tooltip.noConflict = function () {
        return t.fn.tooltip = o, this
    }
}(jQuery), +function (t) {
    "use strict";
    function e(e) {
        return this.each(function () {
            var o = t(this), s = o.data("bs.popover"), n = "object" == typeof e && e;
            (s || !/destroy|hide/.test(e)) && (s || o.data("bs.popover", s = new i(this, n)), "string" == typeof e && s[e]())
        })
    }

    var i = function (t, e) {
        this.init("popover", t, e)
    };
    if (!t.fn.tooltip)throw new Error("Popover requires tooltip.js");
    i.VERSION = "3.3.5", i.DEFAULTS = t.extend({}, t.fn.tooltip.Constructor.DEFAULTS, {
        placement: "right",
        trigger: "click",
        content: "",
        template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
    }), i.prototype = t.extend({}, t.fn.tooltip.Constructor.prototype), i.prototype.constructor = i, i.prototype.getDefaults = function () {
        return i.DEFAULTS
    }, i.prototype.setContent = function () {
        var t = this.tip(), e = this.getTitle(), i = this.getContent();
        t.find(".popover-title")[this.options.html ? "html" : "text"](e), t.find(".popover-content").children().detach().end()[this.options.html ? "string" == typeof i ? "html" : "append" : "text"](i), t.removeClass("fade top bottom left right in"), t.find(".popover-title").html() || t.find(".popover-title").hide()
    }, i.prototype.hasContent = function () {
        return this.getTitle() || this.getContent()
    }, i.prototype.getContent = function () {
        var t = this.$element, e = this.options;
        return t.attr("data-content") || ("function" == typeof e.content ? e.content.call(t[0]) : e.content)
    }, i.prototype.arrow = function () {
        return this.$arrow = this.$arrow || this.tip().find(".arrow");

    };
    var o = t.fn.popover;
    t.fn.popover = e, t.fn.popover.Constructor = i, t.fn.popover.noConflict = function () {
        return t.fn.popover = o, this
    }
}(jQuery), +function (t) {
    "use strict";
    function e(i, o) {
        this.$body = t(document.body), this.$scrollElement = t(t(i).is(document.body) ? window : i), this.options = t.extend({}, e.DEFAULTS, o), this.selector = this.options.selector || (this.options.target || "") + " .nav li > a", this.offsets = [], this.targets = [], this.activeTarget = null, this.scrollHeight = 0, this.$scrollElement.on("scroll.bs.scrollspy", t.proxy(this.process, this)), this.refresh(), this.process()
    }

    function i(i) {
        return this.each(function () {
            var o = t(this), s = o.data("bs.scrollspy"), n = "object" == typeof i && i;
            s || o.data("bs.scrollspy", s = new e(this, n)), "string" == typeof i && s[i]()
        })
    }

    e.VERSION = "3.3.5", e.DEFAULTS = {offset: 10}, e.prototype.getScrollHeight = function () {
        return this.$scrollElement[0].scrollHeight || Math.max(this.$body[0].scrollHeight, document.documentElement.scrollHeight)
    }, e.prototype.refresh = function () {
        var e = this, i = "offset", o = 0;
        this.offsets = [], this.targets = [], this.scrollHeight = this.getScrollHeight(), t.isWindow(this.$scrollElement[0]) || (i = "position", o = this.$scrollElement.scrollTop()), this.$body.find(this.selector).map(function () {
            var e = t(this), s = e.data("target") || e.attr("href"), n = /^#./.test(s) && t(s);
            return n && n.length && n.is(":visible") && [[n[i]().top + o, s]] || null
        }).sort(function (t, e) {
            return t[0] - e[0]
        }).each(function () {
            e.offsets.push(this[0]), e.targets.push(this[1])
        })
    }, e.prototype.process = function () {
        var t, e = this.$scrollElement.scrollTop() + this.options.offset, i = this.getScrollHeight(), o = this.options.offset + i - this.$scrollElement.height(), s = this.offsets, n = this.targets, a = this.activeTarget;
        if (this.scrollHeight != i && this.refresh(), e >= o)return a != (t = n[n.length - 1]) && this.activate(t);
        if (a && e < s[0])return this.activeTarget = null, this.clear();
        for (t = s.length; t--;)a != n[t] && e >= s[t] && (void 0 === s[t + 1] || e < s[t + 1]) && this.activate(n[t])
    }, e.prototype.activate = function (e) {
        this.activeTarget = e, this.clear();
        var i = this.selector + '[data-target="' + e + '"],' + this.selector + '[href="' + e + '"]', o = t(i).parents("li").addClass("active");
        o.parent(".dropdown-menu").length && (o = o.closest("li.dropdown").addClass("active")), o.trigger("activate.bs.scrollspy")
    }, e.prototype.clear = function () {
        t(this.selector).parentsUntil(this.options.target, ".active").removeClass("active")
    };
    var o = t.fn.scrollspy;
    t.fn.scrollspy = i, t.fn.scrollspy.Constructor = e, t.fn.scrollspy.noConflict = function () {
        return t.fn.scrollspy = o, this
    }, t(window).on("load.bs.scrollspy.data-api", function () {
        t('[data-spy="scroll"]').each(function () {
            var e = t(this);
            i.call(e, e.data())
        })
    })
}(jQuery), +function (t) {
    "use strict";
    function e(e) {
        return this.each(function () {
            var o = t(this), s = o.data("bs.tab");
            s || o.data("bs.tab", s = new i(this)), "string" == typeof e && s[e]()
        })
    }

    var i = function (e) {
        this.element = t(e)
    };
    i.VERSION = "3.3.5", i.TRANSITION_DURATION = 150, i.prototype.show = function () {
        var e = this.element, i = e.closest("ul:not(.dropdown-menu)"), o = e.data("target");
        if (o || (o = e.attr("href"), o = o && o.replace(/.*(?=#[^\s]*$)/, "")), !e.parent("li").hasClass("active")) {
            var s = i.find(".active:last a"), n = t.Event("hide.bs.tab", {relatedTarget: e[0]}), a = t.Event("show.bs.tab", {relatedTarget: s[0]});
            if (s.trigger(n), e.trigger(a), !a.isDefaultPrevented() && !n.isDefaultPrevented()) {
                var r = t(o);
                this.activate(e.closest("li"), i), this.activate(r, r.parent(), function () {
                    s.trigger({type: "hidden.bs.tab", relatedTarget: e[0]}), e.trigger({
                        type: "shown.bs.tab",
                        relatedTarget: s[0]
                    })
                })
            }
        }
    }, i.prototype.activate = function (e, o, s) {
        function n() {
            a.removeClass("active").find("> .dropdown-menu > .active").removeClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded", !1), e.addClass("active").find('[data-toggle="tab"]').attr("aria-expanded", !0), r ? (e[0].offsetWidth, e.addClass("in")) : e.removeClass("fade"), e.parent(".dropdown-menu").length && e.closest("li.dropdown").addClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded", !0), s && s()
        }

        var a = o.find("> .active"), r = s && t.support.transition && (a.length && a.hasClass("fade") || !!o.find("> .fade").length);
        a.length && r ? a.one("bsTransitionEnd", n).emulateTransitionEnd(i.TRANSITION_DURATION) : n(), a.removeClass("in")
    };
    var o = t.fn.tab;
    t.fn.tab = e, t.fn.tab.Constructor = i, t.fn.tab.noConflict = function () {
        return t.fn.tab = o, this
    };
    var s = function (i) {
        i.preventDefault(), e.call(t(this), "show")
    };
    t(document).on("click.bs.tab.data-api", '[data-toggle="tab"]', s).on("click.bs.tab.data-api", '[data-toggle="pill"]', s)
}(jQuery), +function (t) {
    "use strict";
    function e(e) {
        return this.each(function () {
            var o = t(this), s = o.data("bs.image-grid"), n = t.extend({}, i.DEFAULTS, o.data(), "object" == typeof e && e);
            s || o.data("bs.image-grid", s = new i(this, n)), "string" == typeof e && s[e].call(o)
        })
    }

    var i = function (e, o) {
        this.cleanWhitespace(e), this.row = 0, this.rownum = 1, this.elements = [], this.element = e, this.albumWidth = t(e).width(), this.images = t(e).children(), this.options = t.extend({}, i.DEFAULTS, o), t(window).on("resize", t.proxy(this.handleResize, this)), this.processImages()
    };
    i.VERSION = "3.3.1", i.TRANSITION_DURATION = 350, i.DEFAULTS = {
        padding: 10,
        targetHeight: 300,
        display: "inline-block"
    }, i.prototype.handleResize = function () {
        this.row = 0, this.rownum = 1, this.elements = [], this.albumWidth = t(this.element).width(), this.images = t(this.element).children(), this.processImages()
    }, i.prototype.processImages = function () {
        var e = this;
        this.images.each(function (i) {
            var o = t(this), s = o.is("img") ? o : o.find("img"), n = "undefined" != typeof s.data("width") ? s.data("width") : s.width(), a = "undefined" != typeof s.data("height") ? s.data("height") : s.height();
            s.data("width", n), s.data("height", a);
            var r = Math.ceil(n / a * e.options.targetHeight), l = Math.ceil(e.options.targetHeight);
            e.elements.push([this, r, l]), e.row += r + e.options.padding, e.row > e.albumWidth && e.elements.length && (e.resizeRow(e.row - e.options.padding), e.row = 0, e.elements = [], e.rownum += 1), e.images.length - 1 == i && e.elements.length && (e.resizeRow(e.row), e.row = 0, e.elements = [], e.rownum += 1)
        })
    }, i.prototype.resizeRow = function (e) {
        for (var i = this.options.padding * (this.elements.length - 1), o = this.albumWidth - i, s = o / (e - i), n = i, a = (e < this.albumWidth, 0); a < this.elements.length; a++) {
            var r = t(this.elements[a][0]), l = Math.floor(this.elements[a][1] * s), h = Math.floor(this.elements[a][2] * s), d = a < this.elements.length - 1;
            n += l, !d && n < this.albumWidth && (l += this.albumWidth - n), l--;
            var c = r.is("img") ? r : r.find("img");
            c.width(l), c.height(h), this.applyModifications(r, d)
        }
    }, i.prototype.applyModifications = function (t, e) {
        var i = {
            "margin-bottom": this.options.padding + "px",
            "margin-right": e ? this.options.padding + "px" : 0,
            display: this.options.display,
            "vertical-align": "bottom"
        };
        t.css(i)
    }, i.prototype.cleanWhitespace = function (e) {
        t(e).contents().filter(function () {
            return 3 == this.nodeType && !/\S/.test(this.nodeValue)
        }).remove()
    };
    var o = t.fn.imageGrid;
    t.fn.imageGrid = e, t.fn.imageGrid.Constructor = i, t.fn.imageGrid.noConflict = function () {
        return t.fn.imageGrid = o, this
    }, t(function () {
        t('[data-grid="images"]').imageGrid()
    })
}(jQuery), +function (t) {
    "use strict";
    function e() {
        this._activeZoom = this._initialScrollPosition = this._initialTouchPosition = this._touchMoveListener = null, this._$document = t(document), this._$window = t(window), this._$body = t(document.body), this._boundClick = t.proxy(this._clickHandler, this)
    }

    function i(e) {
        this._fullHeight = this._fullWidth = this._overlay = this._targetImageWrap = null, this._targetImage = e, this._$body = t(document.body)
    }

    e.prototype.listen = function () {
        this._$body.on("click", '[data-action="zoom"]', t.proxy(this._zoom, this))
    }, e.prototype._zoom = function (e) {
        var o = e.target;
        if (o && "IMG" == o.tagName && !this._$body.hasClass("zoom-overlay-open"))return e.metaKey || e.ctrlKey ? window.open(e.target.getAttribute("data-original") || e.target.src, "_blank") : void(o.width >= t(window).width() - i.OFFSET || (this._activeZoomClose(!0), this._activeZoom = new i(o), this._activeZoom.zoomImage(), this._$window.on("scroll.zoom", t.proxy(this._scrollHandler, this)), this._$document.on("keyup.zoom", t.proxy(this._keyHandler, this)), this._$document.on("touchstart.zoom", t.proxy(this._touchStart, this)), document.addEventListener ? document.addEventListener("click", this._boundClick, !0) : document.attachEvent("onclick", this._boundClick, !0), "bubbles" in e ? e.bubbles && e.stopPropagation() : e.cancelBubble = !0))
    }, e.prototype._activeZoomClose = function (t) {
        this._activeZoom && (t ? this._activeZoom.dispose() : this._activeZoom.close(), this._$window.off(".zoom"), this._$document.off(".zoom"), document.removeEventListener("click", this._boundClick, !0), this._activeZoom = null)
    }, e.prototype._scrollHandler = function (e) {
        null === this._initialScrollPosition && (this._initialScrollPosition = t(window).scrollTop());
        var i = this._initialScrollPosition - t(window).scrollTop();
        Math.abs(i) >= 40 && this._activeZoomClose()
    }, e.prototype._keyHandler = function (t) {
        27 == t.keyCode && this._activeZoomClose()
    }, e.prototype._clickHandler = function (t) {
        t.preventDefault ? t.preventDefault() : event.returnValue = !1, "bubbles" in t ? t.bubbles && t.stopPropagation() : t.cancelBubble = !0, this._activeZoomClose()
    }, e.prototype._touchStart = function (e) {
        this._initialTouchPosition = e.touches[0].pageY, t(e.target).on("touchmove.zoom", t.proxy(this._touchMove, this))
    }, e.prototype._touchMove = function (e) {
        Math.abs(e.touches[0].pageY - this._initialTouchPosition) > 10 && (this._activeZoomClose(), t(e.target).off("touchmove.zoom"))
    }, i.OFFSET = 80, i._MAX_WIDTH = 2560, i._MAX_HEIGHT = 4096, i.prototype.zoomImage = function () {
        var e = document.createElement("img");
        e.onload = t.proxy(function () {
            this._fullHeight = Number(e.height), this._fullWidth = Number(e.width), this._zoomOriginal()
        }, this), e.src = this._targetImage.src
    }, i.prototype._zoomOriginal = function () {
        this._targetImageWrap = document.createElement("div"), this._targetImageWrap.className = "zoom-img-wrap", this._targetImage.parentNode.insertBefore(this._targetImageWrap, this._targetImage), this._targetImageWrap.appendChild(this._targetImage), t(this._targetImage).addClass("zoom-img").attr("data-action", "zoom-out"), this._overlay = document.createElement("div"), this._overlay.className = "zoom-overlay", document.body.appendChild(this._overlay), this._calculateZoom(), this._triggerAnimation()
    }, i.prototype._calculateZoom = function () {
        this._targetImage.offsetWidth;
        var e = this._fullWidth, o = this._fullHeight, s = (t(window).scrollTop(), e / this._targetImage.width), n = t(window).height() - i.OFFSET, a = t(window).width() - i.OFFSET, r = e / o, l = a / n;
        this._imgScaleFactor = a > e && n > o ? s : l > r ? n / o * s : a / e * s
    }, i.prototype._triggerAnimation = function () {
        this._targetImage.offsetWidth;
        var e = t(this._targetImage).offset(), i = t(window).scrollTop(), o = i + t(window).height() / 2, s = t(window).width() / 2, n = e.top + this._targetImage.height / 2, a = e.left + this._targetImage.width / 2;
        this._translateY = o - n, this._translateX = s - a;
        var r = "scale(" + this._imgScaleFactor + ")", l = "translate(" + this._translateX + "px, " + this._translateY + "px)";
        t.support.transition && (l += " translateZ(0)"), t(this._targetImage).css({
            "-webkit-transform": r,
            "-ms-transform": r,
            transform: r
        }), t(this._targetImageWrap).css({
            "-webkit-transform": l,
            "-ms-transform": l,
            transform: l
        }), this._$body.addClass("zoom-overlay-open")
    }, i.prototype.close = function () {
        return this._$body.removeClass("zoom-overlay-open").addClass("zoom-overlay-transitioning"), t(this._targetImage).css({
            "-webkit-transform": "",
            "-ms-transform": "",
            transform: ""
        }), t(this._targetImageWrap).css({
            "-webkit-transform": "",
            "-ms-transform": "",
            transform: ""
        }), t.support.transition ? void t(this._targetImage).one(t.support.transition.end, t.proxy(this.dispose, this)).emulateTransitionEnd(300) : this.dispose()
    }, i.prototype.dispose = function () {
        this._targetImageWrap && this._targetImageWrap.parentNode && (t(this._targetImage).removeClass("zoom-img").attr("data-action", "zoom"), this._targetImageWrap.parentNode.replaceChild(this._targetImage, this._targetImageWrap), this._overlay.parentNode.removeChild(this._overlay), this._$body.removeClass("zoom-overlay-transitioning"))
    }, t(function () {
        (new e).listen()
    })
}(jQuery);


/*!
 * Cropper v1.0.0-rc.1
 * https://github.com/fengyuanchen/cropper
 *
 * Copyright (c) 2014-2015 Fengyuan Chen and contributors
 * Released under the MIT license
 *
 * Date: 2015-09-05T04:29:32.906Z
 */

(function (factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as anonymous module.
        define(['jquery'], factory);
    } else if (typeof exports === 'object') {
        // Node / CommonJS
        factory(require('jquery'));
    } else {
        // Browser globals.
        factory(jQuery);
    }
})(function ($) {

    'use strict';

    // Globals
    var $window = $(window);
    var $document = $(document);
    var location = window.location;

    // Constants
    var NAMESPACE = 'cropper';
    var PREVIEW = 'preview.' + NAMESPACE;

    // Classes
    var CLASS_MODAL = 'cropper-modal';
    var CLASS_HIDE = 'cropper-hide';
    var CLASS_HIDDEN = 'cropper-hidden';
    var CLASS_INVISIBLE = 'cropper-invisible';
    var CLASS_MOVE = 'cropper-move';
    var CLASS_CROP = 'cropper-crop';
    var CLASS_DISABLED = 'cropper-disabled';
    var CLASS_BG = 'cropper-bg';

    // Events
    var EVENT_MOUSE_DOWN = 'mousedown touchstart pointerdown MSPointerDown';
    var EVENT_MOUSE_MOVE = 'mousemove touchmove pointermove MSPointerMove';
    var EVENT_MOUSE_UP = 'mouseup touchend touchcancel pointerup pointercancel MSPointerUp MSPointerCancel';
    var EVENT_WHEEL = 'wheel mousewheel DOMMouseScroll';
    var EVENT_DBLCLICK = 'dblclick';
    var EVENT_LOAD = 'load.' + NAMESPACE;
    var EVENT_ERROR = 'error.' + NAMESPACE;
    var EVENT_RESIZE = 'resize.' + NAMESPACE; // Bind to window with namespace
    var EVENT_BUILD = 'build.' + NAMESPACE;
    var EVENT_BUILT = 'built.' + NAMESPACE;
    var EVENT_CROP_START = 'cropstart.' + NAMESPACE;
    var EVENT_CROP_MOVE = 'cropmove.' + NAMESPACE;
    var EVENT_CROP_END = 'cropend.' + NAMESPACE;
    var EVENT_CROP = 'crop.' + NAMESPACE;
    var EVENT_ZOOM = 'zoom.' + NAMESPACE;

    // RegExps
    var REGEXP_ACTIONS = /^(e|w|s|n|se|sw|ne|nw|all|crop|move|zoom)$/;

    // Actions
    var ACTION_EAST = 'e';
    var ACTION_WEST = 'w';
    var ACTION_SOUTH = 's';
    var ACTION_NORTH = 'n';
    var ACTION_SOUTH_EAST = 'se';
    var ACTION_SOUTH_WEST = 'sw';
    var ACTION_NORTH_EAST = 'ne';
    var ACTION_NORTH_WEST = 'nw';
    var ACTION_ALL = 'all';
    var ACTION_CROP = 'crop';
    var ACTION_MOVE = 'move';
    var ACTION_ZOOM = 'zoom';
    var ACTION_NONE = 'none';

    // Supports
    var SUPPORT_CANVAS = $.isFunction($('<canvas>')[0].getContext);

    // Maths
    var sqrt = Math.sqrt;
    var min = Math.min;
    var max = Math.max;
    var abs = Math.abs;
    var sin = Math.sin;
    var cos = Math.cos;
    var num = parseFloat;

    // Prototype
    var prototype = {};

    function isNumber(n) {
        return typeof n === 'number' && !isNaN(n);
    }

    function isUndefined(n) {
        return typeof n === 'undefined';
    }

    function toArray(obj, offset) {
        var args = [];

        // This is necessary for IE8
        if (isNumber(offset)) {
            args.push(offset);
        }

        return args.slice.apply(obj, args);
    }

    // Custom proxy to avoid jQuery's guid
    function proxy(fn, context) {
        var args = toArray(arguments, 2);

        return function () {
            return fn.apply(context, args.concat(toArray(arguments)));
        };
    }

    function isCrossOriginURL(url) {
        var parts = url.match(/^(https?:)\/\/([^\:\/\?#]+):?(\d*)/i);

        return parts && (
                parts[1] !== location.protocol ||
                parts[2] !== location.hostname ||
                parts[3] !== location.port
            );
    }

    function addTimestamp(url) {
        var timestamp = 'timestamp=' + (new Date()).getTime();

        return (url + (url.indexOf('?') === -1 ? '?' : '&') + timestamp);
    }

    function getNaturalSize(image, callback) {
        var newImage;

        // Modern browsers
        if (image.naturalWidth) {
            return callback(image.naturalWidth, image.naturalHeight);
        }

        // IE8: Don't use `new Image()` here (#319)
        newImage = document.createElement('img');

        newImage.onload = function () {
            callback(this.width, this.height);
        };

        newImage.src = image.src;
    }

    function getTransform(options) {
        var transforms = [];
        var rotate = options.rotate;
        var scaleX = options.scaleX;
        var scaleY = options.scaleY;

        if (isNumber(rotate)) {
            transforms.push('rotate(' + rotate + 'deg)');
        }

        if (isNumber(scaleX) && isNumber(scaleY)) {
            transforms.push('scale(' + scaleX + ',' + scaleY + ')');
        }

        return transforms.length ? transforms.join(' ') : 'none';
    }

    function getRotatedSizes(data, reverse) {
        var deg = abs(data.degree) % 180;
        var arc = (deg > 90 ? (180 - deg) : deg) * Math.PI / 180;
        var sinArc = sin(arc);
        var cosArc = cos(arc);
        var width = data.width;
        var height = data.height;
        var aspectRatio = data.aspectRatio;
        var newWidth;
        var newHeight;

        if (!reverse) {
            newWidth = width * cosArc + height * sinArc;
            newHeight = width * sinArc + height * cosArc;
        } else {
            newWidth = width / (cosArc + sinArc / aspectRatio);
            newHeight = newWidth / aspectRatio;
        }

        return {
            width: newWidth,
            height: newHeight
        };
    }

    function getSourceCanvas(image, data) {
        var canvas = $('<canvas>')[0];
        var context = canvas.getContext('2d');
        var x = 0;
        var y = 0;
        var width = data.naturalWidth;
        var height = data.naturalHeight;
        var rotate = data.rotate;
        var scaleX = data.scaleX;
        var scaleY = data.scaleY;
        var scalable = isNumber(scaleX) && isNumber(scaleY) && (scaleX !== 1 || scaleY !== 1);
        var rotatable = isNumber(rotate) && rotate !== 0;
        var advanced = rotatable || scalable;
        var canvasWidth = width;
        var canvasHeight = height;
        var translateX;
        var translateY;
        var rotated;

        if (scalable) {
            translateX = width / 2;
            translateY = height / 2;
        }

        if (rotatable) {
            rotated = getRotatedSizes({
                width: width,
                height: height,
                degree: rotate
            });

            canvasWidth = rotated.width;
            canvasHeight = rotated.height;
            translateX = rotated.width / 2;
            translateY = rotated.height / 2;
        }

        canvas.width = canvasWidth;
        canvas.height = canvasHeight;

        if (advanced) {
            x = -width / 2;
            y = -height / 2;

            context.save();
            context.translate(translateX, translateY);
        }

        if (rotatable) {
            context.rotate(rotate * Math.PI / 180);
        }

        // Should call `scale` after rotated
        if (scalable) {
            context.scale(scaleX, scaleY);
        }

        context.drawImage(image, x, y, width, height);

        if (advanced) {
            context.restore();
        }

        return canvas;
    }

    function Cropper(element, options) {
        this.$element = $(element);
        this.options = $.extend({}, Cropper.DEFAULTS, $.isPlainObject(options) && options);
        this.ready = false;
        this.built = false;
        this.complete = false;
        this.rotated = false;
        this.cropped = false;
        this.disabled = false;
        this.replaced = false;
        this.isImg = false;
        this.originalUrl = '';
        this.canvas = null;
        this.cropBox = null;
        this.init();
    }

    $.extend(prototype, {
        init: function () {
            var $this = this.$element;
            var url;

            if ($this.is('img')) {
                this.isImg = true;

                // Should use `$.fn.attr` here. e.g.: "img/picture.jpg"
                this.originalUrl = url = $this.attr('src');

                // Stop when it's a blank image
                if (!url) {
                    return;
                }

                // Should use `$.fn.prop` here. e.g.: "http://example.com/img/picture.jpg"
                url = $this.prop('src');
            } else if ($this.is('canvas') && SUPPORT_CANVAS) {
                url = $this[0].toDataURL();
            }

            this.load(url);
        },

        // A shortcut for triggering custom events
        trigger: function (type, data) {
            var e = $.Event(type, data);

            this.$element.trigger(e);

            return e.isDefaultPrevented();
        },

        load: function (url) {
            var options = this.options;
            var $this = this.$element;
            var crossOrigin = '';
            var bustCacheUrl;
            var $clone;

            if (!url) {
                return;
            }

            this.url = url;

            // Trigger build event first
            $this.one(EVENT_BUILD, options.build);

            if (this.trigger(EVENT_BUILD)) {
                return;
            }

            if (options.checkImageOrigin && isCrossOriginURL(url)) {
                crossOrigin = ' crossOrigin="anonymous"';

                // Bust cache (#148), only when there was not a "crossOrigin" property
                if (!$this.prop('crossOrigin')) {
                    bustCacheUrl = addTimestamp(url);
                }
            }

            this.$clone = $clone = $('<img' + crossOrigin + ' src="' + (bustCacheUrl || url) + '">');

            if (this.isImg) {
                if ($this[0].complete) {
                    this.start();
                } else {
                    $this.one(EVENT_LOAD, $.proxy(this.start, this));
                }
            } else {
                $clone.
                one(EVENT_LOAD, $.proxy(this.start, this)).
                one(EVENT_ERROR, $.proxy(this.stop, this)).
                addClass(CLASS_HIDE).
                insertAfter($this);
            }
        },

        start: function () {
            var image = this.isImg ? this.$element[0] : this.$clone[0];

            getNaturalSize(image, $.proxy(function (naturalWidth, naturalHeight) {
                this.image = {
                    naturalWidth: naturalWidth,
                    naturalHeight: naturalHeight,
                    aspectRatio: naturalWidth / naturalHeight
                };

                this.ready = true;
                this.build();
            }, this));
        },

        stop: function () {
            this.$clone.remove();
            this.$clone = null;
        }
    });

    $.extend(prototype, {
        build: function () {
            var options = this.options;
            var $this = this.$element;
            var $clone = this.$clone;
            var $cropper;
            var $cropBox;
            var $face;

            if (!this.ready) {
                return;
            }

            // Unbuild first when replace
            if (this.built) {
                this.unbuild();
            }

            // Create cropper elements
            this.$container = $this.parent();
            this.$cropper = $cropper = $(Cropper.TEMPLATE);
            this.$canvas = $cropper.find('.cropper-canvas').append($clone);
            this.$dragBox = $cropper.find('.cropper-drag-box');
            this.$cropBox = $cropBox = $cropper.find('.cropper-crop-box');
            this.$viewBox = $cropper.find('.cropper-view-box');
            this.$face = $face = $cropBox.find('.cropper-face');

            // Hide the original image
            $this.addClass(CLASS_HIDDEN).after($cropper);

            // Show the clone image if is hidden
            if (!this.isImg) {
                $clone.removeClass(CLASS_HIDE);
            }

            this.initPreview();
            this.bind();

            // Format aspect ratio (0 -> NaN)
            options.aspectRatio = num(options.aspectRatio) || NaN;

            if (options.autoCrop) {
                this.cropped = true;

                if (options.modal) {
                    this.$dragBox.addClass(CLASS_MODAL);
                }
            } else {
                $cropBox.addClass(CLASS_HIDDEN);
            }

            if (!options.guides) {
                $cropBox.find('.cropper-dashed').addClass(CLASS_HIDDEN);
            }

            if (!options.center) {
                $cropBox.find('.cropper-center').addClass(CLASS_HIDDEN);
            }

            if (options.cropBoxMovable) {
                $face.addClass(CLASS_MOVE).data('action', ACTION_ALL);
            }

            if (!options.highlight) {
                $face.addClass(CLASS_INVISIBLE);
            }

            if (options.background) {
                $cropper.addClass(CLASS_BG);
            }

            if (!options.cropBoxResizable) {
                $cropBox.find('.cropper-line, .cropper-point').addClass(CLASS_HIDDEN);
            }

            this.setDragMode(options.dragCrop ? ACTION_CROP : (options.movable ? ACTION_MOVE : ACTION_NONE));

            this.render();
            this.built = true;
            this.setData(options.data);
            $this.one(EVENT_BUILT, options.built);

            // Trigger the built event asynchronously to keep `data('cropper')` is defined
            setTimeout($.proxy(function () {
                this.trigger(EVENT_BUILT);
                this.complete = true;
            }, this), 0);
        },

        unbuild: function () {
            if (!this.built) {
                return;
            }

            this.built = false;
            this.initialImage = null;

            // Clear `initialCanvas` is necessary when replace
            this.initialCanvas = null;
            this.initialCropBox = null;
            this.container = null;
            this.canvas = null;

            // Clear `cropBox` is necessary when replace
            this.cropBox = null;
            this.unbind();

            this.resetPreview();
            this.$preview = null;

            this.$viewBox = null;
            this.$cropBox = null;
            this.$dragBox = null;
            this.$canvas = null;
            this.$container = null;

            this.$cropper.remove();
            this.$cropper = null;
        }
    });

    $.extend(prototype, {
        render: function () {
            this.initContainer();
            this.initCanvas();
            this.initCropBox();

            this.renderCanvas();

            if (this.cropped) {
                this.renderCropBox();
            }
        },

        initContainer: function () {
            var options = this.options;
            var $this = this.$element;
            var $container = this.$container;
            var $cropper = this.$cropper;

            $cropper.addClass(CLASS_HIDDEN);
            $this.removeClass(CLASS_HIDDEN);

            $cropper.css((this.container = {
                width: max($container.width(), num(options.minContainerWidth) || 200),
                height: max($container.height(), num(options.minContainerHeight) || 100)
            }));

            $this.addClass(CLASS_HIDDEN);
            $cropper.removeClass(CLASS_HIDDEN);
        },

        // Canvas (image wrapper)
        initCanvas: function () {
            var container = this.container;
            var containerWidth = container.width;
            var containerHeight = container.height;
            var image = this.image;
            var aspectRatio = image.aspectRatio;
            var canvas = {
                aspectRatio: aspectRatio,
                width: containerWidth,
                height: containerHeight
            };

            if (containerHeight * aspectRatio > containerWidth) {
                canvas.height = containerWidth / aspectRatio;
            } else {
                canvas.width = containerHeight * aspectRatio;
            }

            canvas.oldLeft = canvas.left = (containerWidth - canvas.width) / 2;
            canvas.oldTop = canvas.top = (containerHeight - canvas.height) / 2;

            this.canvas = canvas;
            this.limitCanvas(true, true);
            this.initialImage = $.extend({}, image);
            this.initialCanvas = $.extend({}, canvas);
        },

        limitCanvas: function (size, position) {
            var options = this.options;
            var strict = options.strict;
            var container = this.container;
            var containerWidth = container.width;
            var containerHeight = container.height;
            var canvas = this.canvas;
            var aspectRatio = canvas.aspectRatio;
            var cropBox = this.cropBox;
            var cropped = this.cropped && cropBox;
            var initialCanvas = this.initialCanvas || canvas;
            var initialCanvasWidth = initialCanvas.width;
            var initialCanvasHeight = initialCanvas.height;
            var minCanvasWidth;
            var minCanvasHeight;

            if (size) {
                minCanvasWidth = num(options.minCanvasWidth) || 0;
                minCanvasHeight = num(options.minCanvasHeight) || 0;

                if (minCanvasWidth) {
                    if (strict) {
                        minCanvasWidth = max(cropped ? cropBox.width : initialCanvasWidth, minCanvasWidth);
                    }

                    minCanvasHeight = minCanvasWidth / aspectRatio;
                } else if (minCanvasHeight) {
                    if (strict) {
                        minCanvasHeight = max(cropped ? cropBox.height : initialCanvasHeight, minCanvasHeight);
                    }

                    minCanvasWidth = minCanvasHeight * aspectRatio;
                } else if (strict) {
                    if (cropped) {
                        minCanvasWidth = cropBox.width;
                        minCanvasHeight = cropBox.height;

                        if (minCanvasHeight * aspectRatio > minCanvasWidth) {
                            minCanvasWidth = minCanvasHeight * aspectRatio;
                        } else {
                            minCanvasHeight = minCanvasWidth / aspectRatio;
                        }
                    } else {
                        minCanvasWidth = initialCanvasWidth;
                        minCanvasHeight = initialCanvasHeight;
                    }
                }

                $.extend(canvas, {
                    minWidth: minCanvasWidth,
                    minHeight: minCanvasHeight,
                    maxWidth: Infinity,
                    maxHeight: Infinity
                });
            }

            if (position) {
                if (strict) {
                    if (cropped) {
                        canvas.minLeft = min(cropBox.left, (cropBox.left + cropBox.width) - canvas.width);
                        canvas.minTop = min(cropBox.top, (cropBox.top + cropBox.height) - canvas.height);
                        canvas.maxLeft = cropBox.left;
                        canvas.maxTop = cropBox.top;
                    } else {
                        canvas.minLeft = min(0, containerWidth - canvas.width);
                        canvas.minTop = min(0, containerHeight - canvas.height);
                        canvas.maxLeft = max(0, containerWidth - canvas.width);
                        canvas.maxTop = max(0, containerHeight - canvas.height);
                    }
                } else {
                    canvas.minLeft = -canvas.width;
                    canvas.minTop = -canvas.height;
                    canvas.maxLeft = containerWidth;
                    canvas.maxTop = containerHeight;
                }
            }
        },

        renderCanvas: function (changed) {
            var options = this.options;
            var canvas = this.canvas;
            var image = this.image;
            var aspectRatio;
            var rotated;

            if (this.rotated) {
                this.rotated = false;

                // Computes rotated sizes with image sizes
                rotated = getRotatedSizes({
                    width: image.width,
                    height: image.height,
                    degree: image.rotate
                });

                aspectRatio = rotated.width / rotated.height;

                if (aspectRatio !== canvas.aspectRatio) {
                    canvas.left -= (rotated.width - canvas.width) / 2;
                    canvas.top -= (rotated.height - canvas.height) / 2;
                    canvas.width = rotated.width;
                    canvas.height = rotated.height;
                    canvas.aspectRatio = aspectRatio;
                    this.limitCanvas(true, false);
                }
            }

            if (canvas.width > canvas.maxWidth || canvas.width < canvas.minWidth) {
                canvas.left = canvas.oldLeft;
            }

            if (canvas.height > canvas.maxHeight || canvas.height < canvas.minHeight) {
                canvas.top = canvas.oldTop;
            }

            canvas.width = min(max(canvas.width, canvas.minWidth), canvas.maxWidth);
            canvas.height = min(max(canvas.height, canvas.minHeight), canvas.maxHeight);

            this.limitCanvas(false, true);

            canvas.oldLeft = canvas.left = min(max(canvas.left, canvas.minLeft), canvas.maxLeft);
            canvas.oldTop = canvas.top = min(max(canvas.top, canvas.minTop), canvas.maxTop);

            this.$canvas.css({
                width: canvas.width,
                height: canvas.height,
                left: canvas.left,
                top: canvas.top
            });

            this.renderImage();

            if (this.cropped && options.strict) {
                this.limitCropBox(true, true);
            }

            if (changed) {
                this.output();
            }
        },

        renderImage: function (changed) {
            var canvas = this.canvas;
            var image = this.image;
            var reversed;

            if (image.rotate) {
                reversed = getRotatedSizes({
                    width: canvas.width,
                    height: canvas.height,
                    degree: image.rotate,
                    aspectRatio: image.aspectRatio
                }, true);
            }

            $.extend(image, reversed ? {
                width: reversed.width,
                height: reversed.height,
                left: (canvas.width - reversed.width) / 2,
                top: (canvas.height - reversed.height) / 2
            } : {
                width: canvas.width,
                height: canvas.height,
                left: 0,
                top: 0
            });

            this.$clone.css({
                width: image.width,
                height: image.height,
                marginLeft: image.left,
                marginTop: image.top,
                transform: getTransform(image)
            });

            if (changed) {
                this.output();
            }
        },

        initCropBox: function () {
            var options = this.options;
            var canvas = this.canvas;
            var aspectRatio = options.aspectRatio;
            var autoCropArea = num(options.autoCropArea) || 0.8;
            var cropBox = {
                width: canvas.width,
                height: canvas.height
            };

            if (aspectRatio) {
                if (canvas.height * aspectRatio > canvas.width) {
                    cropBox.height = cropBox.width / aspectRatio;
                } else {
                    cropBox.width = cropBox.height * aspectRatio;
                }
            }

            this.cropBox = cropBox;
            this.limitCropBox(true, true);

            // Initialize auto crop area
            cropBox.width = min(max(cropBox.width, cropBox.minWidth), cropBox.maxWidth);
            cropBox.height = min(max(cropBox.height, cropBox.minHeight), cropBox.maxHeight);

            // The width of auto crop area must large than "minWidth", and the height too. (#164)
            cropBox.width = max(cropBox.minWidth, cropBox.width * autoCropArea);
            cropBox.height = max(cropBox.minHeight, cropBox.height * autoCropArea);
            cropBox.oldLeft = cropBox.left = canvas.left + (canvas.width - cropBox.width) / 2;
            cropBox.oldTop = cropBox.top = canvas.top + (canvas.height - cropBox.height) / 2;

            this.initialCropBox = $.extend({}, cropBox);
        },

        limitCropBox: function (size, position) {
            var options = this.options;
            var strict = options.strict;
            var container = this.container;
            var containerWidth = container.width;
            var containerHeight = container.height;
            var canvas = this.canvas;
            var cropBox = this.cropBox;
            var aspectRatio = options.aspectRatio;
            var minCropBoxWidth;
            var minCropBoxHeight;

            if (size) {
                minCropBoxWidth = num(options.minCropBoxWidth) || 0;
                minCropBoxHeight = num(options.minCropBoxHeight) || 0;

                // The min/maxCropBoxWidth/Height must less than container width/height
                cropBox.minWidth = min(containerWidth, minCropBoxWidth);
                cropBox.minHeight = min(containerHeight, minCropBoxHeight);
                cropBox.maxWidth = min(containerWidth, strict ? canvas.width : containerWidth);
                cropBox.maxHeight = min(containerHeight, strict ? canvas.height : containerHeight);

                if (aspectRatio) {

                    // Compare crop box size with container first
                    if (cropBox.maxHeight * aspectRatio > cropBox.maxWidth) {
                        cropBox.minHeight = cropBox.minWidth / aspectRatio;
                        cropBox.maxHeight = cropBox.maxWidth / aspectRatio;
                    } else {
                        cropBox.minWidth = cropBox.minHeight * aspectRatio;
                        cropBox.maxWidth = cropBox.maxHeight * aspectRatio;
                    }
                }

                // The "minWidth" must be less than "maxWidth", and the "minHeight" too.
                cropBox.minWidth = min(cropBox.maxWidth, cropBox.minWidth);
                cropBox.minHeight = min(cropBox.maxHeight, cropBox.minHeight);
            }

            if (position) {
                if (strict) {
                    cropBox.minLeft = max(0, canvas.left);
                    cropBox.minTop = max(0, canvas.top);
                    cropBox.maxLeft = min(containerWidth, canvas.left + canvas.width) - cropBox.width;
                    cropBox.maxTop = min(containerHeight, canvas.top + canvas.height) - cropBox.height;
                } else {
                    cropBox.minLeft = 0;
                    cropBox.minTop = 0;
                    cropBox.maxLeft = containerWidth - cropBox.width;
                    cropBox.maxTop = containerHeight - cropBox.height;
                }
            }
        },

        renderCropBox: function () {
            var options = this.options;
            var container = this.container;
            var containerWidth = container.width;
            var containerHeight = container.height;
            var cropBox = this.cropBox;

            if (cropBox.width > cropBox.maxWidth || cropBox.width < cropBox.minWidth) {
                cropBox.left = cropBox.oldLeft;
            }

            if (cropBox.height > cropBox.maxHeight || cropBox.height < cropBox.minHeight) {
                cropBox.top = cropBox.oldTop;
            }

            cropBox.width = min(max(cropBox.width, cropBox.minWidth), cropBox.maxWidth);
            cropBox.height = min(max(cropBox.height, cropBox.minHeight), cropBox.maxHeight);

            this.limitCropBox(false, true);

            cropBox.oldLeft = cropBox.left = min(max(cropBox.left, cropBox.minLeft), cropBox.maxLeft);
            cropBox.oldTop = cropBox.top = min(max(cropBox.top, cropBox.minTop), cropBox.maxTop);

            if (options.movable && options.cropBoxMovable) {

                // Turn to move the canvas when the crop box is equal to the container
                this.$face.data('action', (cropBox.width === containerWidth && cropBox.height === containerHeight) ? ACTION_MOVE : ACTION_ALL);
            }

            this.$cropBox.css({
                width: cropBox.width,
                height: cropBox.height,
                left: cropBox.left,
                top: cropBox.top
            });

            if (this.cropped && options.strict) {
                this.limitCanvas(true, true);
            }

            if (!this.disabled) {
                this.output();
            }
        },

        output: function () {
            this.preview();

            if (this.complete) {
                this.trigger(EVENT_CROP, this.getData());
            } else if (!this.built) {

                // Only trigger one crop event before complete
                this.$element.one(EVENT_BUILT, $.proxy(function () {
                    this.trigger(EVENT_CROP, this.getData());
                }, this));
            }
        }
    });

    $.extend(prototype, {
        initPreview: function () {
            var url = this.url;

            this.$preview = $(this.options.preview);
            this.$viewBox.html('<img src="' + url + '">');
            this.$preview.each(function () {
                var $this = $(this);

                // Save the original size for recover
                $this.data(PREVIEW, {
                    width: $this.width(),
                    height: $this.height(),
                    original: $this.html()
                });

                /**
                 * Override img element styles
                 * Add `display:block` to avoid margin top issue
                 * (Occur only when margin-top <= -height)
                 */
                $this.html(
                    '<img src="' + url + '" style="display:block;width:100%;' +
                    'min-width:0!important;min-height:0!important;' +
                    'max-width:none!important;max-height:none!important;' +
                    'image-orientation:0deg!important">'
                );
            });
        },

        resetPreview: function () {
            this.$preview.each(function () {
                var $this = $(this);

                $this.html($this.data(PREVIEW).original).removeData(PREVIEW);
            });
        },

        preview: function () {
            var image = this.image;
            var canvas = this.canvas;
            var cropBox = this.cropBox;
            var width = image.width;
            var height = image.height;
            var left = cropBox.left - canvas.left - image.left;
            var top = cropBox.top - canvas.top - image.top;

            if (!this.cropped || this.disabled) {
                return;
            }

            this.$viewBox.find('img').css({
                width: width,
                height: height,
                marginLeft: -left,
                marginTop: -top,
                transform: getTransform(image)
            });

            this.$preview.each(function () {
                var $this = $(this);
                var data = $this.data(PREVIEW);
                var ratio = data.width / cropBox.width;
                var newWidth = data.width;
                var newHeight = cropBox.height * ratio;

                if (newHeight > data.height) {
                    ratio = data.height / cropBox.height;
                    newWidth = cropBox.width * ratio;
                    newHeight = data.height;
                }

                $this.width(newWidth).height(newHeight).find('img').css({
                    width: width * ratio,
                    height: height * ratio,
                    marginLeft: -left * ratio,
                    marginTop: -top * ratio,
                    transform: getTransform(image)
                });
            });
        }
    });

    $.extend(prototype, {
        bind: function () {
            var options = this.options;
            var $this = this.$element;
            var $cropper = this.$cropper;

            if ($.isFunction(options.cropstart)) {
                $this.on(EVENT_CROP_START, options.cropstart);
            }

            if ($.isFunction(options.cropmove)) {
                $this.on(EVENT_CROP_MOVE, options.cropmove);
            }

            if ($.isFunction(options.cropend)) {
                $this.on(EVENT_CROP_END, options.cropend);
            }

            if ($.isFunction(options.crop)) {
                $this.on(EVENT_CROP, options.crop);
            }

            if ($.isFunction(options.zoom)) {
                $this.on(EVENT_ZOOM, options.zoom);
            }

            $cropper.on(EVENT_MOUSE_DOWN, $.proxy(this.cropStart, this));

            if (options.zoomable && options.mouseWheelZoom) {
                $cropper.on(EVENT_WHEEL, $.proxy(this.wheel, this));
            }

            if (options.doubleClickToggle) {
                $cropper.on(EVENT_DBLCLICK, $.proxy(this.dblclick, this));
            }

            $document.
            on(EVENT_MOUSE_MOVE, (this._cropMove = proxy(this.cropMove, this))).
            on(EVENT_MOUSE_UP, (this._cropEnd = proxy(this.cropEnd, this)));

            if (options.responsive) {
                $window.on(EVENT_RESIZE, (this._resize = proxy(this.resize, this)));
            }
        },

        unbind: function () {
            var options = this.options;
            var $this = this.$element;
            var $cropper = this.$cropper;

            if ($.isFunction(options.cropstart)) {
                $this.off(EVENT_CROP_START, options.cropstart);
            }

            if ($.isFunction(options.cropmove)) {
                $this.off(EVENT_CROP_MOVE, options.cropmove);
            }

            if ($.isFunction(options.cropend)) {
                $this.off(EVENT_CROP_END, options.cropend);
            }

            if ($.isFunction(options.crop)) {
                $this.off(EVENT_CROP, options.crop);
            }

            if ($.isFunction(options.zoom)) {
                $this.off(EVENT_ZOOM, options.zoom);
            }

            $cropper.off(EVENT_MOUSE_DOWN, this.cropStart);

            if (options.zoomable && options.mouseWheelZoom) {
                $cropper.off(EVENT_WHEEL, this.wheel);
            }

            if (options.doubleClickToggle) {
                $cropper.off(EVENT_DBLCLICK, this.dblclick);
            }

            $document.
            off(EVENT_MOUSE_MOVE, this._cropMove).
            off(EVENT_MOUSE_UP, this._cropEnd);

            if (options.responsive) {
                $window.off(EVENT_RESIZE, this._resize);
            }
        }
    });

    $.extend(prototype, {
        resize: function () {
            var $container = this.$container;
            var container = this.container;
            var canvasData;
            var cropBoxData;
            var ratio;

            // Check `container` is necessary for IE8
            if (this.disabled || !container) {
                return;
            }

            ratio = $container.width() / container.width;

            // Resize when width changed or height changed
            if (ratio !== 1 || $container.height() !== container.height) {
                canvasData = this.getCanvasData();
                cropBoxData = this.getCropBoxData();

                this.render();
                this.setCanvasData($.each(canvasData, function (i, n) {
                    canvasData[i] = n * ratio;
                }));
                this.setCropBoxData($.each(cropBoxData, function (i, n) {
                    cropBoxData[i] = n * ratio;
                }));
            }
        },

        dblclick: function () {
            if (this.disabled) {
                return;
            }

            if (this.$dragBox.hasClass(CLASS_CROP)) {
                this.setDragMode(ACTION_MOVE);
            } else {
                this.setDragMode(ACTION_CROP);
            }
        },

        wheel: function (event) {
            var originalEvent = event.originalEvent;
            var e = originalEvent;
            var ratio = num(this.options.wheelZoomRatio) || 0.1;
            var delta = 1;

            if (this.disabled) {
                return;
            }

            event.preventDefault();

            if (e.deltaY) {
                delta = e.deltaY > 0 ? 1 : -1;
            } else if (e.wheelDelta) {
                delta = -e.wheelDelta / 120;
            } else if (e.detail) {
                delta = e.detail > 0 ? 1 : -1;
            }

            this.zoom(-delta * ratio, originalEvent);
        },

        cropStart: function (event) {
            var options = this.options;
            var originalEvent = event.originalEvent;
            var touches = originalEvent && originalEvent.touches;
            var e = event;
            var touchesLength;
            var action;

            if (this.disabled) {
                return;
            }

            if (touches) {
                touchesLength = touches.length;

                if (touchesLength > 1) {
                    if (options.zoomable && options.touchDragZoom && touchesLength === 2) {
                        e = touches[1];
                        this.startX2 = e.pageX;
                        this.startY2 = e.pageY;
                        action = ACTION_ZOOM;
                    } else {
                        return;
                    }
                }

                e = touches[0];
            }

            action = action || $(e.target).data('action');

            if (REGEXP_ACTIONS.test(action)) {
                if (this.trigger(EVENT_CROP_START, {
                        originalEvent: originalEvent,
                        action: action
                    })) {
                    return;
                }

                event.preventDefault();

                this.action = action;
                this.cropping = false;

                // IE8  has `event.pageX/Y`, but not `event.originalEvent.pageX/Y`
                // IE10 has `event.originalEvent.pageX/Y`, but not `event.pageX/Y`
                this.startX = e.pageX || originalEvent && originalEvent.pageX;
                this.startY = e.pageY || originalEvent && originalEvent.pageY;

                if (action === ACTION_CROP) {
                    this.cropping = true;
                    this.$dragBox.addClass(CLASS_MODAL);
                }
            }
        },

        cropMove: function (event) {
            var options = this.options;
            var originalEvent = event.originalEvent;
            var touches = originalEvent && originalEvent.touches;
            var e = event;
            var action = this.action;
            var touchesLength;

            if (this.disabled) {
                return;
            }

            if (touches) {
                touchesLength = touches.length;

                if (touchesLength > 1) {
                    if (options.zoomable && options.touchDragZoom && touchesLength === 2) {
                        e = touches[1];
                        this.endX2 = e.pageX;
                        this.endY2 = e.pageY;
                    } else {
                        return;
                    }
                }

                e = touches[0];
            }

            if (action) {
                if (this.trigger(EVENT_CROP_MOVE, {
                        originalEvent: originalEvent,
                        action: action
                    })) {
                    return;
                }

                event.preventDefault();

                this.endX = e.pageX || originalEvent && originalEvent.pageX;
                this.endY = e.pageY || originalEvent && originalEvent.pageY;

                this.change(e.shiftKey, action === ACTION_ZOOM ? originalEvent : null);
            }
        },

        cropEnd: function (event) {
            var originalEvent = event.originalEvent;
            var action = this.action;

            if (this.disabled) {
                return;
            }

            if (action) {
                event.preventDefault();

                if (this.cropping) {
                    this.cropping = false;
                    this.$dragBox.toggleClass(CLASS_MODAL, this.cropped && this.options.modal);
                }

                this.action = '';

                this.trigger(EVENT_CROP_END, {
                    originalEvent: originalEvent,
                    action: action
                });
            }
        }
    });

    $.extend(prototype, {
        change: function (shiftKey, originalEvent) {
            var options = this.options;
            var aspectRatio = options.aspectRatio;
            var action = this.action;
            var container = this.container;
            var canvas = this.canvas;
            var cropBox = this.cropBox;
            var width = cropBox.width;
            var height = cropBox.height;
            var left = cropBox.left;
            var top = cropBox.top;
            var right = left + width;
            var bottom = top + height;
            var minLeft = 0;
            var minTop = 0;
            var maxWidth = container.width;
            var maxHeight = container.height;
            var renderable = true;
            var offset;
            var range;

            // Locking aspect ratio in "free mode" by holding shift key (#259)
            if (!aspectRatio && shiftKey) {
                aspectRatio = width && height ? width / height : 1;
            }

            if (options.strict) {
                minLeft = cropBox.minLeft;
                minTop = cropBox.minTop;
                maxWidth = minLeft + min(container.width, canvas.width);
                maxHeight = minTop + min(container.height, canvas.height);
            }

            range = {
                x: this.endX - this.startX,
                y: this.endY - this.startY
            };

            if (aspectRatio) {
                range.X = range.y * aspectRatio;
                range.Y = range.x / aspectRatio;
            }

            switch (action) {
                // Move crop box
                case ACTION_ALL:
                    left += range.x;
                    top += range.y;
                    break;

                // Resize crop box
                case ACTION_EAST:
                    if (range.x >= 0 && (right >= maxWidth || aspectRatio &&
                        (top <= minTop || bottom >= maxHeight))) {

                        renderable = false;
                        break;
                    }

                    width += range.x;

                    if (aspectRatio) {
                        height = width / aspectRatio;
                        top -= range.Y / 2;
                    }

                    if (width < 0) {
                        action = ACTION_WEST;
                        width = 0;
                    }

                    break;

                case ACTION_NORTH:
                    if (range.y <= 0 && (top <= minTop || aspectRatio &&
                        (left <= minLeft || right >= maxWidth))) {

                        renderable = false;
                        break;
                    }

                    height -= range.y;
                    top += range.y;

                    if (aspectRatio) {
                        width = height * aspectRatio;
                        left += range.X / 2;
                    }

                    if (height < 0) {
                        action = ACTION_SOUTH;
                        height = 0;
                    }

                    break;

                case ACTION_WEST:
                    if (range.x <= 0 && (left <= minLeft || aspectRatio &&
                        (top <= minTop || bottom >= maxHeight))) {

                        renderable = false;
                        break;
                    }

                    width -= range.x;
                    left += range.x;

                    if (aspectRatio) {
                        height = width / aspectRatio;
                        top += range.Y / 2;
                    }

                    if (width < 0) {
                        action = ACTION_EAST;
                        width = 0;
                    }

                    break;

                case ACTION_SOUTH:
                    if (range.y >= 0 && (bottom >= maxHeight || aspectRatio &&
                        (left <= minLeft || right >= maxWidth))) {

                        renderable = false;
                        break;
                    }

                    height += range.y;

                    if (aspectRatio) {
                        width = height * aspectRatio;
                        left -= range.X / 2;
                    }

                    if (height < 0) {
                        action = ACTION_NORTH;
                        height = 0;
                    }

                    break;

                case ACTION_NORTH_EAST:
                    if (aspectRatio) {
                        if (range.y <= 0 && (top <= minTop || right >= maxWidth)) {
                            renderable = false;
                            break;
                        }

                        height -= range.y;
                        top += range.y;
                        width = height * aspectRatio;
                    } else {
                        if (range.x >= 0) {
                            if (right < maxWidth) {
                                width += range.x;
                            } else if (range.y <= 0 && top <= minTop) {
                                renderable = false;
                            }
                        } else {
                            width += range.x;
                        }

                        if (range.y <= 0) {
                            if (top > minTop) {
                                height -= range.y;
                                top += range.y;
                            }
                        } else {
                            height -= range.y;
                            top += range.y;
                        }
                    }

                    if (width < 0 && height < 0) {
                        action = ACTION_SOUTH_WEST;
                        height = 0;
                        width = 0;
                    } else if (width < 0) {
                        action = ACTION_NORTH_WEST;
                        width = 0;
                    } else if (height < 0) {
                        action = ACTION_SOUTH_EAST;
                        height = 0;
                    }

                    break;

                case ACTION_NORTH_WEST:
                    if (aspectRatio) {
                        if (range.y <= 0 && (top <= minTop || left <= minLeft)) {
                            renderable = false;
                            break;
                        }

                        height -= range.y;
                        top += range.y;
                        width = height * aspectRatio;
                        left += range.X;
                    } else {
                        if (range.x <= 0) {
                            if (left > minLeft) {
                                width -= range.x;
                                left += range.x;
                            } else if (range.y <= 0 && top <= minTop) {
                                renderable = false;
                            }
                        } else {
                            width -= range.x;
                            left += range.x;
                        }

                        if (range.y <= 0) {
                            if (top > minTop) {
                                height -= range.y;
                                top += range.y;
                            }
                        } else {
                            height -= range.y;
                            top += range.y;
                        }
                    }

                    if (width < 0 && height < 0) {
                        action = ACTION_SOUTH_EAST;
                        height = 0;
                        width = 0;
                    } else if (width < 0) {
                        action = ACTION_NORTH_EAST;
                        width = 0;
                    } else if (height < 0) {
                        action = ACTION_SOUTH_WEST;
                        height = 0;
                    }

                    break;

                case ACTION_SOUTH_WEST:
                    if (aspectRatio) {
                        if (range.x <= 0 && (left <= minLeft || bottom >= maxHeight)) {
                            renderable = false;
                            break;
                        }

                        width -= range.x;
                        left += range.x;
                        height = width / aspectRatio;
                    } else {
                        if (range.x <= 0) {
                            if (left > minLeft) {
                                width -= range.x;
                                left += range.x;
                            } else if (range.y >= 0 && bottom >= maxHeight) {
                                renderable = false;
                            }
                        } else {
                            width -= range.x;
                            left += range.x;
                        }

                        if (range.y >= 0) {
                            if (bottom < maxHeight) {
                                height += range.y;
                            }
                        } else {
                            height += range.y;
                        }
                    }

                    if (width < 0 && height < 0) {
                        action = ACTION_NORTH_EAST;
                        height = 0;
                        width = 0;
                    } else if (width < 0) {
                        action = ACTION_SOUTH_EAST;
                        width = 0;
                    } else if (height < 0) {
                        action = ACTION_NORTH_WEST;
                        height = 0;
                    }

                    break;

                case ACTION_SOUTH_EAST:
                    if (aspectRatio) {
                        if (range.x >= 0 && (right >= maxWidth || bottom >= maxHeight)) {
                            renderable = false;
                            break;
                        }

                        width += range.x;
                        height = width / aspectRatio;
                    } else {
                        if (range.x >= 0) {
                            if (right < maxWidth) {
                                width += range.x;
                            } else if (range.y >= 0 && bottom >= maxHeight) {
                                renderable = false;
                            }
                        } else {
                            width += range.x;
                        }

                        if (range.y >= 0) {
                            if (bottom < maxHeight) {
                                height += range.y;
                            }
                        } else {
                            height += range.y;
                        }
                    }

                    if (width < 0 && height < 0) {
                        action = ACTION_NORTH_WEST;
                        height = 0;
                        width = 0;
                    } else if (width < 0) {
                        action = ACTION_SOUTH_WEST;
                        width = 0;
                    } else if (height < 0) {
                        action = ACTION_NORTH_EAST;
                        height = 0;
                    }

                    break;

                // Move canvas
                case ACTION_MOVE:
                    this.move(range.x, range.y);
                    renderable = false;
                    break;

                // Zoom canvas
                case ACTION_ZOOM:
                    this.zoom((function (x1, y1, x2, y2) {
                        var z1 = sqrt(x1 * x1 + y1 * y1);
                        var z2 = sqrt(x2 * x2 + y2 * y2);

                        return (z2 - z1) / z1;
                    })(
                        abs(this.startX - this.startX2),
                        abs(this.startY - this.startY2),
                        abs(this.endX - this.endX2),
                        abs(this.endY - this.endY2)
                    ), originalEvent);
                    this.startX2 = this.endX2;
                    this.startY2 = this.endY2;
                    renderable = false;
                    break;

                // Create crop box
                case ACTION_CROP:
                    if (range.x && range.y) {
                        offset = this.$cropper.offset();
                        left = this.startX - offset.left;
                        top = this.startY - offset.top;
                        width = cropBox.minWidth;
                        height = cropBox.minHeight;

                        if (range.x > 0) {
                            if (range.y > 0) {
                                action = ACTION_SOUTH_EAST;
                            } else {
                                action = ACTION_NORTH_EAST;
                                top -= height;
                            }
                        } else {
                            if (range.y > 0) {
                                action = ACTION_SOUTH_WEST;
                                left -= width;
                            } else {
                                action = ACTION_NORTH_WEST;
                                left -= width;
                                top -= height;
                            }
                        }

                        // Show the crop box if is hidden
                        if (!this.cropped) {
                            this.cropped = true;
                            this.$cropBox.removeClass(CLASS_HIDDEN);
                        }
                    }

                    break;

                // No default
            }

            if (renderable) {
                cropBox.width = width;
                cropBox.height = height;
                cropBox.left = left;
                cropBox.top = top;
                this.action = action;

                this.renderCropBox();
            }

            // Override
            this.startX = this.endX;
            this.startY = this.endY;
        }
    });

    $.extend(prototype, {

        // Show the crop box manually
        crop: function () {
            if (!this.built || this.disabled) {
                return;
            }

            if (!this.cropped) {
                this.cropped = true;
                this.limitCropBox(true, true);

                if (this.options.modal) {
                    this.$dragBox.addClass(CLASS_MODAL);
                }

                this.$cropBox.removeClass(CLASS_HIDDEN);
            }

            this.setCropBoxData(this.initialCropBox);
        },

        // Reset the image and crop box to their initial states
        reset: function () {
            if (!this.built || this.disabled) {
                return;
            }

            this.image = $.extend({}, this.initialImage);
            this.canvas = $.extend({}, this.initialCanvas);

            // Required for strict mode
            this.cropBox = $.extend({}, this.initialCropBox);

            this.renderCanvas();

            if (this.cropped) {
                this.renderCropBox();
            }
        },

        // Clear the crop box
        clear: function () {
            if (!this.cropped || this.disabled) {
                return;
            }

            $.extend(this.cropBox, {
                left: 0,
                top: 0,
                width: 0,
                height: 0
            });

            this.cropped = false;
            this.renderCropBox();

            this.limitCanvas();

            // Render canvas after crop box rendered
            this.renderCanvas();

            this.$dragBox.removeClass(CLASS_MODAL);
            this.$cropBox.addClass(CLASS_HIDDEN);
        },

        /**
         * Replace the image's src and rebuild the cropper
         *
         * @param {String} url
         */
        replace: function (url) {
            if (!this.disabled && url) {
                if (this.isImg) {
                    this.replaced = true;
                    this.$element.attr('src', url);
                }

                // Clear previous data
                this.options.data = null;
                this.load(url);
            }
        },

        // Enable (unfreeze) the cropper
        enable: function () {
            if (this.built) {
                this.disabled = false;
                this.$cropper.removeClass(CLASS_DISABLED);
            }
        },

        // Disable (freeze) the cropper
        disable: function () {
            if (this.built) {
                this.disabled = true;
                this.$cropper.addClass(CLASS_DISABLED);
            }
        },

        // Destroy the cropper and remove the instance from the image
        destroy: function () {
            var $this = this.$element;

            if (this.ready) {
                if (this.isImg && this.replaced) {
                    $this.attr('src', this.originalUrl);
                }

                this.unbuild();
                $this.removeClass(CLASS_HIDDEN);
            } else {
                if (this.isImg) {
                    $this.off(EVENT_LOAD, this.start);
                } else if (this.$clone) {
                    this.$clone.remove();
                }
            }

            $this.removeData(NAMESPACE);
        },

        /**
         * Move the canvas
         *
         * @param {Number} offsetX
         * @param {Number} offsetY (optional)
         */
        move: function (offsetX, offsetY) {
            var canvas = this.canvas;

            // If "offsetY" is not present, its default value is "offsetX"
            if (isUndefined(offsetY)) {
                offsetY = offsetX;
            }

            offsetX = num(offsetX);
            offsetY = num(offsetY);

            if (this.built && !this.disabled && this.options.movable) {
                canvas.left += isNumber(offsetX) ? offsetX : 0;
                canvas.top += isNumber(offsetY) ? offsetY : 0;
                this.renderCanvas(true);
            }
        },

        /**
         * Zoom the canvas
         *
         * @param {Number} ratio
         * @param {Event} _originalEvent (private)
         */
        zoom: function (ratio, _originalEvent) {
            var canvas = this.canvas;
            var width;
            var height;

            ratio = num(ratio);

            if (ratio && this.built && !this.disabled && this.options.zoomable) {
                if (this.trigger(EVENT_ZOOM, {
                        originalEvent: _originalEvent,
                        ratio: ratio
                    })) {
                    return;
                }

                if (ratio < 0) {
                    ratio =  1 / (1 - ratio);
                } else {
                    ratio = 1 + ratio;
                }

                width = canvas.width * ratio;
                height = canvas.height * ratio;
                canvas.left -= (width - canvas.width) / 2;
                canvas.top -= (height - canvas.height) / 2;
                canvas.width = width;
                canvas.height = height;
                this.renderCanvas(true);
                this.setDragMode(ACTION_MOVE);
            }
        },

        /**
         * Rotate the canvas
         * https://developer.mozilla.org/en-US/docs/Web/CSS/transform-function#rotate()
         *
         * @param {Number} degree
         */
        rotate: function (degree) {
            var image = this.image;
            var rotate = image.rotate || 0;

            degree = num(degree) || 0;

            if (this.built && !this.disabled && this.options.rotatable) {
                image.rotate = (rotate + degree) % 360;
                this.rotated = true;
                this.renderCanvas(true);
            }
        },

        /**
         * Scale the image
         * https://developer.mozilla.org/en-US/docs/Web/CSS/transform-function#scale()
         *
         * @param {Number} scaleX
         * @param {Number} scaleY (optional)
         */
        scale: function (scaleX, scaleY) {
            var image = this.image;

            // If "scaleY" is not present, its default value is "scaleX"
            if (isUndefined(scaleY)) {
                scaleY = scaleX;
            }

            scaleX = num(scaleX);
            scaleY = num(scaleY);

            if (this.built && !this.disabled && this.options.scalable) {
                image.scaleX = isNumber(scaleX) ? scaleX : 1;
                image.scaleY = isNumber(scaleY) ? scaleY : 1;
                this.renderImage(true);
            }
        },

        /**
         * Get the cropped area position and size data (base on the original image)
         *
         * @param {Boolean} rounded (optional)
         * @return {Object} data
         */
        getData: function (rounded) {
            var options = this.options;
            var image = this.image;
            var canvas = this.canvas;
            var cropBox = this.cropBox;
            var ratio;
            var data;

            if (this.built && this.cropped) {
                data = {
                    x: cropBox.left - canvas.left,
                    y: cropBox.top - canvas.top,
                    width: cropBox.width,
                    height: cropBox.height
                };

                ratio = image.width / image.naturalWidth;

                $.each(data, function (i, n) {
                    n = n / ratio;
                    data[i] = rounded ? Math.round(n) : n;
                });

            } else {
                data = {
                    x: 0,
                    y: 0,
                    width: 0,
                    height: 0
                };
            }

            if (options.rotatable) {
                data.rotate = image.rotate || 0;
            }

            if (options.scalable) {
                data.scaleX = image.scaleX || 1;
                data.scaleY = image.scaleY || 1;
            }

            return data;
        },

        /**
         * Set the cropped area position and size with new data
         *
         * @param {Object} data
         */
        setData: function (data) {
            var image = this.image;
            var canvas = this.canvas;
            var cropBoxData = {};
            var ratio;

            if ($.isFunction(data)) {
                data = data.call(this.$element);
            }

            if (this.built && !this.disabled && $.isPlainObject(data)) {
                if (isNumber(data.rotate) && data.rotate !== image.rotate &&
                    this.options.rotatable) {

                    image.rotate = data.rotate;
                    this.rotated = true;
                    this.renderCanvas(true);
                }

                ratio = image.width / image.naturalWidth;

                if (isNumber(data.x)) {
                    cropBoxData.left = data.x * ratio + canvas.left;
                }

                if (isNumber(data.y)) {
                    cropBoxData.top = data.y * ratio + canvas.top;
                }

                if (isNumber(data.width)) {
                    cropBoxData.width = data.width * ratio;
                }

                if (isNumber(data.height)) {
                    cropBoxData.height = data.height * ratio;
                }

                this.setCropBoxData(cropBoxData);
            }
        },

        /**
         * Get the container size data
         *
         * @return {Object} data
         */
        getContainerData: function () {
            return this.built ? this.container : {};
        },

        /**
         * Get the image position and size data
         *
         * @return {Object} data
         */
        getImageData: function () {
            return this.ready ? this.image : {};
        },

        /**
         * Get the canvas position and size data
         *
         * @return {Object} data
         */
        getCanvasData: function () {
            var canvas = this.canvas;
            var data;

            if (this.built) {
                data = {
                    left: canvas.left,
                    top: canvas.top,
                    width: canvas.width,
                    height: canvas.height
                };
            }

            return data || {};
        },

        /**
         * Set the canvas position and size with new data
         *
         * @param {Object} data
         */
        setCanvasData: function (data) {
            var canvas = this.canvas;
            var aspectRatio = canvas.aspectRatio;

            if ($.isFunction(data)) {
                data = data.call(this.$element);
            }

            if (this.built && !this.disabled && $.isPlainObject(data)) {
                if (isNumber(data.left)) {
                    canvas.left = data.left;
                }

                if (isNumber(data.top)) {
                    canvas.top = data.top;
                }

                if (isNumber(data.width)) {
                    canvas.width = data.width;
                    canvas.height = data.width / aspectRatio;
                } else if (isNumber(data.height)) {
                    canvas.height = data.height;
                    canvas.width = data.height * aspectRatio;
                }

                this.renderCanvas(true);
            }
        },

        /**
         * Get the crop box position and size data
         *
         * @return {Object} data
         */
        getCropBoxData: function () {
            var cropBox = this.cropBox;
            var data;

            if (this.built && this.cropped) {
                data = {
                    left: cropBox.left,
                    top: cropBox.top,
                    width: cropBox.width,
                    height: cropBox.height
                };
            }

            return data || {};
        },

        /**
         * Set the crop box position and size with new data
         *
         * @param {Object} data
         */
        setCropBoxData: function (data) {
            var cropBox = this.cropBox;
            var aspectRatio = this.options.aspectRatio;
            var widthChanged;
            var heightChanged;

            if ($.isFunction(data)) {
                data = data.call(this.$element);
            }

            if (this.built && this.cropped && !this.disabled && $.isPlainObject(data)) {

                if (isNumber(data.left)) {
                    cropBox.left = data.left;
                }

                if (isNumber(data.top)) {
                    cropBox.top = data.top;
                }

                if (isNumber(data.width) && data.width !== cropBox.width) {
                    widthChanged = true;
                    cropBox.width = data.width;
                }

                if (isNumber(data.height) && data.height !== cropBox.height) {
                    heightChanged = true;
                    cropBox.height = data.height;
                }

                if (aspectRatio) {
                    if (widthChanged) {
                        cropBox.height = cropBox.width / aspectRatio;
                    } else if (heightChanged) {
                        cropBox.width = cropBox.height * aspectRatio;
                    }
                }

                this.renderCropBox();
            }
        },

        /**
         * Get a canvas drawn the cropped image
         *
         * @param {Object} options (optional)
         * @return {HTMLCanvasElement} canvas
         */
        getCroppedCanvas: function (options) {
            var originalWidth;
            var originalHeight;
            var canvasWidth;
            var canvasHeight;
            var scaledWidth;
            var scaledHeight;
            var scaledRatio;
            var aspectRatio;
            var canvas;
            var context;
            var data;

            if (!this.built || !this.cropped || !SUPPORT_CANVAS) {
                return;
            }

            if (!$.isPlainObject(options)) {
                options = {};
            }

            data = this.getData();
            originalWidth = data.width;
            originalHeight = data.height;
            aspectRatio = originalWidth / originalHeight;

            if ($.isPlainObject(options)) {
                scaledWidth = options.width;
                scaledHeight = options.height;

                if (scaledWidth) {
                    scaledHeight = scaledWidth / aspectRatio;
                    scaledRatio = scaledWidth / originalWidth;
                } else if (scaledHeight) {
                    scaledWidth = scaledHeight * aspectRatio;
                    scaledRatio = scaledHeight / originalHeight;
                }
            }

            canvasWidth = scaledWidth || originalWidth;
            canvasHeight = scaledHeight || originalHeight;

            canvas = $('<canvas>')[0];
            canvas.width = canvasWidth;
            canvas.height = canvasHeight;
            context = canvas.getContext('2d');

            if (options.fillColor) {
                context.fillStyle = options.fillColor;
                context.fillRect(0, 0, canvasWidth, canvasHeight);
            }

            // https://developer.mozilla.org/en-US/docs/Web/API/CanvasRenderingContext2D.drawImage
            context.drawImage.apply(context, (function () {
                var source = getSourceCanvas(this.$clone[0], this.image);
                var sourceWidth = source.width;
                var sourceHeight = source.height;
                var args = [source];

                // Source canvas
                var srcX = data.x;
                var srcY = data.y;
                var srcWidth;
                var srcHeight;

                // Destination canvas
                var dstX;
                var dstY;
                var dstWidth;
                var dstHeight;

                if (srcX <= -originalWidth || srcX > sourceWidth) {
                    srcX = srcWidth = dstX = dstWidth = 0;
                } else if (srcX <= 0) {
                    dstX = -srcX;
                    srcX = 0;
                    srcWidth = dstWidth = min(sourceWidth, originalWidth + srcX);
                } else if (srcX <= sourceWidth) {
                    dstX = 0;
                    srcWidth = dstWidth = min(originalWidth, sourceWidth - srcX);
                }

                if (srcWidth <= 0 || srcY <= -originalHeight || srcY > sourceHeight) {
                    srcY = srcHeight = dstY = dstHeight = 0;
                } else if (srcY <= 0) {
                    dstY = -srcY;
                    srcY = 0;
                    srcHeight = dstHeight = min(sourceHeight, originalHeight + srcY);
                } else if (srcY <= sourceHeight) {
                    dstY = 0;
                    srcHeight = dstHeight = min(originalHeight, sourceHeight - srcY);
                }

                args.push(srcX, srcY, srcWidth, srcHeight);

                // Scale destination sizes
                if (scaledRatio) {
                    dstX *= scaledRatio;
                    dstY *= scaledRatio;
                    dstWidth *= scaledRatio;
                    dstHeight *= scaledRatio;
                }

                // Avoid "IndexSizeError" in IE and Firefox
                if (dstWidth > 0 && dstHeight > 0) {
                    args.push(dstX, dstY, dstWidth, dstHeight);
                }

                return args;
            }).call(this));

            return canvas;
        },

        /**
         * Change the aspect ratio of the crop box
         *
         * @param {Number} aspectRatio
         */
        setAspectRatio: function (aspectRatio) {
            var options = this.options;

            if (!this.disabled && !isUndefined(aspectRatio)) {

                // 0 -> NaN
                options.aspectRatio = num(aspectRatio) || NaN;

                if (this.built) {
                    this.initCropBox();

                    if (this.cropped) {
                        this.renderCropBox();
                    }
                }
            }
        },

        /**
         * Change the drag mode
         *
         * @param {String} mode (optional)
         */
        setDragMode: function (mode) {
            var options = this.options;
            var croppable;
            var movable;

            if (this.ready && !this.disabled) {
                croppable = options.dragCrop && mode === ACTION_CROP;
                movable = options.movable && mode === ACTION_MOVE;
                mode = (croppable || movable) ? mode : ACTION_NONE;

                this.$dragBox.
                data('action', mode).
                toggleClass(CLASS_CROP, croppable).
                toggleClass(CLASS_MOVE, movable);

                if (!options.cropBoxMovable) {

                    // Sync drag mode to crop box when it is not movable(#300)
                    this.$face.
                    data('action', mode).
                    toggleClass(CLASS_CROP, croppable).
                    toggleClass(CLASS_MOVE, movable);
                }
            }
        }
    });

    $.extend(Cropper.prototype, prototype);

    Cropper.DEFAULTS = {

        // Define the aspect ratio of the crop box
        aspectRatio: NaN,

        // An object with the previous cropping result data
        data: null,

        // A jQuery selector for adding extra containers to preview
        preview: '',

        // Strict mode, the image cannot zoom out less than the container
        strict: true,

        // Rebuild when resize the window
        responsive: true,

        // Check if the target image is cross origin
        checkImageOrigin: true,

        // Show the black modal
        modal: true,

        // Show the dashed lines for guiding
        guides: true,

        // Show the center indicator for guiding
        center: true,

        // Show the white modal to highlight the crop box
        highlight: true,

        // Show the grid background
        background: true,

        // Enable to crop the image automatically when initialize
        autoCrop: true,

        // Define the percentage of automatic cropping area when initializes
        autoCropArea: 0.8,

        // Enable to create new crop box by dragging over the image
        dragCrop: true,

        // Enable to move the image
        movable: true,

        // Enable to rotate the image
        rotatable: true,

        // Enable to scale the image
        scalable: true,

        // Enable to zoom the image
        zoomable: true,

        // Enable to zoom the image by wheeling mouse
        mouseWheelZoom: true,

        // Define zoom ratio when zoom the image by wheeling mouse
        wheelZoomRatio: 0.1,

        // Enable to zoom the image by dragging touch
        touchDragZoom: true,

        // Enable to move the crop box
        cropBoxMovable: true,

        // Enable to resize the crop box
        cropBoxResizable: true,

        // Toggle drag mode between "crop" and "move" when double click on the cropper
        doubleClickToggle: true,

        // Size limitation
        minCanvasWidth: 0,
        minCanvasHeight: 0,
        minCropBoxWidth: 0,
        minCropBoxHeight: 0,
        minContainerWidth: 200,
        minContainerHeight: 100,

        build: null,
        built: null,
        cropstart: null,
        cropmove: null,
        cropend: null,
        crop: null,
        zoom: null
    };

    Cropper.setDefaults = function (options) {
        $.extend(Cropper.DEFAULTS, options);
    };

    Cropper.TEMPLATE = (
        '<div class="cropper-container">' +
        '<div class="cropper-canvas"></div>' +
        '<div class="cropper-drag-box"></div>' +
        '<div class="cropper-crop-box">' +
        '<span class="cropper-view-box"></span>' +
        '<span class="cropper-dashed dashed-h"></span>' +
        '<span class="cropper-dashed dashed-v"></span>' +
        '<span class="cropper-center"></span>' +
        '<span class="cropper-face"></span>' +
        '<span class="cropper-line line-e" data-action="e"></span>' +
        '<span class="cropper-line line-n" data-action="n"></span>' +
        '<span class="cropper-line line-w" data-action="w"></span>' +
        '<span class="cropper-line line-s" data-action="s"></span>' +
        '<span class="cropper-point point-e" data-action="e"></span>' +
        '<span class="cropper-point point-n" data-action="n"></span>' +
        '<span class="cropper-point point-w" data-action="w"></span>' +
        '<span class="cropper-point point-s" data-action="s"></span>' +
        '<span class="cropper-point point-ne" data-action="ne"></span>' +
        '<span class="cropper-point point-nw" data-action="nw"></span>' +
        '<span class="cropper-point point-sw" data-action="sw"></span>' +
        '<span class="cropper-point point-se" data-action="se"></span>' +
        '</div>' +
        '</div>'
    );

    Cropper.other = $.fn.cropper;

    $.fn.cropper = function (options) {
        var args = toArray(arguments, 1);
        var result;

        this.each(function () {
            var $this = $(this);
            var data = $this.data(NAMESPACE);
            var fn;

            if (!data) {
                if (/destroy/.test(options)) {
                    return;
                }

                $this.data(NAMESPACE, (data = new Cropper(this, options)));
            }

            if (typeof options === 'string' && $.isFunction(fn = data[options])) {
                result = fn.apply(data, args);
            }
        });

        return isUndefined(result) ? this : result;
    };

    $.fn.cropper.Constructor = Cropper;
    $.fn.cropper.setDefaults = Cropper.setDefaults;

    $.fn.cropper.noConflict = function () {
        $.fn.cropper = Cropper.other;
        return this;
    };

});

$(function () {
    function o() {
        return $(window).width() - ($('[data-toggle="popover"]').offset().left + $('[data-toggle="popover"]').outerWidth())
    }

    $(window).on("resize", function () {
        var t = $('[data-toggle="popover"]').data("bs.popover");
        t && (t.options.viewport.padding = o())
    }), $('[data-toggle="popover"]').popover({
        template: '<div class="popover" role="tooltip"><div class="arrow"></div><div class="popover-content p-x-0"></div></div>',
        title: "",
        html: !0,
        trigger: "manual",
        placement: "bottom",
        viewport: {selector: "body", padding: o()},
        content: function () {
            var o = $(".app-navbar .navbar-nav:last-child").clone();
            return '<div class="nav nav-stacked" style="width: 200px">' + o.html() + "</div>"
        }
    }), $('[data-toggle="popover"]').on("click", function (o) {
        o.stopPropagation(), $('[data-toggle="popover"]').data("bs.popover").tip().hasClass("in") ? ($('[data-toggle="popover"]').popover("hide"), $(document).off("click.app.popover")) : ($('[data-toggle="popover"]').popover("show"), setTimeout(function () {
            $(document).one("click.app.popover", function () {
                $('[data-toggle="popover"]').popover("hide")
            })
        }, 1))
    })
});

$(function () {
    function o() {
        $(window).scrollTop() > $(window).height() ? $(".docs-top").fadeIn() : $(".docs-top").fadeOut()
    }

    $(".docs-top").length && (o(), $(window).on("scroll", o))
}), $(function () {
    function o() {
        i.width() > 768 ? e() : t()
    }

    function t() {
        i.off("resize.theme.nav"), i.off("scroll.theme.nav"), n.css({position: "", left: "", top: ""})
    }

    function e() {
        function o() {
            e.containerTop = $(".docs-content").offset().top - 40, e.containerRight = $(".docs-content").offset().left + $(".docs-content").width() + 45, t()
        }

        function t() {
            var o = i.scrollTop(), t = Math.max(o - e.containerTop, 0);
            return t ? void n.css({
                position: "fixed",
                left: e.containerRight,
                top: 40
            }) : ($(n.find("li")[1]).addClass("active"), n.css({position: "", left: "", top: ""}))
        }

        var e = {};
        o(), $(window).on("resize.theme.nav", o).on("scroll.theme.nav", t), $("body").scrollspy({
            target: "#markdown-toc",
            selector: "li > a"
        }), setTimeout(function () {
            $("body").scrollspy("refresh")
        }, 1e3)
    }

    var n = $("#markdown-toc"), i = $(window);
    n[0] && (o(), i.on("resize", o))
});

var newMsg = $('.js-newMsg');
var newMsgBlock = $('.new-message');
var Dialogs = $('.js-Dialogs');
var DialogsTitle = $('.js-DialogsTitle');
var backMsg = $('.js-backMsg');
var sendMsg = $('.js-sendMsg');

newMsg.on('click', function () {
    newMsgBlock.show();
    newMsg.hide();
    Dialogs.hide();
    DialogsTitle.hide();
});

backMsg.on('click', function () {
    newMsgBlock.hide();
    newMsg.show();
    Dialogs.show();
    DialogsTitle.show();
});

sendMsg.on('click', function () {

});

$('#save_background').hide();
$('#background').change(function () {
    var input = $(this)[0];
    if (input.files && input.files[0]) {
        if (input.files[0].type.match('image.*')) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#background_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            $('#save_background').show();
        } else console.log('is not image mime type');
    } else console.log('not isset files data or files API not supordet');
});

$('#save_add_photo').hide();
$('#photo_preview').hide();
$('#add_photo').change(function () {
    var input = $(this)[0];
    if (input.files && input.files[0]) {
        if (input.files[0].type.match('image.*')) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#photo_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            $('#photo_preview').show();
            $('#save_add_photo').show();
        } else console.log('is not image mime type');
    } else console.log('not isset files data or files API not supordet');
});

(function (factory) {
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], factory);
    } else if (typeof exports === 'object') {
        factory(require('jquery'));
    } else {
        factory(jQuery);
    }
})(function ($) {

    'use strict';

    var console = window.console || {
            log: function () {
            }
        };

    function CropAvatar($element) {
        this.$container = $element;

        this.$avatarView = this.$container.find('.avatar-view');
        this.$avatar = this.$avatarView.find('img');
        this.$avatarModal = this.$container.find('#avatar-modal');
        this.$loading = this.$container.find('.loading');

        this.$avatarForm = this.$avatarModal.find('.avatar-form');
        this.$avatarUpload = this.$avatarForm.find('.avatar-upload');
        this.$avatarSrc = this.$avatarForm.find('.avatar-src');
        this.$avatarData = this.$avatarForm.find('.avatar-data');
        this.$avatarInput = this.$avatarForm.find('.avatar-input');
        this.$avatarSave = this.$avatarForm.find('.avatar-save');
        this.$avatarBtns = this.$avatarForm.find('.avatar-btns');

        this.$avatarWrapper = this.$avatarModal.find('.avatar-wrapper');
        this.$avatarPreview = this.$avatarModal.find('.avatar-preview');

        this.init();
    }

    CropAvatar.prototype = {
        constructor: CropAvatar,

        support: {
            fileList: !!$('<input type="file">').prop('files'),
            blobURLs: !!window.URL && URL.createObjectURL,
            formData: !!window.FormData
        },

        init: function () {
            this.support.datauri = this.support.fileList && this.support.blobURLs;

            if (!this.support.formData) {
                this.initIframe();
            }

            this.initTooltip();
            this.initModal();
            this.addListener();
        },

        addListener: function () {
            this.$avatarView.on('click', $.proxy(this.click, this));
            this.$avatarInput.on('change', $.proxy(this.change, this));
            this.$avatarForm.on('submit', $.proxy(this.submit, this));
            this.$avatarBtns.on('click', $.proxy(this.rotate, this));
        },

        initTooltip: function () {
            this.$avatarView.tooltip({
                placement: 'bottom'
            });
        },

        initModal: function () {
            this.$avatarModal.modal({
                show: false
            });
        },

        initPreview: function () {
            var url = this.$avatar.attr('src');
            //this.$avatarWrapper.html('<img src="' + url + '_original">');
            this.$avatarPreview.html('<img class="cu" src="' + url + '">');
        },

        initIframe: function () {
            var target = 'upload-iframe-' + (new Date()).getTime();
            var $iframe = $('<iframe>').attr({
                name: target,
                src: ''
            });
            var _this = this;

              $iframe.one('load', function () {

                $iframe.on('load', function () {
                    var data;

                    try {
                        data = $(this).contents().find('body').text();
                    } catch (e) {
                        console.log(e.message);
                    }

                    if (data) {
                        try {
                            data = $.parseJSON(data);
                        } catch (e) {
                            console.log(e.message);
                        }

                        _this.submitDone(data);
                    } else {
                        _this.submitFail('Image upload failed!');
                    }

                    _this.submitEnd();

                });
            });

            this.$iframe = $iframe;
            this.$avatarForm.attr('target', target).after($iframe.hide());
        },

        click: function () {
            this.$avatarModal.modal('show');
            this.initPreview();
        },

        change: function () {
            var files;
            var file;

            if (this.support.datauri) {
                files = this.$avatarInput.prop('files');

                if (files.length > 0) {
                    file = files[0];

                    if (this.isImageFile(file)) {
                        if (this.url) {
                            URL.revokeObjectURL(this.url); // Revoke the old one
                        }

                        this.url = URL.createObjectURL(file);
                        this.startCropper();
                    }
                }
            } else {
                file = this.$avatarInput.val();

                if (this.isImageFile(file)) {
                    this.syncUpload();
                }
            }
        },

        rotate: function (e) {
            var data;

            if (this.active) {
                data = $(e.target).data();

                if (data.method) {
                    this.$img.cropper(data.method, data.option);
                }
            }
        },

        isImageFile: function (file) {
            if (file.type) {
                return /^image\/\w+$/.test(file.type);
            } else {
                return /\.(jpg|jpeg|png|gif)$/.test(file);
            }
        },

        startCropper: function () {
            var _this = this;

            if (this.active) {
                this.$img.cropper('replace', this.url);
            } else {
                this.$img = $('<img src="' + this.url + '">');
                this.$avatarWrapper.empty().html(this.$img);
                this.$img.cropper({
                    aspectRatio: 1,
                    preview: this.$avatarPreview.selector,
                    strict: false,
                    crop: function (e) {
                        var json = [
                            '{"x":' + e.x,
                            '"y":' + e.y,
                            '"height":' + e.height,
                            '"width":' + e.width,
                            '"rotate":' + e.rotate + '}'
                        ].join();

                        _this.$avatarData.val(json);
                    }
                });

                this.active = true;
            }

            this.$avatarModal.one('hidden.bs.modal', function () {
                _this.$avatarPreview.empty();
                _this.stopCropper();
            });
        },

        stopCropper: function () {
            if (this.active) {
                this.$img.cropper('destroy');
                this.$img.remove();
                this.active = false;
            }
        },

        ajaxUpload: function () {
            var url = this.$avatarForm.attr('action');
            var data = new FormData(this.$avatarForm[0]);
            var _this = this;

            $.ajax(url, {
                type: 'post',
                data: data,
                dataType: 'json',
                processData: false,
                contentType: false,

                beforeSend: function () {
                    _this.submitStart();
                },

                success: function (data) {
                    _this.submitDone(data);
                },

                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    _this.submitFail(textStatus || errorThrown);
                },

                complete: function () {
                    _this.submitEnd();
                }
            });
        },

        syncUpload: function () {
            this.$avatarSave.click();
        },

        submitStart: function () {
            this.$loading.fadeIn();
        },

        submitDone: function (data) {
            console.log(data);

            if ($.isPlainObject(data) && data.state === 200) {
                if (data.result) {
                    this.url = data.result;

                    if (this.support.datauri || this.uploaded) {
                        this.uploaded = false;
                        this.cropDone();
                    } else {
                        this.uploaded = true;
                        this.$avatarSrc.val(this.url);
                        this.startCropper();
                    }

                    this.$avatarInput.val('');
                } else if (data.message) {
                    this.alert(data.message);
                }
            } else {
                this.alert('Failed to response');
            }
        },

        submitFail: function (msg) {
            this.alert(msg);
        },

        submitEnd: function () {
            this.$loading.fadeOut();
        },

        cropDone: function () {
            this.$avatarForm.get(0).reset();
            this.$avatar.attr('src', this.url);
            this.stopCropper();
            this.$avatarModal.modal('hide');
        },

        alert: function (msg) {
            var $alert = [
                '<div class="alert alert-danger avatar-alert alert-dismissable">',
                '<button type="button" class="close" data-dismiss="alert">&times;</button>',
                msg,
                '</div>'
            ].join('');

            this.$avatarUpload.after($alert);
        }
    };

    $(function () {
        return new CropAvatar($('#crop-avatar'));
    });

});

$(function () {
    var country = $('select[name=country]');
    var location = $('select[name=location]');
    var first = $("select[name=location] :first").val();

    country.on('change', function () {
        $.get('/api/getCityList', {country: country.val()})
            .done(function (data) {
                if (data != 0) {
                    location.empty();
                    location.prepend('<option value="">' + first + '</option>');
                    $.each(data, function (id, name) {
                        location.append('<option value="' + id + '">' + name + '</option>');
                    });
                }
            });
    });

});

!function (e, t) {
    if ("function" == typeof define && define.amd)define(["exports", "module"], t);
    else if ("undefined" != typeof exports && "undefined" != typeof module)t(exports, module);
    else {
        var n = {exports: {}};
        t(n.exports, n), e.autosize = n.exports
    }
}(this, function (e, t) {
    "use strict";
    function n(e) {
        function t() {
            var t = window.getComputedStyle(e, null);
            c = t.overflowY, "vertical" === t.resize ? e.style.resize = "none" : "both" === t.resize && (e.style.resize = "horizontal"), f = "content-box" === t.boxSizing ? -(parseFloat(t.paddingTop) + parseFloat(t.paddingBottom)) : parseFloat(t.borderTopWidth) + parseFloat(t.borderBottomWidth), isNaN(f) && (f = 0), i()
        }

        function n(t) {
            var n = e.style.width;
            e.style.width = "0px", e.offsetWidth, e.style.width = n, c = t, u && (e.style.overflowY = t), o()
        }

        function o() {
            var t = window.pageYOffset, n = document.body.scrollTop, o = e.style.height;
            e.style.height = "auto";
            var i = e.scrollHeight + f;
            return 0 === e.scrollHeight ? void(e.style.height = o) : (e.style.height = i + "px", v = e.clientWidth, document.documentElement.scrollTop = t, void(document.body.scrollTop = n))
        }

        function i() {
            var t = e.style.height;
            o();
            var i = window.getComputedStyle(e, null);
            if (i.height !== e.style.height ? "visible" !== c && n("visible") : "hidden" !== c && n("hidden"), t !== e.style.height) {
                var r = document.createEvent("Event");
                r.initEvent("autosize:resized", !0, !1), e.dispatchEvent(r)
            }
        }

        var d = void 0 === arguments[1] ? {} : arguments[1], s = d.setOverflowX, l = void 0 === s ? !0 : s, a = d.setOverflowY, u = void 0 === a ? !0 : a;
        if (e && e.nodeName && "TEXTAREA" === e.nodeName && !r.has(e)) {
            var f = null, c = null, v = e.clientWidth, p = function () {
                e.clientWidth !== v && i()
            }, h = function (t) {
                window.removeEventListener("resize", p, !1), e.removeEventListener("input", i, !1), e.removeEventListener("keyup", i, !1), e.removeEventListener("autosize:destroy", h, !1), e.removeEventListener("autosize:update", i, !1), r["delete"](e), Object.keys(t).forEach(function (n) {
                    e.style[n] = t[n]
                })
            }.bind(e, {
                height: e.style.height,
                resize: e.style.resize,
                overflowY: e.style.overflowY,
                overflowX: e.style.overflowX,
                wordWrap: e.style.wordWrap
            });
            e.addEventListener("autosize:destroy", h, !1), "onpropertychange" in e && "oninput" in e && e.addEventListener("keyup", i, !1), window.addEventListener("resize", p, !1), e.addEventListener("input", i, !1), e.addEventListener("autosize:update", i, !1), r.add(e), l && (e.style.overflowX = "hidden", e.style.wordWrap = "break-word"), t()
        }
    }

    function o(e) {
        if (e && e.nodeName && "TEXTAREA" === e.nodeName) {
            var t = document.createEvent("Event");
            t.initEvent("autosize:destroy", !0, !1), e.dispatchEvent(t)
        }
    }

    function i(e) {
        if (e && e.nodeName && "TEXTAREA" === e.nodeName) {
            var t = document.createEvent("Event");
            t.initEvent("autosize:update", !0, !1), e.dispatchEvent(t)
        }
    }

    var r = "function" == typeof Set ? new Set : function () {
        var e = [];
        return {
            has: function (t) {
                return Boolean(e.indexOf(t) > -1)
            }, add: function (t) {
                e.push(t)
            }, "delete": function (t) {
                e.splice(e.indexOf(t), 1)
            }
        }
    }(), d = null;
    "undefined" == typeof window || "function" != typeof window.getComputedStyle ? (d = function (e) {
        return e
    }, d.destroy = function (e) {
        return e
    }, d.update = function (e) {
        return e
    }) : (d = function (e, t) {
        return e && Array.prototype.forEach.call(e.length ? e : [e], function (e) {
            return n(e, t)
        }), e
    }, d.destroy = function (e) {
        return e && Array.prototype.forEach.call(e.length ? e : [e], o), e
    }, d.update = function (e) {
        return e && Array.prototype.forEach.call(e.length ? e : [e], i), e
    }), t.exports = d
});

autosize($('textarea'));

$('textarea[name=message]').keydown(function (event) {
    if (event.which == 13 && event.ctrlKey) {
        $('button[name=send-message]').trigger('click');
    }
});

$('textarea[name=post]').keydown(function (event) {
    if (event.which == 13 && event.ctrlKey) {
        $('button[name=post-submit]').trigger('click');
    }
});

function wsmessage(host, key) {
    var offline = false;
    var ws = new WebSocket(host);

    ws.onerror = function (error) {
        offline = true;
    };

    ws.onopen = function () {
        $.post('/api/getClientInfo').done(function (agent) {
            ws.send(JSON.stringify({key: key, agent: agent}));
        });
    };

    ws.onmessage = function (e) {
        var data = JSON.parse(e.data);
        if (data.from && data.to && data.message) {
            updateChat(data.from, data.to);
        }
    };

    function updateChat(from, to) {
        $.post('/api/getNewMessage', {from: from, to: to}).done(function (data) {
            var conversation = $('.js-conversation ul');

            $.each(data, function (id, item) {
                conversation.prepend(
                    '<li class="qg aod alt">' +
                    '<div class="qh">' +
                    '<div class="aob">' + item.text + '</div>' +
                    '<div class="aoc">' +
                    '<small class="dp"><a>' + item.name + '</a> ' + item.time + '</small>' +
                    '</div>' +
                    '</div>' +
                    '<a class="qj">' +
                    '<img class="cu qi" src="' + item.image + '">' +
                    '</a>' +
                    '</li>'
                );
            });
        });
    }

    var sendMessage = $('button[name=send-message]');
    sendMessage.click(function () {
        if (!offline) {
            var from = sendMessage.data('from');
            var to = sendMessage.data('to');
            var message = $('textarea[name=message]').val();
            ws.send(JSON.stringify({key: key, body: JSON.stringify({from: from, to: to, message: message})}));
        }
    });
}

//Дальше идет ванила =)

function addEvent(elem, type, handler) {
    if (elem.addEventListener) {
        elem.addEventListener(type, handler, false);
    } else {
        elem.attachEvent('on' + type, handler);
    }
    return false;
}

var inputAttach = document.getElementById('input-file-attach');
var previewAttach = document.getElementById('preview-file-attach');

if (inputAttach && previewAttach) {
    addEvent(inputAttach, 'change', previewFiles.bind(this, inputAttach, previewAttach));
}

function previewFiles(input, preview) {
    preview.innerHTML = null;
    var files = input.files;
    var length = files.length;

    for (var i = 0; i < length; i++) {
        if (files[i].type.match('image.*')) {
            var reader = new FileReader();
            reader.onload = function (e) {
                preview.innerHTML += '<img data-action="zoom" src="' + e.target.result + '" />';
            };
            reader.readAsDataURL(files[i]);
        }
    }
}
