/**
 * Created by Himel on 9/21/14.
 */
var memberApp = angular.module('memberApp',['ui.bootstrap','ui.slider','ui.select2']);

memberApp.filter('dateFormat', function($filter)
{
    return function(input)
    {
        if(input == null){ return ""; }

        var _date = $filter('date')(new Date(input), 'MMM dd yyyy');

        return _date.toUpperCase();

    };
});

memberApp.controller('memberController',['$scope','$http','$sce',function($scope,$http,$sce){

    $scope.slider = {
        'options': {
            start: function (event, ui) {  },
            stop: function (event, ui) { },
            range: true
        }
    }
    $scope.msg = '';
    $scope.form = {};
    $scope.skills = [];
    $scope.members = members;
    $scope.tmp_skill_tag = [];
    $scope.form.skill_tags_id = [];
    $scope.freelancers = [];
    $scope.selected_freelancers = [];
    $scope.form.selectFl = [];
    $scope.frelancerCollections =[];

    $scope.myHTML = "";

    $scope.customSkillSelection = function($data){
        for (var i=0; i<$data.length; i++) {
            $scope.skills.push({"id":$data[i].id,"text":$data[i].category_name});
        }
    };
    $scope.customSkillSelection(skills);

    $scope.multiSkillSelection = {
        'multiple': true,
        query: function (query) {
            query.callback({ results: $scope.skills });
        },
        initSelection: function(element, callback) {

        }
    };

    $scope.form.freelancer_price = [5,30];

    $scope.search = function(){
        $scope.form.skill_tags_id = [];
        if($scope.tmp_skill_tag.length>0)
        {
            for(tmp in $scope.tmp_skill_tag)
            {
                $scope.form.skill_tags_id.push($scope.tmp_skill_tag[tmp].id);
            }
        }
        $scope.form.freelancer_type = "Individual";
        $http({
           url : BASE + 'search/new-member-freelancers-list',
           method:"POST",
           data: $scope.form
        }).success(function(data,status){
            if(data.status==200 && status == 200)
            {
//                $scope.frelancerCollections = data.freelancersList;
//                $scope.currentPage = 1;
//                $scope.maxSize = 5;
//                $scope.itemsPerPage = 10;
//                $scope.bigTotalItems = $scope.frelancerCollections.length;
//                $scope.bigCurrentPage = 1;
//                $scope.freelancers = $scope.frelancerCollections.slice(0,$scope.itemsPerPage);

                $scope.freelancers = data.freelancersList;


            }
        });
    }

    $scope.freelancerPhoto = function(fl)
    {
        if(fl.freelancer_type=='Individual')
        {

            return BASE+'cdn/profile/freelancer/individual/'+fl.photos;
        }else{
            return BASE+'cdn/profile/freelancer/agency/'+fl.photos;
        }
    }

    $scope.testTaken =function(fl)
    {

        var testTaken = 0;
       if(fl.skills.length)
       {
           for(s in fl.skills)
           {
               if(fl.skills[s].test_taken && fl.skills[s].score != null)
                   testTaken++;
           }

       }
       return testTaken;
    }

    $scope.curPage = 0;
    $scope.startOffset = 0;
    $scope.endOffset = 0;
    $scope.pageChanged = function() {
        if($scope.bigCurrentPage == "" || $scope.bigCurrentPage == undefined || $scope.bigCurrentPage < 0)
            $scope.bigCurrentPage=1;
        $scope.curPage     = ($scope.bigCurrentPage-1);
        $scope.startOffset = $scope.curPage * $scope.itemsPerPage;
        $scope.endOffset   =   ($scope.itemsPerPage * $scope.curPage)+$scope.itemsPerPage;
        $scope.freelancers   = $scope.frelancerCollections.slice($scope.startOffset,$scope.endOffset);

    };


    $scope.checkAlreadyExist = function(index)
    {
        //console.log($scope.freelancers[index].fid);
        if($scope.members.length)
        {
            for(member in $scope.members)
            {
                //console.log(member);

                if($scope.members[member].freelancer_id == $scope.freelancers[index].fid)
                {

                    return true;
                }
            }
        }else{
            return false;
        }

    }

    $scope.toggleSelection = function toggleSelection(fl,$index) {
        var idx = $scope.form.selectFl.indexOf(fl);

        // is currently selected
        if (idx > -1) {
            $scope.form.selectFl.splice(idx, 1);
            $scope.selected_freelancers.splice(idx, 1);
        }

        // is newly selected
        else {
            $scope.form.selectFl.push(fl);
            $scope.selected_freelancers.push(fl);
        }
    };

    $scope.sentRequest = function(){
//        console.log($scope.selected_freelancers);
//        return false;
        $http({
            url : BASE+'agency/add-member',
            method : "POST",
            data : {freelancer_id:$scope.selected_freelancers}
        }).success(function(data,status){
                 if(data.status == 200 && status == 200)
                 {
                    $scope.msg = 'Your request successfully sent';
                    $scope.freelancers=[];
                    $scope.members = $scope.selected_freelancers;
                    for(sf in $scope.selected_freelancers)
                    {
                        $scope.members[sf].freelancer_id = $scope.selected_freelancers[sf].fid
                    }

                 }
        });
    }

    $scope.givenTesCount=function($index){
        var count = 0;
        for (var i = 0; i < $scope.freelancers[$index].skills.length; i++) {
            if($scope.freelancers[$index].skills[i].test_taken==1 && $scope.freelancers[$index].skills[i].score!=null)
                count++;
        }
        return count;
    };

    $scope.checkPhotos = function($index){
        if($scope.freelancers[$index].photos=='' || $scope.freelancers[$index].photos==null){

            return true;
        }
        return false;
    };

    $scope.formatDate = function($index){
        //console.log($data);
        var input = $scope.freelancers[$index].last_login;
        var newDate = input.replace(/(.+) (.+)/, "$1T$2Z");
        //var today = $filter('date')(new Date(newDate),'yyyy-MM-dd HH:mm:ss Z');
        //console.log(today);
        return newDate;
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
            var f_skills = [];
            if($scope.tmp_skill_tag.length>0)
            {
                for(tmp in $scope.tmp_skill_tag)
                {
                    f_skills.push($scope.tmp_skill_tag[tmp].id);
                }
            }
            var freelancer_type = "Individual";

            $('#ajaxContent').load($(this).attr('href'),{skill_tags_id:f_skills,freelancer_type:freelancer_type},function(e){
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

//    $scope.setFreelancer = function(index){
//        $scope.form.selectFl.push($scope.freelancers[index].fid);
//        $scope.selected_freelancers.push($scope.freelancers[index]);
//    };
//
//    $scope.deleteFreelancer = function(index){
//        if($scope.selected_freelancers.length>0){
//            $scope.form.selectFl.splice(index, 1);
//            $scope.selected_freelancers.splice(index, 1);
//        }
//    };

    $('.select-freelancer').live('click',function(e){
        var index = $(this).val();

        if($(this).is(':checked')){
            fl_key.push(index);
            $scope.form.selectFl.push($scope.freelancers[index].fid);
            $scope.selected_freelancers.push($scope.freelancers[index]);
        }else{
            if($scope.selected_freelancers.length>0){
                $scope.form.selectFl.splice(fl_key.indexOf(index), 1);
                $scope.selected_freelancers.splice(fl_key.indexOf(index), 1);
                fl_key.splice(fl_key.indexOf(index), 1);
            }
        }
    });

    $("#find_again").live('click',function(e){
        $('#ajaxContent').hide();
        $("#loadingFlag").show();

        var f_skills = [];
        if($scope.tmp_skill_tag.length>0)
        {
            for(tmp in $scope.tmp_skill_tag)
            {
                f_skills.push($scope.tmp_skill_tag[tmp].id);
            }
        }
        var freelancer_type = "Individual";

        $('#ajaxContent').load(BASE+'search/member-freelancers-list',{skill_tags_id:f_skills,freelancer_type:freelancer_type},function(e){

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