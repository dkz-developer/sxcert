/**
 * 首页JS文件
 * @authors KYX
 * @date 	2017-2-24 12:52:26
 */

define(['jquery','vue','tools','topNav','kolDialog','footer','echarts','login'], function($,vue,tools,topNav,kolDialog,footer,echarts,login){

    $(function(){

        

        // 排名情况
        function rankChart(){
            var xAxis = ["12-11","12-11","12-11","12-11","12-11","12-11","12-11",]; // X轴的值
            var values = [1001,2001,3100,4010,1500,600,1001]; //

            /*if(!_data.pubs){return false;}
             for (var i = 0; i < _data.pubs.length; i++) {
             xAxis.push(_data.pubs[i].statisticTime.substr(5, 6));
             values.push(_data.pubs[i].num);
             }
             */

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
                    name:'发布量',
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

        // 发布情况
        function publishChart(){
            var xAxis = ["0","1","2","3","4","5","0","1","2","3","4","5","0","1","2","3","4","5","0","1","2","3","4","5","0","1","2","3","4","5"]; // X轴的值
            var values = [100,200,310,401,150,600,100,200,310,401,150,600,100,200,310,401,150,600,100,200,310,401,150,600,100,200,310,401,150,600];
            /* if(!_data.healineRead){return false;}
             for (var i = 0; i < _data.healineRead.length; i++) {
             xAxis.push(_data.healineRead[i].statisticTime.substr(5, 6));
             values.push(_data.healineRead[i].num);
             }*/

            var myChart = echarts.init($("#publishChart").find(".content").get(0));
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
                    barWidth:15,
                    name:'头条阅读量',
                }]
            };

            // 使用刚指定的配置项和数据显示图表。
            myChart.setOption(option);
        }

        // 传播情况
        function influenceChart(){
            var xAxis = ["12-27","12-27","12-27","12-27","12-27","12-27","12-27","12-27","12-27","12-27","12-27","12-27","12-27","12-27","12-27","12-27","12-27","12-27","12-27","12-27","12-27","12-27","12-27","12-27","12-27","12-27","12-27","12-27","12-27","12-27"]; // X轴的值
            var values = [100,200,310,401,150,0,0,0,310,401,150,600,100,200,310,401,150,600,100,200,310,401,150,600,100,200,310,401,150,600];
            /* if(!_data.healineRead){return false;}
             for (var i = 0; i < _data.healineRead.length; i++) {
             xAxis.push(_data.healineRead[i].statisticTime.substr(5, 6));
             values.push(_data.healineRead[i].num);
             }*/

            var myChart = echarts.init($("#WXinfluenceEchart").find(".content").get(0));
            // 指定图表的配置项和数据
            var option = {
                color: ['#4bc1e1'],
                grid: {
                    left: '1%',
                    right: '1%',
                    bottom: '7%',
                    top: "8%",
                    containLabel: true,
                },
                tooltip: {
                    trigger: 'item'
                },
                xAxis: {
                    data: xAxis,
                    axisTick: false,
                    // x轴线和字体颜色
                    axisLine: {
                        lineStyle: {
                            color: '#888',
                        },
                    },
                    // x轴全部显示 字体倾斜
                    axisLabel: {
                        interval: 0,
                        rotate: 60,
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
                    barWidth:20,
                    name:'头条阅读量',
                }]
            };

            // 使用刚指定的配置项和数据显示图表。
            myChart.setOption(option);
        }

         // 微信授权
        function auth_weixin() {
            var newWeb = window.open('about:blank'); // 处理页面被浏览器默认拦截
            var params = {
                UserId: $.mytools.getCookie("UserId"),
                OauthMedia: "2"
            };
            $.get('http://join.kolstore.com/api/weixin/oauth',params,function(backData){
                if(backData.code == 'S'){
                    newWeb.location.href = backData.msg;

                $.get("/AuthTips", {}, function(backData) {

                        if(backData){

                            var addAccount_dialog = $.kolDialog({
                                "icon_color": "27AE60",
                                "content": backData,
                                "background": "fff",
                                "contentOverflow": "visible"
                            });
                        }

                        $(".closeBtn").remove();

                    }, "html");

                }else if(backData.code == 'F'){
                    $.kolDialog.alert('<i class="fa fa-frown-o"></i> '+backData.msg+'!');
                }
            });
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
            publishChart();
            influenceChart();

            

            // 授权账号按钮
            $(".auth_do").click(function() {

                if(USERTYPE && USERTYPE === "0" && USERNAME) {
                        auth_weixin();
                }else {
                    login._init("kol");
                }
            });

            // 查看账号价格
            $(".viewPrice").click(function() {
                login._init("kol");
            });


        });

    })


});
