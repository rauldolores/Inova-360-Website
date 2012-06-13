/**********************
CAJA LIGHTBOX
***********************/

		.backdrop
		{
			position:fixed;
			top:0px;
			left:0px;
			width:100%;
			height:100%;
			background:#fff;
			opacity: .0;
			filter:alpha(opacity=0);
			z-index:30;
			display:none;
		}


		.box
		{
			font-family: Helvetica, Arial;
			font-size: 12px;
			top:20%;
			left: 10px;
			/*width:600px;
			height:300px;*/			
			position:fixed;
			background:#000;
			color: #ddd;
			z-index:51;
			-webkit-border-radius: 5px;
			-moz-border-radius: 5px;
			border-radius: 5px;
			border: 10px solid #000;
			display:none;
		}

		.close
		{
			float:right;
			margin-right:6px;
			font-weight: bold;
			font-size: 22px;
			cursor:pointer;
			color: #fff;
		}