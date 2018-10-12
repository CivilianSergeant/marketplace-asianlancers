<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
        <h1>Please reset your password !</h1>
        <br/>
		<h2>Dear {{$name}} ,</h2>
		<div>
			To activate your account, Please click the link :

            <a href="{{url('home/reset')}}/{{$id}}/{{$activation_code}}">Click here</a>
		</div>
	</body>
</html>
