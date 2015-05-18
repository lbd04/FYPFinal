
<?php
if (!isset ($_POST["fname"] )){
	header('Location: index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" href="AngularFramework/css/bootstrap.min.css">
<link rel="stylesheet" href="AngularFramework/jquery-ui.css">
<link rel="stylesheet" href="css/ang5.css">
<script src="AngularFramework/jquery.min.js"></script>
<script src="AngularFramework/jquery-ui.min.js"></script>
<script src="js/ajax.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/angular.min.js"></script>
<script src="js/angular-route.min.js"></script>
<script src="js/angular-resource.min.js"></script>

<script>

var semestercredit = 0 ;
var creditsofar = 0 ;
var remnatural = 0 ; 
var cvsp1 = 1 ; 
var cvsp2 = 1 ;
    $(document).ready(function(){
        $("#editDiv").dialog({autoOpen:false});
        $('#Semester').hide();
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            var step = $(e.target).data('step');
            var percent = (parseInt(step) / 2) * 100;
            $('.progress-bar').css({width: percent + '%'});
            $('.progress-bar').text("Step " + step + " of 2");
            $('.progress-bar').text("Step " + step + " of 2");
        });
    });

    var message = "<?php echo $_POST["fname"]   ?>" ;
    var courses ;
    var index = 1 ;
    var app = angular.module('myApp', []);
    app.controller('customersCtrl', function($scope, $http) {
        $http({
            method: 'POST',
            url: "http://myaubadvisor-lbd04.rhcloud.com/getcourses.php",
            data: "username=" + message,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(
                function (response) {
                    //console.log (response) ;
                    var obj = angular.fromJson(response.courses);
                    $scope.names = obj;
                    $scope.majortotake ;
                    $scope.future = [
                    ];
					$scope.remainnumber = [
                    ];
					
                    console.log (JSON.stringify($scope.names)) ;
                    //console.log (angular.identity($scope.names)) ;
                    $scope.deleteUser = function(ind){
                        var ajax = ajaxObj("POST", "delete.php");
                        ajax.onreadystatechange = function() {
                            if(ajaxReturn(ajax) == true) {
                                //alert (ajax.responseText) ;
								
                            }
                        }
                        ajax.send( "username=" + message + "&coursestoadd="+ JSON.stringify($scope.names[ind]));
                        $scope.names.splice (ind, 1) ;
                    };
                    $scope.editUser = function(ind){
                        console.log ($scope.names[ind].Course ) ;
                        $scope.currentIndex = ind;
                        $scope.Course = $scope.names[ind].Course;
                        $scope.Grade = $scope.names[ind].Grade;
                        $("#editDiv").dialog("option", "width", "50%");
                        $("#editDiv").dialog("open");
                    };

                    $scope.saveUser = function(){
						var complete = 0 ;
                        if ($scope.Grade == "") {
                            $scope.names[$scope.currentIndex].Grade = null;
                        }
                        else if ($scope.Grade > -1 && $scope.Grade < 101){
                            $scope.names[$scope.currentIndex].Grade = parseInt( $scope.Grade);
                        }
                        else {
                            alert ( "Your grade should be between 0 and 100") ;
                        }
						if ( $scope.Grade > 59) {
							complete = 1 ;
						}
                        $("#editDiv").dialog("close");
                        var ajax = ajaxObj("POST", "update.php");
                        ajax.onreadystatechange = function() {
                            if(ajaxReturn(ajax) == true) {
                                alert (ajax.responseText) ;
                            }
                        }
                        ajax.send( "username=" + message + "&coursestoadd="+ JSON.stringify($scope.names[$scope.currentIndex]) +"&complete=" + complete);
                    };

                    $scope.cancelSave = function(){
                        $("#editDiv").dialog("close");
                    };

                    $scope.goNext = function(i){
                        $('[href=#step'+(i+1)+']').tab('show');
						if (i == 0) {
							$scope.future = [] ;
							creditsofar = 0 ;
						}
                        return false
                    }


                    $scope.semester = function () {
						$scope.getnumber () ;
                        var ajax = ajaxObj("POST", "futurecourses.php");
                        var obj ;
                        $scope.majortotake = [];
                        ajax.onreadystatechange = function() {
                            if(ajaxReturn(ajax) == true) {
                               // alert (ajax.responseText) ;
                                obj = angular.fromJson(ajax.responseText);
                                $scope.majortotake = angular.fromJson(obj.courses);
                                rem  = $scope.majortotake.length	;
                                console.log (angular.identity($scope.majortotake)) ;
								console.log (1) ;
								$scope.$apply();
                            }
                        }
						//alert (1) ; 
                        ajax.send( "username=" + message);
                        var v = document.getElementById("chosen").value;
						if ( parseInt(v) == 1) {
							document.getElementById("sem").innerHTML = "Fall" ;
							semestercredit = 18 ; 
						}
						else if (parseInt(v)==2) {
							document.getElementById("sem").innerHTML = "Spring" ;
							semestercredit = 18 ;	
						}
						else if (parseInt(v)==3) {
							document.getElementById("sem").innerHTML = "Summer" ;	
							semestercredit = 10 ;
						}
                        $('#Semester').show();
						//alert (3) ;
                    }
					
					$scope.semesters = function () {
                        var ajax = ajaxObj("POST", "futurecourses.php");
                        var obj ;
                        $scope.majortotake = [];
                        ajax.onreadystatechange = function() {
                            if(ajaxReturn(ajax) == true) {
                               // alert (ajax.responseText) ;
                                obj = angular.fromJson(ajax.responseText);
                                $scope.majortotake = angular.fromJson(obj.courses);
                                rem  = $scope.majortotake.length	;
                                //console.log (angular.identity($scope.majortotake)) ;
								//console.log (1) ;
								$scope.$apply();
                            }
                        }
						//alert (1) ; 
                        ajax.send( "username=" + message);
                    }
					
					$scope.semesterss = function () {
                        var ajax = ajaxObj("POST", "english.php");
                        var obj ;
                        $scope.majortotake = [];
                        ajax.onreadystatechange = function() {
                            if(ajaxReturn(ajax) == true) {
                               // alert (ajax.responseText) ;
                                obj = angular.fromJson(ajax.responseText);
                                $scope.majortotake = angular.fromJson(obj.courses);
                                rem  = $scope.majortotake.length	;
                                //console.log (angular.identity($scope.majortotake)) ;
								//console.log (1) ;
								$scope.$apply();
                            }
                        }
						//alert (1) ; 
                        ajax.send( "username=" + message);
                    }
					
					$scope.semesternatural = function () {
                        var ajax = ajaxObj("POST", "natural.php");
                        var obj ;
                        $scope.majortotake = [];
                        ajax.onreadystatechange = function() {
                            if(ajaxReturn(ajax) == true) {
                               //alert (ajax.responseText) ;
                                obj = angular.fromJson(ajax.responseText);
                                $scope.majortotake = angular.fromJson(obj.courses);
                                //console.log ( $scope.majortotake.length)	;
								
                                console.log (angular.identity($scope.majortotake)) ;
								
								//console.log (1) ;
								$scope.$apply();
                            }
                        }
						//alert (1) ; 
                        ajax.send( "username=" + message);
                    }
					
                    $scope.pushpin = function (ind) {
                        var c = $scope.names [ind] ;
                        console.log (creditsofar + "  " + semestercredit) ;
					
						if ($scope.majortotake[ind].Attribute == "natural" && remnatural == 0) {
								alert ("You are out of credit for this category") ;
							}
							else if ($scope.majortotake[ind].Attribute == "cvsp1" && cvsp1 == 0) {
								alert ("You are out of credit for this category") ;
							}
						else if (creditsofar + parseInt($scope.majortotake[ind].Credits) < semestercredit ){
							if ($scope.majortotake[ind].Attribute == "natural") {
							remnatural = remnatural - 1 ;
							}
							if ($scope.majortotake[ind].Attribute == "cvsp1") {
							cvsp1 = cvsp1 - 1 ;
							}
							var ajax = ajaxObj("POST", "furureadd.php");
							ajax.onreadystatechange = function() {
                            if(ajaxReturn(ajax) == true) {
                                $scope.future.push(
                            {
                                Course:$scope.majortotake[ind].Course,
                                Credits:$scope.majortotake[ind].Credits,
								 Attribute:$scope.majortotake[ind].Attribute
                            }
                        );
						$scope.majortotake.splice (ind , 1) ;
								$scope.$apply();
								//alert (ajax.responseText) ;
                            }
                        }
                        ajax.send( "username=" + message+ "&course=" + $scope.majortotake[ind].Course) ;
						creditsofar = creditsofar + parseInt($scope.majortotake[ind].Credits) ;
						//$scope.majortotake.splice (ind , 1) ;
						document.getElementById("totalcredits").innerHTML = creditsofar ;
						}
							else {
						alert ("You have reached the max credits for this semester") ;
						}
                        
                    }
					
					
					$scope.delete = function (ind) {
						creditsofar = creditsofar - parseInt($scope.future[ind].Credits) ;
						var ajax = ajaxObj("POST", "futuredelete.php");
							ajax.onreadystatechange = function() {
                            if(ajaxReturn(ajax) == true) {
					        	$scope.majortotake.unshift ($scope.future[ind]) ;
						        $scope.future.splice (ind , 1) ;
								$scope.$apply();
                            }
                        }
                        ajax.send( "username=" + message+ "&course=" + $scope.future[ind].Course) ;
						if ($scope.majortotake[ind].Attribute == "natural" ) {
							remnatural = remnatural + 1;
						}
						if ($scope.majortotake[ind].Attribute == "cvsp1" ) {
							cvsp1 = cvsp1 + 1;
						}
					}
					
					$scope.savesemester = function () {
						var ajax = ajaxObj("POST", "newsemester.php");
                        ajax.onreadystatechange = function() {
                            if(ajaxReturn(ajax) == true) {
                            //alert (ajax.responseText) ;
							//location.reload();
							document.getElementById("senduser").value = message ; 
				            document.getElementById("personalthing").submit() ; 
							}
                        }
                        ajax.send( "username=" + message + "&newsemester="+ JSON.stringify($scope.future));
						creditsofar = 0 ;
						
					}
					
					$scope.getnumber = function () {
					//	alert (1) ;
						var ajax = ajaxObj("POST", "getremcourses.php");
                        ajax.onreadystatechange = function() {
                            if(ajaxReturn(ajax) == true) {
                                obj = angular.fromJson(ajax.responseText);
                                $scope.remainnumber = angular.fromJson(obj.courses);
							    $scope.$apply();
								remnatural = $scope.remainnumber[10].number;
								//console.log () ;
							}
                        }
                        ajax.send( "username=" + message);
					}
                });
    });
	</script>
</head>

<body ng-app="myApp" ng-controller="customersCtrl" style="padding-bottom : 20px ;">

<form id="personalthing" action="ang5.php" method="POST"  style="display:none">
  <input id ="senduser" type="text" name="fname">
</form>
<div class="container">
        <h3><?= $_POST["fname"] ;  ?></h3>

        <table id="course" class="table table-hover">
            <thead>
                <tr>
                    <th>Edit</th>
                    <th>Course</th>
                    <th>Grade</th>
                    <th>Delete</th>
                    <th>Completed</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="x in names" ng-if="x.Course != 0">
                    <td>
                        <button class="btn" ng-click="editUser($index)"><span class="glyphicon glyphicon-pencil"></span></button>
                    </td>
                    <td>{{ x.Course }}</td>
                    <td>{{ x.Grade }}</td>
                    <td>
                        <button class="btn" ng-click="deleteUser($index)"><span class="glyphicon glyphicon-trash"></span></button>
                    </td>
                    <td ng-if="x.Grade > 59">
                        <button class="btn"><span class="glyphicon glyphicon-thumbs-up"></span></button>
                    </td>
                    <td ng-if="(!(x.Grade > 59)) || x.Grade == null">
                        <button class="btn"><span class="glyphicon glyphicon-thumbs-down"></span></button>
                    </td>
                </tr>
            </tbody>
        </table>
		</div>
   
        <br>
        <div id="editDiv">
            <form class="form form-horizontal">
                <div class="form-group">
                    <label class="col-md-3">Course:</label>
                    <input type="text" placeholder="Password" ng-model="Course" ng-disabled="!editable" />
                </div>
                <div class="form-group">
                    <label class="col-md-3">Grade:</label>
                    <input type="text" placeholder="Your grade" ng-model="Grade" />
                </div>
                <br>

                <button class="btn btn-success btn-lg" ng-click="saveUser()" ng-disabled="error || incomplete">
                    Save Course
                </button>
                <button class="btn btn-danger btn-lg" ng-click="cancelSave()">
                    Cancel
                </button>
            </form>
        </div>
    
<div class="container">
        <div class="col-sm-3" style="padding : 0px ; width : 100% ">
            <div class="panel panel-group" id="main">
                <div class="panel-body">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#main" data-ng-click="semester()" href="#accordion"><span class="glyphicon glyphicon-folder-close"></span> See remaining Courses</a>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse panel-scroll" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-folder-close"></span> Major Required Courses</a>
                                </h4>
                            </div>

                            <div id="collapseOne" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <table class="table table-hover">
                                        <tbody>
                                            <tr class="panel-heading" ng-repeat="x in majortotake" ng-if="x.Course != 0">
                                                <h4 class="panel-title">
                                                    <td>{{ x.Course }}</td>
                                                </h4>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-ng-click="getnumber()" data-parent="#accordion" href="#collapseTwo"><span class="glyphicon glyphicon-folder-close"></span> Other Courses</a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse">
                                <div class="panel-body">
								<table class="table table-hover">
                                        <tbody >
										<thead>
                                               <tr>
                                              <th>Category</th>
                                               <th>Remaining Courses</th>
                                               </tr>
                                         </thead>
                                            <tr class="panel-heading" ng-repeat="x in remainnumber" ng-if="x.nature != 1">
                                                <h4 class="panel-title">
                                                    <td>{{ x.nature }}</td>
													<td>{{ x.number }}</td>
                                                </h4>
                                            </tr>	
                                        </tbody>
								</table>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
   
    <br />
    <br />
    <div class="progress">
        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="2" style="width: 33%;">
            Step 1 of 2
        </div>
    </div>
    <div class="navbar">
        <div class="navbar-inner">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#step1" data-toggle="tab" data-step="1">Step 1</a></li>
                <li><a href="#step2" data-toggle="tab" data-step="2">Step 2</a></li>
                <!--<li><a href="#step3" data-toggle="tab" data-step="3">Step 3</a></li>-->
            </ul>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade in active" id="step1">
            <div class="well">

                <label>Choose semester</label>
                <select id="chosen" class="form-control  input-lg">
                    <option selected="" value="1">Fall</option>
                    <option value="2">Spring</option>
                    <option value="3">Summer</option>
                </select>
                <br>
            </div>

            <a class="btn btn-default btn-lg next" href="" data-ng-click="semester() ;goNext(1) ;">Continue</a>
        </div>
        <div class="tab-pane fade" id="step2">
            <div class="well">


                <h3>Choose your Courses</h3>
				</br>
           <!--     <label>Search: <input ng-model="searchText"></label> -->
							<!--<li><a href="#step3" data-toggle="tab" data-step="3">Step 3</a></li>-->
					
                </br>
               <!-- <button class="btn" data-ng-click="">See courses</button> -->
                <div style="height : 200px; overflow: scroll;">
				        
						    <label><button class="btn" data-ng-click="semesters($index)"><span class="">Major</span></button></label>
							<label><button class="btn" data-ng-click="semesterss($index)"><span class="">English</span></button></label>
							<label><button class="btn" data-ng-click="semesternatural($index)"><span class="">Natural Science</span></button></label>
							<label><button class="btn" data-ng-click="semestercvsp1($index)"><span class="">CVSP 1</span></button></label>
						
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Course</th>
                                <th>Credits</th>
                            </tr>
                        </thead>
                        <tbody>
                           <!-- <tr class="panel-heading" ng-repeat="x in majortotake | filter:searchText" ng-if="x.credit != 0"> -->
							<tr class="panel-heading" ng-repeat="x in majortotake " ng-if="x.credit != 0">

                                <td>{{ x.Course }}</td>
                                <td>{{ x.Credits }}</td>
                                <td><button class="btn" data-ng-click="pushpin($index)"><span class="glyphicon glyphicon-pushpin"></span></button></td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            </br></br>
            <a class="btn btn-default" href="" data-ng-click="goNext(0)">Continue</a>
        </div>

  <!--      <div class="tab-pane fade" id="step3">
            <div class="well"> <h2>Step 3</h2> You're Done! Save your semester!!!</div>
            <a class="btn btn-success first" href="" data-ng-click="goNext(0)">Start over</a>
        </div>-->
    </div>


    <div id="Semester">
        <br /><br />
        <h3 id="sem"></h3>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Course</th>
                    <th>Credits</th>
					<th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="x in future">   

                    <td>{{ x.Course }}</td>
                    <td>{{ x.Credits }}</td>
					<td>
                        <button class="btn" ng-click="delete($index)"><span class="glyphicon glyphicon-trash"></span></button>
                    </td>
                </tr>
				<tr>
					<td> <b> Total credits </b></td>
					<td id="totalcredits" style = "text-weight : bold ;"></td>
				</tr>
            </tbody>
        </table>

        <a class="btn btn-success first" href="" data-ng-click="savesemester() ;goNext(0)">Save Semester</a>
    </div>

</div>
</div>
</br></br>
      <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p> ©AubAdvisor Team <a href="#">Privacy</a> · <a href="#">Terms</a></p>
      </footer>

</body>
</html>