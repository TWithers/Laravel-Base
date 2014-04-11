var contactsControllers = angular.module('contactsControllers',[]);
contactsControllers.controller('ContactListController',['$scope','Contact','Company','$filter','$http','$routeParams',function($scope,Contact,Company,$filter,$http,$routeParams){
	$scope.contacts=Contact.query(function(data){
		$scope.filteredContacts=data;
		if(angular.isDefined($routeParams.hash)&&getByHash($routeParams.hash)!==false){
			$scope.viewContact(data[getByHash($routeParams.hash)]);
		}
	});
	$scope.filteredContacts=[];
	$scope.perPage=15;
	$scope.config = {
		itemsPerPage: $scope.perPage,
		maxPages: 5,
		fillLastPage: "yes"
	};
	$scope.companies=Company.getLimited();

	var blankContact={
		first_name:'',
		last_name:'',
		email:'',
		phone:'',
		id_hash:'',
		company_id:null,
		action:'create', 
		visible:false
	};
	$scope.noteModel={
		visible:false,
		note:'',
		id_hash:null
	};
	$scope.logger=function(a,b,c){
		$scope.contactModel.company_id=a.id_hash;
	}
	$scope.addNote=function(){
		$scope.noteModel.visible=false;
		$scope.noteModel.id_hash=$scope.contactModel.id_hash;
		$http.post('/contactNote',$scope.noteModel).success(function(data){
			$scope.contactModel.contact_notes.push(data);
			$scope.contacts[getByHash($scope.noteModel.id_hash)].contact_notes.push(data);
			$scope.noteModel.note='';
		});
	};
	$scope.updateContactFilter=function(){
		$scope.filteredContacts=$filter("filter")($scope.contacts,$scope.contactFilter);
	};
	$scope.getCSV=function(){
		var r=[];
		$scope.filteredContacts.forEach(function(val){
			r.push([val.last_name,val.first_name,val.email]);
		});
		return r;
	};
	$scope.newContact=function(){
		$scope.contactModel=angular.copy(blankContact);
		$scope.contactModel.visible=true;
		$scope.contactForm.$setPristine();
		$scope.validationError=false;
	};
	$scope.viewContact=function(c){
		$scope.noteModel.visible=false;
		$scope.noteModel.note='';
		$scope.contactModel=angular.copy(c);
		if($scope.contactModel.company!==null){
			$scope.company=$scope.contactModel.company.name;
			$scope.contactModel.company_id=$scope.contactModel.company.id_hash;
		}
		$scope.contactModel.action='read';
		$scope.contactModel.visible=true;
		$scope.contactForm.$setPristine();
		$scope.validationError=false;
	};
	$scope.getDate=function(d){
		return new Date(d);
	};
	$scope.deleteContact=function(){
		if(!confirm('Are you sure you want to delete this contact?')){
			return false;
		}
		Contact.delete({contactHash:$scope.contactModel.id_hash});
		$scope.contacts.splice(getByHash($scope.contactModel.id_hash),1);
		$scope.contactModel.visible=false;
		$scope.updateContactFilter();
	};
	$scope.saveContact=function(){
		if($scope.contactModel.company_id!==null){
			var c=getByHash($scope.contactModel.company_id,$scope.companies);
			if(c===false||$scope.companies[c].name!=$scope.company){
				if($scope.company==''){
					$scope.contactModel.company_id=null;
				}else{
					return contactSaveError({data:['Company does not exist, please only select companies from the list']});
				}
			}
		}
		if($scope.contactModel.action=='update'){
			Contact.put({contactHash:$scope.contactModel.id_hash},$scope.contactModel,function(data){
				$scope.contacts[getByHash(data.id_hash)]=angular.copy(data);
				contactSaveSuccess(data);
			},contactSaveError);
		}else{
			Contact.save($scope.contactModel,function(data){
				$scope.contacts.push(data);
				contactSaveSuccess(data);
			},contactSaveError);
		}
	};
	$scope.cancelContact=function(){
		if($scope.contactModel.action=='update'&&$scope.contactForm.$pristine){
			$scope.contactModel.action='read';
		}else{
			$scope.contactModel.visible=false;
		}
	}
	var contactSaveSuccess=function(data){
		$scope.contactModel=angular.copy(data);
		$scope.contactModel.action='read';
		$scope.contactModel.visible=true;
		$scope.contactForm.$setPristine();
		$scope.updateContactFilter();
		$scope.validationError=false;
	};
	var contactSaveError=function(data){
		$scope.validationError=true;
		$scope.errors=[];
		angular.forEach(data.data,function(val){
			this.push(val);
		},$scope.errors);
		$scope.errors=$scope.errors.join(' ');
	};
	var getByHash=function(hash,context){
		context=context||$scope.contacts;
		for(var i=0;i<context.length;i++){
			if(context[i].id_hash==hash){
				return i;
			}
		}
		return false;
	};
}]);