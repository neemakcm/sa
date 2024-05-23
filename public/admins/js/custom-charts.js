
if($('#lineChart').length > 0)
{
    // based ready dom, initialize echarts instance 
    var myChart = echarts.init(document.getElementById('lineChart'));

    // Specify configurations and data graphs 
    var option = {
        xAxis: {
            type: 'category',
            data: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'],
            name: 'Date',
            nameLocation: 'middle',
            nameGap: 50
        },
        yAxis: {
            type: 'value',
            data: ['100', '200', '300', '400'],
            name: 'Bill Uploaded Count',
            nameLocation: 'middle',
            nameGap: 70
        },

        series: [{
            data: [100, 400, 150, 200, 150, 100, 63, 200, 450, 120, 285, 300, 10, 311, 395, 123, 237, 18, 7, 400, 255, 300, 400, 200, 344, 127, 126, 114, 333, 355],
            type: 'line', // 'bar'
            smooth: true
        }],
        tooltip: {
            trigger: "axis",
            axisPointer: {
                type: "shadow"
            }
        },

    };

    // Use just the specified configurations and data charts. 
    myChart.setOption(option);
}

