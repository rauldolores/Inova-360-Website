<?php
	include("../../../../config.php");
?>
/*------------------------------------*\
	CONTENTS
\*------------------------------------*/
/*
WRAPPER
BUTTON
BUTTON LABEL
BUTTON ICON
ICONS
DROPDOWN MENU
*/


/*------------------------------------*\
	$WRAPPER
\*------------------------------------*/
.buttons {/* Style as you wish (toolbar) */}

/* The Magnificent CLEARFIX */
.buttons:before, .buttons:after {
  content: "\0020"; display: block; height: 0; visibility: hidden;	
} 
.buttons:after { clear: both; }
.buttons { zoom: 1; }
/* ------------------------ */


/*------------------------------------*\
	$BUTTON
\*------------------------------------*/
button, 
.button {
	text-decoration: none;
	text-shadow: 0 1px 0 #fff;
	
	font: bold 11px Helvetica, Arial, sans-serif;
	color: #444;
	line-height: 17px;
	height: 18px;
	
	display: inline-block;
	float: left;
	
	margin: 5px;
	padding: 5px 6px 4px 6px;
	
	background: #F3F3F3;
	border: solid 1px #D9D9D9;
	
	border-radius: 2px;
	-webkit-border-radius: 2px;
	-moz-border-radius: 2px;
	
	-webkit-transition: border-color .20s;
	-moz-transition: border-color .20s;
	-o-transition: border-color .20s;
	transition: border-color .20s;
}
button {
	height: 29px !important;
	cursor: pointer;
}

button.left, 
.button.left {
	margin: 5px 0 5px 5px;
	
	border-top-right-radius: 0;
	-webkit-border-top-right-radius: 0;
	-moz-border-radius-topright: 0;
	
	border-bottom-right-radius: 0;
	-webkit-border-bottom-right-radius: 0;
	-moz-border-radius-bottomright: 0;
}
button.middle, 
.button.middle {
	margin: 5px 0;
	
	border-left-color: #F4F4F4;
	
	border-radius: 0;
	-webkit-border-radius: 0;
	-moz-border-radius: 0;
}
button.right, 
.button.right {
	margin: 5px 5px 5px 0;
	
	border-left-color: #F4F4F4;
	
	border-top-left-radius: 0;
	-webkit-border-top-left-radius: 0;
	-moz-border-radius-topleft: 0;
	
	border-bottom-left-radius: 0;
	-webkit-border-bottom-left-radius: 0;
	-moz-border-radius-bottomleft: 0;
}

button:hover, 
.button:hover {
    background: #F4F4F4;
		border-color: #C0C0C0;
		color: #333;
}

button:active, 
.button:active {
	border-color: #4D90FE;
	color: #4D90FE;
	
	-moz-box-shadow:inset 0 0 10px #D4D4D4;
	-webkit-box-shadow:inset 0 0 10px #D4D4D4;
	box-shadow:inset 0 0 10px #D4D4D4;
}

button.on, 
.button.on {
	border-color: #BBB;
	
	-moz-box-shadow:inset 0 0 10px #D4D4D4;
	-webkit-box-shadow:inset 0 0 10px #D4D4D4;
	box-shadow:inset 0 0 10px #D4D4D4;
}
button.on:hover, 
.button.on:hover {
	border-color: #BBB;
	
	-moz-box-shadow:inset 0 0 10px #D4D4D4;
	-webkit-box-shadow:inset 0 0 10px #D4D4D4;
	box-shadow:inset 0 0 10px #D4D4D4;
}
button.on:active, 
.button.on:active {
	border-color: #4D90FE;
}

button.action, 
.button.action {
	border: 1px solid #D8D8D8 !important;
	
	background: #F2F2F2;
	background: -webkit-linear-gradient(top, #F5F5F5, #F1F1F1);
	background: -moz-linear-gradient(top, #F5F5F5, #F1F1F1);
	background: -ms-linear-gradient(top, #F5F5F5, #F1F1F1);
	background: -o-linear-gradient(top, #F5F5F5, #F1F1F1);
	
	-webkit-transition: border .20s;
	-moz-transition: border .20s;
	-o-transition: border .20s;
	transition: border .20s;
}
button.action:hover, 
.button.action:hover {
	border: 1px solid #C6C6C6 !important;
	
	background: #F3F3F3;
	background: -webkit-linear-gradient(top, #F8F8F8, #F1F1F1);
	background: -moz-linear-gradient(top, #F8F8F8, #F1F1F1);
	background: -ms-linear-gradient(top, #F8F8F8, #F1F1F1);
	background: -o-linear-gradient(top, #F8F8F8, #F1F1F1);
}
button.blue, 
.button.blue {
	border: 1px solid #3079ED !important;
	
	background: #4B8DF8;
	background: -webkit-linear-gradient(top, #4C8FFD, #4787ED);
	background: -moz-linear-gradient(top, #4C8FFD, #4787ED);
	background: -ms-linear-gradient(top, #4C8FFD, #4787ED);
	background: -o-linear-gradient(top, #4C8FFD, #4787ED);
	
	-webkit-transition: border .20s;
	-moz-transition: border .20s;
	-o-transition: border .20s;
	transition: border .20s;
}
button.blue:hover, 
.button.blue:hover {
	border: 1px solid #2F5BB7 !important;
	
	background: #3F83F1;
	background: -webkit-linear-gradient(top, #4D90FE, #357AE8);
	background: -moz-linear-gradient(top, #4D90FE, #357AE8);
	background: -ms-linear-gradient(top, #4D90FE, #357AE8);
	background: -o-linear-gradient(top, #4D90FE, #357AE8);
}
button.green, 
.button.green {
	border: 1px solid #29691D !important;
	
	background: #3A8E00;
	background: -webkit-linear-gradient(top, #3C9300, #398A00);
	background: -moz-linear-gradient(top, #3C9300, #398A00);
	background: -ms-linear-gradient(top, #3C9300, #398A00);
	background: -o-linear-gradient(top, #3C9300, #398A00);
	
	-webkit-transition: border .20s;
	-moz-transition: border .20s;
	-o-transition: border .20s;
	transition: border .20s;
}
button.green:hover, 
.button.green:hover {
	border: 1px solid #2D6200 !important;
	
	background: #3F83F1;
	background: -webkit-linear-gradient(top, #3C9300, #368200);
	background: -moz-linear-gradient(top, #3C9300, #368200);
	background: -ms-linear-gradient(top, #3C9300, #368200);
	background: -o-linear-gradient(top, #3C9300, #368200);
}
button.red, 
.button.red {
	border: 1px solid #D14836 !important;
	
	background: #D64937;
	background: -webkit-linear-gradient(top, #DC4A38, #D14836);
	background: -moz-linear-gradient(top, #DC4A38, #D14836);
	background: -ms-linear-gradient(top, #DC4A38, #D14836);
	background: -o-linear-gradient(top, #DC4A38, #D14836);
	
	-webkit-transition: border .20s;
	-moz-transition: border .20s;
	-o-transition: border .20s;
	transition: border .20s;
}
button.red:hover, 
.button.red:hover {
	border: 1px solid #B0281A !important;
	
	background: #D14130;
	background: -webkit-linear-gradient(top, #DC4A38, #C53727);
	background: -moz-linear-gradient(top, #DC4A38, #C53727);
	background: -ms-linear-gradient(top, #DC4A38, #C53727);
	background: -o-linear-gradient(top, #DC4A38, #C53727);
}

button.action:hover, 
.button.action:hover {
	-moz-box-shadow: 0 1px 0px #DDD;
	-webkit-box-shadow: 0 1px 0px #DDD;
	box-shadow:iset 0 1px 0px #DDD;
}
button.action:active, 
.button.action:active {
	-moz-box-shadow: none !important;
	-webkit-box-shadow: none !important;
	box-shadow: none !important;
	border-color: #C6C6C6 !important;
}
button.blue:active, 
.button.blue:active {
	border-color: #2F5BB7 !important;
}
button.green:active, 
.button.green:active {
	border-color: #2D6200 !important;
}
button.red:active, 
.button.red:active {
	border-color: #B0281A !important;
}



/*------------------------------------*\
	$BUTTON LABEL
\*------------------------------------*/
.ddm span.label, 
button span.label, 
.button span.label {
	display: inline-block;
	float: left;
	line-height: 17px;
	height: 18px;
	padding: 0 1px;
	overflow: hidden;
	color: #444;
	
	-webkit-transition: color .20s;
	-moz-transition: color .20s;
	-o-transition: color .20s;
	transition: color .20s;
} 
button span.label {
	line-height: 15px !important;
}
.ddm:active span.label, 
button:active span.label, 
.button:active span.label {
    color: #4D90FE;
}

button:hover .label, 
.button:hover .label {
    color: #333;
}
button:hover .label.red, 
.button:hover .label.red {
    color: #DB4A37;
}
button:hover .label.blue, 
.button:hover .label.blue {
    color: #7090C8;
}
button:hover .label.green, 
.button:hover .label.green {
    color: #42B449;
}
button:hover .label.yellow, 
.button:hover .label.yellow {
    color: #F7CB38;
}

button.blue .label, 
.button.blue .label {
	color: #FFF !important;
	text-shadow: 0 1px 0 #2F5BB7 !important;
}
button.green .label, 
.button.green .label {
	color: #FFF !important;
	text-shadow: 0 1px 0 #2D6200 !important;
}
button.red .label, 
.button.red .label {
	color: #FFF !important;
	text-shadow: 0 1px 0 #B0281A !important;
}
button.action .label, 
.button.action .label {
	padding: 0 17px !important;
}

button.action:active .label, 
.button.action:active .label {
	color: #333 !important;
}

button.blue:active .label, 
button.green:active .label, 
button.red:active .label, 
.button.blue:active .label, 
.button.green:active .label, 
.button.red:active .label {
	color: #FFF !important;
}



/*------------------------------------*\
	$BUTTON ICON
\*------------------------------------*/
.ddm span.icon, 
button span.icon, 
.button span.icon {
	background-image: url(<?php echo $CONFIG["DOMINIO"]; ?>librerias/js/botones/images/google+-ui-sprite-gray.png);
	
	display: inline-block;
	margin: 0 7px;
	float: left;
	
	line-height: 18px;
	height: 18px;
	width: 18px;
	max-width: 18px;
	
	overflow: hidden;
	text-indent: -9999px;
	
	background-repeat: no-repeat;
	
	-webkit-transition: background-image 0.20s linear;
	-moz-transition: background-image 0.20s linear;
	-o-transition: background-image 0.20s linear;
	transition: background-image 0.20s linear;
}
.ddm:hover span.icon, 
button:hover span.icon, 
.button:hover span.icon {
	background-image: url(<?php echo $CONFIG["DOMINIO"]; ?>librerias/js/botones/images/google+-ui-sprite-colour.png);
}



/*------------------------------------*\
	$ICONS
\*------------------------------------*/

/* Sprite Row 1 */
span.icon1 {background-position: -0px -0px;}
span.icon2 {background-position: -18px -0px;}
span.icon3 {background-position: -36px -0px;}
span.icon4 {background-position: -54px -0px;}
span.icon5 {background-position: -72px -0px;}
span.icon6 {background-position: -90px -0px;}
span.icon7 {background-position: -108px -0px;}
span.icon8 {background-position: -126px -0px;}
span.icon9 {background-position: -144px -0px;}
span.icon10 {background-position: -162px -0px;}
span.icon11 {background-position: -180px -0px;}
span.icon12 {background-position: -198px -0px;}
span.icon13 {background-position: -216px -0px;}
span.icon14 {background-position: -234px -0px;}
span.icon15 {background-position: -252px -0px;}
span.icon16 {background-position: -270px -0px;}
span.icon17 {background-position: -288px -0px;}
span.icon18 {background-position: -306px -0px;}
span.icon19 {background-position: -324px -0px;}
span.icon20 {background-position: -342px -0px;}

/* Sprite Row 2 */
span.icon21 {background-position: -0px -18px;}
span.icon22 {background-position: -18px -18px;}
span.icon23 {background-position: -36px -18px;}
span.icon24 {background-position: -54px -18px;}
span.icon25 {background-position: -72px -18px;}
span.icon26 {background-position: -90px -18px;}
span.icon27 {background-position: -108px -18px;}
span.icon28 {background-position: -126px -18px;}
span.icon29 {background-position: -144px -18px;}
span.icon30 {background-position: -162px -18px;}
span.icon31 {background-position: -180px -18px;}
span.icon32 {background-position: -198px -18px;}
span.icon33 {background-position: -216px -18px;}
span.icon34 {background-position: -234px -18px;}
span.icon35 {background-position: -252px -18px;}
span.icon36 {background-position: -270px -18px;}
span.icon37 {background-position: -288px -18px;}
span.icon38 {background-position: -306px -18px;}
span.icon39 {background-position: -324px -18px;}
span.icon40 {background-position: -342px -18px;}

/* Sprite Row 3 */
span.icon41 {background-position: -0px -36px;}
span.icon42 {background-position: -18px -36px;}
span.icon43 {background-position: -36px -36px;}
span.icon44 {background-position: -54px -36px;}
span.icon45 {background-position: -72px -36px;}
span.icon46 {background-position: -90px -36px;}
span.icon47 {background-position: -108px -36px;}
span.icon48 {background-position: -126px -36px;}
span.icon49 {background-position: -144px -36px;}
span.icon50 {background-position: -162px -36px;}
span.icon51 {background-position: -180px -36px;}
span.icon52 {background-position: -198px -36px;}
span.icon53 {background-position: -216px -36px;}
span.icon54 {background-position: -234px -36px;}
span.icon55 {background-position: -252px -36px;}
span.icon56 {background-position: -270px -36px;}
span.icon57 {background-position: -288px -36px;}
span.icon58 {background-position: -306px -36px;}
span.icon59 {background-position: -324px -36px;}
span.icon60 {background-position: -342px -36px;}

/* Sprite Row 4 */
span.icon61 {background-position: -0px -54px;}
span.icon62 {background-position: -18px -54px;}
span.icon63 {background-position: -36px -54px;}
span.icon64 {background-position: -54px -54px;}
span.icon65 {background-position: -72px -54px;}
span.icon66 {background-position: -90px -54px;}
span.icon67 {background-position: -108px -54px;}
span.icon68 {background-position: -126px -54px;}
span.icon69 {background-position: -144px -54px;}
span.icon70 {background-position: -162px -54px;}
span.icon71 {background-position: -180px -54px;}
span.icon72 {background-position: -198px -54px;}
span.icon73 {background-position: -216px -54px;}
span.icon74 {background-position: -234px -54px;}
span.icon75 {background-position: -252px -54px;}
span.icon76 {background-position: -270px -54px;}
span.icon77 {background-position: -288px -54px;}
span.icon78 {background-position: -306px -54px;}
span.icon79 {background-position: -324px -54px;}
span.icon80 {background-position: -342px -54px;}

/* Sprite Row 5 */
span.icon81 {background-position: -0px -72px;}
span.icon82 {background-position: -18px -72px;}
span.icon83 {background-position: -36px -72px;}
span.icon84 {background-position: -54px -72px;}
span.icon85 {background-position: -72px -72px;}
span.icon86 {background-position: -90px -72px;}
span.icon87 {background-position: -108px -72px;}
span.icon88 {background-position: -126px -72px;}
span.icon89 {background-position: -144px -72px;}
span.icon90 {background-position: -162px -72px;}
span.icon91 {background-position: -180px -72px;}
span.icon92 {background-position: -198px -72px;}
span.icon93 {background-position: -216px -72px;}
span.icon94 {background-position: -234px -72px;}
span.icon95 {background-position: -252px -72px;}
span.icon96 {background-position: -270px -72px;}
span.icon97 {background-position: -288px -72px;}
span.icon98 {background-position: -306px -72px;}
span.icon99 {background-position: -324px -72px;}
span.icon100 {background-position: -342px -72px;}

/* Sprite Row 6 */
span.icon101 {background-position: -0px -90px;}
span.icon102 {background-position: -18px -90px;}
span.icon103 {background-position: -36px -90px;}
span.icon104 {background-position: -54px -90px;}
span.icon105 {background-position: -72px -90px;}
span.icon106 {background-position: -90px -90px;}
span.icon107 {background-position: -108px -90px;}
span.icon108 {background-position: -126px -90px;}
span.icon109 {background-position: -144px -90px;}
span.icon110 {background-position: -162px -90px;}
span.icon111 {background-position: -180px -90px;}
span.icon112 {background-position: -198px -90px;}
span.icon113 {background-position: -216px -90px;}
span.icon114 {background-position: -234px -90px;}
span.icon115 {background-position: -252px -90px;}
span.icon116 {background-position: -270px -90px;}
span.icon117 {background-position: -288px -90px;}
span.icon118 {background-position: -306px -90px;}
span.icon119 {background-position: -324px -90px;}
span.icon120 {background-position: -342px -90px;}

/* Sprite Row 7 */
span.icon121 {background-position: -0px -108px;}
span.icon122 {background-position: -18px -108px;}
span.icon123 {background-position: -36px -108px;}
span.icon124 {background-position: -54px -108px;}
span.icon125 {background-position: -72px -108px;}
span.icon126 {background-position: -90px -108px;}
span.icon127 {background-position: -108px -108px;}
span.icon128 {background-position: -126px -108px;}
span.icon129 {background-position: -144px -108px;}
span.icon130 {background-position: -162px -108px;}
span.icon131 {background-position: -180px -108px;}
span.icon132 {background-position: -198px -108px;}
span.icon133 {background-position: -216px -108px;}
span.icon134 {background-position: -234px -108px;}
span.icon135 {background-position: -252px -108px;}
span.icon136 {background-position: -270px -108px;}
span.icon137 {background-position: -288px -108px;}
span.icon138 {background-position: -306px -108px;}
span.icon139 {background-position: -324px -108px;}
span.icon140 {background-position: -342px -108px;}

/* Sprite Row 8 */
span.icon141 {background-position: -0px -126px;}
span.icon142 {background-position: -18px -126px;}
span.icon143 {background-position: -36px -126px;}
span.icon144 {background-position: -54px -126px;}
span.icon145 {background-position: -72px -126px;}
span.icon146 {background-position: -90px -126px;}
span.icon147 {background-position: -108px -126px;}
span.icon148 {background-position: -126px -126px;}
span.icon149 {background-position: -144px -126px;}
span.icon150 {background-position: -162px -126px;}
span.icon151 {background-position: -180px -126px;}
span.icon152 {background-position: -198px -126px;}
span.icon153 {background-position: -216px -126px;}
span.icon154 {background-position: -234px -126px;}
span.icon155 {background-position: -252px -126px;}
span.icon156 {background-position: -270px -126px;}
span.icon157 {background-position: -288px -126px;}
span.icon158 {background-position: -306px -126px;}
span.icon159 {background-position: -324px -126px;}
span.icon160 {background-position: -342px -126px;}

/* Sprite Row 9 */
span.icon161 {background-position: -0px -144px;}
span.icon162 {background-position: -18px -144px;}
span.icon163 {background-position: -36px -144px;}
span.icon164 {background-position: -54px -144px;}
span.icon165 {background-position: -72px -144px;}
span.icon166 {background-position: -90px -144px;}
span.icon167 {background-position: -108px -144px;}
span.icon168 {background-position: -126px -144px;}
span.icon169 {background-position: -144px -144px;}
span.icon170 {background-position: -162px -144px;}
span.icon171 {background-position: -180px -144px;}
span.icon172 {background-position: -198px -144px;}
span.icon173 {background-position: -216px -144px;}
span.icon174 {background-position: -234px -144px;}
span.icon175 {background-position: -252px -144px;}
span.icon176 {background-position: -270px -144px;}
span.icon177 {background-position: -288px -144px;}
span.icon178 {background-position: -306px -144px;}
span.icon179 {background-position: -324px -144px;}
span.icon180 {background-position: -342px -144px;}

/* Sprite Row 10 */
span.icon181 {background-position: -0px -162px;}
span.icon182 {background-position: -18px -162px;}
span.icon183 {background-position: -36px -162px;}
span.icon184 {background-position: -54px -162px;}
span.icon185 {background-position: -72px -162px;}
span.icon186 {background-position: -90px -162px;}
span.icon187 {background-position: -108px -162px;}
span.icon188 {background-position: -126px -162px;}
span.icon189 {background-position: -144px -162px;}
span.icon190 {background-position: -162px -162px;}
span.icon191 {background-position: -180px -162px;}
span.icon192 {background-position: -198px -162px;}
span.icon193 {background-position: -216px -162px;}
span.icon194 {background-position: -234px -162px;}
span.icon195 {background-position: -252px -162px;}
span.icon196 {background-position: -270px -162px;}
span.icon197 {background-position: -288px -162px;}
span.icon198 {background-position: -306px -162px;}
span.icon199 {background-position: -324px -162px;}
span.icon200 {background-position: -342px -162px;}



/*------------------------------------*\
	$DROPDOWN MENU
\*------------------------------------*/
div.dropdown {
	float: left;
	position: relative;
}

div.dropdown span.toggle {
	width: 19px;
	height: 16px;
	
	margin-left: 7px;
	margin-top: 1px;
	margin-right: 2px;
	padding-left: 8px;
	
	float: right;
	
	background: url(<?php echo $CONFIG["DOMINIO"]; ?>librerias/js/botones/images/toggle.png) top right no-repeat;
	border-left: 1px solid #D9D9D9;
	
	-webkit-transition: border-color .20s;
	-moz-transition: border .20s;
	-o-transition: border-color .20s;
	transition: border-color .20s;
}
div.dropdown span.toggle.active {
	background: url(<?php echo $CONFIG["DOMINIO"]; ?>librerias/js/botones/images/toggle.png) bottom right no-repeat;
}
div.dropdown 
button:hover span.toggle, 
.button:hover span.toggle {
	border-color: #C0C0C0;
}

div.dropdown-slider {
	display: none;
	
	overflow: hidden;
	
	margin: 0 7px 5px 7px;
	position: absolute;
	top: 34px;
	right: 0;
	
	background: #F2F2F2;
	
	border-right: solid 1px #D9D9D9;
	border-bottom: solid 1px #D9D9D9;
	border-left: solid 1px #D9D9D9;
	
	-webkit-border-bottom-right-radius: 2px;
	-webkit-border-bottom-left-radius: 2px;
	-moz-border-radius-bottomright: 2px;
	-moz-border-radius-bottomleft: 2px;
	border-bottom-right-radius: 2px;
	border-bottom-left-radius: 2px;
	
	-webkit-transition: border-color .20s;
	-moz-transition: border .20s;
	-o-transition: border-color .20s;
	transition: border-color .20s;
}
.left div.dropdown-slider {
	margin: 0 1px 5px 7px;
}
.middle div.dropdown-slider {
	margin: 0 1px 5px 1px;
}
.right div.dropdown-slider {
	margin: 0 7px 5px 1px;
}
div.dropdown-slider .ddm {
	display: block;
	background: #F2F2F2;
	color: #585858;
	
	text-decoration: none;
	text-shadow: 0 1px 0 #fff;
	font: bold 11px Helvetica, Arial, sans-serif;
	line-height: 18px;
	height: 18px;
	
	margin: 0;
	padding: 5px 6px 4px 6px;
	width: 100%;
	float: left;
	
	border-top: 1px solid #FFF;
	border-bottom: 1px solid #D9D9D9;
}
div.dropdown-slider .ddm:hover {
	background: #F4F4F4;
	border-bottom-color: #C0C0C0;
}
div.dropdown-slider .ddm:active {
	border-bottom-color: #4D90FE;
	color: #4D90FE;
	
	-moz-box-shadow:inset 0 0 10px #D4D4D4;
	-webkit-box-shadow:inset 0 0 10px #D4D4D4;
	box-shadow:inset 0 0 10px #D4D4D4;
}
div.dropdown-slider .ddm:last-child {
	border-bottom: none;
}
