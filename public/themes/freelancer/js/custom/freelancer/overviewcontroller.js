/**
 * Created by Himel on 9/1/14.
 */
var freelancerApp = angular.module('freelancerApp',['ui.bootstrap']);
var requestPath = BASE + 'freelancer/';
freelancerApp.controller('freelancerAppController',['$scope','$http','$location','$anchorScroll','$modal',

    function($scope,$http,$location,$anchorScroll,$modal){

        $scope.user = user;
        $scope.prices = prices;
        $scope.overviewEditable=0;
        $scope.eduEditable=0;
        $scope.certEditable=0;
        $scope.pbsEditable=0;
        $scope.editEducationIndex = '';
        $scope.editCertIndex = '';
        $scope.editPbsIndex = '';
        $scope.successMsg='';

        $scope.Freelancer = Freelancer;

        $scope.Educations = Educations;
        $scope.Certs = Certs;
        $scope.Pbs = Pbs;
        $scope.testTaken = testTaken;

        $scope.tabs = [
            { title:'Step 1',active:true,disabled:false},
            { title:'Step 2',active:false, disabled:true}
        ];


        $scope.form={
            basic: {
                profile_title : '',
                first_name: '',
                last_name : '',
                email :$scope.user.email,
                overview: ''
            },
            contact:{
                mobile : '',
                phone  : '',
                address: ''
            }

        };

        $scope.overviewForm = {
            profile_title: $scope.Freelancer.profile_title,
            overview     : $scope.Freelancer.overview,
            first_name   : $scope.Freelancer.first_name,
            last_name    : $scope.Freelancer.last_name,
            years_of_experience : $scope.Freelancer.years_of_experience,
            freelancer_price : $scope.Freelancer.freelancer_price
        };

        $scope.edu = {
            institute_name: '',
            area_of_study: '',
            start_year: '',
            end_year: '',
            degree: '',
            description: ''
        };

        $scope.pbs = {
            org_name: '',
            org_type: '',
            start_dt: '',
            end_dt: '',
            current_status: '',
            responsibility: '',
            designation: '',
            url: '',
            address: ''

        };

        $scope.skills = MySkills;

        $scope.nextForm = function()
        {
            $scope.errorMsg = [];
            for(var item in $scope.form.basic)
            {

                if($scope.form.basic[item] == "")
                {
                    $scope.errorMsg.push([item.replace('_'," ") + ' is Required']);
                }
            }

            if($scope.errorMsg.length ==0)
            {
                $scope.tabs[1].disabled = false;
                $scope.tabs[0].active = false;
                $scope.tabs[1].active = true;
                $scope.errorMsg = [];
            }


        };

        $scope.confirmAndSave = function()
        {
            $scope.errorMsg = [];
            for(var item in $scope.form.basic)
            {

                if($scope.form.basic[item] == "")
                {
                    $scope.errorMsg.push([item.replace('_'," ") + ' is Required']);
                }
            }
            if($scope.form.contact.address == "")
                $scope.errorMsg.push(['Address is Required']);

            if($scope.form.contact.mobile == "")
                $scope.errorMsg.push(['Mobile number is Required']);

            if($scope.errorMsg.length ==0)
            {
                $scope.errorMsg = [];

                $http({
                    url : BASE + 'freelancer/initiate',
                    method: "POST",
                    data: $scope.form
                }).success(function(response,status){
                    if(response.status == 200 && status == 200)
                    {
                        window.location.reload();

                    }else{
                        $scope.errorMsg=response.msg;
                        $location.hash('top');
                        $anchorScroll();
                    }

                });
            }
        };


        $scope.editOverview = function()
        {
            $scope.overviewEditable = 1;
        };

        $scope.updateOverview = function()
        {
            var result =  $scope.prices.filter(function(item){
                if(item.title != $scope.overviewForm.freelancer_price)
                    return 0;
                else
                    return 1;
            });
            if(result.length)
            {
                $http({
                    url   : requestPath + 'update-overview',
                    method: 'POST',
                    data  : $scope.overviewForm
                }).success(function(response,status){
                    if(response.status==200 && status == 200)
                    {
                        $scope.overviewEditable = 0;
                    }
                });
            }else{
                $scope.errorMsg=[['Price is not valid']];
            }
        };

        $scope.changeStatus = function(changed_val,cfield)
        {
            changed_val = changed_val != true?false:true;
            changed_val = !changed_val;


            $http({
                url : requestPath + 'change-widget-status',
                method: 'POST',
                data : {val:changed_val,field:cfield}
            }).success(function(response,status){

            });
        };
        $scope.getStatus = function($pram){
            if($pram != 0 || $pram != false)
                return true;
            else
                return false;
        };



        $scope.open = function()
        {
            var dlgHtml  = '';
                dlgHtml += '<form id="uploadPicFrm" method="post" action="'+BASE+'freelancer/upload-photo" enctype="multipart/form-data"><div class="modal-header">';
                dlgHtml += '<h3 class="modal-title">Upload Photo</h3>';
                dlgHtml += '</div>';
                dlgHtml += '<div class="modal-body">';
                dlgHtml += '<input type="file" name="photo"/>';
                dlgHtml += '</div>';
                dlgHtml += '<div class="modal-footer">';
                dlgHtml += '<button class="btn btn-primary" type="submit">Upload</button>';
                dlgHtml += '<button class="btn btn-warning" ng-click="cancel()">Cancel</button>';
                dlgHtml += '</div></form>';

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

        /*** Education ***/
        $scope.addEduInfo = function(hideFrm)
        {
            $scope.edu = {
                id : '',
                institute_name: '',
                area_of_study: '',
                start_year: '',
                end_year: '',
                degree: '',
                description: ''
            };
            $scope.editEducationIndex = '';
            $scope.eduEditable = (hideFrm)? 0 : 1;
            if($scope.eduEditable)
            {
                $scope.errorMsg = '';
                $scope.successMsg = '';
            }
        }

        $scope.saveEdu = function()
        {
            $http({
                url : requestPath+'save-edu',
                method: 'POST',
                data: $scope.edu
            }).success(function(data, status){

                    if((status == 200) && (data.status == 200 || data.status == 202))
                    {
                        if(data.status == 200)
                        {
                            $scope.Educations.push(data.result);
                            $scope.successMsg = 'Information added to Education';
                        }

                        if(data.status == 202)
                        {
                            $scope.Educations[$scope.editEducationIndex] = data.result;
                            $scope.successMsg = 'Information updated of education' ;
                        }

                        $scope.addEduInfo(true);
                        $location.hash('top');

                    }else if((status == 200) && (data.status == 400)){
                        $scope.errorMsg = data.msg;

                        $location.hash('topEdu');
                        $anchorScroll();

                    }

            });
        };

        $scope.openUpdateEduFrm = function(index,id)
        {
            $scope.edu = {
                id : $scope.Educations[index].id,
                institute_name: $scope.Educations[index].institute_name,
                area_of_study: $scope.Educations[index].area_of_study,
                start_year: $scope.Educations[index].start_year,
                end_year: $scope.Educations[index].end_year,
                degree: $scope.Educations[index].degree,
                description: $scope.Educations[index].description
            };
            $scope.editEducationIndex = index;
            $scope.eduEditable = 1;
            $scope.successMsg = '';
            $scope.errorMsg = '';
        }

        $scope.removeEdu = function(index,id)
        {
            $http({
               url    : requestPath + 'delete-edu',
               method : 'POST',
               data   : {id:id}
            }).success(function(data,status){
                $scope.Educations.splice(index,1);
            });
        }

        /*** Certification ***/
        $scope.addCertInfo = function(hideFrm)
        {
            $scope.cert = {
                id : '',
                title: '',
                provider: '',
                description: '',
                date_earned: '',
                submission_code_or_link: ''
            };
            $scope.editCertIndex = '';
            $scope.certEditable = (hideFrm)? 0 : 1;
            if($scope.pbsEditable)
            {
                $scope.successMsg = '';
                $scope.errorMsg = '';
            }
        }

        $scope.openDatePicker = function($event) {
            $event.preventDefault();
            $event.stopPropagation();
            $scope.opened = true;
        };

        $scope.saveCert = function()
        {
            if($scope.cert.date_earned instanceof Date)
            {
                var myDate = $scope.cert.date_earned;
                $scope.cert.date_earned = myDate.getFullYear() + '-' + (myDate.getUTCMonth()+1) + '-' + myDate.getDate();
            }
            $http({
                url : requestPath+'save-cert',
                method: 'POST',
                data: $scope.cert
            }).success(function(data, status){

                if((status == 200) && (data.status == 200 || data.status==202))
                {

                    if(data.status == 200)
                    {
                        $scope.Certs.push(data.result);
                        $scope.successMsg = 'Information added to Certifications';
                    }
                    if(data.status == 202)
                    {
                        $scope.Certs[$scope.editCertIndex] = data.result;
                        $scope.successMsg = 'Information updated of Certifications';
                    }

                    $scope.addCertInfo(true);

                    $location.hash('top');
                }else if((status == 200) && (data.status == 400)){
                    $scope.errorMsg = data.msg;

                    $location.hash('topCert');
                    $anchorScroll();

                }

            });
        };

        $scope.openUpdateCertFrm = function(certIndex,id)
        {


            $scope.cert = {
                id : $scope.Certs[certIndex].id,
                title: $scope.Certs[certIndex].title,
                provider: $scope.Certs[certIndex].provider,
                description: $scope.Certs[certIndex].description,
                date_earned: $scope.Certs[certIndex].date_earned.substring(0,10),
                submission_code_or_link: $scope.Certs[certIndex].submission_code_or_link
            };

            $scope.editCertIndex = certIndex;
            $scope.successMsg = '';
            $scope.errorMsg = '';
            $scope.certEditable = 1;
        };


        $scope.removeCert = function(index,id)
        {

            $http({
                url    : requestPath + 'delete-cert',
                method : 'POST',
                data   : {id : id}
            }).success(function(data,status){
                $scope.Certs.splice(index,1);
            });
        };


        /*** professional Background ***/
        $scope.addPbsInfo = function(hideFrm)
        {
            $scope.pbs = {
                id : '',
                org_name: '',
                org_type: '',
                start_dt: '',
                end_dt: '',
                current_status: '',
                responsibility: '',
                designation: '',
                url: '',
                address: ''


            };
            $scope.editPbsIndex = '';
            $scope.pbsEditable = (hideFrm)? 0 : 1;
            if($scope.pbsEditable)
            {
                $scope.successMsg = '';
                $scope.errorMsg = '';
            }
        }

        $scope.start_date_opened =false;
        $scope.end_date_opened   =false;

        $scope.openPbsStartDatePicker = function($event) {
            $event.preventDefault();
            $event.stopPropagation();
            $scope.start_date_opened = true;
        };

        $scope.openPbsEndDatePicker = function($event) {
            $event.preventDefault();
            $event.stopPropagation();
            $scope.end_date_opened = true;
        };

       /* $scope.isCurrentPBS = function()
        {

            changed_val = $scope.pbs.current_status != true?false:true;
            changed_val = !changed_val;
            return changed_val;
        };*/

        $scope.savePbs = function()
        {

            if($scope.pbs.start_dt instanceof Date)
            {
                var pbsStartDate = $scope.pbs.start_dt;
                $scope.pbs.start_dt = pbsStartDate.getFullYear() + '-' + (pbsStartDate.getUTCMonth()+1) + '-' + pbsStartDate.getDate();

            }

            if($scope.pbs.end_dt instanceof Date)
            {
                var pbsEndDate   = $scope.pbs.end_dt;
                $scope.pbs.end_dt = pbsEndDate.getFullYear() + '-' + (pbsEndDate.getUTCMonth()+1) + '-' + pbsEndDate.getDate();
            }

            $http({
                url : requestPath+'save-pbs',
                method: 'POST',
                data: $scope.pbs
            }).success(function(data, status){

                    if((status == 200) && (data.status == 200 || data.status ==202))
                    {
                        if(data.status == 200)
                        {
                            $scope.successMsg = 'Information added to Professional Backgournd';
                            $scope.Pbs.push(data.result);
                        }

                        if(data.status == 202)
                        {
                            $scope.successMsg = 'Information updated of Professional Backgournd';
                            $scope.Pbs[$scope.editPbsIndex] = data.result;
                        }


                        $scope.addPbsInfo(true);
                        $location.hash('top');
                        $anchorScroll();

                    }else if((status == 200) && (data.status == 400)){
                        $scope.errorMsg = data.msg;

                        $location.hash('topPbs');
                        $anchorScroll();

                    }

                });
        };

        $scope.openUpdatePbsFrm = function(pbsIndex,id)
        {


            $scope.pbs = {
                id : $scope.Pbs[pbsIndex].id,
                org_name: $scope.Pbs[pbsIndex].org_name,
                org_type: $scope.Pbs[pbsIndex].org_type,
                start_dt: $scope.Pbs[pbsIndex].start_dt,
                end_dt: $scope.Pbs[pbsIndex].end_dt,
                current_status: $scope.Pbs[pbsIndex].current_status,
                responsibility: $scope.Pbs[pbsIndex].responsibility,
                designation: $scope.Pbs[pbsIndex].designation,
                url: $scope.Pbs[pbsIndex].url,
                address: $scope.Pbs[pbsIndex].address


            };
            $scope.successMsg = '';
            $scope.editPbsIndex = pbsIndex;
            $scope.errorMsg = '';
            $scope.pbsEditable = 1;
        };


        $scope.removePbs = function(index,id)
        {

            $http({
                url    : requestPath + 'delete-pbs',
                method : 'POST',
                data   : {id : id}
            }).success(function(data,status){
                    $scope.Pbs.splice(index,1);
            });
        };


}]);

var ModalInstanceCtrl = function ($scope, $modalInstance) {

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };
};