var contactsServices = angular.module('contactsServices',[]);
contactsServices.factory('Contact',['$resource',function($resource){
	return $resource('/contact/:contactHash',{},{
		put:{
			method:'PUT'
		}
	});
}]);
contactsServices.factory('Company',['$resource',function($resource){
	return $resource('/company/:contactHash',{},{
		put:{
			method:'PUT'
		},
		getLimited:{
			method:'GET',
			isArray:true,
			params:{contactHash:null,limited:true}
		}

	});
}]);