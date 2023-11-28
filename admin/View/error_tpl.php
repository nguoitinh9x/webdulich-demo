<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Website đang bảo trì</title>
<style type="text/css">
body {
  font: 12px/20px 'Lucida Grande', Verdana, sans-serif;
  color: #404040;
  background: #343137;
}

.container {
  margin: 20px auto;
  width: 500px;
}

.container .notif {
  margin: 10px 0;
}

.notif {
  position: relative;
  padding: 25px 30px 25px 100px;
  min-height: 50px;
  line-height: 22px;
  background: white;
  border-radius: 2px;
}

.notif:before {
  content: '';
  position: absolute;
  top: 25px;
  left: 30px;
  width: 40px;
  height: 40px;
  border: 5px solid;
  border-radius: 25px;
}

.notif p {
  font-size: 11px;
  color: #666;
}

.notif-title {
  margin: 0 0 5px;
  font-size: 14px;
  font-weight: bold;
  color: #333;
}

.notif-title:before, .notif-title:after {
  content: '';
  position: absolute;
  background: white;
  border-radius: 2px;
}
.notif-alert:before {
  background: #e34f4f;
  border-color: #c14343;
}

.notif-alert .notif-title:before, .notif-alert .notif-title:after {
  top: 43px;
  left: 53px;
  width: 4px;
  height: 14px;
  -webkit-transform: rotate(45deg);
  -moz-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  -o-transform: rotate(45deg);
  transform: rotate(45deg);
}

.notif-alert .notif-title:after {
  top: 48px;
  left: 48px;
  width: 14px;
  height: 4px;
}

.notif-controls {
  position: absolute;
  top: 0;
  right: 0;
  height: 16px;
  padding: 4px 3px 5px;
  background: #f0f0f0;
  border: solid #dcdcdc;
  border-width: 0 0 1px 1px;
  border-radius: 0 2px;
}

.notif-controls > a {
  position: relative;
  float: left;
  margin: 0 1px;
  width: 16px;
  height: 16px;
  font: 0/0 serif;
  text-shadow: none;
  color: transparent;
}

.notif-minimize:before {
  content: '';
  position: absolute;
  top: 11px;
  left: 4px;
  width: 7px;
  height: 2px;
  background: #bbb;
}

.notif-minimize:hover:before {
  background: #888;
}

.notif-zoom:before {
  content: '';
  position: absolute;
  top: 6px;
  left: 3px;
  width: 5px;
  height: 3px;
  border: 2px solid #bbb;
}

.notif-zoom:hover:before {
  border-color: #888;
}

.notif-close:before, .notif-close:after {
  content: '';
  position: absolute;
  top: 4px;
  left: 7px;
  width: 2px;
  height: 10px;
  background: #bbb;
  -webkit-transform: rotate(45deg);
  -moz-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  -o-transform: rotate(45deg);
  transform: rotate(45deg);
}

.notif-close:after {
  top: 8px;
  left: 3px;
  width: 10px;
  height: 2px;
}

.notif-close:hover:before, .notif-close:hover:after {
  background: #888;
}

/* IE 8 doesn't support CSS transforms; use Unicode instead. */

.lt-ie9 .notif-notice .notif-title:before {
  content: '\2714';
  display: block;
  top: 25px;
  left: 30px;
  width: 50px;
  font: bold 18px/50px "Arial Unicode MS";
  color: white;
  text-align: center;
  background: none;
}

.lt-ie9 .notif-notice .notif-title:after {
  display: none;
}

.lt-ie9 .notif-alert .notif-title:before {
  content: '\2716';
  display: block;
  top: 25px;
  left: 30px;
  width: 50px;
  font: bold 17px/50px "Arial Unicode MS";
  color: white;
  text-align: center;
  background: none;
}

.lt-ie9 .notif-alert .notif-title:after {
  display: none;
}

.lt-ie9 .notif-close:before {
  content: '\2716';
  display: block;
  top: 0;
  left: 0;
  width: 16px;
  font: 11px/19px 'Arial Unicode MS';
  color: #bbb;
  text-align: center;
  background: none;
}

.lt-ie9 .notif-close:after {
  display: none;
}

.lt-ie9 .notif-close:hover:before {
  color: #999;
}

</style>
</head>

<body>
<div class="container">
   
    <section class="notif notif-alert">
      <h6 class="notif-title">Thông báo!</h6>
      <p>Hiện hệ thống đang bận. Xin quý khác vui lòng quay lại sau!</p>
     <p></p>
    </section>
   
  </div>
</body>
</html>