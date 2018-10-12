/**
 * Created by Himel on 9/1/14.
 */
var clientApp = angular.module('clientApp',['ui.bootstrap','angularFileUpload']);
var requestPath = BASE + 'client/';
clientApp.controller('clientController',['$scope','$http','$location','$anchorScroll','$modal','FileUploader',
    function($scope,$http,$location,$anchorScroll,$modal,FileUploader){
        $scope.client_info = client_info;
        $scope.editClientDetailFlag = 0;
        $scope.editClientContactFlag = 0;
        $scope.changeProfilePictureFlag = 0;
        $scope.countries = countries;
        $scope.destination_path = destination_path;
        
        $scope.form = {};
        $scope.form._token = token;
        $scope.detail = {};
        $scope.contact = {};

        $scope.init=function(){
            $scope.detail.first_name = $scope.client_info.first_name;
            $scope.detail.last_name = $scope.client_info.last_name;
            $scope.detail.profile_title = $scope.client_info.profile_title;
            $scope.detail.description = $scope.client_info.description;

            $scope.contact.country = $scope.client_info.country;
            $scope.contact.address = $scope.client_info.address;
            $scope.contact.address2 = $scope.client_info.address2;
            $scope.contact.city = $scope.client_info.city;
            $scope.contact.province = $scope.client_info.province;
            $scope.contact.postal_code = $scope.client_info.postal_code;
            $scope.contact.contact_number = $scope.client_info.contact_number;

            console.log($scope.client_info);
        };

        $scope.showClientPersonalForm = function(flag){
            $scope.editClientDetailFlag = flag;
        };

        $scope.showClientContactForm = function(flag){
            $scope.editClientContactFlag = flag;
        };

        $scope.showChangePictureForm = function(flag){
            $scope.changeProfilePictureFlag = flag;
        };

        $scope.updateClientDetail = function(){
            $scope.errorMsg = "";
            $scope.form = $scope.detail;
//            console.log($scope.client_info);
            $scope.form.id = $scope.client_info.id;
            console.log($scope.form);
            $http({
                url : requestPath + 'update',
                method: "POST",
                data: $scope.form
            }).success(function(data,status){
                console.log(data);
                console.log(status);
                if((status == 200) && (data.status == 200))
                {
                    $scope.detail.first_name = data.newData.first_name;
                    $scope.detail.last_name = data.newData.last_name;
                    $scope.detail.profile_title = data.newData.profile_title;
                    $scope.detail.description = data.newData.description;

                    $scope.client_info.first_name = data.newData.first_name;
                    $scope.client_info.last_name = data.newData.last_name;
                    $scope.client_info.profile_title = data.newData.profile_title;
                    $scope.client_info.description = data.newData.description;
                    $scope.editClientDetailFlag=0;

                }else{
                    $scope.errorMsg = data.msg;

                    $location.hash('top');
                    $anchorScroll();

                }
            });
        };

        $scope.updateClientContact = function(){
            $scope.errorMsg = "";
            $scope.form = $scope.contact;
            $scope.form.id = $scope.client_info.id;
            $scope.form.first_name = $scope.client_info.first_name;
            $scope.form.last_name = $scope.client_info.last_name;
            $scope.form.profile_title = $scope.client_info.profile_title;
            //console.log($scope.form);
            $http({
                url : requestPath + 'update',
                method: "POST",
                data: $scope.form
            }).success(function(data,status){
                console.log(data);
                console.log(status);
                if((status == 200) && (data.status == 200))
                {
                    $scope.contact.country = data.newData.country;
                    $scope.contact.address = data.newData.address;
                    $scope.contact.address2 = data.newData.address2;
                    $scope.contact.city = data.newData.city;
                    $scope.contact.province = data.newData.province;
                    $scope.contact.postal_code = data.newData.postal_code;
                    $scope.contact.contact_number = data.newData.contact_number;

                    $scope.client_info.country = data.newData.country;
                    $scope.client_info.address = data.newData.address;
                    $scope.client_info.address2 = data.newData.address2;
                    $scope.client_info.city = data.newData.city;
                    $scope.client_info.province = data.newData.province;
                    $scope.client_info.postal_code = data.newData.postal_code;
                    $scope.client_info.contact_number = data.newData.contact_number;

                    $scope.editClientContactFlag=0;

                }else{
                    $scope.errorMsg = data.msg;

                    $location.hash('top');
                    $anchorScroll();

                }
            });
        };

//        $scope.onFileSelect = function($files) {
//            //$files: an array of files selected, each file has name, size, and type.
//            for (var i = 0; i < $files.length; i++) {
//                var file = $files[i];
//                $scope.upload = $upload.upload({
//                    url: 'server/upload/', //upload.php script, node.js route, or servlet url
//                    method: 'POST',// or 'PUT',
//                    //headers: {'header-key': 'header-value'},
//                    //withCredentials: true,
//                    data: {id: $scope.client_info.id},
//                    file: file
//                    // or list of files ($files) for html5 only
//                    //fileName: 'doc.jpg' or ['1.jpg', '2.jpg', ...] // to modify the name of the file(s)
//                    // customize file formData name ('Content-Disposition'), server side file variable name.
//                    //fileFormDataName: myFile, //or a list of names for multiple files (html5). Default is 'file'
//                    // customize how data is added to formData. See #40#issuecomment-28612000 for sample code
//                    //formDataAppender: function(formData, key, val){}
//                }).progress(function(evt) {
//                    console.log('percent: ' + parseInt(100.0 * evt.loaded / evt.total));
//                }).success(function(data, status, headers, config) {
//                    // file is uploaded successfully
//                    console.log(data);
//                });
//                //.error(...)
//                //.then(success, error, progress);
//                // access or attach event listeners to the underlying XMLHttpRequest.
//                //.xhr(function(xhr){xhr.upload.addEventListener(...)})
//            }
//            /* alternative way of uploading, send the file binary with the file's content-type.
//             Could be used to upload files to CouchDB, imgur, etc... html5 FileReader is needed.
//             It could also be used to monitor the progress of a normal http post/put request with large data*/
//            // $scope.upload = $upload.http({...})  see 88#issuecomment-31366487 for sample code.
//        };

        $scope.uploader = new FileUploader({
            url: requestPath+'upload-picture',
            autoUpload: true,
            formData: [{id:$scope.client_info.id}],
            onProgressItem: function(fileItem, progress) {
                //console.info('onProgressItem', fileItem, progress);
                
            },
            onSuccessItem: function(fileItem, response, status, headers) {
                //console.info('onSuccessItem', fileItem, response, status, headers);
                $scope.client_info.photos = response.newData;
                //console.log(response.newData);
                window.location.reload();
				//console.log($scope.client_info);
            },
            onCompleteAll: function() {
                //console.info('onCompleteAll');
            }
        });

        // FILTERS
//
//        $scope.uploader.filters.push({
//            name: 'customFilter',
//            fn: function(item /*{File|FileLikeObject}*/, options) {
//                return this.queue.length < 10;
//            }
//        });

        // CALLBACKS

//        $scope.uploader.onWhenAddingFileFailed = function(item /*{File|FileLikeObject}*/, filter, options) {
//            console.info('onWhenAddingFileFailed', item, filter, options);
//        };
//        $scope.uploader.onAfterAddingFile = function(fileItem) {
//            console.info('onAfterAddingFile', fileItem);
//        };
//        $scope.uploader.onAfterAddingAll = function(addedFileItems) {
//            console.info('onAfterAddingAll', addedFileItems);
//        };
//        $scope.uploader.onBeforeUploadItem = function(item) {
//            console.info('onBeforeUploadItem', item);
//        };
//        $scope.uploader.onProgressItem = function(fileItem, progress) {
//            console.info('onProgressItem', fileItem, progress);
//        };
//        $scope.uploader.onProgressAll = function(progress) {
//            console.info('onProgressAll', progress);
//        };
//        $scope.uploader.onSuccessItem = function(fileItem, response, status, headers) {
//            console.info('onSuccessItem', fileItem, response, status, headers);
//        };
//        $scope.uploader.onErrorItem = function(fileItem, response, status, headers) {
//            console.info('onErrorItem', fileItem, response, status, headers);
//        };
//        $scope.uploader.onCancelItem = function(fileItem, response, status, headers) {
//            console.info('onCancelItem', fileItem, response, status, headers);
//        };
//        $scope.uploader.onCompleteItem = function(fileItem, response, status, headers) {
//            console.info('onCompleteItem', fileItem, response, status, headers);
//        };
//        $scope.uploader.onCompleteAll = function() {
//            console.info('onCompleteAll');
//        };

//        console.info('uploader', $scope.uploader);

}]);

