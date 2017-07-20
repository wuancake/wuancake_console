<template>
<div class="sidebar">
        <div class="box">
            <div class="page with-sidebar">
                <div class="page-header">
                    <img class="img-responsive" src="blue.jpeg" alt="用户头像">
                    <div class="uid"><span>产品经理组：二马</span></div>
                </div>
                <div class="page-sidebar text-center">
                    <ul class="sub-menu" style="padding-left: 0px;margin-bottom: 0px;">
                        <li class="active"><a style="text-decoration:none;" href="#">我的周报</a></li>
                        <li><a style="text-decoration:none;" href="#">修改密码</a></li>
                    </ul>
                </div>
                <div class="page-region">
                    <button class="btn btn-default center-block" type="submit">退出</button>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
  name: 'sidebar',
  data () {
    return {
      title: '午安煎饼计划'
    }
  }
}
</script>

<style scoped>
  html,body{margin: 0;padding: 0;}
  .sidebar{
  	background-color: #f2f2f2;
  }
  .top .navbar {
            background-color: rgb(66, 133, 244);
            text-align: center;
            color: white;
        }

        .top .navbar h2 {
            font-size: 1.15625rem;
            /* 18/16=1.125 */
            /* margin: 0.65625rem auto 0.9375rem; */
            margin-top: 0.65625rem;
            /* 10.5/16=0.65625   15/16=0.9375 */
            /* vertical-align: middle; */
        }

        .box {
            /*display: inline-block;*/
            width: 56%;
            background-color: white;
            height: 100%;
        }

        .box .page-header {
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .box .page-header img {
            height: 5.3125rem;
            /* 85/16=5.3125 */
            width: 5.3125rem;
            border-radius: 50%;
            text-align: center;
            margin: 0 auto;
        }

        .box .page-header .uid {
            margin: 1.4375rem auto 1.21875rem;
            /* 23/16=1.4375   19.5/16=1.21875 */
            text-align: center;
            font-size: 0.9375rem;
            /* 15/16=0.9375 */
        }

        .box .page .page-sidebar ul li {
            padding: 0;
            font-size: 1.09375rem;
            /* 17/16=1.09375 */
            list-style: none;
            height: 2.9375rem;
            /* 47/16=2.9375 */
            /* padding-top: 0.90625rem; */
            /* padding-bottom: 0.9375rem; */
            /* 15/16=0.9375 */
            color: gray;
            display: list-item;
        }

        .box .page .page-sidebar ul li a {
            color: gray;
            display: block;
            height: 2.9375rem;
            line-height: 2.9375rem;
        }

        .box .page .page-sidebar .active {
            background-color: rgb(242, 247, 254);
        }

        .box .page .page-sidebar .active a {
            color: rgb(17, 107, 255);
            /* background-color: blue;*/
        }

        .box .page .page-region {
            margin-top: 7.03125rem;
            /* 112.5/16=7.03125 */
        }

        .btn-default {
            color: #666666;
            background-color: #adccff;
            border: none;
        }

        .btn {
            font-size: 1.1875rem;
            padding: 0.625rem auto;
            border-radius: 0.3125rem;
            width: 37%;
            box-sizing: border-box;
        }

        .logo {
            display: inline-block;
            margin: 1.875rem auto; 
            /* 30/16=1.875 */
            height: 6.25rem;
            /* 100/16=6.25 */
            width: 6.25rem;
            border: 1px solid rgb(66, 133, 244);
        }
</style>