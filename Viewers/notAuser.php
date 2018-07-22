<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>JBMDb oops!</title>
        <style>
            body{
                text-align: center;
                margin-top:100px;
                background-color: #c5ccce;
            }
            article{
                border: 1px solid red;
                background-color: pink;
                color:red;
            }
        </style>
    </head>
    <body>
        <article>
        <h1>Hello, The site you've been trying to reach is for users only.</h1>
        <h1>You will be directed to our home in a minute..</h1>
        </article>
    </body>
    <script>
        setTimeout(function(){
            window.location.href="../";
        }, 6000)
    </script>
</html>
