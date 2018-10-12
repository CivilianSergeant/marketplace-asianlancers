/**
 * Created by Himel on 8/24/14.
 */
var frontHomeApp = angular.module('frontHomeApp', []);
var requestPath = BASE+'home/';


frontHomeApp.controller('frontHomeController',['$scope','$http','$location','$anchorScroll',
    function($scope,$http,$location,$anchorScroll){
        $scope.job_categories = job_categories;

        $scope.form = {};
        $scope.form.freelancer_price=[];
        $scope.form.skill_tags_id=[];
        $scope.form.selectFl = [];
        //console.log($scope.job_categories);

        $scope.showText=function($index){
            return $scope.job_categories[$index].title;
        }

        $scope.showValue=function($index){
            return $scope.job_categories[$index].id;
        }

        $scope.setValueLocal=function($index){

            var data = [{"category_value":$scope.job_categories[$index],"price_value":null,"form_data":$scope.form}];
            setHtmlStorage('mySelection', JSON.stringify(data), 24*3600);
            $http({
                url : requestPath + 'set-page-flag',
                method: "POST",
                data: {page_name:'home',cat_id:job_categories[$index].id}
            }).success(function(data,status){
                if((status == 200) && (data.status == 200))
                {
                    window.location = requestPath+data.url;
                }
            });
            return false;
        }
}]);

frontHomeApp.controller('frontPriceController',['$scope','$http','$location','$anchorScroll',
    function($scope,$http,$location,$anchorScroll){
        $scope.job_prices = job_prices;
        $scope.cat_id = cat_id;

        $scope.showText=function($index){
            return $scope.job_prices[$index].title;
        };

        $scope.showValue=function($index){
            return $scope.job_prices[$index].id;
        };

        $scope.showAvailable=function($index){
            return $scope.job_prices[$index].availableFreelancer;
        };

        $scope.setValueLocal=function($index){
            var mySelectionStatus = statusHtmlStorage('mySelection');
            if(mySelectionStatus){
                var data = JSON.parse(localStorage.getItem('mySelection'));
                data[0]['price_value'] = [{'id':$scope.job_prices[$index].id,'text':$scope.job_prices[$index].title}];
                data[0]['form_data']['freelancer_price']=[$scope.job_prices[$index].title];

                setHtmlStorage('mySelection', JSON.stringify(data), 24*3600);
            }else{
                var data = [{"category_value":null,"price_value":[{'id':$scope.job_prices[$index].id,'text':$scope.job_prices[$index].title}]}];

                data[0]['form_data']['freelancer_price'].push($scope.job_prices[$index].id);
                setHtmlStorage('mySelection', JSON.stringify(data), 24*3600);
            }

            $http({
                url : requestPath + 'set-page-flag',
                method: "POST",
                data: {page_name:'price'}
            }).success(function(data,status){
                if((status == 200) && (data.status == 200))
                {
                    window.location = BASE+'search/freelancer/'+$scope.cat_id;

                }
            });
            //console.log(JSON.parse(localStorage.getItem('mySelection')));
            return false;
        };
    }]);








