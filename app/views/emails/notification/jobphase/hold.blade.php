<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Job Phase Payment on hold</title>
<style type="text/css" media="all">
*{margin:0; padding:0; font-family:Arial; font-size:13px; color:#666; line-height:20px; outline:none; }
.n-headr{width:100%; min-height:50px; background:#fff; padding:20px 0 10px 0; border-bottom: medium solid #dcdcdc;}
.n-wrapper{width:600px; min-height:50px; clear:both; margin:0 auto;}
.n-wrapper p{padding-bottom:10px; text-align:justify;}
.n-wrapper h3{padding-bottom:7px; color:#00accc;}
.n-logo{background:url(logo.png) no-repeat; width:119px; height:33px; display:block;}
.n-logo2{background:url(logo2.png) no-repeat; width:119px; height:33px; display:inline-block;}
.n-body-content{background:#f2f4fa; min-height:150px; padding:30px 0;}
.n-footer{background:#353946; min-height:50px; padding:20px 0 10px 0;}
a.n-btn{-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px; text-align:center; line-height:27px; min-width:90px; color:#FFF; font-size:11px; text-transform:uppercase; text-decoration:none; background:#8093a1; clear:both; display:inline-block;}
</style>
</head>

<body>
  <div style="width:100%; min-height:50px; background:#fff; padding:20px 0 10px 0; border-bottom: medium solid #dcdcdc;">

    <div style="width:600px; min-height:50px; clear:both; margin:0 auto;">
      <a href="http://asianlancers.com" style="text-decoration:none;">
        <img style="width:145px;" src="http://client.asianlancers.com/public/themes/default/img/logo-base.png"/>
        <h1 style="font-size:20px;display:inline-block;float:right;margin-right:210px;">Asianlancers.com</h1>
      </a>
    </div>

  </div>

  <div style="background:#f2f4fa; min-height:150px; padding:30px 0;" >
    <div style="width:600px; min-height:50px; clear:both; margin:0 auto;">
      <h3 style="padding-bottom:7px; color:#00accc;">Dear {{$name}}</h3>
      <p style="padding-bottom:10px; text-align:justify;">Payment process of job phase “{{$job_phase_title}}” was hold by client "{{$client}}"</p>
      <!-- <p style="padding-bottom:10px; text-align:justify;">Please visit the following link to see the job on process</p>
      <a href="" style="-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px; text-align:center; line-height:27px; min-width:90px; color:#FFF; font-size:11px; text-transform:uppercase; text-decoration:none; background:#8093a1; clear:both; display:inline-block; padding:1px 6px !important;">
       View job list
      </a> -->
    </div>
  </div>

  <div style="background:#353946; min-height:50px; padding:20px 0 10px 0;">
    <div style="width:600px; min-height:50px; clear:both; margin:0 auto;">
      <a href="http://asianlancers.com"><img src="http://client.asianlancers.com/public/themes/default/img/logo2.png" alt="logo" />
      </a>
      <a href="{{url('home/unsubscribe')}}" style="color: #fff; float: right; font-size: 12px; line-height: 30px; padding-bottom: 0; color:#00accc; text-decoration:none; padding-left:15px;">Unsubscribe</a>
      <p style="color: #fff; float: right; font-size: 12px; line-height: 30px; padding-bottom: 0;">&copy; Copyright {{date('Y')}}. All Rights Reserved.</p>
    </div>
  </div>

</body>
</html>
