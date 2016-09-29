(function(){
    'use strict';
    
    angular.module('portfolio').controller('LoginController', function($scope, $log, $http, $cookies, Flash){
        
        $scope.submitForm = function(){
            var data = {
                user: $scope.user,
                password: $scope.password
            }
            
            
        };
        
    });
    
}())