var qlevelApp = angular.module('qlevelApp', []);

qlevelApp.controller('qlevelController',function($scope,$http){
      $scope.form={};
      $scope.levels = levels;

      var requestPath = BASE + 'qbuilder/';

      $scope.addLevel = function(){

            $http({
                url : requestPath + 'add-level',
                method: "POST",
                data: $scope.form
            }).success(function(data,status){
                    console.log(data)
                $scope.form = {};
                $scope.levels.push(data);

            });

            return false;
      };

      $scope.deleteLevel = function($index,$id){

          if(confirm('Are you sure to delete this level?'))
          {
              $scope.levels.splice($index,1);

              $http({
                  url : requestPath + 'delete-level',
                  method: "POST",
                  data: {id:$id}
              }).success(function(data,status){

              });

          }
          return false;
      };


});


