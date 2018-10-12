/**
 * Created by User on 9/20/14.
 */
var jobSearchApp = angular.module('jobSearchApp',['ui.bootstrap']);


jobSearchApp.filter('dateFormat', function($filter){
    return function(input)
    {
        if(input == null){ return ""; }

        var _date = $filter('date')(new Date(input), 'MMM dd yyyy');

        return _date.toUpperCase();

    };
});


jobSearchApp.directive("timeAgo", function($compile) {
    return {
        restrict: "C",
        link: function(scope, element, attrs) {
            jQuery(element).timeago();
        }
    };
});

jobSearchApp.filter("timeAgo", function() {
    return function(date) {
        return jQuery.timeago(date);
    };
});

jobSearchApp.controller('jobSearchController',['$scope','$http',function($scope,$http){

    $scope.massData = jobs;



    $scope.currentPage = 1;
    $scope.maxSize = 5;
    $scope.itemsPerPage = 10;
    $scope.bigTotalItems = $scope.massData.length;
    $scope.bigCurrentPage = 1;
    $scope.jobs = $scope.massData.slice(0,$scope.itemsPerPage);


    $scope.curPage = 0;
    $scope.startOffset = 0;
    $scope.endOffset = 0;

    $scope.pageChanged = function() {
        if($scope.bigCurrentPage == "" || $scope.bigCurrentPage == undefined || $scope.bigCurrentPage < 0)
            $scope.bigCurrentPage=1;
        $scope.curPage     = ($scope.bigCurrentPage-1);
        $scope.startOffset = $scope.curPage * $scope.itemsPerPage;
        $scope.endOffset   =   ($scope.itemsPerPage * $scope.curPage)+$scope.itemsPerPage;
        $scope.jobs   = $scope.massData.slice($scope.startOffset,$scope.endOffset);

    };

    $scope.formatDate = function($index){
        var input = $scope.my_jobs[$index].created_at;
        var newDate = input.replace(/(.+) (.+)/, "$1T$2Z");
        return newDate;
    };

    $scope.tags = function(index)
    {
        var job = $scope.jobs[index];

        if(job.tags != null)
        {
            return job.tags.split(",");
        }else{
            return null;
        }

    }

}]);