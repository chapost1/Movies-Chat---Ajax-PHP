<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>JBMDb Home</title>
    </head>
    <body onload="onloadEvents();">
        <?php require_once 'header.php'; ?>
        <article>
            <nav class="row nav-search search">
                <div class="col-4">
                    <div class="row form-group">
                        <input class="col-10 searchVector" type="text" name="searchKey" placeholder="Search Movie by name.." />
                        <input class="col-2 searchBTN" type="button" value="" onclick="serachValue();">
                    </div>
                </div>
                <div class="col-8"><div id="searchErr">Couldn't find any match...</div></div>
            </nav>


            <button id='cBTN'class="btn btn-basic atBTN" data-toggle="collapse" data-target="#add-cont">Add a Movie <span><strong>&#x2207;</strong></span></button>
            <div id="add-cont" class="add-cont collapse">
                <div class="col-2"></div>
                <form id="formation" class="formation col-8" method="POST">
                    <div id="formationLayer"></div>
                    <div class="form-group">
                        <label for="mName">Name:</label>
                        <input id="mName" required="required" type="text" class="form-control" placeholder='Movie Name'/>
                    </div>
                    <div class="form-group">
                        <label for="mLength">Length:</label>
                        <input id="mLength" required="required" type="text" class="form-control" placeholder='Movie Length - 3 Hours'/>
                    </div>
                    <div class="form-group">
                        <label for="mImg">Image by URL:</label>
                        <input id="mImg" required="required" type="text" class="form-control" placeholder='https://www.helloimage.com/imagination/slowbro/smalgo.jpg'/>
                    </div>
                    <div class="form-group">
                        <label for="mGenre">Genre:</label>
                        <select placeholder="" id="mGenre" required="required" class="form-control" data-live-search="true" data-live-search-style="startsWith" class="selectpicker">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="mRating">Rating ( 0.0/10 )</label>
                        <input id="mRating" required="required" type="number" step="0.1" class="form-control" placeholder='4.1'/>
                    </div>
                    <div id="err">Not Everything is filled In the right Format.</div>
                    <input class="btn btn-info" type="button" id="addBTN" value="Add"/>
                </form>
                <div class="col-2"></div>
            </div>

            <div id="movies-cont" class="movies-cont">
                <table class="col-xs-2 table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Length</th>
                            <th>Genre</th>
                            <th>Rating&#9734;</th>
                            <th>Functions</th>
                        </tr>
                    </thead>
                    <tbody id="tBody">
                        <tr>
                            <td>none</td>
                            <td>none</td>
                            <td>none</td>
                            <td>none</td>
                            <td>none</td>
                            <td>none</td>
                            <td>none</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </article>
        <div id="mrAjax"><h1></h1></div>
    </body>
    <script>
        function onloadEvents() {
            genresListLoad(document.getElementById('mGenre'));
            showMovies();
            runMrAjax();
        }
        ;
        /////////
        var letEdit = true;
        //////// adding a movie BTN
        var addBTN = document.getElementById('addBTN');
        addBTN.addEventListener("click", function (e) {
            var myForm = document.getElementById('formation');
            var err = document.getElementById('err');
            var inputRatingValue = document.getElementById('mRating').value;
            if (myForm.checkValidity() && inputRatingValue <= 10 && inputRatingValue.length < 4) {
                err.style.display = "none";
                createMovie();
            } else {
                err.style.display = "block";
            }
        });
        ////// ADD a movie to DB
        function createMovie() {
            var inputName = document.getElementById('mName');
            var inputLength = document.getElementById('mLength');
            var inputImage = document.getElementById('mImg');
            var inputGenre = document.getElementById('mGenre');
            var inputRating = document.getElementById('mRating');
            $.post('../Controllers/moviesControllers/controlMovies.php', {name: inputName.value, length: inputLength.value, rating: parseFloat(inputRating.value), image: inputImage.value, genre: inputGenre.value, create: null}, function (data) {
                data = JSON.parse(data);
                buildMoviesUsingArray(data);
            })
            //// Clean Inputs From Values
            inputName.value = "";
            inputLength.value = "";
            inputImage.value = "";
            inputGenre.value = "";
            inputRating.value = "";
        }
        ;
        ////// Get all movies from DB 
        function showMovies() {
            $.getJSON('../Controllers/moviesControllers/controlMovies.php?allMovies', function (data) {
                buildMoviesUsingArray(data);
            })
        }
        ;
        //////// Build table Body
        function buildMoviesUsingArray(data) {
            var tBody = document.getElementById('tBody');
            if (data.length > 0) {
                tBody.innerHTML = "";
                data.forEach(function (movie, index) {
                    if (movie.rating.length === 1) {
                        var step = '.0';
                    } else {
                        var step = '';
                    }
                    tBody.innerHTML = tBody.innerHTML + '<tr id="row' + index + '"><td>' + (index + 1) + '</td><td>' + movie.name + '</td><td><img src="'
                            + movie.image + '" alt="Movie Image"/></td><td>' + movie.length + '</td><td>' + movie.genre + '</td><td>' + parseFloat(movie.rating) + step + '/10</td><td class="sm-td">\n\
            <input class="btn btn-warning i-b editBTN" type="button" value="edit" data-index="' + index + '" data-id="' + movie.id + '" onclick="editMovie(this)"/>\n\
            <input class="btn btn-danger i-b delBTN" type="button" value="delete" data-id="' + movie.id + '" onclick="delMovie(this)"/></td></tr>';
                })
            } else {
                tBody.innerHTML = "";
                tBody.innerHTML = tBody.innerHTML + '<tr><td>none</td><td>none</td><td>none</td><td>none</td><td>none</td><td>none</td><td>none</td></tr>';
            }
            /// after everyhing loaded again, let edit again.
            letEdit = true;
        }
        ;
        ///////// Delete a movie
        function delMovie(it) {
            if (letEdit) {
                var url = '../Controllers/moviesControllers/controlMovies.php?deleteMovie=' + it.dataset.id;
                $.getJSON(url, function () {
                });
                ///// Right Here movie Should've already gone.
                setTimeout(function () {
                    showMovies();
                }, 50);
            }
        }
        ;
        /////// Edit a movie
        function editMovie(it) {
            if (letEdit) {
                var url = '../Controllers/moviesControllers/controlMovies.php?editMovie=' + it.dataset.id;
                //// don't allow to add right now
                var myFormLayer = document.getElementById('formationLayer');
                myFormLayer.style.display = "block";
                /// don't let edit more movies at same time
                letEdit = false;
                //// Get Properties About The Movie 
                $.getJSON(url, function (data) {
                    var currentTableRow = document.getElementById('row' + it.dataset.index + '');
                    currentTableRow.innerHTML = '<tr><td>' + (parseInt(it.dataset.index) + 1) + '</td><td><input class="editInput" type="text" value="' + data.name + '" id="mEName"/>\n\
                </td><td><input class="editInput" type="text" value="' + data.image + '" id="mEImg"/></td><td><input class="editInput" type="text" value="' + data.length + '" id="mELength"/>\n\
                </td><td><select placeholder="" id="mEGenre" required="required" class="form-control editSelect" data-live-search="true" data-live-search-style="startsWith" class="selectpicker">\n\
                </select></td><td><input class="editInput" type="text"\n\
                value="' + parseFloat(data.rating) + '" id="mERating" onblur="checkRating(this);"/></td><td class="sm-td">\n\
                <input class="btn btn-success" type="button" value="Update" data-id="' + data.id + '" onclick="updateMovie(this)"/></td></tr>';
                    genresListLoad(document.getElementById('mEGenre'));
                });
            }
        }
        ;
        /////// Update The movie
        function updateMovie(it) {
            var currentMid = it.dataset.id;
            var inputName = document.getElementById('mEName');
            var inputLength = document.getElementById('mELength');
            var inputImage = document.getElementById('mEImg');
            var inputGenre = document.getElementById('mEGenre');
            var inputRating = document.getElementById('mERating');
            if (inputRating.value <= 10 && inputRating.value.length < 4) {
                $.post('../Controllers/moviesControllers/controlMovies.php', {id: currentMid, name: inputName.value, length: inputLength.value, rating: parseFloat(inputRating.value), image: inputImage.value, genre: inputGenre.value, update: null}, function () {
                });
                ///// Right Here movie Should've already updated.
                setTimeout(function () {
                    showMovies();
                }, 50);
                //// allow add again
                var myFormLayer = document.getElementById('formationLayer');
                myFormLayer.style.display = "none";
            }
            ;
        }
        ;
        ///// Check If rating is not higher than 10 .
        function checkRating(it) {
            if (!(it.value <= 10 && it.value.length < 4)) {
                it.style.border = "3px solid red";
            } else {
                it.style.border = "1px solid black";
            }
            ;
        }
        ;
        /////// Search For A movie
        function serachValue() {
            var searchKey = document.getElementsByName('searchKey')[0];
            if (searchKey.value === "") {
                document.getElementById('searchErr').style.display = "none";
                showMovies();
            } else {
                var url = '../Controllers/moviesControllers/controlMovies.php?search=' + searchKey.value;
                $.getJSON(url, function (matches) {
                    var searchErr = document.getElementById('searchErr');
                    if (matches.length > 0) {
                        /// found
                        searchErr.style.display = "none";
                        buildMoviesUsingArray(matches);
                    } else {
                        searchErr.style.display = "block";
                    }
                });
            }
        }
        ;
        ////// change collapse add cont arrow.
        var cBTN = document.getElementById('cBTN');
        var dr = 0;
        cBTN.addEventListener("click", function () {
            dr++;
            if (dr % 2 === 1) {
                cBTN.lastChild.firstChild.innerHTML = '&#8710';
            } else {
                cBTN.lastChild.firstChild.innerHTML = '&#x2207';
            }
        });
        ////// Nice Mr.Ajax Will appear Every Reload. set his sentence.
        var j = 0;
        var mrAjax = document.getElementById('mrAjax');
        var wordsArray = ["Hi!", "My", "Name", "is", "Mr.Ajax", "I Run", "onload.", "Bye Now."];
        function runMrAjax() {
            let currentWord = wordsArray[j];
            mrAjax.firstChild.innerHTML = currentWord;
            mrAjax.firstChild.style.opacity = "1";
            setTimeout(function () {
                mrAjax.firstChild.style.opacity = "0";
            }, 1210)
            j++;
            if (j === wordsArray.length) {
                clearTimeout(myWordsInterval);
                j = 0;
                setTimeout(function () {
                    mrAjax.style.opacity = "0";
                    mrAjax.style.display = "none";
                }, 2410)
            } else {
                myWordsInterval = setTimeout(runMrAjax, 2400);
            }
        }
        ;
        ////// Loads Genre List from api, safer for DB and serviece for client.
        function genresListLoad(mGenre) {
            $.getJSON('../JSON' + "'" + 's/moviesGenres.js', function (genres) {
                genres.forEach(function (genre) {
                    mGenre.innerHTML += '<option value="' + genre.name + '">' + genre.name + '</option>';
                });
            });
        }
        ;
    </script>
</html>
