/**
 * Created by Himel on 8/25/14.
 */
var qset = angular.module('qsetApp',['ui.bootstrap']);
var requestPath = BASE + 'qbuilder/';
qset.controller('qsetController',['$scope','$http','$location','$anchorScroll',
    function($scope,$http,$location,$anchorScroll){

    $scope.form={};
    $scope.form._token = token;
    $scope.levels = levels;
    $scope.groups = groups;
    $scope.skills = skills;

    $scope.form.rules = [{'group_id':groups[0].id,'questions':[{'level_id':levels[0].id,'q_no':1}]}];



    $scope.addGroupRow = function()
    {
        var group = {'group_id':groups[0].id,'questions':[{'level_id':levels[0].id,'q_no':1}]};
        $scope.form.rules.push(group);
    };

    $scope.delGroupRow = function(groupIndex)
    {
        $scope.form.rules.splice(groupIndex,1);
    }

    $scope.addQuestionRow = function(index)
    {

        var question = {'level_id':'','q_no':1};
        $scope.form.rules[index].questions.push(question);
    };

    $scope.delQuestionRow = function(groupIndex,questionIndex)
    {
        $scope.form.rules[groupIndex].questions.splice(questionIndex,1);
    }

    $scope.addQuestionSet = function()
    {
        $scope.errorMsg = '';
        $http({
            url : requestPath + 'add-qset',
            method: "POST",
            data: $scope.form
        }).success(function(data,status){
            if(data.status==200 && status==200)
            {
                console.log(data.url);
                window.location = data.url;
            }
            else if(data.status==400 && status == 200)
            {
                /*for(m in data.msg){*/
                    $scope.errorMsg = data.msg;
                /*}*/
                $location.hash('top');
                $anchorScroll();
            }
        });
        return false;
    };


}]);

qset.controller('qsetlistController',function($scope,$http){

   // $scope.sets = sets;

    $scope.massData = sets;

    $scope.currentPage = 1;
    $scope.maxSize = 5;
    $scope.itemsPerPage = 10;
    $scope.bigTotalItems = $scope.massData.length;
    $scope.bigCurrentPage = 1;
    $scope.sets = $scope.massData.slice(0,$scope.itemsPerPage);


    $scope.curPage = 0;
    $scope.startOffset = 0;
    $scope.endOffset = 0;

    $scope.pageChanged = function() {
        if($scope.bigCurrentPage == "" || $scope.bigCurrentPage == undefined || $scope.bigCurrentPage < 0)
            $scope.bigCurrentPage=1;
        $scope.curPage     = ($scope.bigCurrentPage-1);
        $scope.startOffset =  $scope.curPage * $scope.itemsPerPage;
        $scope.endOffset   =  ($scope.itemsPerPage * $scope.curPage)+$scope.itemsPerPage;
        $scope.sets        = $scope.massData.slice($scope.startOffset,$scope.endOffset);

    };

    $scope.deleteQuestionSet = function($index,$id)
    {

        if(confirm('Are you sure to delete this question set?'))
        {
            $scope.sets.splice($index,1);
            $http({
                url : requestPath+'delete-qset',
                method: "POST",
                data: {id:$id}
            }).success(function(data,status){

            });
        }
        return false;
    }
});

qset.controller('qsetEditController',['$scope','$http','$location','$anchorScroll',
    function($scope,$http,$location,$anchorScroll){

        $scope.form={};
        $scope.form._token = token;
        $scope.levels = levels;
        $scope.groups = groups;
        $scope.skills = skills;
        console.log(questionSet);
        $scope.form.id = questionSet.id;
        $scope.form.title = questionSet.title;
        $scope.form.skill_id = questionSet.skill_id;
        $scope.form.level_id = questionSet.level_id;
        $scope.form.group_id = questionSet.group_id;
        $scope.form.test_time = questionSet.test_time;
        $scope.form.rules = questionSet.question_rule;

        $scope.addGroupRow = function()
        {
            var group = {'group_id':groups[0].id,'questions':[{'level_id':levels[0].id,'q_no':1}]};
            $scope.form.rules.push(group);
        };

        $scope.delGroupRow = function(groupIndex)
        {
            $scope.form.rules.splice(groupIndex,1);
        }

        $scope.addQuestionRow = function(index)
        {

            var question = {'level_id':'','q_no':1};
            $scope.form.rules[index].questions.push(question);
        };

        $scope.delQuestionRow = function(groupIndex,questionIndex)
        {
            $scope.form.rules[groupIndex].questions.splice(questionIndex,1);
        }

        $scope.updateQuestionSet = function()
        {
            $scope.errorMsg = '';
            $http({
                url : requestPath + 'update-qset',
                method: "POST",
                data: $scope.form
            }).success(function(data,status){
                    if(data.status==200 && status==200)
                    {
                        window.location.reload();
                       /*window.location = data.url;*/
                    }
                    else if(data.status==400 && status == 200)
                    {

                        $scope.errorMsg = data.msg;

                        $location.hash('top');
                        $anchorScroll();
                    }
                });
            return false;
        };

}]);