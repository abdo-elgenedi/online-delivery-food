<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>AdminLTE 3 | Dashboard</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{asset("assets/mystyle.css")}}">

	<link rel="stylesheet" href="{{asset("assets/plugins/fontawesome-free/css/all.min.css")}}">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Tempusdominus Bbootstrap 4 -->

	<link rel="stylesheet" href="{{asset("assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css")}}">
	<!-- iCheck -->
	<link rel="stylesheet" href="{{asset("assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}">
	<!-- JQVMap -->
	<link rel="stylesheet" href="{{asset("assets/plugins/jqvmap/jqvmap.min.css")}}">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{asset("assets/dist/css/adminlte.min.css")}}">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="{{asset("assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css")}}">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="{{asset("assets/plugins/daterangepicker/daterangepicker.css")}}">
	<!-- summernote -->
	<link rel="stylesheet" href="{{asset("assets/plugins/summernote/summernote-bs4.css")}}">

	<link rel="stylesheet" href="{{asset("assets/plugins/file-uploaders/dropzone.css")}}">

	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<style>
		.outerDivFull { margin:50px; }

		/*.switchToggle input[type=checkbox]{height: 0; width: 0; visibility: hidden; position: absolute; }*/
		.switchToggle label {cursor: pointer; text-indent: -9999px; width: 110px; max-width: 110px; height: 30px; background: #d1d1d1; display: block; border-radius: 100px; position: relative; }
		.switchToggle label:after {content: ''; position: absolute; top: 2px; left: 2px; width: 26px; height: 26px; background: #fff; border-radius: 90px; transition: 0.3s; }
		.switchToggle input:checked + label, .switchToggle input:checked + input + label  {background:#007bff; }
		.switchToggle input + label:before, .switchToggle input + input + label:before {content: 'Deactive'; position: absolute; top: 5px; left: 35px; width: 65px; height: 26px; border-radius: 90px; transition: 0.3s; text-indent: 0; color: #fff; }
		.switchToggle input:checked + label:before, .switchToggle input:checked + input + label:before {content: 'Active'; position: absolute; top: 5px; left: 10px; width: 65px; height: 26px; border-radius: 90px; transition: 0.3s; text-indent: 0; color: #fff; }
		.switchToggle input:checked + label:after, .switchToggle input:checked + input + label:after {left: calc(100% - 2px); transform: translateX(-100%); }
	</style>

</head>