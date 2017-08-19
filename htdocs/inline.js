var ca = function(t, e) {
        function n(t, e) {
            ++packages[t][0] == packages[t][1] && e && e()
        }
        try {
            "number" != typeof t || "function" != typeof e && 0 != e || (s.readyState ? s.onreadystatechange = function() {
                "loaded" !== s.readyState && "complete" !== s.readyState || n(t, e)
            } : s.onload = function() {
                n(t, e)
            })
        } catch (t) {}
    },
    itp = function() {
        s = document.createElement("script"), m = document.getElementsByTagName("script")[0], s.async = sl[ix][4], s.src = sl[ix][0], m.parentNode.insertBefore(s, m), sl[ix][2] ? s.readyState ? s.onreadystatechange = function() {
            "loaded" !== s.readyState && "complete" !== s.readyState || ("function" == typeof sl[ix][1] && sl[ix][1](), ix++, ld())
        } : s.onload = function() {
            "function" == typeof sl[ix][1] && sl[ix][1](), ix++, ld()
        } : 0 == sl[ix][2] && ("function" == typeof sl[ix][1] && sl[ix][1](), ix++, ld())
    },
    ld = function() {
        ix < sll && "string" == typeof sl[ix][0] && (null == sl[ix][1] || "function" == typeof sl[ix][1] || 0 == sl[ix][2] || 1 == sl[ix][2]) && itp()
    };
ld();