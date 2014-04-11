var contactsApp = angular.module('contactsApp', [
  'ngRoute',
  'ngResource',
  'ngCsv',
  'contactsServices',
  'contactsControllers',
  'ui.bootstrap.typeahead',
  'angular-table'
]);
 
contactsApp.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
    when('/', {
      templateUrl: '../assets/partials/contacts/list.html',
      controller: 'ContactListController'
    }).
    when('/view/:hash',{
      templateUrl: '../assets/partials/contacts/list.html',
      controller: 'ContactListController'
    });
      
}]);