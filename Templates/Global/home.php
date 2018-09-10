<!DOCTYPE html>
	<html>
		<head>

			<meta charset="utf-8">
			<title>My FramePhp App</title>
			<!-- The constant ASSET allows you to access the Assets folder to get your css or js files or your images -->
			<link rel="stylesheet" type="text/css" href="<?= ASSET . 'Styles/home.css' ?>">

		</head>
		
		<body>

			<h1>FramePhp</h1>

			<!-- The method translate of translate object allows you to translate your site -->
			<h2><?= $translate->translate('Get started'); ?></h2>
		</body>
	</html>