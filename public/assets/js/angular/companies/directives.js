var contactsDirectives=angular.module('contactsDirectives', []);
contactsDirectives.directive('datatable',function(){
    return {
        templateUrl:'../assets/partials/directives/datatable.html',
        scope:{
            data:'=datatable'
        },
        link:function(scope,ele){
            scope.table={
                data:scope.data.splice(0,15),
                limit:15,
                page:1,
                order:'+ last_name',
                filter:''
            };
            
        }

    };
});
