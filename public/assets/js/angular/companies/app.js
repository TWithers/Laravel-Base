var companiesApp = angular.module('companiesApp', [
  'ngRoute',
  'ngResource',
  'ngCsv',
  'companiesServices',
  'companiesControllers',
  'angular-table'
]);
 
companiesApp.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
    when('/', {
      templateUrl: '../assets/partials/companies/list.html',
      controller: 'CompanyListController'
    }).
    when('/view/:hash',{
      templateUrl: '../assets/partials/companies/list.html',
      controller: 'CompanyListController'
    });
      
}]);