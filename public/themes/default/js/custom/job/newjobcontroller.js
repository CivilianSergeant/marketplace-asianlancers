var jobPostApp = angular.module('jobPostApp',['ui.bootstrap','angularFileUpload','ui.select2','ui.select']);
var requestPath = BASE+'jobPost/'

/*-----------------------------------------------Start Create job ------------------------------------------------------*/

jobPostApp.controller('addJobController',['$scope','$http','$location','$anchorScroll','$modal','$sce',
    function($scope,$http,$location,$anchorScroll,$modal,$sce){
        $scope.skills = skills;//[];
        /*$scope.customSkillSelection = function($data){
            for (var i=0; i<$data.length; i++) {
                $scope.skills.push({"id":$data[i].id,"text":$data[i].category_name});
            }
        };*/
        $scope.job_prices = job_prices; //[];
        /*$scope.customPriceSelection = function($data){
            for (var i=0; i<$data.length; i++) {
                $scope.job_prices.push({"id":$data[i].id,"text":$data[i].title});
            }
        };*/

        $scope.job_categories = job_categories;
        //$scope.customSkillSelection(skills);
        //$scope.customPriceSelection(job_prices);
        $scope.freelancers = {};
        $scope.selected_freelancers = [];
        $scope.job_category = {};
        $scope.tmp = {};
        $scope.tmp.tmp_freelancer_price=[];
        $scope.tmp.tmp_skill_tag = [];
        $scope.addFreelancerFlag = 0;
        $scope.clients = clients;

        $scope.form = {};
        $scope.form.freelancer_price=[];
        $scope.form.skill_tags_id=[];
        $scope.total_freelancer=0;
		$scope.form.job_category_id = "";
        $scope.form.selectFl = [];

        $scope.cancelButtonFlag = 0;
        $scope.loadingFlag =0;
        $scope.saveButtonFlag = 1;
        $scope.loadingSmallButtonFlag = 0;

        $scope.myHTML = "";

        $scope.massData = [];

        $scope.init=function(){
//            var mySelectionStatus = statusHtmlStorage('mySelection');
//            if(mySelectionStatus){
//                var data = JSON.parse(localStorage.getItem('mySelection'));
//
//                if(data[0]['category_value']!=undefined){
//                    $scope.job_category=data[0]['category_value'];
//                }
//                if(data[0]['select_freelancers']!=undefined){
//                    $scope.selected_freelancers = data[0]['select_freelancers'];
//                }
//                if(data[0]['price_value']!=undefined){
//                    $scope.tmp_freelancer_price=data[0]['price_value'];
//                }
//                if(data[0]['skills_value']!=undefined){
//                    $scope.tmp_skill_tag=data[0]['skills_value'];
//                }else
//                    $scope.tmp_skill_tag = [];
//                if(data[0]['form_data']!=undefined){
//                    $scope.form=data[0]['form_data'];
//                }
//            }
//            $scope.readListOfFreelancer();

        };

        $scope.removeFreelancer=function($index){
            if($scope.selected_freelancers.length>0){
                $scope.selected_freelancers.splice($index,1);
                $scope.form.selectFl.splice($index,1);

                $('#select_freelancer'+fl_key[$index]).attr('checked',false);
                fl_key.splice($index,1);
            }
        };

        // toggle selection for a given employee by name
        $scope.toggleSelection = function toggleSelection(code,$index) {
            var idx = $scope.form.selectFl.indexOf(code);
            // is currently selected
            if (idx > -1) {
                $scope.form.selectFl.splice(idx, 1);
                $scope.selected_freelancers.splice(idx, 1);
            }

            // is newly selected
            else {
                $scope.form.selectFl.push(code);
                $scope.selected_freelancers.push($scope.freelancers[$index]);
            }
        };

        $scope.showFreelancerList = function(flag){
            $scope.addFreelancerFlag = 0;
            $scope.cancelButtonFlag = 1;
            $scope.loadingFlag =1;
            $scope.searchFreelancers();
        };

        $scope.showFreelancer = function(code){
            if($scope.form.selectFl.indexOf(code)==-1){
                return 1;
            }
        };

        $scope.readListOfFreelancer = function(){

            $http({
                url : BASE + 'search/new-freelancers-list',
                method: "POST",
                data: $scope.form
            }).success(function(data,status){

                if((status == 200) && (data.status == 200))
                {
                    $scope.freelancers = data.freelancersList;
                    $scope.total_freelancer = data.totalFreelancers;
                    $scope.loadingFlag =0;
                    $scope.addFreelancerFlag = 1;
                }else{
                    $scope.errorMsg = data.msg;

                    $location.hash('top');
                    $anchorScroll();

                }
            });
        };

        /*$scope.multiSkillSelection = {
            'multiple': true,
            query: function (query) {
                query.callback({ results: $scope.skills });
            },
            initSelection: function(element, callback) {

            }
        };*/

        $scope.multiPriceSelection = {
            'multiple': true,
            query: function (query) {
                query.callback({ results: $scope.job_prices });
            },
            initSelection: function(element, callback) {

            }
        };

        $scope.searchFreelancers = function(){
            
            
            $scope.form.freelancer_price = [];
            $scope.form.skill_tags_id    = [];

            if($scope.tmp.tmp_freelancer_price!=undefined && $scope.tmp.tmp_freelancer_price.length>0){
                for (var i = 0; i < $scope.tmp.tmp_freelancer_price.length; i++) {

                    if($scope.tmp.tmp_freelancer_price[i]['title']!=undefined)
                        $scope.form.freelancer_price.push($scope.tmp.tmp_freelancer_price[i]['title']);
                }
            }

            if($scope.tmp.tmp_skill_tag!=undefined && $scope.tmp.tmp_skill_tag.length>0){
                for (var i = 0; i < $scope.tmp.tmp_skill_tag.length; i++) {
                    if($scope.tmp.tmp_skill_tag[i]['id']!=undefined)
                        $scope.form.skill_tags_id.push($scope.tmp.tmp_skill_tag[i]['id']);
                }
            }
            $('#ajaxContent').html('');
            $("#loadingFlag").show();
            $('#ajaxContent').load(BASE+'search/freelancers-list',{cat_id:$scope.form.job_category_id,skill_tags_id:$scope.tmp.tmp_skill_tag,freelancer_price:$scope.tmp.tmp_freelancer_price},function(e){
                if(e!=""){
                    $("#loadingFlag").hide();
                    $('#ajaxContent').show();
                    for(var i=0;i<fl_key.length;i++){
                        $('#select_freelancer'+fl_key[i]).attr('checked',true);
                    }
                }
            });
            if($scope.form.skill_tags_id.length>0 && $scope.form.freelancer_price.length>0){
                $scope.readListOfFreelancer();
                $scope.selected_freelancers=[];
                $scope.form.selectFl=[];
            }else{
                $scope.open('There are no value in skills and price');
                $scope.addFreelancerFlag=0;
                $scope.cancelButtonFlag = 0;
                $scope.loadingFlag =0;
                return false;
            }
        };

        $scope.checkPhotos = function($index){
            if($scope.freelancers[$index].photos=='' || $scope.freelancers[$index].photos==null){

                return true;
            }
            return false;
        };

        $scope.resetFreelancerList = function(){
            $scope.addFreelancerFlag=0;
            $scope.cancelButtonFlag = 0;
            $scope.loadingFlag =0;
            $("#ajaxContent").hide();
        }

        $scope.haveFreelancer = function(code){
            if($scope.freelancers.length>0){
                for (var i = 0; i < $scope.freelancers.length; i++) {
                    if($scope.freelancers[i].code==code){
                        return 1;
                    }
                }
                return 0;
            }else{
                return 1;
            }
        }
		
		$scope.addJobPost = function(){
            $scope.errorMsg = '';
            $scope.successMsg = '';
            $scope.saveButtonFlag = 0;
            $scope.loadingSmallButtonFlag = 1;
            $scope.selected_freelancers = [];
            $scope.form.selectFl = [];
			$scope.form.attach_file = [];
			$scope.form.selectFlInfo = [];
            $scope.form.freelancer_price = [];
            $scope.form.skill_tags_id = [];

//            console.log(fl_key);
//            console.log($scope.freelancers);
            for(var i=0;i<fl_key.length;i++){
                $scope.selected_freelancers.push($scope.freelancers[fl_key[i]]);
                $scope.form.selectFl.push($scope.freelancers[fl_key[i]].fid);
                $scope.form.selectFlInfo.push($scope.freelancers[fl_key[i]]);
            }

            for (var j=0; j<$scope.tmp.tmp_skill_tag.length; j++) {
                $scope.form.skill_tags_id.push($scope.tmp.tmp_skill_tag[j].id);
            }
            for (var j=0; j<$scope.tmp.tmp_freelancer_price.length; j++) {
                $scope.form.freelancer_price.push($scope.tmp.tmp_freelancer_price[j].text);
            }

//            if($scope.form.skill_tags_id.length<=0){
//                for (var i=0; i<$scope.selected_freelancers.length; i++) {
//                    for (var j=0; j<$scope.selected_freelancers[i].skills.length; j++) {
//
//                        if($scope.form.skill_tags_id.indexOf($scope.selected_freelancers[i].skills[j].skill_tags_id)<0)
//                            $scope.form.skill_tags_id.push($scope.selected_freelancers[i].skills[j].skill_tags_id);
//                    }
//                }
//            }
//
//            for (var i=0; i<$scope.selected_freelancers.length; i++) {
//                if($scope.form.freelancer_price.indexOf($scope.selected_freelancers[i].freelancer_price)<0)
//                    $scope.form.freelancer_price[i]=$scope.selected_freelancers[i].freelancer_price;
//            }

            $scope.form.description = angular.element('#description').val();
            
            $http({
                url : requestPath+'add',
                method: "POST",
                data: $scope.form
            }).success(function(data,status){

                if((status == 200) && (data.status == 200))
                {
                    window.location = data.url;
                    $scope.saveButtonFlag = 0;
                }else{
                    $scope.errorMsg = data.msg;

                    $location.hash('top');
                    $anchorScroll();
                    $scope.saveButtonFlag = 1;

                }
                $scope.loadingSmallButtonFlag = 0;
            });

            return false;
        }

        $scope.formatDate = function($index){

            var input = $scope.freelancers[$index].last_login;
            var newDate = input.replace(/(.+) (.+)/, "$1T$2Z");

            return newDate;
        };


        $scope.givenTesCount=function($index){
            var count = 0;
            for (var i = 0; i < $scope.freelancers[$index].skills.length; i++) {
                if($scope.freelancers[$index].skills[i].test_taken==1 && $scope.freelancers[$index].skills[i].score!=null)
                    count++;
            }
            return count;
        }

        $scope.open = function($msg)
        {
            var dlgHtml  = '';
            /*dlgHtml += '<form id="uploadPicFrm" method="post" action="'+BASE+'freelancer/upload-photo" enctype="multipart/form-data">*/
//            dlgHtml += '<div class="modal-header">';
//            dlgHtml += '<h3 class="modal-title">'+$title+'</h3></div>';
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

        $scope.feedBackPrint = function(html,$index){
            var new_html = "";
            for(var i=1; i<=5; i++){
                if(i <= $scope.freelancers[$index].total_feedback)
                    new_html +='<span class="star"></span>';
                else
                    new_html +='<span class="star2"></span>';

            }
            if($scope.freelancers[$index].total_feedback!=undefined)
                new_html +='&nbsp;<b>'+$scope.freelancers[$index].total_feedback+'</b>';
            else
                new_html +='&nbsp;<b>0</b>';
            return $sce.trustAsHtml(new_html);
        };

        $('.pagination a').live('click', function (event) {
            event.preventDefault();
            if ( $(this).attr('href') != '#' ) {
                $("html, body").animate({ scrollTop: 0 }, "fast");

                $('#ajaxContent').hide();
                $("#loadingFlag").show();
                var f_skills = $("#skill_tags_id").val();
                var f_price = $("#freelancer_price").val();
                var cat_id = $("#job_category_id").val();

                $('#ajaxContent').load($(this).attr('href'),{cat_id:$scope.form.job_category_id,skill_tags_id:$scope.tmp.tmp_skill_tag,freelancer_price:$scope.tmp.tmp_freelancer_price},function(e){
                    if(e!=""){
                        $("#loadingFlag").hide();
                        $('#ajaxContent').show();
                        for(var i=0;i<fl_key.length;i++){
                            $('#select_freelancer'+fl_key[i]).attr('checked',true);
                        }
                    }
                });
            }
            return false;
        });

        $scope.setFreelancer = function(index){
            $scope.form.selectFl.push($scope.freelancers[index].fid);
            $scope.selected_freelancers.push($scope.freelancers[index]);
        };

        $scope.deleteFreelancer = function(index){
            if($scope.selected_freelancers.length>0){
                $scope.form.selectFl.splice(index, 1);
                $scope.selected_freelancers.splice(index, 1);
            }
        };

        $('.select-freelancer').live('click',function(e){
            var index = $(this).val();

            if($(this).is(':checked')){
                fl_key.push(index);
                $scope.setFreelancer(index);
            }else{

                $scope.deleteFreelancer(fl_key.indexOf(index));
                fl_key.splice(fl_key.indexOf(index), 1);
            }
        });

        /*$("#find_again").on('click',function(e){
            $('#ajaxContent').hide();
            $("#loadingFlag").show();

            var f_skills = $("#skill_tags_id").val();
            var f_price = $("#freelancer_price").val();
            var cat_id = $("#job_category_id").val();

            $('#ajaxContent').load(BASE+'search/freelancers-list',{cat_id:cat_id,skill_tags_id:f_skills,freelancer_price:f_price},function(e){
                if(e!=""){
                    $("#loadingFlag").hide();
                    $('#ajaxContent').show();
                    for(var i=0;i<fl_key.length;i++){
                        $('#select_freelancer'+fl_key[i]).attr('checked',true);
                    }
                }
            });
        });*/

    }]);

jobPostApp.filter('dateFormat', function($filter){
    return function(input)
    {
        if(input == null){ return ""; }

        var _date = $filter('date')(new Date(input), 'MMM dd yyyy');

        return _date.toUpperCase();

    };
});
var ModalInstanceCtrl = function ($scope, $modalInstance) {

    $scope.ok = function () {
        $modalInstance.dismiss('cancel');
    };
};
/*-----------------------------------------------End Create job ------------------------------------------------------*/
