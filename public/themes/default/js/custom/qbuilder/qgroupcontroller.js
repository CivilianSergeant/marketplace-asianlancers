var qgroupApp = angular.module('qgroupApp', []);
qgroupApp.controller('qgroupController',function($scope,$http){
      $scope.form={};
      $scope.groups = groups;

      var requestPath = BASE + 'qbuilder/';

      $scope.addGroup = function(){

            $http({
                url : requestPath + 'add-group',
                method: "POST",
                data: $scope.form
            }).success(function(data,status){

                $scope.form = {};
                $scope.groups.push(data);

            });

            return false;
      };

      $scope.deleteGroup = function($index,$id){

          if(confirm('Are you sure to delete this group?'))
          {
              $scope.groups.splice($index,1);

              $http({
                  url : requestPath + 'delete-group',
                  method: "POST",
                  data: {id:$id}
              }).success(function(data,status){

              });
          }
          return false;
      };

});

