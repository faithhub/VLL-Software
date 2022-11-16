!(function (t) {
    "use strict";

    t(".navbar .navbar-nav li a, .navbar .appointment-btn").on("click", function (o) {
        var n = t(this);
        t("html, body")
            .stop()
            .animate({ scrollTop: t(n.attr("href")).offset().top - 50 }, 50),
            o.preventDefault();
    }),
    t(document).on("click", ".navbar-collapse.in", function (o) {
        t(o.target).is("a") && "dropdown-toggle" != t(o.target).attr("class") && t(this).collapse("hide");
    }),
    t(".navbar .navbar-nav li a").on("click", function () {
        t(".navbar-collapse").collapse("hide");
    }),
    t(window).on("scroll", function () {
        t(this).scrollTop() > 120 ? t(".navbar-light").addClass("is-sticky") : t(".navbar-light").removeClass("is-sticky");
    }),
    t(".hero-slides").owlCarousel({ items: 1, nav: !1, dots: !0, touchDrag: !1, mouseDrag: !1, autoplay: !0, smartSpeed: 700, loop: !0, navText: ["<i class='icofont-rounded-left'></i>", "<i class='icofont-rounded-right'></i>"] }),
    (function (t) {
        t(".tab ul.tabs").addClass("active").find("> li:eq(0)").addClass("current"),
            t(".tab ul.tabs li a").on("click", function (o) {
                var n = t(this).closest(".tab"),
                    a = t(this).closest("li").index();
                n.find("ul.tabs > li").removeClass("current"),
                    t(this).closest("li").addClass("current"),
                    n
                        .find(".tab_content")
                        .find("div.tabs_item")
                        .not("div.tabs_item:eq(" + a + ")")
                        .slideUp(),
                    n
                        .find(".tab_content")
                        .find("div.tabs_item:eq(" + a + ")")
                        .slideDown(),
                    o.preventDefault();
            });
    })(jQuery),
    t(function () {
        t(".accordion")
            .find(".accordion-title")
            .on("click", function () {
                t(this).toggleClass("active"), t(this).next().slideToggle("fast"), t(".accordion-content").not(t(this).next()).slideUp("fast"), t(".accordion-title").not(t(this)).removeClass("active");
            });
    }),
    t(function () {
        t("#datepicker").datepicker();
    }),
    t(function () {
        try{var a=mixitup(".shorting",{controls:{toggleDefault:"none"}})}catch(b){}
    }),
    t(".popup-btn").magnificPopup({ type: "image", gallery: { enabled: !0 } }),
    t(".popup-video").magnificPopup({ disableOn: 320, type: "iframe", mainClass: "mfp-fade", removalDelay: 160, preloader: !1, fixedContentPos: !1 }),
    t(function () {
        t(window).on("scroll", function () {
            var o = t(window).scrollTop();
            o > 300 && t(".go-top").fadeIn("slow"), o < 300 && t(".go-top").fadeOut("slow");
        }),
            t(".go-top").on("click", function () {
                t("html, body").animate({ scrollTop: "0" }, 500);
            });
    });

    jQuery(window).on("load", function () {
        t(".preloader-area").fadeOut();
    });

})(jQuery);

try {
	// function to set a given theme/color-scheme
	function setTheme(themeName) {
		localStorage.setItem('goldmedi_theme', themeName);
		document.documentElement.className = themeName;
	}
	// function to toggle between light and dark theme
	function toggleTheme() {
		if (localStorage.getItem('goldmedi_theme') === 'theme-dark') {
			setTheme('theme-light');
		} else {
			setTheme('theme-dark');
		}
	}
	// Immediately invoked function to set the theme on initial load
	(function () {
		if (localStorage.getItem('goldmedi_theme') === 'theme-dark') {
			setTheme('theme-dark');
			document.getElementById('slider').checked = false;
		} else {
			setTheme('theme-light');
		document.getElementById('slider').checked = true;
		}
	})();
} catch (err) {}