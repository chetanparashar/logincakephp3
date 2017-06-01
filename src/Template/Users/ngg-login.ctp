<?= $this->Html->script(['angular.min']) ?>
<div class="users form" ng-app="myApp" ng-controller="myCtrl">
    <?php
    echo $this->Html->div('login-logo', $this->Html->image('logo_blue.png', ['alt' => 'Payworld', 'style' => 'width:200px;height:auto;']));
    echo $this->Html->tag("H3", "Api Associats Login", array('style' => 'margin-top:0px;text-align:center;color:#3C8DBC;font-size: 28px;
    font-weight: bold;'));
    ?>
    <?= $this->Form->create() ?>
    <fieldset>        
        <legend> <span>{{message}}</span></legend>
        <div class="form-group">  
            <?php
            echo $this->Html->div('row');
            echo $this->Html->div('col-md-12');
            echo $this->Html->div("input-group user");
            echo $this->Html->div("input-group-addon");
            echo $this->Html->tag('span', '', ['class' => "glyphicon glyphicon-user"]);
            echo $this->Html->tag('/div');
            echo $this->Form->input('username', ['ng-model' => 'username', 'placeholder' => 'username', 'id' => 'username', 'label' => FALSE, 'class' => 'form-control pull-right', 'value' => "", "required"]);
            echo $this->Html->tag('/div');
            echo $this->Html->tag('/div');
            echo $this->Html->tag('/div');
            echo "<br>";
            echo $this->Html->div('row');
            echo $this->Html->div('col-md-12');
            echo $this->Html->div("input-group lock");
            echo $this->Html->div("input-group-addon");
            echo $this->Html->tag('span', '', ['class' => "glyphicon glyphicon-lock"]);
            echo $this->Html->tag('/div');
            echo $this->Form->input('password', ['ng-model' => 'password', 'placeholder' => 'password', 'id' => 'password', 'label' => FALSE, 'class' => 'form-control pull-right', 'value' => "", "required"]);
            echo $this->Html->tag('/div');
            echo $this->Html->tag('/div');
            echo $this->Html->tag('/div');
//            echo $this->Form->hidden('loginname', [ 'value' => '']);
//            echo $this->Form->hidden('password', ['value' => '']);
//            echo $this->Form->unlockField('loginname');
//            echo $this->Form->unlockField('password');
            ?>           
        </div>            
        <button type="button"  class="btn btn-primary btn-block" ng-click="login()">Login</button>
    </fieldset>
    <!--< $this->Form->postButton('I forgot my password', array('action' => 'reset'), array('method' => 'POST', 'target' => '_self', 'class' => 'btn-link'));-->
    <?= $this->Form->end() ?>
</div>

<style>
    .login-logo{
        margin-bottom: 15px;
    }
    .input-group .input-group-addon {

        color: #3686B9;
    }
    .form-control {
        color: #3686B9;
        font-size: 16px;
    }
</style>
<script type="text/javascript">

    var app = angular.module('myApp', []);
    app.controller('myCtrl', function ($scope, $http, $window) {
        $scope.CSRF = "<?= $this->request->params['_csrfToken'] ?>";
        $scope.message = "";
        $scope.login = function () {
            $scope.postData = {username: $scope.username, password: $scope.password};
            $http.post('<?= $this->request->webroot ?>users/ng-login.json', $scope.postData, {headers: {'X-CSRF-Token': $scope.CSRF}})
                    .then(function (result) {
                        $window.window.alert(result.data);
                        if (result.data.error == 0) {
                            $window.location.href = "<?= $this->request->webroot ?>users/home";
                        } else {
                            $scope.message = result.data.message;
                        }
                    }, function (err) {
                        $window.window.alert(err.data);
                        deferred.resolve(err);
                    });

        };
    });

</script>