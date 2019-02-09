<%@ page import="java.io.*,java.util.*" %>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>雪莉娜ACG</title>
    <link rel="icon" href="img/logo.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="img/logo.ico">
    <link rel="Bookmark" href="img/logo.ico">
    <style type="text/css">
    body
    {
        background-image:url(img/back.jpg);
        background-repeat:no-repeat;
        width:100%;
        height:100%;
        background-size:100% 100%;
        position:absolute;
        background-attachment:fixed
    }
    </style>
  </head>

  <body>
    <%
        Integer hitsCount = (Integer)application.getAttribute("hitCounter");
        if( hitsCount ==null || hitsCount == 0 )
            hitsCount = 1;
        else
            hitsCount += 1;
        application.setAttribute("hitCounter", hitsCount);
        String Counter = hitsCount.toString();
        while (Counter.length() < 7)
            Counter = "0" + Counter;
    %>
    <p align="center"><br>您是第<span style="background:black;"><font color="#FFFFFF"><%= Counter%></font></span>位访客。<br>
    <br>
    <p align="center"><font color="#FF0000" size=8 face="幼圆"><b>欢迎来到雪莉娜官网！</b></font><br>
    <img src="img/logo.png" align="center" height="200" name="logo" title="雪莉娜logo" alt="雪莉娜logo" vspace="30" hspace="10">
    <p align="center"><a href="https://sherrinaclub.github.io/"><font size=5 face="黑体"><b>入口</b></font></a><br>
    <br>
    发送邮件请点击右侧→<a href="mailto:sherrinaacg@163.com"><img src="img/post.png" name="post" title="发送邮件" alt="发送邮件"></a><br>
    <br><br><br><br><br><br>
    <img src="img/haruhichan.png" align="bottom" width="50%" />
  </body>
</html>
