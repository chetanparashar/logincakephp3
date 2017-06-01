<?= $this->Html->script(['angular.min']) ?>



<div class="users form" ng-app="myApp" ng-controller="myCtrl">


    <?= $this->Flash->render() ?>
    <?= $this->Form->create() ?><fieldset>
        
        <legend> <span style="color: red;">{{message}}</span></legend>
        <div class="form-group">
         
            <?= $this->Form->control('username', ['ng-model' => 'username', 'validate-on'=>"dirty",'required']) ?>
           
        </div>
        <?= $this->Form->control('password', ['ng-model' => 'password', 'validate-on'=>"dirty",'required']) ?>
        <button type="button" ng-click="login()" class="btn btn-primary btn-block">Login</button>
    </fieldset>


    <?= $this->Form->end() ?>
</div>

<style>
    
</style>
<script type="text/javascript">
    var app = angular.module('myApp', []);
    app.controller('myCtrl', function ($scope, $http, $window) {
//        $scope.name = "Chetan";
        $scope.message = "";
        $scope.login = function () {
            $scope.postData = {username: $scope.username, password: $scope.password};
            $http.post('<?= $this->request->webroot ?>users/login.json', $scope.postData)
                    .then(function (result) {
                        console.log(result);
                        if (result.data.error == 0) {
                            $window.location.href = "<?= $this->request->webroot ?>users/index";
                        } else {
                            $scope.message = result.data.msg;
                        }
                    });
        };
    });

</script>
