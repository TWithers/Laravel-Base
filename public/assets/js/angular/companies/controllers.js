var companiesControllers = angular.module('companiesControllers',[]);
companiesControllers.controller('CompanyListController',['$scope','Company','$filter','$http','$routeParams',function($scope,Company,$filter,$http,$routeParams){
	$scope.companies=Company.query(function(data){
		$scope.filteredCompanies=data;
		if(angular.isDefined($routeParams.hash)&&getByHash($routeParams.hash)!==false){
			$scope.viewCompany(data[getByHash($routeParams.hash)]);
		}
	});
	$scope.filteredCompanies=[];
	$scope.perPage=15;
	$scope.config = {
		itemsPerPage: $scope.perPage,
		maxPages: 5,
		fillLastPage: "yes"
	};
	var blankCompany={
		name:'',
		address1:'',
		address2:'',
		city:'',
		state:'',
		zip:'',
		country:'USA',
		id_hash:'',
		action:'create',
		visible:false
	};
	$scope.noteModel={
		visible:false,
		note:'',
		id_hash:null
	};
	$scope.addNote=function(){
		$scope.noteModel.visible=false;
		$scope.noteModel.id_hash=$scope.companyModel.id_hash;
		$http.post('/companyNote',$scope.noteModel).success(function(data){
			$scope.companyModel.company_notes.push(data);
			$scope.companies[getByHash($scope.noteModel.id_hash)].company_notes.push(data);
			$scope.noteModel.note='';
		});
	};
	$scope.updateCompanyFilter=function(){
		$scope.filteredCompanies=$filter("filter")($scope.companies,$scope.companyFilter);
	};
	$scope.getCSV=function(){
		var r=[];
		$scope.filteredCompanies.forEach(function(val){
			r.push([val.name,val.address1,val.address2,val.city,val.state,val.zip,val.country]);
		});
		return r;
	};
	$scope.newCompany=function(){
		$scope.companyModel=angular.copy(blankCompany);
		$scope.companyModel.visible=true;
		$scope.companyForm.$setPristine();
		$scope.validationError=false;
	};
	$scope.viewCompany=function(c){
		$scope.noteModel.visible=false;
		$scope.noteModel.note='';
		$scope.companyModel=angular.copy(c);
		$scope.companyModel.action='read';
		$scope.companyModel.visible=true;
		$scope.companyForm.$setPristine();
		$scope.validationError=false;
	};
	$scope.getDate=function(d){
		return new Date(d);
	};
	$scope.deleteCompany=function(){
		if(!confirm('Are you sure you want to delete this company?')){
			return false;
		}
		Company.delete({companyHash:$scope.companyModel.id_hash});
		$scope.companies.splice(getByHash($scope.companyModel.id_hash),1);
		$scope.companyModel.visible=false;
		$scope.updateCompanyFilter();
	};
	$scope.saveCompany=function(){
		if($scope.companyModel.action=='update'){
			Company.put({companyHash:$scope.companyModel.id_hash},$scope.companyModel,function(data){
				$scope.companies[getByHash(data.id_hash)]=angular.copy(data);
				companySaveSuccess(data);
			},companySaveError);
		}else{
			Company.save($scope.companyModel,function(data){
				$scope.companies.push(data);
				companySaveSuccess(data);
			},companySaveError);
		}
	};
	$scope.cancelCompany=function(){
		if($scope.companyModel.action=='update'&&$scope.companyForm.$pristine){
			$scope.companyModel.action='read';
		}else{
			$scope.companyModel.visible=false;
		}
	}
	var companySaveSuccess=function(data){
		$scope.companyModel=angular.copy(data);
		$scope.companyModel.action='read';
		$scope.companyModel.visible=true;
		$scope.companyForm.$setPristine();
		$scope.updateCompanyFilter();
		$scope.validationError=false;
	};
	var companySaveError=function(data){
		$scope.validationError=true;
		$scope.errors=[];
		angular.forEach(data.data,function(val){
			this.push(val);
		},$scope.errors);
		$scope.errors=$scope.errors.join(' ');
	};
	var getByHash=function(hash,context){
		context=context||$scope.companies;
		for(var i=0;i<context.length;i++){
			if(context[i].id_hash==hash){
				return i;
			}
		}
		return false;
	};
}]);