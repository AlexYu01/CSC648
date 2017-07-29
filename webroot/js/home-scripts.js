var W = W || {};
W.Bi = W.Bi || {};
W.Bi.EventMap = {};

(function(exports, global) {
    global["MenuAndFooter"] = exports;
    "use strict";
    window.W = window.W || {};
    W.Site = W.Site || {};
    W.Site.Common = W.Site.Common || {};
    var BI = W.Site.Common.BI || function() {
        var headerFooterEvent = {
            extension: "hf",
            src: "19",
            init: "500",
            loadComplete: "501",
            fail: "13",
            loginDialog: "503",
            goToVerticalsSelection: "504",
            goToVerticalHomepage: "505"
        };
        var mobileHeaderEvents = {
            extension: "mhp",
            src: "19",
            openMenu: "202",
            menuPage: "203",
            signinClick: "200"
        };
        var legacyHeaderEvents = {
            extension: "hp",
            src: "19",
            clickOnHeader: "311",
            languageChange: "313",
            signinClick: "314"
        };
        var spettatoreEvents = {
            extension: "spettatore_bi",
            src: "2",
            legacyPostReg: "30"
        };
        var topBannerEvent = {
            extension: "dash",
            src: "5",
            init: "54",
            complete: "55",
            fail: "13",
            click: "14",
            create: "34",
            update: "36"
        };
        var Utils = Utils || {};
        Utils.getLocationOrigin = Utils.getLocationOrigin || function() {
            var origin = window.location.origin;
            if (!window.location.origin) {
                origin = "//" + window.location.hostname + (window.location.port ? ":" + window.location.port : "");
            }
            return origin;
        };
        var path = "";
        function _report(extension, src, evtid, report) {
            var date = new Date().getTime();
            var finaleReport = "";
            if (typeof report !== "undefined") {
                finaleReport = report + "&";
            }
            if (extension === headerFooterEvent.extension || extension === legacyHeaderEvents.extension) {
                finaleReport += "origin=" + window.location.host + window.location.pathname + "&";
            }
            finaleReport += "_=" + date;
            var imgSrc = W.Site.Common.BI.path + extension + "?src=" + src + "&evid=" + evtid + "&" + finaleReport;
            var img = new Image();
            img.src = imgSrc;
        }
        return {
            headerFooterEvent: headerFooterEvent,
            topBannerEvent: topBannerEvent,
            legacyHeaderEvents: legacyHeaderEvents,
            spettatoreEvents: spettatoreEvents,
            mobileHeaderEvents: mobileHeaderEvents,
            path: path,
            report: _report
        };
    }();
    W.Site.Common.BI = BI;
})({}, function() {
    return this;
}());