(function(){
    'use strict';
    
    angular.module('portfolio').config(function($stateProvider, $urlRouterProvider){
        $urlRouterProvider.otherwise('/resume');
        
        $stateProvider.state('resume', {
            url: '/resume',
            templateUrl: 'res/resume/p.resume.html'
        }).state('login', {
            url: '/login',
            templateUrl: 'res/login/p.login.html',
            controller: 'LoginController'
        });
    });
    
}())