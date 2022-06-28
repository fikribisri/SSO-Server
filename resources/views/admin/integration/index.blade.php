@extends('layouts.main')
@section('pageTitle', 'Integration')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item active">
        <a href="{{ route('admin.integration') }}">Integration</a>
    </li>
</ol>
<div class="container-fluid">
    <div class="col-md-12">
        <div class="row">
            <div class="col">
              <div class="card">
                <div class="card-header">
                  <i class="icon-question"></i> Example Integration
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-4">
                      <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="tab" href="#list-home" role="tab" aria-controls="list-home" aria-selected="false"><i class="fa fa-php"></i> PHP</a>
                        <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="tab" href="#list-profile" role="tab" aria-controls="list-profile" aria-selected="false">API</a>
                      </div>
                    </div>
                    <div class="col-8">
                      <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade active show" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                            <textarea id="codemirror">
                                index.php

                                    session_start();

                                    if(empty($_SESSION['is_login'])){
                                        header('Location:http://client.local.com/auth_redirection.php');
                                    }else{
                                        $ch = curl_init();
                                        $url = '{{URL::to('/')}}/api/user/detail';
                                        $header = array(
                                        'Authorization: Bearer '. @$_SESSION["access_token"]
                                        );

                                        curl_setopt($ch,CURLOPT_URL, $url);
                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                                        $result = curl_exec($ch);
                                        curl_close($ch);
                                        $response = json_decode($result);

                                        if(!empty($response->data->id)){
                                            // return true;
                                        }else{
                                            session_unset();
                                            @session_destroy();
                                        }


                                        echo "<br />";
                                        print_r($_SESSION);
                                        echo 'Selamat datang <b>Login</b> | <a href="logout.php">Sign Out</a>';
                                    }

                                auth_redirection.php

                                $query = http_build_query(array(
                                    'client_id' => '5',
                                    'redirect_uri' => 'http://client.local.com/callback.php',
                                    'response_type' => 'code',
                                    'scope' => '*',
                                ));

                                header('Location: {{URL::to('/')}}/oauth/authorize?'.$query);


                                callback.php

                                session_start();
                                // check if the response includes authorization_code
                                if (isset($_REQUEST['code']) && $_REQUEST['code'])
                                {
                                    $ch = curl_init();
                                    $url = '{{URL::to('/')}}/oauth/token';

                                    $params = array(
                                        'grant_type' => 'authorization_code',
                                        'client_id' => '5',
                                        'client_secret' => 'QnvuB2pJmyvRC2LsoFvMgfXkIcJvju0pCkaLliem',
                                        'redirect_uri' => 'http://client.local.com/callback.php',
                                        'code' => $_REQUEST['code']
                                    );

                                    curl_setopt($ch,CURLOPT_URL, $url);
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                                    $params_string = '';

                                    if (is_array($params) && count($params))
                                    {
                                        foreach($params as $key=>$value) {
                                            $params_string .= $key.'='.$value.'&';
                                        }

                                        rtrim($params_string, '&');

                                        curl_setopt($ch,CURLOPT_POST, count($params));
                                        curl_setopt($ch,CURLOPT_POSTFIELDS, $params_string);
                                    }

                                    $result = curl_exec($ch);
                                    curl_close($ch);
                                    $response = json_decode($result);

                                    // check if the response includes access_token
                                    if (isset($response->access_token) && $response->access_token)
                                    {

                                        // you would like to store the access_token in the session though...
                                        $access_token = $response->access_token;
                                        // use above token to make further api calls in this session or until the access token expires
                                        $ch = curl_init();
                                        $url = '{{URL::to('/')}}/api/user/detail';
                                        $header = array(
                                        'Authorization: Bearer '. $access_token
                                        );

                                        curl_setopt($ch,CURLOPT_URL, $url);
                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                                        $result = curl_exec($ch);
                                        curl_close($ch);
                                        $response = json_decode($result);

                                        $_SESSION["access_token"] = $access_token;
                                        $_SESSION["is_login"] = true;
                                        $_SESSION["id"] = $response->data->id;
                                        $_SESSION["email"] = $response->data->email;
                                        $_SESSION["name"] = $response->data->full_name;
                                        echo "<br />";
                                        // echo 'Selamat datang <b>Login</b> | <a href="logout.php">Sign Out</a>';
                                        header('Location:http://client.local.com/');
                                    }
                                    else
                                    {
                                        if(empty($_SESSION["access_token"])){
                                            session_unset();
                                            session_destroy();
                                            header('Location:http://client.local.com/');
                                        }else{
                                            $ch = curl_init();
                                            $url = '{{URL::to('/')}}/api/user/detail';
                                            $header = array(
                                            'Authorization: Bearer '. $_SESSION["access_token"]
                                            );

                                            curl_setopt($ch,CURLOPT_URL, $url);
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                                            $result = curl_exec($ch);
                                            curl_close($ch);
                                            $response = json_decode($result);

                                            if(!empty($response->data)){
                                                echo "<br />as";
                                                echo 'Selamat datang <b>Login</b> | <a href="logout.php">Sign Out</a>';
                                            }else{
                                                $ch = curl_init();
                                                $url = '{{URL::to('/')}}/api/logout';
                                                $header = array(
                                                'Authorization: Bearer '. @$_SESSION["access_token"]
                                                );
                                                curl_setopt($ch,CURLOPT_URL, $url);
                                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                                curl_setopt($ch, CURLOPT_POST, 1);
                                                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                                                $result = curl_exec($ch);
                                                curl_close($ch);
                                                $response = json_decode($result);

                                                session_unset();
                                                session_destroy();
                                                header('Location:http://client.local.com/');
                                            }

                                        }
                                    }
                                }

                                logout.php

                                session_start();
                                $ch = curl_init();
                                $url = '{{URL::to('/')}}/api/logout';
                                $header = array(
                                'Authorization: Bearer '. @$_SESSION["access_token"]
                                );

                                curl_setopt($ch,CURLOPT_URL, $url);
                                curl_setopt($ch, CURLOPT_POST, 1);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                                $result = curl_exec($ch);
                                curl_close($ch);
                                $response = json_decode($result);

                                session_unset();
                                session_destroy();


                                <div align="center">
                                    <h2>Anda telah berhasil logout..</h2>
                                    Silahkan klik <a href="auth_redirection.php">disini</a> untuk login kembali
                                </div>
                            </textarea>
                        </div>
                        <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">

                            <table class="table table-responsive">
                                <tr>
                                    <th colspan="2"><h4>Endpoint : {{URL::to('/')}}</h4></th>
                                </tr>
                                <tr>
                                    <th colspan="2"></th>
                                </tr>
                                <tr>
                                    <th colspan="2"><b>Login User</b></th>
                                </tr>
                                <tr>
                                    <th>Url</th>
                                    <td>[endpoint]/api/login</td>
                                </tr>
                                <tr>
                                    <th>Method</th>
                                    <td>POST</td>
                                </tr>
                                <tr>
                                    <th>Form Body</th>
                                    <td>
                                        1. email <br>
                                        2. password <br>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Result</th>
                                    <td>
                                        {
                                            "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYTFiMDkzYjVkM2FjMTMwZWJkZWEzMGNlZTYyZDQ0YTI1N2Q1ZTc3Nzc2YmNhZjUyOGMxMTI4YzQ5YWFkNzQ5MjRjODczYzhlNWNlYTY5MTgiLCJpYXQiOjE2MTE4NTQ4MDAsIm5iZiI6MTYxMTg1NDgwMCwiZXhwIjoxNjQzMzkwODAwLCJzdWIiOiI3Iiwic2NvcGVzIjpbXX0.Em_OYvzUsVD5pwQtpyKRxO7d_amoDpPxMPOaKZRtOSdXO46ikEUkNEkRv2BY15EsKD0cEKbTR7jbsx_F787SObyDoVLyC-I-e2h-hG5m0nclw8vKJqMMzgKJzNvifNsTglfeVNMPR9GJlJlwx7nnG7K5uUXDbyS4hov6j8Kng5pSYznn9eRN5X5B1PKibyCzWSjmTVF-_gmtpLRiwZJPfJWhQ8hPb0P-RceJNfCVsgfH-LzeL53OpIKwHRnnw_oCue0OlmcrLn8rQCGosCFq6fhUUSychVToDDnER2vwAzPBTO_DJxVPzAwL7x79-cqOpoTG62SrGJIFZOP5dz6ycdGSFRgRaf-PUMEuxQfXv2b5lZgzzgm4jSIGlE5jpKGsMoF2lPjb2bvI99AtwdjQ7xcYR7OLrRzcUQWzoeoP1uc4JmiVh4WQ2oQhQTGyTbyVgjvGql-QYMaGb3h14I6pfzNuUOXvne2hTY7U88Kwz_FASOpixogT5P2zA3tupUh7y2S2q5a2r5rAYoXspnVfRES0OtvkP0h6L61nHB55_Db4PH191M3vCDyaR4gASlIpib4UgyBk4uEwJcqt6MV9mdAOSmC2J58H92VJUgpZHlHgvcueTqaNZrgogxQL512hpYA0OMTfnrOJnHcTNIY1TGclMeXkLhpw4ddTIg4O30w"
                                        }
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="2"><b>Get User</b></th>
                                </tr>
                                <tr>
                                    <th>Url</th>
                                    <td>[endpoint]/api/user/detail</td>
                                </tr>
                                <tr>
                                    <th>Method</th>
                                    <td>GET</td>
                                </tr>
                                <tr>
                                    <th>Header</th>
                                    <td>
                                        Authorization: Bearer @token
                                    </td>
                                </tr>
                                <tr>
                                    <th>Result</th>
                                    <td>
                                        {
                                            "success": true,
                                            "data": {
                                                "id": "349c297d-fe36-8U7f-a091-598c48f9afea",
                                                "full_name": Demo Data,
                                                "email": "demo@gmail.com",
                                                "username": 'demo',
                                                "phone": 0,
                                                "date_of_birth": null,
                                                "role": "User"
                                            }
                                        }
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="2"><b>Logout</b></th>
                                </tr>
                                <tr>
                                    <th>Url</th>
                                    <td>[endpoint]/api/logout</td>
                                </tr>
                                <tr>
                                    <th>Method</th>
                                    <td>POST</td>
                                </tr>
                                <tr>
                                    <th>Header</th>
                                    <td>
                                        Authorization: Bearer @token
                                    </td>
                                </tr>
                                <tr>
                                    <th>Result</th>
                                    <td>
                                        {
                                            "message": "Successfully logged out"
                                        }
                                    </td>
                                </tr>
                            </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>

@endsection

@section('css')
<link href="{{asset('vendor/codemirror/lib/codemirror.css')}}" rel="stylesheet">
@endsection

@section('js')
<script src="{{asset('vendor/codemirror/lib/codemirror.js')}}"></script>
<script src="{{asset('vendor/codemirror/mode/xml/xml.js')}}"></script>
<script type="text/javascript">
var editor = CodeMirror.fromTextArea(codemirror, {
    // lineNumbers: true,
    mode: 'xml',
    htmlMode: true
  });
  editor.setSize('100%', 700);
</script>
@endsection
