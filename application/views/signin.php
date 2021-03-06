<?php include('common_top.php');?>
<body class="signin">
<section>
  <div class="signinpanel">
    <div class="row">
      <div class="col-md-7">
        <div class="signin-info">
          <div class="logopanel">
              <h1><span>//</span> 巧克力任务跟踪系统<sup>0.3</sup> <span>//</span></h1>
          </div><!-- logopanel -->
          <div class="mb20"></div>
          <h5><strong>CITS - Chocolate Issue Tracker System</strong></h5>
          <ul style="line-height:27px;">
              <li><i class="fa fa-arrow-circle-o-right"></i> 开发计划轻松掌握</li>
              <li><i class="fa fa-arrow-circle-o-right"></i> 任务执行情况跟踪</li>
              <li><i class="fa fa-arrow-circle-o-right"></i> 代码提测一键部署</li>
              <li><i class="fa fa-arrow-circle-o-right"></i> 过程数据跟踪分析</li>
              <li><i class="fa fa-arrow-circle-o-right"></i> 静态分析持续集成</li>
          </ul>
          <div class="mb20"></div>
          
          <span class="label label-primary"><strong>由于用户系统升级，原有密码失效，老用户请使用“忘记密码？”功能重设您的密码</strong></span>
        </div><!-- signin0-info -->
      </div><!-- col-sm-7 -->
      <div class="col-md-5">
      <form method="post" action="/admin/login">
        <h4 class="nomargin">登录</h4>
        <input name="account" id="account" type="text" class="form-control uname" placeholder="帐号/邮箱" />
        <input name="password" id="password" type="password" class="form-control pword" placeholder="密码" />
        <button name="button" id="button" type="button" class="btn btn-success btn-block">登入</button>
        <div class="mb20"></div>
        <div class="row"><div class="col-sm-6"><a href="/forgot">忘记密码？</a></div><div class="col-sm-6" align="right"><a href="/signup">申请帐号</a></div></div>
      </form>
      </div><!-- col-sm-5 -->
    </div><!-- row -->
    <div class="signup-footer">
        <div class="pull-left">
            &copy; 2016. All Rights Reserved.
        </div>
        <div class="pull-right">
            Page rendered in <strong>{elapsed_time}</strong> seconds.
        </div>
    </div>
  </div><!-- signin -->
</section>
<?php include('common_js.php');?>
<script src="<?php echo STATIC_HOST; ?>/js/custom.js"></script>
<script type="text/javascript">

  //验证登录函数
  function login() {
    var redirect_url = $.cookie('cits_redirect_url');
    $.cookie('cits_redirect_url', '', {expires:-1});
    if (!redirect_url) {
      redirect_url = '/';
    }
    $.ajax({
      type: "POST",
      url: "/signin/check",
      data:{'account':$("#account").val(), 'password':$("#password").val()},
      dataType: "JSON",
      success: function(data){
        if (data.status) {
          jQuery.gritter.add({
            title: '提醒',
            text: data.message,
            class_name: 'growl-success',
            sticky: false,
            time: ''
          });
          setTimeout(function(){
            location.href = redirect_url;
          }, 500);
        } else {
          jQuery.gritter.add({
            title: '提醒',
            text: data.error,
            class_name: 'growl-danger',
            sticky: false,
            time: ''
          });
        }
      }
    });
  }

  $(document).ready(function(){

    //提交按钮触发
    $("#button").click(function(){
      login();
    });

    //回车键触发
    $('input:text:first').focus();
    var $inp = $('input');
    $inp.keypress(function (e) {
      var key = e.which; //e.which是按键的值 
      if (key == 13) { 
        login();
      } 
    }); 

  });
</script>

</body>
</html>
