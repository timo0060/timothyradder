(function(){
    'use strict';
    
    angular.module('portfolio').controller('LoginController', function($scope, $log, $http, $cookies, Flash){
        
        $scope.submitForm = function(){
            var data = {
                user: $scope.user,
                password: $scope.password
            }
            
            $http.post('http://server.timothyradder:443/api/login', data).success(function (data, status) {
               
           }).error(function (error) {
               
           });
        };
        
    });
    
}())