(() => {
    function e(e, t) {
        return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + e + "<br/>" + Math.round(t.percent) + "%</div>";
    }
    $(function () {
        for (var e = [], t = [], a = 0; a < 14; a += 0.1) e.push([a, Math.sin(a)]), t.push([a, Math.cos(a)]);
        plot = $.plot("#placeholder1", [{ data: e }, { data: t }], {
            series: { lines: { show: !0 } },
            lines: { show: !0, fill: !0, fillColor: { colors: [{ opacity: 0.7 }, { opacity: 0.7 }] } },
            crosshair: { mode: "x" },
            grid: { hoverable: !1, autoHighlight: !1, borderColor: "rgba(119, 119, 142, 0.1)", verticalLines: !1, horizontalLines: !1 },
            colors: ["#6c5ffc", "#05c3fb"],
            yaxis: { min: -1.2, max: 1.2, tickLength: 0 },
            xaxis: { tickLength: 0 },
        });
    }),
        $(function () {
            for (var e = [], t = [], a = 0; a < 14; a += 0.5) e.push([a, Math.sin(a)]), t.push([a, Math.cos(a)]);
            $.plot(
                "#placeholder2",
                [
                    { data: e, label: "data1" },
                    { data: t, label: "data2" },
                ],
                {
                    series: { lines: { show: !0 }, points: { show: !0 } },
                    grid: { hoverable: !0, clickable: !0, borderColor: "rgba(119, 119, 142, 0.1)", verticalLines: !1, horizontalLines: !1 },
                    colors: ["#6c5ffc", "#05c3fb"],
                    yaxis: { min: -1.2, max: 1.2, tickLength: 0 },
                    xaxis: { tickLength: 0 },
                }
            );
        }),
        $(function () {
            var e = [];
            function t() {
                for (e.length > 0 && (e = e.slice(1)); e.length < 300; ) {
                    var t = (e.length > 0 ? e[e.length - 1] : 50) + 10 * Math.random() - 5;
                    t < 0 ? (t = 0) : t > 100 && (t = 100), e.push(t);
                }
                for (var a = [], i = 0; i < e.length; ++i) a.push([i, e[i]]);
                return a;
            }
            var a = 30;
            $("#updateInterval")
                .val(a)
                .change(function () {
                    var e = $(this).val();
                    e && !isNaN(+e) && ((a = +e) < 1 ? (a = 1) : a > 2e3 && (a = 2e3), $(this).val("" + a));
                });
            var i = $.plot("#placeholder4", [t()], { series: { shadowSize: 0 }, grid: { borderColor: "rgba(119, 119, 142, 0.1)" }, colors: ["#6c5ffc"], yaxis: { min: 0, max: 100, tickLength: 0 }, xaxis: { tickLength: 0, show: !1 } });
            !(function e() {
                i.setData([t()]), i.draw(), setTimeout(e, a);
            })();
        }),
        $(function () {
            for (var e = [], t = 0; t <= 10; t += 1) e.push([t, parseInt(30 * Math.random())]);
            var a = [];
            for (t = 0; t <= 10; t += 1) a.push([t, parseInt(30 * Math.random())]);
            var i = [];
            for (t = 0; t <= 10; t += 1) i.push([t, parseInt(30 * Math.random())]);
            var o = 0,
                l = !0,
                s = !1,
                n = !1;
            function r() {
                $.plot("#placeholder6", [e, a, i], {
                    series: { stack: o, lines: { show: s, fill: !0, steps: n }, bars: { show: l, barWidth: 0.6 } },
                    grid: { borderColor: "rgba(119, 119, 142, 0.1)" },
                    colors: ["#6c5ffc", "#05c3fb"],
                    yaxis: { tickLength: 0 },
                    xaxis: { tickLength: 0, show: !1 },
                });
            }
            r(),
                $(".stackControls button").click(function (e) {
                    e.preventDefault(), (o = "With stacking" == $(this).text() || null), r();
                }),
                $(".graphControls button").click(function (e) {
                    e.preventDefault(), (l = -1 != $(this).text().indexOf("Bars")), (s = -1 != $(this).text().indexOf("Lines")), (n = -1 != $(this).text().indexOf("steps")), r();
                });
        }),
        $(function () {
            for (var t = [], a = Math.floor(4 * Math.random()) + 3, i = 0; i < a; i++) t[i] = { label: "Series" + (i + 1), data: Math.floor(100 * Math.random()) + 1 };
            var o = $("#placeholder");
            $("#example-1").click(function () {
                o.unbind(),
                    $("#title").text("Default pie chart"),
                    $("#description").text("The default pie chart with no options set."),
                    $.plot(o, t, { series: { pie: { show: !0 } }, colors: ["#6c5ffc", "#05c3fb", "#09ad95", "#1170e4", "#f82649"] });
            }),
                $("#example-2").click(function () {
                    o.unbind(),
                        $("#title").text("Default without legend"),
                        $("#description").text("The default pie chart when the legend is disabled. Since the labels would normally be outside the container, the chart is resized to fit."),
                        $.plot(o, t, { series: { pie: { show: !0 } }, colors: ["#6c5ffc", "#05c3fb", "#09ad95", "#1170e4", "#f82649"], legend: { show: !1 } });
                }),
                $("#example-3").click(function () {
                    o.unbind(),
                        $("#title").text("Custom Label Formatter"),
                        $("#description").text("Added a semi-transparent background to the labels and a custom labelFormatter function."),
                        $.plot(o, t, {
                            series: { pie: { show: !0, radius: 1, label: { show: !0, radius: 1, formatter: e, background: { opacity: 0.8 } } } },
                            colors: ["#1170e4", "#d43f8d", "#45aaf2", "#ecb403", "#e86a91"],
                            legend: { show: !1 },
                        });
                }),
                $("#example-4").click(function () {
                    o.unbind(),
                        $("#title").text("Label Radius"),
                        $("#description").text("Slightly more transparent label backgrounds and adjusted the radius values to place them within the pie."),
                        $.plot(o, t, {
                            series: { pie: { show: !0, radius: 1, label: { show: !0, radius: 3 / 4, formatter: e, background: { opacity: 0.5 } } } },
                            colors: ["#1170e4", "#d43f8d", "#45aaf2", "#ecb403", "#64E572"],
                            legend: { show: !1 },
                        });
                }),
                $("#example-5").click(function () {
                    o.unbind(),
                        $("#title").text("Label Styles #1"),
                        $("#description").text("Semi-transparent, black-colored label background."),
                        $.plot(o, t, {
                            series: { pie: { show: !0, radius: 1, label: { show: !0, radius: 3 / 4, formatter: e, background: { opacity: 0.5, color: "#000" } } } },
                            colors: ["#1170e4", "#d43f8d", "#45aaf2", "#ecb403", "#e86a91"],
                            legend: { show: !1 },
                        });
                }),
                $("#example-6").click(function () {
                    o.unbind(),
                        $("#title").text("Label Styles #2"),
                        $("#description").text("Semi-transparent, black-colored label background placed at pie edge."),
                        $.plot(o, t, {
                            series: { pie: { show: !0, radius: 3 / 4, label: { show: !0, radius: 3 / 4, formatter: e, background: { opacity: 0.5, color: "#000" } } } },
                            colors: ["#1170e4", "#d43f8d", "#45aaf2", "#ecb403", "#e86a91"],
                            legend: { show: !1 },
                        });
                }),
                $("#example-7").click(function () {
                    o.unbind(),
                        $("#title").text("Hidden Labels"),
                        $("#description").text("Labels can be hidden if the slice is less than a given percentage of the pie (10% in this case)."),
                        $.plot(o, t, { series: { pie: { show: !0, radius: 1, label: { show: !0, radius: 2 / 3, formatter: e, threshold: 0.1 } } }, colors: ["#1170e4", "#d43f8d", "#45aaf2", "#ecb403", "#e86a91"], legend: { show: !1 } });
                }),
                $("#example-8").click(function () {
                    o.unbind(),
                        $("#title").text("Combined Slice"),
                        $("#description").text("Multiple slices less than a given percentage (5% in this case) of the pie can be combined into a single, larger slice."),
                        $.plot(o, t, { series: { pie: { show: !0, combine: { color: "#999", threshold: 0.05 } } }, colors: ["#1170e4", "#d43f8d", "#45aaf2", "#ecb403", "#e86a91"], legend: { show: !1 } });
                }),
                $("#example-9").click(function () {
                    o.unbind(),
                        $("#title").text("Rectangular Pie"),
                        $("#description").text("The radius can also be set to a specific size (even larger than the container itself)."),
                        $.plot(o, t, { series: { pie: { show: !0, radius: 500, label: { show: !0, formatter: e, threshold: 0.1 } } }, colors: ["#1170e4", "#d43f8d", "#45aaf2", "#ecb403", "#e86a91"], legend: { show: !1 } });
                }),
                $("#example-10").click(function () {
                    o.unbind(),
                        $("#title").text("Tilted Pie"),
                        $("#description").text("The pie can be tilted at an angle."),
                        $.plot(o, t, {
                            series: { pie: { show: !0, radius: 1, tilt: 0.5, label: { show: !0, radius: 1, formatter: e, background: { opacity: 0.8 } }, combine: { color: "#999", threshold: 0.1 } } },
                            colors: ["#1170e4", "#d43f8d", "#45aaf2", "#ecb403", "#e86a91"],
                            legend: { show: !1 },
                        });
                }),
                $("#example-11").click(function () {
                    o.unbind(), $("#title").text("Donut Hole"), $("#description").text("A donut hole can be added."), $.plot(o, t, { series: { pie: { innerRadius: 0.5, show: !0 } } });
                }),
                $("#example-1").click();
        });
})();
