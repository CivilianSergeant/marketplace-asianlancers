var jobPostApp = angular.module('jobPostApp',['ui.bootstrap','angularFileUpload','ui.select2']);
var requestPath = BASE+'jobPost/'

/*-----------------------------------------------Start job list ------------------------------------------------------*/

jobPostApp.controller('myJobListController',['$scope','$http','$location','$anchorScroll','$filter','$modal',
    function($scope,$http,$location,$anchorScroll,$filter,$modal){

        //$scope.my_jobs = my_jobs;
        $scope.massData = my_jobs;
        $scope.currentPage = 1;
        $scope.maxSize = 3;
        $scope.itemsPerPage = 10;
        $scope.bigTotalItems = $scope.massData.length;
        $scope.bigCurrentPage = 1;
        $scope.my_jobs = $scope.massData.slice(0,$scope.itemsPerPage);


        $scope.curPage = 0;
        $scope.startOffset = 0;
        $scope.endOffset = 0;

        $scope.deleteJobPost = function($index){
            $scope.errorMsgList = '';
            $scope.successMsgList = '';

            if(confirm('Are you sure to delete this job ?'))
            {
                $http({
                    url : requestPath + 'delete-job',
                    method: "POST",
                    data: {id:$scope.my_jobs[$index].id}
                }).success(function(data,status){
                    if((status == 200) && (data.status == 200))
                    {
                        $scope.successMsgList = data.msg;
                        $scope.my_jobs.splice($index,1);
                    }else{
                        $scope.errorMsgList = data.msg;

                        $location.hash('top');
                        $anchorScroll();

                    }
                });
            }
        }

        $scope.showData = function($data){
    //        console.log($data);
        };

        $scope.formatDate = function($index){
            var input = $scope.my_jobs[$index].created_at;
            var newDate = input.replace(/(.+) (.+)/, "$1T$2Z");
            return newDate;
        };

        $scope.wordPrint = function($str,$length){
            if($str.lenght>$length)
                return $str.substr(0, $length);
            return $str;
        }
        $scope.pageChanged = function() {
            if($scope.bigCurrentPage == "" || $scope.bigCurrentPage == undefined || $scope.bigCurrentPage < 0)
                $scope.bigCurrentPage=1;
            $scope.curPage     = ($scope.bigCurrentPage-1);
            $scope.startOffset = $scope.curPage * $scope.itemsPerPage;
            $scope.endOffset   =   ($scope.itemsPerPage * $scope.curPage)+$scope.itemsPerPage;
            $scope.my_jobs   = $scope.massData.slice($scope.startOffset,$scope.endOffset);

        };

        $scope.updateJobStatus = function($index,$type){
            $scope.errorMsg="";
            $http({
                url : requestPath + 'update-job-status',
                method: "POST",
                data: {code:$scope.my_jobs[$index].code,type:$type}
            }).success(function(data,status){

                if((status == 200) && (data.status == 200)){
                    $scope.my_jobs[$index].job_status = data.newData.job_status;
                }else{
                    $scope.errorMsg = data.msg;
                    $location.hash('top');
                    $anchorScroll();
                }
            });
        };
        $scope.showAllPhase = function($index){
            $http({
                url : BASE + 'jobPhase/all-phase',
                method: "POST",
                data: {code:$scope.my_jobs[$index].code}
            }).success(function(data,status){
                console.log(status);
                console.log(data);
                if(status == 200){
                    $scope.open($scope.my_jobs[$index].title,data);
                }else{
                    $scope.errorMsg = data.msg;
                    $location.hash('top');
                    $anchorScroll();
                }
            });
        };

        $scope.open = function($title,$msg)
        {
            var dlgHtml  = '';
            /*dlgHtml += '<form id="uploadPicFrm" method="post" action="'+BASE+'freelancer/upload-photo" enctype="multipart/form-data">*/
            dlgHtml += '<div class="modal-header">';
            dlgHtml += '<h3 class="modal-title">'+$title+'</h3></div>';
            /*dlgHtml += '</div>';*/
            dlgHtml += '<div class="modal-body">';
            dlgHtml +=  $msg;
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

/*-----------------------------------------------End job list ------------------------------------------------------*/


/*-----------------------------------------------Start Create job ------------------------------------------------------*/

jobPostApp.controller('addJobController',['$scope','$http','$location','$anchorScroll','$modal',
    function($scope,$http,$location,$anchorScroll,$modal){
        $scope.skills = [];
        $scope.customSkillSelection = function($data){
            for (var i=0; i<$data.length; i++) {
                $scope.skills.push({"id":$data[i].id,"text":$data[i].category_name});
            }
        };
        $scope.job_prices = [];
        $scope.customPriceSelection = function($data){
            for (var i=0; i<$data.length; i++) {
                $scope.job_prices.push({"id":$data[i].id,"text":$data[i].title});
            }
        };

        $scope.job_categories = job_categories;
        $scope.customSkillSelection(skills);
        $scope.customPriceSelection(job_prices);
        $scope.freelancers = {};
        $scope.selected_freelancers = [];
        $scope.select_fl_key = [];
        $scope.job_category = {};
        $scope.tmp_freelancer_price={};
        $scope.tmp_skill_tag = [];
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

        $scope.init=function(){
            var mySelectionStatus = statusHtmlStorage('mySelection');
            if(mySelectionStatus){
                var data = JSON.parse(localStorage.getItem('mySelection'));
                //console.log(data);
                if(data[0]['category_value']!=undefined){
                    $scope.job_category=data[0]['category_value'];
                }
                if(data[0]['select_freelancers']!=undefined){
                    $scope.selected_freelancers = data[0]['select_freelancers'];
                }
                if(data[0]['price_value']!=undefined){
                    $scope.tmp_freelancer_price=data[0]['price_value'];
                }
                if(data[0]['skills_value']!=undefined){
                    $scope.tmp_skill_tag=data[0]['skills_value'];
                }
                if(data[0]['form_data']!=undefined){
                    $scope.form=data[0]['form_data'];
                }
                if(data[0]['select_fl_key']!=undefined){
                    $scope.select_fl_key=data[0]['select_fl_key'];
                }
            }
            $scope.readListOfFreelancer();

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

        $scope.resetFreelancerList = function(){
            $scope.addFreelancerFlag=0;
            $scope.cancelButtonFlag = 0;
            $scope.loadingFlag =0;
            $("#ajaxContent").hide();
        }
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

        $scope.multiSkillSelection = {
            'multiple': true,
            query: function (query) {
                query.callback({ results: $scope.skills });
            },
            initSelection: function(element, callback) {

            }
        };

        $scope.multiPriceSelection = {
            'multiple': true,
            query: function (query) {
                query.callback({ results: $scope.job_prices });
            },
            initSelection: function(element, callback) {

            }
        };

        $scope.searchFreelancers = function(){

            $scope.form.skill_tags_id = [];
            $scope.form.freelancer_price = [];
//            console.log($scope.tmp_freelancer_price);
            if($scope.tmp_freelancer_price!=undefined && $scope.tmp_freelancer_price.length>0){
                for (var i = 0; i < $scope.tmp_freelancer_price.length; i++) {

                    if($scope.tmp_freelancer_price[i]['text']!=undefined)
                        $scope.form.freelancer_price.push($scope.tmp_freelancer_price[i]['text']);
                }
            }

            if($scope.tmp_skill_tag!=undefined && $scope.tmp_skill_tag.length>0){
                for (var i = 0; i < $scope.tmp_skill_tag.length; i++) {
                    if($scope.tmp_skill_tag[i]['id']!=undefined)
                        $scope.form.skill_tags_id.push($scope.tmp_skill_tag[i]['id']);
                }
            }
            if($scope.form.skill_tags_id.length>0 && $scope.form.freelancer_price.length>0){
                $scope.readListOfFreelancer();
//                $scope.selected_freelancers=[];
//                $scope.form.selectFl=[];
//                $scope.select_fl_key=[];
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

        $scope.haveFreelancer = function(code){
            if($scope.freelancers.length>0){
                for (var i = 0; i < $scope.freelancers.length; i++) {
                    if($scope.freelancers[i].fid==code){
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
			$scope.form.job_category_id = $scope.job_category.id;
			$scope.form.attach_file = [];
			$scope.form.selectFlInfo = [];
            $scope.form.freelancer_price = [];
            $scope.form.skill_tags_id = [];
            $scope.selected_freelancers =[];
            $scope.form.selectFl =[];

            for(var i=0;i<fl_key.length;i++){
                $scope.selected_freelancers.push($scope.freelancers[fl_key[i]]);
                $scope.form.selectFl.push($scope.freelancers[fl_key[i]].fid);
                $scope.form.selectFlInfo.push($scope.freelancers[fl_key[i]]);
            }
            for (var j=0; j<$scope.tmp_skill_tag.length; j++) {
                $scope.form.skill_tags_id.push($scope.tmp_skill_tag[j].id);
            }
            for (var j=0; j<$scope.tmp_freelancer_price.length; j++) {
                $scope.form.freelancer_price.push($scope.tmp_freelancer_price[j].text);
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
            $scope.saveButtonFlag = 0;
            $scope.loadingSmallButtonFlag = 1;

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


        $('.pagination a').live('click', function (event) {
            event.preventDefault();
            if ( $(this).attr('href') != '#' ) {
                $("html, body").animate({ scrollTop: 0 }, "fast");

                $('#ajaxContent').hide();
                $("#loadingFlag").show();
                var f_skills = $("#skill_tags_id").val();
                var f_price = $("#freelancer_price").val();

                $('#ajaxContent').load($(this).attr('href'),{cat_id:$scope.job_category.id,skill_tags_id:f_skills,freelancer_price:f_price},function(e){
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

        $("#find_again").on('click',function(e){
            $('#ajaxContent').hide();
            $("#loadingFlag").show();

            var f_skills = $("#skill_tags_id").val();
            var f_price = $("#freelancer_price").val();
            $('#ajaxContent').load(BASE+'search/freelancers-list',{cat_id:$scope.job_category.id,skill_tags_id:f_skills,freelancer_price:f_price},function(e){
                if(e!=""){
                    $("#loadingFlag").hide();
                    $('#ajaxContent').show();
                    for(var i=0;i<fl_key.length;i++){
                        $('#select_freelancer'+fl_key[i]).attr('checked',true);
                    }
                }
            });
        });
		
}]);

var ModalInstanceCtrl = function ($scope, $modalInstance) {

    $scope.ok = function () {
        $modalInstance.dismiss('cancel');
    };
};

jobPostApp.filter('dateFormat', function($filter){
    return function(input)
    {
        if(input == null){ return ""; }

        var _date = $filter('date')(new Date(input), 'MMM dd yyyy');

        return _date.toUpperCase();

    };
});

/*-----------------------------------------------End Create job ------------------------------------------------------*/

/*-----------------------------------------------Start Edit job ------------------------------------------------------*/

jobPostApp.controller('editJobController',['$scope','$http','$location','$anchorScroll','FileUploader',
    function($scope,$http,$location,$anchorScroll,FileUploader){
		$scope.skills = [];
        $scope.customSelection = function($data){
            for (var i=0; i<$data.length; i++) {

                $scope.skills.push({"id":$data[i].id,"text":$data[i].category_name});
            }

        };

        $scope.job_categories = job_categories;
        $scope.customSelection(skills);
        $scope.tmpSkills = {};

        $scope.form={};
        $scope.form._token = token;
        $scope.form.id = job_post.id;
        $scope.form.job_category_id = job_post.job_category_id;
        $scope.form.title = job_post.title;
        $scope.form.description = job_post.description;
        $scope.form.skill_tag = select_skills;
//        $scope.attach_file_name = job_post.attach_file;


//        $scope.attach_file = [];

        $scope.multiSelection = {
            'multiple': true,
            query: function (query) {
                query.callback({ results: $scope.skills });
            },
            initSelection: function(element, callback) {
                
            }
        };

        $scope.updateJobPost = function(){
             $scope.errorMsg = '';
             $scope.successMsg = '';
			 for (var i=0; i<$scope.form.skill_tag.length; i++) {				
                $scope.form.skill_tag[i]=$scope.form.skill_tag[i].id;
			}
             $http({
                 url : requestPath+'update-job',
                 method: "POST",
                 data: $scope.form
             }).success(function(data,status){

                if((status == 200) && (data.status == 200))
                {
                    //window.location = data.url;
                    $scope.successMsg = data.msg;
                    $scope.form.job_category_id = data.newData.job_category_id;
                    $scope.form.title = data.newData.title;
                    $scope.form.description = data.newData.description;
					$scope.form.skill_tag = data.select_skills;

                }else{
                    $scope.errorMsg = data.msg;

                    $location.hash('top');
                    $anchorScroll();

                }
             });

            return false;
        };

//        $scope.onFileSelect= function($files){
//			$scope.successMsg ='';
//			$scope.errorMsg ='';
//			console.log($files);
//			//$files: an array of files selected, each file has name, size, and type.
//			for (var i = 0; i < $files.length; i++) {
//				var file = $files[i];
//				$scope.upload = $upload.upload({
//					url: requestPath+'upload-file', //upload.php script, node.js route, or servlet url
//					method: 'POST',
//					//headers: {'header-key': 'header-value'},
//					//withCredentials: true,
//					//headers: { 'Content-Type' : 'application/json' },
//					data: {id: $scope.form.id},
//					file: file, // or list of files ($files) for html5 only
//					//fileName: 'doc.jpg' or ['1.jpg', '2.jpg', ...] // to modify the name of the file(s)
//					// customize file formData name ('Content-Disposition'), server side file variable name.
//					//fileFormDataName: myFile, //or a list of names for multiple files (html5). Default is 'file'
//					// customize how data is added to formData. See #40#issuecomment-28612000 for sample code
//					//formDataAppender: function(formData, key, val){}
//				}).progress(function(evt) {
//					console.log('percent: ' + parseInt(100.0 * evt.loaded / evt.total));
//				}).success(function(data, status, headers, config) {
//					// file is uploaded successfully
//					//console.log(data);
//					if((status == 200) && (data.status == 200))
//					{
//						//window.location = data.url;
//						$scope.successMsg = data.msg;
//						$scope.attach_file_name=JSON.parse(data.newData);
//					}else{
//						$scope.errorMsg = data.msg;
//
//						$location.hash('top');
//						$anchorScroll();
//
//					}
//				});
//				//.error(...)
//				//.then(success, error, progress);
//				// access or attach event listeners to the underlying XMLHttpRequest.
//				//.xhr(function(xhr){xhr.upload.addEventListener(...)})
//			}
//			/* alternative way of uploading, send the file binary with the file's content-type.
//			   Could be used to upload files to CouchDB, imgur, etc... html5 FileReader is needed.
//			   It could also be used to monitor the progress of a normal http post/put request with large data*/
//			// $scope.upload = $upload.http({...})  see 88#issuecomment-31366487 for sample code.
//        };
		
		$scope.deleteFile = function($index){
             $scope.errorMsg = '';
             $scope.successMsg = '';
             $http({
                 url : requestPath+'delete-file',
                 method: "POST",
                 data: {id:$scope.form.id, file_name:$scope.attach_file[$index]}
             }).success(function(data,status){
				
                if((status == 200) && (data.status == 200))
                {
                    //window.location = data.url;
                    $scope.successMsg = data.msg;
                    $scope.attach_file.splice($index,1);
                    $scope.job_post.attach_file.splice($index,1);
//					$scope.attach_file=JSON.parse(data.newData);

                }else{
                    $scope.errorMsg = data.msg;

                    $location.hash('top');
                    $anchorScroll();

                }
             });

            return false;
        };
}]);

/*-----------------------------------------------End Edit job ------------------------------------------------------*/

/*-----------------------------------------------Start View job ------------------------------------------------------*/

jobPostApp.controller('jobViewController',['$scope','$http','$location','$anchorScroll','FileUploader','$sce','$modal',
    function($scope,$http,$location,$anchorScroll,FileUploader,$sce,$modal){
        $scope.job_post = job_post;
        $scope.job_post.balance_hour = $scope.job_post.hour;
        $scope.select_skills = select_skills;
        $scope.clients = clients;
        $scope.skills = skills;
        $scope.job_prices = job_prices;
        $scope.fileUploadFlag = 0;
		$scope.editJobPostFlag = 0;
        $scope.newJobOffer = 0;
        $scope.jobOfferFormFlag = 0;
        $scope.jobOfferListFlag = 1;
        $scope.jobPhaseFormFlag = 0;
        $scope.statusFormFlag = 0;
        $scope.addFreelancerFlag = 0;
        $scope.authenticateUserInfo = authenticateUserInfo;
        $scope.jobRequestFreelancer = requested_freelancer;

        $scope.accJOffer = [];
        $scope.accJOfferPhase = [];

		$scope.form={};
		$scope.form.id = job_post.code;
        $scope.form.title = job_post.title;
        $scope.form.description = job_post.description;
		$scope.form.hour = job_post.hour;
        $scope.form.client_id = job_post.client_id;
        $scope.form.job_status = job_post.job_status;

        $scope.form.jobOffer={};
        $scope.form.jobOfferComment={};
        $scope.form.jobOfferStatus={};
        $scope.form.search = {};
        $scope.freelancers = {};
        $scope.selectFreelancer = [];

        $scope.jobPostLoadingFlag = 0;
        $scope.jobPostSaveButtonFlag = 1;

        $scope.commentLoadingFlag = 0;
        $scope.commentSaveButtonFlag = 1;

        $scope.phaseLoadingFlag = 0;
        $scope.phaseSaveButtonFlag = 1;

        $scope.jobOfferLoadingFlag = 0;
        $scope.jobOfferSaveButtonFlag = 1;

        $scope.jobOfferULoadingFlag = 0;
        $scope.jobOfferUButtonFlag = 1;

        $scope.searchJOCButtonFlag = 0;
        $scope.searchJOLFlag =0;
        $scope.searchJOSButtonFlag = 0;

        $scope.phaseEditableFieldFlag = 1;

        $scope.myHTML = "";

        removeHtmlStorage('mySelection');


        $scope.openFlagJobOfferAcc= function(){
            for(var i=0;i<$scope.job_post.job_offer.length;i++){
                if($scope.job_post.job_offer[i].job_offer_status=='Progress'){
                    $scope.accJOffer.push(true);
                }
                else
                    $scope.accJOffer.push(false);
                var tmpPh = [];
                for(var j=0;j<$scope.job_post.job_offer[i].job_phase.length;j++){
                    if($scope.job_post.job_offer[i].job_phase[j].phase_payment_status=='Progress'){
                        tmpPh.push(true);
                    }else{
                        tmpPh.push(false);
                    }
                }
                $scope.accJOfferPhase.push(tmpPh);
                //console.log($scope.accJOffer);
                //console.log(tmpPh);
                //console.log($scope.accJOfferPhase);
            }
        };
        $scope.openFlagJobOfferAcc();

        $scope.checkSelectClient = function(cid,jcid){
            console.log('C:'+cid);
            console.log('JC:'+jcid);
            //console.log(cid==jcid);
            if(cid==jcid)
                return true;
            return false;
        };

		$scope.formatDate = function($data){

            var input = $data;
            var newDate = input.replace(/(.+) (.+)/, "$1T$2Z");

            return newDate;
        };

        $scope.open = function($event) {
            $event.preventDefault();
            $event.stopPropagation();

            $scope.opened = true;
        };

        $scope.openStart = function($event) {
            $event.preventDefault();
            $event.stopPropagation();
            console.log($event);
            $scope.openedStart = true;
        };
			
		$scope.uploader = new FileUploader({
            url: requestPath+'upload-file',
            autoUpload: true,
            formData: [{id:$scope.job_post.code}],//{id:$scope.job_post.code},
            onProgressItem: function(fileItem, progress) {
                //console.info('onProgressItem', fileItem, progress);
            },
            onSuccessItem: function(fileItem, response, status, headers) {
                //console.info('onSuccessItem', fileItem, response, status, headers);
//                $scope.job_post.attach_file = response.newData;
                $scope.job_post.attach_file=JSON.parse(response.newData);
				//console.log($scope.client_info);
            },
            onCompleteAll: function() {
                //console.info('onCompleteAll');
            }
        });
		
		$scope.updateJobPost = function(){
            $scope.jobPostSaveButtonFlag = 0;
            $scope.jobPostLoadingFlag = 1;
             $scope.errorMsg = '';
             $scope.form.description = angular.element("#description").val();
             $http({
                 url : requestPath+'update-job',
                 method: "POST",
                 data: $scope.form
             }).success(function(data,status){

                if((status == 200) && (data.status == 200))
                {
                    window.location.reload();
                    //window.location = data.url;
                    $scope.form.title = data.newData.title;
                   // $scope.form.description = data.newData.description;
					$scope.form.hour = data.newData.hour;
                    $scope.form.client_id = data.newData.client_id;

                    $scope.job_post.title = data.newData.title;
                    $scope.job_post.description = data.newData.description;
                    $scope.job_post.hour = data.newData.hour;
                    $scope.job_post.client_id = data.newData.client_id;
                    $scope.job_post.balance_hour =  data.newData.hour;
                    $scope.editJobPostFlag = 0;
                }else{
                    $scope.errorMsg = data.msg;

                    $location.hash('top');
                    $anchorScroll();

                }
                 $scope.jobPostLoadingFlag = 0;
                 $scope.jobPostSaveButtonFlag = 1;
             });

             return false;
        };

        $scope.givenTesCount=function($index){
            var count = 0;
            for (var i = 0; i < $scope.jobRequestFreelancer[$index].freelancer.skills.length; i++) {
                if($scope.jobRequestFreelancer[$index].freelancer.skills[i].test_taken==1 && $scope.jobRequestFreelancer[$index].freelancer.skills[i].score!=null)
                    count++;
            }
            return count;
        };

        $scope.updateJobOfferPost = function(){
            $scope.jobOfferUButtonFlag = 0;
            $scope.jobOfferULoadingFlag = 1;
            $scope.errorMsg = '';
            $scope.form.jobOffer.job_post_id = $scope.job_post.id;

            $http({
                url : BASE+'jobOffer/update',
                method: "POST",
                data: $scope.form.jobOffer
            }).success(function(data,status){

                if((status == 200) && (data.status == 200))
                {
                    $scope.jobOfferFormFlag = 0;
                    $scope.job_post.job_offer[$scope.form.jobOffer.jo_index_id]=data.newData;
                    $scope.form.jobOffer = {};
                }else{
                    $scope.errorMsg = data.msg;

                    $location.hash('middle');
                    $anchorScroll();

                }
                $scope.jobOfferULoadingFlag = 0;
                $scope.jobOfferUButtonFlag = 1;
            });

            return false;
        };

        $scope.toggleMin = function() {
            $scope.minDate = $scope.minDate ? null : new Date();
        };
        $scope.toggleMin();

        $scope.addJobOfferPhase = function(){
            $scope.phaseSaveButtonFlag = 0;
            $scope.phaseLoadingFlag = 1;
            $scope.phaseErrorMsg = '';
            if($scope.form.jobPhase.phase_start instanceof Date)
            {
                var myDate = $scope.form.jobPhase.phase_start;
                $scope.form.jobPhase.phase_start = myDate.getFullYear() + '-' + (myDate.getUTCMonth()+1) + '-' + myDate.getDate();
            }

            if($scope.form.jobPhase.phase_deadline instanceof Date)
            {
                var myDate = $scope.form.jobPhase.phase_deadline;
                $scope.form.jobPhase.phase_deadline = myDate.getFullYear() + '-' + (myDate.getUTCMonth()+1) + '-' + myDate.getDate();
            }

            $http({
                url : BASE+'jobPhase/add',
                method: "POST",
                data: $scope.form.jobPhase
            }).success(function(data,status){

                if((status == 200) && (data.status == 200))
                {
                    $scope.jobPhaseFormFlag = 0;
                    if($scope.form.jobPhase.jph_index_id==undefined)
                        $scope.job_post.job_offer[$scope.form.jobPhase.jo_index_id].job_phase.push(data.newData);
                    else
                        $scope.job_post.job_offer[$scope.form.jobPhase.jo_index_id].job_phase[$scope.form.jobPhase.jph_index_id]=data.newData;

                    $scope.form.jobPhase = {};
                    $scope.phaseSaveButtonFlag = 1;
                }else{
                    $scope.phaseErrorMsg = data.msg;

                    $location.hash('middle');
                    $anchorScroll();
                    $scope.phaseSaveButtonFlag = 1;
                }
                $scope.phaseLoadingFlag = 0;
            });

            return false;
        };

        $scope.balanceHour = function(){
            var tmp_hour=0;
            var balance_hour = 0;
            if($scope.job_post.job_offer.length>0){
                for(var i=0;i<$scope.job_post.job_offer.length;i++){
                    tmp_hour += +$scope.job_post.job_offer[i].job_offer_hour;
                }
            }
            balance_hour = $scope.job_post.hour-tmp_hour;
            $scope.job_post.balance_hour = balance_hour;
            return balance_hour;
        };
        $scope.offerPriceCalculate = function(){
            var h = $scope.form.jobOffer.job_offer_hour;
            var offer_price = 0;
            offer_price=h*$scope.form.jobOffer.freelancer_price;

            $scope.job_post.balance_hour = 0;
            if($scope.job_post.job_offer.length>0){
                for(var i=0;i<$scope.job_post.job_offer.length;i++){
                    if($scope.form.jobOffer.jo_index_id!=i){
                        $scope.job_post.balance_hour += +$scope.job_post.job_offer[i].job_offer_price;
                    }
                }
            }
            $scope.job_post.balance_hour += +offer_price;

//            if($scope.job_post.balance_hour>$scope.job_post.hour){
//                alert("Your job offer price has been greater then your total job cost.Please update your total job cost.");
//                $scope.form.jobOffer.job_offer_hour = "";
//                $scope.form.jobOffer.job_offer_price = "";
//            }else{
                $scope.form.jobOffer.job_offer_price = offer_price;
//            }
        }
        $scope.phasePriceCalculate =function(){
            var h = $scope.form.jobPhase.phase_hour;
            var t_h = 0;
            var phase_price = h*$scope.job_post.job_offer[$scope.form.jobPhase.jo_index_id].freelancer.freelancer_price;

            if($scope.job_post.job_offer[$scope.form.jobPhase.jo_index_id].job_phase.length>0){
                for(var i=0;i<$scope.job_post.job_offer[$scope.form.jobPhase.jo_index_id].job_phase.length;i++){
                    if($scope.form.jobPhase.jph_index_id!=i){
                        t_h += +$scope.job_post.job_offer[$scope.form.jobPhase.jo_index_id].job_phase[i].phase_hour;
                    }
                }
            }
            t_h+= +h;
            if(t_h>$scope.job_post.job_offer[$scope.form.jobPhase.jo_index_id].job_offer_hour){
                alert("Your job phase hour has been greater then your job offer hr.Please update your total job offer hour.");
//                $scope.openModal('Warning!',"Your job phase hour has been greater then your job offer hr.Please update your total job offer hour.");
                $scope.form.jobPhase.phase_hour = "";
                $scope.form.jobPhase.phase_price = "";
            }else{
                $scope.form.jobPhase.phase_price = phase_price;
            }
        }
        $scope.editJobOffer = function(index){
            $scope.jobOfferFormFlag=1;
            $scope.jobPhaseFormFlag=0;
            $scope.statusFormFlag=0;
            $scope.form.jobOffer = {};
            $scope.form.jobOffer.jo_index_id = index;
            $scope.form.jobOffer.id = $scope.job_post.job_offer[index].id;
            $scope.form.jobOffer.freelancer_id = $scope.job_post.job_offer[index].freelancer_id;
            $scope.form.jobOffer.freelancer_price = $scope.job_post.job_offer[index].freelancer.freelancer_price;
            $scope.form.jobOffer.title = $scope.job_post.job_offer[index].title;
            $scope.form.jobOffer.description = $scope.job_post.job_offer[index].description;
            $scope.form.jobOffer.job_offer_hour = $scope.job_post.job_offer[index].job_offer_hour;
            $scope.form.jobOffer.job_offer_price = $scope.job_post.job_offer[index].job_offer_price;
            $scope.form.jobOffer.job_offer_status = $scope.job_post.job_offer[index].job_offer_status;
            $location.hash('middle');
            $anchorScroll();
        }
        $scope.editJobPhase = function(jo_index,jph_index){
            $scope.jobPhaseFormFlag=1;
            $scope.statusFormFlag=0;
            $scope.jobOfferFormFlag=0;
            $scope.form.jobPhase = {};
            $scope.form.jobPhase.jph_index_id = jph_index;
            $scope.form.jobPhase.jo_index_id = jo_index;
            $scope.form.jobPhase.id = $scope.job_post.job_offer[jo_index].job_phase[jph_index].id;
            $scope.form.jobPhase.job_offer_id = $scope.job_post.job_offer[jo_index].job_phase[jph_index].job_offer_id;
            $scope.form.jobPhase.phase_title = $scope.job_post.job_offer[jo_index].job_phase[jph_index].phase_title;
            $scope.form.jobPhase.phase_price = $scope.job_post.job_offer[jo_index].job_phase[jph_index].phase_price;
            $scope.form.jobPhase.phase_hour = $scope.job_post.job_offer[jo_index].job_phase[jph_index].phase_hour;
            $scope.form.jobPhase.phase_payment_status = $scope.job_post.job_offer[jo_index].job_phase[jph_index].phase_payment_status;
            $scope.form.jobPhase.phase_start = $scope.job_post.job_offer[jo_index].job_phase[jph_index].phase_start;
            $scope.form.jobPhase.phase_deadline = $scope.job_post.job_offer[jo_index].job_phase[jph_index].phase_deadline;
            $scope.form.jobPhase.phase_details = $scope.job_post.job_offer[jo_index].job_phase[jph_index].phase_details;

//            console.log($scope.form.jobPhase);
            $scope.checkPhaseEditableField(jo_index,jph_index);
            $location.hash('middle');
            $anchorScroll();
        };

        $scope.checkPhaseEditableField = function(jo_index,jph_index){
//            console.log($scope.job_post.job_offer[jo_index].job_phase[jph_index].phase_payment_status);
            if(($scope.job_post.job_offer[jo_index].job_phase[jph_index].phase_payment_status=='Done'||
                $scope.job_post.job_offer[jo_index].job_phase[jph_index].phase_payment_status=='Hold' ||
                $scope.job_post.job_offer[jo_index].job_phase[jph_index].phase_payment_status=='Waiting' ||
                $scope.job_post.job_offer[jo_index].job_phase[jph_index].phase_payment_status=='Progress') &&
                $scope.authenticateUserInfo.user_type=='Client')
                $scope.phaseEditableFieldFlag = 0;
            else
                $scope.phaseEditableFieldFlag = 1;
        };

        $scope.openJobPhaseForm = function($index,joffer_id){
            $scope.jobPhaseFormFlag=1;
            $scope.jobOfferFormFlag=0;
            $scope.statusFormFlag=0;
            $scope.form.jobPhase = {};
            $scope.form.jobPhase.job_offer_id = joffer_id;
            $scope.form.jobPhase.jo_index_id = $index;
            $scope.form.jobPhase.phase_payment_status ='Pending';
            $scope.phaseEditableFieldFlag = 1

            $location.hash('middle');
            $anchorScroll();
        };
        $scope.statusForm = function(index){
            $scope.statusFormFlag=1;
            $scope.jobPhaseFormFlag=0;
            $scope.jobOfferFormFlag=0;
            $scope.form.jobOfferStatus.jo_index_id = index;
            $scope.form.jobOfferStatus.id = $scope.job_post.job_offer[index].id;
            $location.hash('middle');
            $anchorScroll();
        };
        $scope.updateJobOfferStatus = function(){
            $scope.errorMsgStatus = '';

            $http({
                url : BASE+'jobOffer/status-update',
                method: "POST",
                data: $scope.form.jobOfferStatus
            }).success(function(data,status){

                if((status == 200) && (data.status == 200))
                {
                    $scope.job_post.job_offer[$scope.form.jobOfferStatus.jo_index_id].job_offer_status = data.newData.job_offer_status;
                    $scope.job_post.job_offer[$scope.form.jobOfferStatus.jo_index_id].job_offer_status_reason = data.newData.job_offer_status_reason;
                    $scope.job_post.job_status = data.newData.job_offer_status;
                    $scope.statusFormFlag=0;
                }else{
                    $scope.errorMsgStatus = data.msg;

                    $location.hash('status_form');
                    $anchorScroll();

                }
            });

            return false;
        };
        $scope.checkPermission=function(index_jo){
            if($scope.authenticateUserInfo.user_type=="Client"){
                if($scope.job_post.job_offer[index_jo].job_offer_status=='Canceled' || $scope.job_post.job_offer[index_jo].job_offer_status=='Declined'){
                    return false
                }else
                    return true;
            }
            else
                return true;
        };

        $scope.checkPhasePermission=function(index_jo,jph_index){
            if($scope.job_post.job_offer[index_jo].job_phase[jph_index].phase_payment_status=='Done')
                return 0;
            return 1;
        };

        $scope.showNewJobOffer = function(){
            $scope.newJobOffer=1;
            $scope.searchJOSButtonFlag = 1;
            $scope.jobOfferListFlag=0;
            $scope.fileUploadFlag=0;
            $scope.form.jobOffer={};
            $scope.selectFreelancer=[];
            $scope.freelancers = [];
        }
        $scope.showFreelancerList = function(){
            $scope.form.search.job_id = $scope.job_post.id;
            $scope.form.search.skill_tags_id = [];
            $scope.form.search.tmp_skill_tags_id = [];
            $scope.form.search.tmp_freelancer_price = [];
            $scope.form.search.freelancer_price = [];

            for (var i = 0; i < $scope.job_post.price_range.length; i++) {
                $scope.form.search.tmp_freelancer_price.push($scope.job_post.price_range[i]);
                $scope.form.search.freelancer_price.push($scope.job_post.price_range[i]);
            }
            for (var i = 0; i < $scope.job_post.related_tags.length; i++) {
                $scope.form.search.tmp_skill_tags_id.push($scope.job_post.related_tags[i].skill_tags_id);
                $scope.form.search.skill_tags_id.push($scope.job_post.related_tags[i].skill_tags_id);
            }
            $scope.searchJOLFlag = 1;
            $scope.searchJOCButtonFlag = 1;
            $scope.readListOfFreelancer();
        };

        $scope.resetFreelancerList = function(){
            $scope.addFreelancerFlag=0;
            $scope.searchJOLFlag = 0;
            $scope.searchJOCButtonFlag =0;
            $scope.freelancers = [];
            $("#ajaxContent").hide();
        };

        $scope.searchFreelancers = function(){
            $scope.addFreelancerFlag = 0;
            $scope.searchJOLFlag = 1;

            if($scope.form.search.tmp_freelancer_price.length>0){
                for (var i = 0; i < $scope.form.search.tmp_freelancer_price.length; i++) {
                    if($scope.form.search.freelancer_price.indexOf(parseInt($scope.form.search.tmp_freelancer_price[i]))==-1){
                        $scope.form.search.freelancer_price.push(parseInt($scope.form.search.tmp_freelancer_price[i]));
                    }
                }
            }
            if($scope.form.search.tmp_skill_tags_id.length>0){
                for (var i = 0; i < $scope.form.search.tmp_skill_tags_id.length; i++) {
                    if($scope.form.search.skill_tags_id.indexOf(parseInt($scope.form.search.tmp_skill_tags_id[i]))==-1){
                        $scope.form.search.skill_tags_id.push(parseInt($scope.form.search.tmp_skill_tags_id[i]));
                    }
                }
            }
//            console.log($scope.form.search);
            $scope.readListOfFreelancer();
        };
        $scope.readListOfFreelancer = function(){
            $http({
                url : BASE + 'search/new-job-offer-freelancer-list',
                method: "POST",
                data: $scope.form.search
            }).success(function(data,status){
                if((status == 200) && (data.status == 200))
                {
                    $scope.freelancers = data.freelancersList;
                    $scope.totalFreelancers = data.totalFreelancers;
                    $scope.searchJOLFlag = 0;
                    $scope.addFreelancerFlag = 1;
                }else{
                    $scope.errorMsg = data.msg;

                    $location.hash('middle');
                    $anchorScroll();

                }
            });
        };

        $scope.givenTesCount=function($index){
            var count = 0;
            for (var i = 0; i < $scope.freelancers[$index].skills.length; i++) {
                if($scope.freelancers[$index].skills[i].test_taken==1 && $scope.freelancers[$index].skills[i].score!=null)
                    count++;
            }
            return count;
        };

        $scope.freelancerSelection = function($index){
            $scope.selectFreelancer = [];
            $scope.selectFreelancer.push($scope.freelancers[$index]);
        }

        $scope.selectFreelancer = function(){
            $scope.selectFreelancer = [];
            var index = $(this);
            //console.log(index);
            $scope.selectFreelancer.push(index); //
        }

        $scope.removeFreelancer=function($index){
            $scope.selectFreelancer = [];
            $scope.form.jobOffer.job_offer_hour = "";
            $scope.form.jobOffer.job_offer_price = "";
        };
        $scope.showFreelancer = function(code){
            if($scope.selectFreelancer[0].code==code){
                return 1;
            }
        };

        $scope.addJobOffer = function(){
//            console.log(window.location);
            $scope.jobOfferSaveButtonFlag = 0;
            $scope.jobOfferLoadingFlag= 1;
            $scope.errorMsg = '';
            $scope.form.jobOffer.job_post_id = $scope.job_post.id;
            if($scope.selectFreelancer != undefined && $scope.selectFreelancer.length>0)
                $scope.form.jobOffer.freelancer_id = $scope.selectFreelancer[0].fid;
            else
                $scope.form.jobOffer.freelancer_id ="";
            $scope.form.jobOffer.description = angular.element('#jo_description').val();

            $http({
                url : BASE+'jobOffer/new-job-offer',
                method: "POST",
                data: $scope.form.jobOffer
            }).success(function(data,status){

                if((status == 200) && (data.status == 200))
                {
                    $scope.newJobOffer = 0;
                    if(data.dataFlag=='new')
                        $scope.job_post.job_offer.push(data.newData);
                    else
                        window.location = window.location.href;

                    $scope.form.jobOffer = {};
                }else{
                    $scope.errorMsg = data.msg;

                    $location.hash('middle');
                    $anchorScroll();

                }
                $scope.jobOfferLoadingFlag= 0;
                $scope.jobOfferSaveButtonFlag = 1;
                $scope.jobOfferListFlag = 1;
            });

            return false;
        };

        $scope.newOfferPriceCalculate = function(){
            var h = $scope.form.jobOffer.job_offer_hour;
            var offer_price = 0;
            if($scope.selectFreelancer!=undefined && $scope.selectFreelancer.length>0){
                offer_price=h*$scope.selectFreelancer[0].freelancer_price;
                $scope.form.jobOffer.job_offer_price = offer_price;
            }else{
                $scope.form.jobOffer.job_offer_price = "";
                $scope.form.jobOffer.job_offer_hour = "";
                $scope.openModal('Warning!',"Please select freelancer first");
            }
        };

        $scope.addJobOfferComment =function(jo_index){
            $scope.commentSaveButtonFlag = 0;
            $scope.commentLoadingFlag = 1;

            $scope.form.jobOfferComment.jobthread_id = $scope.job_post.job_offer[jo_index].id;
            $scope.form.jobOfferComment.jobthread_type = 'JobOffer';
            if($scope.form.jobOfferComment.message !="" && $scope.form.jobOfferComment.message != undefined){
                $http({
                    url : BASE+'jobOffer/add-comment',
                    method: "POST",
                    data: $scope.form.jobOfferComment
                }).success(function(data,status){

                    if((status == 200) && (data.status == 200))
                    {
                        $scope.job_post.job_offer[jo_index].comments.push(data.newData);
                        $scope.form.jobOfferComment = {};
                        $scope.commentSaveButtonFlag = 1;
                    }else{
                        $scope.errorMsg = data.msg;

                        $location.hash('middle');
                        $anchorScroll();
                        $scope.commentSaveButtonFlag = 1;
                    }

                    $scope.commentLoadingFlag = 0;
                });
            }else{
                $scope.openModal('Warning!','Sorry! Please fillup comment field.');
                $scope.commentSaveButtonFlag = 1;
                $scope.commentLoadingFlag = 0;
            }

            return false;
        };

        $scope.deleteFile = function($index){
            $scope.errorMsg = '';
            $scope.successMsg = '';
            $http({
                url : requestPath+'delete-file',
                method: "POST",
                data: {id:$scope.form.id, file_name:$scope.job_post.attach_file[$index]}
            }).success(function(data,status){

                if((status == 200) && (data.status == 200))
                {
                    //window.location = data.url;
                    $scope.successMsg = data.msg;
					$scope.job_post.attach_file=JSON.parse(data.newData);

                }else{
                    $scope.errorMsg = data.msg;

                    $location.hash('top');
                    $anchorScroll();

                }
            });

            return false;
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

        $scope.openModal = function($title,$msg)
        {
            var dlgHtml  = '';
            /*dlgHtml += '<form id="uploadPicFrm" method="post" action="'+BASE+'freelancer/upload-photo" enctype="multipart/form-data">*/
            dlgHtml += '<div class="modal-header">';
            dlgHtml += '<h3 class="modal-title">'+$title+'</h3></div>';
            /*dlgHtml += '</div>';*/
            dlgHtml += '<div class="modal-body">';
            dlgHtml +=  $msg;
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

        $("#find_again").on('click',function(e){
            $('#ajaxContent').hide();
            $("#searchJOLFlag").show();

            $scope.form.search.job_id = $scope.job_post.id;
            $scope.form.search.skill_tags_id = [];
            $scope.form.search.tmp_skill_tags_id = [];
            $scope.form.search.tmp_freelancer_price = [];
            $scope.form.search.freelancer_price = [];

            for (var i = 0; i < $scope.job_post.price_range.length; i++) {
                $scope.form.search.tmp_freelancer_price.push($scope.job_post.price_range[i]);
                $scope.form.search.freelancer_price.push($scope.job_post.price_range[i]);
            }
            for (var i = 0; i < $scope.job_post.related_tags.length; i++) {
                $scope.form.search.tmp_skill_tags_id.push($scope.job_post.related_tags[i].skill_tags_id);
                $scope.form.search.skill_tags_id.push($scope.job_post.related_tags[i].skill_tags_id);
            }

            var f_skills = $scope.form.search.skill_tags_id;
            var f_price = $scope.form.search.freelancer_price;

            $('#ajaxContent').load(BASE+'search/job-offer-freelancers-list',{job_id:$scope.job_post.id,skill_tags_id:f_skills,freelancer_price:f_price},function(e){
                if(e!=""){
                    $("#searchJOLFlag").hide();
                    $('#ajaxContent').show();
                }
            });
        });

        $('.pagination a').live('click', function (event) {
            event.preventDefault();
            if ( $(this).attr('href') != '#' ) {
                $("html, body").animate({ scrollTop: 0 }, "fast");

                $('#ajaxContent').hide();
                $("#searchJOLFlag").show();
                var f_skills = $scope.form.search.skill_tags_id;
                var f_price = $scope.form.search.freelancer_price;

                $('#ajaxContent').load($(this).attr('href'),{job_id:$scope.job_post.id,skill_tags_id:f_skills,freelancer_price:f_price},function(e){
                    if(e!=""){
                        $("#searchJOLFlag").hide();
                        $('#ajaxContent').show();
                    }
                });
            }
            return false;
        });

        $('.select-freelancer').live('click',function(e){
            var index = $(this).val();
            $scope.selectFreelancer = [];
            if($(this).is(':checked')){
                $scope.selectFreelancer.push($scope.freelancers[index]);
            }
            console.log($scope.selectFreelancer);
        });
}]);

/*-----------------------------------------------End View job ------------------------------------------------------*/

jobPostApp.directive("timeAgo", function($compile) {
    return {
        restrict: "C",
        link: function(scope, element, attrs) {
            jQuery(element).timeago();
        }
    };
});

jobPostApp.filter("timeAgo", function() {
    return function(date) {
        return jQuery.timeago(date);
    };
});