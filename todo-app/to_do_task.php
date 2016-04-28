<!DOCTYPE html>
<html lang="en" ng-app='store'>

<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
<style>
.material-switch > input[type="checkbox"] {
    display: none;
}

.material-switch > label {
    cursor: pointer;
    height: 0px;
    position: relative;
    width: 40px;
}

.material-switch > label::before {
    background: rgb(0, 0, 0);
    box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.5);
    border-radius: 8px;
    content: '';
    height: 16px;
    margin-top: -8px;
    position:absolute;
    opacity: 0.3;
    transition: all 0.4s ease-in-out;
    width: 40px;
}
.material-switch > label::after {
    background: rgb(255, 255, 255);
    border-radius: 16px;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
    content: '';
    height: 24px;
    left: -4px;
    margin-top: -8px;
    position: absolute;
    top: -4px;
    transition: all 0.3s ease-in-out;
    width: 24px;
}
.material-switch > input[type="checkbox"]:checked + label::before {
    background: inherit;
    opacity: 0.5;
}
.material-switch > input[type="checkbox"]:checked + label::after {
    background: inherit;
    left: 20px;
}
</style>
</head>
<body>

<div class="container">
  <div class="jumbotron" style="font-variant-ligatures: initial;color: #fff;background-color: rgb(47, 98, 136);">
      <img src="images/peaks.jpg" alt="perk" class="img-circle " style=" width: 151px;height: 125px;margin-top: 25px;float: left;">
	<div class="col-lm-12" style="text-align:center;">
		<h2>To-Do List</h2>
	</div>
      </div>
	<div class="row" style="margin: 10px!important;">
		<div ng-controller="TodoCtrl">
			<div class="col-lm-12" style="text-align:center;">
				{{getUncompletedCount()}} of {{todos.length}} remaining
				<button ng-click="archiveCompleted()" class="btn btn-primary">Archive Completed</button>
			</div>
			<br/>
			<form style="text-align: center;" class="form-group">
				<input type="text" ng-model="todoText" size="30" placeholder="enter new todo here" class="form-control" autofocus style="width:93%!important;float:left;"/>
				<button ng-click="addTodo()" ng-disabled="!todoText" class="btn-success">Add</button>
				<br>
			</form>

			<ul class="nav nav-pills nav-stacked tag-list">
				<li class="col-md-12 list-group-item" ng-repeat="todo in todos"/>
					<a href="#" style="background-color: #2F6288; color:#FFF;">
						<div class="material-switch pull-right">
							<input id="someSwitchOptionSuccess{{todo.text}}" name="someSwitchOption001" type="checkbox"  ng-model="todo.done"/>
							<label for="someSwitchOptionSuccess{{todo.text}}" class="label-success"></label>
						</div>
                        <button ng-click="deleteTodo(todo)" class="btn-warning">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
					<span class="done-{{todo.done}}">{{todo.text}}</span>

				</li>
			</ul>
		</div>

	</div>
	</div>
</div>
</body>
<script type="text/javascript">
	(function (){

			var app=angular.module('store',[])
app.controller('TodoCtrl', function ($scope,$http) {
$scope.todos = [
{text: 'Go to play', done: true},
{text: 'Go for Movie', done: false}
];
$scope.addTodo = function () {
$scope.todos.push({text: $scope.todoText, done: false});
 $http.get("ajax_to_do_task.php")
    .then(function(response) {
        $scope.todos.push({text: response.data, done: false});
    });
$scope.todoText = ''; // clears input
};
$scope.archiveCompleted = function () {
// Not saving completed todos in this version.
$scope.todos = $scope.todos.filter(function (t) { return !t.done; });
};
$scope.deleteTodo = function (todo) {
$scope.todos = $scope.todos.filter(function (t) { return t !== todo; });
};
$scope.getUncompletedCount = function () {
var count = 0;
angular.forEach($scope.todos, function (todo) {
if (!todo.done) count++;
});
return count;
};
});
	})()
</script>
</html>