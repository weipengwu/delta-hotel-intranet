<html>
	<head>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

		<style>
			@import url(https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,300,700,400,600);
			body { font-family: 'Open Sans';}
			#navMenu_app.iconItem .item .image, #navMenu_app.iconItem .item .title , #navMenu_app.iconItem .item .content, #navMenu_app.iconItem .item img{
			  display:inline-block;
			  float:none;
			  vertical-align:middle;
			  padding:0px;
			}

			#navMenu_app.iconItem .item .image{
			  margin-right:23px;
			}

			 #navMenu_app.iconItem .item .content{
			  width:auto;
			}

			.iconItem .item {
display: block;
text-align: left;
margin: 0px 0px 10px 0px;
}
.iconItem .item .image {
float: left;
width: 22px;
}
.col-1 .item .content {
width: 290px;
}
.item .content .title {
font-size: 16px;
line-height: 16px;
color: #004684;
}
.item .content .copy {
font-size: 12px;
}
		</style>
	</head>
	<body>
		<div class="navMenu iconItem" id="navMenu_app">
            <div class="inner">
                
                <div class="col-1" style="border-right: 0px;">
                    
                </div>
                
            </div>
        </div>
	</body>
	<script>
		$(document).ready(function() { 
			<? if ($_SERVER['SERVER_NAME'] == 'deltaden.kpd-i.com'): ?>
			$.ajax({ url:  'https://deltahotels.oktapreview.com/api/v1/users/me/appLinks', xhrFields: { withCredentials: true } }).done(function(res) { 
			<? else: ?>
			$.ajax({ url:  'https://deltahotels.okta.com/api/v1/users/me/appLinks', xhrFields: { withCredentials: true } }).done(function(res) { 
			<? endif; ?>

		        $.each(res, function(i, v) {

		            $('#navMenu_app .col-1').append('<a class="item" href="' + v.linkUrl + '" target="_blank"><div class="image"><img width="22" height="22" alt="" src="' + v.logoUrl + '"></div><div class="content"><div class="title">' + v.label + '</div></div></a>');


		        });

		    });
	    });
	</script>
</html>