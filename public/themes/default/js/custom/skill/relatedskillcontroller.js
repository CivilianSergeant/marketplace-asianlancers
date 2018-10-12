var relatedSkillApp = angular.module('relatedSkillApp',['ui.bootstrap']);
relatedSkillApp.controller('relatedSkillAppController',['$scope','$http','$location','$anchorScroll',
    function($scope,$http,$location,$anchorScroll){

    	$scope.form = {
    		'category_name' : ''
    	};
    	
    	$scope.skills = skills;
		$scope.rskills = rskills;


    	$scope.addSkill = function()
    	{
    		
			$scope.errorMsg = '';
			$scope.successMsg = '';
    		$http({
    			url : BASE + 'freelancer/add-skill',
    			method: 'POST',
    			data: $scope.form
    		}).success(function(response,status){

                if(response.status == 200 && status == 200)
                {

                    $scope.rskills.push(response.result);
                    resetForm();
                }else{
                    $scope.errorMsg = response.msg;
                }


    		});
    	};

        $scope.remove = function(index,id)
        {

        };

        $scope.getNextTime = function(r)
        {
           var oneDay = (60*60*24);
           var nextExam = 30;
           return  parseInt(r)+(oneDay*nextExam);

        }

        $scope.getResultLink = function(rskillid)
        {
            $http({
                url : BASE+'exam/get-result-link',
                method : "POST",
                data: {id:rskillid}
            }).success(function(data,status){
                window.location = BASE+'exam/result/'+data;
            });
        }



    	function resetForm()
    	{
    		$scope.form = {
    			'category_name': ''
    		}
    	};


        $scope.updateDisplay =function($id,value){
            $scope.errorMsgList = '';
            $scope.successMsgList = '';

            $http({
                url : BASE + 'freelancer/update-skill-display',
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

        $scope.deleteSkill = function(index,id)
        {

            if(confirm('Are you sure to delete this skill ?'))
            {

                $scope.rskills.splice(index,1);
                $http({
                    url : BASE + 'freelancer/remove-skill',
                    method: "POST",
                    data: {id:id}
                }).success(function(){

                });
            }

        }
}]);