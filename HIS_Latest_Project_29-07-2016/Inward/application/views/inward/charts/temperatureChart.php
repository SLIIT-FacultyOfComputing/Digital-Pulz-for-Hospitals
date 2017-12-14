<!DOCTYPE html>
<html>
<head>
<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
  <script src="http://cdn.oesmith.co.uk/morris-0.4.1.min.js"></script>
<meta charset=utf-8 />
<title>Morris.js Line Chart Example</title>
<style>
.title
{
    height: 45px;
    line-height: 45px;
    margin: 0 auto;
    padding: 0 40px;
    width: 950px;
}

    .title h1,
    .title h2
    {
        display: inline;
        font-size: 30px;
        color: #565656;
        text-transform: none;
    }

    .title h2
    {
        color: #f17f21
    }
</style>
</head>
<body>
	<div class="title">
		<h1>Charts:</h1>&nbsp;&nbsp;&nbsp;<h2>Fever Chart</h2>
	</div>
  <div id="line-example"></div>
  
  <script>
  Morris.Line({
        element: 'line-example',
        data: [
            {Date: '2014-08-20 13:00', Temperature: 45},
            {Date: '2014-08-20 17:00', Temperature: 40},
            {Date: '2014-08-20 23:00', Temperature: 37},
            {Date: '2014-08-21 05:00', Temperature: 42},
            {Date: '2014-08-21 11:00', Temperature: 50},
            {Date: '2014-08-21 17:00', Temperature: 45},
            {Date: '2014-08-21 23:00', Temperature: 43},
			{Date: '2014-08-22 05:00', Temperature: 40},
            {Date: '2014-08-22 11:00', Temperature: 42},
            {Date: '2014-08-22 17:00', Temperature: 37},
            //{ Date: '1970-01-01 05:30', Temperature: 100, Seline: 50, OutPut: 120},
        ],
        xkey: 'Date',
        ykeys: ['Temperature'],
        labels: ['Temperature']
});
  </script>
</body>
</html>