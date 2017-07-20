import Vue from 'vue'
import Router from 'vue-router'
import Hello from '@/components/Hello'
import elHeader from '@/components/elHeader'
import Login from '@/components/Login'
import Signup from '@/components/Signup'
import ChangePassWord from '@/components/ChangePassWord'
import SideBar from '@/components/SideBar'
import WriteWeekly from '@/components/WriteWeekly'
import MyWeekly from '@/components/MyWeekly'
import Leave from '@/components/Leave'
import HomePage from '@/components/HomePage'
import submitted from '@/components/submitted'
import askLeaveSuccess from '@/components/askLeaveSuccess'

Vue.use(Router)

export default new Router({
  routes: [
    {
    	path: '/',
    	components: {
        default: Hello,
        headerBox: elHeader,
        contentsBox: HomePage
      }
    },
    {
      path: '/Login',
      components: {
        default: Hello,
        headerBox: elHeader,
        contentsBox: Login
      }
    },
    {
      path: '/user/:id/PassWord/:password',
      components: {
        default: Hello,
        headerBox: elHeader,
        contentsBox: HomePage
      }
    },
    {
      path: '/writeWeekly',
      components: {
        default: Hello,
        headerBox: elHeader,
        contentsBox: WriteWeekly
      }
    },
    {
      path: '/myWeekly',
      components: {
        default: Hello,
        headerBox: elHeader,
        contentsBox: MyWeekly
      }
    },
    {
      path: '/Leave',
      components: {
        default: Hello,
        headerBox: elHeader,
        contentsBox: Leave
      }
    },
    {
      path: '/ChangePassWord',
      components: {
        default: Hello,
        headerBox: elHeader,
        contentsBox: ChangePassWord
      }
    },
    {
      path: '/Signup',
      components: {
        default: Hello,
        headerBox: elHeader,
        contentsBox: Signup
      }
    },
    {
      path: '/SideBar',
      components: {
        default: Hello,
        headerBox: elHeader,
        contentsBox: SideBar
      }
    },
    {
    	path: '/submitted',
    	components: {
        default: Hello,
        headerBox: elHeader,
        contentsBox: submitted
      }
    },
    {
    	path: '/askLeaveSuccess',
    	components: {
        default: Hello,
        headerBox: elHeader,
        contentsBox: askLeaveSuccess
      }
    }
  ]
})
