var companiesServices = angular.module('companiesServices',[]);
companiesServices.factory('Company',['$resource',function($resource){
	return $resource('/company/:companyHash',{},{
		put:{
			method:'PUT'
		}
	});
}]);