
// 默认跳转到
app.config(function($urlRouterProvider){
    $urlRouterProvider.otherwise('/backend/login');
}); 
//url不区分大小写
app.config(function($urlMatcherFactoryProvider){
    $urlMatcherFactoryProvider.caseInsensitive(false);
  });  

//路由设置
app.config(['$stateProvider',function($stateProvider){
    $stateProvider.
    state('backend',{
        url:'/backend',
        templateUrl:'../template/app.html',
        controller:'appCtl'
    }).
    state('login',{
        url:'/backend/login',
        templateUrl:'../template/login.html',
        controller:'loginCtl'
    }).
    state('404',{
        url:'/404',
        templateUrl:'../template/404.html'
    }).
    state('backend.home',{
        url:'/home',
        templateUrl:'../template/home.html',
        controller:'homeCtl'
    }).
    state('backend.users',{
        url:'/users',
        templateUrl:'../template/users.html',
        controller:'usersCtl'
    }).
    state('backend.experience',{
        url:'/experience',
        templateUrl:'../template/experience.html',
        controller:'experienceCtl'
    }).
    state('backend.comments',{
        url:'/comments',
        templateUrl:'../template/comments.html',
        controller:'commentsCtl'
    }).
    state('backend.leaveMsg',{
        url:'/leaveMsg',
        templateUrl:'../template/leaveMsg.html',
        controller:'leaveMsgCtl'
    }).
    state('/backend',{
        redirectTo:'/login'
    });
// 试一下view{}
}]);