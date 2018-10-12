var settingApp = angular.module('settingApp', ['ui.bootstrap']);
var requestPath = BASE + 'setting/';
settingApp.controller('settingController',['$scope','$http','$location','$anchorScroll',
    function($scope,$http,$location,$anchorScroll){
		$scope.form={};
		$scope.form._token = token;

        $scope.form.oldPassword = '';
        $scope.form.newPassword = '';
        $scope.form.confPassword = '';

        $scope.errorMsg = '';
        $scope.successMsg = '';


		$scope.changePassword = function(){


          //  console.log($scope.form);
            $http({
                url : requestPath+'change-password',
				method: "POST",
				data: $scope.form
            }).success(function(data,status){

                if((status == 200) && (data.status == 'Error'))
				{
                    $scope.errorMsg = data.message;
				}
                else if((status == 200) && (data.status == 'Success')){
                    $scope.successMsg = data.message;
                }else{
                    $scope.errorMsg = 'Password changing fail.';
				}

            });

            return false;
		};

		$scope.deleteSkill = function($index,$id){
			$scope.errorMsgList = '';
			$scope.successMsgList = '';
			
			if(confirm('Are you sure to delete this skill tag?'))
			{
				$http({
					url : requestPath + 'delete',
					method: "POST",
					data: {id:$id}
				}).success(function(data,status){
					if((status == 200) && (data.status == 200))
					{
						//window.location = data.url;
						$scope.successMsgList = data.msg;
						$scope.skills.splice($index,1);
						//console.log($scope.skills);
					}else{
						$scope.errorMsgList = data.msg;
						$location.hash('top');
						$anchorScroll();
					}
				});
			}			
		};

		$scope.updateDisplay =function($id,value){
			$scope.errorMsgList = '';
			$scope.successMsgList = '';
			
			$http({
				url : requestPath + 'update-display',
				method: "POST",
				data: {id:$id,value:value}
			}).success(function(data,status){
				if((status == 200) && (data.status == 200))
				{
					//window.location = data.url;
					$scope.successMsgList = data.msg;
					$scope.skills.filter(function(item){
						if(item.id==$id){
							item.display = value; 
						}
					});
				}else{
					$scope.errorMsgList = data.msg;

					$location.hash('top');
					$anchorScroll();

				}
			});
		};
		$scope.pageChanged = function() {
			if($scope.bigCurrentPage == "" || $scope.bigCurrentPage == undefined || $scope.bigCurrentPage < 0)
				$scope.bigCurrentPage=1;
			$scope.curPage     = ($scope.bigCurrentPage-1);
			$scope.startOffset = $scope.curPage * $scope.itemsPerPage;
			$scope.endOffset   =   ($scope.itemsPerPage * $scope.curPage)+$scope.itemsPerPage;
			$scope.skills   = $scope.massData.slice($scope.startOffset,$scope.endOffset);

		};
}]);

/* if you want to add custom directive
skillApp.directive('removeSkill',function(){
    return {
        link:function(scope,elt,attrs)
        {
            scope.remove = function(){
                console.log(elt.parent().parent().remove());
            };
        }
    }
});*/
