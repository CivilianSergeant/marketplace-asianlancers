/**
 * Created by Himel on 8/24/14.
 */
var searchApp = angular.module('searchApp', ['ui.select2']);
var requestPath = BASE+'search/';


searchApp.controller('searchController',['$scope','$http','$location','$anchorScroll',
    function($scope,$http,$location,$anchorScroll){

        $scope.skills = [];
        $scope.customSkillSelection = function($data){
            for (var i=0; i<$data.length; i++) {
                $scope.skills.push({"id":$data[i].id,"text":$data[i].category_name});
            }
        };
        $scope.job_prices = [];
        $scope.customPriceSelection = function($data){
            for (var i=0; i<$data.length; i++) {
                $scope.job_prices.push({"id":$data[i].id,"text":$data[i].title});
            }
        };

        $scope.job_categories = job_categories;
        $scope.customSkillSelection(skills);
        $scope.customPriceSelection(job_prices);
        //$scope.job_prices = job_prices;
        //$scope.skills = skills;
        $scope.freelancers = {};
        $scope.selected_freelancers = [];
		$scope.job_category = {};
        $scope.tmp_freelancer_price={};
        $scope.tmp_skill_tag = [];
		
        $scope.form = {};
        $scope.form.freelancer_price=[];
        $scope.form.skill_tags_id=[];
        $scope.total_freelancer=0;
		$scope.form.selectFl = [];


        $scope.init=function(){
            var mySelectionStatus = statusHtmlStorage('mySelection');
            if(mySelectionStatus){
                var data = JSON.parse(localStorage.getItem('mySelection'));
                console.log(data);
                if(data[0]['price_value']!=undefined){
                    $scope.tmp_freelancer_price=data[0]['price_value'];
                }
                if(data[0]['skills_value']!=undefined){
                    $scope.tmp_skill_tag=data[0]['skills_value'];
                }
                if(data[0]['form_data']!=undefined){
                    $scope.form=data[0]['form_data'];
                }
                if(data[0]['category_value']!=undefined){
                    $scope.job_category=data[0]['category_value'];
                }
                if(data[0]['select_freelancers']!=undefined){
                    $scope.selected_freelancers = data[0]['select_freelancers'];
                }
            }
            console.log($scope.form);
            //console.log(data[0]['price_value']);
            //removeHtmlStorage('mySelection');
            $scope.readListOfFreelancer();
        };

        $scope.readListOfFreelancer = function(){
            console.log($scope.form);
            $http({
                url : requestPath + 'freelancers-list',
                method: "POST",
                data: $scope.form
            }).success(function(data,status){
                //console.log(data);
                //console.log(status);
                if((status == 200) && (data.status == 200))
                {
                    $scope.successMsg = data.msg;
                    $scope.freelancers = data.freelancersList;
                    $scope.total_freelancer = data.totalFreelancers;

                }else{
                    $scope.errorMsg = data.msg;

                    $location.hash('top');
                    $anchorScroll();

                }
            });
        };
		
		// toggle selection for a given employee by name
		$scope.toggleSelection = function toggleSelection(code,$index) {
			var idx = $scope.form.selectFl.indexOf(code);

			// is currently selected
			if (idx > -1) {
			    $scope.form.selectFl.splice(idx, 1);
                $scope.selected_freelancers.splice(idx, 1);
			}

			// is newly selected
			else {
			    $scope.form.selectFl.push(code);
                $scope.selected_freelancers.push($scope.freelancers[$index]);
			}
		};
		
		$scope.goToJobPost = function(){
			//console.log($scope.form);
            var data = JSON.parse(localStorage.getItem('mySelection'));
            data = [{
                        "category_value":data[0]['category_value'],
                        "price_value":$scope.tmp_freelancer_price,
                        "skills_value":$scope.tmp_skill_tag,
                        "form_data":$scope.form,
                        "select_freelancers":$scope.selected_freelancers
                    }];
            setHtmlStorage('mySelection', JSON.stringify(data), 24*3600);
            window.location = BASE+'jobPost/create-job';
            //console.log(data);
			return false;
		};

        $scope.searchFreelancers = function(){
            //console.log($scope.form);
            //console.log($scope.tmp_freelancer_price.length);
            //console.log($scope.tmp_skill_tag.length);
            $scope.form.skill_tags_id = [];
            $scope.form.freelancer_price = [];

            if($scope.tmp_freelancer_price.length>0){
                for (var i = 0; i < $scope.tmp_freelancer_price.length; i++) {
                    //console.log($scope.tmp_freelancer_price[i]);
                    if($scope.tmp_freelancer_price[i]['text']!=undefined)
                        $scope.form.freelancer_price.push($scope.tmp_freelancer_price[i]['text']);
                }
            }

            if($scope.tmp_skill_tag.length>0){
                for (var i = 0; i < $scope.tmp_skill_tag.length; i++) {
                    if($scope.tmp_skill_tag[i]['id']!=undefined)
                        $scope.form.skill_tags_id.push($scope.tmp_skill_tag[i]['id']);
                }
            }
            $scope.readListOfFreelancer();
            //console.log($scope.form);
        };

        $scope.multiSkillSelection = {
            'multiple': true,
            query: function (query) {
                query.callback({ results: $scope.skills });
            },
            initSelection: function(element, callback) {

            }
        };

        $scope.multiPriceSelection = {
            'multiple': true,
            query: function (query) {
                query.callback({ results: $scope.job_prices });
            },
            initSelection: function(element, callback) {

            }
        };
}]);











