/**
 * Created by Himel on 8/24/14.
 */
var jobCategoryApp = angular.module('jobCategoryApp', ['ui.bootstrap']);
var requestPath = BASE + 'jobCategory/';
jobCategoryApp.controller('jobCategoryController',['$scope','$http','$location','$anchorScroll',
    function($scope,$http,$location,$anchorScroll){

    $scope.form={};
    $scope.form._token = token;
	$scope.massData = job_categories;

    $scope.currentPage = 1;
    $scope.maxSize = 5;
    $scope.itemsPerPage = 10;
    $scope.bigTotalItems = $scope.massData.length;
    $scope.bigCurrentPage = 1;
    $scope.job_categories = $scope.massData.slice(0,$scope.itemsPerPage);


    $scope.curPage = 0;
    $scope.startOffset = 0;
    $scope.endOffset = 0;
		
    //$scope.job_categories = job_categories;
	$scope.tmp_value={};


    $scope.addJobCategory = function(){
        $scope.errorMsg = '';
		$scope.successMsg = '';
        $http({
            url : requestPath+'add',
            method: "POST",
            data: $scope.form
        }).success(function(data,status){
            //console.log(data);
            //console.log(status);

            if((status == 200) && (data.status == 200))
            {
                //window.location = data.url;
                $scope.successMsg = data.msg;
				$scope.form={};
                //$location.hash('top');
                //$anchorScroll();
                $scope.job_categories.push(data.newData);
            }else{
                $scope.errorMsg = data.msg;

                $location.hash('top');
                $anchorScroll();

            }
        });

        return false;
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
				$scope.job_categories.filter(function(item){
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
	$scope.deleteJobCategory =function($index,$id){
		$scope.errorMsgList = '';
		$scope.successMsgList = '';
		
		if(confirm('Are you sure to delete job category?'))
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
					$scope.job_categories.splice($index,1);
					//console.log($scope.job_categories);
				}else{
					$scope.errorMsgList = data.msg;

					$location.hash('top');
					$anchorScroll();

				}
			});
		}
    };
	
	$scope.pageChanged = function() {
        if($scope.bigCurrentPage == "" || $scope.bigCurrentPage == undefined || $scope.bigCurrentPage < 0)
            $scope.bigCurrentPage=1;
        $scope.curPage     = ($scope.bigCurrentPage-1);
        $scope.startOffset = $scope.curPage * $scope.itemsPerPage;
        $scope.endOffset   =   ($scope.itemsPerPage * $scope.curPage)+$scope.itemsPerPage;
        $scope.job_categories   = $scope.massData.slice($scope.startOffset,$scope.endOffset);

    };
}]);







