<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>

<body>
<?php foreach ($news as $news_item): ?>
<h2><?php echo $news_item['title'] ?></h2>
<div id="main">
        <?php echo $news_item['text'] ?>
    </div>
    <p><a href="news/<?php echo $news_item['slug'] ?>">View article</a></p>

<?php endforeach ?>

</body>
</html>
