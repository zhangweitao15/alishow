<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Slides &laquo; Admin</title>
  <link rel="stylesheet" href="/template/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/template/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/template/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/template/assets/css/admin.css">
  <script src="/template/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
    <nav class="navbar">
      <?php include_once '../include/nav.php' ?>
    </nav>
    <div class="container-fluid">
      <div class="page-title">
        <h1>图片轮播</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="row">
        <div class="col-md-4">
          <form>
            <h2>添加新轮播内容</h2>
            <div class="form-group">
              <label for="image">图片</label>
              <!-- show when image chose -->
              <img class="help-block thumbnail" style="display: none">
              <input id="image" class="form-control" name="image" type="file">
            </div>
            <div class="form-group">
              <label for="text">文本</label>
              <input id="text" class="form-control" name="text" type="text" placeholder="文本">
            </div>
            <div class="form-group">
              <label for="link">链接</label>
              <input id="link" class="form-control" name="link" type="text" placeholder="链接">
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="button">添加</button>
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th class="text-center">图片</th>
                <th>文本</th>
                <th>链接</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>

            <tbody>
            </tbody>

          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php' ?>
  </div>

  <script src="/template/assets/vendors/jquery/jquery.js"></script>
  <script src="/template/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="/template/assets/vendors/layer/template-web.js" ></script>
  <script type="text/template" id="tpl" >
    {{each data as v}}
        <tr>
            <td class="text-center"><input type="checkbox"></td>
            <td class="text-center"><img class="slide" src="{{v.pic_url}}"></td>
            <td>{{v.pic_text}}</td>
            <td>{{v.pic_link}}</td>
            <td class="text-center">
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr>
    {{/each}}
  </script>

 <script type="text/template" id="tpl_add" >
        <tr>
            <td class="text-center"><input type="checkbox"></td>
            <td class="text-center"><img class="slide" src="{{pic_url}}}"></td>
            <td>{{pic_text}}</td>
            <td>{{pic_link}}</td>
            <td class="text-center">
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr>
  </script>

  </script>
  <script>
    // 通过post向后端
  $.post('/template/admin/api/pic/getPic.php', function (msg) {
      var str = template('tpl', msg);
      $('tbody').html(str);
  }, 'json');
// 在添加按钮上绑定
  $('.btn-primary').click(function () {
    var fm = $('form')[0];
    var fd = new FormData(fm);
    
  $.ajax({
    url: '/template/admin/api/pic/addPic.php',
    data: fd,
    type: 'post',
    dataType: 'json',
    contentType:false,
    processData:false,
    success: function (msg) {
      console.log(msg);
      // ==
      if (msg.code == 306) {
        alert(msg.message);
        //将新数据追加到表格中
        var str = template('tpl_add', msg.data);
        $('tbody').append(str);
      } else {
        alert(msg.message);
      }
      
    }
  })
});
  </script>
  
  
  
  <script>NProgress.done()</script>
</body>
</html>
