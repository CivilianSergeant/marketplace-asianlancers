/**
 * Created by Himel on 8/24/14.
 */
var qbuilderApp = angular.module('qbuilderApp', ['ui.bootstrap']);
var requestPath = BASE + 'qbuilder/';
qbuilderApp.controller('qbuilderController',['$scope','$http','$location','$anchorScroll',
    function($scope,$http,$location,$anchorScroll){

    $scope.form={};
    $scope.form._token = token;
    $scope.levels = levels;
    $scope.groups = groups;
    $scope.skills = skills;
    $scope.form.question_type='Textbox';
    $scope.form.answers=[];



    $scope.addQuestion = function(){
        $scope.errorMsg = '';

        $http({
            url : requestPath+'add',
            method: "POST",
            data: $scope.form
        }).success(function(data,status){

               if((status == 200) && (data.status == 200))
               {
                  window.location = data.url;
               }else{
                  $scope.errorMsg = data.msg;

                  $location.hash('top');
                  $anchorScroll();

               }
        });

        return false;
    };

    $scope.addRow = function()
    {

        if($scope.form.question_type != 'Textbox')
        {
            var index = ($scope.form.answers.length == undefined)? 0 : ($scope.form.answers.length);
            $scope.form.answers[index]={'answer':'','correct':0};

        }
        if($scope.form.question_type == 'Textbox' && $scope.form.answers.length == 0)
        {
            var index = ($scope.form.answers.length == undefined)? 0 : ($scope.form.answers.length);
            $scope.form.answers[index]={'answer':'','correct':1};
        }
    }

    $scope.sliceRow = function()
    {
        if($scope.form.answers.length > 0)
        {
            $scope.form.answers.splice(1,$scope.form.answers.length);
            $scope.form.answers[0].correct=1;
        }

    }

    $scope.refreshAnswers = function()
    {
        var answers = $scope.form.answers;
        for (ans in answers)
        {

            $scope.form.answers[ans] = {'answer':answers[ans].answer,'correct':0};
        }
    }

}]);

qbuilderApp.controller('qlistsController',function($scope,$http){

        $scope.massData = questions;

        $scope.currentPage = 1;
        $scope.maxSize = 5;
        $scope.itemsPerPage = 10;
        $scope.bigTotalItems = $scope.massData.length;
        $scope.bigCurrentPage = 1;
        $scope.questions = $scope.massData.slice(0,$scope.itemsPerPage);


        $scope.curPage = 0;
        $scope.startOffset = 0;
        $scope.endOffset = 0;

        $scope.pageChanged = function() {
            if($scope.bigCurrentPage == "" || $scope.bigCurrentPage == undefined || $scope.bigCurrentPage < 0)
                $scope.bigCurrentPage=1;
            $scope.curPage     = ($scope.bigCurrentPage-1);
            $scope.startOffset = $scope.curPage * $scope.itemsPerPage;
            $scope.endOffset   =   ($scope.itemsPerPage * $scope.curPage)+$scope.itemsPerPage;
            $scope.questions   = $scope.massData.slice($scope.startOffset,$scope.endOffset);

        };

        $scope.deleteQuestion = function($index,$id)
        {
            if(confirm('Are you sure to delete this question?'))
            {
                $scope.questions.splice($index,1);
                $http({
                    url : requestPath+'delete-question',
                    method: "POST",
                    data: {id:$id}
                }).success(function(data,status){

                });
            }
        }

});

qbuilderApp.controller('qbuilderEditController',['$scope','$http','$location','$anchorScroll',
    function($scope,$http,$location,$anchorScroll){

        $scope.form={};

        $scope.form._token = token;
        $scope.levels = levels;
        $scope.groups = groups;
        $scope.skills = skills;

        $scope.form.id = question.id;
        $scope.form.skill_id = question.skill_id;
        $scope.form.level_id = question.level_id;
        $scope.form.group_id = question.group_id;
        $scope.form.question = question.question;
        $scope.form.answer_time = question.answer_time;
        $scope.form.question_type = question.question_type;
        $scope.form.answers = question.answers;

        $scope.updateAnswers = function($index)
        {
            for(i in $scope.form.answers)
            {
                if($scope.form.question_type == 'Radio')
                {
                    if(i == $index)
                    {
                        $scope.form.answers[i].correct = 1;
                    }else{
                        $scope.form.answers[i].correct = 0;
                    }
                }

            }
        };

        $scope.addRow = function()
        {

            if($scope.form.question_type != 'Textbox')
            {
                var index = ($scope.form.answers.length == undefined)? 0 : ($scope.form.answers.length);
                $scope.form.answers[index]={'answer':'','correct':0};

            }
            if($scope.form.question_type == 'Textbox' && $scope.form.answers.length == 0)
            {
                var index = ($scope.form.answers.length == undefined)? 0 : ($scope.form.answers.length);
                $scope.form.answers[index]={'answer':'','correct':1};
            }
        }

        $scope.sliceRow = function()
        {
            if($scope.form.answers.length > 0)
            {
                $scope.form.answers.splice(1,$scope.form.answers.length);
                $scope.form.answers[0].correct=1;
            }

        }

        $scope.refreshAnswers = function()
        {
            var answers = $scope.form.answers;
            for (ans in answers)
            {

                $scope.form.answers[ans] = {'answer':answers[ans].answer,'correct':0};
            }
        }

        $scope.updateQuestion = function(){
            $scope.errorMsg = '';

            $http({
                url : requestPath+'update',
                method: "POST",
                data: $scope.form
            }).success(function(data,status){

                    if((status == 200) && (data.status == 200))
                    {
                        window.location = data.url;
                    }else{

                        $scope.errorMsg = data.msg;
                        $location.hash('top');
                        $anchorScroll();

                    }
                });

            return false;
        };
}]);





