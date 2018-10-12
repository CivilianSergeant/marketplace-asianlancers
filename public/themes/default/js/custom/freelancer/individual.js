/**
 * Created by sanzeeb on 8/31/14.
 */

//var userApp = angular.module('xApp',['ui.bootstrap']);
var xAppModule = angular.module('xApp',['ui.bootstrap']);
var requestPath = BASE + 'freelancer/';

//alert(UserData.toString());

xAppModule.controller('IndividualCtrl' , ['$scope','$http','$location','$anchorScroll',function ($scope,$http,$location,$anchorScroll) {

    $scope.UserData = UserData;

    $scope.form = {};
    $scope.country = country;


    $scope.divisions  = [
        {ID: 'Barisal', Title: 'Barisal'},
        {ID: 'Chittagong', Title: 'Chittagong'},
        {ID: 'Dhaka', Title: 'Dhaka'},
        {ID: 'Khulna', Title: 'Khulna'},
        {ID: 'Rajshahi', Title: 'Rajshahi'},
        {ID: 'Rajshahi', Title: 'Rangpur'},
        {ID: 'Sylhet', Title: 'Sylhet'}
    ];

    $scope.form.division = $scope.UserData.division;
    $scope.form.address = $scope.UserData.address;
    $scope.form.country = $scope.UserData.address_country;
    $scope.form.city = $scope.UserData.address_city;
    $scope.form.zip = $scope.UserData.address_zip;
    $scope.form.contact_number = $scope.UserData.contact_number;
    $scope.form.mobile = $scope.UserData.mobile;

    $scope.updateContact = function()
    {
        $http({
            url:requestPath+'update-contact',
            method:"POST",
            data: $scope.form
        }).success(function(response,status){
            window.location = response.url;
        });
    }









}]);

