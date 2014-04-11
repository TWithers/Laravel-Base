var usersApp = angular.module('usersApp', [
  'ngRoute',
  'ngResource',
  'ngCsv',
  'usersServices',
  'usersControllers',
  'angular-table'
]);
 
usersApp.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
    when('/', {
      templateUrl: '../assets/partials/users/list.html',
      controller: 'UserListController'
    }).
    when('/view/:hash',{
      templateUrl: '../assets/partials/users/list.html',
      controller: 'UserListController'
    });
      
}]);