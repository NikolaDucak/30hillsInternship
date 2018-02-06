<!DOCTYPE html>
<html>
<head>
	<title>30hills - Test</title>
	<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>/public/css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
	<div id="container">

		<div id="people-list" class="list fixedSize">
			<ul>
				<?= $this->outputBufferContent('people-list');?>
			</ul>
		</div>

		<div id="person-info">
			<div id="person-details">
				<?= $this->outputBufferContent('person-details')?>
			</div>

			<div id="direct-friends" class="list fixedSize">	
				<h4>Direct Frineds</h4>
				<ul>
					<?= $this->outputBufferContent('direct-friends-list');?>
				</ul>
			</div>

			<div id="friends-friends" class="list fixedSize">
				<h4>Outer Friends</h4>
				<ul>
					<?= $this->outputBufferContent('outer-friends-list');?>
				</ul>
			</div>

			<div id="sugested" class="list fixedSize">
				<h4>Sugested Friends</h4>
				<ul>
					<?= $this->outputBufferContent('friend-sugestion-list');?>
				</ul>
			</div>
		</div>
		
	</div>
	<script type="text/javascript">
		$('.user').click(function(){
			$uid = $(this).attr("id");
			$('body').load('<?=BASE_URL?>/index.php', {uid: $uid});
		});
	</script>
</body>
</html>