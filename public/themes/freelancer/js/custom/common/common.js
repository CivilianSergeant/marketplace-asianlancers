// Functions
function removeHtmlStorage(name) {
    localStorage.removeItem(name);
    localStorage.removeItem(name + '_time');
}

function setHtmlStorage(name, value, expires) {

    if (expires == undefined || expires == 'null') {
        var expires = 3600;
    } // default: 1h

    var date = new Date();
    var schedule = Math.round((date.setSeconds(date.getSeconds() + expires)) / 1000);

    localStorage.setItem(name, value);
    localStorage.setItem(name + '_time', schedule);
}

function statusHtmlStorage(name) {

    var date = new Date();
    var current = Math.round(+date / 1000);

    // Get Schedule
    var stored_time = localStorage.getItem(name + '_time');
    if (stored_time == undefined || stored_time == 'null') {
        var stored_time = 0;
    }

    // Expired
    if (stored_time < current) {

        // Remove
        removeHtmlStorage(name);

        return 0;

    } else {

        return 1;
    }
}

function drawRating(ratingsElmParent)
{
    var ratingsElm = $(ratingsElmParent).children();

    $.each(ratingsElm,function(i,e){
        var item = $(this);
        item.hover(function(){
            if($(this).prev())
                $(this).prevAll().addClass('selected');
        },function(){
            if($(this).prev())
                $(this).prevAll().removeClass('selected');
        })
    });
}

function setRating(item)
{

    if(item.hasClass('rated'))
    {
        item.nextAll().removeClass('rated');
    }
    if(!item.hasClass('rated'))
    {
        item.addClass('rated').prevAll().addClass('rated');
    }

}

/////////////////  Password reset////////////////



var requestPath = BASE + 'home/' ;
var frontApp = angular.module('frontApp',['ui.bootstrap']);
frontApp.controller('frontController',['$scope','$http','$location','$anchorScroll','$modal'
    ,function($scope,$http,$location,$anchorScroll,$modal){

        $scope.form={};
        $scope.form._token = token;

        $scope.successMsg = '';
        $scope.errorMsg = '';
        $scope.disableButton = false;



        $scope.sendEmail = function(){
            $scope.successMsg = '';
            $scope.errorMsg = '';
            $scope.disableButton = true;

            $http({
                url : requestPath+'forget',
                method: "POST",
                data: $scope.form
            }).success(function(data,status){

                if((status == 200) && (data.status == 'Error'))
                {
                    // console.log(data.message);
                    $scope.errorMsg = data.message;
                    $scope.disableButton = false;

                }
                else if((status == 200) && (data.status == 'Success')){
                    $scope.successMsg = data.message;
                }else{
                    $scope.errorMsg = 'Password changing fail.';
                    $scope.disableButton = false;

                }

            });

            return false;

        }


        $scope.resetPassword = function(){
            $scope.successMsg = '';
            $scope.errorMsg = '';

            $scope.form.id = id;
            $scope.form.code = code;

            $scope.disableButton = true;

            $http({
                url : requestPath+'reset',
                method: "POST",
                data: $scope.form
            }).success(function(data,status){

                if((status == 200) && (data.status == 'Error'))
                {
                    $scope.errorMsg = data.message;
                    $scope.disableButton = false;
                }
                else if((status == 200) && (data.status == 'Success')){
                    $scope.successMsg = data.message;
                }else{
                    $scope.errorMsg = 'Password changing fail.';
                    $scope.disableButton = false;
                }

            });

            return false;
        }

    }]);
///
