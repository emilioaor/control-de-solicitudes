angular.module("app",["ngRoute"])
    .config(function ($routeProvider,$http) {
        $routeProvider
            .when("/",{
                controller: "loginController",
                templateUrl: function ($http) {
                    $http.get("/rest",
                        function (data) {
                            console.log(data);
                        },
                        function (error) {

                        }
                    );
                }
            })
    })
    .controller("loginController",["scope","http",function ($scope,$http) {
        console.log();
    }])
;