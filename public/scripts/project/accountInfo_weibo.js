/**
 * 首页JS文件
 * @authors KYX
 * @date    2017-2-24 12:52:26
 */

define(['jquery','vue','tools','topNav','footer','echarts',"svg3dtagcloud","login"], function($,Vue,tools,topNav,footer,echarts,svg3dtagcloud,login){

    $(function(){

            // 如果用户已经登录
            var USERTYPE = $.mytools.getCookie("Type");
            var USERNAME = $.mytools.getCookie("UserName");

        
        var weiboUserId = $.mytools.GetQueryString("weiboUserId"); // 账号ID
        // 实例化vue
        var vm = new Vue({
            el: '#app',
            data: {
                loginBycom: false,
            },
            methods: {
                // 排名情况
                rankChart: function(event) {
                    $(".account-ranking").find("span[data-bind]").removeClass("active");
                    $(event.currentTarget).addClass("active");
                    var rankType = event.currentTarget.getAttribute("data-bind");

                    rankChart({"rankType": rankType});
                }, 
                // 传播情况
                influenceChart: function(event) {
                    $(".account-influence").find("span[data-bind]").removeClass("active");
                    $(event.currentTarget).addClass("active");
                    var numType = event.currentTarget.getAttribute("data-bind");
                    influenceChart({"numType": numType});
                },  
            }
        });

        // 排名情况
        function rankChart(setting){

            var params = {
                "_token": $("#app").attr("data-value"),
                "weiboUserId": weiboUserId,
                "rankType": setting && setting.rankType ? setting.rankType : "WeekRank",
            }

            var xAxis = []; // X轴的值
            var values = []; // Y轴的值

            $.post('/WeiboRankList', params, function(backData) {

                if(backData && backData.code === "S") {

                     for (var i = 0; i < backData.msg.length; i++) {
                         xAxis.push(backData.msg[i].CreateDate.substr(5, 6));
                         values.push(backData.msg[i].WeekRank);
                     }

                    var myChart = echarts.init($("#rankChart").find(".content").get(0));

                    // 指定图表的配置项和数据
                    var option = {
                        color: ['#4bc1e1'],
                        grid: {
                            left: '1%',
                            right: '1%',
                            bottom: '0',
                            top: "8%",
                            containLabel: true
                        },
                        tooltip: {
                            trigger: 'item'
                        },
                        xAxis: {
                            data: xAxis,
                            axisTick: false,
                            axisLine: {
                                lineStyle: {
                                    color: '#888',
                                },
                            },
                        },
                        yAxis: [{
                            type: 'value',
                            axisTick: false,
                            axisLine: {
                                lineStyle: {
                                    color: '#888',
                                },
                            },
                        }],
                        series: [{
                            type: 'line',
                            data: values,
                            name:'排名',
                            symbolSize: 13,
                            itemStyle: {normal: {
                                borderWidth: 3,
                            }},
                            lineStyle: {normal: {
                                width: 4,
                            }},
                        }]
                    };

                    // 使用刚指定的配置项和数据显示图表。
                    myChart.setOption(option);
                }

            }, "json"); 
        };

        // 传播情况
        function influenceChart(setting){

            var params = {
                "_token": $("#app").attr("data-value"),
                "weiboUserId": weiboUserId,
                "numType": setting && setting.numType ? setting.numType : "WeekAvgPostmum",
            }

            var xAxis = []; // X轴的值
            var values = []; // Y轴的值

            $.post('/WeiboNumList', params, function(backData) {

                if(backData && backData.code === "S") {

                     for (var i = 0; i < backData.msg.length; i++) {
                         xAxis.push(backData.msg[i].CreateDate.substr(5, 6));
                         values.push(backData.msg[i].num);
                     }

                    var myChart = echarts.init($("#influenceChart").find(".content").get(0));
                    
                    // 指定图表的配置项和数据
                    var option = {
                        color: ['#4bc1e1'],
                        grid: {
                            left: '1%',
                            right: '1%',
                            bottom: '0',
                            top: "8%",
                            containLabel: true
                        },
                        tooltip: {
                            trigger: 'item'
                        },
                        xAxis: {
                            data: xAxis,
                            axisTick: false,
                            axisLine: {
                                lineStyle: {
                                    color: '#888',
                                },
                            },

                        },
                        yAxis: [{
                            type: 'value',
                            axisTick: false,
                            axisLine: {
                                lineStyle: {
                                    color: '#888',
                                },
                            },
                        }],
                        series: [{
                            type: 'bar',
                            data: values,
                            barWidth:50,
                            name:'头条阅读量',
                        }]
                    };

                    // 使用刚指定的配置项和数据显示图表。
                    myChart.setOption(option);
                }

            }, "json"); 
        };

        // 活跃粉丝总量
        function FollowersCountChart(backdata){
            var xAxis = []; // X轴的值
            var values = []; //Y轴的值

            if(!backdata){return false;}
             for (var i = 0; i < backdata.length; i++) {
             xAxis.push(backdata[i].CreateDate.substr(5, 6));
             values.push(backdata[i].ActivefansNum);
             }
             
            var myChart = echarts.init($("#FollowersCountChart").find(".content").get(0));

            // 指定图表的配置项和数据
            var option = {
                color: ['#4bc1e1'],
                grid: {
                    left: '2%',
                    right: '8%',
                    bottom: '0',
                    top: "8%",
                    containLabel: true
                },
                tooltip: {
                    trigger: 'item'
                },
                xAxis: {
                    data: xAxis,
                    axisTick: false,
                    axisLine: {
                        lineStyle: {
                            color: '#888',
                        },
                    },
                },
                yAxis: [{
                    type: 'value',
                    axisTick: false,
                    axisLine: {
                        lineStyle: {
                            color: '#888',
                        },
                    },
                }],
                series: [{
                    type: 'line',
                    data: values,
                    name:'活跃粉丝总量',
                    symbolSize: 13,
                    itemStyle: {normal: {
                        borderWidth: 3,
                    }},
                    lineStyle: {normal: {
                        width: 4,
                    }},
                }]
            };

            // 使用刚指定的配置项和数据显示图表。
            myChart.setOption(option);
        }

        // 粉丝地域分布
        function FansAreaPercentage(backdata) {
           var xAxis = []; // X轴的值
            var values = []; //Y轴的值

            if(backdata.length <= 0){
                $("#FansAreaPercentage").parents(".module").hide(); return false;
            }
            for (var i in backdata) {
                xAxis.push(backdata[i].city);
                values.push(backdata[i].num);
            }

            var myChart = echarts.init($("#FollowersAreaChart").find(".content").get(0));
            // 指定图表的配置项和数据
            var option = {
                color: ['#4bc1e1'],
                grid: {
                    left: '2%',
                    right: '8%',
                    bottom: '0',
                    top: "0",
                    containLabel: true
                },
                tooltip: {
                    trigger: 'item'
                },
                xAxis: {
                    type: 'value',
                    axisTick: false,
                    splitLine:{
                        show:false
                    },
                    axisLabel: {
                        formatter: '{value}%',
                    },
                    axisLine: {
                        lineStyle: {
                            color: '#888',
                        },
                    },

                },
                yAxis: [{
                    data: xAxis,
                    axisTick: false,
                    axisLine: {
                        lineStyle: {
                            color: '#888',
                        },
                    },

                }],
                series: [{
                    type: 'bar',
                    data: values,
                    barWidth:20,
                    name:'粉丝地域分布所在比例',
                    itemStyle: {normal: {
                        label : {show:true,position:'right',formatter:'{c}%'},
                    }},
                }]
            };

            // 使用刚指定的配置项和数据显示图表。
            myChart.setOption(option);
        }

        // 性别比例
        function genderRatio(backdata) {
            if(backdata){
                $("#sex-ratio").find(".male > em").css("height", Math.round(backdata["MaleFansRatio"]) + "%").find("span").text(Math.round(backdata["MaleFansRatio"]) + "%");
                $("#sex-ratio").find(".female > em").css("height", Math.round(backdata["FemaleFansRatio"]) + "%").find("span").text(Math.round(backdata["FemaleFansRatio"]) + "%");
            }else{
                $("#sex-ratio").parents(".module").hide();
            }
        }

        // 粉丝标签
        function fanslabel() {
            var entries = [];

            /*if(JSON.stringify(_data.FansTags) == "{}" || _data.FansTags.length <= 0){
                $(".fanslabel").parents(".module").hide();
                return false;
            };

            for(var i in _data.FansTags){
                entries.push({"label": i});
            }*/


            var entries = [{"label": "篮球"},{"label": "12篮球"},{"label": "22篮球"},{"label": "33篮球"},{"label": "篮44球"}];

            $("#fanslabel").find(".content").svg3DTagCloud({
                entries: entries,
                width: "1118",
                height: "310",
                radius: "80",
                bgDraw: false,
                fontColor: "red",
                fontSize: 16,
                speed: 1
            });

            var allLabel = $("#fanslabel > .content").find("a");
            var color = ["#1d8cff", "#f77aaf", "#8d64c7", "#fdb793", "#65cae0", "#f6cb9f", "#72d1a3", "#83bdf9"];
            var fontSize = ["20px", "26px", "32px", "38px", "42px"];

            allLabel.each(function() {
                var num_1 = $.mytools.GetRandomNum(0, 7);
                var num_2 = $.mytools.GetRandomNum(0, 4);

                $(this).find("text").attr("font-size", fontSize[num_2]);
                $(this).find("text").attr("fill", color[num_1]);
                $(this).removeAttr("xlink:href");
                $(this).removeAttr("target");
            });
        }

        // 加载粉丝 地域 性别 标签
        function _initLoadData() {

            var params = {
                "_token": $("#app").attr("data-value"),
                "weiboUserId": weiboUserId,
            }

             $.post('/WeiboFans', params, function(backData) {

                if(backData && backData.code === "S") {
                    FollowersCountChart(backData.activefansNum);
                    FansAreaPercentage(backData.regionalRatio);
                    genderRatio(backData.fansRatio);
                }

            }, "json"); 
        }

        $(function(){

            // 如果用户已经登录
            var USERTYPE = $.mytools.getCookie("Type");
            var USERNAME = $.mytools.getCookie("UserName");

            // 加载顶部导航条
            topNav.render("kolrank");

            // 加载脚部信息条
            footer.render();

            rankChart();

            influenceChart();

           _initLoadData();

           if(USERTYPE && USERTYPE === "1" && USERNAME) {
                            
            }else {
            }

             // 查看账号价格
            $(".viewPrice").click(function() {
                login._init("kol");
            });
        });

    })


});
