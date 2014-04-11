var usersServices = angular.module('usersServices',[]);
usersServices.factory('User',['$resource',function($resource){
	return $resource('/user/:userHash',{},{
		put:{
			method:'PUT'
		}
	});
}]);