<?php
    $row_trinhduyet  =  $db->query("select browser,count(browser) as dem from table_counter group by browser");
    $row_hdh2  =  $db->query("select os,count(os) as dem from table_counter group by os order by os asc");
    $row_thietbi  =  $db->query("select device,count(device) as dem from table_counter group by device order by device asc");
    $row_tb  =  $db->query("select device,count(device) as dem from table_counter group by device order by device asc");
    $row_quocgia  =  $db->query("select nation,count(nation) as dem from table_counter where nation!='' group by nation order by dem desc limit 0,10");
    $row_dentu  =  $db->query("select website,count(website) as dem from table_counter where website!='' group by website order by dem desc limit 0,8");

    for($i=0;$i<count($row_trinhduyet);$i++){
        $tong = $tong + $row_trinhduyet[$i]['dem'];
    }

?>
<?php
    /* Set the default timezone */
   date_default_timezone_set('Asia/Ho_Chi_Minh');

    /* Set the date */
    if($_GET['datepicker']!=''){
        $date = strtotime($_GET['datepicker']);
    } else {
        $date = strtotime(date('y-m-d'));
    } 

    $day = date('d', $date);
    $month = date('m', $date);
    $year = date('Y', $date);

    $firstDay = mktime(0,0,0,$month, 1, $year);
    $title = strftime('%B', $firstDay);
    $dayOfWeek = date('D', $firstDay);
    $daysInMonth = cal_days_in_month(0, $month, $year);
    /* Get the name of the week days */
    $timestamp = strtotime('next Sunday');
    $weekDays = array();
    for ($i = 0; $i < 7; $i++) {
        $weekDays[] = strftime('%a', $timestamp);
        $timestamp = strtotime('+1 day', $timestamp);
    }
    $blank = date('w', strtotime("{$year}-{$month}-01"));
?>

<script src="Assets/js/chart/js/chartli.js"></script>

<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Thống kê truy cập tháng : <?php echo $month ?> - <?php echo $year ?> '
        },
        subtitle: {
            text: 'Devetloper by : <a href="http://cipmedia.vn">CIP Media .LTD</a>'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Arial'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Số người truy cập'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Tổng : <b>{point.y:.1f} Lượt truy cập </b>'
        },
        series: [{
            name: 'Population',
            data: [
            <?php for($i = 1; $i <= $daysInMonth; $i++):

                $k = $i+1;
                $begin = strtotime($year.'-'.$month.'-'.$i);
                if($i==$daysInMonth){
                    if($month==12){
                        $year_tt = $year+1;
                        $end = strtotime($year_tt.'-1-1');
                    } else {
                        $month_tt = $month+1;
                        $end = strtotime($year.'-'.$month_tt.'-1');
                    }
                    
                } else {
                    $end = strtotime($year.'-'.$month.'-'.$k);
                }

                $todayrc  =  $db->row("SELECT COUNT(*) AS todayrecord FROM table_counter WHERE tm>='$begin' and tm<'$end'");
                $today_visitors     =    $todayrc['todayrecord']; 

            ?>
                ['<?=$i?>', <?=$today_visitors?>],
            <?php endfor; ?>


            ],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Arial'
                }
            }
        }]
    });
    $( "#datepicker" ).datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'yy-mm',
        onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
    });

});

    $(window).load(function() {
        $('.highcharts-data-labels tspan').each(function(index, el) {
            var html= $(this).html();
            if(html=='0.0'){
                $(this).html('');
            }
        });
    });
    

</script>
<style>
.ui-datepicker-calendar {
    display: none;
    }
</style>

<div class="wrapper">
<form name="supplier" id="validate" class="form" action="index.php" method="get" enctype="multipart/form-data">

<div class="widget">
   <div class="title"><h6>Chào mừng bạn đến với Administrator - HỆ THỐNG QUẢN TRỊ NỘI DUNG WEBSITE - Powered by <a href="http://www.cipmedia.vn" target="_blank"><span style="color:#f00;">Thiết kế website CIP Media</span></a></h6><div class="clear"></div></div>
   <p>Nếu bạn có thắc mắc trong quá trình sử dụng, xin vui lòng gởi mail về địa chỉ <strong><a href="mailto:cskh@cipmedia.vn">cskh@cipmedia.vn</a></strong></p>

   <div class="clear"></div>
   <div class="formRow">
        <label>Thống kê theo tháng</label>
        <div class="formRight">
                <input type="text" id="datepicker" name="datepicker" placeholder="yyyy-mm-dd" value="<?=$_GET['datepicker']?>">
                <input type="submit" class="blueB xemthongke" onclick="TreeFilterChanged2(); return false;" value="Xem thống kê" />
        </div>
        <div class="clear"></div>
   </div>
   
   <div id="container" style="width: 100%; height: 400px; margin: 0 auto"></div>
   <div class="clear"></div>

   <div class="formRow">
        <div class="row_70">
              <label>Thống kê theo trình duyệt</label>
                <div class="clear"></div>
                <div id="chartli3" style="height:400px;"></div>
                <div class="clear"></div>
        </div>

        <div class="row_30" style="padding-left:20px;">
            <table width="100%" border="1" class="table_tk">
                <thead>
                    <tr>
                        <th>Trình Duyệt</th>
                        <th>Lượt</th>
                        <th>Tỷ lệ</th>
                    </tr>
                </thead>
                <tbody>
                <?php for($i=0;$i<count($row_trinhduyet);$i++){ ?>
                    <tr>
                        <td><?=$row_trinhduyet[$i]['browser']?></td>
                        <td><?=$row_trinhduyet[$i]['dem']?></td>
                        <td><?=$func->phantram($row_trinhduyet[$i]['dem'],$tong) ?> %</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
       <div class="clear"></div>
      
   </div>

   <div class="formRow">
        <div class="row_70">
            <label>Thống kê hệ điều hành</label>
            <div class="clear"></div>
            <div id="chartli4" style="height:400px;"></div>
            <div class="clear"></div>
        </div>

        <div class="row_30" style="padding-left:20px;">
            <table width="100%" border="1" class="table_tk">
                <thead>
                    <tr>
                        <th>HDH</th>
                        <th>Lượt</th>
                        <th>Tỷ lệ</th>
                    </tr>
                </thead>
                <tbody>
                <?php for($i=0;$i<count($row_hdh2);$i++){ ?>
                    <tr>
                        <td><?=$row_hdh2[$i]['os']?></td>
                        <td><?=$row_hdh2[$i]['dem']?></td>
                        <td><?=$func->phantram($row_hdh2[$i]['dem'],$tong) ?> %</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
       <div class="clear"></div>
   </div>

   <div class="clear"></div>


   <div class="formRow">
        <div class="row_70">
            <label>Khách đến từ</label>
            <div class="clear"></div>
            <div id="chartli8" style="height:400px;"></div>
            <div class="clear"></div>
        </div>

        <div class="row_30" style="padding-left:20px;">
            <table width="100%" border="1" class="table_tk">
                <thead>
                    <tr>
                        <th>Từ</th>
                        <th>Lượt</th>
                        <th>Tỷ lệ</th>
                    </tr>
                </thead>
                <tbody>
                <?php for($i=0;$i<count($row_dentu);$i++){ ?>
                    <tr>
                        <td><?=$row_dentu[$i]['website']?></td>
                        <td><?=$row_dentu[$i]['dem']?></td>
                        <td><?=$func->phantram($row_dentu[$i]['dem'],$tong) ?> %</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
       <div class="clear"></div>
   </div>

   <div class="clear"></div>


   <div class="formRow">
        <div class="row_70">
            <label>Thống kê thiết bị</label>
            <div class="clear"></div>
            <div id="chartli5" style="height:400px;"></div>
            <div class="clear"></div>
        </div>

        <div class="row_30" style="padding-left:20px;">
            <table width="100%" border="1" class="table_tk">
                <thead>
                    <tr>
                        <th>Device</th>
                        <th>Lượt</th>
                        <th>Tỷ lệ</th>
                    </tr>
                </thead>
                <tbody>
                <?php for($i=0;$i<count($row_thietbi);$i++){ ?>
                    <tr>
                        <td><?=$row_thietbi[$i]['device']?></td>
                        <td><?=$row_thietbi[$i]['dem']?></td>
                        <td><?=$func->phantram($row_thietbi[$i]['dem'],$tong) ?> %</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
       <div class="clear"></div>
   </div>

   <div class="clear"></div>

   <div class="formRow">
           <div class="row">
            <div class="clear"></div>
            <div id="chartli6" style="height:400px;"></div>
            <div class="clear"></div>
        </div>
       <div class="clear"></div>
   </div>

   <div class="clear"></div>

    
</div>
<div class="clear"></div>
<?php echo $today = date("d-m-y H:i a");  ?>
</form></div>

<script src="Assets/js/highcharts/highcharts.js"></script>
<script src="Assets/js/highcharts/modules/exporting.js"></script>

<script>
        var chartliexample3 = echarts.init(document.getElementById('chartli3'));
        option = {
            title: {
                text: '',
                subtext: '',
                x: 'center'
            },

            tooltip: {
                trigger: 'item',
                formatter: "{a} <br />{b} : {c} ({d}%)"
            },

            legend: {
                x: 'center',
                y: 'bottom',
                data: [
                <?php for($i=1;$i<count($row_trinhduyet);$i++){ ?>
                '<?=$row_trinhduyet[$i]['browser']?>',
                <?php } ?>
                '<?=$row_trinhduyet[0]['browser']?>'
                ]
            },

            toolbox: {
                show: true,
                feature: {
                    mark: { show: true },
                    dataView: { show: true, readOnly: false },
                    magicType: {
                        show: true,
                        type: ['pie', 'funnel']
                    },
                    restore: { show: true },
                    saveAsImage: { show: true }
                }
            },

            color: ['#EAC435', '#345995', '#E40066', '#03CEA4', '#FB4D3D', '#403F4C', '#FA7921', '#1B998B'],
            calculable: true,
            series: [
            {
                    name: 'Area Mode',
                    type: 'pie',
                    radius: [30, 110],
                    center: ['50%', 200],
                    roseType: 'area',
                    x: '50%',               // for funnel
                    max: 40,                // for funnel
                    sort: 'ascending',     // for funnel
                    data: [
                    <?php for($i=1;$i<count($row_trinhduyet);$i++){ ?>
                        { value: <?=$row_trinhduyet[$i]['dem']?>, name: '<?=$row_trinhduyet[$i]['browser']?>' },
                    <?php } ?>
                        { value: <?=$row_trinhduyet[0]['dem']?>, name: '<?=$row_trinhduyet[0]['browser']?>' }
                    ]
                }
            ]
        };
        chartliexample3.setOption(option);
    </script>

     <script>
        var chartliexample4 = echarts.init(document.getElementById('chartli4'));
        option = {

            tooltip: {
                trigger: 'item',
                formatter: "{a} <br />{b} : {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                x: 'left',
                data: [
                    <?php for($i=1;$i<count($row_hdh2);$i++){ ?>
                '<?=$row_hdh2[$i]['os']?>',
                <?php } ?>
                '<?=$row_hdh2[0]['os']?>'
                ]
            },
            toolbox: {
                show: true,
                feature: {
                    mark: { show: true },
                    dataView: { show: true, readOnly: false },
                    magicType: {
                        show: true,
                        type: ['pie', 'funnel']
                    },
                    restore: { show: true },
                    saveAsImage: { show: true }
                }
            },
            color: ['#EAC435', '#345995', '#E40066', '#03CEA4', '#FB4D3D', '#403F4C', '#FA7921', '#1B998B'],


            calculable: false,
            series: [
                {
                    name: 'Access Sources',
                    type: 'pie',
                    selectedMode: 'single',
                    radius: [0, 70],

                    // for funnel
                    x: '20%',
                    width: '40%',
                    funnelAlign: 'right',
                    max: 1548,

                    itemStyle: {
                        normal: {
                            label: {
                                position: 'inner'
                            },
                            labelLine: {
                                show: false
                            }
                        }
                    },
                    data: [
                    <?php for($i=1;$i<count($row_hdh2);$i++){?>
                        { value: <?=$row_hdh2[$i]['dem']?>, name: '<?=$row_hdh2[$i]['os']?>' },
                    <?php } ?>
                    ]
                },
                {
                    name: 'Access Sources',
                    type: 'pie',
                    radius: [100, 140],

                    // for funnel
                    x: '60%',
                    width: '35%',
                    funnelAlign: 'left',
                    max: 1048,

                    data: [
                    <?php for($i=1;$i<count($row_hdh2);$i++){ ?>
                        { value: <?=$row_hdh2[$i]['dem']?>, name: '<?=$row_hdh2[$i]['os']?>' },
                    <?php } ?>
                        { value: <?=$row_hdh2[0]['dem']?>, name: '<?=$row_hdh2[0]['os']?>' }
                    ]
                }
            ]
        };

        chartliexample4.setOption(option);
    </script>

    <script>
        var chartliexample5 = echarts.init(document.getElementById('chartli5'));
        var labelTop = {
            normal: {
                label: {
                    show: true,
                    position: 'center',
                    formatter: '{b}',
                    textStyle: {
                        baseline: 'bottom'
                    }
                },
                labelLine: {
                    show: false
                }
            }
        };
        var labelFromatter = {
            normal: {
                label: {
                    formatter: function (params) {
                        return 100 - params.value + '%'
                    },
                    textStyle: {
                        baseline: 'top'
                    }
                }
            },
        }
        var labelBottom = {
            normal: {
                color: '#ccc',
                label: {
                    show: true,
                    position: 'center'
                },
                labelLine: {
                    show: false
                }
            },
            emphasis: {
                color: 'rgba(0,0,0,0)'
            }
        };

        var radius = [40, 55];
        option = {

            legend: {
                x: 'center',
                y: 'center',
                data: [
                <?php for($i=1;$i<count($row_thietbi);$i++){ ?>
                    '<?=$row_thietbi[$i]['device']?>',
                <?php } ?>
                    '<?=$row_thietbi[0]['device']?>'
                ]
            },
            color: ['#EAC435', '#345995', '#E40066', '#03CEA4', '#FB4D3D', '#403F4C', '#FA7921', '#1B998B'],

            title: {
                text: 'Device',
                subtext: 'Devetloper By CIP Media',
                x: 'center'
            },
            toolbox: {
                show: true,
                feature: {
                    dataView: { show: true, readOnly: false },
                    magicType: {
                        show: true,
                        type: ['pie', 'funnel'],
                        option: {
                            funnel: {
                                width: '20%',
                                height: '30%',
                                itemStyle: {
                                    normal: {
                                        label: {
                                            formatter: function (params) {
                                                return 'other\n' + params.value + '%\n'
                                            },
                                            textStyle: {
                                                baseline: 'middle'
                                            }
                                        }
                                    },
                                }
                            }
                        }
                    },
                    restore: { show: true },
                    saveAsImage: { show: true }
                }
            },
            series: [
             <?php for($i=1;$i<count($row_thietbi);$i++){ ?>
                {
                    type: 'pie',
                    center: ['<?php echo ($i-1)*20+10;?>%', '30%'],
                    radius: radius,
                    x: '0%', // for funnel
                    itemStyle: labelFromatter,
                    data: [
                        { name: 'Device', value: <?=round($func->phantram($tong-$row_thietbi[$i]['dem'],$tong))?>, itemStyle: labelBottom },
                        { name: '<?=$row_thietbi[$i]['device']?>', value: <?=round($func->phantram($row_thietbi[$i]['dem'],$tong))?>, itemStyle: labelTop }
                    ]
                },
                <?php } ?>
                {
                    type: 'pie',
                    center: ['50%', '30%'],
                    radius: radius,
                    x: '60%', // for 
                    itemStyle: labelFromatter,
                    data: [
                        { name: 'Device', value: <?=round($func->phantram($tong-$row_thietbi[0]['dem'],$tong))?>, itemStyle: labelBottom },
                        { name: '<?=$row_thietbi[0]['device']?>', value: <?=round($func->phantram($row_thietbi[0]['dem'],$tong))?>, itemStyle: labelTop }
                    ]
                }
            ]
        };

        chartliexample5.setOption(option);
    </script>

<script>
        var chartliexample6 = echarts.init(document.getElementById('chartli6'));
        window.onresize = chartliexample3.resize
        option = {
            title: {
                text: 'Nation',
                subtext: 'Devetloper By CIP Media',
                sublink: 'http://cipmedia.vn'
            },
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'shadow'        // type:'line' | 'shadow'
                },
                formatter: function (params) {
                    return params[0].name + '<br />'
                           + params[0].seriesName + ' : ' + params[0].value + '<br />'
                           + params[1].seriesName + ' : ' + (params[1].value + params[0].value);
                }
            },
            legend: {
                selectedMode: false,
                data: ['Nation']
            },
            toolbox: {
                show: true,
                feature: {
                    mark: { show: false },
                    dataView: { show: false, readOnly: false },
                    //magicType: { show: true, type: ['line', 'bar',  'tiled'] },
                    restore: { show: true, title: 'Refresh' },
                    saveAsImage: { show: true, title: 'Save As Image' }
                }
            },
            calculable: true,
            xAxis: [
                {
                    type: 'category',
                    data: [
                    <?php for($i=0;$i<count($row_quocgia);$i++){?>
                    '<?=trim($row_quocgia[$i]['nation'])?>'<?php if(($i+1)!=count($row_quocgia)){ echo ",";}?>
                    <?php } ?>
                    ]
                }
            ],
            yAxis: [
                {
                    type: 'value',
                    boundaryGap: [0, 0.1]
                }
            ],
            series: [
                {
                    name: 'Nation',
                    type: 'bar',
                    stack: 'sum',
                    barCategoryGap: '50%',
                    itemStyle: {
                        normal: {
                            color: 'tomato',
                            barBorderColor: 'tomato',
                            barBorderWidth: 6,
                            barBorderRadius: 0,
                            label: {
                                show: true, position: 'insideTop'
                            }
                        }
                    },
                    data: [ <?php for($i=0;$i<count($row_quocgia);$i++){?><?=$row_quocgia[$i]['dem']?><?php if(($i+1)!=count($row_quocgia)){ echo ",";}?><?php } ?>]
                }
            ]
        };

        chartliexample6.setOption(option);
    </script>

    <script>

        var chartliexample8 = echarts.init(document.getElementById('chartli8'));

        option = {
            title: {
                text: 'Form to',
                subtext: 'Devetloper By CIP Media',
                sublink: 'http://cipmedia.vn',
                x: 'right',
                y: 'bottom'
            },

            tooltip: {
                trigger: 'item',
                formatter: "{a} <br />{b} : {c} ({d}%)"
            },

            legend: {
                orient: 'vertical',
                x: 'left',
                data: [
                    <?php for($i=0;$i<count($row_dentu);$i++){?>
                    '<?=trim($row_dentu[$i]['website'])?>'<?php if(($i+1)!=count($row_dentu)){ echo ",";}?>
                    <?php } ?>
                ]
            },

            toolbox: {
                show: true,
                feature: {
                    restore: { show: true, title: 'Refresh' },
                    //magicType: { show: true, type: ['force', 'chord'] },
                    saveAsImage: { show: true, title: 'Save As Image' }
                }
            },

            color: ['#EAC435', '#345995', '#E40066', '#03CEA4', '#FB4D3D', '#403F4C', '#FA7921', '#1B998B'],

            calculable: false,
            series: (function () {
                var series = [];
                for (var i = 0; i < 30; i++) {
                    series.push({
                        name: 'Browser（Data is purely fictional）',
                        type: 'pie',
                        itemStyle: {
                            normal: {
                                label: { show: i > 28 },
                                labelLine: { show: i > 28, length: 20 }
                            }
                        },
                        radius: [i * 4 + 40, i * 4 + 43],
                        data: [
                        <?php for($i=0;$i<count($row_dentu);$i++){?>
                            { value: <?=$row_dentu[$i]['dem']?>, name: '<?=$row_dentu[$i]['website']?>' },
                        <?php } ?>
                        ]
                    })
                }

                series[0].markPoint = {
                    symbol: 'emptyCircle',
                    symbolSize: series[0].radius[0],
                    effect: { show: true, scaleSize: 12, color: 'rgba(250,225,50,0.8)', shadowBlur: 10, period: 30 },
                    data: [{ x: '50%', y: '50%' }]
                };

                return series;
            })()
        };
        chartliexample8.setOption(option);
    </script>




