
/* 自动聚焦指令autofocus */
app.directive('autoFocus',[function(){
    return {
        restrict:'A',
        link:function($scope,$ele){
            $ele.focus();
        }
    }
}]);
/* 登录 */
app.config(function ($httpProvider) {  //实现$http模块POST请求request payload转form data
    $httpProvider.defaults.transformRequest = function (obj) {
        var str = [];
        for (var p in obj) {
            str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
        }
        return str.join("&");
    }
    $httpProvider.defaults.headers.post = {
        'Content-Type': 'application/x-www-form-urlencoded'
    }
});
app.controller('loginCtl', ['$scope', '$rootScope', '$http', '$state', function ($s, $rootScope, $http, $state) {
    $rootScope.username = '';
    $s.password = '';
    $s.tishiyu = '';
    $s.isShowTishi = false;
    $s.login = function () {
        let data = { 'username': $rootScope.username, 'password': $s.password }
        $http.post('http://localhost/backapi/login.php', data)
            .success(function (res) {
                if (res.code == 1) {
                    sessionStorage.setItem('myadmin', $rootScope.username);
                    $state.go("backend.home");
                } else {
                    $s.tishiyu = res.msg;
                    $s.isShowTishi = true;
                }
            })

    }
}])

/* header */
app.controller('appCtl', ['$scope', '$rootScope', '$http', '$state', function ($s, $rootScope, $http, $state) {
    $s.logout = function () {
        $rootScope.username='';
        $state.go("login");
    }
}])

/* home页面 */
app.controller('homeCtl', ['$scope', '$rootScope', '$http', '$state', function ($s, $rootScope, $http, $state) {
    
}])
