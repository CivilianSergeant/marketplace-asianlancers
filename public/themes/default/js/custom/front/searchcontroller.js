/**
 * Created by Himel on 8/24/14.
 */
var searchApp = angular.module('searchApp', ['ui.select2','ui.bootstrap']);
var requestSearchPath = BASE+'search/';


searchApp.controller('searchController',['$scope','$http','$location','$anchorScroll','$sce',
    function($scope,$http,$location,$anchorScroll,$sce){

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
        $scope.freelancers = [];
        $scope.selected_freelancers = [];
		$scope.job_category = {};
        $scope.tmp_freelancer_price={};
        $scope.tmp_skill_tag = [];
		
        $scope.form = {};
        $scope.form.freelancer_price=[];
        $scope.form.skill_tags_id=[];
        $scope.total_freelancer=0;
		$scope.form.selectFl = [];
        $scope.searchListFlag = 0;
        $scope.loadingFlag = 1;
        $scope.myHTML = "";
        $scope.freelancerHTML = "";


        $scope.massData = [];


        $scope.init=function(){
            var mySelectionStatus = statusHtmlStorage('mySelection');
            if(mySelectionStatus){
                var data = JSON.parse(localStorage.getItem('mySelection'));
//                console.log(data);
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
//            console.log($scope.form);
            //console.log(data[0]['price_value']);
            //removeHtmlStorage('mySelection');
            $scope.readListOfFreelancer();
        };

        $scope.readListOfFreelancer = function(){

            $http({
                url : requestSearchPath + 'new-freelancers-list',
                method: "POST",
                data: $scope.form
            }).success(function(data,status){
                //console.log(data);
                //console.log(status);
                if((status == 200) && (data.status == 200))
                {
                    $scope.searchListFlag = 1;
                    $scope.loadingFlag = 0;
                    $scope.successMsg = data.msg;
                    $scope.freelancers = data.freelancersList;
//                    $scope.massData = data.freelancersList;
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
            $scope.errorMsg=[];
            $scope.selected_freelancers =[];
            $scope.form.selectFl =[];

            for(var i=0;i<fl_key.length;i++){
                $scope.selected_freelancers.push($scope.freelancers[fl_key[i]]);
                $scope.form.selectFl.push($scope.freelancers[fl_key[i]].fid);
            }
            $scope.form.freelancer_price = [];
            for(i=0;i<$scope.tmp_freelancer_price.length;i++){
                $scope.form.freelancer_price.push($scope.tmp_freelancer_price[i].text);
            }
            $scope.form.skill_tags_id = [];
            for(i=0;i<$scope.tmp_skill_tag.length;i++){
                $scope.form.skill_tags_id.push($scope.tmp_skill_tag[i].id);
            }

            var data = JSON.parse(localStorage.getItem('mySelection'));
            data = [{
                        "category_value":data[0]['category_value'],
                        "price_value":$scope.tmp_freelancer_price,
                        "skills_value":$scope.tmp_skill_tag,
                        "form_data":$scope.form,
                        "select_freelancers":$scope.selected_freelancers,
                        "select_fl_key":fl_key
                    }];

//            console.log(fl_key);
//            console.log(data);
//            return false;

            setHtmlStorage('mySelection', JSON.stringify(data), 24*3600);
//            if($scope.form.selectFl.length>0){
                $http({
                    url : BASE + 'home/set-page-flag',
                    method: "POST",
                    data: {page_name:'search'}
                }).success(function(data,status){
                    if((status == 200) && (data.status == 200))
                    {
                        window.location = BASE+'jobPost/create-job';

                    }
                });

//            }
//            else{
//                $scope.errorMsg.push('Please select at least one freelancer.');
//            }/
            //console.log(data);
			return false;
		};

        $scope.searchFreelancers = function(){
            //console.log($scope.form);
            //console.log($scope.tmp_freelancer_price.length);
            //console.log($scope.tmp_skill_tag.length);
            $scope.searchListFlag = 0;
            $scope.loadingFlag =1;
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

        $scope.formatDate = function($index){
            //console.log($data);
            var input = $scope.freelancers[$index].last_login;
            var newDate = input.replace(/(.+) (.+)/, "$1T$2Z");
            //var today = $filter('date')(new Date(newDate),'yyyy-MM-dd HH:mm:ss Z');
            //console.log(today);
            return newDate;
        };


        $scope.givenTesCount=function($index){
            var count = 0;
            for (var i = 0; i < $scope.freelancers[$index].skills.length; i++) {
                if($scope.freelancers[$index].skills[i].test_taken==1 && $scope.freelancers[$index].skills[i].score!=null)
                    count++;
            }
            return count;
        };

        $scope.checkPhotos = function($index){
            if($scope.freelancers[$index].photos=='' || $scope.freelancers[$index].photos==null){

                return true;
            }
            return false;
        };

        $scope.feedBackPrint = function(html,$index){
            var new_html = "";
            for(var i=1; i<=5; i++){
                if(i <= $scope.freelancers[$index].total_feedback)
                    new_html +='<span class="star"></span>';
                else
                    new_html +='<span class="star2"></span>';

            }
            if($scope.freelancers[$index].total_feedback!=undefined)
                new_html +='&nbsp;<b>'+$scope.freelancers[$index].total_feedback+'</b>';
            else
                new_html +='&nbsp;<b>0</b>';
            return $sce.trustAsHtml(new_html);
        };

        $scope.searchFreelancers();

}]);
searchApp.filter('dateFormat', function($filter)
{
    return function(input)
    {
        if(input == null){ return ""; }

        var _date = $filter('date')(new Date(input), 'MMM dd yyyy');

        return _date.toUpperCase();

    };
});










