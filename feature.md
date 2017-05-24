# 午安煎饼计划管理系统v1.0需求文档
午安煎饼计划管理系统（wuancake_console）主要用于对成员的管理、周报的提交和考勤、导师回复等功能。分为学员前台和导师后台两部分。
### 一、学员前台

1.注册

注册页面包含的表单内容有：邮箱、昵称、QQ号、午安网昵称、密码

2.登录

该系统需要登录方可使用，学员可使用自己的邮箱和密码进行登录

3.选择分组

注册成功后学员需加入分组方可进入主页，分组包含Web前端、PHP、UI设计、Android、产品经理、软件测试、JAVA中选一个
如学员长期不交周报被移出分组，则再次登录也会进入选择分组页面

4.主页

学员主页包含学员提交的所有周报和请假、缺勤，每页20条，同时有提交周报和请假按钮

5.提交周报

学员每周可提交一次周报，以每周一0点作为一周的起始点，提交周报后当周即不可再提交

周报内容分以下几部分：本周已经完成的内容、本周遇到的问题、下周的计划，另附一个选填项：作品链接

6.请假

学员无法回复周报可进行请假操作，请假周期可选择1周、2周、3周，同时需要填写请假理由

如该周处于请假状态，学员无法继续请假

如该周处于请假状态，学员仍可正常提交周报，同时请假状态取消

如果学员连续请假3周，则不可继续请假

7.考勤

每周一0点统计上一周所有成员的考勤数据，如果学员连续两周既没有提交周报也没有请假，自动取消分组权限

### 二、导师后台

1.创建账号

导师账号分三个用户组，最高管理员、管理员、导师

最高管理员在数据库手动设置，最高管理员可任命管理员，账号信息包含邮箱、昵称、密码

最高管理员和管理员可任命导师，账号信息包含邮箱、昵称、密码、分组

2.登录

导师后台同学员前台，采用邮箱和密码作为登录依据

3.考勤汇总

管理员及导师可在后台查看所有学员所有时间的考勤状态记录，包括已提交、请假、未提交三个状态

4.周报汇总

管理员及导师可在后台查看所有学员所有时间的周报列表

5.清理记录

管理员及导师可在后台查看系统自动清人的记录，记录包含清人时间、分组、昵称