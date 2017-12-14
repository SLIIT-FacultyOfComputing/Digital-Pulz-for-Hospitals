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
		<h1>Charts:</h1>&nbsp;&nbsp;&nbsp;<h2>Diabetic  Chart</h2>
	</div>
  <div id="line-example"></div>
  
  <script>
  Morris.Line({
        element: 'line-example',
        data: [
            {Date: '2014-08-20 13:00', Diabetic: 88},
            {Date: '2014-08-20 17:00', Diabetic: 85},
            {Date: '2014-08-20 23:00', Diabetic: 95},
            {Date: '2014-08-21 05:00', Diabetic: 92},
            {Date: '2014-08-21 11:00', Diabetic: 105},
            {Date: '2014-08-21 17:00', Diabetic: 100},
            {Date: '2014-08-21 23:00', Diabetic: 96},
			{Date: '2014-08-22 05:00', Diabetic: 91},
            {Date: '2014-08-22 11:00', Diabetic: 87},
            {Date: '2014-08-22 17:00', Diabetic: 84},
            //{ Date: '1970-01-01 05:30', Diabetic: 100, Seline: 50, OutPut: 120},
        ],
        xkey: 'Date',
        ykeys: ['Diabetic'],
        labels: ['Diabetic']
});
  </script>
</body>
</html>