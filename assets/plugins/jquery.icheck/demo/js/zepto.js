/*!
 * Zepto v1.0 zeptojs.com | MIT licensed
 * Modules: zepto, polyfill, event, data
 */
var Zepto = function () {
    function h(a) {
        return null == a ? String(a) : G[S.call(a)] || "object"
    }

    function m(a) {
        return "function" == h(a)
    }

    function p(a) {
        return null != a && a == a.window
    }

    function s(a) {
        return null != a && a.nodeType == a.DOCUMENT_NODE
    }

    function q(a) {
        return "object" == h(a)
    }

    function k(a) {
        return q(a) && !p(a) && a.__proto__ == Object.prototype
    }

    function t(a) {
        return a instanceof Array
    }

    function l(a) {
        return "number" == typeof a.length
    }

    function j(a) {
        return a.replace(/::/g, "/").replace(/([A-Z]+)([A-Z][a-z])/g, "$1_$2").replace(/([a-z\d])([A-Z])/g,
            "$1_$2").replace(/_/g, "-").toLowerCase()
    }

    function r(a) {
        return a in H ? H[a] : H[a] = RegExp("(^|\\s)" + a + "(\\s|$)")
    }

    function A(a) {
        return "children"in a ? B.call(a.children) : c.map(a.childNodes, function (a) {
            if (1 == a.nodeType)return a
        })
    }

    function C(a, b, d) {
        for (g in b)d && (k(b[g]) || t(b[g])) ? (k(b[g]) && !k(a[g]) && (a[g] = {}), t(b[g]) && !t(a[g]) && (a[g] = []), C(a[g], b[g], d)) : b[g] !== f && (a[g] = b[g])
    }

    function y(a, b) {
        return b === f ? c(a) : c(a).filter(b)
    }

    function x(a, b, d, c) {
        return m(b) ? b.call(a, d, c) : b
    }

    function z(a, b) {
        var d = a.className,
            c = d && d.baseVal !== f;
        if (b === f)return c ? d.baseVal : d;
        c ? d.baseVal = b : a.className = b
    }

    function E(a) {
        var b;
        try {
            return a ? "true" == a || ("false" == a ? !1 : "null" == a ? null : !isNaN(b = Number(a)) ? b : /^[\[\{]/.test(a) ? c.parseJSON(a) : a) : a
        } catch (d) {
            return a
        }
    }

    function e(a, b) {
        b(a);
        for (var d in a.childNodes)e(a.childNodes[d], b)
    }

    var f, g, c, u, w = [], B = w.slice, D = w.filter, v = window.document, I = {}, H = {}, J = v.defaultView.getComputedStyle, M = {
            "column-count": 1,
            columns: 1,
            "font-weight": 1,
            "line-height": 1,
            opacity: 1,
            "z-index": 1,
            zoom: 1
        }, N = /^\s*<(\w+|!)[^>]*>/,
        T = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/ig, O = /^(?:body|html)$/i, U = "val css html text data width height offset".split(" "), K = v.createElement("table"), P = v.createElement("tr"), Q = {
            tr: v.createElement("tbody"),
            tbody: K,
            thead: K,
            tfoot: K,
            td: P,
            th: P,
            "*": v.createElement("div")
        }, V = /complete|loaded|interactive/, W = /^\.([\w-]+)$/, X = /^#([\w-]*)$/, Y = /^[\w-]+$/, G = {}, S = G.toString, n = {}, L, F, R = v.createElement("div");
    n.matches = function (a, b) {
        if (!a || 1 !== a.nodeType)return !1;
        var d = a.webkitMatchesSelector ||
            a.mozMatchesSelector || a.oMatchesSelector || a.matchesSelector;
        if (d)return d.call(a, b);
        var c;
        c = a.parentNode;
        (d = !c) && (c = R).appendChild(a);
        c = ~n.qsa(c, b).indexOf(a);
        d && R.removeChild(a);
        return c
    };
    L = function (a) {
        return a.replace(/-+(.)?/g, function (a, d) {
            return d ? d.toUpperCase() : ""
        })
    };
    F = function (a) {
        return D.call(a, function (b, d) {
            return a.indexOf(b) == d
        })
    };
    n.fragment = function (a, b, d) {
        a.replace && (a = a.replace(T, "<$1></$2>"));
        b === f && (b = N.test(a) && RegExp.$1);
        b in Q || (b = "*");
        var e, g = Q[b];
        g.innerHTML = "" + a;
        a = c.each(B.call(g.childNodes),
            function () {
                g.removeChild(this)
            });
        k(d) && (e = c(a), c.each(d, function (a, b) {
            if (-1 < U.indexOf(a))e[a](b); else e.attr(a, b)
        }));
        return a
    };
    n.Z = function (a, b) {
        a = a || [];
        a.__proto__ = c.fn;
        a.selector = b || "";
        return a
    };
    n.isZ = function (a) {
        return a instanceof n.Z
    };
    n.init = function (a, b) {
        if (a) {
            if (m(a))return c(v).ready(a);
            if (n.isZ(a))return a;
            var d;
            if (t(a))d = D.call(a, function (a) {
                return null != a
            }); else if (q(a))d = [k(a) ? c.extend({}, a) : a], a = null; else if (N.test(a))d = n.fragment(a.trim(), RegExp.$1, b), a = null; else {
                if (b !== f)return c(b).find(a);
                d = n.qsa(v, a)
            }
            return n.Z(d, a)
        }
        return n.Z()
    };
    c = function (a, b) {
        return n.init(a, b)
    };
    c.extend = function (a) {
        var b, d = B.call(arguments, 1);
        "boolean" == typeof a && (b = a, a = d.shift());
        d.forEach(function (d) {
            C(a, d, b)
        });
        return a
    };
    n.qsa = function (a, b) {
        var d;
        return s(a) && X.test(b) ? (d = a.getElementById(RegExp.$1)) ? [d] : [] : 1 !== a.nodeType && 9 !== a.nodeType ? [] : B.call(W.test(b) ? a.getElementsByClassName(RegExp.$1) : Y.test(b) ? a.getElementsByTagName(b) : a.querySelectorAll(b))
    };
    c.contains = function (a, b) {
        return a !== b && a.contains(b)
    };
    c.type =
        h;
    c.isFunction = m;
    c.isWindow = p;
    c.isArray = t;
    c.isPlainObject = k;
    c.isEmptyObject = function (a) {
        for (var b in a)return !1;
        return !0
    };
    c.inArray = function (a, b, d) {
        return w.indexOf.call(b, a, d)
    };
    c.camelCase = L;
    c.trim = function (a) {
        return a.trim()
    };
    c.uuid = 0;
    c.support = {};
    c.expr = {};
    c.map = function (a, b) {
        var d, e = [], f;
        if (l(a))for (f = 0; f < a.length; f++)d = b(a[f], f), null != d && e.push(d); else for (f in a)d = b(a[f], f), null != d && e.push(d);
        return 0 < e.length ? c.fn.concat.apply([], e) : e
    };
    c.each = function (a, b) {
        var d;
        if (l(a))for (d = 0; d < a.length &&
        !1 !== b.call(a[d], d, a[d]); d++); else for (d in a)if (!1 === b.call(a[d], d, a[d]))break;
        return a
    };
    c.grep = function (a, b) {
        return D.call(a, b)
    };
    window.JSON && (c.parseJSON = JSON.parse);
    c.each("Boolean Number String Function Array Date RegExp Object Error".split(" "), function (a, b) {
        G["[object " + b + "]"] = b.toLowerCase()
    });
    c.fn = {
        forEach: w.forEach,
        reduce: w.reduce,
        push: w.push,
        sort: w.sort,
        indexOf: w.indexOf,
        concat: w.concat,
        map: function (a) {
            return c(c.map(this, function (b, d) {
                return a.call(b, d, b)
            }))
        },
        slice: function () {
            return c(B.apply(this,
                arguments))
        },
        ready: function (a) {
            V.test(v.readyState) ? a(c) : v.addEventListener("DOMContentLoaded", function () {
                a(c)
            }, !1);
            return this
        },
        get: function (a) {
            return a === f ? B.call(this) : this[0 <= a ? a : a + this.length]
        },
        toArray: function () {
            return this.get()
        },
        size: function () {
            return this.length
        },
        remove: function () {
            return this.each(function () {
                null != this.parentNode && this.parentNode.removeChild(this)
            })
        },
        each: function (a) {
            w.every.call(this, function (b, d) {
                return !1 !== a.call(b, d, b)
            });
            return this
        },
        filter: function (a) {
            return m(a) ? this.not(this.not(a)) :
                c(D.call(this, function (b) {
                    return n.matches(b, a)
                }))
        },
        add: function (a, b) {
            return c(F(this.concat(c(a, b))))
        },
        is: function (a) {
            return 0 < this.length && n.matches(this[0], a)
        },
        not: function (a) {
            var b = [];
            if (m(a) && a.call !== f)this.each(function (d) {
                a.call(this, d) || b.push(this)
            }); else {
                var d = "string" == typeof a ? this.filter(a) : l(a) && m(a.item) ? B.call(a) : c(a);
                this.forEach(function (a) {
                    0 > d.indexOf(a) && b.push(a)
                })
            }
            return c(b)
        },
        has: function (a) {
            return this.filter(function () {
                return q(a) ? c.contains(this, a) : c(this).find(a).size()
            })
        },
        eq: function (a) {
            return -1 === a ? this.slice(a) : this.slice(a, +a + 1)
        },
        first: function () {
            var a = this[0];
            return a && !q(a) ? a : c(a)
        },
        last: function () {
            var a = this[this.length - 1];
            return a && !q(a) ? a : c(a)
        },
        find: function (a) {
            var b = this;
            return "object" == typeof a ? c(a).filter(function () {
                var a = this;
                return w.some.call(b, function (b) {
                    return c.contains(b, a)
                })
            }) : 1 == this.length ? c(n.qsa(this[0], a)) : this.map(function () {
                return n.qsa(this, a)
            })
        },
        closest: function (a, b) {
            var d = this[0], e = !1;
            for ("object" == typeof a && (e = c(a)); d && !(e ? 0 <= e.indexOf(d) :
                n.matches(d, a));)d = d !== b && !s(d) && d.parentNode;
            return c(d)
        },
        parents: function (a) {
            for (var b = [], d = this; 0 < d.length;)d = c.map(d, function (a) {
                if ((a = a.parentNode) && !s(a) && 0 > b.indexOf(a))return b.push(a), a
            });
            return y(b, a)
        },
        parent: function (a) {
            return y(F(this.pluck("parentNode")), a)
        },
        children: function (a) {
            return y(this.map(function () {
                return A(this)
            }), a)
        },
        contents: function () {
            return this.map(function () {
                return B.call(this.childNodes)
            })
        },
        siblings: function (a) {
            return y(this.map(function (a, d) {
                return D.call(A(d.parentNode),
                    function (a) {
                        return a !== d
                    })
            }), a)
        },
        empty: function () {
            return this.each(function () {
                this.innerHTML = ""
            })
        },
        pluck: function (a) {
            return c.map(this, function (b) {
                return b[a]
            })
        },
        show: function () {
            return this.each(function () {
                "none" == this.style.display && (this.style.display = null);
                if ("none" == J(this, "").getPropertyValue("display")) {
                    var a = this.style, b = this.nodeName, d, c;
                    I[b] || (d = v.createElement(b), v.body.appendChild(d), c = J(d, "").getPropertyValue("display"), d.parentNode.removeChild(d), "none" == c && (c = "block"), I[b] = c);
                    a.display =
                        I[b]
                }
            })
        },
        replaceWith: function (a) {
            return this.before(a).remove()
        },
        wrap: function (a) {
            var b = m(a);
            if (this[0] && !b)var d = c(a).get(0), e = d.parentNode || 1 < this.length;
            return this.each(function (f) {
                c(this).wrapAll(b ? a.call(this, f) : e ? d.cloneNode(!0) : d)
            })
        },
        wrapAll: function (a) {
            if (this[0]) {
                c(this[0]).before(a = c(a));
                for (var b; (b = a.children()).length;)a = b.first();
                c(a).append(this)
            }
            return this
        },
        wrapInner: function (a) {
            var b = m(a);
            return this.each(function (d) {
                var e = c(this), f = e.contents();
                d = b ? a.call(this, d) : a;
                f.length ? f.wrapAll(d) :
                    e.append(d)
            })
        },
        unwrap: function () {
            this.parent().each(function () {
                c(this).replaceWith(c(this).children())
            });
            return this
        },
        clone: function () {
            return this.map(function () {
                return this.cloneNode(!0)
            })
        },
        hide: function () {
            return this.css("display", "none")
        },
        toggle: function (a) {
            return this.each(function () {
                var b = c(this);
                (a === f ? "none" == b.css("display") : a) ? b.show() : b.hide()
            })
        },
        prev: function (a) {
            return c(this.pluck("previousElementSibling")).filter(a || "*")
        },
        next: function (a) {
            return c(this.pluck("nextElementSibling")).filter(a ||
            "*")
        },
        html: function (a) {
            return a === f ? 0 < this.length ? this[0].innerHTML : null : this.each(function (b) {
                var d = this.innerHTML;
                c(this).empty().append(x(this, a, b, d))
            })
        },
        text: function (a) {
            return a === f ? 0 < this.length ? this[0].textContent : null : this.each(function () {
                this.textContent = a
            })
        },
        attr: function (a, b) {
            var d;
            return "string" == typeof a && b === f ? 0 == this.length || 1 !== this[0].nodeType ? f : "value" == a && "INPUT" == this[0].nodeName ? this.val() : !(d = this[0].getAttribute(a)) && a in this[0] ? this[0][a] : d : this.each(function (d) {
                if (1 === this.nodeType)if (q(a))for (g in a) {
                    d =
                        g;
                    var c = a[g];
                    null == c ? this.removeAttribute(d) : this.setAttribute(d, c)
                } else d = x(this, b, d, this.getAttribute(a)), null == d ? this.removeAttribute(a) : this.setAttribute(a, d)
            })
        },
        removeAttr: function (a) {
            return this.each(function () {
                1 === this.nodeType && this.removeAttribute(a)
            })
        },
        prop: function (a, b) {
            return b === f ? this[0] && this[0][a] : this.each(function (d) {
                this[a] = x(this, b, d, this[a])
            })
        },
        data: function (a, b) {
            var d = this.attr("data-" + j(a), b);
            return null !== d ? E(d) : f
        },
        val: function (a) {
            return a === f ? this[0] && (this[0].multiple ? c(this[0]).find("option").filter(function () {
                return this.selected
            }).pluck("value") :
                this[0].value) : this.each(function (b) {
                this.value = x(this, a, b, this.value)
            })
        },
        offset: function (a) {
            if (a)return this.each(function (b) {
                var e = c(this);
                b = x(this, a, b, e.offset());
                var f = e.offsetParent().offset();
                b = {top: b.top - f.top, left: b.left - f.left};
                "static" == e.css("position") && (b.position = "relative");
                e.css(b)
            });
            if (0 == this.length)return null;
            var b = this[0].getBoundingClientRect();
            return {
                left: b.left + window.pageXOffset,
                top: b.top + window.pageYOffset,
                width: Math.round(b.width),
                height: Math.round(b.height)
            }
        },
        css: function (a,
                       b) {
            if (2 > arguments.length && "string" == typeof a)return this[0] && (this[0].style[L(a)] || J(this[0], "").getPropertyValue(a));
            var d = "";
            if ("string" == h(a))!b && 0 !== b ? this.each(function () {
                this.style.removeProperty(j(a))
            }) : d = j(a) + ":" + ("number" == typeof b && !M[j(a)] ? b + "px" : b); else for (g in a)!a[g] && 0 !== a[g] ? this.each(function () {
                this.style.removeProperty(j(g))
            }) : d += j(g) + ":" + ("number" == typeof a[g] && !M[j(g)] ? a[g] + "px" : a[g]) + ";";
            return this.each(function () {
                this.style.cssText += ";" + d
            })
        },
        index: function (a) {
            return a ? this.indexOf(c(a)[0]) :
                this.parent().children().indexOf(this[0])
        },
        hasClass: function (a) {
            return w.some.call(this, function (a) {
                return this.test(z(a))
            }, r(a))
        },
        addClass: function (a) {
            return this.each(function (b) {
                u = [];
                var d = z(this);
                x(this, a, b, d).split(/\s+/g).forEach(function (a) {
                    c(this).hasClass(a) || u.push(a)
                }, this);
                u.length && z(this, d + (d ? " " : "") + u.join(" "))
            })
        },
        removeClass: function (a) {
            return this.each(function (b) {
                if (a === f)return z(this, "");
                u = z(this);
                x(this, a, b, u).split(/\s+/g).forEach(function (a) {
                    u = u.replace(r(a), " ")
                });
                z(this,
                    u.trim())
            })
        },
        toggleClass: function (a, b) {
            return this.each(function (d) {
                var e = c(this);
                x(this, a, d, z(this)).split(/\s+/g).forEach(function (a) {
                    (b === f ? !e.hasClass(a) : b) ? e.addClass(a) : e.removeClass(a)
                })
            })
        },
        scrollTop: function () {
            if (this.length)return "scrollTop"in this[0] ? this[0].scrollTop : this[0].scrollY
        },
        position: function () {
            if (this.length) {
                var a = this[0], b = this.offsetParent(), d = this.offset(), e = O.test(b[0].nodeName) ? {
                    top: 0,
                    left: 0
                } : b.offset();
                d.top -= parseFloat(c(a).css("margin-top")) || 0;
                d.left -= parseFloat(c(a).css("margin-left")) ||
                0;
                e.top += parseFloat(c(b[0]).css("border-top-width")) || 0;
                e.left += parseFloat(c(b[0]).css("border-left-width")) || 0;
                return {top: d.top - e.top, left: d.left - e.left}
            }
        },
        offsetParent: function () {
            return this.map(function () {
                for (var a = this.offsetParent || v.body; a && !O.test(a.nodeName) && "static" == c(a).css("position");)a = a.offsetParent;
                return a
            })
        }
    };
    c.fn.detach = c.fn.remove;
    ["width", "height"].forEach(function (a) {
        c.fn[a] = function (b) {
            var d, e = this[0], g = a.replace(/./, function (a) {
                return a[0].toUpperCase()
            });
            return b === f ? p(e) ?
                e["inner" + g] : s(e) ? e.documentElement["offset" + g] : (d = this.offset()) && d[a] : this.each(function (d) {
                e = c(this);
                e.css(a, x(this, b, d, e[a]()))
            })
        }
    });
    ["after", "prepend", "before", "append"].forEach(function (a, b) {
        var d = b % 2;
        c.fn[a] = function () {
            var a, f = c.map(arguments, function (b) {
                a = h(b);
                return "object" == a || "array" == a || null == b ? b : n.fragment(b)
            }), g, u = 1 < this.length;
            return 1 > f.length ? this : this.each(function (a, h) {
                g = d ? h : h.parentNode;
                h = 0 == b ? h.nextSibling : 1 == b ? h.firstChild : 2 == b ? h : null;
                f.forEach(function (a) {
                    if (u)a = a.cloneNode(!0);
                    else if (!g)return c(a).remove();
                    e(g.insertBefore(a, h), function (a) {
                        null != a.nodeName && ("SCRIPT" === a.nodeName.toUpperCase() && (!a.type || "text/javascript" === a.type) && !a.src) && window.eval.call(window, a.innerHTML)
                    })
                })
            })
        };
        c.fn[d ? a + "To" : "insert" + (b ? "Before" : "After")] = function (b) {
            c(b)[a](this);
            return this
        }
    });
    n.Z.prototype = c.fn;
    n.uniq = F;
    n.deserializeValue = E;
    c.zepto = n;
    return c
}();
window.Zepto = Zepto;
"$"in window || (window.$ = Zepto);
(function (h) {
    String.prototype.trim === h && (String.prototype.trim = function () {
        return this.replace(/^\s+|\s+$/g, "")
    });
    Array.prototype.reduce === h && (Array.prototype.reduce = function (m) {
        if (void 0 === this || null === this)throw new TypeError;
        var p = Object(this), s = p.length >>> 0, q = 0, k;
        if ("function" != typeof m)throw new TypeError;
        if (0 == s && 1 == arguments.length)throw new TypeError;
        if (2 <= arguments.length)k = arguments[1]; else {
            do {
                if (q in p) {
                    k = p[q++];
                    break
                }
                if (++q >= s)throw new TypeError;
            } while (1)
        }
        for (; q < s;)q in p && (k = m.call(h,
            k, p[q], q, p)), q++;
        return k
    })
})();
(function (h) {
    function m(e) {
        return e._zid || (e._zid = r++)
    }

    function p(e, f, g, c) {
        f = s(f);
        if (f.ns)var h = RegExp("(?:^| )" + f.ns.replace(" ", " .* ?") + "(?: |$)");
        return (j[m(e)] || []).filter(function (e) {
            return e && (!f.e || e.e == f.e) && (!f.ns || h.test(e.ns)) && (!g || m(e.fn) === m(g)) && (!c || e.sel == c)
        })
    }

    function s(e) {
        e = ("" + e).split(".");
        return {e: e[0], ns: e.slice(1).sort().join(" ")}
    }

    function q(e, f, g) {
        "string" != h.type(e) ? h.each(e, g) : e.split(/\s/).forEach(function (e) {
            g(e, f)
        })
    }

    function k(e, f, g, c, u, l) {
        var k = m(e), r = j[k] || (j[k] =
                []);
        q(f, g, function (f, g) {
            var j = s(f);
            j.fn = g;
            j.sel = c;
            j.e in C && (g = function (e) {
                var c = e.relatedTarget;
                if (!c || c !== this && !h.contains(this, c))return j.fn.apply(this, arguments)
            });
            j.del = u && u(g, f);
            var k = j.del || g;
            j.proxy = function (c) {
                var f = k.apply(e, [c].concat(c.data));
                !1 === f && (c.preventDefault(), c.stopPropagation());
                return f
            };
            j.i = r.length;
            r.push(j);
            e.addEventListener(C[j.e] || j.e, j.proxy, j.del && ("focus" == j.e || "blur" == j.e) || !!l)
        })
    }

    function t(e, f, g, c, h) {
        var l = m(e);
        q(f || "", g, function (f, g) {
            p(e, f, g, c).forEach(function (c) {
                delete j[l][c.i];
                e.removeEventListener(C[c.e] || c.e, c.proxy, c.del && ("focus" == c.e || "blur" == c.e) || !!h)
            })
        })
    }

    function l(e) {
        var f, g = {originalEvent: e};
        for (f in e)!z.test(f) && void 0 !== e[f] && (g[f] = e[f]);
        h.each(E, function (c, f) {
            g[c] = function () {
                this[f] = y;
                return e[c].apply(e, arguments)
            };
            g[f] = x
        });
        return g
    }

    var j = {}, r = 1, A = {}, C = {mouseenter: "mouseover", mouseleave: "mouseout"};
    A.click = A.mousedown = A.mouseup = A.mousemove = "MouseEvents";
    h.event = {add: k, remove: t};
    h.proxy = function (e, f) {
        if (h.isFunction(e)) {
            var g = function () {
                return e.apply(f, arguments)
            };
            g._zid = m(e);
            return g
        }
        if ("string" == typeof f)return h.proxy(e[f], e);
        throw new TypeError("expected function");
    };
    h.fn.bind = function (e, f) {
        return this.each(function () {
            k(this, e, f)
        })
    };
    h.fn.unbind = function (e, f) {
        return this.each(function () {
            t(this, e, f)
        })
    };
    h.fn.one = function (e, f) {
        return this.each(function (g, c) {
            k(this, e, f, null, function (e, f) {
                return function () {
                    var g = e.apply(c, arguments);
                    t(c, f, e);
                    return g
                }
            })
        })
    };
    var y = function () {
        return !0
    }, x = function () {
        return !1
    }, z = /^([A-Z]|layer[XY]$)/, E = {
        preventDefault: "isDefaultPrevented",
        stopImmediatePropagation: "isImmediatePropagationStopped", stopPropagation: "isPropagationStopped"
    };
    h.fn.delegate = function (e, f, g) {
        return this.each(function (c, j) {
            k(j, f, g, e, function (c) {
                return function (f) {
                    var g, k = h(f.target).closest(e, j).get(0);
                    if (k)return g = h.extend(l(f), {
                        currentTarget: k,
                        liveFired: j
                    }), c.apply(k, [g].concat([].slice.call(arguments, 1)))
                }
            })
        })
    };
    h.fn.undelegate = function (e, f, g) {
        return this.each(function () {
            t(this, f, g, e)
        })
    };
    h.fn.live = function (e, f) {
        h(document.body).delegate(this.selector, e, f);
        return this
    };
    h.fn.die = function (e, f) {
        h(document.body).undelegate(this.selector, e, f);
        return this
    };
    h.fn.on = function (e, f, g) {
        return !f || h.isFunction(f) ? this.bind(e, f || g) : this.delegate(f, e, g)
    };
    h.fn.off = function (e, f, g) {
        return !f || h.isFunction(f) ? this.unbind(e, f || g) : this.undelegate(f, e, g)
    };
    h.fn.trigger = function (e, f) {
        if ("string" == typeof e || h.isPlainObject(e))e = h.Event(e);
        var g = e;
        if (!("defaultPrevented"in g)) {
            g.defaultPrevented = !1;
            var c = g.preventDefault;
            g.preventDefault = function () {
                this.defaultPrevented = !0;
                c.call(this)
            }
        }
        e.data =
            f;
        return this.each(function () {
            "dispatchEvent"in this && this.dispatchEvent(e)
        })
    };
    h.fn.triggerHandler = function (e, f) {
        var g, c;
        this.each(function (j, k) {
            g = l("string" == typeof e ? h.Event(e) : e);
            g.data = f;
            g.target = k;
            h.each(p(k, e.type || e), function (e, f) {
                c = f.proxy(g);
                if (g.isImmediatePropagationStopped())return !1
            })
        });
        return c
    };
    "focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select keydown keypress keyup error".split(" ").forEach(function (e) {
        h.fn[e] =
            function (f) {
                return f ? this.bind(e, f) : this.trigger(e)
            }
    });
    ["focus", "blur"].forEach(function (e) {
        h.fn[e] = function (f) {
            f ? this.bind(e, f) : this.each(function () {
                try {
                    this[e]()
                } catch (f) {
                }
            });
            return this
        }
    });
    h.Event = function (e, f) {
        "string" != typeof e && (f = e, e = f.type);
        var g = document.createEvent(A[e] || "Events"), c = !0;
        if (f)for (var h in f)"bubbles" == h ? c = !!f[h] : g[h] = f[h];
        g.initEvent(e, c, !0, null, null, null, null, null, null, null, null, null, null, null, null);
        g.isDefaultPrevented = function () {
            return this.defaultPrevented
        };
        return g
    }
})(Zepto);
(function (h) {
    function m(l, j) {
        var r = l[t], r = r && s[r];
        if (void 0 === j)return r || p(l);
        if (r) {
            if (j in r)return r[j];
            var m = k(j);
            if (m in r)return r[m]
        }
        return q.call(h(l), j)
    }

    function p(l, j, m) {
        var q = l[t] || (l[t] = ++h.uuid), p;
        if (!(p = s[q])) {
            p = s;
            var y = {};
            h.each(l.attributes, function (j, l) {
                0 == l.name.indexOf("data-") && (y[k(l.name.replace("data-", ""))] = h.zepto.deserializeValue(l.value))
            });
            p = p[q] = y
        }
        l = p;
        void 0 !== j && (l[k(j)] = m);
        return l
    }

    var s = {}, q = h.fn.data, k = h.camelCase, t = h.expando = "Zepto" + +new Date;
    h.fn.data = function (l,
                          j) {
        return void 0 === j ? h.isPlainObject(l) ? this.each(function (j, k) {
            h.each(l, function (h, j) {
                p(k, h, j)
            })
        }) : 0 == this.length ? void 0 : m(this[0], l) : this.each(function () {
            p(this, l, j)
        })
    };
    h.fn.removeData = function (l) {
        "string" == typeof l && (l = l.split(/\s+/));
        return this.each(function () {
            var j = this[t], m = j && s[j];
            m && h.each(l, function () {
                delete m[k(this)]
            })
        })
    }
})(Zepto);