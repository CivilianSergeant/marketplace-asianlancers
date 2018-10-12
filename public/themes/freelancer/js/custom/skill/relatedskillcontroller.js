var relatedSkillApp = angular.module('relatedSkillApp',['ui.bootstrap','ui.select']);
relatedSkillApp.controller('relatedSkillAppController',['$scope','$http','$location','$anchorScroll',
    function($scope,$http,$location,$anchorScroll){

    	$scope.form = {
    		'category_name' : []
    	};
    	
    	
		$scope.rskills = rskills;
        $scope.tmp_skill_tag = [];
        $scope.skills = skills;

        $scope.multipleDemo = {};
        

        /*$scope.customSkillSelection = function($data){
            for (var i=0; i<$data.length; i++) {
                $scope.skills.push({"id":$data[i].id,"text":$data[i].category_name});
            }
       
        };
         $scope.customSkillSelection(skills);
        */

    	$scope.addSkill = function()
    	{

                $scope.form.category_name = $scope.multipleDemo;

			$scope.errorMsg = [];
			$scope.successMsg = [];

    		$http({
    			url : BASE + 'freelancer/add-skill',
    			method: 'POST',
    			data: $scope.form
    		}).success(function(response,status){


                for(r in response){
                    if(response[r].status == 200 && status == 200)
                    {
                        $scope.rskills.push(response[r].result);
                        $scope.successMsg.push(response[r].msg);
                        resetForm();
                    }else{

                        $scope.errorMsg.push(response[r].msg);

                    }
                   
                }
    		});
    	};

        /*$scope.multiSkillSelection = {
            'multiple': true,
            query: function (query) {
                query.callback({ results: $scope.skills });
            },
            initSelection: function(element, callback) {

            }
        };*/


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
    			'category_name': []
    		};
            $scope.multipleDemo = {};
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