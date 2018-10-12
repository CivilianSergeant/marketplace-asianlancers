/**
 * Created by HimelC51 on 10/19/14.
 */
var feedbackApp = angular.module('feedbackApp',['ui.bootstrap']);
feedbackApp.controller('feedbackController',['$scope','$http','$location','$anchorScroll','$modal',
    function($scope,$http,$location,$anchorScroll,$modal){

    $scope.client = client;
    $scope.jobOffer   = job_offer;

    $scope.form = {
      'client_id' : $scope.client.id,
      'job_offer_id' : $scope.jobOffer.id

    };
    $scope.saveFreelancerFeedback = function()
    {
        var qualityRatedElm = angular.element('div.quality > span.rated');
        var expertiseRatedElm = angular.element('div.expertise > span.rated');
        var scheduleRatedElm = angular.element('div.schedule > span.rated');
        var responseRatedElm = angular.element('div.response > span.rated');
        var professionalRatedElm = angular.element('div.professional > span.rated');
        var ratedElm = angular.element('span.rated');
        var comment = angular.element('.feedback_comment').val();
        var rating = (ratedElm.length > 0)? (ratedElm.length/5) : 0;

        if(qualityRatedElm.length == 0)
        {

            $scope.open('Warning!','Please give rating for Quality');

            return false;
        }
        if(expertiseRatedElm.length == 0)
        {
            $scope.open('Warning!','Please give rating for Expertise');
            return false;
        }
        if(scheduleRatedElm.length == 0)
        {
            $scope.open('Warning!','Please give rating for Schedule');
            return false;
        }
        if(responseRatedElm.length == 0)
        {
            $scope.open('Warning!','Please give rating for Response');
            return false;
        }
        if(professionalRatedElm.length == 0)
        {
            $scope.open('Warning!','Please give rating for Professional');
            return false;
        }

        if(rating > 0 && comment != "")
        {
            $scope.form.score = rating;
            $scope.form.comment = comment;
            angular.element('.send_feedback_btn').attr('disabled','disabled');
            $http({
                url : BASE + 'freelancer/save-feedback',
                method : "POST",
                data : $scope.form
            }).success(function(data,status){

                        window.location = BASE + 'freelancer';
            });
        }else{
            $scope.open('Warning!','Please give a comment');
            return false;
        }



    }

    $scope.open = function($title,$msg)
    {
        var dlgHtml  = '';
        /*dlgHtml += '<form id="uploadPicFrm" method="post" action="'+BASE+'freelancer/upload-photo" enctype="multipart/form-data">*/
        dlgHtml += '<div class="modal-header">';
        dlgHtml += '<h3 class="modal-title">'+$title+'</h3></div>';
        /*dlgHtml += '</div>';*/
        dlgHtml += '<div class="modal-body">';
        dlgHtml +=  '<p>'+$msg+'</p>';
        dlgHtml += '</div>';


        dlgHtml += '<div class="modal-footer">';
        dlgHtml += '<button class="btn btn-warning pull-right" ng-click="ok()">OK</button></div>';
        var modalInstance = $modal.open({
            template: dlgHtml,
            controller: ModalInstanceCtrl
            //size: size,
            /*resolve: {
             items: function () {
             return $scope.items;
             }
             }*/
        });

        modalInstance.result.then(function () {
            //$scope.selected = selectedItem;
        }, function () {
            //$log.info('Modal dismissed at: ' + new Date());
        });
    };


}]);

var ModalInstanceCtrl = function ($scope, $modalInstance) {

    $scope.ok = function () {
        $modalInstance.dismiss('cancel');
    };
};