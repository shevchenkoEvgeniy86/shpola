function animScroll() {
    var e = $(window).height() / 1.2, o = $(this).scrollTop() + e,
        t = $("[data-circle-first] [data-circle-1-img-1]").offset().top,
        r = $("[data-circle-2] [data-circle-up]").offset().top,
        m = $("[data-circle-map] [data-circle-m]").offset().top,
        a = $("[data-circle-3] [data-circle-1-img-1]").offset().top,
        n = ($("#map_canvas").offset().top, $(".main-wrap #pay-method-section .pull-left").offset().top, 0);
    e = $(window).height(), o >= t && $("[data-circle-first] .col-sm-6 ").each(function () {
        $(this).addClass("anim-show").css("transition-delay", n + "s"), n += .3
    }), n = 0,
        o >= r && $("[data-circle-2] > .border-before").each(function () {
        $(this).addClass("anim-show-top").css("transition-delay", n + "s"), n += .3
    }), n = 0,
        o >= m && $("[data-circle-map] .map-border-before").each(function () {
            $(this).addClass("anim-show-top-m").css("transition-delay", n + "s"), n += .3
        }), n = 0,
        o >= a && $("[data-circle-3] > .work-inner-to").each(function () {
        $(this).addClass("anim-show").css("transition-delay", n + "s"), n += .3
    }), n = 0
}
function CreateAvAlertPopup2(e, o) {
    return $(".av-alert-popup").remove(), $('<div class="av-alert-popup">' + e + "<div data-close-form2></div></div>").appendTo("body").on("click", "[data-close-form2]", function () {
        $(this).closest(".av-alert-popup").fadeOut(), $("[form-input-error-123]").removeClass("show");
        AvBlurScreen("off");
    })
}
function CreateAvAlertPopup3(e, o) {
    return $(".av-alert-popup").remove(), $('<div class="av-alert-popup av-alert-popup-3"><div class="col-md-12"><div class="col-md-6 pull-left text-center text-uppercase"><br><p>металлочерепица</p><div img></div><div table>' + $("#hover-section-2 table").html() + '</div></div><div class="col-md-6 pull-right">' + e + "</div><div data-close-form2></div></div></div>").appendTo("body").on("click", "[data-close-form2]", function () {
        $(this).closest(".av-alert-popup").remove(), $("[form-input-error-123]").removeClass("show")
    })
}
function ShowPopUp() {
    AvBlurScreen("on", 9999), $("#form-anwer123").hide(), CreateAvAlertPopup2($("#form-anwer123").html(), "").positionCenter(999999).on("remove", function () {
        $("body").removeClass("stop-scrolling")
    })
}
function changeUrl() {
    var e = {foo: "bar"};
    history.pushState(e, "page 1", "https://www.avsteel.com.ua")
}
$(function () {
    function e() {
        function e() {
            var e = new google.maps.Map(document.getElementById("map_canvas"), {
                center: {
                    lat: 48.464242,
                    lng: 35.052390
                },
                zoom: 15,
                zoomControl: !0,
                scrollwheel: !1,
                scaleControl: !1,
                mapTypeControl: !0,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            google.maps.event.addListener(e, "idle", function () {
                $(window).scroll(function () {
                    var o = $(window).height() / 1.9, r = $(this).scrollTop() + o;
                    r >= $("#map_canvas").offset().top && t(e)
                })
            }), o++
        }

        function t(e) {
            if (!$("#map_canvas").is("[markers-seted]")) {
                for (var o = [
                    ['м. Дніпро, вул. Шолом-Алейхема, 5<br> Телефон: <a href="tel:+3(056) 790-01-20">+3(056) 790-01-20</a><br><a href="tel:+3(050) 888-89-09">+3(050) 888-89-09</a>', 48.4642429, 35.0523904, 65]
                    // ['г. Хмельницкий, ул. Курчатова, 8<br> Телефон: <a href="tel:0675669522">067 566 95 22</a>', 49.440058, 26.947964, 6],
                    // ['г. Киев, ул. Автопарковая, 5<br> Телефон: <a href="tel:+380672314784">067 231 47 84</a>', 50.396999, 30.686763, 5],
                    // ['г. Херсон, ул. Тираспольская, 1<br> Телефон: <a href="tel:+380676169916">067 616 99 16</a>', 46.64254, 32.620287, 3],
                    // ['г. Харьков, ул. Пушкинская, 109<br> Телефон: <a href="tel:+380675758917">067 575 89 17</a>', 50.019081, 36.264693, 2],
                    // ['г. Львов, ул. Навроцкого, 1<br> Телефон: <a href="tel:0674454319">067 445 43 19</a>', 49.811408, 24.047117, 1]
                ], t = {
                    url: "/upload/medialibrary/769/map-marker-new.png",
                    size: new google.maps.Size(40, 60),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(18, 45)
                }, r = 0; r < o.length; r++) {
                    var a = o[r], n = new google.maps.Marker({
                        position: {lat: a[1], lng: a[2]},
                        map: e,
                        animation: google.maps.Animation.DROP,
                        icon: t,
                        content: a[0],
                        zIndex: a[3]
                    }), i = new google.maps.InfoWindow;
                    google.maps.event.addListener(n, "click", function (o, t, r) {
                        return function () {
                            r.setContent(this.content), r.open(e, this)
                        }
                    }(n, r, i))
                }
                $("#map_canvas").attr("markers-seted", !0)
            }
        }

        1 == o && e()
    }




    $(document).on("keydown", ".inputtext.phone", function (e) {
        46 == e.keyCode || 8 == e.keyCode || 9 == e.keyCode || 27 == e.keyCode || 65 == e.keyCode && e.ctrlKey === !0 || e.keyCode >= 35 && e.keyCode <= 39 || (e.keyCode < 48 || e.keyCode > 57) && (e.keyCode < 96 || e.keyCode > 105) && e.preventDefault()
    }), $("#hamburger").click(function () {
        $(".av-alert-popup").remove(), $(this).toggleClass("open"), $(".bg-mobile-menu").fadeToggle(400, "swing").toggleClass("hidden"), $(".bg-mobile-menu").bind("touchmove", function (e) {
            e.preventDefault()
        })
    }), $("#mobile-menu li a").on("click", function () {
        $(".bg-mobile-menu").toggleClass("hidden"), $("#hamburger").toggleClass("open")
    }), $("#partners-form-btn2").on("click", function () {
        $("body").addClass("stop-scrolling"), AvBlurScreen("on", "99999"), CreateAvAlertPopup2($("[data-partners-form]").html(), "").positionCenter(999999).on("remove", function () {
            AvBlurScreen("off"), $("body").removeClass("stop-scrolling")
        })
    }), $("body").on("mouseenter touchstart", ".main-wrap .hover-section-1-plus-img", function () {
        var e = $(this).offset();
        $("#placeholder-hover-wrap").html($(this).attr("data-placeholderText")).fadeIn().css({
            "z-index": 9,
            left: e.left - 20 + "px",
            top: e.top - $("#placeholder-hover-wrap").height() - 50 + "px"
        })
    }), $("#hover-section-2-roof-img, #hover-section-1-roof-img").mouseout(function () {
        $("#placeholder-hover-wrap").hide()
    }), $("body").on("click", "#av-blur-screen", function () {
        $(".av-alert-popup").hide();
        AvBlurScreen("off");
        $('.popUp').fadeOut();
    }), $(window).on("resize22", function () {
        $("#placeholder-hover-wrap").hide(), AvBlurScreen("off"), $(".av-alert-popup").remove(), $("#hamburger").removeClass("open"), $(".bg-mobile-menu").addClass("hidden")
    }), $(window).on("scroll", function () {
        var o = $("#map-wrap").offset().top;
        $(this).scrollTop() > o / 2 && e(), $(this).scrollTop() > 700 ? $(".main-wrap .main-menu-fixed").addClass("fixed") : $(".main-wrap .main-menu-fixed").removeClass("fixed"), $(this).scrollTop() >= $("#order-now-wrap").offset().top / 2 && $("#order-now-wrap").css("background", "url(/upload/pipe/partners-bg.jpg) center 20% no-repeat"), animScroll()
    }), $(window).height() >= $("[data-circle-first] [data-circle-1-img-1]").offset().top && animScroll(), $(window).scrollTop() >= $("#order-now-wrap").offset().top / 2 && $("#order-now-wrap").css("background", "url(/upload/pipe/partners-bg.jpg) center center no-repeat"), $(".emailLowerCase").keyup(function () {
        this.value = this.value.toLowerCase()
    }), $('a[href^="#"]').click(function () {
        var e = $(this).attr("href");
        "#how_we_work" == e ? $("body").animate({scrollTop: $(e).offset().top - 60}, 1e3) : "#profnastil" == e ? $("body").animate({scrollTop: $(e).offset().top + 330}, 1e3) : $("body").animate({scrollTop: $(e).offset().top}, 1e3)
    }), $("body").on("click  touchstart", ".ral-color-btn", function () {
        $(".ral-color-btn").removeClass("active");
        var e = $(this).attr("data-ral-color");
        $(this).addClass("active"), $(".main-wrap #ral-color-wrap svg").css("fill", e)
    }), $(".ral-image-tab").on("click  touchstart", function () {
        $(".ral-image-tab").removeClass("active"), "ral-image-tab-2" == $(this).attr("id") ? ($(this).addClass("active"), $(".ral-main-img-2").fadeIn(), $(".ral-main-img-1").hide()) : ($("#ral-image-tab-1").addClass("active"), $(".ral-main-img-1").fadeIn(), $(".ral-main-img-2").hide())
    })
    var o = 1;
    $(".av-center-cetalog").slick({
        centerMode: !1,
        centerPadding: "0px",
        slidesToShow: 3,
        responsive: [{
            breakpoint: 768,
            settings: {arrows: !1, centerMode: !0, centerPadding: "80px", slidesToShow: 1}
        }, {breakpoint: 480, settings: {arrows: !1, centerMode: !0, centerPadding: "40px", slidesToShow: 1}}]
    })
});


$(document).ready(function () {

    /* ------------------------------------------- */
    /* --------- object position center ---------- */
    /* ------------------------------------------- */
    jQuery.fn.positionCenter = function (zIndex) {
        if (this.css("position") != 'absolute') this.css("position", 'absolute');

        var
            screenWidth = $(window).width(),
            screenHeight = $(window).height(),
            scrollTop = $(window).scrollTop(),
            scrollLeft = $(window).scrollLeft(),
            formWidth = this.outerWidth(),
            formHeight = this.outerHeight(),
            cssParams =
                {
                    "z-index": parseInt(this.css("z-index")),
                    "left": '',
                    "right": '',
                    "top": '',
                    "bottom": ''
                };

        if (!cssParams["z-index"] || cssParams["z-index"] < 1) cssParams["z-index"] = parseInt(zIndex);
        if (!cssParams["z-index"] || cssParams["z-index"] < 1) cssParams["z-index"] = 100;

        if (screenWidth <= formWidth + 5) cssParams["left"] = 0;
        else                             cssParams["left"] = scrollLeft + (screenWidth - formWidth) / 2;
        if (formHeight < screenHeight) cssParams["top"] = scrollTop + (screenHeight - formHeight) / 2;
        else                             cssParams["top"] = scrollTop + 50;
        if (!cssParams["left"]) cssParams["right"] = 0;

        return this.css(cssParams);
    };

    $("li.call-btn").on("click", function () {
        AvBlurScreen("on", "9999");
        $('[data-call-back-form]').positionCenter(99999).fadeToggle().on("remove", function () {
            AvBlurScreen("off")
        });
    });

    $('a[href^="#"]').click(function () {
        var el = $(this).attr('href');
        if (el == "#how_we_work") {
            $('body').animate({
                scrollTop: $(el).offset().top - 60
            }, 1000);
        } else if (el == "#profnastil") {
            $('body').animate({
                scrollTop: $(el).offset().top + 330
            }, 1000);
        } else {
            $('body').animate({
                scrollTop: $(el).offset().top
            }, 1000);
        }
    });


    $('#partners-form-btn').on("click", function () {
        AvBlurScreen("on", "9999");
        $('[data-partners-form]').positionCenter(99999).fadeIn().on("remove", function () {
            AvBlurScreen("off")
        });
    });


    $('[data-close-form2]').on('click', function () {
        AvBlurScreen("off");
        $('.popUp').fadeOut();
    });

    $('.more-btn').on('click', function () {
        AvBlurScreen("on", "9999");
        $('.make-done-form').positionCenter(99999).fadeIn().on("remove", function () {
            AvBlurScreen("off")
        });
    });

    $('.more-btn1').on('click', function () {
        AvBlurScreen("on", "9999");
        $('.make-done-form').positionCenter(99999).fadeIn().on("remove", function () {
            AvBlurScreen("off")
        });
    });


    $('.more-btn2').on('click', function () {
        AvBlurScreen("on", "9999");
        $('.make-done-form-sq').positionCenter(99999).fadeIn().on("remove", function () {
            AvBlurScreen("off")
        });
    });

    $('.more-btn3').on('click', function () {
        AvBlurScreen("on", "9999");
        $('.make-done-form-circle').positionCenter(99999).fadeIn().on("remove", function () {
            AvBlurScreen("off")
        });
    });

    $('.av-ctatalog-item-tablet').on('click', function (e) {
        e.preventDefault;
    });

});

