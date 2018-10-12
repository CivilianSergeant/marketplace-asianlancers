var notifyApp = angular.module('notifyApp', ['ui.bootstrap']);
var requestPath = BASE + 'notification/';
notifyApp.controller('notifyController',['$scope','$http','$location','$anchorScroll','$modal',
    function($scope,$http,$location,$anchorScroll,$modal){

        $scope.jobPhase = jobPhase;
        $scope.notification = notification;
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
            dlgHtml += '<button class="btn btn-warning pull-right" ng-click="cancel()">Cancel</button>';
            dlgHtml += '<button class="btn btn-success pull-right" ng-click="ok()"  style="margin-right:10px;">Ok</button></div>';

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

        $scope.paymentProcess = function(){
            $scope.open('Warning!','Are you sure to open payment for worker');
//            console.log($scope.notification);
            return false;
        };

}]);
var ModalInstanceCtrl = function ($scope, $modalInstance) {

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };
    $scope.ok = function () {
//        $modalInstance.dismiss('cancel');
        window.location = BASE+'payment/paynow/'+notification.object_id;
    };
};