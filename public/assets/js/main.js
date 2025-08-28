/*-----------------------------------------------------------------------------------

    Theme Name: Lifest - Insurance Agency HTML Template
    Description: Insurance Agency HTML Template
    Author: #
    Version: 2.1
        
    ---------------------------------- */

!(function (s) {
    "use strict";
    var o = s(window);
    function a() {
        var e, a;
        (e = s(".full-screen")), (a = o.height()), e.css("min-height", a), (e = s("header").height()), (a = s(".screen-height")), (e = o.height() - e), a.css("height", e);
    }
    s("#preloader").fadeOut("normall", function () {
        s(this).remove();
    }),
        o.on("scroll", function () {
            var e = o.scrollTop(),
                a = s(".navbar-brand"),
                t = s(".navbar-brand.logodefault");
                // a = s(".navbar-brand img"),
                // t = s(".navbar-brand.logodefault img");
            e <= 50 ? (s("header").removeClass("scrollHeader").addClass("fixedHeader"), 
            a.attr("src", "assets/img/logos/logo-inner.png")) : (s("header").removeClass("fixedHeader").addClass("scrollHeader"), a.attr("src", "assets/img/logos/logo.png")),
                t.attr("src", "assets/img/logos/logo.png");
        }),
        o.on("scroll", function () {
            500 < s(this).scrollTop() ? s(".scroll-to-top").fadeIn(400) : s(".scroll-to-top").fadeOut(400);
        }),
        s(".scroll-to-top").on("click", function (e) {
            e.preventDefault(), s("html, body").animate({ scrollTop: 0 }, 600);
        }),
        new WOW({ boxClass: "wow", animateClass: "animated", offset: 0, mobile: !1, live: !0 }).init(),
        s(".parallax,.bg-img").each(function (e) {
            s(this).attr("data-background") && s(this).css("background-image", "url(" + s(this).data("background") + ")");
        }),
        s(".story-video").magnificPopup({ delegate: ".video", type: "iframe" }),
        s(".source-modal").magnificPopup({ type: "inline", mainClass: "mfp-fade", removalDelay: 160 }),
        s(".current-year").text(new Date().getFullYear()),
        o.resize(function (e) {
            setTimeout(function () {
                a();
            }, 500),
                e.preventDefault();
        }),
        a(),
        0 !== s(".copy-clipboard").length &&
            (new ClipboardJS(".copy-clipboard"),
            s(".copy-clipboard").on("click", function () {
                var e = s(this);
                e.text();
                e.text("Copied"),
                    setTimeout(function () {
                        e.text("Copy");
                    }, 2e3);
            })),
        s(document).ready(function () {
            s(".testimonial-carousel").owlCarousel({
                loop: !0,
                responsiveClass: !0,
                autoplay: !0,
                smartSpeed: 1500,
                nav: !1,
                dots: !0,
                center: !1,
                margin: 0,
                responsive: { 0: { items: 1, margin: 0 }, 768: { items: 1 }, 992: { items: 1 }, 1200: { items: 1 } },
            }),
                s(".testimonial-carousel-one").owlCarousel({
                    loop: !0,
                    responsiveClass: !0,
                    autoplay: !0,
                    smartSpeed: 1500,
                    nav: !1,
                    dots: !0,
                    center: !1,
                    margin: 30,
                    responsive: { 0: { items: 1, margin: 10 }, 768: { items: 1 }, 992: { items: 1 }, 1200: { items: 1 } },
                }),
                s(".testimonial-carousel-02").owlCarousel({
                    loop: !0,
                    responsiveClass: !0,
                    autoplay: !0,
                    smartSpeed: 1500,
                    nav: !1,
                    dots: !0,
                    center: !1,
                    margin: 0,
                    responsive: { 0: { items: 1, margin: 0 }, 768: { items: 1 }, 992: { items: 1 }, 1200: { items: 1 } },
                }),
                s(".testimonial-carousel-three").owlCarousel({
                    loop: !1,
                    responsiveClass: !0,
                    autoplay: !0,
                    autoplayTimeout: 5e3,
                    smartSpeed: 1500,
                    nav: !1,
                    navText: ["<i class='ti-arrow-left'></i>", "<i class='ti-arrow-right'></i>"],
                    dots: !0,
                    center: !0,
                    margin: 30,
                    responsive: { 0: { items: 1 }, 992: { items: 1, nav: !0 }, 1200: { items: 1, nav: !0 } },
                }),
                s(".feature-carousel").owlCarousel({
                    loop: !0,
                    responsiveClass: !0,
                    autoplay: !0,
                    smartSpeed: 1500,
                    nav: !1,
                    dots: !0,
                    center: !1,
                    margin: 0,
                    responsive: { 0: { items: 1 }, 768: { items: 2 }, 992: { items: 2 }, 1200: { items: 3 } },
                }),
                s(".clients-carousel").owlCarousel({
                    loop: !0,
                    responsiveClass: !0,
                    autoplay: !0,
                    smartSpeed: 1500,
                    nav: !1,
                    dots: !1,
                    center: !1,
                    margin: 10,
                    responsive: { 0: { items: 2 }, 768: { items: 4, margin: 30 }, 992: { items: 5, margin: 40 }, 1200: { items: 6, margin: 40 } },
                }),
                s(".portfolio-carousel").owlCarousel({
                    loop: !0,
                    responsiveClass: !0,
                    autoplay: !0,
                    smartSpeed: 1500,
                    nav: !1,
                    dots: !1,
                    center: !1,
                    margin: 20,
                    responsive: { 0: { items: 1 }, 576: { items: 2 }, 992: { items: 3 }, 1200: { items: 4 } },
                }),
                s(".about-carousel").owlCarousel({
                    loop: !0,
                    responsiveClass: !0,
                    autoplay: !0,
                    autoplayTimeout: 6e3,
                    smartSpeed: 1500,
                    nav: !0,
                    navText: ["<i class='ti-arrow-left'></i>", "<i class='ti-arrow-right'></i>"],
                    dots: !1,
                    center: !1,
                    margin: 80,
                    responsive: { 0: { items: 1 }, 768: { items: 1, margin: 30 }, 992: { items: 1, margin: 40 }, 1200: { items: 1 } },
                }),
                s(".portfolio-carousel-02").owlCarousel({
                    loop: !0,
                    responsiveClass: !0,
                    autoplay: !0,
                    smartSpeed: 1500,
                    nav: !1,
                    dots: !1,
                    center: !0,
                    margin: 30,
                    responsive: { 0: { items: 1, margin: 0 }, 768: { items: 2 }, 992: { items: 3 }, 1200: { items: 4 } },
                }),
                s(".services-carousel-one").owlCarousel({
                    loop: !0,
                    responsiveClass: !0,
                    autoplay: !0,
                    autoplayTimeout: 6e3,
                    smartSpeed: 1500,
                    nav: !1,
                    dots: !1,
                    center: !1,
                    margin: 30,
                    responsive: { 0: { items: 1, dots: !1 }, 576: { items: 2 }, 768: { items: 2 }, 992: { items: 3 }, 1200: { items: 4 } },
                }),
                s(".services-carousel-two").owlCarousel({
                    loop: !0,
                    responsiveClass: !0,
                    autoplay: !0,
                    smartSpeed: 1500,
                    autoplayTimeout: 6e3,
                    nav: !1,
                    navText: ["<i class='ti-arrow-left'></i>", "<i class='ti-arrow-right'></i>"],
                    dots: !1,
                    center: !1,
                    margin: 0,
                    responsive: { 0: { items: 1 }, 576: { items: 1, nav: !0 }, 992: { items: 2, nav: !0 }, 1200: { items: 3, nav: !0 } },
                }),
                s(".services-carousel-three").owlCarousel({
                    loop: !0,
                    responsiveClass: !0,
                    autoplay: !0,
                    smartSpeed: 1500,
                    autoplayTimeout: 6e3,
                    nav: !1,
                    navText: ["<i class='ti-arrow-left'></i>", "<i class='ti-arrow-right'></i>"],
                    dots: !1,
                    center: !1,
                    margin: 0,
                    responsive: { 0: { items: 1 }, 576: { items: 1, nav: !0 }, 992: { items: 2, nav: !0 }, 1200: { items: 3, nav: !0 } },
                }),
                s(".services-carousel-four").owlCarousel({
                    loop: !0,
                    responsiveClass: !0,
                    autoplay: !0,
                    autoplayTimeout: 6e3,
                    smartSpeed: 1500,
                    nav: !0,
                    navText: ["<i class='ti-angle-left'></i>", "<i class='ti-angle-right'></i>"],
                    dots: !1,
                    center: !1,
                    margin: 40,
                    responsive: { 0: { items: 1, nav: !1 }, 576: { items: 1, nav: !1 }, 768: { items: 2 }, 992: { items: 3 }, 1200: { items: 3 } },
                }),
                s(".slider-fade").owlCarousel({
                    items: 1,
                    loop: !0,
                    dots: !0,
                    margin: 0,
                    nav: !1,
                    navText: ["<i class='ti-angle-left'></i>", "<i class='ti-angle-right'></i>"],
                    autoplay: !0,
                    autoplayTimeout: 6e3,
                    smartSpeed: 1500,
                    mouseDrag: !1,
                    animateIn: "fadeIn",
                    animateOut: "fadeOut",
                    responsive: { 992: { nav: !1 } },
                }),
                s(".slider-fade2").owlCarousel({
                    items: 1,
                    loop: !0,
                    dots: !0,
                    margin: 0,
                    nav: !1,
                    navText: ["<i class='ti-angle-left'></i>", "<i class='ti-angle-right'></i>"],
                    autoplay: !0,
                    autoplayTimeout: 6e3,
                    smartSpeed: 1500,
                    mouseDrag: !1,
                    animateIn: "fadeIn",
                    animateOut: "fadeOut",
                    responsive: { 992: { nav: !0, dots: !1 } },
                }),
                s(".slider-fade3").owlCarousel({
                    items: 1,
                    loop: !0,
                    dots: !0,
                    margin: 0,
                    nav: !1,
                    navText: ["<i class='ti-arrow-left'></i>", "<i class='ti-arrow-right'></i>"],
                    autoplay: !0,
                    autoplayTimeout: 7e3,
                    smartSpeed: 1500,
                    animateIn: "fadeIn",
                    animateOut: "fadeOut",
                    responsive: { 992: { nav: !0, dots: !1 } },
                }),
                s(".owl-carousel").owlCarousel({ items: 1, loop: !0, dots: !1, margin: 0, autoplay: !0, smartSpeed: 500 }),
                s(".slider-fade").on("changed.owl.carousel", function (e) {
                    e = e.item.index - 2;
                    s("span").removeClass("animated fadeInUp"),
                        s("h1").removeClass("animated fadeInUp"),
                        s("p").removeClass("animated fadeInUp"),
                        s("a").removeClass("animated fadeInUp"),
                        s(".owl-item").not(".cloned").eq(e).find("span").addClass("animated fadeInUp"),
                        s(".owl-item").not(".cloned").eq(e).find("h1").addClass("animated fadeInUp"),
                        s(".owl-item").not(".cloned").eq(e).find("p").addClass("animated fadeInUp"),
                        s(".owl-item").not(".cloned").eq(e).find("a").addClass("animated fadeInUp");
                }),
                s(".slider-fade2").on("changed.owl.carousel", function (e) {
                    e = e.item.index - 2;
                    s("span").removeClass("animated fadeInUp"),
                        s("h1").removeClass("animated fadeInUp"),
                        s("p").removeClass("animated fadeInUp"),
                        s("a").removeClass("animated fadeInUp"),
                        s(".owl-item").not(".cloned").eq(e).find("span").addClass("animated fadeInUp"),
                        s(".owl-item").not(".cloned").eq(e).find("h1").addClass("animated fadeInUp"),
                        s(".owl-item").not(".cloned").eq(e).find("p").addClass("animated fadeInUp"),
                        s(".owl-item").not(".cloned").eq(e).find("a").addClass("animated fadeInUp");
                }),
                s(".slider-fade3").on("changed.owl.carousel", function (e) {
                    e = e.item.index - 2;
                    s(".small-title").removeClass("animated fadeInUp"),
                        s("h1").removeClass("animated fadeInUp"),
                        s("p").removeClass("animated fadeInUp"),
                        s("a").removeClass("animated fadeInUp"),
                        s(".banner-button").removeClass("animated fadeInUp"),
                        s(".owl-item").not(".cloned").eq(e).find(".small-title").addClass("animated fadeInUp"),
                        s(".owl-item").not(".cloned").eq(e).find("h1").addClass("animated fadeInUp"),
                        s(".owl-item").not(".cloned").eq(e).find("p").addClass("animated fadeInUp"),
                        s(".owl-item").not(".cloned").eq(e).find("a").addClass("animated fadeInUp"),
                        s(".owl-item").not(".cloned").eq(e).find(".banner-button").addClass("animated fadeInUp");
                }),
                0 !== s(".horizontaltab").length &&
                    s(".horizontaltab").easyResponsiveTabs({
                        type: "default",
                        width: "auto",
                        fit: !0,
                        tabidentify: "hor_1",
                        activate: function (e) {
                            var a = s(this),
                                t = s("#nested-tabInfo");
                            s("span", t).text(a.text()), t.show();
                        },
                    }),
                s(".countup").counterUp({ delay: 25, time: 2e3 }),
                s(".countdown").countdown({ date: "01 Dec 2026 00:01:00", format: "on" });
        }),
        o.on("load", function () {
            var a = s(".portfolio-gallery-isotope").isotope({});
            s(".filtering").on("click", "span", function () {
                var e = s(this).attr("data-filter");
                a.isotope({ filter: e });
            }),
                s(".filtering").on("click", "span", function () {
                    s(this).addClass("active").siblings().removeClass("active");
                }),
                s(".portfolio-gallery,.portfolio-gallery-isotope").lightGallery(),
                s(".portfolio-link").on("click", (e) => {
                    e.stopPropagation();
                });
        });
})(jQuery);
