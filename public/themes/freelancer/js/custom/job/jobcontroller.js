var jobPostApp = angular.module('jobPostApp',['angularFileUpload','ui.select2']);
var requestPath = BASE+'jobPost/'

jobPostApp.controller('myJobListController',['$scope','$http','$location','$anchorScroll','$upload','$filter',
    function($scope,$http,$location,$anchorScroll,$upload,$filter){

    $scope.my_jobs = my_jobs;
    //$scope.job_select_skills = job_select_skills;
    console.log($scope.my_jobs);

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
                    //window.location = data.url;
                    $scope.successMsgList = data.msg;
                    $scope.my_jobs.splice($index,1);
                    //console.log($scope.job_categories);
                }else{
                    $scope.errorMsgList = data.msg;

                    $location.hash('top');
                    $anchorScroll();

                }
            });
        }
    }

    $scope.showData = function($data){
        console.log($data);
    };

    $scope.formatDate = function($index){
        //console.log($data);
        var input = $scope.my_jobs[$index].created_at;
        var newDate = input.replace(/(.+) (.+)/, "$1T$2Z");
        return newDate;
    };

    $scope.wordPrint = function($str,$length){
        var count = 0;
        var mainStr = $str.split(" ");
        var tmpStr = "";

        for (i = 0; i < $length; i++) {
            if (mainStr[i]!==undefined && mainStr[i] != "")
                tmpStr += mainStr[i]+" ";
        }


        return tmpStr;
    }
}]);


jobPostApp.controller('addJobController',['$scope','$http','$location','$anchorScroll','$upload',
    function($scope,$http,$location,$anchorScroll,$upload){
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
        $scope.job_category = {};
        $scope.tmp_freelancer_price={};
        $scope.tmp_skill_tag = [];
        $scope.addFreelancerFlag = 0;

        $scope.form = {};
        $scope.form.freelancer_price=[];
        $scope.form.skill_tags_id=[];
        $scope.total_freelancer=0;
        $scope.form.selectFl = [];


        $scope.init=function(){
            var mySelectionStatus = statusHtmlStorage('mySelection');
            if(mySelectionStatus){
                var data = JSON.parse(localStorage.getItem('mySelection'));
                console.log(data);
                console.log(data[0]);
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
                console.log($scope.tmp_freelancer_price);
                console.log($scope.tmp_skill_tag);
                console.log($scope.form);
                //$scope.form.skill_tags_id=data[0]['form_data']['skill_tags_id'];
                //$scope.form.selectFl = data[0]['form_data']['selectFl'];
            }
            $scope.readListOfFreelancer();

        };

        $scope.removeFreelancer=function($index){
            if($scope.selected_freelancers.length>0){
                $scope.selected_freelancers.splice($index,1);
                $scope.form.selectFl.splice($index,1);
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
            $scope.addFreelancerFlag = flag;
        };

        $scope.showFreelancer = function(code){
            if($scope.form.selectFl.indexOf(code)==-1){
                return 1;
            }
        };

        $scope.readListOfFreelancer = function(){
            console.log($scope.form);
            $http({
                url : BASE + 'search/freelancers-list',
                method: "POST",
                data: $scope.form
            }).success(function(data,status){
                //console.log(data);
                //console.log(status);
                if((status == 200) && (data.status == 200))
                {
                    $scope.freelancers = data.freelancersList;
                    $scope.total_freelancer = data.totalFreelancers;


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
}]);

jobPostApp.controller('editJobController',['$scope','$http','$location','$anchorScroll','$upload',
    function($scope,$http,$location,$anchorScroll,$upload){
		$scope.skills = [];
        $scope.customSelection = function($data){
            for (var i=0; i<$data.length; i++) {
				//console.log($data[i].id);
                $scope.skills.push({"id":$data[i].id,"text":$data[i].category_name});
            }
            //console.log($scope.skills);
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
        $scope.attach_file_name = job_post.attach_file;


        $scope.attach_file = [];        

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

        $scope.onFileSelect= function($files){
			$scope.successMsg ='';
			$scope.errorMsg ='';
			console.log($files);
			//$files: an array of files selected, each file has name, size, and type.
			for (var i = 0; i < $files.length; i++) {
				var file = $files[i];
				$scope.upload = $upload.upload({
					url: requestPath+'upload-file', //upload.php script, node.js route, or servlet url
					method: 'POST',
					//headers: {'header-key': 'header-value'},
					//withCredentials: true,
					//headers: { 'Content-Type' : 'application/json' },
					data: {id: $scope.form.id},
					file: file, // or list of files ($files) for html5 only
					//fileName: 'doc.jpg' or ['1.jpg', '2.jpg', ...] // to modify the name of the file(s)
					// customize file formData name ('Content-Disposition'), server side file variable name. 
					//fileFormDataName: myFile, //or a list of names for multiple files (html5). Default is 'file' 
					// customize how data is added to formData. See #40#issuecomment-28612000 for sample code
					//formDataAppender: function(formData, key, val){}
				}).progress(function(evt) {
					console.log('percent: ' + parseInt(100.0 * evt.loaded / evt.total));
				}).success(function(data, status, headers, config) {
					// file is uploaded successfully
					//console.log(data);
					if((status == 200) && (data.status == 200))
					{
						//window.location = data.url;
						$scope.successMsg = data.msg;
						$scope.attach_file_name=JSON.parse(data.newData);
					}else{
						$scope.errorMsg = data.msg;

						$location.hash('top');
						$anchorScroll();

					}
				});
				//.error(...)
				//.then(success, error, progress); 
				// access or attach event listeners to the underlying XMLHttpRequest.
				//.xhr(function(xhr){xhr.upload.addEventListener(...)})
			}
			/* alternative way of uploading, send the file binary with the file's content-type.
			   Could be used to upload files to CouchDB, imgur, etc... html5 FileReader is needed. 
			   It could also be used to monitor the progress of a normal http post/put request with large data*/
			// $scope.upload = $upload.http({...})  see 88#issuecomment-31366487 for sample code.			
        };
		
		$scope.deleteFile = function($index){
             $scope.errorMsg = '';
             $scope.successMsg = '';
             $http({
                 url : requestPath+'delete-file',
                 method: "POST",
                 data: {id:$scope.form.id, file_name:$scope.attach_file_name[$index]}
             }).success(function(data,status){
				
                if((status == 200) && (data.status == 200))
                {
                    //window.location = data.url;
                    $scope.successMsg = data.msg;
					$scope.attach_file_name=JSON.parse(data.newData);

                }else{
                    $scope.errorMsg = data.msg;

                    $location.hash('top');
                    $anchorScroll();

                }
             });

            return false;
        };
}]);

jobPostApp.controller('jobViewController',['$scope','$http','$location','$anchorScroll','$upload',
    function($scope,$http,$location,$anchorScroll,$upload){
        $scope.job_post = job_post;
        $scope.select_skills = select_skills;
}]);

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