var usersControllers = angular.module('usersControllers',[]);
usersControllers.controller('UserListController',['$scope','User','$filter','$http','$routeParams',function($scope,User,$filter,$http,$routeParams){
	$scope.users=User.query(function(data){
		$scope.filteredUsers=data;
		if(angular.isDefined($routeParams.hash)&&getByHash($routeParams.hash)!==false){
			$scope.viewUser(data[getByHash($routeParams.hash)]);
		}
	});
	$scope.filteredUsers=[];
	$scope.perPage=15;
	$scope.config = {
		itemsPerPage: $scope.perPage,
		maxPages: 5,
		fillLastPage: "yes"
	};
	var blankUser={
		username:'',
		email:'',
		password:'',
		password_confirmation:'',
		id_hash:'',
		action:'create', 
		visible:false
	};
	$scope.logger=function(a,b,c){
		//$scope.userModel.company_id=a.id_hash;
	}
	$scope.updateUserFilter=function(){
		$scope.filteredUsers=$filter("filter")($scope.users,$scope.userFilter);
	};
	$scope.getCSV=function(){
		var r=[];
		$scope.filteredUsers.forEach(function(val){
			r.push([val.last_name,val.first_name,val.email]);
		});
		return r;
	};
	$scope.newUser=function(){
		$scope.userModel=angular.copy(blankUser);
		$scope.userModel.visible=true;
		$scope.userForm.$setPristine();
		$scope.validationError=false;
	};
	$scope.viewUser=function(c){
		$scope.userModel=angular.copy(c);
		$scope.userModel.action='read';
		$scope.userModel.visible=true;
		$scope.userForm.$setPristine();
		$scope.validationError=false;
	};
	$scope.getDate=function(d){
		return new Date(d);
	};
	$scope.deleteUser=function(){
		if(!confirm('Are you sure you want to delete this user?')){
			return false;
		}
		User.delete({userHash:$scope.userModel.id_hash});
		$scope.users.splice(getByHash($scope.userModel.id_hash),1);
		$scope.userModel.visible=false;
		$scope.updateUserFilter();
	};
	$scope.saveUser=function(){
		if($scope.userModel.action=='update'){
			User.put({userHash:$scope.userModel.id_hash},$scope.userModel,function(data){
				$scope.users[getByHash(data.id_hash)]=angular.copy(data);
				userSaveSuccess(data);
			},userSaveError);
		}else{
			User.save($scope.userModel,function(data){
				$scope.users.push(data);
				userSaveSuccess(data);
			},userSaveError);
		}
	};
	$scope.cancelUser=function(){
		if($scope.userModel.action=='update'&&$scope.userForm.$pristine){
			$scope.userModel.action='read';
		}else{
			$scope.userModel.visible=false;
		}
	}
	var userSaveSuccess=function(data){
		$scope.userModel=angular.copy(data);
		$scope.userModel.action='read';
		$scope.userModel.visible=true;
		$scope.userForm.$setPristine();
		$scope.updateUserFilter();
		$scope.validationError=false;
	};
	var userSaveError=function(data){
		$scope.validationError=true;
		$scope.errors=[];
		angular.forEach(data.data,function(val){
			this.push(val);
		},$scope.errors);
		$scope.errors=$scope.errors.join(' ');
	};
	var getByHash=function(hash,context){
		context=context||$scope.users;
		for(var i=0;i<context.length;i++){
			if(context[i].id_hash==hash){
				return i;
			}
		}
		return false;
	};
}]);