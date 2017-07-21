<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<!DOCTYPE html>
<html>
    <head>
        <body>
            <div style="width:400px; margin-right:auto; margin-left:auto; margin-top:15px;">
            <form action="search.php" method="post" id="search">
                <select id="categoryList" name="Category">
                    <option value="all">All</option>
                    <option value="pictures">Pictures</option>
                    <option value="videos">Videos</option>
                </select>
                <input type="text" id="searchBar" placeholder="Enter keywords here..." maxlength="30" autocomplete="off" onMouseDown="" onblur=""/>
                <input  type="submit" id="searchButton" value="Search!"/>
            </form>
            </div>
        </body>
    </head>
</html>