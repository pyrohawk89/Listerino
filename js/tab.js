var SimpleTabs = function(e) {
    var t;
    var n = function() {
        var e = this;
        this.tab;
        this.pane;
        this.setClick = function() {
            e.tab.addEventListener("click", e.showThisTab)
        };
        this.showThisTab = function() {
            if (e !== t) {
                t.pane.className = t.pane.className.replace("active-page", "");
                t.tab.className = t.tab.className.replace("active", "");
                e.pane.className = e.pane.className + "active-page";
                e.tab.className = e.tab.className + "active";
                t = e
            }
        }
    };
    var r = e;
    var i;
    var s = r.getElementsByTagName("li");
    for (i = 0; i < s.length; ++i) {
        var o = new n;
        o.tab = s[i];
        var u = s[i].className;
        var a = u.split(" ")[0];
        o.pane = document.getElementById(a);
        o.setClick();
        if (u.indexOf("active") > -1) {
            t = o
        }
    }
}