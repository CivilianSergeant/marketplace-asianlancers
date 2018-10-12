var jobViewApp = angular.module('jobViewApp',['ui.bootstrap']);
var requestPath = BASE+'view/'


jobViewApp.filter('dateFormat', function($filter){
    return function(input)
    {
        if(input == null){ return ""; }

        var _date = $filter('date')(new Date(input), 'MMM dd yyyy');

        return _date.toUpperCase();

    };
});


/*-----------------------------------------------Start View job ------------------------------------------------------*/

jobViewApp.controller('jobViewController',['$scope','$http','$location','$anchorScroll','$sce',
    function($scope,$http,$location,$anchorScroll,$sce){
        $scope.job_post = job_post;

        $scope.job_post.balance_hour = $scope.job_post.hour;
        $scope.select_skills = select_skills;
        $scope.clients = clients;
        $scope.skills = skills;
        $scope.job_prices = job_prices;
        $scope.jobPhaseFormFlag = 0;
        $scope.authenticateUserInfo = authenticateUserInfo;

		$scope.form={};
        $scope.form.jobOfferComment={};
        $scope.form.jobOfferStatus={};


		$scope.formatDate = function($data){

            var input = $data;
            var newDate = input.replace(/(.+) (.+)/, "$1T$2Z");

            return newDate;
        };

        $scope.open = function($event) {
            $event.preventDefault();
            $event.stopPropagation();

            $scope.opened = true;
        };
			

        $scope.fileLength = function(){
            console.log($scope.job_post.attach_file.length);
        };

        $scope.givenTesCount=function($index){
            var count = 0;
            for (var i = 0; i < $scope.job_post.job_offer[$index].freelancer.skills.length; i++) {
                if($scope.job_post.job_offer[$index].freelancer.skills[i].test_taken==1 && $scope.job_post.job_offer[$index].freelancer.skills[i].score!=null)
                    count++;
            }
            return count;
        };


        $scope.toggleMin = function() {
            $scope.minDate = $scope.minDate ? null : new Date();
        };
        $scope.toggleMin();

        $scope.phaseStatus = function(jo_index,jo_ph_index,ph_status){
            $scope.errorMsg = '';
            $http({
                url : BASE+'freelancer/phase-status',
                method: "POST",
                data: {id:$scope.job_post.job_offer[jo_index].job_phase[jo_ph_index].id,phase_payment_status:ph_status}
            }).success(function(data,status){

                if((status == 200) && (data.status == 200))
                {
                    window.location=window.location.href;
                }else{
                    $scope.errorMsg = data.msg;

                    $location.hash('top');
                    $anchorScroll();

                }
            });

            return false;
        };
        $scope.checkPermission=function(index_jo){
            if($scope.authenticateUserInfo.user_type=="Client"){
                if($scope.job_post.job_offer[index_jo].job_offer_status=='Canceled' || $scope.job_post.job_offer[index_jo].job_offer_status=='Declined'){
                    return false
                }else
                    return true;
            }
            else
                return true;
        };

        $scope.addJobOfferComment =function(jo_index){
            $scope.form.jobOfferComment.jobthread_id = $scope.job_post.job_offer[jo_index].id;
            $scope.form.jobOfferComment.jobthread_type = 'JobOffer';
            $http({
                url : BASE+'freelancer/add-comment',
                method: "POST",
                data: $scope.form.jobOfferComment
            }).success(function(data,status){

                if((status == 200) && (data.status == 200))
                {
                    $scope.job_post.job_offer[jo_index].comments.push(data.newData);
                    $scope.form.jobOfferComment = {};
                }else{
                    $scope.errorMsg = data.msg;

                    $location.hash('middle');
                    $anchorScroll();

                }
            });

            return false;
        };


}]);

/*-----------------------------------------------End View job ------------------------------------------------------*/

jobViewApp.directive("timeAgo", function($compile) {
    return {
        restrict: "C",
        link: function(scope, element, attrs) {
            jQuery(element).timeago();
        }
    };
});

jobViewApp.filter("timeAgo", function() {
    return function(date) {
        return jQuery.timeago(date);
    };
});